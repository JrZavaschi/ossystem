<?php
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	$clienteSelecionado = $_GET['clienteSelecionado'];
	
	$dados = $connect->prepare("SELECT HANDLE id, PLACA value FROM ms_veiculos WHERE CLIENTE = '".$clienteSelecionado."'");
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>