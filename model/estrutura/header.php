<!--logo start-->
<div class="brand">
    <a href="index.php" class="logo">
       <?php
		$query_logo_emitente =  $connect->prepare("SELECT LOGO FROM ms_oficina");
					
		$query_logo_emitente->execute();

		$row_logo_emitente = $query_logo_emitente->fetch(PDO::FETCH_ASSOC);
		$logo_emitente = $row_logo_emitente['LOGO'];
	   ?>
	   <!--img src="view/tecnologia/uploads/oficina/emitente/<?php echo $logo_emitente; ?>" class="img-responsive" width="90px" height="auto" alt="Olsson Motorsport"-->OSSystem  
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="nav notify-row " id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- notification dropdown start-->
        
        <!-- notification dropdown end -->
    </ul>
    <!--  notification end -->
</div>
<div class="top-nav notify-row pull-right clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <!-- user login dropdown start-->
        <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                <i class="fa fa-bell-o"></i>
                <span class="badge bg-warning">3</span>
            </a>
            <ul class="dropdown-menu extended notification">
                <li>
                    <p>Notificações recentes</p>
                </li>
                <li>
                    <div class="alert alert-info clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <div class="noti-info">
                            <a href="#"> Exemplo de notificação</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="alert alert-danger clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <div class="noti-info">
                            <a href="#"> Exemplo de notificação</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="alert alert-success clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <div class="noti-info">
                            <a href="#"> Exemplo de notificação</a>
                        </div>
                    </div>
                </li>

            </ul>
        </li>
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="view/tecnologia/uploads/restaurante/usuario/<?php echo $fotoUsuario; ?>">
                <span class="username"><?php echo $loginUsuario; ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-user"></i>Perfil</a></li>
                <li><a href="#"><i class="fa fa-cogs"></i> Configurações</a></li>
                <li><a href="controller/estrutura/logout.php"><i class="fa fa-sign-out"></i> Sair</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>