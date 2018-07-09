<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');
$handleOC = Sistema::getGet('h');

$queryOC = $connect->prepare("SELECT A.*
							  FROM of_orcamento A
							  WHERE A.HANDLE = '".$handleOC."'
							 ");

$queryOC->execute();

$rowOC = $queryOC->fetch(PDO::FETCH_ASSOC);
  	$handleOC = $rowOC['HANDLE'];
	$clienteOC = $rowOC['CLIENTE'];
	$placaOC = $rowOC['PLACA'];
	$marcaOC = $rowOC['MARCA'];
	$modeloOC = $rowOC['MODELO'];
	$anoOC = $rowOC['ANO'];
	$anomodeloOC = $rowOC['ANOMODELO'];
	$garantiaOC = $rowOC['GARANTIA'];
	$descricao = $rowOC['DESCRICAO'];
	$observacao = $rowOC['OBSERVACAO'];


$queryEmitente = $connect->prepare("SELECT * FROM ms_oficina");

$queryEmitente->execute();

$rowEmitente = $queryEmitente->fetch(PDO::FETCH_ASSOC);
  $handle = $rowEmitente['HANDLE'];
  $razaoSocial = $rowEmitente['RAZAOSOCIAL']; 
  $nomeFantasia = $rowEmitente['NOMEFANTASIA'];
  $cnpj = $rowEmitente['CNPJ']; 
  $ie = $rowEmitente['IE'];
  $ehAtivo = $rowEmitente['EHATIVO']; 
  $logradouro = $rowEmitente['LOGRADOURO']; 
  $numero = $rowEmitente['NUMERO']; 
  $bairro = $rowEmitente['BAIRRO']; 
  $cidade = $rowEmitente['CIDADE']; 
  $uf = $rowEmitente['UF']; 
  $cep = $rowEmitente['CEP']; 
  $logo = $rowEmitente['LOGO'];
  $telefone = $rowEmitente['TELEFONE'];
  $email = $rowEmitente['EMAIL'];
  $dataHora = date('d/m/Y H:i:s', strtotime($rowEmitente['DATAHORA']));




$querySomaTotalProdutos = $connect->prepare("SELECT SUM( VALORTOTAL ) VALORTOTAL FROM of_os_produtos WHERE OS = '".$handleOC."'");
$querySomaTotalProdutos->execute();
$rowSomaTotalProdutos = $querySomaTotalProdutos->fetch(PDO::FETCH_ASSOC);
$valorTotalSomaProdutos = $rowSomaTotalProdutos['VALORTOTAL'];


$querySomaTotalServicos = $connect->prepare("SELECT SUM( VALORTOTAL ) VALORTOTAL FROM of_os_servicos WHERE OS = '".$handleOC."'");
$querySomaTotalServicos->execute();
$rowSomaTotalServicos = $querySomaTotalServicos->fetch(PDO::FETCH_ASSOC);
$valorTotalSomaServicos = $rowSomaTotalServicos['VALORTOTAL'];


$valorTotalOS = Valor( number_format( $valorTotalSomaProdutos, 2, ',', '.' ) ) + Valor( number_format( $valorTotalSomaServicos, 2, ',', '.' ) );

?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Layout DANFE</title>
      <link rel="stylesheet" href="../../view/tecnologia/css/styleImpressaoDanfe.css">
      
	  <script type="text/javascript" src="../../view/tecnologia/js/jquery.js"></script>
	  <script type="text/javascript" src="http://barcode-coder.com/js/jquery-barcode-last.min.js"></script>
	  <script type="text/javascript">
		$(document).ready(function(){
			$("#barcode").barcode(<?php echo $handleOC; ?>, "ean13"); 
		});
	  </script>
</head>
 
<body>
  <div class="danfe">
  <!--div class="marca-dagua">Sem valor fiscal</div-->
  <div class="blocos">
    <table>
      <tr>
        <td rowspan="3">
        	<img src="../../view/tecnologia/uploads/oficina/emitente/<?php echo $logo; ?>" width="180px" height="auto" alt="">
        </td>
        <td rowspan="3" class="emitente">
          <p class="texto-campo negrito"><?php echo $razaoSocial; ?></p>
          <p class="texto-campo"><?php echo $logradouro.', '.$numero; ?></p>
          <p class="texto-campo"><?php echo $bairro; ?></p>
          <p class="texto-campo"><?php echo $cidade.' - '.$uf; ?></p>
          <p class="texto-campo">CEP: <?php echo $cep; ?></p>
          <p class="texto-campo">Fone: <?php echo $telefone; ?></p>
          <p class="texto-campo"><?php echo 'www.olssonmotorsport.com.br'; ?></p>
        </td>
        <td rowspan="3" class="tipo-danfe">
          <p class="titulo-campo negrito center-align">OC</p>
          <p class="titulo-campo descricao-sigla">Orçamento</p>
          <p class="texto-campo ">Nº <span class="texto-campo negrito"><?php echo $handleOC; ?></span></p>
          <p class="texto-campo 	">Série <span class="texto-campo negrito">1</span></p>
        </td>
        <td class="codigo-barras center-align valign-middle">
          <p class="titulo-campo">Número</p>
          <p class="texto-campo negrito"><?php echo $handleOC; ?></p>
        </td>
      </tr>
      <tr>
        <td class="chave-acesso valign-middle">
           <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAR8AAAAeAQAAAAA9ByfxAAAAX0lEQVR4nGP6&#10;Txj8Y2IgAtBb0a8U9dzUs1OM031PzTJRTz0bC2NmnnWdIyTse7frmMOgdPio&#10;olFFRCpim3Nz8mzjnLMzN5ulnbk523gxjDndeHfKu7eblcusDgxGhwMAdfVI&#10;GBBgXSsAAAAASUVORK5CYII=&#10;">
        </td>
      </tr>
      <tr>
        <td class="consulta-sefaz valign-middle">
          <!--p class="center-align">Consulta de autenticidade no portal nacional da NF-e www.nfe.fazenda.gov.br/portal ou no site da Sefaz Autorizadora</p-->
        </td>
      </tr>
      <!--tr>
        <td colspan="2">
          <p class="titulo-campo">Natureza da Operação</p>
          <p class="texto-campo">Venda de serviços e produtos</p>
        </td>
        <td class="numero-registro-dpec">
          <!--p class="titulo-campo">Número de Registro DPEC</p>
          <p class="texto-campo">891160001968095</p>
        </td>
      </tr-->
    </table>
    <table>
      <tr>
        <td class="sem-borda-topo inscricao-estadual">
          <p class="titulo-campo">Inscrição Estadual</p>
          <p class="texto-campo"><?php echo $ie; ?></p>
        </td>
        <td class="sem-borda-topo inscricao-estadual-st">
          <p class="titulo-campo"></p>
          <p class="texto-campo"></p>
        </td>
        <td class="sem-borda-topo cnpj">
          <p class="titulo-campo">CNPJ</p>
          <p class="texto-campo"><?php echo $cnpj; ?></p>
        </td>
      </tr>
    </table>
 
    <div class="titulo-bloco">Cliente / Veículo</div>
    <table>
      <tr>
        <td>
          <p class="titulo-campo">Nome / Razão Social</p>
          <p class="texto-campo"><?php echo $clienteOC; ?></p>
        </td>
        <td>
          <p class="titulo-campo">Veículo</p>
          <p class="texto-campo"><?php echo $placaOC; ?></p>
        </td>
        <td class="data-emissao">
          <p class="titulo-campo">Marca</p>
          <p class="texto-campo"><?php echo $marcaOC; ?></p>
        </td>
      </tr>
    </table>
    <table>
      <tr>
        <td class="sem-borda-topo endereco">
          <p class="titulo-campo">Modelo</p>
          <p class="texto-campo"><?php echo $modeloOC; ?></p>
        </td>
        <td class="sem-borda-topo">
          <p class="titulo-campo">Ano</p>
          <p class="texto-campo"><?php echo $anoOC; ?></p>
        </td>
        <td class="sem-borda-topo cep">
          <p class="titulo-campo">Ano/Modelo</p>
          <p class="texto-campo"><?php echo $anomodeloOC; ?></p>
        </td>
        <td class="sem-borda-topo data-entrada-saida">
          <p class="titulo-campo">Garantia</p>
          <p class="texto-campo"><?php echo $garantiaOC; ?></p>
        </td>
      </tr>
    </table>
 
    <div class="titulo-bloco">Orçamento</div>
    <table>
      <tr>
        <td class="observacoes">
          <p class="titulo-campo">Descrição Serviços/Produtos</p>
          <p class="texto-campo"><?php echo $descricao; ?></p>
        </td>
        <td class="observacoes">
          <p class="titulo-campo">Observações</p>
          <p class="texto-campo"><?php echo $observacao; ?></p>
        </td>
      </tr>
    </table>
  </div>
</div>
   
   
</body>
</html>