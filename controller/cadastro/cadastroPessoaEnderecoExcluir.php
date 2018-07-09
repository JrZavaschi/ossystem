<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$handlePessoaEndereco = Sistema::getPost('handlePessoaEndereco');


$queryPessoaEndereco = $connect->exec("DELETE FROM `ms_pessoaendereco` WHERE HANDLE = '".$handlePessoaEndereco."' ");
$connect->exec("COMMIT;");


if($queryPessoaEndereco > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro excluído com sucesso!');
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N','retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos excluir, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>