<section class="wrapper" style="margin-top:20px;">
		<!-- //market-->
		<div class="market-updates">
		<p><br></p>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users"> </i>
					</div>
					 <div class="col-md-8 market-update-left">
					 <h4>Clientes</h4>
					<h3>
						<?php 
							$query_count_clientes =  $connect->prepare("SELECT COUNT( HANDLE ) AS COUNT_CLI FROM ms_pessoa");
					
							$query_count_clientes->execute();

							$row_count_clientes = $query_count_clientes->fetch(PDO::FETCH_ASSOC);
						 	echo $row_count_clientes['COUNT_CLI'];
						?>
					</h3>
					<p>Totalizador de clientes cadastrados.</p>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-usd" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>Pagar</h4>
						<h3>R$ 0,00</h3>
						<p>Totalizador de contas a pagar hoje.</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-usd"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Receber</h4>
						<h3>R$ 0,00</h3>
						<p>Totalizador de contas a receber hoje.</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-wrench" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Serviços</h4>
						<h3>
						<?php 
							$query_count_servicos =  $connect->prepare("SELECT COUNT( HANDLE ) AS COUNT_SERVICOS FROM of_os");
					
							$query_count_servicos->execute();

							$row_count_servicos = $query_count_servicos->fetch(PDO::FETCH_ASSOC);
						 	echo $row_count_servicos['COUNT_SERVICOS'];
						?>
						</h3>
						<p>Totalizador de serviços realizados pela oficina.</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>	
		<!-- //market-->
		<div class="agileits-w3layouts-stats">
					<div class="col-md-12 stats-info stats-last widget-shadow">
						<div class="stats-last-agile">
						<header class="agileits-box-header clearfix">
							<h3>OS em aberto</h3>
						</header>
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
					<div class="clearfix"> </div>
				</div>		
</section>

	<script type="text/javascript" src="view/tecnologia/js/monthly.js"></script>
	<script type="text/javascript">
		$(window).load( function() {
						
			$('#ultimosPedidos').DataTable( {
				"language": {
					"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
				}
			} );
		});
	</script>
	<!-- //calendar -->