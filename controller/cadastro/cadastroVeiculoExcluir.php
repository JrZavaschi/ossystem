<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$handleVeiculo = Sistema::getPost('handleVeiculo');

$queryhandleVeiculo = $connect->exec("DELETE FROM `ms_veiculos` WHERE HANDLE = '".$handleVeiculo."'") or die('erro');

$connect->exec("COMMIT;");

if($queryhandleVeiculo > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro excluido com sucesso!');
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos excluir o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>