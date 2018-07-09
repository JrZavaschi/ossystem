<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$handleProduto = Sistema::getGet('h');
$nome = Sistema::getPost('nome');
$codigoReferencia = Sistema::getPost('codigoReferencia');
$valorCusto = Sistema::getPost('valorCusto');
$valorVenda = Sistema::getPost('valorVenda');
$margemLucro = Sistema::getPost('margemLucro');
$observacao = Sistema::getPost('obs');
$quantidade = Sistema::getPost('quantidade');
$unidadeMedida = Sistema::getPost('unidadeMedida');
$ehKit = 'N';

if(isset($_POST['ativo'])){
	$statusProduto = 'S';
}
else{
	$statusProduto = 'N';
}



$queryProduto = $connect->exec("UPDATE `re_produto` 
								SET `NOME`= '".$nome."',
								`VALORCUSTO`='".$valorCusto."',
								`VALORVENDA`='".$valorVenda."',
								`MARGEMLUCRO`='".$margemLucro."',
								`QUANTIDADE`='".$quantidade."',
								`UNIDADEMEDIDA`='".$unidadeMedida."',
								`CODIGOREFERENCIA`='".$codigoReferencia."',
								`EHKIT`='".$ehKit."',
								`DATAHORA`='".$datetime."',
								`ATIVO`='".$statusProduto."',
								`OBS`='".$observacao."'
								WHERE HANDLE = '".$handleProduto."'
							   ") or die('erro');


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
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro atualizado com sucesso!', 'handleProduto'=>$handleProduto);
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos atualizar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>