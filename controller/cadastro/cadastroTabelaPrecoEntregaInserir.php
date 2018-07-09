<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$ativo = Sistema::getPost('ativo');
$bairro = Sistema::getPost('bairro');
$valor = number_format(Sistema::getPost('valor'), '2', '.', ',');
$obs = Sistema::getPost('obs');
$cidade = Sistema::getPost('cidade');
$uf = Sistema::getPost('uf');

if($ativo == true){
	$status = 'S';
}
else{
	$status = 'N';
}

$queryTabelaPrecoEntrega = $connect->exec("INSERT INTO `re_pedidoentregavalor`
										   (`RESTAURANTE`, `CIDADE`, `BAIRRO`, `DATAHORA`, `VALOR`, `ATIVO`, `OBSERVACAO`) 
										   VALUES 
										   ('".$restauranteUsuario."', '".$cidade."', '".$bairro."', '".$datetime."', '".$valor."', '".$status."', '".$obs."')
										  ") or die('erro');

$handleTabelaPrecoEntrega = $connect->lastInsertId();
$connect->exec("COMMIT;");

if($queryTabelaPrecoEntrega > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro efetuado com sucesso!', 'handleTabelaPrecoEntrega'=>$handleTabelaPrecoEntrega);
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos efetuar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>