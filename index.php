<?php
include('controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();

include('controller/estrutura/logou.php');		
?>
<!DOCTYPE html>
<head>
<title>OS System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="#" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Pace Loader -->
<link rel="stylesheet" href="view/tecnologia/css/pace-loader.css" >
<!-- bootstrap-css -->
<link rel="stylesheet" href="view/tecnologia/css/bootstrap.css" >
<link rel="stylesheet" href="view/tecnologia/css/dataTables.bootstrap.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="view/tecnologia/css/style.css" rel='stylesheet' type='text/css' />
<link href="view/tecnologia/css/style-responsive.css" rel="stylesheet"/>
<link href="view/tecnologia/css/jquery-ui.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="view/tecnologia/css/font.css" type="text/css"/>
<link href="view/tecnologia/css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="view/tecnologia/css/morris.css" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="view/tecnologia/css/monthly.css">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="view/tecnologia/js/jquery2.0.3.min.js"></script>
<script src="view/tecnologia/js/raphael-min.js"></script>
<script src="view/tecnologia/js/morris.js"></script>
<script src="view/tecnologia/ckeditor/ckeditor.js"></script>
<link href="view/tecnologia/css/bootstrap-toggle.min.css" rel="stylesheet">

<script src="view/tecnologia/js/script.global.js"></script>
	
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
	<?php
		include('model/estrutura/header.php')
	?>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <?php 
		include('model/estrutura/sidebar.php');
	?>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content" class="merge-left">
	<?php
	$paginaAtual = $_GET['p'];
	
	if($paginaAtual > ''){
		include('view/paginas/'.$paginaAtual.'.php');
	}
	else{
		include('view/paginas/dashboard.php');
	}
	?>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© <?php echo date('Y'); ?> OS System. Todos os direitos reservados | Desenvolvido por <a href="http://WeCoded.com.br">WeCoded.com.br</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script data-pace-options='{ "ajax": true }' src="view/tecnologia/js/pace-loader.js"></script>
<script src="view/tecnologia/js/jquery.maskMoney.min.js"></script>
<script src="view/tecnologia/js/bootstrap.js"></script>
<script src="view/tecnologia/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="view/tecnologia/js/scripts.js"></script>
<script src="view/tecnologia/js/jquery.slimscroll.js"></script>
<script src="view/tecnologia/js/jquery.nicescroll.js"></script>
<script src="view/tecnologia/js/jquery.dataTables.js"></script>
<script src="view/tecnologia/js/dataTables.bootstrap.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="view/tecnologia/js/jquery.scrollTo.js"></script>
<script src="view/tecnologia/js/bootstrap-toggle.min.js"></script>
<script src="view/tecnologia/js/jquery-ui.js"></script>
</body>
</html>
