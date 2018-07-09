<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-wrench"></i> Inserir Orçamento
    </div>
    
    <form action="#" id="oficinaOrcamentoInserir" method="post" enctype="multipart/form-data">
   	<div class="row w3-res-tb">
   		<div class="col-sm-12 m-b-xs">
   			<a href="index.php?p=oficinaOrcamento"><button class="btn btn-default" type="button"><i class="fa fa-arrow-left"></i> Listar Orçamentos</button></a>
		</div>
		<!-- Start retorno -->
		<?php
			include('model/estrutura/retorno.php');
			include('model/estrutura/retornoConfirm.php');
		?>
		<!-- End retorno //-->
   	</div>
    <div class="row w3-res-tb">
     
      <div class="col-sm-1 m-b-xs">
        <label>Código</label>      
        <input type="text" name="codigo" class="form-control" disabled>
      </div>
	  <div class="col-sm-5 m-b-xs">
		<label>Cliente <font color="#FF0004">*</font></label>   
		<input type="text" name="cliente" id="cliente" class="form-control">
	  </div>
	  <div class="col-sm-2 m-b-xs">
		<label>Veículo <font color="#FF0004">*</font></label>     
		<input type="text" name="placa" id="placa" class="form-control">
	  </div>
	  <div class="col-sm-2 m-b-xs">	  	
		<label>Marca</label>
		<input type="text" name="marca" id="marca" class="form-control">
	  </div>
	  <div class="col-sm-2 m-b-xs">	  	
		<label>Modelo</label>
		<input type="text" name="modelo" id="modelo" class="form-control">
	  </div>
	  <div class="col-sm-2 m-b-xs">	  	
		<label>Ano</label>
		<input type="text" name="ano" id="ano" class="form-control">
	  </div>
	  <div class="col-sm-2 m-b-xs">	  	
		<label>Ano Modelo</label>
		<input type="text" name="anomodelo" id="anomodelo" class="form-control">
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>Garantia</label>      
		<input type="text" class="form-control" name="garantia" id="garantia">
	  </div>
	  <div class="col-sm-5 m-b-xs">
			<label>Foto</label>      
			<input type="file" id="foto" name="foto" class="form-control">
	  </div>
	  <div class="col-sm-12 m-b-xs">
			<label>Descrição Produto/Serviço - Valores <font color="#FF0004">*</font></label>      
		  <textarea type="text" id="descricao" rows="8" name="descricao" class="form-control"></textarea>
	  </div>
	  <div class="col-sm-12 m-b-xs">
			<label>Observações <font color="#FF0004">*</font></label>      
		  <textarea type="text" id="obs" rows="8" name="obs" class="form-control"></textarea>
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
	CKEDITOR.replace( 'descricao' );
	//CKEDITOR.replace( 'obs' );
	var url_atual = window.location.href;
	var url_atual_remaster = url_atual.replace("index.php?p=oficinaOrcamentoInserir", "");
	
	jQuery('#oficinaOrcamentoInserir').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dados = jQuery( this ).serialize();
		//console.log(new FormData( this ));
		jQuery.ajax({
			type: "POST",
			url: "controller/oficina/oficinaOrcamentoInserir.php",
			//dataType : 'json', 
			data: new FormData( this ),
			processData: false,
			contentType: false,    
			success: function( data ) {
					var json = jQuery.parseJSON(data);
				console.log(data);
					$('#retornoConfirm').modal('show');
					$('#retornoConfirm-body').html(json.retorno);	
					if(json.sucesso === 'S'){
						$('.confirmarRetornoConfirm').click(function(){
							window.open(url_atual_remaster.replace("#", "")+'model/oficina/oficinaOrcamentoImprimir.php?h='+json.handleOC, '_blank');
							$('#retornoConfirm').modal('toggle');
						    location.href = 'index.php?p=oficinaOrcamentoEditar&h='+json.handleOC;
						});
					}
			}
		});
		return false;
	});
	
});
</script>