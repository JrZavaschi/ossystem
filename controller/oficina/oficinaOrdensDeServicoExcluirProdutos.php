<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$handleProduto = Sistema::getPost('handleProduto');

$queryOS = $connect->exec("DELETE FROM `of_os_produtos` WHERE HANDLE = '".$handleProduto."'") or die('erro');

$connect->exec("COMMIT;");

if($queryOS > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro excluido com sucesso!');
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos excluir o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>