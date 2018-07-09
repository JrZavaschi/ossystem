<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$cliente = Sistema::getPost('cliente');
$placa = Sistema::getPost('placa');
$marca = Sistema::getPost('marca');
$modelo = Sistema::getPost('modelo');
$ano = Sistema::getPost('ano');
$anomodelo = Sistema::getPost('anomodelo');
$garantia = Sistema::getPost('garantia');
$descricao = Sistema::getPost('descricao');
$obs = Sistema::getPost('obs');

$queryOC = $connect->exec("INSERT INTO `of_orcamento`
						   (`CLIENTE`, `PLACA`, `MARCA`, `MODELO`, `ANO`, `ANOMODELO`, `GARANTIA`, `DESCRICAO`, `OBSERVACAO`, `DATAHORA`)
						   VALUES 
						   ('".$cliente."', '".$placa."', '".$marca."', '".$modelo."', '".$ano."', '".$anomodelo."', '".$garantia."', '".$descricao."', '".$obs."', '".$datetime."' )
						  ") or die('erro');

$handleOC = $connect->lastInsertId();
$connect->exec("COMMIT;");


if(isset($_FILES["foto"]) and $_FILES["foto"]["size"] > 0){
	$destino = "../../view/tecnologia/uploads/oficina/orcamento/";

	$foto = $_FILES["foto"]["name"];
	$foto = explode('.', $foto);
	$foto = md5($foto[0]).'.'.$foto[1];

	$queryOCFoto = $connect->exec("UPDATE `of_orcamento` SET `FOTO`= '".$foto."' WHERE `HANDLE` = '".$handleOC."'");
	$connect->exec("COMMIT;");
	move_uploaded_file( $_FILES["foto"]["tmp_name"], ($destino.$foto) );
}//isset imagem


if($queryOC > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro efetuado com sucesso! <br> Deseja imprimir seu Orçamento?', 'handleOC'=>$handleOC);
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos efetuar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>