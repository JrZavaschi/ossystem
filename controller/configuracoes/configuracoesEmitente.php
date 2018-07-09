<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$nomeFantasia = Sistema::getPost('nomeFantasia');
$razaoSocial = Sistema::getPost('razaoSocial');
$cnpj = Sistema::getPost('cnpj');
$ie = Sistema::getPost('ie');
$logradouro = Sistema::getPost('logradouro');
$numero = Sistema::getPost('numero');
$bairro = Sistema::getPost('bairro');
$cidade = Sistema::getPost('cidade');
$uf = Sistema::getPost('uf');
$cep = Sistema::getPost('cep');
$telefone = Sistema::getPost('telefone');
$email = Sistema::getPost('email');

$query = $connect->exec("UPDATE `ms_oficina`
						 SET RAZAOSOCIAL = '".$razaoSocial."',
						 NOMEFANTASIA  = '".$nomeFantasia."',
						 CNPJ  = '".$cnpj."',
						 IE  = '".$ie."',
						 EHATIVO  = 'S',
						 LOGRADOURO  = '".$logradouro."',
						 NUMERO  = '".$numero."',
						 BAIRRO  = '".$bairro."',
						 CIDADE  = '".$cidade."',
						 UF  = '".$uf."',
						 DATAHORA  = '".$datetime."',
						 CEP  = '".$cep."',
						 TELEFONE  = '".$telefone."',
						 EMAIL = '".$email."'
   					    ") or die('erro');

$handle = $connect->lastInsertId();
$connect->exec("COMMIT;");

if(isset($_FILES["logo"]) and $_FILES["logo"]["size"] > 0){
	$destino = "../../view/tecnologia/uploads/oficina/emitente/";

	$logo = $_FILES["logo"]["name"];
	$logo = explode('.', $logo);
	$logo = md5($logo[0]).'.'.$logo[1];

	$queryOSlogo = $connect->exec("UPDATE `ms_oficina` SET `LOGO`= '".$logo."'");
	$connect->exec("COMMIT;");
	move_uploaded_file( $_FILES["logo"]["tmp_name"], ($destino.$logo) );
}//isset imagem


if($query > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro atualizado com sucesso!');
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos atualizar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>