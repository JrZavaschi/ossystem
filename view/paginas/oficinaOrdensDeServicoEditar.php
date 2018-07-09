<?php
$handleOS = $_GET['h'];
$queryOS = $connect->prepare("SELECT A.STATUS, 
							  A.DATAINICIAL, 
							  A.DATAFINAL, 
							  A.GARANTIA, 
							  A.DESCRICAO, 
							  A.DEFEITO, 
							  A.OBERVACOES, 
							  A.LAUDOTECNICO, 
							  A.DATAHORA, 
							  A.PROTOCOLO, 
							  B.NOME CLIENTEOS,
							  B.HANDLE HANDLECLIENTEOS,
							  C.NOME TECNICOOS,
							  C.HANDLE HANDLETECNICOOS,
							  D.PLACA VEICULO,
							  D.HANDLE HANDLEVEICULO,
							  A.FOTO,
							  A.KMVEICULO,
							  A.FORMAPAGAMENTO
							  FROM of_os A
							  LEFT JOIN ms_pessoa B ON B.HANDLE = A.CLIENTE
							  LEFT JOIN ms_pessoa C ON C.HANDLE = A.TECNICO
							  LEFT JOIN ms_veiculos D ON D.HANDLE = A.VEICULO
							  WHERE A.HANDLE = '".$handleOS."'
							 ");
$queryOS->execute();

$rowOS = $queryOS->fetch(PDO::FETCH_ASSOC);

	  $statusOS = $rowOS['STATUS']; 
	  $dataInicialOS = date('Y-m-d', strtotime($rowOS['DATAINICIAL']));
	  $dataFinalOS = date('Y-m-d', strtotime($rowOS['DATAFINAL'])); 
	  $garantiaOS = $rowOS['GARANTIA'];
	  $descricaoOS = $rowOS['DESCRICAO']; 
	  $defeitoOS = $rowOS['DEFEITO'];
	  $observacoesOS = $rowOS['OBERVACOES']; 
	  $laudoTecnicoOS = $rowOS['LAUDOTECNICO']; 
	  $dataHoraOS = date('d/m/Y H:i:s', strtotime($rowOS['DATAHORA'])); 
	  $protocoloOS = $rowOS['PROTOCOLO']; 
	  $clienteOS = $rowOS['CLIENTEOS']; 
	  $tecnicoOS = $rowOS['TECNICOOS']; 
	  $veiculoOS = $rowOS['VEICULO'];	
	  $handleClienteOS = $rowOS['HANDLECLIENTEOS']; 
	  $handleTecnicoOS = $rowOS['HANDLETECNICOOS']; 
	  $handleVeiculoOS = $rowOS['HANDLEVEICULO'];	
	  $fotoOS = $rowOS['FOTO'];
	  $kmVeiculoOS = $rowOS['KMVEICULO'];
	  $formaPagamentoOS = $rowOS['FORMAPAGAMENTO'];
?>
	<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-wrench"></i> Ordem de serviço #<?php echo $protocoloOS; ?>
    </div>
   	<div class="row w3-res-tb">
   		<div class="col-sm-12 m-b-xs">
   			<a href="index.php?p=oficinaOrdensDeServico"><button class="btn btn-default" type="button"><i class="fa fa-arrow-left"></i> Listar Ordens de Serviço</button></a>
   			
   			<a href="model/oficina/oficinaOrdensDeServicoImprimir.php?h=<?php echo $handleOS; ?>" target="_blank"><button class="btn btn-primary" type="button"><i class="fa fa-print"></i> Imprimir OS</button></a>
		</div>
		<!-- Start retorno -->
		<?php
			include('model/estrutura/retorno.php');
			include('model/estrutura/excluir.php');
		?>
		<!-- End retorno //-->
   	</div>
    <div class="row w3-res-tb">
      <ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#os" aria-controls="os" role="tab" data-toggle="tab">OS</a></li>
		<li role="presentation"><a href="#servicos" aria-controls="servicos" role="tab" data-toggle="tab">Serviços</a></li>
		<li role="presentation"><a href="#produtos" aria-controls="produtos" role="tab" data-toggle="tab">Produtos</a></li>
		<li role="presentation"><a href="#anexos" aria-controls="anexos" role="tab" data-toggle="tab">Anexos</a></li>
	  </ul>
      <div class="tab-content">
      	<div role="tabpanel" class="tab-pane active" id="os">
			<form action="#" id="oficinaOrdensDeServicoEditar" method="post" enctype="multipart/form-data">
			<p><br></p>
			  <div class="col-sm-1 m-b-xs">
				<label>Código</label>      
				<input type="text" name="codigo" class="form-control" value="<?php echo $handleOS; ?>" disabled>
			  </div>
			  <div class="col-sm-5 m-b-xs">
				<label>Ciente <font color="#FF0004">*</font></label>   
				<input type="text" name="clienteNome" id="cliente" value="<?php echo $clienteOS; ?>" class="form-control" required>
				<input type="text" name="cliente" value="<?php echo $handleClienteOS; ?>" id="clienteHandle" class="form-control" hidden="true" style="display: none">   
			  </div>
			  <div class="col-sm-2 m-b-xs">
				<label>Veículo <font color="#FF0004">*</font></label>     
				<input type="text" name="veiculoNome" id="veiculo" value="<?php echo $veiculoOS; ?>" class="form-control" required disabled>
				<input type="text" value="<?php echo $handleVeiculoOS; ?>" name="veiculo" id="veiculoHandle" class="form-control" hidden="true" style="display: none">    
			  </div>
			  <div class="col-sm-2 m-b-xs">	  	
				<label>KM</label>
				<input type="text" name="kmVeiculo" id="kmVeiculo" value="<?php echo $kmVeiculoOS; ?>" class="form-control">
			  </div>
			  <div class="col-sm-2 m-b-xs">
				<label>Técnico <font color="#FF0004">*</font></label>      
				<select name="tecnico" id="tecnico" class="form-control" required>
					<option value="<?php echo $handleTecnicoOS; ?>"><?php echo $tecnicoOS; ?></option>
					<?php
						$queryTecnico = $connect->prepare("SELECT HANDLE, NOME, CPFCNPJ FROM ms_pessoa WHERE EHTECNICO = 'S' AND HANDLE <> '".$handleTecnicoOS."'");

					$queryTecnico->execute();

					while($rowTecnico = $queryTecnico->fetch(PDO::FETCH_ASSOC)){
					?>
					<option value="<?php echo $rowTecnico['HANDLE']; ?>"><?php echo $rowTecnico['NOME']; ?></option>
					<?php
					}
					?>
				</select>
			  </div>
			  <div class="col-sm-3 m-b-xs">
				<label>Status <font color="#FF0004">*</font></label>      
				<select name="status" id="status" class="form-control" required>
					<option value="<?php echo $statusOS; ?>"><?php echo $statusOS; ?></option>
					<option value="Orçamento">Orçamento</option>
					<option value="Em andamento">Em andamento</option>
					<option value="Finalizado">Finalizado</option>
					<option value="Cancelado">Cancelado</option>
				</select>
			  </div>
			  <div class="col-sm-3 m-b-xs">
				<label>Data inicial</label>      
				<input type="date" class="form-control" name="dataInicial" id="dataInicial" value="<?php echo $dataInicialOS; ?>">
			  </div>
			  <div class="col-sm-3 m-b-xs">
				<label>Data Final</label>      
				<input type="date" class="form-control" name="dataFinal" id="dataFinal" value="<?php echo $dataFinalOS; ?>">
			  </div>
			  <div class="col-sm-3 m-b-xs">
				<label>Garantia</label>      
				<input type="text" class="form-control" name="garantia" id="garantia" value="<?php echo $garantiaOS; ?>">
			  </div>
			  <div class="col-sm-3 m-b-xs">
				<label>Forma de pagamento </label>      
				<select name="formaPagamento" id="formaPagamento" class="form-control">
					<option value="<?php echo $formaPagamentoOS; ?>"><?php echo $formaPagamentoOS; ?></option>
					<?php
						$queryFormaPagamento = $connect->prepare("SELECT * FROM ms_formapagamento WHERE FORMAPAGAMENTO <> '".$formaPagamentoOS."'");
						$queryFormaPagamento->execute();

						while($rowFormaPagamento = $queryFormaPagamento->fetch(PDO::FETCH_ASSOC)){
					?>
						<option value="<?php echo $rowFormaPagamento['FORMAPAGAMENTO']; ?>"><?php echo $rowFormaPagamento['FORMAPAGAMENTO']; ?></option>
					<?php
						}
					?>
				</select>
			  </div>
			  <div class="col-sm-10 m-b-xs">
					<label>Foto</label>      
					<input type="file" id="foto" name="foto" class="form-control">
			  </div>
			  <div class="col-sm-2 m-b-xs">
				<a href="view/tecnologia/uploads/oficina/os/<?php echo $fotoOS; ?>" target="_blank">
					<img src="view/tecnologia/uploads/oficina/os/<?php echo $fotoOS; ?>" class="img-responsive thumbnail" alt="">
				</a>
			  </div>
			  <div class="col-sm-6 m-b-xs">
					<label>Descrição Produto/Serviço </label>      
				  <textarea type="text" id="descricao" rows="8" name="descricao" class="form-control"><?php echo $descricaoOS; ?></textarea>
			  </div>
			  <div class="col-sm-6 m-b-xs">
					<label>Defeito </label>      
				  <textarea type="text" id="defeito" rows="8" name="defeito" class="form-control"><?php echo $defeitoOS; ?></textarea>
			  </div>
			  <div class="col-sm-6 m-b-xs">
					<label>Observações </label>      
				  <textarea type="text" id="obs" rows="8" name="obs" class="form-control"><?php echo $observacoesOS; ?></textarea>
			  </div>
			  <div class="col-sm-6 m-b-xs">
					<label>Laudo Técnico </label>      
				  <textarea type="text" id="laudoTecnico" rows="8" name="laudoTecnico" class="form-control"><?php echo $laudoTecnicoOS; ?></textarea>
			  </div>
			  
			  <div class="col-sm-12 m-b-xs">
			  	<button type="submit" class="btn btn-success right-stat-bar floatRight">Gravar</button>
			  </div>
		  </form>
	  </div><!-- end tabPanel OS -->
	  <div role="tabpanel" class="tab-pane" id="servicos">
	  <p><br></p>
	  	<form action="#" id="oficinaOrdensDeServicoInserirServico" method="post" enctype="multipart/form-data">
	  		<div class="col-sm-5 m-b-xs">
	  			<label for="">Serviço <font color="#FF0004">*</font></label>
	  			<input type="text" class="form-control pulaCampoEnter" name="nomeServico" id="nomeServico" required>
			</div>
    		<div class="col-sm-3 m-b-xs">
	  			<label for="">Quantidade <font color="#FF0004">*</font></label>
	  			<input type="text" class="form-control pulaCampoEnter" name="quantidadeServico" id="quantidadeServico" required>
			</div> 
    		<div class="col-sm-3 m-b-xs">
	  			<label for="">Valor R$<font color="#FF0004">*</font></label>
	  			<input type="text" class="form-control moeda pulaCampoEnter" name="valorServico" id="valorServico" required>
			</div>
    		<div class="col-sm-1 m-b-xs">
	  			<p><br>	</p>
	  			<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
			</div>
	    </form>
	    <div class="row">
	    	<div class="col-sm-12 m-b-xs">
				<table class="table table-striped table-responsive">
					<thead>
						<th>Serviço</th>
						<th>Quantidade</th>
						<th>Valor</th>
						<th>Valor Total</th>
						<th><i class="fa fa-cogs"></i></th>
					</thead>
					<tbody id="tBodyTableServicos"></tbody>
					<tbody>
						<?php
							$queryServicos = $connect->prepare("SELECT * FROM `of_os_servicos` WHERE `OS` = '".$handleOS."'");
			
							$queryServicos->execute();

							while($rowServicos = $queryServicos->fetch(PDO::FETCH_ASSOC)){
						?>
							<tr>
								<td><?php echo $rowServicos['SERVICO']; ?></td>
								<td><?php echo $rowServicos['QUANTIDADE']; ?></td>
								<td><?php echo @number_format($rowServicos['VALOR'], 2, ',', '.'); ?></td>
								<td><?php echo @number_format($rowServicos['VALORTOTAL'], 2, ',', '.'); ?></td>
								<td>
									<button id="<?php echo $rowServicos['HANDLE']; ?>" type="button" class="btn btn-default excluirServico">
										<i class="fa fa-times text-danger text"></i>
									</a>
								</td>
							</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
	    </div>
	  </div><!-- end tabPanel servicos -->
	  <div role="tabpanel" class="tab-pane" id="produtos">
		<p><br></p>
	  	<form action="#" id="oficinaOrdensDeServicoInserirProdutos" method="post" enctype="multipart/form-data">
	  		<div class="col-sm-5 m-b-xs">
	  			<label for="">Produto <font color="#FF0004">*</font></label>
	  			<input type="text" class="form-control pulaCampoEnter" name="nomeProduto" id="nomeProduto" required>
			</div>
    		<div class="col-sm-3 m-b-xs">
	  			<label for="">Quantidade <font color="#FF0004">*</font></label>
	  			<input type="text" class="form-control pulaCampoEnter" name="quantidadeProduto" id="quantidadeProduto" required>
			</div> 
    		<div class="col-sm-3 m-b-xs">
	  			<label for="">Valor R$<font color="#FF0004">*</font></label>
	  			<input type="text" class="form-control moeda pulaCampoEnter" name="valorProduto" id="valorProduto" required>
			</div>
    		<div class="col-sm-1 m-b-xs">
	  			<p><br>	</p>
	  			<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
			</div>
	    </form>
	    <div class="row">
	    	<div class="col-sm-12 m-b-xs">
				<table class="table table-striped table-responsive">
					<thead>
						<th>Produto</th>
						<th>Quantidade</th>
						<th>Valor</th>
						<th>Valor Total</th>
					</thead>
					<tbody id="tBodyTableProdutos">
						<?php
							$queryProdutos = $connect->prepare("SELECT * FROM `of_os_produtos` WHERE `OS` = '".$handleOS."'");
			
							$queryProdutos->execute();

							while($rowProdutos = $queryProdutos->fetch(PDO::FETCH_ASSOC)){
						?>
							<tr>
								<td><?php echo $rowProdutos['PRODUTO']; ?></td>
								<td><?php echo $rowProdutos['QUANTIDADE']; ?></td>
								<td><?php echo @number_format($rowProdutos['VALOR'], 2, ',', '.'); ?></td>
								<td><?php echo @number_format($rowProdutos['VALORTOTAL'], 2, ',', '.'); ?></td>
								<td>
									<button id="<?php echo $rowProdutos['HANDLE']; ?>" type="button" class="btn btn-default excluirProduto">
										<i class="fa fa-times text-danger text"></i>
									</a>
								</td>
								</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
	    </div>
	  </div><!-- end tabPanel produtos -->
	  <div role="tabpanel" class="tab-pane" id="anexos">
	  		<p><br></p>
	  	<form action="#" id="oficinaOrdensDeServicoInserirAnexos" method="post" enctype="multipart/form-data">
	  		<div class="col-sm-5 m-b-xs">
	  			<label for="">Anexo <font color="#FF0004">*</font></label>
	  			<input type="file" class="form-control" name="anexo" id="anexo" required>
			</div>
    		<div class="col-sm-1 m-b-xs">
	  			<p><br>	</p>
	  			<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
			</div>
	    </form>
	    <div class="row">
	    	<div class="col-sm-12 m-b-xs">
	    	<table class="table table-striped table-responsive">
				<thead>
					<th>Nome</th>
					<th>Data</th>
					<th><i class="fa fa-cogs"></i></th>
				</thead>
				<tbody id="tBodyTableAnexos">
	    		<?php
					$queryAnexos = $connect->prepare("SELECT * FROM `of_os_anexos` WHERE `OS` = '".$handleOS."'");

					$queryAnexos->execute();

					while($rowAnexos = $queryAnexos->fetch(PDO::FETCH_ASSOC)){
						
				?>
					<tr>
						<td><?php echo $rowAnexos['NOMEARQUIVO']; ?></td>
						<td><?php echo date('d/m/Y H:i', strtotime($rowAnexos['DATAHORA'])); ?></td>
						<td>
							<a href="#">
								<i id="<?php echo $rowAnexos['HANDLE']; ?>" class="fa fa-times text-danger text  excluirAnexo"></i>
							</a>
							&nbsp; &nbsp; &nbsp; 
							<a href="view/tecnologia/uploads/oficina/os/<?php echo $rowAnexos['ARQUIVO']; ?>" target="_blank">
								<i id="<?php echo $rowAnexos['HANDLE']; ?>" class="fa fa-eye text-primary text"></i>
							</a>
						</td>
					</tr>
				<?php
					}
				?>
				</tbody>
			</table>
			</div>
	    </div>
	  </div><!-- end tabPanel anexos -->
	</div><!-- end tabContent -->
    </div>
  </div>
</div>
</section>
<!-- Include js scripts for page -->
<script src="view/tecnologia/js/jquery.maskedinput.js"></script>
<script>
	
$(document).ready(function(){
	//CKEDITOR.replace( 'obs' );
	
	//pula campos usando enter
	$('.pulaCampoEnter').keypress(function(e){

	   var tecla = (e.keyCode?e.keyCode:e.which);

	   if(tecla == 13){
		   /* guarda o seletor do campo onde foi pressionado Enter */
		   campo =  $('.pulaCampoEnter');
		   /* pega o indice do elemento*/
		   indice = campo.index(this);
		   /*soma mais um ao indice e verifica se não é null
			*se não for é porque existe outro elemento
		   */
		  if(campo[indice+1] != null){
			 /* adiciona mais 1 no valor do indice */
			 proximo = campo[indice + 1];
			 /* passa o foco para o proximo elemento */
			 proximo.focus();
		  }else{
			return true;
		  }
	   }
	   if(tecla == 13){
		/* impede o submit caso esteja dentro de um form */
			e.preventDefault(e);
			return false;
		}else{
			/* se não for tecla enter deixa escrever */
			return true;
		}
	})
	
	jQuery('#oficinaOrdensDeServicoEditar').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dados = jQuery( this ).serialize();
		jQuery.ajax({
			type: "POST",
			url: "controller/oficina/oficinaOrdensDeServicoEditar.php?h=<?php echo $handleOS; ?>",
			//dataType : 'json', 
			data: new FormData( this ),
			processData: false,
			contentType: false,    
			success: function( data ) {
					var json = jQuery.parseJSON(data);
					$('#retorno').modal('show');
					$('#retorno-body').html(json.retorno);
			}
		});
		return false;
	});//end Editar OS
	
	
	jQuery('#oficinaOrdensDeServicoInserirServico').submit(function(){
				
		var dados = jQuery( this ).serialize();
		jQuery.ajax({
			type: "POST",
			url: "controller/oficina/oficinaOrdensDeServicoInserirServico.php?h=<?php echo $handleOS; ?>",
			//dataType : 'json', 
			data: new FormData( this ),
			processData: false,
			contentType: false,    
			success: function( data ) {
					var json = jQuery.parseJSON(data);
					
					if(json.sucesso === 'S'){
						
						$("#nomeServico").val('');
						$("#quantidadeServico").val('');
						$("#valorServico").val('');
						
						$('#tBodyTableServicos').append( '<tr><td>'+ json.servico +'</td><td>' + json.quantidade +'</td><td>' + json.valor +'</td><td>' + json.valorTotal +'</td><td><button type="button" id="'+ json.handleServico +'" class="btn btn-warning excluirServico testeclass"><i  class="fa fa-times text-danger text"></i></button></td></tr>');
					}
					else{
						$('#retorno').modal('show');
						$('#retorno-body').html(json.retorno);
					}
			}
		});
		return false;
	});//end Inserir Servico OS
	
	$('.excluirServico').click(function(){
		
		$('#excluirModal').modal('show');
		var idServico = this.id;
		
		$('#confirmarExcluir').click(function(){
			
			$('#excluirModal').modal('hide');
			jQuery.ajax({
				type: "POST",
				url: "controller/oficina/oficinaOrdensDeServicoExcluirServico.php",				
				data: { "handleServico":idServico },
				success: function( data ) {
					
						var json = $.parseJSON(data);
						$('#retorno').modal('show');
						$('#retorno-body').html(json.retorno);
					
					$('#retornoOk').click(function(){
						location.reload();
					});
				}
			});
			return false;
		});
	});//excluirServico  click
	
	
	jQuery('#oficinaOrdensDeServicoInserirProdutos').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dados = jQuery( this ).serialize();
		jQuery.ajax({
			type: "POST",
			url: "controller/oficina/oficinaOrdensDeServicoInserirProdutos.php?h=<?php echo $handleOS; ?>",
			//dataType : 'json', 
			data: new FormData( this ),
			processData: false,
			contentType: false,    
			success: function( data ) {
					var json = jQuery.parseJSON(data);
					
					if(json.sucesso === 'S'){
						
						$("#nomeProduto").val('');
						$("#quantidadeProduto").val('');
						$("#valorProduto").val('');
						
						$('#tBodyTableProdutos').append('<tr><td>'+ json.produto +'</td><td>' + json.quantidade +'</td><td>' + json.valor +'</td><td>' + parseFloat(json.valorTotal).toFixed(2) +'</td><td><button type="button" class="btn btn-default excluirProduto" id="'+ json.handleProduto +'"><i class="fa fa-times text-danger text"></i></button></td></tr>');
					}
					else{
						$('#retorno').modal('show');
						$('#retorno-body').html(json.retorno);
					}
			}
		});
		return false;
	});//end Inserir Produto OS
	
	$('.excluirProduto').click(function(){
		
		$('#excluirModal').modal('show');
		var idProduto = this.id;
		
		$('#confirmarExcluir').click(function(){
			
			$('#excluirModal').modal('hide');
			jQuery.ajax({
				type: "POST",
				url: "controller/oficina/oficinaOrdensDeServicoExcluirProdutos.php",				
				data: { "handleProduto":idProduto },
				success: function( data ) {
					
						var json = $.parseJSON(data);
						$('#retorno').modal('show');
						$('#retorno-body').html(json.retorno);
					
					$('#retornoOk').click(function(){
						location.reload();
					});
				}
			});
			return false;
		});
	});//excluir Produto  click
	
	
	
	jQuery('#oficinaOrdensDeServicoInserirAnexos').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dados = jQuery( this ).serialize();
		jQuery.ajax({
			type: "POST",
			url: "controller/oficina/oficinaOrdensDeServicoInserirAnexos.php?h=<?php echo $handleOS; ?>",
			data: new FormData( this ),
			processData: false,
			contentType: false,    
			success: function( data ) {
					var json = jQuery.parseJSON(data);
					
					if(json.sucesso === 'S'){
						$('#tBodyTableAnexos').html($('#tBodyTableAnexos').html() + '<tr><td>'+ json.nomeArquivo +'</td><td>' + json.data +'</td><td><button type="button" class="btn btn-default excluirAnexo" id="'+ json.handleAnexo +'"><i class="fa fa-times text-danger text "></i></button></td></tr>');
					}
					else{
						$('#retorno').modal('show');
						$('#retorno-body').html(json.retorno);
					}
			}
		});
		return false;
	});//end Inserir Anexos OS
	
	$('.excluirAnexo').click(function(){
		
		$('#excluirModal').modal('show');
		var idAnexo = this.id;
		
		$('#confirmarExcluir').click(function(){
			
			$('#excluirModal').modal('hide');
			jQuery.ajax({
				type: "POST",
				url: "controller/oficina/oficinaOrdensDeServicoExcluirAnexos.php",				
				data: { "handleAnexo":idAnexo },
				success: function( data ) {
					
						var json = $.parseJSON(data);
						$('#retorno').modal('show');
						$('#retorno-body').html(json.retorno);
					
					$('#retornoOk').click(function(){
						location.reload();
					});
				}
			});
			return false;
		});
	});//excluir Produto  click
	
	
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
	
	
	
var input = document.getElementById('valorProduto');

input.onfocus = function(){
    if (!input.value)
        input.value = '0.00';
};

input.onblur = function(){
    if (this.value == '0.00')
        this.value = '0.00';
};

input.onkeyup = function() {
    var value = this.value.replace(/\./g, ''); // Remove ponto
    
    // Remove todos os zeros à esquerda
    while (1) {
        if (value[0] == '0')
            value = value.substr(1);
        else
            break;
    }
    
    // Se o número não tiver tamannho 3 insere zeros à esquerda
    while (1) {
        if (value.length < 3)
            value = '0' + value;
        else
            break;
    }
    
    var result = value.substr(0, value.length - 2);
    result += '.' + value.substr(value.length - 2);
    this.value = result;
};
	
var input = document.getElementById('valorServico');

input.onfocus = function(){
    if (!input.value)
        input.value = '0.00';
};

input.onblur = function(){
    if (this.value == '0.00')
        this.value = '0.00';
};

input.onkeyup = function() {
    var value = this.value.replace(/\./g, ''); // Remove ponto
    
    // Remove todos os zeros à esquerda
    while (1) {
        if (value[0] == '0')
            value = value.substr(1);
        else
            break;
    }
    
    // Se o número não tiver tamannho 3 insere zeros à esquerda
    while (1) {
        if (value.length < 3)
            value = '0' + value;
        else
            break;
    }
    
    var result = value.substr(0, value.length - 2);
    result += '.' + value.substr(value.length - 2);
    this.value = result;
};
	
</script>