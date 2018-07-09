<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-wrench"></i> Ordens de serviço
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
        <a href="?p=oficinaOrdensDeServicoInserir"><button class="btn btn-success">Inserir</button> </a>       
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
            <th>Protocolo</th>
            <th>Data início</th>
            <th>Data final</th>
            <th>Cliente</th>
            <th>Veículo</th>
            <th>Técnico</th>
            <th>Status</th>
            <th><i class="fa fa-cogs"></i></th>
          </tr>
        </thead>
        <tbody>
         <?php
				$queryOS = $connect->prepare("SELECT A.HANDLE, 
											  A.STATUS, 
											  A.DATAINICIAL, 
											  A.DATAFINAL, 
											  A.GARANTIA, 
											  A.DESCRICAO, 
											  A.DEFEITO, 
											  A.OBERVACOES, 
											  A.LAUDOTECNICO, 
											  A.DATAHORA, 
											  A.PROTOCOLO, 
											  B.NOME CLIENTEOS, 
											  C.NOME TECNICOOS, 
											  D.PLACA VEICULO
											  FROM of_os A
											  LEFT JOIN ms_pessoa B ON B.HANDLE = A.CLIENTE
											  LEFT JOIN ms_pessoa C ON C.HANDLE = A.TECNICO
											  LEFT JOIN ms_veiculos D ON D.HANDLE = A.VEICULO
											 ");
			
			$queryOS->execute();
			
			while($rowOS = $queryOS->fetch(PDO::FETCH_ASSOC)){
				  $handleOS = $rowOS['HANDLE'];
				  $statusOS = $rowOS['STATUS']; 
				  $dataInicialOS = date('d/m/Y', strtotime($rowOS['DATAINICIAL']));
				  $dataFinalOS = date('d/m/Y', strtotime($rowOS['DATAFINAL'])); 
				  $garantiaOS = $rowOS['GARANTIA'];
				  $descricaoOS = $rowOS['DESCRICAO']; 
				  $defeitoOS = $rowOS['DEFEITO'];
				  $observacoesOS = $rowOS['OBERVACOES']; 
				  $laudoTecnicoOS = $rowOS['LAUDOTECNICO']; 
				  $dataHoraOS = date('d/m/Y H:i:s', strtotime($rowOS['DATAHORA'])); 
				  $protocoloOS = $rowOS['PROTOCOLO']; 
				  $clienteOS = $rowOS['CLIENTEOS']; 
				  $tecnicoOS = $rowOS['TECNICOOS']; 
				  $veiculoOS = $rowOS['VEICULO'];				
		 ?>	
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" value="<?php echo $handleOS; ?>" name="chk[]"><i></i></label></td>
            <td><?php echo $handleOS; ?></td>
            <td><?php echo $protocoloOS; ?></td>
            <td><?php echo $dataInicialOS; ?></td>
            <td><?php echo $dataFinalOS; ?></td>
            <td><?php echo $clienteOS; ?></td>
            <td><?php echo $veiculoOS; ?></td>
            <td><?php echo $tecnicoOS; ?></td>
            <td><?php echo $statusOS; ?></td>
            <td>
              <a href="model/oficina/oficinaOrdensDeServicoImprimir.php?h=<?php echo $handleOS; ?>" target="_blank"><i class="fa fa-print text-info text"></i></a>
              <a href="index.php?p=oficinaOrdensDeServicoEditar&h=<?php echo $handleOS; ?>" class="active" ui-toggle-class=""><i class="fa fa-pencil text-success text-active"></i ></a> &shy;
              <a href="#"><i id="<?php echo $handleOS; ?>" class="fa fa-times text-danger text excluirOS"></i></a>
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
				url: "controller/oficina/oficinaOrdensDeServicoExcluir.php",
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