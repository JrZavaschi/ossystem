<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$handleTabelaPrecoEntrega = Sistema::getGet('h');

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

$queryTabelaPrecoEntrega = $connect->exec("UPDATE `re_pedidoentregavalor` 
										   SET `RESTAURANTE`= '".$restauranteUsuario."',
										   `CIDADE`= '".$cidade."',
										   `BAIRRO`= '".$bairro."',
										   `DATAHORA`= '".$datetime."',
										   `VALOR`= '".$valor."',
										   `ATIVO`= '".$status."',
										   `OBSERVACAO`= '".$obs."'
										   WHERE `HANDLE` = '".$handleTabelaPrecoEntrega."'
								   		  ") or die('erro');

$connect->exec("COMMIT;");

if($queryTabelaPrecoEntrega > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro atualizado com sucesso!', 'handleTabelaPrecoEntrega'=>$handleTabelaPrecoEntrega);
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos atualizar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>