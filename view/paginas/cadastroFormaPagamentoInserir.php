<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-money"></i><i class="fa fa-plus"></i> Inserir Forma de pagamento
    </div>
    
    <form action="#" id="cadastroFormaPagamentoInserir" method="post" enctype="multipart/form-data">
   	<div class="row w3-res-tb">
   		<div class="col-sm-12 m-b-xs">
   			<a href="index.php?p=cadastroFormaPagamento">
   				<button class="btn btn-default" type="button"><i class="fa fa-arrow-left"></i> Listar formas de pagamento</button>
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
     
      <div class="col-sm-2 m-b-xs">
        <label>Código</label>      
        <input type="text" name="codigo" class="form-control" disabled>
      </div>
      <div class="col-sm-10 m-b-xs">
		<label>Forma de Pagamento <font color="#FF0004">*</font></label>      
		<select name="formapagamento" id="formapagamento" class="form-control" required>
			<option value="">-- Selecione --</option>
			<?php
			
				$queryMS_FormaPagamento = $connect->prepare("SELECT `HANDLE`, 
														 	`FORMAPAGAMENTO`
														     FROM `MS_FORMAPAGAMENTO` 
															");
				$queryMS_FormaPagamento->execute();
				while($rowMS_FormaPagamento = $queryMS_FormaPagamento->FETCH(PDO::FETCH_ASSOC)){

				$handleMS_FormaPagamento = $rowMS_FormaPagamento['HANDLE'];
				$nomeMS_FormaPagamento = $rowMS_FormaPagamento['FORMAPAGAMENTO'];
			?>
			<option value="<?php echo $handleMS_FormaPagamento; ?>"><?php echo $nomeMS_FormaPagamento; ?></option>
			<?php
				}
			?>
		</select>
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
	
	
	jQuery('#cadastroFormaPagamentoInserir').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dados = jQuery( this ).serialize();

		jQuery.ajax({
			type: "POST",
			url: "controller/cadastro/cadastroFormaPagamentoInserir.php",
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
						setTimeout(function(){location.href='index.php?p=cadastroFormaPagamentoEditar&h='+json.handleFormaPagamento} , 3000);
					}
			}
		});
		return false;
	});
});
</script>