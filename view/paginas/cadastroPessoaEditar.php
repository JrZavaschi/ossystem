<?php
$handlePessoa = Sistema::getGet('h');
$queryPessoa = $connect->prepare("SELECT A.HANDLE, 
													A.NOME, 
													A.SOBRENOME, 
													A.EMAIL, 
													A.TELEFONE, 
													A.CELULAR, 
													A.CPFCNPJ, 
													A.TIPOPESSOA,
													A.NOMEFANTASIA,
													A.RAZAOSOCIAL,
													A.DATANASC,
													A.FOTO,
													A.OBS,
													A.EHCLIENTE,
													A.EHFORNECEDOR,
													A.EHTECNICO,
													A.ATIVO,
													A.IERG,
													A.COMISSAOENTREGA
													FROM ms_pessoa A
													WHERE A.HANDLE = '".$handlePessoa."'
													ORDER BY A.DATAHORA DESC");
$queryPessoa->execute();
$rowPessoa = $queryPessoa->FETCH(PDO::FETCH_ASSOC);

$nomePessoa = $rowPessoa['NOME'];
$sobrenomePessoa = $rowPessoa['SOBRENOME'];
$emailPessoa = $rowPessoa['EMAIL'];
$telefonePessoa = $rowPessoa['TELEFONE'];
$celularPessoa = $rowPessoa['CELULAR'];
$cpfcnpjPessoa = $rowPessoa['CPFCNPJ'];
$tipopessoaPessoa = $rowPessoa['TIPOPESSOA'];
$nomefantasiaPessoa = $rowPessoa['NOMEFANTASIA'];
$razaosocialPessoa = $rowPessoa['RAZAOSOCIAL'];
$obsPessoa = $rowPessoa['OBS'];
$fotoPessoa = $rowPessoa['FOTO'];
$datanascPessoa = date('Y-m-d', strtotime($rowPessoa['DATANASC']));
$ehClientePessoa = $rowPessoa['EHCLIENTE'];
$ehFornecedorPessoa = $rowPessoa['EHFORNECEDOR'];
$ehTecnicoPessoa = $rowPessoa['EHTECNICO'];
$ativoPesoa = $rowPessoa['ATIVO'];
$IERGPessoa = $rowPessoa['IERG'];
$comissaoTecnico = $rowPessoa['COMISSAOENTREGA'];


if($ativoPesoa == 'S'){
	$status = 'checked';
}
else {
	$status = '';
}

if($ehClientePessoa == 'S'){
	$ehClientePessoaCheck = 'checked';
}
else{
	$ehClientePessoaCheck = '';
}

if($ehFornecedorPessoa == 'S'){
	$ehFornecedorPessoaCheck = 'checked';
}
else{
	$ehFornecedorPessoaCheck = '';
}

if($ehTecnicoPessoa == 'S'){
	$ehTecnicoPessoaCheck = 'checked';
}
else{
	$ehTecnicoPessoaCheck = '';
}


$queryPessoaPontos = $connect->prepare("SELECT COUNT(A.PONTOS) PONTOS
										FROM ms_pessoapontos A
										WHERE A.PESSOA = '".$handlePessoa."'
										AND A.RESGATOU = 'N'
										AND A.DATAHORARESGATE IS NULL");
$queryPessoaPontos->execute();
$rowPessoaPontos = $queryPessoaPontos->FETCH(PDO::FETCH_ASSOC);
$pessoaPontos = $rowPessoaPontos['PONTOS'];



$queryPessoaEnderecoCount = $connect->prepare("SELECT COUNT(HANDLE) CONTADOR FROM ms_pessoaendereco WHERE PESSOA = '".$handlePessoa."'");
$queryPessoaEnderecoCount->execute();
$rowPessoaEnderecoCount = $queryPessoaEnderecoCount->FETCH(PDO::FETCH_ASSOC);
$countPessoaEndereco = $rowPessoaEnderecoCount['CONTADOR'];

if($countPessoaEndereco <= '1'){
	$queryPessoaEndereco = $connect->prepare("SELECT B.HANDLE,
												B.LOGRADOURO, 
												B.NUMERO, 
												B.CEP, 
												B.COMPLEMENTO, 
												B.PONTOREFERENCIA, 
												C.CIDADE,
												C.HANDLE HANDLECIDADE,
												D.SIGLA UF,
												D.HANDLE HANDLEUF,
												E.NOME BAIRRO,
												E.HANDLE HANDLEBAIRRO
												FROM ms_pessoaendereco B
												LEFT JOIN ms_cidade C ON C.HANDLE = B.CIDADE
												LEFT JOIN ms_uf D ON D.HANDLE = C.UF
												LEFT JOIN ms_bairro E ON E.HANDLE = B.BAIRRO
												WHERE B.PESSOA = '".$handlePessoa."'
												ORDER BY B.DATAHORA DESC");
	$queryPessoaEndereco->execute();
	$rowPessoaEndereco = $queryPessoaEndereco->FETCH(PDO::FETCH_ASSOC);

	$handlePessoaEndereco = $rowPessoaEndereco['HANDLE'];
	$logradouroPessoa = $rowPessoaEndereco['LOGRADOURO'];
	$cepPessoa = $rowPessoaEndereco['CEP'];
	$complementoPessoa = $rowPessoaEndereco['COMPLEMENTO'];
	$pontoreferenciaPessoa = $rowPessoaEndereco['PONTOREFERENCIA'];
	$cidadePessoa = $rowPessoaEndereco['CIDADE'];
	$ufPessoa = $rowPessoaEndereco['UF'];
	$bairroPessoa = $rowPessoaEndereco['BAIRRO'];
	$handleUfPessoa = $rowPessoaEndereco['HANDLEUF'];
	$handleCidadePessoa = $rowPessoaEndereco['HANDLECIDADE'];
	$handleBairroPessoa = $rowPessoaEndereco['HANDLEBAIRRO'];
	$numeroPessoa = $rowPessoaEndereco['NUMERO'];
}
?>
	<section class="wrapper">
		<div class="table-agile-info">
		 <form id="cadastroPessoaEditar" action="#" method="post" enctype="multipart/form-data">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-user-plus"></i> Editar Pessoa
    </div>
    
    <div class="row w3-res-tb">
    	<div class="col-sm-12 m-b-xs">
   			<a href="index.php?p=cadastroPessoa"><button class="btn btn-default" type="button"><i class="fa fa-arrow-left"></i> Listar Pessoas</button></a>
   			<input type="checkbox" id="ativo" name="ativo" data-onstyle="info" <?php echo $status; ?>>
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
        <input type="text" name="codigo" class="form-control" value="<?php echo $handlePessoa; ?>" disabled>
      </div>
      <div class="col-sm-2 m-b-xs">
        <label>Tipo <font color="#FF0004">*</font></label>      
        <select name="tipopessoa" id="tipopessoa" class="form-control" required>
        	<option value="<?php echo $tipopessoaPessoa; ?>"><?php echo $tipopessoaPessoa; ?></option>
        	<option value="Física">Fisíca</option>
        	<option value="Jurídica">Jurídica</option>
        </select>
      </div>
      <div id="fisica">
		  <div class="col-sm-3 m-b-xs">
			<label>Nome <font color="#FF0004">*</font></label>      
			<input type="text" name="nome" id="nome" value="<?php echo $nomePessoa; ?>" class="form-control" required>
		  </div>
		  <div class="col-sm-3 m-b-xs">
			<label>Sobrenome <font color="#FF0004">*</font></label>      
			<input type="text" name="sobrenome" id="sobrenome" value="<?php echo $sobrenomePessoa; ?>" class="form-control" required>
		  </div>
		  <div class="col-sm-3 m-b-xs">
			<label>CPF </label>      
			<input type="text" id="cpf" name="cpf" value="<?php echo $cpfcnpjPessoa; ?>" class="form-control">
		  </div>
      	  <div class="col-sm-2 m-b-xs">
			<label>RG</label>      
			<input type="text" id="iergF" name="iergF" value="<?php echo $IERGPessoa; ?>" class="form-control">
	  	  </div>
      </div>
      <div id="juridica" class="hide">
		  <div class="col-sm-3 m-b-xs">
			<label>Razão social <font color="#FF0004">*</font></label>      
			<input type="text" name="razaosocial" id="razaosocial" value="<?php echo $razaosocialPessoa; ?>" class="form-control">
		  </div>
		  <div class="col-sm-3 m-b-xs">
			<label>Nome Fantasia <font color="#FF0004">*</font></label>      
			<input type="text" name="nomefantasia" id="nomefantasia" value="<?php echo $nomefantasiaPessoa; ?>" class="form-control">
		  </div>
		  <div class="col-sm-3 m-b-xs">
			<label>CNPJ <font color="#FF0004">*</font></label>      
			<input type="text" id="cnpj" name="cnpj" value="<?php echo $cpfcnpjPessoa; ?>" class="form-control">
		  </div>
      	  <div class="col-sm-2 m-b-xs">
			<label>IE</label>      
			<input type="text" id="iergJ" name="iergJ" value="<?php echo $IERGPessoa; ?>" class="form-control">
	  	  </div>
      </div>
      <div class="col-sm-2 m-b-xs">
			<label>Nascimento </label>      
			<input type="date" id="datanasc" name="datanasc" value="<?php echo $datanascPessoa; ?>" class="form-control">
	  </div>
	  <div class="col-sm-2 m-b-xs">
			<label>Telefone </label>      
			<input type="text" id="telefone" name="telefone" value="<?php echo $telefonePessoa; ?>" class="form-control">
	  </div>
	  <div class="col-sm-2 m-b-xs">
			<label>Celular <font color="#FF0004">*</font></label>      
			<input type="text" id="celular" name="celular" value="<?php echo $celularPessoa; ?>" class="form-control">
	  </div>
	  <div class="col-sm-4 m-b-xs">
			<label>E-mail </label>      
			<input type="email" id="email" name="email" value="<?php echo $emailPessoa; ?>" class="form-control">
	  </div>
	  <div class="col-sm-4 m-b-xs">
			<label>Foto de perfil </label>
			<input type="file" id="foto" name="foto" class="form-control">
	  </div>
	  <div class="col-sm-2 m-b-xs">
			<label>&nbsp;</label>
			<img src="view/tecnologia/uploads/oficina/pessoa/<?php echo $fotoPessoa; ?>" alt="Sem foto cadastrada" class="img-responsive thumbnail">
	  </div>
	</div>
  	<div class="row w3-res-tb">
	  <div class="col-sm-12 m-b-xs">
			<label>Abrangência </label> 
			<br>			 
			<input type="checkbox" id="ehCliente" name="ehCliente" data-onstyle="success" <?php echo $ehClientePessoaCheck; ?>>&nbsp;&nbsp;
			<input type="checkbox" id="ehFornecedor" name="ehFornecedor" data-onstyle="success" <?php echo $ehFornecedorPessoaCheck; ?>>&nbsp;&nbsp; 
			<input type="checkbox" id="ehTecnico" name="ehTecnico" data-onstyle="success" <?php echo $ehTecnicoPessoaCheck; ?>>&nbsp;&nbsp;   
			<br><br>
	  </div>
	  <div class="col-sm-2 m-b-xs <?php if($ehTecnicoPessoa == 'S'){ echo '';}else{ echo 'hide';} ?>" id="comissaoTecnicoDiv">
			<label>Comissão (%) </label>      
			<input type="text" id="comissaoTecnico" name="comissaoTecnico" value="<?php echo $comissaoTecnico; ?>" class="form-control">
	  </div>
	  <div class="col-sm-2 m-b-xs <?php if($ehClientePessoa == 'S'){ echo '';}else{ echo 'hide';} ?>" id="pontosClienteDiv">
			<label>Pontos cliente</label>      
			<input type="text" id="pontosCliente" name="pontosCliente" value="<?php echo $pessoaPontos; ?>" class="form-control" disabled>
	  </div>
	  <div class="col-sm-12 m-b-xs">
			<label>Observações </label>      
		  <textarea type="text" id="obs" name="obs" class="form-control"><?php echo $obsPessoa; ?></textarea>
	  </div>
    </div>
    <div class="row w3-res-tb">
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" id="tabPage" role="tablist">
		<li role="presentation" class="active"><a href="#endereco" aria-controls="endereco" role="tab" data-toggle="tab">Endereço</a></li>
	  </ul>
	  <!-- Tab panes -->
	  <div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="endereco">
			<div class="row">
			<div class="col-md-12">
				<div class="floatRight">
					  <a href="#inserirEnderecoModal" data-toggle="modal">
					  	<button type="button" class="btn btn-default"><i class="fa fa-plus"> </i> </button>
					  </a>
					  <button type="button" id="visualizarEndereco" class="btn btn-default"><i class="fa fa-eye"> </i> </button>
					  <button type="button" id="excluirEndereco" class="btn btn-default"><i class="fa fa-times"> </i></button>
				</div>
				<br>
	    	</div>
		    </div>
			<?php
				if($countPessoaEndereco <= '1'){
				
			?>
			<input type="text" class="hide" hidden="true" name="handlePessoaEndereco" value="<?php echo $handlePessoaEndereco; ?>">
			 <div class="col-sm-2 m-b-xs">
				<label>UF <font color="#FF0004">*</font></label>      
				<select id="uf" name="uf" class="form-control" required>
					<option value="<?php echo $handleUfPessoa; ?>"><?php echo $ufPessoa; ?></option>
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
						<option value="<?php echo $handleCidadePessoa; ?>"><?php echo $cidadePessoa; ?></option>
					</select>
			  </div>
			  <div class="col-sm-4 m-b-xs">
					<label>Bairro <font color="#FF0004">*</font></label> 
					<select id="bairro" name="bairro" class="form-control" required>
						<option value="<?php echo $handleBairroPessoa; ?>"><?php echo $bairroPessoa; ?></option>
					</select>
			  </div>
			  <div class="col-sm-2 m-b-xs">
					<label>CEP </label>      
					<input type="text" id="cep" name="cep" value="<?php echo $cepPessoa; ?>" class="form-control">
			  </div>
			  <div class="col-sm-6 m-b-xs">
					<label>Logradouro <font color="#FF0004">*</font></label>      
					<input type="text" id="logradouro" name="logradouro" value="<?php echo $logradouroPessoa; ?>" class="form-control">
			  </div>
			  <div class="col-sm-2 m-b-xs">
					<label>Número <font color="#FF0004">*</font></label>      
					<input type="text" id="numero" name="numero" value="<?php echo $numeroPessoa; ?>" class="form-control">
			  </div>
			  <div class="col-sm-4 m-b-xs">
					<label>Complemento </label>      
					<input type="text" id="complemento" name="complemento" value="<?php echo $complementoPessoa; ?>" class="form-control">
			  </div>
			  <div class="col-sm-6 m-b-xs">
					<label>Ponto de referência </label>      
					<input type="text" id="pontoreferencia" name="pontoreferencia" value="<?php echo $pontoreferenciaPessoa; ?>" class="form-control">
			  </div>
				  
    
			<?php
				}
				else if($countPessoaEndereco > '1'){
			?>
		   		<div class="table table-responsive">
		   			<table class="table table-responsive table-striped">
		   				<thead>
		   					<th>#</th>
		   					<th>Cidade - UF</th>
		   					<th>Bairro</th>
		   					<th>Logradouro</th>
		   					<th>Número</th>
		   				</thead>
		   				<tbody>
		   					<?php
								$queryPessoaEnderecoTable = $connect->prepare(" SELECT B.HANDLE,
																	B.LOGRADOURO, 
																	B.NUMERO, 
																	B.CEP, 
																	B.COMPLEMENTO, 
																	B.PONTOREFERENCIA, 
																	C.CIDADE,
																	C.HANDLE HANDLECIDADE,
																	D.SIGLA UF,
																	D.HANDLE HANDLEUF,
																	E.NOME BAIRRO,
																	E.HANDLE HANDLEBAIRRO
																	FROM ms_Pessoaendereco B
																	LEFT JOIN ms_cidade C ON C.HANDLE = B.CIDADE
																	LEFT JOIN ms_uf D ON D.HANDLE = C.UF
																	LEFT JOIN ms_bairro E ON E.HANDLE = B.BAIRRO
																	WHERE B.PESSOA = '".$handlePessoa."'
																	ORDER BY B.DATAHORA DESC");
								$queryPessoaEnderecoTable->execute();
								while($rowPessoaEnderecoTable = $queryPessoaEnderecoTable->FETCH(PDO::FETCH_ASSOC)){
								
								$handlePessoaEnderecoTable = $rowPessoaEnderecoTable['HANDLE'];
								$logradouroPessoaTable = $rowPessoaEnderecoTable['LOGRADOURO'];
								$cepPessoaTable = $rowPessoaEnderecoTable['CEP'];
								$complementoPessoaTable = $rowPessoaEnderecoTable['COMPLEMENTO'];
								$pontoreferenciaPessoaTable = $rowPessoaEnderecoTable['PONTOREFERENCIA'];
								$cidadePessoaTable = $rowPessoaEnderecoTable['CIDADE'];
								$ufPessoaTable = $rowPessoaEnderecoTable['UF'];
								$bairroPessoaTable = $rowPessoaEnderecoTable['BAIRRO'];
								$handleUfPessoaTable = $rowPessoaEnderecoTable['HANDLEUF'];
								$handleCidadePessoaTable = $rowPessoaEnderecoTable['HANDLECIDADE'];
								$handleBairroPessoaTable = $rowPessoaEnderecoTable['HANDLEBAIRRO'];
								$numeroPessoaTable = $rowPessoaEnderecoTable['NUMERO'];
							?>
		   					<tr>
		   						<td><input type="radio" name="chk[]" id="chk" value="<?php echo $handlePessoaEnderecoTable; ?>"></td>
		   						<td><?php echo $cidadePessoaTable.' - '.$ufPessoaTable; ?></td>
								<td><?php echo $bairroPessoaTable; ?></td>
								<td><?php echo $logradouroPessoaTable; ?></td>
								<td><?php echo $numeroPessoaTable; ?></td>
		   					</tr>
		   					<?php
								}
							?>
		   				</tbody>
		   			</table>
		   		</div>
			<?php
				}
			?>
		</div>
		
	  </div>
  </div>
    </div>
    <footer class="panel-footer">
      <div class="row">
		  <div class="col-sm-12">
			  <button id="submitCadastroPessoaEditar" class="btn btn-success floatRight" value="Gravar" />Gravar</button>
		  </div>
      </div>
    </footer>
    
</form>
</div>
</section>

<?php
	include('model/cadastro/cadastroPessoaEditarModal.php');
?>
<!-- Include js scripts for page -->
<script src="view/tecnologia/js/jquery.maskedinput.js"></script>
<script src="view/tecnologia/js/script.global.js"></script>
<script src="view/tecnologia/js/script.cadastro.pessoa.js"></script>
<script>
	
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
		
		if($(this).prop('checked') === true){
			$('#comissaoTecnicoDiv').removeClass('hide');
		}
		else {
			$('#comissaoTecnicoDiv').addClass('hide');
		}
		
	});
	
	$('#ehCliente').change(function(){
		
		if($(this).prop('checked') === true){
			$('#pontosClienteDiv').removeClass('hide');
		}
		else {
			$('#pontosClienteDiv').addClass('hide');
		}
		
	});
	jQuery('#cadastroPessoaEditar').submit(function(){
		
		//atualiza todos CKEDITOR para enviar os dados junto ao form em ajax by Jr
		for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dados = jQuery( this ).serialize();

		jQuery.ajax({
			type: "POST",
			url: "controller/cadastro/cadastroPessoaEditar.php?h=<?php echo $handlePessoa; ?>",
			//dataType : 'json', 
			/*data: dados,*/
			data: new FormData( this ),
			processData: false,
			contentType: false,  
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


	$('#tabPage a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	})
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

	$('button#submitCadastroPessoaEditar').click( function() {
		$('#cadastroPessoaEditar').submit();
	});

	$('#visualizarEndereco').click(function(){
		$('input#chk[type=radio]').each(function(){
			if(this.checked) {
				var handlePessoaEndereco = this.value;
				
				jQuery.ajax({
					type: "POST",
					url: "controller/cadastro/cadastroPessoaEnderecoVisualizar.php",
					//dataType : 'json', 
					data:  {"handlePessoaEndereco":handlePessoaEndereco},
					success: function( data ) {
						var json = $.parseJSON(data);
						//console.log(data);
						$('#uf-modal-visualizar').val(json.uf);
						$('#cidade-modal-visualizar').val(json.cidade);
						$('#bairro-modal-visualizar').val(json.bairro);
						$('#logradouro-modal-visualizar').val(json.logradouro);
						$('#numero-modal-visualizar').val(json.numero);
						$('#complemento-modal-visualizar').val(json.complemento);
						$('#cep-modal-visualizar').val(json.cep);
						$('#pontoreferencia-modal-visualizar').val(json.pontoreferencia);
						
						$('#visualizarEnderecoModal').modal('show');
						
						
					}
				});
				return false;
				
			}
		});
	});
	
	$('#excluirEndereco').click(function(){
		$('input#chk[type=radio]').each(function(){
			if(this.checked) {
				var handlePessoaEndereco = this.value;
				console.log(handlePessoaEndereco);
				
				jQuery.ajax({
					type: "POST",
					url: "controller/cadastro/cadastroPessoaEnderecoExcluir.php",
					//dataType : 'json', 
					data:  {"handlePessoaEndereco":handlePessoaEndereco},
					success: function( data ) {
							var json = $.parseJSON(data);
						
							$('#retorno').modal('show');
							$('#retorno-body').html(json.retorno);	
							
						$('retornoOk').click(function(){
							location.reload();
						});
					}
				});
				return false;
			}
		});
	});

//jQuery Mask input by Jr :)
$("#cpf").mask("999.999.999-99");
$("#cnpj").mask("99.999.999/9999-99");
$("#telefone").mask("(99) 9999 9999");
$("#celular").mask("(99) 9 9999 9999");
$("#cep").mask("99999-999");
$("#cep-modal").mask("99999-999");

});//$(document).ready(function(){
	
</script>