<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$handleClienteEndereco = Sistema::getPost('h');


$queryClienteEndereco = $connect->exec("DELETE FROM `re_produto` WHERE HANDLE = '".$handleClienteEndereco."' ");
$connect->exec("COMMIT;");


if($queryClienteEndereco > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro excluído com sucesso!');
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N','retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos excluir, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>