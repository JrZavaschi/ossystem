<?php
if(!isset($_SESSION['logou']) || !isset($_SESSION['handleUsuario'])){
	header('Location: view/estrutura/login.php');
	exit;
}
else{
	$handleUsuario = $_SESSION['handleUsuario'];
	$queryUsuario = $connect->prepare("SELECT A.NOME, 
									   A.EMAIL, 
									   A.FOTO, 
									   A.LOGIN, 
									   A.EHADMIN,
									   A.CPF
									   FROM `ms_usuario` A
									   WHERE A.HANDLE = '".$handleUsuario."'
									   ");
    $queryUsuario->execute();
    
    $rowUsuario = $queryUsuario->fetch(PDO::FETCH_ASSOC);
	
    $nomeUsuario = $rowUsuario['NOME'];
	$emailUsuario = $rowUsuario['EMAIL'];
	$fotoUsuario = $rowUsuario['FOTO'];
	$loginUsuario = $rowUsuario['LOGIN'];
	$ehadminUsuario = $rowUsuario['EHADMIN'];
	$cpfUsuario = $rowUsuario['CPF'];
	
	if($fotoUsuario == null){
		$fotoUsuario = 'user.png';
	}
	
}
?>