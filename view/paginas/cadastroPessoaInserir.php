<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-user-plus"></i> Inserir Pessoa
    </div>
    
   	<div class="row w3-res-tb">
   		<div class="col-sm-12 m-b-xs">
   			<a href="index.php?p=cadastroPessoa"><button class="btn btn-default"><i class="fa fa-arrow-left"></i> Listar Pessoas</button></a>
   			<input type="checkbox" id="ativo" name="ativo" data-onstyle="info" checked>
		</div>
		<!-- Start retorno -->
		<?php
			include('model/estrutura/retorno.php');
			include('model/estrutura/retornoConfirm.php');
		?>
		<!-- End retorno //-->
   	</div>
   	
    <form action="#" id="cadastroPessoaInserir" method="post" enctype="multipart/form-data">
    <div class="row w3-res-tb">
     
      <div class="col-sm-1 m-b-xs">
        <label>Código</label>      
        <input type="text" name="codigo" class="form-control" disabled>
      </div>
      <div class="col-sm-2 m-b-xs">
        <label>Tipo <font color="#FF0004">*</font></label>      
        <select name="tipopessoa" id="tipopessoa" class="form-control" required>
        	<option value="Física">Fisíca</option>
        	<option value="Jurídica">Jurídica</option>
        </select>
      </div>
      <div id="fisica">
		  <div class="col-sm-3 m-b-xs">
			<label>Nome <font color="#FF0004">*</font></label>      
			<input type="text" name="nome" id="nome" class="form-control" required>
		  </div>
		  <div class="col-sm-3 m-b-xs">
			<label>Sobrenome <font color="#FF0004">*</font></label>      
			<input type="text" name="sobrenome" id="sobrenome" class="form-control" required>
		  </div>
		  <div class="col-sm-3 m-b-xs">
			<label>CPF </label>      
			<input type="text" id="cpf" name="cpf" class="form-control">
		  </div>
      	  <div class="col-sm-2 m-b-xs">
			<label>RG</label>      
			<input type="text" id="iergF" name="iergF" class="form-control">
	  	  </div>
      </div>
      <div id="juridica" class="hide">
		  <div class="col-sm-3 m-b-xs">
			<label>Razão social <font color="#FF0004">*</font></label>      
			<input type="text" name="razaosocial" id="razaosocial" class="form-control">
		  </div>
		  <div class="col-sm-3 m-b-xs">
			<label>Nome Fantasia <font color="#FF0004">*</font></label>      
			<input type="text" name="nomefantasia" id="nomefantasia" class="form-control">
		  </div>
		  <div class="col-sm-3 m-b-xs">
			<label>CNPJ <font color="#FF0004">*</font></label>      
			<input type="text" id="cnpj" name="cnpj" class="form-control">
		  </div>
      	  <div class="col-sm-2 m-b-xs">
			<label>IE</label>      
			<input type="text" id="iergJ" name="iergJ" class="form-control">
	  	  </div>
      </div>
      <div class="col-sm-2 m-b-xs">
			<label>Nascimento </label>      
			<input type="date" id="datanasc" name="datanasc" class="form-control">
	  </div>
	  <div class="col-sm-2 m-b-xs">
			<label>Telefone </label>      
			<input type="text" id="telefone" name="telefone" class="form-control">
	  </div>
	  <div class="col-sm-2 m-b-xs">
			<label>Celular <font color="#FF0004">*</font></label>      
			<input type="text" id="celular" name="celular" class="form-control">
	  </div>
	  <div class="col-sm-4 m-b-xs">
			<label>E-mail </label>      
			<input type="email" id="email" name="email" class="form-control">
	  </div>
	  <div class="col-sm-2 m-b-xs">
			<label>UF <font color="#FF0004">*</font></label>      
		    <select id="uf" name="uf" class="form-control" required>
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
	  <div class="col-sm-4 m-b-xs">
			<label>Cidade <font color="#FF0004">*</font></label>      
			<select id="cidade" name="cidade" class="form-control" required>
				<option value="">-- Selecione uma UF --</option>
			</select>
	  </div>
	  <div class="col-sm-4 m-b-xs">
			<label>Bairro <font color="#FF0004">*</font></label> 
			<select id="bairro" name="bairro" class="form-control" required>
				<option value="">-- Selecione uma Cidade --</option>
			</select>
	  </div>
	  <div class="col-sm-2 m-b-xs">
			<label>CEP </label>      
			<input type="text" id="cep" name="cep" class="form-control">
	  </div>
	  <div class="col-sm-6 m-b-xs">
			<label>Logradouro <font color="#FF0004">*</font></label>      
			<input type="text" id="logradouro" name="logradouro" class="form-control">
	  </div>
	  <div class="col-sm-2 m-b-xs">
			<label>Número <font color="#FF0004">*</font></label>      
			<input type="text" id="numero" name="numero" class="form-control">
	  </div>
	  <div class="col-sm-4 m-b-xs">
			<label>Complemento </label>      
			<input type="text" id="complemento" name="complemento" class="form-control">
	  </div>
	  <div class="col-sm-6 m-b-xs">
			<label>Ponto de referência </label>      
			<input type="text" id="pontoreferencia" name="pontoreferencia" class="form-control">
	  </div>
	  <div class="col-sm-6 m-b-xs">
			<label>Foto de perfil </label>      
			<input type="file" id="foto" name="foto" class="form-control">
	  </div>
	</div>
  	<div class="row w3-res-tb">
	  <div class="col-sm-12 m-b-xs">
			<label>Abrangência </label> 
			<br>			 
			<input type="checkbox" id="ehCliente" name="ehCliente" data-onstyle="success" checked>&nbsp;&nbsp;
			<input type="checkbox" id="ehFornecedor" name="ehFornecedor" data-onstyle="success">&nbsp;&nbsp; 
			<input type="checkbox" id="ehTecnico" name="ehTecnico" data-onstyle="success">&nbsp;&nbsp;   
			<br><br>
	  </div>
	  <div class="col-sm-3 m-b-xs hide" id="comissaoTecnicoDiv">
			<label>Comissão (%) </label>      
			<input type="text" id="comissaoTecnico" name="comissaoTecnico" class="form-control">
	  </div>
	  <div class="col-sm-12 m-b-xs">
			<label>Observações </label>      
		  <textarea type="text" id="obs" name="obs" class="form-control"></textarea>
	  </div>
	 
    </div>
    <footer class="panel-footer">
      <div class="row">
      <div class="col-sm-12 m-b-xs">
     	 <button type="submit" class="btn btn-success right-stat-bar floatRight">Gravar</button>      	
      </div>
      </div>
    </footer>
    </form>
  </div>
</div>
</section>

<!-- Include js scripts for page -->
<script src="view/tecnologia/js/jquery.maskedinput.js"></script>
<script src="view/tecnologia/js/script.global.js"></script>
<script src="view/tecnologia/js/script.cadastro.pessoa.js"></script>
<script>
// JavaScript Document
$(document).ready(function(){
	CKEDITOR.replace( 'obs' );
	
	$('#ativo').bootstrapToggle({
      on: 'Ativo',
      off: 'Inativo'
    });
	
	$('#ehCliente').bootstrapToggle({
      on: 'Cliente',
      off: 'Cliente'
    });
	$('#ehFornecedor').bootstrapToggle({
      on: 'Fornecedor',
      off: 'Fornecedor'
    });
	$('#ehTecnico').bootstrapToggle({
      on: 'Tecnico',
      off: 'Tecnico'
    });
	
	$('#ehTecnico').change(function(){
		console.log($(this).prop('checked'));
		
		if($(this).prop('checked') === true){
			$('#comissaoTecnicoDiv').removeClass('hide');
		}
		else {
			$('#comissaoTecnicoDiv').addClass('hide');
		}
		
	});
	
	jQuery('#cadastroPessoaInserir').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dados = jQuery( this ).serialize();
		
		if($(this)[0].checkValidity()) {

			jQuery.ajax({
				type: "POST",
				url: "controller/cadastro/cadastroPessoaInserir.php",
				//dataType : 'json', 
				/*data: dados,*/
				data: new FormData( this ),
				processData: false,
				contentType: false, 
				success: function( data ) {
					//alert(data);
						var json = $.parseJSON(data);
					
						$('#retorno').modal('show');
						$('#retorno-body').html(json.retorno);
						
					$('#retornoOk').click(function(){
						if(json.sucesso === 'S'){
							location.href='index.php?p=cadastroPessoaEditar&h='+json.handlePessoa;
						}
					});
				}
			});
			return false;
		}
		else{
			$('#retorno').modal('show');
			$('#retorno-body').html('Preencha todos os campos obrigatórios para prosseguir');
		}
	});
	
	$('#cpf').blur(function(){
		var cpfValor = $(this).val();
		jQuery.ajax({
			type: "POST",
			url: "controller/cadastro/cadastroBuscaPessoaCGC.ajax.php",
			//dataType : 'json', 
			data: {"cpfValor":cpfValor},
			success: function( data ) {
					var json = $.parseJSON(data);
				
					if(json.sucesso === 'S' & json.handleBuscaPessoa > '0'){
						$('#retornoConfirm').modal('show');
						$('#retornoConfirm-body').html(json.retorno);
						
						$('.confirmarRetornoConfirm').click(function(){
							location.href='index.php?p=cadastroPessoaEditar&h='+json.handleBuscaPessoa;
						});
					}
			
			}
		});
		return false;
	});
	$('#cnpj').blur(function(){
		var cnpjValor = $(this).val();
		jQuery.ajax({
			type: "POST",
			url: "controller/cadastro/cadastroBuscaPessoaCGC.ajax.php",
			//dataType : 'json', 
			data: {"cpfValor":cnpjValor},
			success: function( data ) {
					var json = $.parseJSON(data);
					if(json.sucesso === 'S' & json.handleBuscaPessoa > '0'){
						$('#retornoConfirm').modal('show');
						$('#retornoConfirm-body').html(json.retorno);
						$('.confirmarRetornoConfirm').click(function(){
							location.href='index.php?p=cadastroPessoaEditar&h='+json.handleBuscaPessoa;
						});
					}
			
			}
		});
		return false;
	});
	
$('#tipopessoa').change(function(){
	if(this.value === 'Física'){
		$('#fisica').removeClass('hide');
		$('#fisica').addClass('nohide');
		
		$('#juridica').removeClass('nohide');
		$('#juridica').addClass('hide');
		
		$('#nome').attr('required', 'required');
		$('#sobrenome').attr('required', 'required');
		$('#cpf').attr('required', 'required');
		
		$('#razaosocial').removeAttr('required');
		$('#nomefantasia').removeAttr('required');
		$('#cnpj').removeAttr('required');
	}
	else if(this.value === 'Jurídica'){
		$('#juridica').removeClass('hide');
		$('#juridica').addClass('nohide');
		
		$('#fisica').removeClass('nohide');
		$('#fisica').addClass('hide');
		
		$('#razaosocial').attr('required', 'required');
		$('#nomefantasia').attr('required', 'required');
		$('#cnpj').attr('required', 'required');
		
		$('#nome').removeAttr('required');
		$('#sobrenome').removeAttr('required');
		$('#cpf').removeAttr('required');
	}
});
	
$(function(){
	$('#uf').change(function(){
		if( $(this).val() ) {
			$('#cidade').hide();
			$.getJSON('controller/global/cidades.ajax.php?search=',{uf: $(this).val(), ajax: 'true'}, function(j){
				var options = '<option value=""></option>';	
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].HANDLE + '">' + j[i].CIDADE + '</option>';
				}	
				$('#cidade').html(options).show();
			});
		} else {
			$('#cidade').html('<option value="">-- Escolha um estado --</option>');
		}
	});
	
	$('#cidade').change(function(){
		if( $(this).val() ) {
			$('#bairro').hide();
			$.getJSON('controller/global/bairros.ajax.php?search=',{cidade: $(this).val(), ajax: 'true'}, function(j){
				var options = '<option value=""></option>';	
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].HANDLE + '">' + j[i].NOME + '</option>';
				}	
				$('#bairro').html(options).show();
			});
		} else {
			$('#cidade').html('<option value="">-- Escolha uma cidade --</option>');
		}
	});
});

});
	
//jQuery Mask input by Jr :)
$("#cpf").mask("999.999.999-99");
$("#cnpj").mask("99.999.999/9999-99");
$("#telefone").mask("(99) 9999 9999");
$("#celular").mask("(99) 9 9999 9999");
$("#cep").mask("99999-999");
$("#cep-modal").mask("99999-999");

</script>