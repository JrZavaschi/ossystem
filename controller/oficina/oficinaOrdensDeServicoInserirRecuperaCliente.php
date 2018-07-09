<?php
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$dados = $connect->prepare("SELECT HANDLE id, NOME value
								FROM ms_pessoa
								WHERE EHCLIENTE = 'S'
								ORDER BY value ASC
								");
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>