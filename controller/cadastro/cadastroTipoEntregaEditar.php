<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$handleTipoEntrega = Sistema::getGet('h');


$nome = Sistema::getPost('nome');
$ativo = Sistema::getPost('ativo');
$tarifado = Sistema::getPost('ativo');
$observacao = Sistema::getPost('observacao');

if($ativo == true){
	$status = 'S';
}
else{
	$status = 'N';
}


if($tarifado == true){
	$ehTarifado = 'S';
}
else{
	$ehTarifado = 'N';
}

$queryTipoEntrega = $connect->exec("UPDATE `re_pedidotipoentrega` 
									   SET `NOME`= '".$nome."',
									   `DATAHORA`= '".$datetime."',
									   `ATIVO`= '".$status."',
									   `EHTARIFADO`= '".$ehTarifado."',
									   OBSERVACAO = '".$observacao."'
									   WHERE `HANDLE` =  '".$handleTipoEntrega."'
								      ") or die('erro ao atualizar');

$connect->exec("COMMIT;");

if($queryTipoEntrega > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro atualizado com sucesso!', 'handleTipoEntrega'=>$handleTipoEntrega);
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos atualizar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>