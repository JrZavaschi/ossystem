<?php
$handleTipoEntrega = Sistema::getGet('h');
$queryTipoEntrega = $connect->prepare("SELECT HANDLE, 
									   NOME,
									   EHTARIFADO, 
									   ATIVO, 
									   DATAHORA,
									   OBSERVACAO
									   FROM `re_pedidotipoentrega` 
									   WHERE HANDLE = '".$handleTipoEntrega."'
									  ");

$queryTipoEntrega->execute();
$rowTipoEntrega = $queryTipoEntrega->FETCH(PDO::FETCH_ASSOC);

$handleTipoEntrega = $rowTipoEntrega['HANDLE'];
$nomeTipoEntrega = $rowTipoEntrega['NOME'];
$ativoTipoEntrega = $rowTipoEntrega['ATIVO'];
$ehTarifadoTipoEntrega = $rowTipoEntrega['EHTARIFADO'];
$dataHoraTipoEntrega = date('d/m/Y', strtotime($rowTipoEntrega['DATAHORA']));
$observacaoTipoEntrega = $rowTipoEntrega['OBSERVACAO'];

if($ativoTipoEntrega == 'S'){
	$statusTipoEntrega = 'checked';
}
else{
	$statusTipoEntrega = '';
}

if($ehTarifadoTipoEntrega == 'S'){
	$tarifadoTipoEntrega = 'checked';
}
else{
	$tarifadoTipoEntrega = '';
}

?>
<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-motorcycle"></i><i class="fa fa-pencil"></i> Editar tipo de entrega
    </div>
    
    <form action="#" id="cadastroTipoEntregaEditar" method="post" enctype="multipart/form-data">
   	<div class="row w3-res-tb">
   		<div class="col-sm-12 m-b-xs">
   			<a href="index.php?p=cadastroTipoEntrega">
   				<button class="btn btn-default" type="button"><i class="fa fa-arrow-left"></i> Listar formas de pagamento</button>
   			</a>
			<input type="checkbox" id="ativo" name="ativo" data-onstyle="info" <?php echo $statusTipoEntrega; ?> >
			<input type="checkbox" id="tarifado" name="tarifado" data-onstyle="success" data-offstyle="warning" <?php echo $tarifadoTipoEntrega; ?>>
		</div>
		<!-- Start retorno -->
		<?php
			include('model/estrutura/retorno.php');
		?>
		<!-- End retorno //-->
   	</div>
    <div class="row w3-res-tb">
     
      <div class="col-sm-2 m-b-xs">
        <label>Código</label>      
        <input type="text" name="codigo" value="<?php echo $handleTipoEntrega; ?>" class="form-control" disabled>
      </div>
      <div class="col-sm-10 m-b-xs">
		<label>Nome <font color="#FF0004">*</font></label>      
		<input type="text" class="form-control" value="<?php echo $nomeTipoEntrega; ?>" name="nome" id="nome" required>
	  </div>
	  <div class="col-sm-12 m-b-xs">
		  <label>Observação</label>   
		  <textarea name="observacao" id="observacao" class="form-control" cols="30" rows="10"><?php echo $observacaoTipoEntrega; ?></textarea>
	  </div>
    </div>
    <footer class="panel-footer">
      <div class="row">
      <button type="submit" class="btn btn-success right-stat-bar floatRight">Gravar</button>
      </div>
    </footer>
    </form>
  </div>
</div>
</section>
<!-- Include js scripts for page -->
<script src="view/tecnologia/js/jquery.maskedinput.js"></script>
<script>
// JavaScript Document
$(document).ready(function(){
	
	for ( instance in CKEDITOR.instances )
    CKEDITOR.instances[instance].updateElement();
	
	CKEDITOR.replace( 'observacao' );
	
	$('#ativo').bootstrapToggle({
      on: 'Ativo',
      off: 'Inativo'
    });
	
	$('#tarifado').bootstrapToggle({
      on: 'Tarifado',
      off: 'Não tarifado'
    });
	
	jQuery('#cadastroTipoEntregaEditar').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dados = jQuery( this ).serialize();
		
		jQuery.ajax({
			type: "POST",
			url: "controller/cadastro/cadastroTipoEntregaEditar.php?h=<?php echo $handleTipoEntrega;?>",
			//dataType : 'json', 
			data: new FormData( this ),
			//data: dados,
			processData: false,
			contentType: false,    
			success: function( data ) {
				//console.log(data);
					var json = jQuery.parseJSON(data);
					$('#retorno').modal('show');
					$('#retorno-body').html(json.retorno);
				
			}
		});
		return false;
	});
});
</script>