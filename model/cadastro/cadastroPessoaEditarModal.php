<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="inserirEnderecoModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">Inserir endereço</h4>
			</div>
		    <form method="post" id="cadastroPessoaEnderecoInserir" action="#">
				<div class="modal-body">
						<div class="col-sm-4 m-b-xs">
							<label>UF <font color="#FF0004">*</font></label>      
							<select id="uf-modal" name="uf" class="form-control" required>
								<option value="">-- Selecione --</option>
								<?php
								$queryUF = $connect->prepare("SELECT HANDLE, SIGLA FROM ms_uf");

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
						  <div class="col-sm-8 m-b-xs">
								<label>Cidade <font color="#FF0004">*</font></label>      
								<select id="cidade-modal" name="cidade" class="form-control" required>
									<option value="">-- Selecione um estado --</option>
								</select>
						  </div>
						  <div class="col-sm-8 m-b-xs">
								<label>Bairro <font color="#FF0004">*</font></label> 
								<select id="bairro-modal" name="bairro" class="form-control" required>
									<option value="">-- Selecione uma cidade --</option>
								</select>
						  </div>
						  <div class="col-sm-4 m-b-xs">
								<label>CEP </label>      
								<input type="text" id="cep-modal" name="cep" class="form-control">
						  </div>
						  <div class="col-sm-8 m-b-xs">
								<label>Logradouro <font color="#FF0004">*</font></label>      
								<input type="text" id="logradouro-modal" name="logradouro" class="form-control">
						  </div>
						  <div class="col-sm-4 m-b-xs">
								<label>Número <font color="#FF0004">*</font></label>      
								<input type="text" id="numero-modal" name="numero" class="form-control">
						  </div>
						  <div class="col-sm-6 m-b-xs">
								<label>Complemento </label>      
								<input type="text" id="complemento-modal" name="complemento" class="form-control">
						  </div>
						  <div class="col-sm-6 m-b-xs">
								<label>Ponto de referência </label>      
								<input type="text" id="pontoreferencia-modal" name="pontoreferencia" class="form-control">
						  </div>
				</div>
				<div class="modal-footer">
					<div class="col-md-12">
						<button type="submit" class="btn btn-success floatRight">Gravar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="visualizarEnderecoModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">Inserir endereço</h4>
			</div>
			<div class="modal-body">
				<div class="col-sm-4 m-b-xs">
						<label>UF <font color="#FF0004">*</font></label>      
						<input type="text" id="uf-modal-visualizar" name="uf-modal-visualizar" class="form-control" disabled>
					  </div>
					  <div class="col-sm-8 m-b-xs">
							<label>Cidade <font color="#FF0004">*</font></label>      
							<input type="text" id="cidade-modal-visualizar" name="cidade-modal-visualizar" class="form-control" disabled>
					  </div>
					  <div class="col-sm-8 m-b-xs">
							<label>Bairro <font color="#FF0004">*</font></label> 
							<input type="text" id="bairro-modal-visualizar" name="bairro-modal-visualizar" class="form-control"  disabled>
					  </div>
					  <div class="col-sm-4 m-b-xs">
							<label>CEP </label>      
							<input type="text" id="cep-modal-visualizar" name="cep-modal-visualizar" class="form-control" disabled>
					  </div>
					  <div class="col-sm-8 m-b-xs">
							<label>Logradouro <font color="#FF0004">*</font></label>      
							<input type="text" id="logradouro-modal-visualizar" name="logradouro-modal-visualizar" class="form-control" disabled>
					  </div>
					  <div class="col-sm-4 m-b-xs">
							<label>Número <font color="#FF0004">*</font></label>      
							<input type="text" id="numero-modal-visualizar" name="numero-modal-visualizar" class="form-control" disabled>
					  </div>
					  <div class="col-sm-6 m-b-xs">
							<label>Complemento </label>      
							<input type="text" id="complemento-modal-visualizar" name="complemento-modal-visualizar" class="form-control" disabled>
					  </div>
					  <div class="col-sm-6 m-b-xs">
							<label>Ponto de referência </label>      
							<input type="text" id="pontoreferencia-modal-visualizar" name="pontoreferencia-modal-visualizar" class="form-control" disabled>
					  </div>
			</div>
			<div class="modal-footer">
				<div class="col-sm-12">
					<button aria-hidden="true" data-dismiss="modal" class="btn btn-default" type="button">Ok</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	
	jQuery('#cadastroPessoaEnderecoInserir').submit(function(){		
		var dados = jQuery( this ).serialize();

		jQuery.ajax({
			type: "POST",
			url: "controller/cadastro/cadastroPessoaEnderecoInserir.php?h=<?php echo $handlePessoa; ?>",
			//dataType : 'json', 
			data: dados,
			success: function( data ) {
					var json = $.parseJSON(data);
					$('#inserirEnderecoModal').modal('toggle');
					$('#retorno').modal('show');
					$('#retorno-body').html(json.retorno);
				
				$('#retornoOk').click(function(){
					location.reload();
				});
			}
		});
		return false;
	});
	
	$('#uf-modal').change(function(){
		if( $(this).val() ) {
			$('#cidade-modal').hide();
			$.getJSON('controller/global/cidades.ajax.php?search=',{uf: $(this).val(), ajax: 'true'}, function(j){
				var options = '<option value=""></option>';	
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].HANDLE + '">' + j[i].CIDADE + '</option>';
				}	
				$('#cidade-modal').html(options).show();
			});
		} else {
			$('#cidade').html('<option value="">-- Escolha um estado --</option>');
		}
	});
	
	$('#cidade-modal').change(function(){
		if( $(this).val() ) {
			$('#bairro-modal').hide();
			$.getJSON('controller/global/bairros.ajax.php?search=',{cidade: $(this).val(), ajax: 'true'}, function(j){
				var options = '<option value=""></option>';	
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].HANDLE + '">' + j[i].NOME + '</option>';
				}	
				$('#bairro-modal').html(options).show();
			});
		} else {
			$('#cidade-modal').html('<option value="">-- Escolha uma cidade --</option>');
		}
	});
});
</script>