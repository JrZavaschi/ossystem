<?php
$handleTabelaPrecoEntrega = Sistema::getGet('h');
$queryTabelaPrecoEntrega = $connect->prepare("SELECT A.HANDLE, 
											  A.VALOR, 
											  B.CIDADE, 
											  B.HANDLE HANDLECIDADE,
											  C.SIGLA UF, 
											  C.HANDLE HANDLEUF,
											  D.NOME BAIRRO,
											  D.HANDLE HANDLEBAIRRO,
											  A.ATIVO,
											  A.DATAHORA,
											  A.OBSERVACAO
											  FROM `re_pedidoentregavalor` A
											  INNER JOIN ms_cidade B ON B.HANDLE = A.CIDADE
											  INNER JOIN ms_uf C ON C.HANDLE = B.UF
											  INNER JOIN ms_bairro D ON D.HANDLE = A.BAIRRO
											  WHERE A.`HANDLE` = '".$handleTabelaPrecoEntrega."'
											 ");

$queryTabelaPrecoEntrega->execute();
$rowTabelaPrecoEntrega = $queryTabelaPrecoEntrega->FETCH(PDO::FETCH_ASSOC);

$handleTabelaPrecoEntrega = $rowTabelaPrecoEntrega['HANDLE'];
$bairroTabelaPrecoEntrega = $rowTabelaPrecoEntrega['BAIRRO'];
$handleBairroTabelaPrecoEntrega = $rowTabelaPrecoEntrega['HANDLEBAIRRO'];
$valorTabelaPrecoEntrega = $rowTabelaPrecoEntrega['VALOR'];
$ativoTabelaPrecoEntrega = $rowTabelaPrecoEntrega['ATIVO'];
$cidadeTabelaPrecoEntrega = $rowTabelaPrecoEntrega['CIDADE'];
$handleCidadeTabelaPrecoEntrega = $rowTabelaPrecoEntrega['HANDLECIDADE'];
$ufTabelaPrecoEntrega = $rowTabelaPrecoEntrega['UF'];
$handleUfTabelaPrecoEntrega = $rowTabelaPrecoEntrega['HANDLEUF'];
$observacaoTabelaPrecoEntrega = $rowTabelaPrecoEntrega['OBSERVACAO'];
$dataHoraTabelaPrecoEntrega = date('d/m/Y', strtotime($rowTabelaPrecoEntrega['DATAHORA']));

if($ativoTabelaPrecoEntrega == 'S'){
	$statusTabelaPrecoEntrega = 'checked';
}
else{
	$statusTabelaPrecoEntrega = '';
}
?>
<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-money"></i><i class="fa fa-pencil"></i> Editar tabela de preço
    </div>
    
    <form action="#" id="cadastroTabelaPrecoEntregaEditar" method="post" enctype="multipart/form-data">
   	<div class="row w3-res-tb">
   		<div class="col-sm-12 m-b-xs">
   			<a href="index.php?p=cadastroTabelaPrecoEntrega">
   				<button class="btn btn-default" type="button"><i class="fa fa-arrow-left"></i> Listar tabelas de preço</button>
   			</a>
			<input type="checkbox" id="ativo" name="ativo" data-onstyle="info" <?php echo $statusTabelaPrecoEntrega; ?> >
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
        <input type="text" name="codigo" value="<?php echo $handleTabelaPrecoEntrega; ?>" class="form-control" disabled>
      </div>
      <div class="col-sm-1 m-b-xs">
			<label>UF <font color="#FF0004">*</font></label>      
		    <select id="uf" name="uf" class="form-control" required>
		    	<option value="<?php echo $handleUfTabelaPrecoEntrega; ?>"><?php echo $ufTabelaPrecoEntrega; ?></option>
		    	<?php
				$queryUF = $connect->prepare("SELECT HANDLE, SIGLA FROM MS_UF");
					
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
	  <div class="col-sm-4 m-b-xs">
			<label>Cidade <font color="#FF0004">*</font></label>      
			<select id="cidade" name="cidade" class="form-control" required>
				<option value="<?php echo $handleCidadeTabelaPrecoEntrega; ?>"><?php echo $cidadeTabelaPrecoEntrega; ?></option>
			</select>
	  </div>
	  <div class="col-sm-4 m-b-xs">
			<label>Bairro <font color="#FF0004">*</font></label> 
			<select id="bairro" name="bairro" class="form-control" required>
				<option value="<?php echo $handleBairroTabelaPrecoEntrega; ?>"><?php echo $bairroTabelaPrecoEntrega; ?></option>
			</select>
	  </div>
	  <div class="col-sm-2 m-b-xs">
	  	<label>Valor <font color="#FF0004">*</font></label> 
	  	<input type="text" class="form-control" name="valor" value="<?php echo $valorTabelaPrecoEntrega; ?>" id="valor" required />
	  </div>
	  <div class="col-sm-12 m-b-xs">
		  <label>Observação</label>   
		  <textarea name="observacao" id="observacao" class="form-control" cols="30" rows="10"><?php echo $observacaoTabelaPrecoEntrega; ?></textarea>
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
	
	jQuery('#cadastroTabelaPrecoEntregaEditar').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dados = jQuery( this ).serialize();
		
		jQuery.ajax({
			type: "POST",
			url: "controller/cadastro/cadastroTabelaPrecoEntregaEditar.php?h=<?php echo $handleTabelaPrecoEntrega;?>",
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