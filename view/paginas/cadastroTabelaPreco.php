<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-money"></i> Tabela de preço
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
        <a href="?p=cadastroTabelaPrecoInserir"><button class="btn btn-success">Inserir</button> </a>       
      </div>
    </div>
    <div class="table-responsive">
     <div class="col-sm-12">
      <table class="table table-striped b-t b-light" id="categorias">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Codigo</th>
            <th>Promoção</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Valor</th>
            <th>Pontos</th>
            <th>Sabores</th>
            <th>Status</th>
            <th><i class="fa fa-cogs"></i></th>
          </tr>
        </thead>
        <tbody>
         <?php
		 if($ehrestauranteUsuario == 'S'){
			$queryTabelaPreco = $connect->prepare(" SELECT A.`HANDLE`, 
													A.`NOME`, 
													A.`VALOR`, 
													A.`DATAHORA`, 
													A.`OBSERVACAO`, 
													B.NOME CATEGORIA,
													A.`ATIVO`,
													A.QUANTIDADECARDAPIO,
													A.EHPROMOCAO,
													A.PONTOS
													FROM `re_tabelapreco` A
                                                    LEFT JOIN re_cardapiocategoria B ON B.HANDLE = A.CATEGORIA 
													WHERE A.`RESTAURANTE` =  '".$restauranteUsuario."'
											      ");
		 }
		 else{
			 $queryTabelaPreco = $connect->prepare("SELECT A.`HANDLE`, 
													A.`NOME`, 
													A.`VALOR`, 
													A.`DATAHORA`, 
													A.`OBSERVACAO`, 
													B.NOME CATEGORIA,
													A.`ATIVO`,
													A.QUANTIDADECARDAPIO,
													A.EHPROMOCAO,
													A.PONTOS
													FROM `re_tabelapreco` A
                                                    LEFT JOIN re_cardapiocategoria B ON B.HANDLE = A.CATEGORIA
											   		");
		 }
			
			$queryTabelaPreco->execute();
			
			while($rowTabelaPreco = $queryTabelaPreco->fetch(PDO::FETCH_ASSOC)){
				$handleTabelaPreco = $rowTabelaPreco['HANDLE'];
				$nomeTabelaPreco = $rowTabelaPreco['NOME'];
				$valorTabelaPreco = $rowTabelaPreco['VALOR'];
				$ativoTabelaPreco = $rowTabelaPreco['ATIVO'];
				$categoriaTabelaPreco = $rowTabelaPreco['CATEGORIA'];
				$quantidadecardapio = $rowTabelaPreco['QUANTIDADECARDAPIO'];
				$ehPromocao = $rowTabelaPreco['EHPROMOCAO'];
				$pontosTabelaPreco = $rowTabelaPreco['PONTOS'];
				$dataHoraTabelaPreco = date('d/m/Y', strtotime($rowTabelaPreco['DATAHORA']));
								
				if($ativoTabelaPreco == 'S'){
					$statusTabelaPreco = '<font color="#29a43b">Ativo</font>';
				}
				else{
					$statusTabelaPreco = '<font color="#a42929">Inativo</font>';
				}
				
				if($ehPromocao == 'S'){
					$promocaoTabelaPreco = '<font color="#a42929">ON</font>';
				}
				else{
					$promocaoTabelaPreco = 'OFF';
				}
		 ?>	
         
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" value="<?php echo $handleTabelaPreco; ?>" name="chk[]"><i></i></label></td>
            <td><?php echo $handleTabelaPreco; ?></td>
            <td><?php echo $promocaoTabelaPreco; ?></td>
            <td><?php echo $nomeTabelaPreco; ?></td>
            <td><?php echo $categoriaTabelaPreco; ?></td>
            <td><?php echo $valorTabelaPreco ?></td>
            <td><?php echo $pontosTabelaPreco; ?></td>
            <td><?php echo $quantidadecardapio; ?></td>
            <td><?php echo $statusTabelaPreco ?></td>
            <td>
              <a href="index.php?p=cadastroTabelaPrecoEditar&h=<?php echo $handleTabelaPreco; ?>" class="active" ui-toggle-class=""><i class="fa fa-pencil text-success text-active"></i ></a> &shy;
              <a href="#"><i id="<?php echo $handleTabelaPreco; ?>" class="fa fa-times text-danger text excluirTabelaPreco"></i></a>
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
		
	 $('#categorias').DataTable( {
        "language": {
			"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
        }
    } );
	
	$('.excluirTabelaPreco').click(function(){
		
		$('#excluirModal').modal('show');
		var idCardapio = this.id;
		$('#confirmarExcluir').click(function(){
			$('#excluirModal').modal('hide');
			
			jQuery.ajax({
				type: "POST",
				url: "controller/cadastro/cadastroTabelaPrecoExcluir.php",
				//dataType : 'json', 
				data: { "handleTabelaPreco":idCardapio },
				success: function( data ) {
					//console.log(data);
						var json = $.parseJSON(data);
						$('#retorno').modal('show');
						$('#retorno-body').html(json.retorno);
				}
			});
			return false;
		});
		
	});
	
});
</script>