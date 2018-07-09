<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-money"></i><i class="fa fa-plus"></i> Inserir tabela de preço
    </div>
    
    <form action="#" id="cadastroTabelaPrecoInserir" method="post" enctype="multipart/form-data">
   	<div class="row w3-res-tb">
   		<div class="col-sm-12 m-b-xs">
   			<a href="index.php?p=cadastroTabelaPreco">
   				<button class="btn btn-default" type="button"><i class="fa fa-arrow-left"></i> Listar tabelas de preço</button>
   			</a>
			<input type="checkbox" id="ativo" name="ativo" data-onstyle="info" checked>
			<input type="checkbox" id="promocao" name="promocao" data-onstyle="danger">
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
      <div class="col-sm-3 m-b-xs">
		<label>Categoria <font color="#FF0004">*</font></label>      
		<select name="categoria" id="categoria" class="form-control" required>
			<option value="">-- Selecione --</option>
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
		<input type="text" name="nome" id="nome" class="form-control" required>
	  </div>
	  <div class="col-sm-1 m-b-xs">
		<label>Sabores <font color="#FF0004">*</font></label><br>      
		  <input type="number" name="quantidadecardapio" id="quantidadecardapio" class="form-control" required>
	  </div>
	  <div class="col-sm-2 m-b-xs">
		<label>Valor <font color="#FF0004">*</font></label><br>      
		  <input type="text" name="valor" id="valor" class="form-control" required>
	  </div>
	  <div class="col-sm-2 m-b-xs">
		<label>Pontos</label><br>      
		  <input type="text" name="pontos" id="pontos" class="form-control">
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
	
	$('#promocao').bootstrapToggle({
      on: 'Promoção On',
      off: 'Promoção Off'
    });
	
	jQuery('#cadastroTabelaPrecoInserir').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dados = jQuery( this ).serialize();

		jQuery.ajax({
			type: "POST",
			url: "controller/cadastro/cadastroTabelaPrecoInserir.php",
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
						setTimeout(function(){location.href='index.php?p=cadastroTabelaPrecoEditar&h='+json.handleTabelaPreco} , 3000);
					}
			}
		});
		return false;
	});
});
</script>