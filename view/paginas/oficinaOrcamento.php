<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-wrench"></i> Orçamentos
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
        <a href="?p=oficinaOrcamentoInserir"><button class="btn btn-success">Inserir</button> </a>       
      </div>
      
    </div>
    <div class="table-responsive">
     <div class="col-sm-12">
      <table class="table table-striped b-t b-light" id="OSs">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Número</th>
            <th>Data</th>
            <th>Cliente</th>
            <th>Veículo</th>
            <th>Marca / Modelo</th>
            <th><i class="fa fa-cogs"></i></th>
          </tr>
        </thead>
        <tbody>
         <?php
			$queryOC = $connect->prepare("SELECT * FROM of_orcamento");
			
			$queryOC->execute();
			
			while($rowOC = $queryOC->fetch(PDO::FETCH_ASSOC)){
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
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" value="<?php echo $handleOC; ?>" name="chk[]"><i></i></label></td>
            <td><?php echo $handleOC; ?></td>
            <td><?php echo $dataHoraOC; ?></td>
            <td><?php echo $clienteOC; ?></td>
            <td><?php echo $placaOC; ?></td>
            <td><?php echo $marcaOC.' / '.$modeloOC; ?></td>
            <td>
              <a href="model/oficina/oficinaOrcamentoImprimir.php?h=<?php echo $handleOC; ?>" target="_blank"><i class="fa fa-print text-info text"></i></a>
              <a href="index.php?p=oficinaOrcamentoEditar&h=<?php echo $handleOC; ?>" class="active" ui-toggle-class=""><i class="fa fa-pencil text-success text-active"></i ></a> &shy;
              <a href="#"><i id="<?php echo $handleOC; ?>" class="fa fa-times text-danger text excluirOS"></i></a>
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
	 $('#OSs').DataTable( {
        "language": {
			"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
        }
    } );
	
	jQuery('#formCadastroOSPesquisa').submit(function(){
		var dados = jQuery( this ).serialize();

		jQuery.ajax({
			type: "POST",
			url: "index.php?p=cadastroOSPesquisa",
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
	
	$('.excluirOS').click(function(){
		
		$('#excluirModal').modal('show');
		var idOS = this.id;
		$('#confirmarExcluir').click(function(){
			$('#excluirModal').modal('hide');
			
			jQuery.ajax({
				type: "POST",
				url: "controller/oficina/oficinaOrcamentoExcluir.php",
				//dataType : 'json', 
				data: { "handleOS":idOS },
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