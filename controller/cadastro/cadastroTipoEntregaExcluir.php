<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	
$handleTipoEntrega = Sistema::getPost('handleTipoEntrega');

$queryTipoEntrega = $connect->exec("DELETE FROM re_pedidotipoentrega WHERE HANDLE = '".$handleTipoEntrega."'");

$connect->exec("COMMIT;");

if($queryTipoEntrega > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro excluído com sucesso!');
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos excluir o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}

?>