<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-user-plus"></i> Inserir Veículo
    </div>
    
   	<div class="row w3-res-tb">
   		<div class="col-sm-12 m-b-xs">
   			<a href="index.php?p=cadastroVeiculo"><button class="btn btn-default"><i class="fa fa-arrow-left"></i> Listar Veiculos</button></a>
		</div>
		<!-- Start retorno -->
		<?php
			include('model/estrutura/retorno.php');
			include('model/estrutura/retornoConfirm.php');
		?>
		<!-- End retorno //-->
   	</div>
   	
    <form action="#" id="cadastroVeiculoInserir" method="post" enctype="multipart/form-data">
    <div class="row w3-res-tb">
     
      <div class="col-sm-1 m-b-xs">
        <label>Código</label>      
        <input type="text" name="codigo" class="form-control" disabled>
      </div>
      <div class="col-sm-3 m-b-xs">
			<label>Cliente <font color="#FF0004">*</font></label>      
		    <select id="cliente" name="cliente" class="form-control" required>
		    	<option value="">-- Selecione --</option>
		    	<?php
				$queryCliente = $connect->prepare("SELECT HANDLE, NOME, NOMEFANTASIA, TIPOPESSOA FROM ms_pessoa");
					
				$queryCliente->execute();

				while($rowCliente = $queryCliente->fetch(PDO::FETCH_ASSOC)){
					$handleCliente = $rowCliente['HANDLE'];
					$nomeCliente = $rowCliente['NOME'];
					$nomeFantasiaCliente = $rowCliente['NOMEFANTASIA'];
					$tipoPessoaCliente = $rowCliente['TIPOPESSOA'];
					
					if($tipoPessoaCliente == 'Física'){
						$nomeClienteExibe = $nomeCliente;
					}
					else{
						$nomeClienteExibe = $nomeFantasiaCliente;
					}
				?>
		    	<option value="<?php echo $handleCliente; ?>"><?php echo $nomeClienteExibe; ?></option>
		    	<?php
				}
				?>
		    </select>
	  </div>
      <div class="col-sm-2 m-b-xs">
			<label>Placa <font color="#FF0004">*</font></label>      
			<input type="text" id="placa" name="placa" class="form-control">
	  </div>
      <div class="col-sm-3 m-b-xs">
			<label>Marca</label>      
			<input type="text" id="marca" name="marca" class="form-control">
	  </div>
      <div class="col-sm-3 m-b-xs">
			<label>Modelo </label>      
			<input type="text" id="modelo" name="modelo" class="form-control">
	  </div>
      <div class="col-sm-2 m-b-xs">
			<label>Cor </label>      
			<input type="text" id="cor" name="cor" class="form-control">
	  </div>
      <div class="col-sm-3 m-b-xs">
			<label>Combustível </label>      
			<input type="text" id="combustivel" name="combustivel" class="form-control">
	  </div>
      <div class="col-sm-3 m-b-xs">
			<label>Quilometragem </label>      
			<input type="text" id="quilometragem" name="quilometragem" class="form-control">
	  </div>
      <div class="col-sm-2 m-b-xs">
			<label>Ano</label>      
			<input type="text" id="ano" name="ano" class="form-control">
	  </div>
      <div class="col-sm-2 m-b-xs">
			<label>Ano Modelo </label>      
			<input type="text" id="anomodelo" name="anomodelo" class="form-control">
	  </div>
      <div class="col-sm-4 m-b-xs">
			<label>Nº Motor</label>      
			<input type="text" id="numeromotor" name="numeromotor" class="form-control">
	  </div>
      <div class="col-sm-4 m-b-xs">
			<label>Nº Chassi</label>      
			<input type="text" id="numerochassi" name="numerochassi" class="form-control">
	  </div>
      <div class="col-sm-4 m-b-xs">
			<label>Foto</label>      
			<input type="file" id="foto" name="foto" class="form-control">
	  </div>
	 
    </div>
    <footer class="panel-footer">
      <div class="row">
      <div class="col-sm-12 m-b-xs">
     	 <button type="submit" class="btn btn-success right-stat-bar floatRight">Gravar</button>      	
      </div>
      </div>
    </footer>
    </form>
  </div>
</div>
</section>

<!-- Include js scripts for page -->
<script src="view/tecnologia/js/jquery.maskedinput.js"></script>
<script src="view/tecnologia/js/script.global.js"></script>
<script>
// JavaScript Document
$(document).ready(function(){
	
	
	jQuery('#cadastroVeiculoInserir').submit(function(){
		
		
		var dados = jQuery( this ).serialize();
		
		if($(this)[0].checkValidity()) {

			jQuery.ajax({
				type: "POST",
				url: "controller/cadastro/cadastroVeiculoInserir.php",
				//dataType : 'json', 
				/*data: dados,*/
				data: new FormData( this ),
				processData: false,
				contentType: false, 
				success: function( data ) {
					alert(data);
						var json = $.parseJSON(data);
					
						$('#retorno').modal('show');
						$('#retorno-body').html(json.retorno);
						
					$('#retornoOk').click(function(){
						if(json.sucesso === 'S'){
							location.href='index.php?p=cadastroVeiculoEditar&h='+json.handleVeiculo;
						}
					});
				}
			});
			return false;
		}
		else{
			$('#retorno').modal('show');
			$('#retorno-body').html('Preencha todos os campos obrigatórios para prosseguir');
		}
	});
	
});
	
//jQuery Mask input by Jr :)
$("#cpf").mask("999.999.999-99");
$("#cnpj").mask("99.999.999/9999-99");
$("#telefone").mask("(99) 9999 9999");
$("#celular").mask("(99) 9 9999 9999");
$("#cep").mask("99999-999");
$("#cep-modal").mask("99999-999");

</script>