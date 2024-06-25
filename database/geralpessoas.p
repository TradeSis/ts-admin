
// Programa especializado em CRAR a tabela geralpessoas
def temp-table ttentrada no-undo serialize-name "geralpessoas"   /* JSON ENTRADA */
    LIKE geralpessoas
    FIELD idEmpresa AS INT.

//CONSULTA CNPJ
def TEMP-TABLE ttentradaConsulta NO-UNDO serialize-name "dadosEntradaConsulta"  /* JSON ENTRADA */
    FIELD idEmpresa AS INT
    field cnpj  AS CHAR.

def temp-table ttconsultaCnpj  NO-UNDO serialize-name "consultaCnpj"  /* JSON SAIDA */
    field cnae                    as CHAR.
    
//CNAE CLASSE
def TEMP-TABLE ttentradaCnae NO-UNDO serialize-name "dadosEntradaCnae"  /* JSON ENTRADA */
    field cnaeID      AS INT.

def temp-table ttcnaeClasse  no-undo serialize-name "cnaeClasse"  /* JSON SAIDA */
    field ID                    as CHAR
    field Descricao             as CHAR
    field grupoID               as CHAR
    field grupoDescricao        as CHAR
    field divisaoID             as CHAR
    field divisaoDescricao      as CHAR
    field secaoID               as CHAR
    field secaoDescricao        as CHAR
    field caracTrib             AS INT init ?
    field descricaoCaracTrib    as CHAR.
    
    
def input param vAcao as char.
DEF INPUT PARAM TABLE FOR ttentrada.
def output param vmensagem as char.

vmensagem = ?.

find first ttentrada no-error.
if not avail ttentrada then do:
    vmensagem = "Dados de Entrada nao encontrados".
    return.    
end.


if ttentrada.cpfCnpj = ? or ttentrada.cpfCnpj = ""
then do:
    vmensagem = "Dados de Entrada Invalidos".
    return.
end.


if vAcao = "PUT"
THEN DO:
  
    find geralpessoas where geralpessoas.cpfCnpj = ttentrada.cpfCnpj no-lock no-error.
    if avail geralpessoas
    then do:
        vmensagem = "Pessoa ja cadastrada".
        return.
    end.
    do on error undo:
        create geralpessoas.
      
        BUFFER-COPY ttentrada TO geralpessoas.
        
        if ttentrada.nomeFantasia = ? or ttentrada.nomeFantasia = ""
        then geralpessoas.nomeFantasia = entry(1,ttentrada.nomePessoa," ").
   
        IF geralpessoas.cnae = "" OR geralpessoas.cnae = ?
        THEN DO:
            
            CREATE ttentradaConsulta.
            ttentradaConsulta.idEmpresa = ttentrada.idEmpresa. 
            ttentradaConsulta.cnpj = geralpessoas.cpfCnpj.
            
            RUN admin/database/consulta_cnpj.p (  input table ttentradaConsulta,
                                                  INPUT-OUTPUT table ttconsultaCnpj, 
                                                  output vmensagem). 
            
            find first ttconsultaCnpj no-error.
            if not avail ttconsultaCnpj
            then do:
                vmensagem = "cnae nao encontrado".
                return.
            end.
            geralpessoas.cnae = ttconsultaCnpj.cnae.
            
            
            CREATE ttentradaCnae.
            ttentradaCnae.cnaeID = int(SUBSTRING(geralpessoas.cnae, 1, 5)).
            
            RUN impostos/database/cnaeClasse.p (  input table ttentradaCnae,
                                                  INPUT-OUTPUT table ttcnaeClasse, 
                                                  output vmensagem).
            find first ttcnaeClasse no-error.
            if not avail ttcnaeClasse
            then do:
                vmensagem = "cnaeClasse nao encontrado".
                return.
            end.
            geralpessoas.caracTrib = ttcnaeClasse.caracTrib.
            
        END.
        
    end.
END.
IF vAcao = "POST" 
THEN DO:

    find geralpessoas where geralpessoas.cpfCnpj = ttentrada.cpfCnpj no-lock no-error.
    if not avail geralpessoas
    then do:
        vmensagem = "Pessoa nao cadastrada".
        return.
    end.

    do on error undo:   
        find geralpessoas where geralpessoas.cpfCnpj = ttentrada.cpfCnpj EXCLUSIVE .
        BUFFER-COPY ttentrada EXCEPT ttentrada.cpfCnpj TO geralpessoas .
        
        if ttentrada.nomeFantasia = ? or ttentrada.nomeFantasia = ""
        then geralpessoas.nomeFantasia = entry(1,ttentrada.nomePessoa," ").
    end.
    
END.
   

