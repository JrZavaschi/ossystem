<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-wrench"></i> Inserir Ordem de serviço
    </div>
    
    <form action="#" id="oficinaOrdensDeServicoInserir" method="post" enctype="multipart/form-data">
   	<div class="row w3-res-tb">
   		<div class="col-sm-12 m-b-xs">
   			<a href="index.php?p=oficinaOrdensDeServico"><button class="btn btn-default" type="button"><i class="fa fa-arrow-left"></i> Listar Ordens de Serviço</button></a>
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
	  <div class="col-sm-5 m-b-xs">
		<label>Ciente <font color="#FF0004">*</font></label>   
		<input type="text" name="clienteNome" id="cliente" class="form-control" required>
		<input type="text" name="cliente" id="clienteHandle" class="form-control" hidden="true" style="display: none">   
	  </div>
	  <div class="col-sm-2 m-b-xs">
		<label>Veículo <font color="#FF0004">*</font></label>     
		<input type="text" name="veiculoNome" id="veiculo" class="form-control" required disabled>
		<input type="text" name="veiculo" id="veiculoHandle" class="form-control" hidden="true" style="display: none">    
	  </div>
	  <div class="col-sm-2 m-b-xs">	  	
		<label>KM</label>
		<input type="text" name="kmVeiculo" id="kmVeiculo" class="form-control">
	  </div>
	  <div class="col-sm-2 m-b-xs">
		<label>Técnico </label>      
		<select name="tecnico" id="tecnico" class="form-control" >
			<option value="">-- Selecione --</option>
			<?php
			$queryTecnico = $connect->prepare("SELECT HANDLE, NOME, CPFCNPJ FROM ms_pessoa WHERE EHTECNICO = 'S'");
			
			$queryTecnico->execute();
			
			while($rowTecnico = $queryTecnico->fetch(PDO::FETCH_ASSOC)){
			?>
			<option value="<?php echo $rowTecnico['HANDLE']; ?>"><?php echo $rowTecnico['NOME']; ?></option>
			<?php
			}w
			?>
		</select>
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>Status <font color="#FF0004">*</font></label>      
		<select name="status" id="status" class="form-control" required>
			<option value="Orçamento">Orçamento</option>
			<option value="Em andamento">Em andamento</option>
			<option value="Finalizado">Finalizado</option>
			<option value="Cancelado">Cancelado</option>
		</select>
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>Data inicial</label>      
		<input type="date" class="form-control" name="dataInicial" id="dataInicial">
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>Data Final</label>      
		<input type="date" class="form-control" name="dataFinal" id="dataFinal">
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>Garantia</label>      
		<input type="text" class="form-control" name="garantia" id="garantia">
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>Forma de pagamento </label>      
		<select name="formaPagamento" id="formaPagamento" class="form-control">
			<option value="">-- Selecione --</option>
			<?php
				$queryFormaPagamento = $connect->prepare("SELECT * FROM ms_formapagamento");
				$queryFormaPagamento->execute();

				while($rowFormaPagamento = $queryFormaPagamento->fetch(PDO::FETCH_ASSOC)){
			?>
				<option value="<?php echo $rowFormaPagamento['FORMAPAGAMENTO']; ?>"><?php echo $rowFormaPagamento['FORMAPAGAMENTO']; ?></option>
			<?php
				}
			?>
		</select>
	  </div>
	  <div class="col-sm-8 m-b-xs">
			<label>Foto</label>      
			<input type="file" id="foto" name="foto" class="form-control">
	  </div>
	  <div class="col-sm-6 m-b-xs">
			<label>Descrição Produto/Serviço </label>      
		  <textarea type="text" id="descricao" rows="8" name="descricao" class="form-control"></textarea>
	  </div>
	  <div class="col-sm-6 m-b-xs">
			<label>Defeito </label>      
		  <textarea type="text" id="defeito" rows="8" name="defeito" class="form-control"></textarea>
	  </div>
	  <div class="col-sm-6 m-b-xs">
			<label>Observações </label>      
		  <textarea type="text" id="obs" rows="8" name="obs" class="form-control"></textarea>
	  </div>
	  <div class="col-sm-6 m-b-xs">
			<label>Laudo Técnico </label>      
		  <textarea type="text" id="laudoTecnico" rows="8" name="laudoTecnico" class="form-control"></textarea>
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
	//CKEDITOR.replace( 'obs' );
	
	jQuery('#oficinaOrdensDeServicoInserir').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dados = jQuery( this ).serialize();
		console.log(new FormData( this ));
		jQuery.ajax({
			type: "POST",
			url: "controller/oficina/oficinaOrdensDeServicoInserir.php",
			//dataType : 'json', 
			data: new FormData( this ),
			processData: false,
			contentType: false,    
			success: function( data ) {
					var json = jQuery.parseJSON(data);
					$('#retorno').modal('show');
					$('#retorno-body').html(json.retorno);	
					if(json.sucesso === 'S'){
						$('#retornoOk').click(function(){
							location.href='index.php?p=oficinaOrdensDeServicoEditar&h='+json.handleOS;
						});
						setTimeout(function(){location.href='index.php?p=oficinaOrdensDeServicoEditar&h='+json.handleOS} , 3000);
					}
			}
		});
		return false;
	});
	

		
		$('#cliente').click(function () {
			$('#cliente').autocomplete('option', 'minLength', 0);
			$('#cliente').autocomplete('search', $('#cliente').val());
		});
		
		$('#veiculo').click(function () {
			$('#veiculo').autocomplete('option', 'minLength', 0);
			$('#veiculo').autocomplete('search', $('#veiculo').val());
		});
		
		// Captura o retorno do retornaCliente.php
		$.getJSON('controller/oficina/oficinaOrdensDeServicoInserirRecuperaCliente.php', function(data){
			 var dados = [];
			 var handle = [];

			 $('#cliente').autocomplete({ 
				 source: data, 
				 minLength: 0,
				 select: function(event, ui) {
					 $("#clienteHandle").val(ui.item.id)
					 $('#veiculo').removeAttr('disabled');
			}     
				 
			 });
		});
		
		
		$('#veiculo').focus(function(){
			 
			var clienteSelecionado = $('#clienteHandle').val();
			$.getJSON('controller/oficina/oficinaOrdensDeServicoInserirRecuperaVeiculo.php?clienteSelecionado='+clienteSelecionado, function(data){
				 var dados = [];
				 var handle = [];

				 $('#veiculo').autocomplete({ 
					 source: data, 
					 minLength: 0,
					 select: function(event, ui) {
						 $("#veiculoHandle").val(ui.item.id)
				}     
				 });
			});
			
		});
	
});
</script>