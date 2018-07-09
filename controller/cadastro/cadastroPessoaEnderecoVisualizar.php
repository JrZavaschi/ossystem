<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$handlePessoaEndereco = Sistema::getPost('handlePessoaEndereco');


$queryPessoaEndereco = $connect->prepare("SELECT A.HANDLE, A.LOGRADOURO, A.NUMERO, A.CEP, A.COMPLEMENTO, A.PONTOREFERENCIA, B.CIDADE, C.SIGLA UF, D.NOME BAIRRO
										   FROM `ms_pessoaendereco` A 
										   LEFT JOIN ms_cidade B ON B.HANDLE = A.CIDADE
										   LEFT JOIN ms_uf C ON C.HANDLE = B.UF
										   LEFT JOIN ms_bairro D ON D.HANDLE = A.BAIRRO
										   WHERE A.`HANDLE` = '".$handlePessoaEndereco."'
										   ");
$queryPessoaEndereco->execute();

$rowPessoaEndereco = $queryPessoaEndereco->fetch(PDO::FETCH_ASSOC);

	$dados = array('logradouro'=>$rowPessoaEndereco['LOGRADOURO'], 'numero'=>$rowPessoaEndereco['NUMERO'], 'cep'=>$rowPessoaEndereco['CEP'], 'complemento'=>$rowPessoaEndereco['COMPLEMENTO'], 'pontoreferencia'=>$rowPessoaEndereco['PONTOREFERENCIA'], 'cidade'=>$rowPessoaEndereco['CIDADE'], 'uf'=>$rowPessoaEndereco['UF'], 'bairro'=>$rowPessoaEndereco['BAIRRO']);

echo json_encode($dados, JSON_UNESCAPED_UNICODE);
?>