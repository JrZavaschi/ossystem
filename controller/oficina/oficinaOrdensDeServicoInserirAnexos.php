<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$handleOS = Sistema::getGet('h');

if(isset($_FILES["anexo"]) and $_FILES["anexo"]["size"] > 0){
	$destino = "../../view/tecnologia/uploads/oficina/os/";

	$anexo = $_FILES["anexo"]["name"];
	$anexo = explode('.', $anexo);
	$anexo = md5($anexo[0]).'.'.$anexo[1];

	$queryOS = $connect->exec("INSERT INTO `of_os_anexos`
								  (`OS`, `ARQUIVO`, `DATAHORA`, `NOMEARQUIVO`)
								  VALUES
								  ('".$handleOS."', '".$anexo."', '".$datetime."', '".$_FILES["anexo"]["name"]."')
								 ");
	$handleAnexo = $connect->lastInsertId();
	$connect->exec("COMMIT;");
	move_uploaded_file( $_FILES["anexo"]["tmp_name"], ($destino.$anexo) );
}//isset imagem


if($queryOS > ''){
	$retorno = array('sucesso'=>'S', 'nomeArquivo'=>$_FILES["anexo"]["name"], 'data'=>$datetime, 'handleAnexo'=>$handleAnexo, 'retorno'=>'Cadastro efetuado com sucesso!');
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos efetuar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>