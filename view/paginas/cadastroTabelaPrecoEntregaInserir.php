<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-money"></i><i class="fa fa-motorcycle"></i><i class="fa fa-plus"></i> Inserir tabela de preço entrega
    </div>
    
    <form action="#" id="cadastroTabelaPrecoEntregaInserir" method="post" enctype="multipart/form-data">
   	<div class="row w3-res-tb">
   		<div class="col-sm-12 m-b-xs">
   			<a href="index.php?p=cadastroTabelaPrecoEntrega">
   				<button class="btn btn-default" type="button"><i class="fa fa-arrow-left"></i> Listar tabelas de preço de entrega</button>
   			</a>
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
      <div class="col-sm-1 m-b-xs">
			<label>UF <font color="#FF0004">*</font></label>      
		    <select id="uf" name="uf" class="form-control" required>
		    	<option value="">-- Selecione --</option>
		    	<?php
				$queryUF = $connect->prepare("SELECT HANDLE, SIGLA FROM MS_UF");
					
				$queryUF->execute();

				while($rowUF = $queryUF->fetch(PDO::FETCH_ASSOC)){
					$handleUF = $rowUF['HANDLE'];
					$siglaUF = $rowUF['SIGLA'];
				?>
		    	<option value="<?php echo $handleUF; ?>"><?php echo $siglaUF; ?></option>
		    	<?php
				}
				?>
		    </select>
	  </div>
	  <div class="col-sm-4 m-b-xs">
			<label>Cidade <font color="#FF0004">*</font></label>      
			<select id="cidade" name="cidade" class="form-control" required>
				<option value="">-- Selecione uma UF --</option>
			</select>
	  </div>
	  <div class="col-sm-4 m-b-xs">
			<label>Bairro <font color="#FF0004">*</font></label> 
			<select id="bairro" name="bairro" class="form-control" required>
				<option value="">-- Selecione uma Cidade --</option>
			</select>
	  </div>
	  <div class="col-sm-2 m-b-xs">
	  	<label>Valor <font color="#FF0004">*</font></label> 
	  	<input type="text" class="form-control" name="valor" id="valor" required />
	  </div>
	  <div class="col-sm-12 m-b-xs">
		  <label>Observação</label>   
		  <textarea name="obs" id="obs" class="form-control" cols="30" rows="10"></textarea>
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
	
	$("#valor").maskMoney();
	
	CKEDITOR.replace( 'obs' );
	
	$('#ativo').bootstrapToggle({
      on: 'Ativo',
      off: 'Inativo'
    });
	
	jQuery('#cadastroTabelaPrecoEntregaInserir').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dados = jQuery( this ).serialize();

		jQuery.ajax({
			type: "POST",
			url: "controller/cadastro/cadastroTabelaPrecoEntregaInserir.php",
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
						setTimeout(function(){location.href='index.php?p=cadastroTabelaPrecoEntregaEditar&h='+json.handleTabelaPrecoEntrega} , 3000);
					}
			}
		});
		return false;
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
});
</script>