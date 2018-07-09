<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');	

$handleVeiculo = $_GET['h'];
$cliente = Sistema::getPost('cliente');
$placa = Sistema::getPost('placa');
$marca = Sistema::getPost('marca');
$modelo = Sistema::getPost('modelo');
$cor = Sistema::getPost('cor');
$quilometragem = Sistema::getPost('quilometragem');
$combustivel = Sistema::getPost('combustivel');
$ano = Sistema::getPost('ano');
$anomodelo = Sistema::getPost('anomodelo');
$numeromotor = Sistema::getPost('numeromotor');
$numerochassi = Sistema::getPost('numerochassi');

try{
$queryVeiculo = $connect->exec("UPDATE `ms_veiculos`
								SET CLIENTE = '".$cliente."',
								PLACA = '".$placa."',
								MARCA = '".$marca."',
								MODELO = '".$modelo."',
								ANO = '".$ano."',
								ANOMODELO = '".$anomodelo."',
								COR = '".$cor."',
								CHASSIS = '".$numerochassi."',
								COMBUSTIVEL = '".$combustivel."',
								NUMEROMOTOR = '".$numeromotor."',
								QUILOMETRAGEM = '".$quilometragem."',
								DATAHORA = '".$datetime."'
								WHERE HANDLE = '".$handleVeiculo."'
							   ") or die('erro');

$handleVeiculo = $connect->lastInsertId();
$connect->exec("COMMIT;");

if(isset($_FILES["foto"]) and $_FILES["foto"]["size"] > 0){
	$destino = "../../view/tecnologia/uploads/oficina/veiculo/";

	$foto = $_FILES["foto"]["name"];
	$foto = explode('.', $foto);
	$foto = md5($foto[0]).'.'.$foto[1];

	$queryVeiculoFoto = $connect->exec("UPDATE `ms_veiculos` SET `FOTO`= '".$foto."' WHERE `HANDLE` = '".$handleVeiculo."'");
	$connect->exec("COMMIT;");
	move_uploaded_file( $_FILES["foto"]["tmp_name"], ($destino.$foto) );
}//isset imagem

if($queryVeiculo > ''){
	$retorno = array('sucesso'=>'S', 'retorno'=>'Cadastro atualizado com sucesso!', 'handleVeiculo'=>$handleVeiculo);
	echo json_encode($retorno);
}
else{
	$retorno = array('sucesso'=>'N','retorno'=>'<strong>Ooops!</strong> <br>Não conseguimos atualizar o cadastro, entre em contato com o administrador.');
	echo json_encode($retorno);
}

}
catch(PDOException $Exception){
	$retorno = array('sucesso'=>'N','retorno'=>$Exception);
	echo json_encode($retorno);
}
?>