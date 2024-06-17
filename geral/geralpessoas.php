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
                <h2 class="ts-tituloPrincipal">Pessoas</h2>
            </div>

            <div class="col-6 col-lg-6">
                <div class="input-group">
                    <input type="text" class="form-control ts-input" id="buscaPessoa" placeholder="Buscar por cpf/cnpj ou nome">
                    <button class="btn btn-primary rounded" type="button" id="buscar"><i class="bi bi-search"></i></button>
                    <button type="button" class="ms-4 btn btn-success" data-bs-toggle="modal" data-bs-target="#inserirPessoaModal"><i class="bi bi-plus-square"></i>&nbsp Novo</button>
                </div>
            </div>

        </div>

        <div class="table mt-2 ts-divTabela ts-tableFiltros text-center">
            <table class="table table-sm table-hover">
                <thead class="ts-headertabelafixo">
                    <tr class="ts-headerTabelaLinhaCima">
                        <th>Cpf/Cnpj</th>
                        <th>Nome</th>
                        <th>Estado</th>
                        <th>regimetrib</th>
                        <th>CRT</th>
                        <th>caractrib</th>
                        <th>regime especial</th>
                        <th>cnae</th>
                        <th colspan="2">Ação</th>
                    </tr>
                </thead>

                <tbody id='dados' class="fonteCorpo">

                </tbody>
            </table>
        </div>


        <!--------- INSERIR --------->
        <div class="modal fade bd-example-modal-lg" id="inserirPessoaModal" tabindex="-1" aria-labelledby="inserirPessoaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Inserir Pessoa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <ul class="nav nav-tabs gap-1" id="tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link ts-tabModal active" id="tabInserir1-tab" data-bs-toggle="tab" href="#tabInserir1" role="tab" aria-controls="tabInserir1" aria-selected="true">Dados Pessoais</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ts-tabModal" id="tabInserir2-tab" data-bs-toggle="tab" href="#tabInserir2" role="tab" aria-controls="tabInserir2" aria-selected="false">Endereço</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ts-tabModal" id="tabInserir3-tab" data-bs-toggle="tab" href="#tabInserir3" role="tab" aria-controls="tabInserir3" aria-selected="false">Dados Tributarios</a>
                            </li>
                        </ul>
                        <form method="post" id="form-inserirPessoas">
                            <div class="tab-content" id="myTabsContent">
                                <div class="tab-pane fade show active" id="tabInserir1" role="tabpanel" aria-labelledby="tabInserir1-tab">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label class="form-label ts-label">Tipo Pessoa<span class="text-danger"> * </span></label>
                                                <select class="form-select ts-input" name="tipoPessoa" required>
                                                    <option value="J">Jurídica</option>
                                                    <option value="F">Física</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label ts-label">Cpf/Cnpj<span class="text-danger"> * </span></label>
                                                <input type="text" class="form-control ts-input" name="cpfCnpj" required>
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">Nome<span class="text-danger"> * </span></label>
                                                <input type="text" class="form-control ts-input" name="nomePessoa" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md">
                                                <label class="form-label ts-label">Nome Fantasia<span class="text-danger"> * </span></label>
                                                <input type="text" class="form-control ts-input" name="nomeFantasia" required>
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">Email</label>
                                                <input type="text" class="form-control ts-input" name="email">
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">Telefone</label>
                                                <input type="text" class="form-control ts-input" name="telefone">
                                            </div>
                                        </div>
                                    </div><!-- container 1 -->
                                </div><!-- tab-pane 1 -->

                                <div class="tab-pane fade" id="tabInserir2" role="tabpanel" aria-labelledby="tabInserir2-tab">
                                    <div class="container">
                                        <div class="row mt-3">
                                            <div class="col-md">
                                                <label class="form-label ts-label">codigoCidade<span class="text-danger"> * </span></label>
                                                <input type="text" class="form-control ts-input" name="codigoCidade" required>
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">codigoEstado<span class="text-danger"> * </span></label>
                                                <input type="text" class="form-control ts-input" name="codigoEstado" required>
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">CEP</label>
                                                <input type="text" class="form-control ts-input" name="cep">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md">
                                                <label class="form-label ts-label">Bairro</label>
                                                <input type="text" class="form-control ts-input" name="bairro">
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">Endereço</label>
                                                <input type="text" class="form-control ts-input" name="endereco">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label ts-label">Numero</label>
                                                <input type="text" class="form-control ts-input" name="endNumero">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md">
                                                <label class="form-label ts-label">Município</label>
                                                <input type="text" class="form-control ts-input" name="municipio">
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">IE</label>
                                                <input type="text" class="form-control ts-input" name="IE">
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">País</label>
                                                <input type="text" class="form-control ts-input" name="pais">
                                            </div>
                                        </div>
                                    </div><!-- container 2 -->
                                </div><!-- tab-pane3 -->

                                <div class="tab-pane fade" id="tabInserir3" role="tabpanel" aria-labelledby="tabInserir3-tab">
                                    <div class="container">
                                        <div class="row mt-3">
                                            <!-- lucas 04042024 - Alterado para select: crt, regimeTrib e caracTrib -->
                                            <div class="col-md">
                                                <label class="form-label ts-label">regimeTrib<span class="text-danger"> * </span></label>
                                                <select class="form-select ts-input" name="regimeTrib" required>
                                                    <option value="">Selecione</option>
                                                    <option value="SN" value="SN">SN - Simples Nacional</option>
                                                    <option value="LR">LR - Lucro Real</option>
                                                    <option value="LP">LP - Lucro Presumido</option>
                                                </select>
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">crt<span class="text-danger"> * </span></label>
                                                <select class="form-select ts-input" name="crt" required>
                                                    <option value="">Selecione</option>
                                                    <option data-datacrt="SN" value="1">1 - Simples Nacional</option>
                                                    <option data-datacrt="SN" value="2">2 - SN com excesso sublimite de receita bruta</option>

                                                    <option data-datacrt="LR" value="3">3 - Regime Normal. (v2.0)</option>
                                                    <option data-datacrt="LP" value="3">3 - Regime Normal. (v2.0)</option>
                                                </select>
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">caracTrib<span class="text-danger"> * </span></label>
                                                <select class="form-select ts-input" name="caracTrib" required>
                                                    <option value="0">0 - Industrial</option>
                                                    <option value="1">1 - Distribuidor</option>
                                                    <option value="2">2 - Atacadista</option>
                                                    <option value="3">3 - Varejista</option>
                                                    <option value="4">4 - Produtor Rural Fantasia Juridica</option>
                                                    <option value="6">6 - Produtor Rural Pessoa Fisica</option>
                                                    <option value="7">7 - Pessoa Juridica n�o Contribuinte do ICMS</option>
                                                    <option value="8">8 - Pessoa Fisica n�o Contribuinte do ICMS</option>
                                                    <option value="9">9 - Armaz�m Geral</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md">
                                                <label class="form-label ts-label">regimeEspecial</label>
                                                <input type="text" class="form-control ts-input" name="regimeEspecial">
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">cnae</label>
                                                <input type="text" class="form-control ts-input" name="cnae">
                                            </div>
                                        </div>
                                    </div><!-- container 3 -->

                                </div><!-- tab-pane3 -->

                            </div><!-- tab-content -->

                    </div><!--body-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="btn-formInserir">Cadastrar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!--------- ALTERAR --------->
        <div class="modal fade bd-example-modal-lg" id="alterarPessoaModal" tabindex="-1" aria-labelledby="alterarPessoaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar Pessoa: </h5>
                        <h5 class="modal-title" id="titulomodalalterar"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <ul class="nav nav-tabs gap-1" id="tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link ts-tabModal active" id="tabAlterar1-tab" data-bs-toggle="tab" href="#tabAlterar1" role="tab" aria-controls="tabAlterar1" aria-selected="true">Dados Pessoais</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ts-tabModal" id="tabAlterar2-tab" data-bs-toggle="tab" href="#tabAlterar2" role="tab" aria-controls="tabAlterar2" aria-selected="false">Endereço</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ts-tabModal" id="tabAlterar3-tab" data-bs-toggle="tab" href="#tabAlterar3" role="tab" aria-controls="tabAlterar3" aria-selected="false">Dados Tributarios</a>
                            </li>
                        </ul>
                        <form method="post" id="form-alterarPessoas">
                            <div class="tab-content" id="myTabsContent">
                                <div class="tab-pane fade show active" id="tabAlterar1" role="tabpanel" aria-labelledby="tabAlterar1-tab">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label class="form-label ts-label">Tipo Pessoa<span class="text-danger"> * </span></label>
                                                <select class="form-select ts-input" name="tipoPessoa" id="tipoPessoa" required>
                                                    <option value="J">Jurídica</option>
                                                    <option value="F">Física</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label ts-label">Cpf/Cnpj<span class="text-danger"> * </span></label>
                                                <input type="text" class="form-control ts-input" id="cpfCnpj" name="cpfCnpj" required>
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">Nome<span class="text-danger"> * </span></label>
                                                <input type="text" class="form-control ts-input" name="nomePessoa" id="nomePessoa" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md">
                                                <label class="form-label ts-label">Nome Fantasia<span class="text-danger"> * </span></label>
                                                <input type="text" class="form-control ts-input" name="nomeFantasia" id="nomeFantasia" required>
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">Email</label>
                                                <input type="text" class="form-control ts-input" id="email" name="email">
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">Telefone</label>
                                                <input type="text" class="form-control ts-input" id="telefone" name="telefone">
                                            </div>
                                        </div>
                                    </div><!-- container 1 -->
                                </div><!-- tab-pane 1 -->

                                <div class="tab-pane fade" id="tabAlterar2" role="tabpanel" aria-labelledby="tabAlterar2-tab">
                                    <div class="container">
                                        <div class="row mt-3">
                                            <div class="col-md">
                                                <label class="form-label ts-label">codigoCidade<span class="text-danger"> * </span></label>
                                                <input type="text" class="form-control ts-input" id="codigoCidade" name="codigoCidade" required>
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">codigoEstado<span class="text-danger"> * </span></label>
                                                <input type="text" class="form-control ts-input" id="codigoEstado" name="codigoEstado" required>
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">CEP</label>
                                                <input type="text" class="form-control ts-input" id="cep" name="cep">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md">
                                                <label class="form-label ts-label">Bairro</label>
                                                <input type="text" class="form-control ts-input" id="bairro" name="bairro">
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">Endereço</label>
                                                <input type="text" class="form-control ts-input" id="endereco" name="endereco">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label ts-label">Numero</label>
                                                <input type="text" class="form-control ts-input" id="endNumero" name="endNumero">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md">
                                                <label class="form-label ts-label">Município</label>
                                                <input type="text" class="form-control ts-input" id="municipio" name="municipio">
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">IE</label>
                                                <input type="text" class="form-control ts-input" id="IE" name="IE">
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">País</label>
                                                <input type="text" class="form-control ts-input" id="pais" name="pais">
                                            </div>
                                        </div>
                                    </div><!-- container 2 -->
                                </div><!-- tab-pane3 -->

                                <div class="tab-pane fade" id="tabAlterar3" role="tabpanel" aria-labelledby="tabAlterar3-tab">
                                    <div class="container">
                                        <div class="row mt-3">
                                            <!-- lucas 04042024 - Alterado para select: crt, regimeTrib e caracTrib -->
                                            <div class="col-md">
                                                <label class="form-label ts-label">regimeTrib<span class="text-danger"> * </span></label>
                                                <select class="form-select ts-input" name="regimeTrib" id="regimeTrib" required>
                                                    <option value="">Selecione</option>
                                                    <option value="SN" value="SN">SN - Simples Nacional</option>
                                                    <option value="LR">LR - Lucro Real</option>
                                                    <option value="LP">LP - Lucro Presumido</option>
                                                </select>
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">crt<span class="text-danger"> * </span></label>
                                                <select class="form-select ts-input" name="crt" id="crt" required>
                                                    <option value="">Selecione</option>
                                                    <option value="1">1 - Simples Nacional</option>
                                                    <option value="2">2 - SN com excesso sublimite de receita bruta</option>

                                                    <option value="3">3 - Regime Normal. (v2.0)</option>
                                                    <option value="3">3 - Regime Normal. (v2.0)</option>
                                                </select>
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">caracTrib<span class="text-danger"> * </span></label>
                                                <select class="form-select ts-input" name="caracTrib" id="caracTrib" required>
                                                    <option value="0">0 - Industrial</option>
                                                    <option value="1">1 - Distribuidor</option>
                                                    <option value="2">2 - Atacadista</option>
                                                    <option value="3">3 - Varejista</option>
                                                    <option value="4">4 - Produtor Rural Pessoa Juridica</option>
                                                    <option value="6">6 - Produtor Rural Pessoa Fisica</option>
                                                    <option value="7">7 - Pessoa Juridica n�o Contribuinte do ICMS</option>
                                                    <option value="8">8 - Pessoa Fisica n�o Contribuinte do ICMS</option>
                                                    <option value="9">9 - Armaz�m Geral</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md">
                                                <label class="form-label ts-label">regimeEspecial</label>
                                                <input type="text" class="form-control ts-input" id="regimeEspecial" name="regimeEspecial">
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label ts-label">cnae</label>
                                                <input type="text" class="form-control ts-input" id="cnae" name="cnae">
                                            </div>
                                        </div>
                                    </div><!-- container 3 -->

                                </div><!-- tab-pane3 -->

                            </div><!-- tab-content -->

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
        buscar($("#buscaPessoa").val());


        function buscar(buscaPessoa) {
            //alert (buscaPessoa);
            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: '<?php echo URLROOT ?>/admin/database/geral.php?operacao=buscarGeralPessoas',
                beforeSend: function() {
                    $("#dados").html("Carregando...");
                },
                data: {
                    cpfCnpj: buscaPessoa,
                    acao: "filtrar"
                },
                success: function(msg) {
                    //alert("segundo alert: " + msg);
                    var json = JSON.parse(msg);

                    var linha = "";
                    for (var $i = 0; $i < json.length; $i++) {
                        var object = json[$i];

                        vnomeFantasia = object.nomeFantasia
                        if (object.nomeFantasia == null) {
                            vnomeFantasia = object.nomePessoa
                        }

                        linha = linha + "<tr>";
                        linha = linha + "<td>" + object.cpfCnpj + "</td>";
                        linha = linha + "<td>" + vnomeFantasia + "</td>";

                        linha = linha + "<td>" + object.codigoEstado + "</td>";
                        linha = linha + "<td>" + object.regimeTrib + "</td>";
                        linha = linha + "<td>" + object.crt + "</td>";
                        linha = linha + "<td>" + object.caracTrib + "</td>";
                        linha = linha + "<td>" + object.regimeEspecial + "</td>";
                        linha = linha + "<td>" + object.cnae + "</td>";

                        linha = linha + "<td>" + "<button type='button' class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#alterarPessoaModal' data-cpfCnpj='" + object.cpfCnpj + "'><i class='bi bi-pencil-square'></i></button> "
                        linha = linha + "</tr>";
                    }
                    $("#dados").html(linha);
                }
            });
        }

        $("#buscar").click(function() {
            buscar($("#buscaPessoa").val());
        })

        document.addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                buscar($("#buscaPessoa").val());
            }
        });

        $(document).on('click', 'button[data-bs-target="#alterarPessoaModal"]', function() {
            var cpfCnpj = $(this).attr("data-cpfCnpj");
            //alert(cpfCnpj)
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '../database/geral.php?operacao=buscarGeralPessoas',
                data: {
                    cpfCnpj: cpfCnpj
                },
                success: function(data) {
                    $('#cpfCnpj').val(data.cpfCnpj);
                    $('#tipoPessoa').val(data.tipoPessoa);
                    $('#nomePessoa').val(data.nomePessoa);
                    $('#nomeFantasia').val(data.nomeFantasia);
                    //titulo modal alterar
                    var texto = $("#titulomodalalterar");
                    texto.html(' &nbsp ' + data.nomeFantasia);
                    $('#IE').val(data.IE);
                    $('#municipio').val(data.municipio);
                    $('#pais').val(data.pais);
                    $('#bairro').val(data.bairro);
                    $('#endereco').val(data.endereco);
                    $('#endNumero').val(data.endNumero);
                    $('#cep').val(data.cep);
                    $('#email').val(data.email);
                    $('#telefone').val(data.telefone);
                    $('#facebook').val(data.facebook);
                    $('#instagram').val(data.instagram);
                    $('#twitter').val(data.twitter);
                    $('#imgPerfil').val(data.imgPerfil);
                    $('#crt').val(data.crt);
                    $('#regimeTrib').val(data.regimeTrib);
                    $('#cnae').val(data.cnae);
                    $('#regimeEspecial').val(data.regimeEspecial);
                    $('#codigoCidade').val(data.codigoCidade);
                    $('#codigoEstado').val(data.codigoEstado);
                    $('#caracTrib').val(data.caracTrib);

                    $('#alterarPessoaModal').modal('show');
                }
            });
        });

        $(document).ready(function() {
            $("#form-inserirPessoas").submit(function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "../database/geral.php?operacao=geralpessoasInserir",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: refreshPage,
                });
            });

            $("#form-alterarPessoas").submit(function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "../database/geral.php?operacao=geralpessoasAlterar",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: refreshPage,
                });
            });

            $("input[name='cpfCnpj']").on("input", function() {
                var cpfCnpj = $(this).val();
                if (cpfCnpj.length >= 11) {
                    verificaCampoCNPJ(cpfCnpj);
                }
            });

            function refreshPage() {
                window.location.reload();
            }

            function verificaCampoCNPJ(cpfCnpj) {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../database/pessoas.php?operacao=verificaCNPJ',
                    data: {
                        cpfCnpj: cpfCnpj
                    },
                    success: function(data) {
                        //alert(data)
                        if (data == 'LIBERADO') {
                            //alert('DEU CERTO');
                            //$('#btn-formInserir').show();
                        } else {
                            alert('CPF ou CNPJ já cadastrado!');
                            //$('#btn-formInserir').hide();
                        }
                    }
                });
            }
        });

        // lucas 04042024 - Select inserir de crt e regimeTrib
        var vcrt = $('select[name="crt"] option');
        $('select[name="regimeTrib"]').on('change', function() {
            var regimeTrib = this.value;
            var novoSelect = vcrt.filter(function() {
                return $(this).data('datacrt') == regimeTrib;
            });
            $('select[name="crt"]').html(novoSelect);
        });
    </script>

    <!-- LOCAL PARA COLOCAR OS JS -FIM -->

</body>

</html>