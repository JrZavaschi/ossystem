<?php
include_once('../tecnologia/Sistema.php');
	$entrar = Sistema::getPost('entrar');
	print_r($_POST);
if (isset($entrar)) {
	    $connect = Sistema::getConexao();	
		$login = Sistema::getPost('login');
    	$senha = md5(Sistema::getPost('senha'));
		
	// Verifica login digitado
    $queryLogin = $connect->prepare("SELECT `HANDLE`, `NOME`, `EMAIL`, `SENHA`, `FOTO`, `LOGIN`, `EHADMIN`, `EHRESTAURANTE`
									 FROM `ms_usuario` 
									 WHERE `EMAIL` = '".$login."'
									 OR `LOGIN` = '".$login."'
									 AND `SENHA` = '".$senha."'
									 ");
    $queryLogin->execute();
    
    $rowLogin = $queryLogin->fetch(PDO::FETCH_ASSOC);
	
    $handleUsuario = $rowLogin['HANDLE'];
	
if ($handleUsuario > 0) {
	
	$_SESSION['handleUsuario'] = $handleUsuario;
	$_SESSION['logou'] = 'S';
	header('Location: ../../index.php');
}//if login e senha existir
else {
	
	unset($_SESSION['$handleUsuario']);
	unset($_SESSION['logou']);
	$_SESSION['retorno'] = 'Login e/ou senha incorretos, tente novamente.';
	header('Location: ../../view/estrutura/login.php');
}
}//isset entrar
else {
	$_SESSION['retorno'] = 'Login e/ou senha incorretos, tente novamente.';
	unset($_SESSION['logou']);
	unset($_SESSION['$handleUsuario']);
	header('Location: ../../view/estrutura/login.php');
}
?>