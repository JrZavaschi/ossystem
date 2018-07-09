<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$handlePessoa = Sistema::getGet('h');
$handlePessoaEndereco = Sistema::getPost('handlePessoaEndereco');
$nome = Sistema::getPost('nome');
$sobrenome = Sistema::getPost('sobrenome');
$cpf = Sistema::getPost('cpf');
$iergJ = Sistema::getPost('iergJ');
$iergF = Sistema::getPost('iergF');
$razaosocial = Sistema::getPost('razaosocial');
$nomefantasia = Sistema::getPost('nomefantasia');
$cnpj = Sistema::getPost('cnpj');
$datanasc = date('Y-m-d', strtotime(Sistema::getPost('datanasc')));
$telefone = Sistema::getPost('telefone');
$celular = Sistema::getPost('celular');
$email = Sistema::getPost('email');
$uf = Sistema::getPost('uf');
$cidade = Sistema::getPost('cidade');
$bairro = Sistema::getPost('bairro');
$logradouro = Sistema::getPost('logradouro');
$complemento = Sistema::getPost('complemento');
$numero = Sistema::getPost('numero');
$cep = Sistema::getPost('cep');
$pontoreferencia = Sistema::getPost('pontoreferencia');
$obs = Sistema::getPost('obs');
$foto = Sistema::getPost('foto');
$tipopessoa = Sistema::getPost('tipopessoa');
$ehCliente = Sistema::getPost('ehCliente');
$ehFornecedor = Sistema::getPost('ehFornecedor');
$ehTecnico = Sistema::getPost('ehTecnico');
$comissaoEntrega = Sistema::getPost('comissaoTecnico');
$ativo = Sistema::getPost('ativo');	


if($tipopessoa == 'Física'){
	$cpfcnpj = $cpf;
	$ierg = $iergF;
}
else if($tipopessoa == 'Jurídica'){
	$cpfcnpj = $cnpj;
	$ierg = $iergJ;
}


if($ativo == true){
	$status = 'S';
}
else{
	$status = 'N';
}

if($ehCliente == true){
	$ehClienteValue = 'S';
}
else{
	$ehClienteValue = 'N';
}

if($ehFornecedor == true){
	$ehFornecedorValue = 'S';
}
else{
	$ehFornecedorValue = 'N';
}

if($ehTecnico == true){
	$ehTecnicoValue = 'S';
}
else{
	$ehTecnicoValue = 'N';
}
try{
$queryPessoa = $connect->exec("UPDATE `ms_pessoa` 
								SET `NOME`= '".$nome."', 
								`SOBRENOME`= '".$sobrenome."', 
								`EMAIL`= '".$email."', 
								`TELEFONE`= '".$telefone."', 
								`CELULAR`= '".$celular."',
								`DATAHORA`= '".$datetime."', 
								`CPFCNPJ`= '".$cpfcnpj."', 
								`IERG` = '".$ierg."',
								`TIPOPESSOA`= '".$tipopessoa."', 
								`RAZAOSOCIAL`= '".$razaosocial."', 
								`NOMEFANTASIA`= '".$nomefantasia."', 
								`DATANASC`= '".$datanasc."', 
								`EHCLIENTE` = '".$ehClienteValue."',
								`EHFORNECEDOR` = '".$ehFornecedorValue."',
								`EHTECNICO` = '".$ehTecnicoValue."',
								`OBS`= '".$obs."', 
								`ATIVO`= '".$status."' 
								WHERE `HANDLE`= '".$handlePessoa."'
							   ");
	
$connect->exec("COMMIT;");

if($handlePessoaEndereco > '0'){
	$queryPessoaEndereco = $connect->exec("UPDATE `ms_pessoaendereco` 
											SET `LOGRADOURO`= '".$logradouro."',
											`NUMERO`= '".$numero."',
											`BAIRRO`= '".$bairro."',
											`CIDADE`= '".$cidade."',
											`CEP`= '".$cep."',
											`COMPLEMENTO`= '".$complemento."',
											`PONTOREFERENCIA`= '".$pontoreferencia."',
											`DATAHORA`= '".$datetime."'
											WHERE `PESSOA` =  '".$handlePessoa."'
											AND `HANDLE` =  '".$handlePessoaEndereco."'
											");
	$connect->exec("COMMIT;");
}


if(isset($_FILES["foto"]) and $_FILES["foto"]["size"] > 0){
	$destino = "../../view/tecnologia/uploads/oficina/pessoa/";

	$foto = $_FILES["foto"]["name"];
	$foto = explode('.', $foto);
	$foto = md5($foto[0]).'.'.$foto[1];

	$queryPessoaFoto = $connect->exec("UPDATE `ms_pessoa` SET `FOTO`= '".$foto."' WHERE `HANDLE` = '".$handlePessoa."'");
	$connect->exec("COMMIT;");
	move_uploaded_file( $_FILES["foto"]["tmp_name"], ($destino.$foto) );
}//isset imagem


	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro atualizado com sucesso!', 'handlePessoa'=>$handlePessoa);
	echo json_encode($retorno);

	
}
catch(PDOException $Exception){
	$retorno = array('sucesso'=>'N','retorno'=>$Exception);
	echo json_encode($retorno);
}
?>