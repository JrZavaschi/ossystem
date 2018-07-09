e<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-users"></i> Veiculos
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
        <a href="?p=cadastroVeiculoInserir"><button class="btn btn-success">Inserir</button> </a>       
      </div>
      
    </div>
    <div class="table-responsive">
     <div class="col-sm-12">
      <table class="table table-striped b-t b-light" id="Veiculos">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Cliente</th>
            <th>Placa</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Ano/AnoModelo</th>
            <th><i class="fa fa-cogs"></i></th>
          </tr>
        </thead>
        <tbody>
         <?php
			
				$queryVeiculo = $connect->prepare("SELECT A.HANDLE, 
												  A.PLACA,
												  A.MARCA, 
												  A.MODELO, 
												  A.ANO, 
												  A.ANOMODELO, 
												  A.COR, 
												  A.CHASSIS, 
												  A.FOTO, 
												  A.COMBUSTIVEL, 
												  A.NUMEROMOTOR, 
												  A.QUILOMETRAGEM, 
												  A.DATAHORA, 
												  A.CLIENTE, 
												  B.HANDLE HANDLECLIENTE, 
												  B.NOME NOMECLIENTE, 
												  B.NOMEFANTASIA 
												  NOMEFANTASIACLIENTE, 
												  B.TIPOPESSOA
												  FROM `ms_veiculos` A
												  LEFT JOIN ms_pessoa B ON B.HANDLE = A.CLIENTE
												  ORDER BY A.PLACA");
			
			$queryVeiculo->execute();
			
			while($rowVeiculo = $queryVeiculo->fetch(PDO::FETCH_ASSOC)){
				$handleVeiculo = $rowVeiculo['HANDLE'];
				$placa = $rowVeiculo['PLACA'];
				$marca = $rowVeiculo['MARCA'];
				$modelo = $rowVeiculo['MODELO'];
				$ano = $rowVeiculo['ANO'];
				$anomodelo = $rowVeiculo['ANOMODELO'];
				$cor = $rowVeiculo['COR'];
				$chassis = $rowVeiculo['CHASSIS']; 
				$foto = $rowVeiculo['FOTO'];
				$combustivel = $rowVeiculo['COMBUSTIVEL']; 
				$numeromotor = $rowVeiculo['NUMEROMOTOR']; 
				$quilometragem = $rowVeiculo['QUILOMETRAGEM']; 
				$datahora = $rowVeiculo['DATAHORA']; 
				$handleCliente = $rowVeiculo['HANDLECLIENTE']; 
				$nomeCliente = $rowVeiculo['NOMECLIENTE']; 
				$nomeFantasiaCliente = $rowVeiculo['NOMEFANTASIACLIENTE']; 
				$tipoPessoa = $rowVeiculo['TIPOPESSOA'];
				
				if($tipoPessoa == 'Física'){
					$nomeClienteExibe = $nomeCliente;
				}
				else if($tipoPessoa == 'Jurídica'){
					$nomeClienteExibe = $nomeFantasiaCliente;
				}
				else{
					$nomeClienteExibe = null;
				}
		 ?>	
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" value="<?php echo $handleVeiculo; ?>" name="chk[]"><i></i></label></td>
            <td><?php echo $nomeClienteExibe; ?></td>
            <td><?php echo $placa; ?></td>
            <td><?php echo $marca; ?></td>
            <td><?php echo $modelo; ?></td>
            <td><?php echo $ano.' / '.$anomodelo; ?></td>
            <td>
              <a href="index.php?p=cadastroVeiculoEditar&h=<?php echo $handleVeiculo; ?>" class="active" ui-toggle-class=""><i class="fa fa-pencil text-success text-active"></i ></a> &shy;
              <a href="#"><i id="<?php echo $handleVeiculo; ?>" class="fa fa-times text-danger text excluirVeiculo"></i></a>
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
	 $('#Veiculos').DataTable( {
        "language": {
			"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
        }
    } );
	
	jQuery('#formCadastroVeiculoPesquisa').submit(function(){
		var dados = jQuery( this ).serialize();

		jQuery.ajax({
			type: "POST",
			url: "index.php?p=cadastroVeiculoPesquisa",
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
	
	$('.excluirVeiculo').click(function(){
		
		$('#excluirModal').modal('show');
		var idVeiculo = this.id;
		$('#confirmarExcluir').click(function(){
			$('#excluirModal').modal('hide');
			
			jQuery.ajax({
				type: "POST",
				url: "controller/cadastro/cadastroVeiculoExcluir.php",
				//dataType : 'json', 
				data: { "handleVeiculo":idVeiculo },
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