<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$handleCliente = Sistema::getGet('h');
$uf = Sistema::getPost('uf');
$cidade = Sistema::getPost('cidade');
$bairro = Sistema::getPost('bairro');
$logradouro = Sistema::getPost('logradouro');
$complemento = Sistema::getPost('$complemento');
$numero = Sistema::getPost('numero');
$cep = Sistema::getPost('cep');
$pontoreferencia = Sistema::getPost('pontoreferencia');


$queryClienteEndereco = $connect->exec("INSERT INTO `ms_pessoaendereco`
									   (`pessoa`, `LOGRADOURO`, `NUMERO`, `BAIRRO`, `CIDADE`, `CEP`, `COMPLEMENTO`, `PONTOREFERENCIA`, `DATAHORA`) VALUES
									   ('".$handleCliente."', '".$logradouro."', '".$numero."', '".$bairro."', '".$cidade."', '".$cep."', '".$complemento."', '".$pontoreferencia."', '".$datetime."')
									   ");
$connect->exec("COMMIT;");



if($queryClienteEndereco > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro efetuado com sucesso!');
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N','retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos cadastrar, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>