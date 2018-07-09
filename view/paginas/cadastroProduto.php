<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-archive"></i> Produtos
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
        <a href="?p=cadastroProdutoInserir"><button class="btn btn-success">Inserir</button> </a>       
      </div>
      
    </div>
    <div class="table-responsive">
     <div class="col-sm-12">
      <table class="table table-striped b-t b-light" id="Produtos">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Cód. referência</th>
            <th>Nome</th>
            <th>Valor custo</th>
            <th>Valor venda</th>
            <th>Quantidade</th>
            <th>Status</th>
            <th><i class="fa fa-cogs"></i></th>
          </tr>
        </thead>
        <tbody>
         <?php
		 if($ehrestauranteUsuario == 'S'){
			$queryProduto = $connect->prepare("SELECT A.HANDLE, 
											   A.NOME, 
											   A.VALORCUSTO, 
											   A.VALORVENDA, 
											   A.MARGEMLUCRO, 
											   A.QUANTIDADE, 
											   A.UNIDADEMEDIDA, 
											   A.ATIVO,
											   A.CODIGOREFERENCIA, 
											   A.EHKIT, 
											   A.DATAHORA,
											   A.FOTO,
											   A.OBS
											   FROM `re_produto` A
											   WHERE A.RESTAURANTE = '".$restauranteUsuario."'
											   ");
		 }
		 else{
			 $queryProduto = $connect->prepare("SELECT A.HANDLE, 
											   A.NOME, 
											   A.VALORCUSTO, 
											   A.VALORVENDA, 
											   A.MARGEMLUCRO, 
											   A.QUANTIDADE, 
											   A.UNIDADEMEDIDA,  
											   A.ATIVO,
											   A.CODIGOREFERENCIA, 
											   A.EHKIT,
											   A.DATAHORA,
											   A.FOTO,
											   A.OBS
											   FROM `re_produto` A
											   ");
		 }
			
			$queryProduto->execute();
			
			while($rowProduto = $queryProduto->fetch(PDO::FETCH_ASSOC)){
				$handleProduto = $rowProduto['HANDLE'];
				$nomeProduto = $rowProduto['NOME'];
				$valorCustoProduto = $rowProduto['VALORCUSTO'];
				$valorVendaProduto = $rowProduto['VALORVENDA'];
				$margemLucroProduto = $rowProduto['MARGEMLUCRO'];
				$quantidadeProduto = $rowProduto['QUANTIDADE'];
				$unidadeMedidaProduto = $rowProduto['UNIDADEMEDIDA'];
				$ativoProduto = $rowProduto['ATIVO'];
				$codigoReferenciahandleProduto = $rowProduto['CODIGOREFERENCIA'];
				$ehKitProduto = $rowProduto['EHKIT'];
				$dataHoraProduto = date('d/m/Y', strtotime($rowProduto['DATAHORA']));
				$fotoProduto = $rowProduto['FOTO'];
				$observacaoProduto = $rowProduto['OBS'];
								
				if($ativoProduto == 'S'){
					$statusProduto = '<font color="#29a43b">Ativo</font>';
				}
				else{
					$statusProduto = '<font color="#a42929">Inativo</font>';
				}
		 ?>	
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" value="<?php echo $handleProduto; ?>" name="chk[]"><i></i></label></td>
            <td><?php echo $codigoReferenciahandleProduto; ?></td>
            <td><?php echo $nomeProduto; ?></td>
            <td><?php echo 'R$'.number_format($valorCustoProduto,'2', ',', '.'); ?></td>
            <td><?php echo 'R$'.number_format($valorVendaProduto,'2', ',', '.'); ?></td>
            <td><?php echo $quantidadeProduto.' '.$unidadeMedidaProduto; ?></td>
            <td><?php echo $statusProduto; ?></td>
            <td>
              <a href="index.php?p=cadastroProdutoEditar&h=<?php echo $handleProduto; ?>" class="active" ui-toggle-class=""><i class="fa fa-pencil text-success text-active"></i ></a> &shy;
              <a href="controller/cadastro/cadastroProdutoExcluir.php?h=<?php echo $handleProduto; ?>" class="active" ui-toggle-class=""> <i class="fa fa-times text-danger text"></i></a>
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
<script>
$(document).ready(function(){
		
	 $('#Produtos').DataTable( {
        "language": {
			"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
        }
    } );
	
	jQuery('#formCadastroProdutoPesquisa').submit(function(){
		var dados = jQuery( this ).serialize();

		jQuery.ajax({
			type: "POST",
			url: "index.php?p=cadastroProdutoPesquisa",
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
});
</script>