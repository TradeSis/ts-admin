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

            <div class="col-6 col-lg-6">
                <h2 class="ts-tituloPrincipal">Fornecimento</h2>
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
                        <th>refProduto</th>
                        <th>Produto</th>
                        <th>Valor</th>
                        <th colspan="2">Ação</th>
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
                    </div><!--body-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!--------- ALTERAR --------->
        <div class="modal fade bd-example-modal-lg" id="alterarFornecedorModal" tabindex="-1" aria-labelledby="alterarFornecedorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar Fornecedor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                
                    </div>
                    <div class="modal-body">
                        <form method="post" id="form-alterarFornecedor">
                            <div class="row">
                                <div class="col-md">
                                    <label class="form-label ts-label">Cnpj</label>
                                    <input type="text" class="form-control ts-input" name="Cnpj" id="Cnpj" disabled>
                                </div>
                                <div class="col-md">
                                    <label class="form-label ts-label">Fornecedor</label>
                                    <input type="text" class="form-control ts-input" name="nomePessoa" id="nomePessoa" disabled>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-1">
                                    <label class="form-label ts-label">ID</label>
                                    <input type="text" class="form-control ts-input" name="idGeralProduto" id="idGeralProduto">
                                    <input type="hidden" class="form-control ts-input" name="idFornecimento" id="idFornecimento">
                                </div>
                                <div class="col-md">
                                    <label class="form-label ts-label">Produto</label>
                                    <input type="text" class="form-control ts-input" name="nomeProduto" id="nomeProduto" disabled>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label ts-label">refProduto</label>
                                    <input type="text" class="form-control ts-input" name="refProduto" id="refProduto">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label ts-label">valorCompra</label>
                                    <input type="text" class="form-control ts-input" name="valorCompra" id="valorCompra">
                                </div>
                            </div>
                    </div><!--body-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div><!--container-fluid-->

    <!-- LOCAL PARA COLOCAR OS JS -->

    <?php include_once ROOT . "/vendor/footer_js.php"; ?>

    <script>
        buscar($("#buscaFornecimento").val());

        function limpar() {
            buscar(null, null, null, null);
            window.location.reload();
        }

        function buscar(buscaFornecimento) {
            //alert (buscaFornecimento);
            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: '<?php echo URLROOT ?>/admin/database/geral.php?operacao=buscarGeralFornecimento',
                beforeSend: function() {
                    $("#dados").html("Carregando...");
                },
                data: {
                    buscaFornecimento: buscaFornecimento
                },
                success: function(msg) {
                    //alert("segundo alert: " + msg);
                    var json = JSON.parse(msg);

                    var linha = "";
                    for (var $i = 0; $i < json.length; $i++) {
                        var object = json[$i];

                        linha = linha + "<tr>";
                        linha = linha + "<td>" + object.Cnpj + "</td>";
                        linha = linha + "<td>" + object.nomePessoa + "</td>";
                        linha = linha + "<td>" + object.refProduto + "</td>";
                        linha = linha + "<td>" + object.nomeProduto + "</td>";
                        linha = linha + "<td>" + object.valorCompra + "</td>";

                        linha = linha + "<td>" + "<button type='button' class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#alterarFornecedorModal' data-idFornecimento='" + object.idFornecimento + "'><i class='bi bi-pencil-square'></i></button> "
                        linha = linha + "</tr>";
                    }
                    $("#dados").html(linha);
                }
            });
        }

        $("#buscar").click(function() {
            buscar($("#buscaFornecimento").val());
        })

        document.addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                buscar($("#buscaFornecimento").val());
            }
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
                        $('#Cnpj').val(data.Cnpj);
                        $('#refProduto').val(data.refProduto);
                        $('#idGeralProduto').val(data.idGeralProduto);
                        $('#valorCompra').val(data.valorCompra);
                        $('#nomePessoa').val(data.nomePessoa);
                        $('#nomeProduto').val(data.nomeProduto);
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