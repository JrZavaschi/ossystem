<?php
$handleformaPagamento = Sistema::getGet('h');
$queryformaPagamento = $connect->prepare("SELECT A.HANDLE HANDLERE, B.HANDLE HANDLEFORMA, B.FORMAPAGAMENTO, A.ATIVO, A.DATAHORA, A.OBSERVACAO
										  FROM `re_formapagamento` A
										  INNER JOIN ms_formapagamento B ON B.HANDLE = A.FORMAPAGAMENTO
										  WHERE A.HANDLE = '".$handleformaPagamento."'
									  ");

$queryformaPagamento->execute();
$rowformaPagamento = $queryformaPagamento->FETCH(PDO::FETCH_ASSOC);

$handleformaPagamento = $rowformaPagamento['HANDLERE'];
$handleMSFormaPagamento = $rowformaPagamento['HANDLEFORMA'];
$nomeformaPagamento = $rowformaPagamento['FORMAPAGAMENTO'];
$ativoformaPagamento = $rowformaPagamento['ATIVO'];
$dataHoraformaPagamento = date('d/m/Y', strtotime($rowformaPagamento['DATAHORA']));
$observacaoformaPagamento = $rowformaPagamento['OBSERVACAO'];

if($ativoformaPagamento == 'S'){
	$statusformaPagamento = 'checked';
}
else{
	$statusformaPagamento = '';
}

?>
<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-money"></i><i class="fa fa-pencil"></i> Editar forma de pagamento
    </div>
    
    <form action="#" id="cadastroFormaPagamentoEditar" method="post" enctype="multipart/form-data">
   	<div class="row w3-res-tb">
   		<div class="col-sm-12 m-b-xs">
   			<a href="index.php?p=cadastroformaPagamento">
   				<button class="btn btn-default" type="button"><i class="fa fa-arrow-left"></i> Listar formas de pagamento</button>
   			</a>
			<input type="checkbox" id="ativo" name="ativo" data-onstyle="info" <?php echo $statusformaPagamento; ?> >
		</div>
		<!-- Start retorno -->
		<?php
			include('model/estrutura/retorno.php');
		?>
		<!-- End retorno //-->
   	</div>
    <div class="row w3-res-tb">
     
      <div class="col-sm-2 m-b-xs">
        <label>Código</label>      
        <input type="text" name="codigo" value="<?php echo $handleformaPagamento; ?>" class="form-control" disabled>
      </div>
      <div class="col-sm-10 m-b-xs">
		<label>Forma de Pagamento <font color="#FF0004">*</font></label>      
		<select name="formapagamento" id="formapagamento" class="form-control" required>
			<option value="<?php echo $handleMSFormaPagamento; ?>"><?php echo $nomeformaPagamento; ?></option>
			<?php
			
				$queryMS_FormaPagamento = $connect->prepare("SELECT `HANDLE`, 
														 	`FORMAPAGAMENTO`
														     FROM `MS_FORMAPAGAMENTO` 
															");
				$queryMS_FormaPagamento->execute();
				while($rowMS_FormaPagamento = $queryMS_FormaPagamento->FETCH(PDO::FETCH_ASSOC)){

				$handleMS_FormaPagamento = $rowMS_FormaPagamento['HANDLE'];
				$nomeMS_FormaPagamento = $rowMS_FormaPagamento['FORMAPAGAMENTO'];
			?>
			<option value="<?php echo $handleMS_FormaPagamento; ?>"><?php echo $nomeMS_FormaPagamento; ?></option>
			<?php
				}
			?>
		</select>
	  </div>
	  <div class="col-sm-12 m-b-xs">
		  <label>Observação</label>   
		  <textarea name="observacao" id="observacao" class="form-control" cols="30" rows="10"><?php echo $observacaoformaPagamento; ?></textarea>
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
	
	for ( instance in CKEDITOR.instances )
    CKEDITOR.instances[instance].updateElement();
	
	CKEDITOR.replace( 'observacao' );
	
	$('#ativo').bootstrapToggle({
      on: 'Ativo',
      off: 'Inativo'
    });
	
	jQuery('#cadastroFormaPagamentoEditar').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dados = jQuery( this ).serialize();
		
		jQuery.ajax({
			type: "POST",
			url: "controller/cadastro/cadastroFormaPagamentoEditar.php?h=<?php echo $handleformaPagamento;?>",
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