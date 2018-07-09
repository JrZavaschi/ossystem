<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-users"></i> Pessoa
    </div>
<?php
if(isset($_SESSION['retorno'])){
	$retorno = $_SESSION['retorno'];
	unset($_SESSION['retorno']);
	print('<br /><div class="alert alert-info">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> '.$retorno.'</div>');
	$retorno = null;
}	
?>
    <div class="row w3-res-tb">
      <div class="col-sm-12 m-b-xs">
        <a href="?p=cadastroPessoaInserir"><button class="btn btn-success">Inserir</button> </a>       
      </div>
      
    </div>
    <div class="table-responsive">
     <div class="col-sm-12">
      <table class="table table-striped b-t b-light" id="Pessoas">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Celular</th>
            <th>Cidade - UF</th>
            <th>Bairro</th>
            <th>CGC</th>
            <th>Abrangência</th>
            <th><i class="fa fa-cogs"></i></th>
          </tr>
        </thead>
        <tbody>
         <?php
			
				$queryPessoa = $connect->prepare(" SELECT DISTINCT(A.HANDLE), 
													A.NOME, 
													A.SOBRENOME, 
													A.EMAIL, 
													A.TELEFONE, 
													A.CELULAR, 
													A.CPFCNPJ, 
													B.LOGRADOURO, 
													B.NUMERO, 
													B.CEP, 
													A.FOTO,
													B.COMPLEMENTO, 
													B.PONTOREFERENCIA, 
													C.CIDADE, 
													D.SIGLA UF, 
													A.TIPOPESSOA,
													A.NOMEFANTASIA,
													A.RAZAOSOCIAL,
													E.NOME BAIRRO,
													A.DATANASC,
													A.EHCLIENTE,
													A.EHFORNECEDOR,
													A.EHENTREGADOR
													FROM ms_pessoa A
													LEFT JOIN ms_pessoaendereco B ON B.PESSOA = A.HANDLE
													LEFT JOIN ms_cidade C ON C.HANDLE = B.CIDADE
													LEFT JOIN ms_uf D ON D.HANDLE = C.UF
													LEFT JOIN ms_bairro E ON E.HANDLE = B.BAIRRO
													GROUP BY A.HANDLE
													ORDER BY A.DATAHORA, B.DATAHORA DESC");
			
			$queryPessoa->execute();
			
			while($rowPessoa = $queryPessoa->fetch(PDO::FETCH_ASSOC)){
				$handlePessoa = $rowPessoa['HANDLE'];
				$nomePessoa = $rowPessoa['NOME'];
				$sobrenomePessoa = $rowPessoa['SOBRENOME'];
				$emailPessoa = $rowPessoa['EMAIL'];
				$telefonePessoa = $rowPessoa['TELEFONE'];
				$celularPessoa = $rowPessoa['CELULAR'];
				$cpfcnpjPessoa = $rowPessoa['CPFCNPJ'];
				$logradouroPessoa = $rowPessoa['LOGRADOURO'];
				$cepPessoa = $rowPessoa['CEP'];
				$complementoPessoa = $rowPessoa['COMPLEMENTO'];
				$pontoreferenciaPessoa = $rowPessoa['PONTOREFERENCIA'];
				$cidadePessoa = $rowPessoa['CIDADE'];
				$ufPessoa = $rowPessoa['UF'];
				$bairroPessoa = $rowPessoa['BAIRRO'];
				$tipopessoaPessoa = $rowPessoa['TIPOPESSOA'];
				$nomefantasiaPessoa = $rowPessoa['NOMEFANTASIA'];
				$razaosocialPessoa = $rowPessoa['RAZAOSOCIAL'];
				$datanascPessoa = date('d-m-Y', strtotime($rowPessoa['DATANASC']));
				$fotoPessoa = $rowPessoa['FOTO'];
				$ehClientePessoa = $rowPessoa['EHCLIENTE'];
				$ehFornecedorPessoa = $rowPessoa['EHFORNECEDOR'];
				$ehEntregadorPessoa = $rowPessoa['EHENTREGADOR'];

				
				if($tipopessoaPessoa == 'Física'){
					$nomePessoaExibe = $nomePessoa;
				}
				else if($tipopessoaPessoa == 'Jurídica'){
					$nomePessoaExibe = $nomefantasiaPessoa;
				}
				else{
					$nomePessoaExibe = null;
				}
				
				$abrangencia = null;
				
				if($ehClientePessoa == 'S'){
					$abrangencia .= ' Cliente ';
				}
				if($ehFornecedorPessoa == 'S'){
					$abrangencia .= ' Fornecedor ';
				}
				if($ehEntregadorPessoa == 'S'){
					$abrangencia .= ' Entregador ';
				}
		 ?>	
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" value="<?php echo $handlePessoa; ?>" name="chk[]"><i></i></label></td>
            <td><?php echo $nomePessoaExibe; ?></td>
            <td><?php echo $telefonePessoa; ?></td>
            <td><?php echo $celularPessoa; ?></td>
            <td><?php echo $cidadePessoa.' - '.$ufPessoa; ?></td>
            <td><?php echo $bairroPessoa; ?></td>
            <td><?php echo $cpfcnpjPessoa; ?></td>
            <td><?php echo $abrangencia; ?></td>
            <td>
              <a href="index.php?p=cadastroPessoaEditar&h=<?php echo $handlePessoa; ?>" class="active" ui-toggle-class=""><i class="fa fa-pencil text-success text-active"></i ></a> &shy;
              <a href="#"><i id="<?php echo $handlePessoa; ?>" class="fa fa-times text-danger text excluirPessoa"></i></a>
            </td>
          </tr>
         <?php
			}
		 ?>	
        </tbody>
      </table>
      </div>
    </div>
    <footer class="panel-footer">
    </footer>
  </div>
</div>
</section>
<?php
	include('model/estrutura/retorno.php');
	include('model/estrutura/excluir.php');
?>
<script>
$(document).ready(function(){
	 $('#Pessoas').DataTable( {
        "language": {
			"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
        }
    } );
	
	jQuery('#formCadastroPessoaPesquisa').submit(function(){
		var dados = jQuery( this ).serialize();

		jQuery.ajax({
			type: "POST",
			url: "index.php?p=cadastroPessoaPesquisa",
			//dataType : 'json', 
			data: dados,
			success: function( data ) {
					var json = $.parseJSON(data);
					$('#retorno').modal('show');
					$('#retorno-body').html(json.retorno);
			}
		});
		return false;
	});
	
	$('.excluirPessoa').click(function(){
		
		$('#excluirModal').modal('show');
		var idPessoa = this.id;
		$('#confirmarExcluir').click(function(){
			$('#excluirModal').modal('hide');
			
			jQuery.ajax({
				type: "POST",
				url: "controller/cadastro/cadastroPessoaExcluir.php",
				//dataType : 'json', 
				data: { "handlePessoa":idPessoa },
				success: function( data ) {
					//console.log(data);
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
		
	});
});
</script>