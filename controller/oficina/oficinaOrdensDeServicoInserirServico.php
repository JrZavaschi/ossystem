<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$handleOS = Sistema::getGet('h');
$servico = Sistema::getPost('nomeServico');
$quantidade = Sistema::getPost('quantidadeServico');
$valor = Sistema::getPost('valorServico');
$valorTotal = $quantidade * $valor;

$queryOS = $connect->exec("INSERT INTO `of_os_servicos`
						   (`OS`, `SERVICO`, `VALOR`, `VALORTOTAL`, `DATAHORA`, `QUANTIDADE`) 
						   VALUES 
						   ('".$handleOS."', '".$servico."', '".$valor."', '".$valorTotal."', '".$datetime."', '".$quantidade."')
						  ") or die('erro');
$handleServico = $connect->lastInsertId();
$connect->exec("COMMIT;");

if($queryOS > ''){
	$retorno = array('sucesso'=>'S', 'servico'=>$servico, 'quantidade'=>$quantidade,'valor'=>$valor,'valorTotal'=>$valorTotal, 'retorno'=>'Cadastro efetuado com sucesso!', 'handleOS'=>$handleOS, 'handleServico'=>$handleServico);
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos efetuar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>