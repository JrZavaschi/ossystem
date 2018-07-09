<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');

$handleFormaPagamento = Sistema::getPost('handleFormaPagamento');

$queryFormaPagamento = $connect->exec("DELETE FROM re_formapagamento WHERE HANDLE = '".$handleFormaPagamento."'");

$connect->exec("COMMIT;");

if($queryFormaPagamento > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro excluído com sucesso!');
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>$handleFormaPagamento, 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos excluir o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>