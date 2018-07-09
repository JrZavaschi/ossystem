<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$handleFormaPagamento = Sistema::getGet('h');


$nome = Sistema::getPost('formapagamento');
$ativo = Sistema::getPost('ativo');
$observacao = Sistema::getPost('observacao');

if($ativo == true){
	$status = 'S';
}
else{
	$status = 'N';
}

$queryFormaPagamento = $connect->exec("UPDATE `re_formapagamento` 
									   SET `FORMAPAGAMENTO`= '".$nome."',
									   `DATAHORA`= '".$datetime."',
									   `ATIVO`= '".$status."',
									   OBSERVACAO = '".$observacao."'
									   WHERE `HANDLE` =  '".$handleFormaPagamento."'
								      ") or die('erro ao atualizar');

$connect->exec("COMMIT;");

if($queryFormaPagamento > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro atualizado com sucesso!', 'handleFormaPagamento'=>$handleFormaPagamento);
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos atualizar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>