<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	
$handlePessoa = Sistema::getPost('handlePessoa');

$queryPessoa = $connect->exec("DELETE FROM ms_pessoa WHERE HANDLE = '".$handlePessoa."'");

$connect->exec("COMMIT;");

$queryPessoaEndereco = $connect->exec("DELETE FROM ms_pessoaendereco WHERE PESSOA = '".$handlePessoa."'");
$connect->exec("COMMIT;");

if($queryPessoa > '' and $queryPessoaEndereco > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro excluído com sucesso!');
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>$handleCardapio, 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos excluir o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}

?>