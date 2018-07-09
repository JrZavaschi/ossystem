<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$nome = Sistema::getPost('nome');
$ativo = Sistema::getPost('ativo');
$categoria = Sistema::getPost('categoria');
$valor = number_format(Sistema::getPost('valor'), '2', '.', ',');
$obs = Sistema::getPost('obs');
$quantidadecardapio = Sistema::getPost('quantidadecardapio');
$promocao = Sistema::getPost('promocao');
$pontos = Sistema::getPost('pontos');

if($ativo == true){
	$status = 'S';
}
else{
	$status = 'N';
}
if($promocao == true){
	$ehPromocao = 'S';
}
else{
	$ehPromocao = 'N';
}
$queryTabelaPreco = $connect->exec("INSERT INTO `re_tabelapreco`
									(`NOME`, `VALOR`, `DATAHORA`, `OBSERVACAO`, `RESTAURANTE`, `CATEGORIA`, `ATIVO`, `QUANTIDADECARDAPIO`, `EHPROMOCAO`, `PONTOS`) 
									VALUES
									('".$nome."', '".$valor."', '".$datetime."', '".$obs."', '".$restauranteUsuario."', '".$categoria."', '".$status."', '".$quantidadecardapio."', '".$ehPromocao."', '".$pontos."')
								   ") or die('erro');

$handleTabelaPreco = $connect->lastInsertId();
$connect->exec("COMMIT;");

if($queryTabelaPreco > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro efetuado com sucesso!', 'handleTabelaPreco'=>$handleTabelaPreco);
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos efetuar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>