<?php
session_start();
?>
<!DOCTYPE html>
<head>
<title>Login - OS System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="#" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="../tecnologia/css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="../tecnologia/css/style.css" rel='stylesheet' type='text/css' />
<link href="../tecnologia/css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="../tecnologia/css/font.css" type="text/css"/>
<link href="../tecnologia/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="../tecnologia/js/jquery2.0.3.min.js"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>Fazer login</h2>
<?php
if(isset($_SESSION['retorno'])){
	$retorno = $_SESSION['retorno'];
	unset($_SESSION['retorno']);
	print('<div class="alert alert-danger">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Atenção! </strong>'.$retorno.'</div>');
	$retorno = null;
}	
?>
		<form action="../../controller/estrutura/login_query.php" method="post">
			<input type="text" class="ggg" name="login" placeholder="LOGIN" required="">
			<input type="password" class="ggg" name="senha" placeholder="SENHA" required="">
			<span><input type="checkbox" name="lembrar" />Lembrar minha senha</span>
			<h6><a href="#">Esqueceu sua senha?</a></h6>
				<div class="clearfix"></div>
				<input type="submit" value="Entrar" name="entrar">
		</form>
		<p>Desenvolvido com <i class="fa fa-heart" style="color: #FB4245"></i> por<a href="http://WeCoded.com.br" target="_blank">WeCoded.com.br</a></p>
</div>
</div>
<script src="../tecnologia/js/bootstrap.js"></script>
<script src="../tecnologia/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="../tecnologia/js/scripts.js"></script>
<script src="../tecnologia/js/jquery.slimscroll.js"></script>
<script src="../tecnologia/js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="../tecnologia/js/jquery.scrollTo.js"></script>
</body>
</html>
