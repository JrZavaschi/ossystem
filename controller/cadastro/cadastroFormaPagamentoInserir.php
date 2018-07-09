<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$nome = Sistema::getPost('formapagamento');
$ativo = Sistema::getPost('ativo');
$obs = Sistema::getPost('obs');
if($ativo == true){
	$status = 'S';
}
else{
	$status = 'N';
}

$queryFormaPagamento = $connect->exec("INSERT INTO `re_formaPagamento`
									   (`FORMAPAGAMENTO`, `DATAHORA`, `OBSERVACAO`, `RESTAURANTE`, `ATIVO`) 
									   VALUES
									   ('".$nome."', '".$datetime."', '".$obs."', '".$restauranteUsuario."', '".$status."')
								      ") or die('erro');

$handleFormaPagamento = $connect->lastInsertId();
$connect->exec("COMMIT;");

if($queryFormaPagamento > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro efetuado com sucesso!', 'handleFormaPagamento'=>$handleFormaPagamento);
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos efetuar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>