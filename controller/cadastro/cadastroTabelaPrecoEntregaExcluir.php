<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');

$handleTabelaPrecoEntrega = Sistema::getPost('handleTabelaPrecoEntrega');

$queryTabelaPrecoEntrega = $connect->exec("DELETE FROM re_pedidoentregavalor WHERE HANDLE = '".$handleTabelaPrecoEntrega."'");

$connect->exec("COMMIT;");

if($queryTabelaPrecoEntrega > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro excluído com sucesso!');
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>$handleTabelaPrecoEntrega, 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos excluir o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>