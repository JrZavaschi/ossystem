<?php
$handleProduto = Sistema::getGet('h');
$queryProduto = $connect->prepare("SELECT A.HANDLE, 
											   A.NOME, 
											   A.VALORCUSTO, 
											   A.VALORVENDA, 
											   A.MARGEMLUCRO, 
											   A.QUANTIDADE, 
											   A.UNIDADEMEDIDA, 
											   A.ATIVO,
											   A.CODIGOREFERENCIA, 
											   A.EHKIT, 
											   A.DATAHORA,
											   A.FOTO,
											   A.OBS
											   FROM `re_produto` A
											   WHERE A.HANDLE = '".$handleProduto."'
											   ");
$queryProduto->execute();
$rowProduto = $queryProduto->FETCH(PDO::FETCH_ASSOC);

$handleProduto = $rowProduto['HANDLE'];
$nomeProduto = $rowProduto['NOME'];
$valorCustoProduto = $rowProduto['VALORCUSTO'];
$valorVendaProduto = $rowProduto['VALORVENDA'];
$margemLucroProduto = $rowProduto['MARGEMLUCRO'];
$quantidadeProduto = $rowProduto['QUANTIDADE'];
$unidadeMedidaProduto = $rowProduto['UNIDADEMEDIDA'];
$ativoProduto = $rowProduto['ATIVO'];
$codigoReferenciaProduto = $rowProduto['CODIGOREFERENCIA'];
$ehKitProduto = $rowProduto['EHKIT'];
$dataHoraProduto = date('d/m/Y', strtotime($rowProduto['DATAHORA']));
$fotoProduto = $rowProduto['FOTO'];
$observacaoProduto = $rowProduto['OBS'];

if($ativoProduto == 'S'){
	$statusProduto = 'checked';
}
else{
	$statusProduto = '';
}

?>
<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-archive"></i> Inserir produto
    </div>
    
    <form action="#" id="cadastroProdutoEditar" method="post" enctype="multipart/form-data">
   	<div class="row w3-res-tb">
   		<div class="col-sm-12 m-b-xs">
   			<a href="index.php?p=cadastroProduto">
   				<button class="btn btn-default" type="button"><i class="fa fa-arrow-left"></i> Listar produtos</button>
   			</a>
			<input type="checkbox" id="ativo" value="true" name="ativo" data-onstyle="info" <?php echo $statusProduto; ?>>
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
        <input type="text" name="codigo" value="<?php echo $handleProduto; ?>" class="form-control" disabled>
      </div>
      <div class="col-sm-3 m-b-xs">
		<label>Cód. referência </label>      
		<input type="text" name="codigoReferencia" id="codigoReferencia" value="<?php echo $codigoReferenciaProduto; ?>" class="form-control" >
	  </div>
	  <div class="col-sm-8 m-b-xs">
		<label>Nome <font color="#FF0004">*</font></label>      
		<input type="text" name="nome" id="nome" value="<?php echo $nomeProduto; ?>" class="form-control" required>
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>Valor custo</label>      
		<input type="text" name="valorCusto" id="valorCusto" value="<?php echo $valorCustoProduto; ?>" class="form-control">
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>Valor venda</label>      
		<input type="text" name="valorVenda" id="valorVenda" value="<?php echo $valorVendaProduto; ?>" class="form-control">
	  </div>
	  <div class="col-sm-2 m-b-xs">
		<label>Margem de lucro </label>      
		<input type="text" id="margemLucro" name="margemLucro" value="<?php echo $margemLucroProduto; ?>" class="form-control">
	  </div>
      <div class="col-sm-2 m-b-xs">
		<label>Quantidade </label>      
		<input type="text" id="quantidade" name="quantidade" value="<?php echo $quantidadeProduto; ?>" class="form-control">
	  </div>
      <div class="col-sm-2 m-b-xs">
		<label>Unidade medida </label>      
		<input type="text" id="unidadeMedida" name="unidadeMedida" value="<?php echo $unidadeMedidaProduto; ?>" class="form-control">
	  </div>
	  <div class="col-sm-6 m-b-xs">
			<label>Foto</label>      
			<input type="file" id="foto" name="foto" class="form-control">
	  </div>
	  <div class="col-sm-6 m-b-xs">
			<img src="view/tecnologia/uploads/restaurante/produto/<?php echo $fotoProduto; ?>" class="img-responsive thumbnail" width="200px" height="auto" alt="">
	  </div>
	  <div class="col-sm-12 m-b-xs">
			<label>Observações</label>      
		  <textarea type="text" id="obs" name="obs" class="form-control"><?php echo $observacaoProduto; ?></textarea>
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
	
	$('#toggle-on').click(function() {
    	$('#ativo').prop('checked', 'true');
	});
	$('#toggle-off').click(function() {
    	$('#ativo').prop('checked', 'true');
	});

	jQuery('#cadastroProdutoEditar').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
				
		var dados = jQuery( this ).serialize();
		
		jQuery.ajax({
			type: "POST",
			url: "controller/cadastro/cadastroProdutoEditar.php?h=<?php echo $handleProduto; ?>",
			//dataType : 'json', 
			data: new FormData( this ),
			processData: false,
			contentType: false,       
			success: function( data ) {
				//console.log(data);
					var json = jQuery.parseJSON(data);
					$('#retorno').modal('show');
					$('#retorno-body').html(json.retorno);
				
				Pace.stop;
			},
			error: function(xhr, ajaxOptions, thrownError) {
			   console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
		return false;
	});
});

</script>