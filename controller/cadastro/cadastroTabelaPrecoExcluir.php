<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');

$handleTabelaPreco = Sistema::getPost('handleTabelaPreco');

$queryTabelaPreco = $connect->exec("DELETE FROM re_tabelaPreco WHERE HANDLE = '".$handleTabelaPreco."'");

$connect->exec("COMMIT;");

if($queryTabelaPreco > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro excluído com sucesso!');
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>$handleTabelaPreco, 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos excluir o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>