<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$cpfValor = Sistema::getPost('cpfValor');

$queryBuscaPessoa = $connect->prepare("SELECT HANDLE FROM `ms_pessoa` WHERE CPFCNPJ = '".$cpfValor."'");
$queryBuscaPessoa->execute();
$rowBuscaPessoa = $queryBuscaPessoa->FETCH(PDO::FETCH_ASSOC);
$handleBuscaPessoa = $rowBuscaPessoa['HANDLE'];

if($queryBuscaPessoa->rowCount() > 0){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Pessoa já cadastrado, deseja editar o cadastro?', 'handleBuscaPessoa'=>$handleBuscaPessoa);
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N','retorno'=>'<strong>Ooops!</strong><br> Erro ao localizar CPF cadastrado, tente novamente.');
	echo json_encode($retorno);
}
?>