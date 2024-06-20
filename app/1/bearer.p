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
  
DEFINE VARIABLE joToken         AS JsonObject NO-UNDO.

def input param vlcentrada as longchar. /* JSON ENTRADA */
def input param vtmp       as char.     /* CAMINHO PROGRESS_TMP */
RUN LOG("INICIO").

def var vlcsaida   as longchar.         /* JSON SAIDA */

def var lokjson as log.                 /* LOGICAL DE APOIO */
def var hentrada as handle.             /* HANDLE ENTRADA */
def var hsaida   as handle.             /* HANDLE SAIDA */

def TEMP-TABLE ttentrada NO-UNDO serialize-name "dadosEntrada"  /* JSON ENTRADA */
    field idEmpresa      AS INT.

def temp-table ttbearer  no-undo serialize-name "bearer"  /* JSON SAIDA */
    field access_token                    as CHAR.

def temp-table ttsaida  no-undo serialize-name "conteudoSaida"  /* JSON SAIDA CASO ERRO */
    field tstatus        as int serialize-name "status"
    field descricaoStatus      as CHAR.


hEntrada = temp-table ttentrada:HANDLE.
lokJSON = hentrada:READ-JSON("longchar",vlcentrada, "EMPTY") no-error.

/* find first ttentrada no-error.
IF NOT AVAIL ttentrada 
THEN DO:
    RUN montasaida (400,"Dados de entrada invalidos!").
    RETURN.
END. */


 oLib = ClientLibraryBuilder:Build()
                            :sslVerifyHost(NO)
                            :ServerNameIndicator('gateway.apiserpro.serpro.gov.br') 
                            :library.
                                      
/* INI - requisicao web */
ASSIGN netClient   = ClientBuilder:Build():UsingLibrary(oLib):Client 
       netUri      = new URI("https", "gateway.apiserpro.serpro.gov.br") /* URI("metodo", "dominio", "porta") */
       netUri:Path = "/token?grant_type=client_credentials".
 


//FAZ A REQUISIÇÃO
netRequest = RequestBuilder:POST (netUri)
                     :AcceptJson()
                     :AddHeader("Authorization", "Basic SGNja1lqNnQyb2pmV3pvSjZYVUJzelIxd0ZjYTpFdlRCMGtzODhnSjNSOXl3Zks0dm5vc1FScUVh")
                     :AddHeader("Content-Type", "application/x-www-form-urlencoded")
                     :REQUEST.

netResponse = netClient:EXECUTE(netRequest).

//TRATA RETORNO
if type-of(netResponse:Entity, JsonObject) then do:
    joResponse = CAST(netResponse:Entity, JsonObject).
    joResponse:Write(lcJsonResponse).
    RUN LOG("RETORNO Token BEARER " + STRING(lcJsonResponse)).
    
    joToken = joResponse.
   
   CREATE ttbearer.
   ttbearer.access_token = joToken:GetCharacter("access_token").

END.


find first ttbearer no-error.

if not avail ttbearer
then do:
    create ttsaida.
    ttsaida.tstatus = 400.
    ttsaida.descricaoStatus = "bearer nao encontrado".

    hsaida  = temp-table ttsaida:handle.

    lokJson = hsaida:WRITE-JSON("LONGCHAR", vlcSaida, TRUE).
    message string(vlcSaida).
    return.
end.

hsaida  = TEMP-TABLE ttbearer:handle.


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
    OUTPUT TO VALUE(vtmp + "/bearer_" + string(today,"99999999") + ".log") APPEND.
        PUT UNFORMATTED 
            STRING (TIME,"HH:MM:SS")
            " progress -> " vmensagem
            SKIP.
    OUTPUT CLOSE.
    
END PROCEDURE.
