<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$nome = Sistema::getPost('nome');
$ativo = Sistema::getPost('ativo');
$ehTarifado = Sistema::getPost('tarifado');
$obs = Sistema::getPost('obs');

if($ativo == true){
	$status = 'S';
}
else{
	$status = 'N';
}

if($ehTarifado == true){
	$tarifado = 'S';
}
else{
	$tarifado = 'N';
}

$queryTipoEntrega = $connect->exec("INSERT INTO `re_pedidotipoentrega`
									   (`NOME`, `DATAHORA`, `OBSERVACAO`, `RESTAURANTE`, `ATIVO`, `EHTARIFADO`) 
									   VALUES
									   ('".$nome."', '".$datetime."', '".$obs."', '".$restauranteUsuario."', '".$status."', '".$tarifado."')
								      ") or die('erro');

$handleTipoEntrega = $connect->lastInsertId();
$connect->exec("COMMIT;");

if($queryTipoEntrega > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro efetuado com sucesso!', 'handleTipoEntrega'=>$handleTipoEntrega);
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos efetuar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>