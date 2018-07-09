<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-money"></i><i class="fa fa-motorcycle"></i> Tabela de preço entrega
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
        <a href="?p=cadastroTabelaPrecoEntregaInserir"><button class="btn btn-success">Inserir</button> </a>       
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
            <th>Cidade - UF</th>
            <th>Bairro</th>
            <th>Valor</th>
            <th>Status</th>
            <th><i class="fa fa-cogs"></i></th>
          </tr>
        </thead>
        <tbody>
         <?php
		 if($ehrestauranteUsuario == 'S'){
			$queryTabelaPrecoEntrega = $connect->prepare("SELECT A.HANDLE, 
														  A.VALOR, 
														  B.CIDADE, 
														  C.SIGLA UF, 
														  D.NOME BAIRRO,
														  A.ATIVO,
														  A.DATAHORA
														  FROM `re_pedidoentregavalor` A
														  INNER JOIN ms_cidade B ON B.HANDLE = A.CIDADE
														  INNER JOIN ms_uf C ON C.HANDLE = B.UF
														  INNER JOIN ms_bairro D ON D.HANDLE = A.BAIRRO
														  WHERE A.RESTAURANTE =  '".$restauranteUsuario."'
											      		 ");
		 }
		 else{
			$queryTabelaPrecoEntrega = $connect->prepare("SELECT A.HANDLE, 
														  A.VALOR, 
														  B.CIDADE, 
														  C.SIGLA UF, 
														  D.NOME BAIRRO,
														  A.ATIVO,
														  A.DATAHORA
														  FROM `re_pedidoentregavalor` A
														  INNER JOIN ms_cidade B ON B.HANDLE = A.CIDADE
														  INNER JOIN ms_uf C ON C.HANDLE = B.UF
														  INNER JOIN ms_bairro D ON D.HANDLE = A.BAIRRO
											   			 ");
		 }
			
			$queryTabelaPrecoEntrega->execute();
			
			while($rowTabelaPrecoEntrega = $queryTabelaPrecoEntrega->fetch(PDO::FETCH_ASSOC)){
				$handleTabelaPrecoEntrega = $rowTabelaPrecoEntrega['HANDLE'];
				$bairroTabelaPrecoEntrega = $rowTabelaPrecoEntrega['BAIRRO'];
				$valorTabelaPrecoEntrega = $rowTabelaPrecoEntrega['VALOR'];
				$ativoTabelaPrecoEntrega = $rowTabelaPrecoEntrega['ATIVO'];
				$cidadeTabelaPrecoEntrega = $rowTabelaPrecoEntrega['CIDADE'];
				$ufTabelaPrecoEntrega = $rowTabelaPrecoEntrega['UF'];
				$dataHoraTabelaPrecoEntrega = date('d/m/Y', strtotime($rowTabelaPrecoEntrega['DATAHORA']));
								
				if($ativoTabelaPrecoEntrega == 'S'){
					$statusTabelaPrecoEntrega = '<font color="#29a43b">Ativo</font>';
				}
				else{
					$statusTabelaPrecoEntrega = '<font color="#a42929">Inativo</font>';
				}
		 ?>	
         
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" value="<?php echo $handleTabelaPrecoEntrega; ?>" name="chk[]"><i></i></label></td>
            <td><?php echo $handleTabelaPrecoEntrega; ?></td>
            <td><?php echo $cidadeTabelaPrecoEntrega.' - '.$ufTabelaPrecoEntrega; ?></td>
            <td><?php echo $bairroTabelaPrecoEntrega; ?></td>
            <td><?php echo 'R$ '.$valorTabelaPrecoEntrega; ?></td>
            <td><?php echo $statusTabelaPrecoEntrega ?></td>
            <td>
              <a href="index.php?p=cadastroTabelaPrecoEntregaEditar&h=<?php echo $handleTabelaPrecoEntrega; ?>" class="active" ui-toggle-class=""><i class="fa fa-pencil text-success text-active"></i ></a> &shy;
              <a href="#"><i id="<?php echo $handleTabelaPrecoEntrega; ?>" class="fa fa-times text-danger text excluirTabelaPrecoEntrega"></i></a>
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
	
	$('.excluirTabelaPrecoEntrega').click(function(){
		
		$('#excluirModal').modal('show');
		var idTabelaPrecoEntrega = this.id;
		$('#confirmarExcluir').click(function(){
			$('#excluirModal').modal('hide');
			
			jQuery.ajax({
				type: "POST",
				url: "controller/cadastro/cadastroTabelaPrecoEntregaExcluir.php",
				//dataType : 'json', 
				data: { "handleTabelaPrecoEntrega":idTabelaPrecoEntrega },
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