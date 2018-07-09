<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$handleTabelaPreco = Sistema::getGet('h');

$nome = Sistema::getPost('nome');
$ativo = Sistema::getPost('ativo');
$categoria = Sistema::getPost('categoria');
$observacao = Sistema::getPost('observacao');
$quantidadecardapio = Sistema::getPost('quantidadecardapio');
$promocao = Sistema::getPost('promocao');
$pontos = Sistema::getPost('pontos');
$valor = number_format(Sistema::getPost('valor'), '2', '.', ',');

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

$queryTabelaPreco = $connect->exec("UPDATE `re_tabelapreco` 
									SET `NOME`= '".$nome."',
									`VALOR`= '".$valor."',
									`DATAHORA`= '".$datetime."',
									`CATEGORIA`= '".$categoria."',
									`ATIVO`= '".$status."',
									OBSERVACAO = '".$observacao."',
									EHPROMOCAO = '".$ehPromocao."',
									PONTOS = '".$pontos."',
									QUANTIDADECARDAPIO = '".$quantidadecardapio."'
									WHERE `HANDLE` =  '".$handleTabelaPreco."'
								   ") or die('erro');

$connect->exec("COMMIT;");

if($queryTabelaPreco > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro atualizado com sucesso!', 'handleTabelaPreco'=>$handleTabelaPreco);
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos atualizar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>