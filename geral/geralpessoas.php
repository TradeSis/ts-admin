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
                        <th>IE</th>
                        <th>País</th>
                        <th>Endereço</th>
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
                        <form method="post" id="form-inserirPessoas">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="form-label ts-label">Tipo de Pessoa</label>
                                    <select class="form-select ts-input" name="tipoPessoa">
                                        <option value="J">Jurídica</option>
                                        <option value="F">Física</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label ts-label">Cpf/Cnpj</label>
                                    <input type="text" class="form-control ts-input" name="cpfCnpj" required>
                                </div>
                                <div class="col-md">
                                    <label class="form-label ts-label">Nome</label>
                                    <input type="text" class="form-control ts-input" name="nomePessoa" required>
                                </div>
                            </div><!--fim row 1-->
                            <div class="row mt-3">
                                <div class="col-md">
                                    <label class="form-label ts-label">codigoCidade</label>
                                    <input type="text" class="form-control ts-input" name="codigoCidade" required>
                                </div>
                                <div class="col-md">
                                    <label class="form-label ts-label">codigoEstado</label>
                                    <input type="text" class="form-control ts-input" name="codigoEstado">
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
                            </div><!--fim row 2-->
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
                            </div><!--fim row 3-->
                            <div class="row mt-3">
                                <div class="col-md">
                                    <label class="form-label ts-label">Email</label>
                                    <input type="text" class="form-control ts-input" name="email">
                                </div>
                                <div class="col-md">
                                    <label class="form-label ts-label">Telefone</label>
                                    <input type="text" class="form-control ts-input" name="telefone">
                                </div>
                            </div><!--fim row 4-->
                            <div class="row mt-3">
                                <!-- lucas 04042024 - Alterado para select: crt, regimeTrib e caracTrib -->
                                <div class="col-md">
                                    <label class="form-label ts-label">crt</label>
                                    <select class="form-select ts-input" name="crt">
                                        <option value="">Selecione</option>
                                        <option value="1">1- Simples Nacional</option>
                                        <option value="2" title="SN com excesso sublimite de receita bruta">2 - SN com excesso</option>
                                        <option value="3">3- Regime Normal</option>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <label class="form-label ts-label">regimeTrib</label>
                                    <select class="form-select ts-input" name="regimeTrib">
                                        <option value="">Selecione</option>
                                        <option data-crt="1" value="SN">SN</option>
                                        <option data-crt="2" value="SN">SN</option>
                                        <option data-crt="3" value="LR">LR</option>
                                        <option data-crt="3" value="LP">LP</option>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <label class="form-label ts-label">caracTrib</label>
                                    <select class="form-select ts-input" name="caracTrib">
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
                                    <input type="text" class="form-control ts-input" name="regimeEspecial">
                                </div>
                                <div class="col-md">
                                    <label class="form-label ts-label">cnae</label>
                                    <input type="text" class="form-control ts-input" name="cnae">
                                </div>
                            </div><!--fim row 5-->
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
                        <h5 class="modal-title" id="exampleModalLabel">Alterar Pessoa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="form-alterarPessoas">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="form-label ts-label">Tipo de Pessoa</label>
                                    <select class="form-select ts-input" name="tipoPessoa" id="tipoPessoa">
                                        <option value="J">Jurídica</option>
                                        <option value="F">Física</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label ts-label">Cpf/Cnpj</label>
                                    <input type="text" class="form-control ts-input" id="cpfCnpj" name="cpfCnpj">
                                </div>
                                <div class="col-md">
                                    <label class="form-label ts-label">Nome</label>
                                    <input type="text" class="form-control ts-input" name="nomePessoa" id="nomePessoa">
                                </div>
                            </div><!--fim row 1-->
                            <div class="row mt-3">
                                <div class="col-md">
                                    <label class="form-label ts-label">codigoCidade</label>
                                    <input type="text" class="form-control ts-input" id="codigoCidade" name="codigoCidade">
                                </div>
                                <div class="col-md">
                                    <label class="form-label ts-label">codigoEstado</label>
                                    <input type="text" class="form-control ts-input" id="codigoEstado" name="codigoEstado">
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
                            </div><!--fim row 2-->
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
                            </div><!--fim row 3-->
                            <div class="row mt-3">
                                <div class="col-md">
                                    <label class="form-label ts-label">Email</label>
                                    <input type="text" class="form-control ts-input" id="email" name="email">
                                </div>
                                <div class="col-md">
                                    <label class="form-label ts-label">Telefone</label>
                                    <input type="text" class="form-control ts-input" id="telefone" name="telefone">
                                </div>
                            </div><!--fim row 4-->
                            <div class="row mt-3">
                                <!-- lucas 04042024 - Alterado para select: crt, regimeTrib e caracTrib -->
                                <div class="col-md">
                                    <label class="form-label ts-label">crt</label>
                                    <select class="form-select ts-input" name="crt" id="crt">
                                        <option value="1">1- Simples Nacional</option>
                                        <option value="2" title="SN com excesso sublimite de receita bruta">2 - SN com excesso</option>
                                        <option value="3">3 - Regime Normal</option>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <label class="form-label ts-label">regimeTrib</label>
                                    <select class="form-select ts-input" name="regimeTrib" id="regimeTrib">
                                        <option value="">Selecione</option>
                                        <option value="SN">SN</option>
                                        <option value="SN">SN</option>
                                        <option value="LR">LR</option>
                                        <option value="LP">LP</option>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <label class="form-label ts-label">caracTrib</label>
                                    <select class="form-select ts-input" name="caracTrib" id="caracTrib">
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
                            </div><!--fim row 5-->
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

                        linha = linha + "<tr>";
                        linha = linha + "<td>" + object.cpfCnpj + "</td>";
                        linha = linha + "<td>" + object.nomePessoa + "</td>";
                        linha = linha + "<td>" + object.IE + "</td>";
                        linha = linha + "<td>" + object.pais + "</td>";
                        linha = linha + "<td>" + object.endereco + "</td>";

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
        var vregimeTrib = $('select[name="regimeTrib"] option');
        //$('select[name="regimeTrib"]').attr('disabled', 'disabled');
        $('select[name="crt"]').on('change', function() {
            var crt = this.value;
            if (crt == '') {
                var novoSelect = '0;'
                $('select[name="regimeTrib"]').html(novoSelect);
                $('select[name="regimeTrib"]').attr('disabled', 'disabled');
            } else {
                var novoSelect = vregimeTrib.filter(function() {
                    return $(this).data('crt') == crt;
                });
                $('select[name="regimeTrib"]').html(novoSelect);
                $('select[name="regimeTrib"]').removeAttr('disabled');
            }

        });
    </script>

    <!-- LOCAL PARA COLOCAR OS JS -FIM -->

</body>

</html>