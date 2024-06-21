
// Programa especializado em CRAR a tabela geralpessoas
def temp-table ttentrada no-undo serialize-name "geralpessoas"   /* JSON ENTRADA */
    LIKE geralpessoas.

  
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
   

