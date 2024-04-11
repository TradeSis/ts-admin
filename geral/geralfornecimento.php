<?php
//Helio 05102023 padrao novo
//Lucas 04042023 criado
include_once(__DIR__ . '/../header.php');

?>
<!doctype html>
<html lang="pt-BR">

<head>

    <?php include_once ROOT . "/vendor/head_css.php"; ?>

</head>

<body>
    <div class="container-fluid">

        <div class="row ">
            <!--<BR> MENSAGENS/ALERTAS -->
        </div>
        <div class="row">
            <!--<BR> BOTOES AUXILIARES -->
        </div>
        <div class="row d-flex align-items-center justify-content-center mt-1 pt-1 ">

            <div class="col-4 col-lg-4">
                <h2 class="ts-tituloPrincipal">Fornecimento</h2>
            </div>

            <div class="col-2 pt-2">
                <!-- FILTROS -->
                <form method="post">
                    <select class="form-select ts-input" name="filtroDataAtualizacao" id="filtroDataAtualizacao">
                        <option value="">Todos</option>
                        <option value="dataAtualizada">Atualizados</option>
                        <option value="dataNaoAtualizada">Nao Atualizados</option>
                    </select>
                </form>
            </div>
     
            <div class="col-6 col-lg-6">
                <div class="input-group">
                    <input type="text" class="form-control ts-input" id="buscaFornecimento" placeholder="Buscar por cpf/cnpj ou nome">
                    <button class="btn btn-primary rounded" type="button" id="buscar"><i class="bi bi-search"></i></button>
                    <button type="button" class="ms-4 btn btn-success" data-bs-toggle="modal" data-bs-target="#inserirFornecedorModal"><i class="bi bi-plus-square"></i>&nbsp Novo</button>
                </div>
            </div>

        </div>

        <div class="table mt-2 ts-divTabela ts-tableFiltros text-center">
            <table class="table table-sm table-hover">
                <thead class="ts-headertabelafixo">
                    <tr class="ts-headerTabelaLinhaCima">
                        <th>Cnpj</th>
                        <th>Fornecedor</th>
                        <th>idProduto</th>
                        <th>refProduto</th>
                        <th>eanProduto</th>
                        <th>Produto</th>
                        <th>Valor</th>
                        <th>cfop</th>
                        <th>origem</th>
                        <th>Att Trib.</th>
                        <th colspan="2">AÃ§Ã£o</th>
                    </tr>
                </thead>

                <tbody id='dados' class="fonteCorpo">

                </tbody>
            </table>
        </div>


        <!--------- INSERIR --------->
        <div class="modal fade bd-example-modal-lg" id="inserirFornecedorModal" tabindex="-1" aria-labelledby="inserirFornecedorModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Inserir Fornecedor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="form-inserirFornecedor">
                            <div class="row">
                                <div class="col-md">
                                    <label class="form-label ts-label">Cnpj</label>
                                    <input type="text" class="form-control ts-input" name="Cnpj">
                                </div>
                                <div class="col-md">
                                    <label class="form-label ts-label">refProduto</label>
                                    <input type="text" class="form-control ts-input" name="refProduto">
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label ts-label">idGeralProduto</label>
                                    <input type="text" class="form-control ts-input" name="idGeralProduto">
                                </div>
                                <div class="col-md">
                                    <label class="form-label ts-label">valorCompra</label>
                                    <input type="text" class="form-control ts-input" name="valorCompra">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md">
                                    <label class="form-label ts-label">Origem</label>
                                    <select class="form-select ts-input" name="origem">
                                        <option value="0">0 - Nacional, exceto as indicadas nos códigos 3 a 5</option>
                                        <option value="1">1 - Estrangeira - Importação direta, exceto a indicada no código 6</option>
                                        <option value="2">2- Estrangeira - Adquirida no mercado interno, exceto a indicada no código 7</option>
                                        <option value="3" title="mercadoria ou bem com Conteúdo de Importação superior a 40%">3 - Nacional, superior a 40%..</option>
                                        <option value="4" title="cuja produção tenha sido feita em conformidade com os processos produtivos básicos de que tratam o
Decreto-Lei no 288/1967 , e as Leis nos 8.248/1991, 8.387/1991, 10.176/2001 e 11.484/2007">4 - Nacional, processos produtivos</option>
                                        <option value="5" title="mercadoria ou bem com Conteúdo de Importação inferior ou igual a 40%">5 - Nacional, inferior ou igual a 40%</option>
                                        <option value="6" title="Importação direta, sem similar nacional, constante em lista de Resolução Camex e gás natural">6- Estrangeira - Importação direta</option>
                                        <option value="7" title="Adquirida no mercado interno, sem similar nacional, constante em lista de Resolução Camex
e gás natural">7 - Estrangeira - Adquirida no mercado interno</option>
                                        <option value="8" title="mercadoria ou bem com Conteúdo de Importação superior a 70% (setenta por cento)">8 - Nacional, superior a 70% (setenta por cento)</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label ts-label">cfop</label>
                                    <input type="text" class="form-control ts-input" name="cfop">
                                </div>
                            </div>
                    </div><!--body-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include 'modalFornecedor_Alterar.php'; ?>

    </div><!--container-fluid-->

    <!-- LOCAL PARA COLOCAR OS JS -->

    <?php include_once ROOT . "/vendor/footer_js.php"; ?>

    <script>
        buscar($("#buscaFornecimento").val(), $("#filtroDataAtualizacao").val());

        function limpar() {
            buscar(null, null, null, null);
            window.location.reload();
        }

        function buscar(buscaFornecimento, filtroDataAtualizacao) {
            //alert (buscaFornecimento);
            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: '<?php echo URLROOT ?>/admin/database/geral.php?operacao=buscarGeralFornecimento',
                beforeSend: function() {
                    $("#dados").html("Carregando...");
                },
                data: {
                    filtroDataAtualizacao: filtroDataAtualizacao,
                    buscaFornecimento: buscaFornecimento
                },
                success: function(msg) {
                    //alert("segundo alert: " + msg);
                    var json = JSON.parse(msg);

                    var linha = "";
                    for (var $i = 0; $i < json.length; $i++) {
                        var object = json[$i];

                        vnomeFantasia = object.nomeFantasia
                        if(object.nomeFantasia == null){
                            vnomeFantasia = object.nomePessoa
                        }

                        linha = linha + "<tr>";
                        linha = linha + "<td>" + object.Cnpj + "</td>";
                        linha = linha + "<td>" + vnomeFantasia + "</td>";
                        linha = linha + "<td>" + object.idGeralProduto + "</td>";
                        linha = linha + "<td>" + object.refProduto + "</td>";
                        linha = linha + "<td>" + (object.eanProduto ? object.eanProduto : "--")+ "</td>";
                        linha = linha + "<td>" + object.nomeProduto + "</td>";   
                        linha = linha + "<td>" + object.valorCompra + "</td>";
                        linha = linha + "<td>" + object.cfop + "</td>";
                        linha = linha + "<td>" + object.origem + "</td>";
                        linha = linha + "<td>" + (object.dataAtualizacaoTributaria ? formatarData(object.dataAtualizacaoTributaria) : "--") + "</td>";

                        linha = linha + "<td>" + "<button type='button' class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#alterarFornecedorModal' data-idFornecimento='" + object.idFornecimento + "'><i class='bi bi-pencil-square'></i></button> "
                        linha = linha + "</tr>";
                    }
                    $("#dados").html(linha);
                }
            });
        }

        function formatarData(data) {
            var d = new Date(data);
            var dia = d.getDate().toString().padStart(2, '0');
            var mes = (d.getMonth() + 1).toString().padStart(2, '0');
            var ano = d.getFullYear();
            var hora = d.getHours().toString().padStart(2, '0');
            var minutos = d.getMinutes().toString().padStart(2, '0');
            return dia + '/' + mes + '/' + ano + ' ' + hora + ':' + minutos;
        } 

        $("#buscar").click(function() {
            buscar($("#buscaFornecimento").val(), $("#filtroDataAtualizacao").val());
        })

        $("#filtroDataAtualizacao").change(function() {
            buscar($("#buscaFornecimento").val(), $("#filtroDataAtualizacao").val());
        })

        document.addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                buscar($("#buscaFornecimento").val(), $("#filtroDataAtualizacao").val());
            }
        });
        
        $(document).on('click', 'button[data-bs-target="#atualizaFornecedorModal"]', function() {

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../database/geral.php?operacao=atualizar',
            data: {
                idFornecimento: idFornecedorAtualiza
            }
        });
        window.location.reload();

        });

        $(document).on('click', 'button[data-bs-target="#alterarFornecedorModal"]', function() {
                var idFornecimento = $(this).attr("data-idFornecimento");
                //alert(idFornecimento)
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../database/geral.php?operacao=buscarGeralFornecimento',
                    data: {
                        idFornecimento: idFornecimento
                    },
                    success: function(data) {
                        $('#idFornecimento').val(data.idFornecimento);
                        idFornecedorAtualiza = data.idFornecimento;
                        $('#Cnpj').val(data.Cnpj);
                        $('#refProdutoFOR').val(data.refProduto);
                        $('#idGeralProdutoFOR').val(data.idGeralProduto);
                        $('#valorCompra').val(data.valorCompra);
                        $('#nomePessoa').val(data.nomePessoa);
                        $('#nomeProdutoFOR').val(data.nomeProduto);
                        $('#eanProdutoFOR').val(data.eanProduto);
                        $('#origem').val(data.origem);
                        $('#cfop').val(data.cfop);
                        vdataFormatada = (data.dataAtualizacaoTributaria ? formatarData(data.dataAtualizacaoTributaria) : "");
                        $('#dataAtualizacaoTributaria').val(vdataFormatada);

                        $('#alterarFornecedorModal').modal('show');
                    }
                });
            });

        $(document).ready(function() {
            $("#form-inserirFornecedor").submit(function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "../database/geral.php?operacao=geralFornecedorInserir",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: refreshPage,
                });
            });

            $("#form-alterarFornecedor").submit(function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "../database/geral.php?operacao=geralFornecedorAlterar",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: refreshPage,
                });
            });

        });

        function refreshPage() {
            window.location.reload();
        }

    </script>

    <!-- LOCAL PARA COLOCAR OS JS -FIM -->

</body>

</html>