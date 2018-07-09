<?php
$query = $connect->prepare("SELECT * FROM ms_oficina");

$query->execute();

$row = $query->fetch(PDO::FETCH_ASSOC);
  $handle = $row['HANDLE'];
  $razaoSocial = $row['RAZAOSOCIAL']; 
  $nomeFantasia = $row['NOMEFANTASIA'];
  $cnpj = $row['CNPJ']; 
  $ie = $row['IE'];
  $ehAtivo = $row['EHATIVO']; 
  $logradouro = $row['LOGRADOURO']; 
  $numero = $row['NUMERO']; 
  $bairro = $row['BAIRRO']; 
  $cidade = $row['CIDADE']; 
  $uf = $row['UF']; 
  $cep = $row['CEP']; 
  $logo = $row['LOGO'];
  $telefone = $row['TELEFONE'];
  $email = $row['EMAIL'];
  $dataHora = date('d/m/Y H:i:s', strtotime($row['DATAHORA'])); 
?>
	<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-wrench"></i> Cadastro da empresa
    </div>
    
    <form action="#" id="configuracoesEmitente" method="post" enctype="multipart/form-data">
   	<div class="row w3-res-tb">
		<!-- Start retorno -->
		<?php
			include('model/estrutura/retorno.php');
		?>
		<!-- End retorno //-->
   	</div>
    <div class="row w3-res-tb">
     
      <div class="col-sm-1 m-b-xs">
        <label>Código</label>      
        <input type="text" name="codigo" class="form-control" value="<?php echo $handle; ?>" disabled>
      </div>
	  <div class="col-sm-3 m-b-xs">
		<label>Razão Social <font color="#FF0004">*</font></label>      
		<input type="text" class="form-control" name="razaoSocial" value="<?php echo $razaoSocial; ?>" required>
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>Nome Fantasia <font color="#FF0004">*</font></label>      
		<input type="text" class="form-control" name="nomeFantasia" value="<?php echo $nomeFantasia; ?>" required>
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>CNPJ <font color="#FF0004">*</font></label>      
		<input type="text" class="form-control" name="cnpj" value="<?php echo $cnpj; ?>" required>
	  </div>
	  <div class="col-sm-2 m-b-xs">
		<label>Inscrição Estadual</label>      
		<input type="text" class="form-control" name="ie" value="<?php echo $ie; ?>">
	  </div>
	  <div class="col-sm-2 m-b-xs">
		<label>Telefone <font color="#FF0004">*</font></label>      
		<input type="tel" class="form-control" name="telefone" value="<?php echo $telefone; ?>" required>
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>E-mail <font color="#FF0004">*</font></label>      
		<input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required>
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>Cidade <font color="#FF0004">*</font></label>      
		<input type="text" class="form-control" name="cidade" value="<?php echo $cidade; ?>" required>
	  </div>
	  <div class="col-sm-1 m-b-xs">
		<label>UF <font color="#FF0004">*</font></label>      
		<input type="text" class="form-control" name="uf" value="<?php echo $uf; ?>" required>
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>Logradouro <font color="#FF0004">*</font></label>      
		<input type="text" class="form-control" name="logradouro" value="<?php echo $logradouro; ?>" required>
	  </div>
	  <div class="col-sm-2 m-b-xs">
		<label>Número</label>      
		<input type="text" class="form-control" name="numero" value="<?php echo $numero; ?>">
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>Bairro <font color="#FF0004">*</font></label>      
		<input type="text" class="form-control" name="bairro" value="<?php echo $bairro; ?>" required>
	  </div>
	  <div class="col-sm-2 m-b-xs">
		<label>CEP <font color="#FF0004">*</font></label>      
		<input type="text" class="form-control" name="cep" value="<?php echo $cep; ?>" required>
	  </div>
	  <div class="col-sm-3 m-b-xs">
		<label>Logo</label>      
		<input type="file" id="logo" name="logo" class="form-control">
	  </div>
	  <div class="col-sm-2 m-b-xs">
		<img src="view/tecnologia/uploads/oficina/emitente/<?php echo $logo; ?>" class="img-responsive thumbnail" alt="">
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
	//CKEDITOR.replace( 'obs' );
	
	jQuery('#configuracoesEmitente').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dados = jQuery( this ).serialize();
		console.log(new FormData( this ));
		jQuery.ajax({
			type: "POST",
			url: "controller/configuracoes/configuracoesEmitente.php",
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
	});
});
</script>