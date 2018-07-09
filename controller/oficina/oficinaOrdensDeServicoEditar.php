<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$handleOS = Sistema::getGet('h');
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
$laudoTecnico = Sistema::getPost('laudoTecnico');
$formaPagamento = Sistema::getPost('formaPagamento');
$kmVeiculo = Sistema::getPost('kmVeiculo');

$queryOS = $connect->exec("UPDATE `of_os`
						   SET CLIENTE = '".$cliente."',
						   TECNICO = '".$tecnico."',
						   STATUS = '".$status."',
						   DATAINICIAL = '".$dataInicial."',
						   DATAFINAL = '".$dataFinal."',
						   GARANTIA = '".$garantia."',
						   DESCRICAO = '".$descricao."',
						   DEFEITO = '".$defeito."',
						   OBERVACOES = '".$obs."',
						   LAUDOTECNICO = '".$laudoTecnico."',
						   DATAHORA = '".$datetime."',
						   VEICULO= '".$veiculo."',
						   KMVEICULO = '".$kmVeiculo."',
						   FORMAPAGAMENTO = '".$formaPagamento."'
						   WHERE HANDLE = '".$handleOS."'
						  ") or die('erro');

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
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro atualizado com sucesso!', 'handleOS'=>$handleOS);
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N', 'retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos atualizar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}
?>