<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
       <i class="fa fa-motorcycle"></i><i class="fa fa-plus"></i> Inserir tipo de pedido 
    </div>
    
    <form action="#" id="cadastroTipoEntregaInserir" method="post" enctype="multipart/form-data">
   	<div class="row w3-res-tb">
   		<div class="col-sm-12 m-b-xs">
   			<a href="index.php?p=cadastroTipoEntrega">
   				<button class="btn btn-default" type="button"><i class="fa fa-arrow-left"></i> Listar formas de pagamento</button>
   			</a>
			<input type="checkbox" id="ativo" name="ativo" data-onstyle="info" checked>
			<input type="checkbox" id="tarifado" name="tarifado" data-onstyle="success" data-offstyle="warning" checked>
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
        <input type="text" name="codigo" class="form-control" disabled>
      </div>
      <div class="col-sm-10 m-b-xs">
		<label>Nome <font color="#FF0004">*</font></label>      
		<input type="text" class="form-control" name="nome" id="nome" required>
	  </div>
	  <div class="col-sm-12">
	  	<label for="obs">Observação</label>
	  	<textarea type="text" class="form-control" name="obs" id="obs"></textarea>
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
	
	CKEDITOR.replace( 'obs' );
	
	$('#ativo').bootstrapToggle({
      on: 'Ativo',
      off: 'Inativo'
    });
	
	$('#tarifado').bootstrapToggle({
      on: 'Tarifado',
      off: 'Não tarifado'
    });
	
	jQuery('#cadastroTipoEntregaInserir').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dados = jQuery( this ).serialize();

		jQuery.ajax({
			type: "POST",
			url: "controller/cadastro/cadastroTipoEntregaInserir.php",
			//dataType : 'json', 
			data: new FormData( this ),
			//data: dados,
			processData: false,
			contentType: false,    
			success: function( data ) {
					var json = jQuery.parseJSON(data);
					$('#retorno').modal('show');
					$('#retorno-body').html(json.retorno);
				
					if(json.sucesso === 'S'){
						setTimeout(function(){location.href='index.php?p=cadastroTipoEntregaEditar&h='+json.handleTipoEntrega} , 3000);
					}
			}
		});
		return false;
	});
});
</script>