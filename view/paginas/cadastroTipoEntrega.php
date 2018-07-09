<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
       <i class="fa fa-motorcycle"></i> Tipos de entrega
    </div>
<?php
if(isset($_SESSION['retorno'])){
	$retorno = $_SESSION['retorno'];
	unset($_SESSION['retorno']);
	print('<br /><div class="alert alert-info">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> '.$retorno.'</div>');
	$retorno = null;
}	
?>
    <div class="row w3-res-tb">
      <div class="col-sm-12 m-b-xs">
        <a href="?p=cadastroTipoEntregaInserir"><button class="btn btn-success">Inserir</button> </a>       
      </div>
    </div>
    <div class="table-responsive">
     <div class="col-sm-12">
      <table class="table table-striped b-t b-light" id="categorias">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Codigo</th>
            <th>Nome</th>
            <th>Tarifado</th>
            <th>Status</th>
            <th><i class="fa fa-cogs"></i></th>
          </tr>
        </thead>
        <tbody>
         <?php
		 if($ehrestauranteUsuario == 'S'){
			$queryTipoEntrega = $connect->prepare("SELECT HANDLE, 
												   NOME,
												   EHTARIFADO, 
												   ATIVO, 
												   DATAHORA 
												   FROM `re_pedidotipoentrega` 
												   WHERE `RESTAURANTE` = '".$restauranteUsuario."'
											      ");
		 }
		 else{
			 $queryTipoEntrega = $connect->prepare("SELECT HANDLE, 
												    NOME,
												    EHTARIFADO, 
												    ATIVO, 
												    DATAHORA 
												    FROM `re_pedidotipoentrega` 
												   ");
		 }
			
			$queryTipoEntrega->execute();
			
			while($rowTipoEntrega = $queryTipoEntrega->fetch(PDO::FETCH_ASSOC)){
				$handleTipoEntrega = $rowTipoEntrega['HANDLE'];
				$nomeTipoEntrega = $rowTipoEntrega['NOME'];
				$ativoTipoEntrega = $rowTipoEntrega['ATIVO'];
				$ehTarifadoTipoEntrega = $rowTipoEntrega['EHTARIFADO'];
				$dataHoraTipoEntrega = date('d/m/Y', strtotime($rowTipoEntrega['DATAHORA']));
								
				if($ativoTipoEntrega == 'S'){
					$statusTipoEntrega = '<font color="#29a43b">Ativo</font>';
				}
				else{
					$statusTipoEntrega = '<font color="#a42929">Inativo</font>';
				}
				
				if($ehTarifadoTipoEntrega == 'S'){
					$tarifadoPedidoEntrega = 'Sim';
				}
				else{
					$tarifadoPedidoEntrega = 'Não';
				}
		 ?>	
         
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" value="<?php echo $handleTipoEntrega; ?>" name="chk[]"><i></i></label></td>
            <td><?php echo $handleTipoEntrega; ?></td>
            <td><?php echo $nomeTipoEntrega; ?></td>
            <td><?php echo $tarifadoPedidoEntrega; ?></td>
            <td><?php echo $statusTipoEntrega; ?></td>
            <td>
              <a href="index.php?p=cadastroTipoEntregaEditar&h=<?php echo $handleTipoEntrega; ?>" class="active" ui-toggle-class=""><i class="fa fa-pencil text-success text-active"></i ></a> &shy;
              <a href="#"><i id="<?php echo $handleTipoEntrega; ?>" class="fa fa-times text-danger text excluirTipoEntrega"></i></a>
            </td>
          </tr>
         <?php
			}
		 ?>	
        </tbody>
      </table>
      </div>
    </div>
    <footer class="panel-footer">
    </footer>
  </div>
</div>
</section>
<?php
	include('model/estrutura/retorno.php');
	include('model/estrutura/excluir.php');
?>
<script>
$(document).ready(function(){
		
	 $('#categorias').DataTable( {
        "language": {
			"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
        }
    } );
	
	$('.excluirTipoEntrega').click(function(){
		
		$('#excluirModal').modal('show');
		var handleTipoEntrega = this.id;
		$('#confirmarExcluir').click(function(){
			$('#excluirModal').modal('hide');
			
			jQuery.ajax({
				type: "POST",
				url: "controller/cadastro/cadastroTipoEntregaExcluir.php",
				//dataType : 'json', 
				data: { "handleTipoEntrega":handleTipoEntrega },
				success: function( data ) {
					//console.log(data);
						var json = $.parseJSON(data);
						$('#retorno').modal('show');
						$('#retorno-body').html(json.retorno);
				}
			});
			return false;
		});
		
	});
	
});
</script>