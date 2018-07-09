<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$cliente = Sistema::getPost('cliente');
$veiculo = Sistema::getPost('veiculo');
$tecnico = Sistema::getPost('tecnico');
$status = Sistema::getPost('status');
$dataInicial = date('Y-m-d', strtotime(Sistema::getPost('dataInicial')));
$dataFinal = date('Y-m-d', strtotime(Sistema::getPost('dataFinal')));
$garantia = Sistema::getPost('garantia');
$descricao = Sistema::getPost('descricao');
$defeito = Sistema::getPost('defeito');
$obs = Sistema::getPost('obs');
$formaPagamento = Sistema::getPost('formaPagamento');
$kmVeiculo = Sistema::getPost('kmVeiculo');

$laudoTecnico = Sistema::getPost('laudoTecnico');
$protocolo = date('Y').$cliente.'-'.date('d H');


$queryOS = $connect->exec("INSERT INTO `of_os`
						   (`PROTOCOLO`, `CLIENTE`, `TECNICO`, `STATUS`, `DATAINICIAL`, `DATAFINAL`, `GARANTIA`, `DESCRICAO`, `DEFEITO`, `OBERVACOES`, `LAUDOTECNICO`, `DATAHORA`, `VEICULO`, `KMVEICULO`, `FORMAPAGAMENTO`)
						   VALUES 
						   ('".$protocolo."', '".$cliente."', '".$tecnico."', '".$status."', '".$dataInicial."', '".$dataFinal."', '".$garantia."', '".$descricao."', '".$defeito."', '".$obs."', '".$laudoTecnico."', '".$datetime."', '".$veiculo."', '".$kmVeiculo."', '".$formaPagamento."' )
						  ") or die('erro');

$handleOS = $connect->lastInsertId();
$connect->exec("COMMIT;");


if(isset($_FILES["foto"]) and $_FILES["foto"]["size"] > 0){
	$destino = "../../view/tecnologia/uploads/oficina/os/";

	$foto = $_FILES["foto"]["name"];
	$foto = explode('.', $foto);
	$foto = md5($foto[0]).'.'.$foto[1];

	$queryOSFoto = $connect->exec("UPDATE `of_os` SET `FOTO`= '".$foto."' WHERE `HANDLE` = '".$handleOS."'");
	$connect->exec("COMMIT;");
	move_uploaded_file( $_FILES["foto"]["tmp_name"], ($destino.$foto) );
}//isset imagem


if($queryOS > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro efetuado com sucesso!', 'handleOS'=>$handleOS);
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos efetuar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>