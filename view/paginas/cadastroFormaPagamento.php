<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-money"></i>  <i class="fa fa-times"></i>  <i class="fa fa-credit-card-alt"></i> Formas de pagamento
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
        <a href="?p=cadastroFormaPagamentoInserir"><button class="btn btn-success">Inserir</button> </a>       
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
            <th>Nome</th>
            <th>Status</th>
            <th><i class="fa fa-cogs"></i></th>
          </tr>
        </thead>
        <tbody>
         <?php
			 $queryFormaPagamento = $connect->prepare("SELECT A.HANDLE, B.FORMAPAGAMENTO, A.ATIVO, A.DATAHORA
													   FROM `re_formapagamento` A
													   INNER JOIN ms_formapagamento B ON B.HANDLE = A.FORMAPAGAMENTO
											   		  ");
		 
			
			$queryFormaPagamento->execute();
			
			while($rowFormaPagamento = $queryFormaPagamento->fetch(PDO::FETCH_ASSOC)){
				$handleFormaPagamento = $rowFormaPagamento['HANDLE'];
				$nomeFormaPagamento = $rowFormaPagamento['FORMAPAGAMENTO'];
				$ativoFormaPagamento = $rowFormaPagamento['ATIVO'];
				$dataHoraFormaPagamento = date('d/m/Y', strtotime($rowFormaPagamento['DATAHORA']));
								
				if($ativoFormaPagamento == 'S'){
					$statusFormaPagamento = '<font color="#29a43b">Ativo</font>';
				}
				else{
					$statusFormaPagamento = '<font color="#a42929">Inativo</font>';
				}
		 ?>	
         
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" value="<?php echo $handleFormaPagamento; ?>" name="chk[]"><i></i></label></td>
            <td><?php echo $handleFormaPagamento; ?></td>
            <td><?php echo $nomeFormaPagamento; ?></td>
            <td><?php echo $statusFormaPagamento; ?></td>
            <td>
              <a href="index.php?p=cadastroFormaPagamentoEditar&h=<?php echo $handleFormaPagamento; ?>" class="active" ui-toggle-class=""><i class="fa fa-pencil text-success text-active"></i ></a> &shy;
              <a href="#"><i id="<?php echo $handleFormaPagamento; ?>" class="fa fa-times text-danger text excluirFormaPagamento"></i></a>
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
	
	$('.excluirFormaPagamento').click(function(){
		
		$('#excluirModal').modal('show');
		var handleFormaPagamento = this.id;
		$('#confirmarExcluir').click(function(){
			$('#excluirModal').modal('hide');
			
			jQuery.ajax({
				type: "POST",
				url: "controller/cadastro/cadastroFormaPagamentoExcluir.php",
				//dataType : 'json', 
				data: { "handleFormaPagamento":handleFormaPagamento },
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