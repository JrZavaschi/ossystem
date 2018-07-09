<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

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
$senha = geraSenha(6, false, true);
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
$queryPessoa = $connect->exec("INSERT INTO `ms_pessoa`
							   (`NOME`, `SOBRENOME`, `EMAIL`, `TELEFONE`, `CELULAR`, `SENHA`, `DATAHORA`, `CPFCNPJ`, `TIPOPESSOA`, `RAZAOSOCIAL`, `NOMEFANTASIA`, `DATANASC`, `OBS`, `ATIVO`, `EHCLIENTE`, `EHFORNECEDOR`, `EHTECNICO`, `COMISSAOENTREGA`, `IERG`) 
							   VALUES 
							   ('".$nome."', '".$sobrenome."', '".$email."', '".$telefone."', '".$celular."', '".$senha."', '".$datetime."', '".$cpfcnpj."', '".$tipopessoa."', '".$razaosocial."', '".$nomefantasia."', '".$datanasc."', '".$obs."', '".$status."', '".$ehClienteValue."', '".$ehFornecedorValue."', '".$ehTecnicoValue."', '".$comissaoEntrega."', '".$ierg."')
							   ") or die('erro');


$handlePessoa = $connect->lastInsertId();
$connect->exec("COMMIT;");

$queryPessoaEndereco = $connect->exec("INSERT INTO `ms_pessoaendereco`
									   (`PESSOA`, `LOGRADOURO`, `NUMERO`, `BAIRRO`, `CIDADE`, `CEP`, `COMPLEMENTO`, `PONTOREFERENCIA`, `DATAHORA`) VALUES
									   ('".$handlePessoa."', '".$logradouro."', '".$numero."', '".$bairro."', '".$cidade."', '".$cep."', '".$complemento."', '".$pontoreferencia."', '".$datetime."')
									   ");
$connect->exec("COMMIT;");

if(isset($_FILES["foto"]) and $_FILES["foto"]["size"] > 0){
	$destino = "../../view/tecnologia/uploads/oficina/pessoa/";

	$foto = $_FILES["foto"]["name"];
	$foto = explode('.', $foto);
	$foto = md5($foto[0]).'.'.$foto[1];

	$queryPessoaFoto = $connect->exec("UPDATE `ms_pessoa` SET `FOTO`= '".$foto."' WHERE `HANDLE` = '".$handlePessoa."'");
	$connect->exec("COMMIT;");
	move_uploaded_file( $_FILES["foto"]["tmp_name"], ($destino.$foto) );
}//isset imagem

if($queryPessoa > '' and $queryPessoaEndereco > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro efetuado com sucesso!', 'handlePessoa'=>$handlePessoa);
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N','retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos efetuar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}

}
catch(PDOException $Exception){
	$retorno = array('sucesso'=>'N','retorno'=>$Exception);
	echo json_encode($retorno);
}
?>