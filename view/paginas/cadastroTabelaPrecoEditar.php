<?php
$handleTabelaPreco = Sistema::getGet('h');
$queryTabelaPreco = $connect->prepare("SELECT A.`HANDLE`, 
									   A.`NOME`, 
									   A.`VALOR`, 
									   A.`DATAHORA`, 
									   A.`OBSERVACAO`, 
									   B.NOME CATEGORIA,
									   B.HANDLE HANDLECATEGORIA,
									   A.QUANTIDADECARDAPIO,
									   A.`ATIVO`,
									   A.PONTOS,
									   A.EHPROMOCAO
									   FROM `re_tabelapreco` A
									   LEFT JOIN re_cardapiocategoria B ON B.HANDLE = A.CATEGORIA
									   WHERE A.HANDLE = '".$handleTabelaPreco."'
									  ");

$queryTabelaPreco->execute();
$rowTabelaPreco = $queryTabelaPreco->FETCH(PDO::FETCH_ASSOC);

$handleTabelaPreco = $rowTabelaPreco['HANDLE'];
$nomeTabelaPreco = $rowTabelaPreco['NOME'];
$valorTabelaPreco = $rowTabelaPreco['VALOR'];
$observacaoTabelaPreco = $rowTabelaPreco['OBSERVACAO'];
$categoriaTabelaPreco = $rowTabelaPreco['CATEGORIA'];
$handleCategoriaTabelaPreco = $rowTabelaPreco['HANDLECATEGORIA'];
$ativoTabelaPreco = $rowTabelaPreco['ATIVO'];
$quantidadecardapio = $rowTabelaPreco['QUANTIDADECARDAPIO'];
$promocaoTabelaPreco = $rowTabelaPreco['EHPROMOCAO'];
$dataHoraTabelaPreco = date('d/m/Y', strtotime($rowTabelaPreco['DATAHORA']));
$pontosTabelaPreco = $rowTabelaPreco['PONTOS'];

if($ativoTabelaPreco == 'S'){
	$statusTabelaPreco = 'checked';
}
else{
	$statusTabelaPreco = '';
}

if($promocaoTabelaPreco == 'S'){
	$ehPromocao = 'checked';
}
else{
	$ehPromocao = '';
}
?>
<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-money"></i><i class="fa fa-pencil"></i> Editar tabela de preço
    </div>
    
    <form action="#" id="cadastroTabelaPrecoEditar" method="post" enctype="multipart/form-data">
   	<div class="row w3-res-tb">
   		<div class="col-sm-12 m-b-xs">
   			<a href="index.php?p=cadastroTabelaPreco">
   				<button class="btn btn-default" type="button"><i class="fa fa-arrow-left"></i> Listar tabelas de preço</button>
   			</a>
			<input type="checkbox" id="ativo" name="ativo" data-onstyle="info" <?php echo $statusTabelaPreco; ?> >
			<input type="checkbox" id="promocao" name="promocao" data-onstyle="danger" <?php echo $ehPromocao; ?> >
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
        <input type="text" name="codigo" value="<?php echo $handleTabelaPreco; ?>" class="form-control" disabled>
      </div>
      <div class="col-sm-3 m-b-xs">
		<label>Categoria <font color="#FF0004">*</font></label>      
		<select name="categoria" id="categoria" class="form-control">
			<option value="<?php echo $handleCategoriaTabelaPreco; ?>"><?php echo $categoriaTabelaPreco; ?></option>
			<?php
			if($ehrestauranteUsuario == 'S'){
				$queryCategoria = $connect->prepare("SELECT `HANDLE`, 
													 `NOME`, 
													 `DATAHORA`, 
													 `EHBEBIDA` 
													 FROM `re_cardapiocategoria` 
													 WHERE `RESTAURANTE` = '".$restauranteUsuario."'");
			}
			else{
				$queryCategoria = $connect->prepare("SELECT `HANDLE`,
													 `NOME`,
													 `DATAHORA`,
													 `EHBEBIDA`
													 FROM `re_cardapiocategoria`");
			}
				$queryCategoria->execute();
				while($rowCategoria = $queryCategoria->FETCH(PDO::FETCH_ASSOC)){

				$handleCategoria = $rowCategoria['HANDLE'];
				$nomeCategoria = $rowCategoria['NOME'];
			?>
			<option value="<?php echo $handleCategoria; ?>"><?php echo $nomeCategoria; ?></option>
			<?php
				}
			?>
		</select>
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>Nome <font color="#FF0004">*</font></label>      
		<input type="text" name="nome" id="nome" value="<?php echo $nomeTabelaPreco; ?>" class="form-control" required>
	  </div>
	  <div class="col-sm-1 m-b-xs">
		<label>Sabores <font color="#FF0004">*</font></label><br>      
		  <input type="number" value="<?php echo $quantidadecardapio; ?>" name="quantidadecardapio" id="quantidadecardapio" class="form-control" required>
	  </div>
	  <div class="col-sm-2 m-b-xs">
		<label>Valor <font color="#FF0004">*</font></label><br>      
		  <input type="text" name="valor" id="valor" value="<?php echo $valorTabelaPreco; ?>" class="form-control" required>
	  </div>
	  <div class="col-sm-2 m-b-xs">
		<label>Pontos</label><br>      
		  <input type="text" name="pontos" id="pontos" value="<?php echo $pontosTabelaPreco; ?>" class="form-control">
	  </div>
	  <div class="col-sm-12 m-b-xs">
		  <label>Observação</label>   
		  <textarea name="observacao" id="observacao" class="form-control" cols="30" rows="10"><?php echo $observacaoTabelaPreco; ?></textarea>
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
	
	for ( instance in CKEDITOR.instances )
    CKEDITOR.instances[instance].updateElement();
	
	CKEDITOR.replace( 'observacao' );
	
	$('#ativo').bootstrapToggle({
      on: 'Ativo',
      off: 'Inativo'
    });
	
	$('#promocao').bootstrapToggle({
      on: 'Promoção On',
      off: 'Promoção Off'
    });
	
	jQuery('#cadastroTabelaPrecoEditar').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dados = jQuery( this ).serialize();
		
		jQuery.ajax({
			type: "POST",
			url: "controller/cadastro/cadastroTabelaPrecoEditar.php?h=<?php echo $handleTabelaPreco;?>",
			//dataType : 'json', 
			data: new FormData( this ),
			//data: dados,
			processData: false,
			contentType: false,    
			success: function( data ) {
				//console.log(data);
					var json = jQuery.parseJSON(data);
					$('#retorno').modal('show');
					$('#retorno-body').html(json.retorno);
				
			}
		});
		return false;
	});
});
</script>