<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-archive"></i> Inserir produto
    </div>
    
    <form action="#" id="cadastroProdutoInserir" method="post" enctype="multipart/form-data">
   	<div class="row w3-res-tb">
   		<div class="col-sm-12 m-b-xs">
   			<a href="index.php?p=cadastroProduto"><button class="btn btn-default" type="button"><i class="fa fa-arrow-left"></i> Listar produtos</button></a>
			<input type="checkbox" id="ativo" name="ativo" data-onstyle="info" checked>
		</div>
		<!-- Start retorno -->
		<?php
			include('model/estrutura/retorno.php');
		?>
		<!-- End retorno //-->
   	</div>
    <div class="row w3-res-tb">
     
      <div class="col-sm-1 m-b-xs">
        <label>Código</label>      
        <input type="text" name="codigo" class="form-control" disabled>
      </div>
      <div class="col-sm-3 m-b-xs">
		<label>Cód. referência </label>      
		<input type="text" name="codigoReferencia" id="codigoReferencia" class="form-control" >
	  </div>
	  <div class="col-sm-8 m-b-xs">
		<label>Nome <font color="#FF0004">*</font></label>      
		<input type="text" name="nome" id="nome" class="form-control" required>
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>Valor custo</label>      
		<input type="text" name="valorCusto" id="valorCusto" class="form-control">
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>Valor venda</label>      
		<input type="text" name="valorVenda" id="valorVenda" class="form-control">
	  </div>
	  <div class="col-sm-2 m-b-xs">
		<label>Margem de lucro </label>      
		<input type="text" id="margemLucro" name="margemLucro" class="form-control">
	  </div>
      <div class="col-sm-2 m-b-xs">
		<label>Quantidade </label>      
		<input type="text" id="quantidade" name="quantidade" class="form-control">
	  </div>
      <div class="col-sm-2 m-b-xs">
		<label>Unidade medida </label>      
		<input type="text" id="unidadeMedida" name="unidadeMedida" class="form-control">
	  </div>
	  <div class="col-sm-6 m-b-xs">
			<label>Foto</label>      
			<input type="file" id="foto" name="foto" class="form-control">
	  </div>
	  <div class="col-sm-12 m-b-xs">
			<label>Observações </label>      
		  <textarea type="text" id="obs" name="obs" class="form-control"></textarea>
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

	jQuery('#cadastroProdutoInserir').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dados = jQuery( this ).serialize();

		jQuery.ajax({
			type: "POST",
			url: "controller/cadastro/cadastroProdutoInserir.php",
			//dataType : 'json', 
			data: new FormData( this ),
			processData: false,
			contentType: false,    
			success: function( data ) {
					var json = jQuery.parseJSON(data);
					$('#retorno').modal('show');
					$('#retorno-body').html(json.retorno);	
					if(json.sucesso === 'S'){
						setTimeout(function(){location.href='index.php?p=cadastroProdutoEditar&h='+json.handleProduto} , 3000);
					}
			}
		});
		return false;
	});
});
	
$('#tipopessoa').change(function(){
	if(this.value === 'Física'){
		$('#fisica').removeClass('hide');
		$('#fisica').addClass('nohide');
		
		$('#juridica').removeClass('nohide');
		$('#juridica').addClass('hide');
		
		$('#nome').attr('required', 'required');
		$('#sobrenome').attr('required', 'required');
		$('#cpf').attr('required', 'required');
		
		$('#razaosocial').removeAttr('required');
		$('#nomefantasia').removeAttr('required');
		$('#cnpj').removeAttr('required');
	}
	else if(this.value === 'Jurídica'){
		$('#juridica').removeClass('hide');
		$('#juridica').addClass('nohide');
		
		$('#fisica').removeClass('nohide');
		$('#fisica').addClass('hide');
		
		$('#razaosocial').attr('required', 'required');
		$('#nomefantasia').attr('required', 'required');
		$('#cnpj').attr('required', 'required');
		
		$('#nome').removeAttr('required');
		$('#sobrenome').removeAttr('required');
		$('#cpf').removeAttr('required');
	}
});
	
$(function(){
	$('#uf').change(function(){
		if( $(this).val() ) {
			$('#cidade').hide();
			$.getJSON('controller/global/cidades.ajax.php?search=',{uf: $(this).val(), ajax: 'true'}, function(j){
				var options = '<option value=""></option>';	
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].HANDLE + '">' + j[i].CIDADE + '</option>';
				}	
				$('#cidade').html(options).show();
			});
		} else {
			$('#cidade').html('<option value="">-- Escolha um estado --</option>');
		}
	});
	
	$('#cidade').change(function(){
		if( $(this).val() ) {
			$('#bairro').hide();
			$.getJSON('controller/global/bairros.ajax.php?search=',{cidade: $(this).val(), ajax: 'true'}, function(j){
				var options = '<option value=""></option>';	
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].HANDLE + '">' + j[i].NOME + '</option>';
				}	
				$('#bairro').html(options).show();
			});
		} else {
			$('#cidade').html('<option value="">-- Escolha uma cidade --</option>');
		}
	});
});
</script>