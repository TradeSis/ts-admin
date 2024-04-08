<?php
include_once __DIR__ . "/../conexao.php";

function buscarGeralProduto($eanProduto = null)
{
	$produtos = array();

	$apiEntrada = array(
		'eanProduto' => $eanProduto
	);

	$produtos = chamaAPI(null, '/admin/geralprodutos', json_encode($apiEntrada), 'GET');
	return $produtos;
}
function buscarGeralPessoas($cpfCnpj = null)
{
	$pessoas = array();

	$apiEntrada = array(
		'cpfCnpj' => $cpfCnpj
	);

	$pessoas = chamaAPI(null, '/admin/geralpessoas', json_encode($apiEntrada), 'GET');
	return $pessoas;
}
function buscarGeralFornecimento($buscaFornecimento = null)
{
	$fornecedor = array();

	$apiEntrada = array(
		'buscaFornecimento' => $buscaFornecimento
	);

	$fornecedor = chamaAPI(null, '/admin/geralfornecimento', json_encode($apiEntrada), 'GET');
	return $fornecedor;
}


if (isset($_GET['operacao'])) {

	$operacao = $_GET['operacao'];

	if ($operacao == "buscarGeralPessoas") {
		
		$cpfCnpj = $_POST["cpfCnpj"];
		$acao = isset($_POST["acao"]) ? $_POST["acao"] : null;

		if ($cpfCnpj == "") {
			$cpfCnpj = null;
		}
		if ($acao == "") {
			$acao = null;
		}

		$apiEntrada = array(
			'cpfCnpj' => $cpfCnpj,
			'acao' => $acao
		);

		$pessoa = chamaAPI(null, '/admin/geralpessoas', json_encode($apiEntrada), 'GET');

		echo json_encode($pessoa);
		return $pessoa;
	}
	if ($operacao=="geralpessoasInserir") {

		$apiEntrada = array(
			'cpfCnpj' => $_POST['cpfCnpj'],
			'tipoPessoa' => $_POST['tipoPessoa'],
			'nomePessoa' => $_POST['nomePessoa'],
			'IE' => $_POST['IE'],
			'municipio' => $_POST['municipio'],
			'codigoCidade' => $_POST['codigoCidade'],
			'codigoEstado' => $_POST['codigoEstado'],
			'pais' => $_POST['pais'],
			'bairro' => $_POST['bairro'],
			'endereco' => $_POST['endereco'],
			'endNumero' => $_POST['endNumero'],
			'cep' => $_POST['cep'],
			'email' => $_POST['email'],
			'telefone' => $_POST['telefone'],
			'crt' => $_POST['crt'],
			'regimeTrib' => $_POST['regimeTrib'],
			'cnae' => $_POST['cnae'],
			'regimeEspecial' => $_POST['regimeEspecial'],
			'caracTrib' => $_POST['caracTrib'],
			'origem' => $_POST['origem'],
			'nomeFantasia' => $_POST['nomeFantasia']
		);
		$pessoas = chamaAPI(null, '/admin/geralpessoas', json_encode($apiEntrada), 'PUT');
		return $pessoas;

	}

	if ($operacao=="geralpessoasAlterar") {

		$apiEntrada = array(
			'cpfCnpj' => $_POST['cpfCnpj'],
			'tipoPessoa' => $_POST['tipoPessoa'],
			'nomePessoa' => $_POST['nomePessoa'],
			'IE' => $_POST['IE'],
			'municipio' => $_POST['municipio'],
			'codigoCidade' => $_POST['codigoCidade'],
			'codigoEstado' => $_POST['codigoEstado'],
			'pais' => $_POST['pais'],
			'bairro' => $_POST['bairro'],
			'endereco' => $_POST['endereco'],
			'endNumero' => $_POST['endNumero'],
			'cep' => $_POST['cep'],
			'email' => $_POST['email'],
			'telefone' => $_POST['telefone'],
			'crt' => $_POST['crt'],
			'regimeTrib' => $_POST['regimeTrib'],
			'cnae' => $_POST['cnae'],
			'regimeEspecial' => $_POST['regimeEspecial'],
			'caracTrib' => $_POST['caracTrib'],
			'origem' => $_POST['origem'],
			'nomeFantasia' => $_POST['nomeFantasia']
		);
		$pessoas = chamaAPI(null, '/admin/geralpessoas', json_encode($apiEntrada), 'POST');
		return $pessoas;

	}

	if ($operacao == "buscarGeralProduto") {

		$buscaProduto = isset($_POST["buscaProduto"]) && $_POST["buscaProduto"] !== "" ? $_POST["buscaProduto"] : null;
    	$idGeralProduto = isset($_POST["idGeralProduto"]) && $_POST["idGeralProduto"] !== "" ? $_POST["idGeralProduto"] : null;
		$filtroDataAtualizacao = isset($_POST["filtroDataAtualizacao"]) && $_POST["filtroDataAtualizacao"] !== ""  ? $_POST["filtroDataAtualizacao"]  : null;

		$apiEntrada = array(
			'buscaProduto' => $buscaProduto,
			'idGeralProduto' => $idGeralProduto,
			'filtroDataAtualizacao' => $filtroDataAtualizacao
		);

		$produto = chamaAPI(null, '/admin/geralprodutos', json_encode($apiEntrada), 'GET');

		echo json_encode($produto);
		return $produto;
	}
	
	if ($operacao=="geralProdutosInserir") {

		$apiEntrada = array(
			'eanProduto' => $_POST['eanProduto'],
			'nomeProduto' => $_POST['nomeProduto'],
			'idMarca' => $_POST['idMarca'],
			'dataAtualizacaoTributaria' => $_POST['dataAtualizacaoTributaria'],
			'codImendes' => $_POST['codImendes'],
			'idGrupo' => $_POST['idGrupo'],
			'prodZFM' => $_POST['prodZFM']
		);
		$produtos = chamaAPI(null, '/admin/geralprodutos', json_encode($apiEntrada), 'PUT');
		return $produtos;

	}

	if ($operacao=="geralProdutosAlterar") {

		$apiEntrada = array(
			'idGeralProduto' => $_POST['idGeralProduto'],
			'nomeProduto' => $_POST['nomeProduto'],
			'idMarca' => $_POST['idMarca'],
			'dataAtualizacaoTributaria' => $_POST['dataAtualizacaoTributaria'],
			'idGrupo' => $_POST['idGrupo'],
			'prodZFM' => $_POST['prodZFM']
		);
		$produtos = chamaAPI(null, '/admin/geralprodutos', json_encode($apiEntrada), 'POST');
		return $produtos;

	}

	if ($operacao == "buscarGeralFornecimento") {

		$idFornecimento = isset($_POST["idFornecimento"]) ? $_POST["idFornecimento"] : null;
    	$buscaFornecimento = isset($_POST["buscaFornecimento"]) ? $_POST["buscaFornecimento"] : null;
		$filtroDataAtualizacao = isset($_POST["filtroDataAtualizacao"]) && $_POST["filtroDataAtualizacao"] !== ""  ? $_POST["filtroDataAtualizacao"]  : null;

		if ($buscaFornecimento == "") {
			$buscaFornecimento = null;
		}
		if ($idFornecimento == "") {
			$idFornecimento = null;
		}

		$apiEntrada = array(
			'idFornecimento' => $idFornecimento,
			'buscaFornecimento' => $buscaFornecimento,
			'filtroDataAtualizacao' => $filtroDataAtualizacao
		);

		$fornecedor = chamaAPI(null, '/admin/geralfornecimento', json_encode($apiEntrada), 'GET');

		echo json_encode($fornecedor);
		return $fornecedor;
	}

	if ($operacao=="geralFornecedorInserir") {

		$apiEntrada = array(
			'Cnpj' => $_POST['Cnpj'],
			'refProduto' => $_POST['refProduto'],
			'idGeralProduto' => $_POST['idGeralProduto'],
			'valorCompra' => $_POST['valorCompra'],
			'origem' => $_POST['origem'],
			'cfop' => $_POST['cfop']
		);
		$fornecedor = chamaAPI(null, '/admin/geralfornecimento', json_encode($apiEntrada), 'PUT');
		return $fornecedor;

	}

	if ($operacao=="geralFornecedorAlterar") {

		$apiEntrada = array(
			'idFornecimento' => $_POST['idFornecimento'],
			'Cnpj' => $_POST['Cnpj'],
			'refProduto' => $_POST['refProduto'],
			'idGeralProduto' => $_POST['idGeralProduto'],
			'valorCompra' => $_POST['valorCompra'],
			'origem' => $_POST['origem'],
			'cfop' => $_POST['cfop']
		);
		$fornecedor = chamaAPI(null, '/admin/geralfornecimento', json_encode($apiEntrada), 'POST');
		return $fornecedor;

	}

	if ($operacao=="atualizar") {
		$idFornecimento = isset($_POST["idFornecimento"]) && $_POST["idFornecimento"] !== "null"  ? $_POST["idFornecimento"]  : null;

		$apiEntrada = array(
			'idEmpresa' => $_SESSION['idEmpresa'],
			'idFornecimento' => $idFornecimento
		);
		$fornecedor = chamaAPI(null, '/impostos/imendes/saneamento', json_encode($apiEntrada), 'POST');
		return $fornecedor;

	}
	
}
