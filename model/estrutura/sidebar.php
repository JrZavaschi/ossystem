<div id="sidebar" class="nav-collapse hide-left-bar">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <?php
					
				if($ehadminUsuario == 'S'){
					$query_modulo =  $connect->prepare("SELECT A.* FROM `ms_modulo` A ORDER BY A.ORDEM ASC");
					
					$query_modulo->execute();
					
					while($row_modulo = $query_modulo->fetch(PDO::FETCH_ASSOC)){
						$handleModulo = $row_modulo['HANDLE'];
						$nomeModulo = $row_modulo['NOME'];
						$iconeModulo = $row_modulo['ICONE'];
						$linkModulo = $row_modulo['LINK'];
						$ehModulo = $row_modulo['EHMODULO'];
						$ehmenuModulo = $row_modulo['EHMENU'];
				?>
				<li class="sub-menu">
                    <a class="<?php echo $activeMenu; ?>" href="<?php echo $linkModulo; ?>">
                        <i class="<?php echo $iconeModulo; ?>"></i>
                        <span><?php echo $nomeModulo; ?></span>
                    </a>
                    <?php
						$query_menu =  $connect->prepare("SELECT * FROM `ms_menu` WHERE `MODULO` = '".$handleModulo."' ORDER BY ORDEM ASC");
						$query_menu->execute();
						while($row_menu = $query_menu->fetch(PDO::FETCH_ASSOC)){
						$handleMenu = $row_menu['HANDLE'];
						$nomeMenu = $row_menu['MENU'];
						$iconeMenu = $row_menu['ICONE'];
						$linkMenu = $row_menu['LINK'];
							
					?>
                    <ul class="sub">
						<li><a href="<?php echo $linkMenu; ?>"><?php echo $nomeMenu; ?></a></li>
                    </ul>
                    <?php
						}
					?>
                </li>				
				<?php
				}
					}//if ehadminUsuario = 'S'
			    ?>
                
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>