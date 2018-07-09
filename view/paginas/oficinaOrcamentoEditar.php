<?php
$handleOC = $_GET['h'];
$queryOC = $connect->prepare("SELECT * FROM of_orcamento WHERE HANDLE = '".$handleOC."'");
			
			$queryOC->execute();
			
			$rowOC = $queryOC->fetch(PDO::FETCH_ASSOC);
				  $handleOC = $rowOC['HANDLE'];
				  $garantiaOC = $rowOC['GARANTIA']; 
				  $clienteOC = $rowOC['CLIENTE'];
				  $logradouroOC = $rowOC['LOGRADOURO'];
				  $numeroOC = $rowOC['NUMERO'];
				  $bairroOC = $rowOC['BAIRRO'];
				  $cidadeOC = $rowOC['CIDADE'];
				  $telefoneOC = $rowOC['TELEFONE'];
				  $placaOC = $rowOC['PLACA'];
				  $marcaOC = $rowOC['MARCA'];
				  $modeloOC = $rowOC['MODELO'];
				  $corOC = $rowOC['COR']; 
				  $anoOC = $rowOC['ANO'];
				  $anomodeloOC = $rowOC['ANOMODELO'];
				  $valorTotalOC = $rowOC['VALORTOTAL']; 
				  $valorTotalProdutosOC = $rowOC['VALORTOTALPRODUTOS']; 
				  $valorTotalServicosOC = $rowOC['VALORTOTALSERVICOS']; 
				  $validadeOC = $rowOC['VALIDADE']; 
				  $observacoesOC = $rowOC['OBSERVACAO']; 
				  $descricaoOC = $rowOC['DESCRICAO'];
				  $dataHoraOC = date('d/m/Y H:i:s', strtotime($rowOC['DATAHORA'])); 
?>
	<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-wrench"></i> Orçamento #<?php echo $handleOC; ?>
    </div>
    <form action="#" id="oficinaOrcamentoEditar" method="post" enctype="multipart/form-data">
   	<div class="row w3-res-tb">
   		<div class="col-sm-12 m-b-xs">
   			<a href="index.php?p=oficinaOrcamento"><button class="btn btn-default" type="button"><i class="fa fa-arrow-left"></i> Listar Orçamentos</button></a>
   			
   			<a href="model/oficina/oficinaOrcamentoImprimir.php?h=<?php echo $handleOC; ?>" target="_blank"><button class="btn btn-primary" type="button"><i class="fa fa-print"></i> Imprimir Orçamento</button></a>
		</div>
		<!-- Start retorno -->
		<?php
			include('model/estrutura/retorno.php');
			include('model/estrutura/retornoConfirm.php');
			include('model/estrutura/excluir.php');
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
		<input type="text" name="cliente" id="cliente" class="form-control" value="<?php echo $clienteOC; ?>">
	  </div>
	  <div class="col-sm-2 m-b-xs">
		<label>Veículo <font color="#FF0004">*</font></label>     
		<input type="text" name="placa" id="placa" class="form-control" value="<?php echo $placaOC; ?>">
	  </div>
	  <div class="col-sm-2 m-b-xs">	  	
		<label>Marca</label>
		<input type="text" name="marca" id="marca" class="form-control" value="<?php echo $marcaOC; ?>">
	  </div>
	  <div class="col-sm-2 m-b-xs">	  	
		<label>Modelo</label>
		<input type="text" name="modelo" id="modelo" class="form-control" value="<?php echo $modeloOC; ?>">
	  </div>
	  <div class="col-sm-2 m-b-xs">	  	
		<label>Ano</label>
		<input type="text" name="ano" id="ano" class="form-control" value="<?php echo $anoOC; ?>">
	  </div>
	  <div class="col-sm-2 m-b-xs">	  	
		<label>Ano Modelo</label>
		<input type="text" name="anomodelo" id="anomodelo" class="form-control" value="<?php echo $anomodeloOC; ?>">
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>Garantia</label>      
		<input type="text" class="form-control" name="garantia" id="garantia" value="<?php echo $garantiaOC; ?>">
	  </div>
	  <div class="col-sm-5 m-b-xs">
			<label>Foto</label>      
			<input type="file" id="foto" name="foto" class="form-control">
	  </div>
	  <div class="col-sm-12 m-b-xs">
			<label>Descrição Produto/Serviço - Valores <font color="#FF0004">*</font></label>      
		  <textarea type="text" id="descricao" rows="8" name="descricao" class="form-control"><?php echo $descricaoOC; ?></textarea>
	  </div>
	  <div class="col-sm-12 m-b-xs">
			<label>Observações <font color="#FF0004">*</font></label>      
		  <textarea type="text" id="obs" rows="8" name="obs" class="form-control"><?php echo $observacoesOC; ?></textarea>
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
	
$(document).ready(function(){
	
	CKEDITOR.replace( 'obs' );
	CKEDITOR.replace( 'descricao' );
	
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
	
	jQuery('#oficinaOrcamentoEditar').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dados = jQuery( this ).serialize();
		jQuery.ajax({
			type: "POST",
			url: "controller/oficina/oficinaOrcamentoEditar.php?h=<?php echo $handleOC; ?>",
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
	
	
	
});
	
</script>