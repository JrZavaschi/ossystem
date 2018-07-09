<!-- Produto -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="inserirProdutoModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">Inserir produto</h4>
			</div>
		    <form method="post" id="cadastroProdutoInserir" action="#">
				<div class="modal-body">
				  		  <div class="col-sm-12 m-b-xs">
					  			<input type="checkbox" id="ativoModal" name="ativo" data-onstyle="info" checked>
						  </div>
						  <div class="col-sm-4 m-b-xs">
								<label>Produto <font color="#FF0004">*</font></label>      
								<select id="produtoModal" name="produto" class="form-control" required>
										<option value="">-- Selecione --</option>
									<?php
									if($ehrestauranteUsuario == 'S'){
										$queryProdutoModal = $connect->prepare("SELECT `HANDLE`, `NOME` 
																				FROM `re_produto` 
																				WHERE `ATIVO` = 'S' 
																				AND `RESTAURANTE` = '".$restauranteUsuario."'");
									}
									else{
										$queryProdutoModal = $connect->prepare("SELECT `HANDLE`, `NOME` 
																				FROM `re_produto` 
																				WHERE `ATIVO` = 'S'");
									}
										$queryProdutoModal->execute();

										while($rowProdutoModal = $queryProdutoModal->fetch(PDO::FETCH_ASSOC)){
											$handleProdutoModal = $rowProdutoModal['HANDLE'];
											$nomeProdutoModal = $rowProdutoModal['NOME'];
									?>
										<option value="<?php echo $handleProdutoModal; ?>"><?php echo $nomeProdutoModal; ?></option>
									<?php
										}
									?>
								</select>
						  </div>
						  <div class="col-sm-8 m-b-xs">
								<label>Quantidade</label>      
								<input type="text" id="quantidadeModal" name="quantidade" class="form-control">
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

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="visualizarProdutoModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">Visualizar produto</h4>
			</div>
			<form method="post" id="cadastroProdutoEditar" action="#">
				<div class="modal-body">
				  		  <div class="col-sm-12 m-b-xs">
					  			<input type="checkbox" id="ativoVisualizarModal" name="ativoVisualizarModal" data-onstyle="info">
					  			<input type="text" name="handleProdutoVisualizarModal" id="handleProdutoVisualizarModal" hidden="true">
						  </div>
						  <div class="col-sm-4 m-b-xs">
								<label>Produto <font color="#FF0004">*</font></label>      
								<select id="produtoVisualizarModal" name="produtoVisualizarModal" class="form-control" required>
									<option value="" id="optionProdutoVisualizarModal"></option>
									<?php
									if($ehrestauranteUsuario == 'S'){
										$queryProdutoModal = $connect->prepare("SELECT `HANDLE`, `NOME` 
																				FROM `re_produto` 
																				WHERE `ATIVO` = 'S' 
																				AND `RESTAURANTE` = '".$restauranteUsuario."'");
									}
									else{
										$queryProdutoModal = $connect->prepare("SELECT `HANDLE`, `NOME` 
																				FROM `re_produto` 
																				WHERE `ATIVO` = 'S'");
									}
										$queryProdutoModal->execute();

										while($rowProdutoModal = $queryProdutoModal->fetch(PDO::FETCH_ASSOC)){
											$handleProdutoModal = $rowProdutoModal['HANDLE'];
											$nomeProdutoModal = $rowProdutoModal['NOME'];
									?>
										<option value="<?php echo $handleProdutoModal; ?>"><?php echo $nomeProdutoModal; ?></option>
									<?php
										}
									?>
								</select>
						  </div>
						  <div class="col-sm-8 m-b-xs">
								<label>Quantidade</label>      
								<input type="text" id="quantidadeVisualizarModal" name="quantidadeVisualizarModal" class="form-control">
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

<!-- Adicional -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="inserirAdicionalModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">Inserir adicional</h4>
			</div>
		    <form method="post" id="cadastroAdicionalInserir" action="#">
				<div class="modal-body">
				  		  <div class="col-sm-12 m-b-xs">
					  			<input type="checkbox" id="ativoAdicionalModal" name="ativo" data-onstyle="info" checked>
						  </div>
						  <div class="col-sm-4 m-b-xs">
								<label>Produto <font color="#FF0004">*</font></label>      
								<select id="produtoModal" name="produto" class="form-control" required>
										<option value="">-- Selecione --</option>
									<?php
									if($ehrestauranteUsuario == 'S'){
										$queryProdutoModal = $connect->prepare("SELECT `HANDLE`, `NOME` 
																				FROM `re_produto` 
																				WHERE `ATIVO` = 'S' 
																				AND `RESTAURANTE` = '".$restauranteUsuario."'");
									}
									else{
										$queryProdutoModal = $connect->prepare("SELECT `HANDLE`, `NOME` 
																				FROM `re_produto` 
																				WHERE `ATIVO` = 'S'");
									}
										$queryProdutoModal->execute();

										while($rowProdutoModal = $queryProdutoModal->fetch(PDO::FETCH_ASSOC)){
											$handleProdutoModal = $rowProdutoModal['HANDLE'];
											$nomeProdutoModal = $rowProdutoModal['NOME'];
									?>
										<option value="<?php echo $handleProdutoModal; ?>"><?php echo $nomeProdutoModal; ?></option>
									<?php
										}
									?>
								</select>
						  </div>
						  <div class="col-sm-8 m-b-xs">
								<label>Quantidade</label>      
								<input type="text" id="quantidadeModal" name="quantidade" class="form-control">
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

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="visualizarAdicionalModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">Visualizar produto</h4>
			</div>
			<form method="post" id="cadastroAdicionalEditar" action="#">
				<div class="modal-body">
				  		  <div class="col-sm-12 m-b-xs">
					  			<input type="checkbox" id="ativoAdicionalVisualizarModal" name="ativoVisualizarModal" data-onstyle="info">
					  			<input type="text" name="handleAdicionalVisualizarModal" id="handleAdicionalVisualizarModal" hidden="true">
						  </div>
						  <div class="col-sm-4 m-b-xs">
								<label>Produto <font color="#FF0004">*</font></label>      
								<select id="produtoAdicionalVisualizarModal" name="produtoVisualizarModal" class="form-control" required>
									<option value="" id="optionAdicionalVisualizarModal"></option>
									<?php
									if($ehrestauranteUsuario == 'S'){
										$queryProdutoModal = $connect->prepare("SELECT `HANDLE`, `NOME` 
																				FROM `re_produto` 
																				WHERE `ATIVO` = 'S' 
																				AND `RESTAURANTE` = '".$restauranteUsuario."'");
									}
									else{
										$queryProdutoModal = $connect->prepare("SELECT `HANDLE`, `NOME` 
																				FROM `re_produto` 
																				WHERE `ATIVO` = 'S'");
									}
										$queryProdutoModal->execute();

										while($rowProdutoModal = $queryProdutoModal->fetch(PDO::FETCH_ASSOC)){
											$handleProdutoModal = $rowProdutoModal['HANDLE'];
											$nomeProdutoModal = $rowProdutoModal['NOME'];
									?>
										<option value="<?php echo $handleProdutoModal; ?>"><?php echo $nomeProdutoModal; ?></option>
									<?php
										}
									?>
								</select>
						  </div>
						  <div class="col-sm-8 m-b-xs">
								<label>Quantidade</label>      
								<input type="text" id="quantidadeAdicionalVisualizarModal" name="quantidadeVisualizarModal" class="form-control">
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
<script>
$(document).ready(function(){
	$('#ativoModal').bootstrapToggle({
      on: 'Ativo',
      off: 'Inativo'
    });
	$('#ativoVisualizarModal').bootstrapToggle({
      on: 'Ativo',
      off: 'Inativo'
    });
	$('#ativoAdicionalModal').bootstrapToggle({
      on: 'Ativo',
      off: 'Inativo'
    });
	$('#ativoAdicionalVisualizarModal').bootstrapToggle({
      on: 'Ativo',
      off: 'Inativo'
    });
	
	//produto
	jQuery('#cadastroProdutoInserir').submit(function(){		
		var dados = jQuery( this ).serialize();

		jQuery.ajax({
			type: "POST",
			url: "controller/cadastro/cadastroCardapioProdutoInserir.php?h=<?php echo $handleCardapio; ?>",
			//dataType : 'json', 
			data: dados,
			success: function( data ) {
					var json = $.parseJSON(data);
					$('#inserirProdutoModal').modal('toggle');
					$('#retorno').modal('show');
					$('#retorno-body').html(json.retorno);
			}
		});
		return false;
	});
	
	jQuery('#cadastroProdutoEditar').submit(function(){		
		var dados = jQuery( this ).serialize();

		jQuery.ajax({
			type: "POST",
			url: "controller/cadastro/cadastroCardapioProdutoEditar.php?h=<?php echo $handleCardapio; ?>",
			//dataType : 'json', 
			data: dados,
			success: function( data ) {
					var json = $.parseJSON(data);
					$('#visualizarProdutoModal').modal('toggle');
					$('#retorno').modal('show');
					$('#retorno-body').html(json.retorno);
			}
		});
		return false;
	});
	
	//adicional
	jQuery('#cadastroAdicionalInserir').submit(function(){		
		var dados = jQuery( this ).serialize();

		jQuery.ajax({
			type: "POST",
			url: "controller/cadastro/cadastroCardapioAdicionalInserir.php?h=<?php echo $handleCardapio; ?>",
			//dataType : 'json', 
			data: dados,
			success: function( data ) {
					var json = $.parseJSON(data);
					$('#visualizarAdicionalModal').modal('hide');
					$('#retorno').modal('show');
					$('#retorno-body').html(json.retorno);
			}
		});
		return false;
	});
	
	jQuery('#cadastroAdicionalEditar').submit(function(){		
		var dados = jQuery( this ).serialize();

		jQuery.ajax({
			type: "POST",
			url: "controller/cadastro/cadastroCardapioAdicioalEditar.php?h=<?php echo $handleCardapio; ?>",
			//dataType : 'json', 
			data: dados,
			success: function( data ) {
					var json = $.parseJSON(data);
					$('#visualizarAdicionalModal').modal('hide');
					$('#retorno').modal('show');
					$('#retorno-body').html(json.retorno);
			}
		});
		return false;
	});
});
</script>