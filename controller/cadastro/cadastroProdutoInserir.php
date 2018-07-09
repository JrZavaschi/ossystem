<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$nome = Sistema::getPost('nome');
$ativo = Sistema::getPost('ativo');
$codigoReferencia = Sistema::getPost('codigoReferencia');
$valorCusto = Sistema::getPost('valorCusto');
$valorVenda = Sistema::getPost('valorVenda');
$margemLucro = Sistema::getPost('margemLucro');
$observacao = Sistema::getPost('obs');
$quantidade = Sistema::getPost('quantidade');
$unidadeMedida = Sistema::getPost('unidadeMedida');
$ehKit = 'N';

if($ativo == true){
	$status = 'S';
}
else{
	$status = 'N';
}

$queryProduto = $connect->exec("INSERT INTO `re_produto`
								(`RESTAURANTE`, `NOME`, `VALORCUSTO`, `VALORVENDA`, `MARGEMLUCRO`, `QUANTIDADE`, `UNIDADEMEDIDA`, `CODIGOREFERENCIA`, `EHKIT`, `DATAHORA`, `ATIVO`, `OBS`) 
								VALUES 
								('".$restauranteUsuario."', '".$nome."', '".$valorCusto."', '".$valorVenda."', '".$margemLucro."', '".$quantidade."', '".$unidadeMedida."', '".$codigoReferencia."', '".$ehKit."', '".$datetime."', '".$status."', '".$observacao."')
							   ") or die('erro');


$handleProduto = $connect->lastInsertId();
$connect->exec("COMMIT;");


if(isset($_FILES["foto"]) and $_FILES["foto"]["size"] > 0){
	$destino = "../../view/tecnologia/uploads/restaurante/produto/";

	$foto = $_FILES["foto"]["name"];
	$foto = explode('.', $foto);
	$foto = md5($foto[0]).'.'.$foto[1];

	$queryProdutoFoto = $connect->exec("UPDATE `re_produto` SET `FOTO`= '".$foto."' WHERE `HANDLE` = '".$handleProduto."'");
	$connect->exec("COMMIT;");
	move_uploaded_file( $_FILES["foto"]["tmp_name"], ($destino.$foto) );
}//isset imagem

if($queryProduto > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro efetuado com sucesso!', 'handleProduto'=>$handleProduto);
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos efetuar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>