<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$handleOS = Sistema::getGet('h');
$produto = Sistema::getPost('nomeProduto');
$quantidade = Sistema::getPost('quantidadeProduto');
$valor = Sistema::getPost('valorProduto');
$valorTotal =  $quantidade *  $valor;

$queryOS = $connect->exec("INSERT INTO `of_os_produtos`
						   (`OS`, `PRODUTO`, `VALOR`, `VALORTOTAL`, `DATAHORA`, `QUANTIDADE`) 
						   VALUES 
						   ('".$handleOS."', '".$produto."', '".$valor."', '".$valorTotal."', '".$datetime."', '".$quantidade."')
						  ") or die('erro');
$handleProduto = $connect->lastInsertId();
$connect->exec("COMMIT;");

if($queryOS > ''){
	$retorno = array('sucesso'=>'S', 'produto'=>$produto, 'quantidade'=>$quantidade,'valor'=>$valor,'valorTotal'=>$valorTotal, 'retorno'=>'Cadastro efetuado com sucesso!', 'handleOS'=>$handleOS, 'handleProduto'=>$handleProduto);
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos efetuar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>