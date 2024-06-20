<?php
include_once __DIR__ . "/../conexao.php";



if (isset($_GET['operacao'])) {

	$operacao = $_GET['operacao'];

	if ($operacao == "buscar") {
		
		
		$apiEntrada = array(
			'cnpj' => $_POST["cnpj"]
		);

		$pessoa = chamaAPI(null, '/admin/consulta_cnpj', json_encode($apiEntrada), 'GET');

		echo json_encode($pessoa);
		return $pessoa;
	}
	
}
