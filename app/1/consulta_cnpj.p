/** Carrega bibliotecas necessarias **/
using OpenEdge.Net.HTTP.IHttpClientLibrary.
using OpenEdge.Net.HTTP.ConfigBuilder.
using OpenEdge.Net.HTTP.ClientBuilder.
using OpenEdge.Net.HTTP.Credentials.
using OpenEdge.Net.HTTP.IHttpClient.
using OpenEdge.Net.HTTP.IHttpRequest.
using OpenEdge.Net.HTTP.RequestBuilder.
using OpenEdge.Net.URI.
using OpenEdge.Net.HTTP.IHttpResponse.
using Progress.Json.ObjectModel.JsonObject.
using Progress.Json.ObjectModel.JsonArray.
using Progress.Json.ObjectModel.ObjectModelParser.
USING OpenEdge.Net.HTTP.Lib.ClientLibraryBuilder.

DEFINE VARIABLE oLib AS IHttpClientLibrary NO-UNDO.

def VAR netClient        AS IHttpClient        no-undo.
def VAR netUri           as URI                no-undo.
def VAR netRequest       as IHttpRequest       no-undo.
def VAR netResponse      as IHttpResponse      no-undo.

DEF VAR joResponse       AS JsonObject NO-UNDO.
DEF VAR lcJsonRequest    AS LONGCHAR NO-UNDO.
DEF VAR lcJsonResponse   AS LONGCHAR NO-UNDO.
  
DEFINE VARIABLE joCNPJ         AS JsonObject NO-UNDO.
DEFINE VARIABLE joCNAE         AS JsonObject NO-UNDO.

def input param vlcentrada as longchar. /* JSON ENTRADA */
def input param vtmp       as char.     /* CAMINHO PROGRESS_TMP */

def VAR vlcbearer as longchar. /* JSON ENTRADA */
RUN LOG("INICIO").

def var vlcsaida   as longchar.         /* JSON SAIDA */

def var lokjson as log.                 /* LOGICAL DE APOIO */
def var hentrada as handle.             /* HANDLE ENTRADA */
def var hbearer as handle.             
def var hsaida   as handle.             /* HANDLE SAIDA */

def TEMP-TABLE ttentrada NO-UNDO serialize-name "dadosEntrada"  /* JSON ENTRADA */
    field cnpj  AS CHAR.

def temp-table ttconsultaCnpj  NO-UNDO serialize-name "consultaCnpj"  /* JSON SAIDA */
    field cnae                    as CHAR.
    
def temp-table ttsaida  no-undo serialize-name "conteudoSaida"  /* JSON SAIDA CASO ERRO */
    field tstatus        as int serialize-name "status"
    field descricaoStatus      as CHAR.

DEF VAR token AS CHAR. 

hEntrada = temp-table ttentrada:HANDLE.
lokJSON = hentrada:READ-JSON("longchar",vlcentrada, "EMPTY") no-error.

find first ttentrada no-error.
IF NOT AVAIL ttentrada 
THEN DO:
    RUN montasaida (400,"Dados de entrada invalidos!").
    RETURN.
END.

 oLib = ClientLibraryBuilder:Build()
                            :sslVerifyHost(NO)
                            :ServerNameIndicator('gateway.apiserpro.serpro.gov.br')
                            :library.
                                      
/* INI - requisicao web */
ASSIGN netClient   = ClientBuilder:Build()
                                  :UsingLibrary(oLib)
                                  :Client       
       netUri      = new URI("https", "gateway.apiserpro.serpro.gov.br") /* URI("metodo", "dominio", "porta") */
       netUri:Path = "/consulta-cnpj-df/v2/basica/" + STRING(ttentrada.cnpj).    


RUN admin/database/bearer.p (OUTPUT token).


//FAZ A REQUISIÇÃO
netRequest = RequestBuilder:GET (netUri)
                     :AcceptJson()
                     :AddHeader("Accept", "application/json")
                     :AddHeader("Authorization", "Bearer " + token)
                     :REQUEST.

netResponse = netClient:EXECUTE(netRequest).

//TRATA RETORNO
if type-of(netResponse:Entity, JsonObject) then do:
    joResponse = CAST(netResponse:Entity, JsonObject).
    joResponse:Write(lcJsonResponse).
    RUN LOG("RETORNO CNPJ " + STRING(lcJsonResponse)).
    
    joCNPJ = joResponse.
    joCNAE = joCNPJ:GetJsonObject("cnaePrincipal").

   CREATE ttconsultaCnpj.
   ttconsultaCnpj.cnae = joCNAE:GetCharacter("codigo").

END.


find first ttconsultaCnpj no-error.

if not avail ttconsultaCnpj
then do:
    create ttsaida.
    ttsaida.tstatus = 400.
    ttsaida.descricaoStatus = "consultaCnpj nao encontrado".

    hsaida  = temp-table ttsaida:handle.

    lokJson = hsaida:WRITE-JSON("LONGCHAR", vlcSaida, TRUE).
    message string(vlcSaida).
    return.
end.

hsaida  = TEMP-TABLE ttconsultaCnpj:handle.


lokJson = hsaida:WRITE-JSON("LONGCHAR", vlcSaida, TRUE).
put unformatted string(vlcSaida).

procedure montasaida.
    DEF INPUT PARAM tstatus AS INT.
    DEF INPUT PARAM tdescricaoStatus AS CHAR.

    create ttsaida.
    ttsaida.tstatus = tstatus.
    ttsaida.descricaoStatus = tdescricaoStatus.

    hsaida  = temp-table ttsaida:handle.

    lokJson = hsaida:WRITE-JSON("LONGCHAR", vlcSaida, TRUE).
    put unformatted string(vlcSaida).

END PROCEDURE.


procedure LOG.
    DEF INPUT PARAM vmensagem AS CHAR.    
    OUTPUT TO VALUE(vtmp + "/consulta_cnpj_" + string(today,"99999999") + ".log") APPEND.
        PUT UNFORMATTED 
            STRING (TIME,"HH:MM:SS")
            " progress -> " vmensagem
            SKIP.
    OUTPUT CLOSE.
    
END PROCEDURE.
