<?php
include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();
include('../../controller/estrutura/logou.php');
$handleOS = Sistema::getGet('h');

$queryOS = $connect->prepare("SELECT MAX(E.HANDLE) HANDLEENDERECO, 
							  A.HANDLE, 
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
							  B.IERG, 
							  B.CELULAR TELEFONECLIENTE,
							  B.CPFCNPJ CPFCNPJCLIENTE,
                              E.LOGRADOURO LOGRADOUROCLIENTE,
                              E.NUMERO NUMEROCLIENTE,
                              F.NOME BAIRROCLIENTE,
                              E.CEP CEPCLIENTE,
                              G.CIDADE CIDADECLIENTE,
                              H.SIGLA UFCLIENTE,
							  C.NOME TECNICOOS, 
							  D.PLACA VEICULO,
                              D.ANO,
                              D.ANOMODELO,
                              A.KMVEICULO,
                              D.MARCA,
                              D.MODELO
							  FROM of_os A
							  LEFT JOIN ms_pessoa B ON B.HANDLE = A.CLIENTE
							  LEFT JOIN ms_pessoa C ON C.HANDLE = A.TECNICO
							  LEFT JOIN ms_veiculos D ON D.HANDLE = A.VEICULO
							  LEFT JOIN ms_pessoaendereco E ON E.PESSOA = B.HANDLE
                              LEFT JOIN ms_bairro F ON F.HANDLE = E.BAIRRO
                              LEFT JOIN ms_cidade G ON G.HANDLE = E.CIDADE
                              LEFT JOIN ms_uf H ON H.HANDLE = G.UF
							  WHERE A.HANDLE = '".$handleOS."'
							 ");

$queryOS->execute();

$rowOS = $queryOS->fetch(PDO::FETCH_ASSOC);
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
  $cppfCnpjClienteOS = $rowOS['CPFCNPJCLIENTE'];
  $logradouroClienteOS = $rowOS['LOGRADOUROCLIENTE'];
  $numeroClienteOS = $rowOS['NUMEROCLIENTE'];
  $bairroClienteOS = $rowOS['BAIRROCLIENTE'];
  $cepClienteOS = $rowOS['CEPCLIENTE'];
  $cidadeClienteOS = $rowOS['CIDADECLIENTE'];
  $ufClienteOS = $rowOS['UFCLIENTE'];	
  $IERGCliente = $rowOS['IERG'];
  $telefoneClienteOS = $rowOS['TELEFONECLIENTE'];
  $anoVeiculoOS = $rowOS['ANO'];
  $anoModeloVeiculoOS = $rowOS['ANOMODELO'];
  $kmVeiculoOS = $rowOS['KMVEICULO'];
  $marcaVeiculoOS = $rowOS['MARCA'];
  $modeloVeiculoOS = $rowOS['MODELO'];


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




$querySomaTotalProdutos = $connect->prepare("SELECT SUM( VALORTOTAL ) VALORTOTAL FROM of_os_produtos WHERE OS = '".$handleOS."'");
$querySomaTotalProdutos->execute();
$rowSomaTotalProdutos = $querySomaTotalProdutos->fetch(PDO::FETCH_ASSOC);
$valorTotalSomaProdutos = $rowSomaTotalProdutos['VALORTOTAL'];


$querySomaTotalServicos = $connect->prepare("SELECT SUM( VALORTOTAL ) VALORTOTAL FROM of_os_servicos WHERE OS = '".$handleOS."'");
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
			$("#barcode").barcode(<?php echo $protocoloOS; ?>, "ean13"); 
		});
	  </script>
</head>
 
<body>
  <div class="danfe">
  <!--div class="marca-dagua">Sem valor fiscal</div-->
  <div class="blocos">
    <table>
      <tr>
        <td colspan="2">
          <p class="titulo-campo">Recebemos de <span><?php echo $clienteOS; ?></span> os produtos e serviços constantes da ordem de serviço indicada ao lado
        </td>
        <td rowspan="2" class="canhoto-numero-nfe">
          <p class="titulo-campo negrito center-align">Ordem de Serviço</p>
          <p class="titulo-campo negrito">Nº <span class="texto-campo negrito"><?php echo $handleOS; ?></span></p>
          <p class="titulo-campo negrito">Série <span class="texto-campo negrito">1</span></p>
        </td>
      </tr>
      <tr>
        <td class="data-recebimento">
          <p class="titulo-campo">Data de recebimento</p>
        </td>
        <td>
          <p class="titulo-campo">Identificação e assinatura do recebedor</p>
          <!--p class="texto-campo">NF-e Emitida em Ambiente de Homologacao - Sem Valor Fiscal</p-->
        </td>
      </tr>
    </table>
 
    <div class="linha-tracejada"></div>
 
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
          <p class="titulo-campo negrito center-align">OS</p>
          <p class="titulo-campo descricao-sigla">Ordem de serviço</p>
          <p class="texto-campo ">Nº <span class="texto-campo negrito"><?php echo $handleOS; ?></span></p>
          <p class="texto-campo 	">Série <span class="texto-campo negrito">1</span></p>
        </td>
        <td class="codigo-barras center-align valign-middle">
          <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAR8AAAAeAQAAAAA9ByfxAAAAX0lEQVR4nGP6&#10;Txj8Y2IgAtBb0a8U9dzUs1OM031PzTJRTz0bC2NmnnWdIyTse7frmMOgdPio&#10;olFFRCpim3Nz8mzjnLMzN5ulnbk523gxjDndeHfKu7eblcusDgxGhwMAdfVI&#10;GBBgXSsAAAAASUVORK5CYII=&#10;">
        </td>
      </tr>
      <tr>
        <td class="chave-acesso valign-middle">
          <p class="titulo-campo">Protocolo</p>
          <p class="texto-campo negrito"><?php echo $protocoloOS; ?></p>
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
 
    <div class="titulo-bloco">Cliente</div>
    <table>
      <tr>
        <td>
          <p class="titulo-campo">Nome / Razão Social</p>
          <p class="texto-campo"><?php echo $clienteOS; ?></p>
        </td>
        <td>
          <p class="titulo-campo">CNPJ / CPF</p>
          <p class="texto-campo"><?php echo $cppfCnpjClienteOS; ?></p>
        </td>
        <td class="data-emissao">
          <p class="titulo-campo">Data da Emissão</p>
          <p class="texto-campo"><?php echo $dataHoraOS; ?></p>
        </td>
      </tr>
    </table>
    <table>
      <tr>
        <td class="sem-borda-topo endereco">
          <p class="titulo-campo">Endereço</p>
          <p class="texto-campo"><?php echo $logradouroClienteOS.', '.$numeroClienteOS; ?></p>
        </td>
        <td class="sem-borda-topo">
          <p class="titulo-campo">Bairro / Distrito</p>
          <p class="texto-campo"><?php echo $bairroClienteOS; ?></p>
        </td>
        <td class="sem-borda-topo cep">
          <p class="titulo-campo">CEP</p>
          <p class="texto-campo"><?php echo $cepClienteOS; ?></p>
        </td>
        <td class="sem-borda-topo data-entrada-saida">
          <p class="titulo-campo">Data de Entrada</p>
          <p class="texto-campo"><?php echo $dataInicialOS; ?></p>
        </td>
      </tr>
    </table>
    <table>
      <tr>
        <td class="sem-borda-topo">
          <p class="titulo-campo">Município</p>
          <p class="texto-campo"><?php echo $cidadeClienteOS; ?></p>
        </td>
        <td class="sem-borda-topo">
          <p class="titulo-campo">Fone / Fax</p>
          <p class="texto-campo"><?php echo $telefoneClienteOS; ?></p>
        </td>
        <td class="sem-borda-topo">
          <p class="titulo-campo">UF</p>
          <p class="texto-campo"><?php echo $ufClienteOS; ?></p>
        </td>
        <td class="sem-borda-topo">
          <p class="titulo-campo">Inscrição Estadual/RG</p>
          <p class="texto-campo"><?php echo $IERGCliente; ?></p>
        </td>
        <td class="sem-borda-topo hora-saida">
          <p class="titulo-campo">Data de Saída</p>
          <p class="texto-campo"><?php echo $dataFinalOS; ?></p>
        </td>
      </tr>
    </table>
 
    <div class="titulo-bloco">Veículo</div>
    <table>
      <tr>
        <td>
          <p class="titulo-campo">Placa</p>
          <p class="texto-campo"><?php echo $veiculoOS; ?></p>
        </td>
        <td>
          <p class="titulo-campo">Marca / Modelo</p>
          <p class="texto-campo"><?php echo $marcaVeiculoOS.' / '.$modeloVeiculoOS; ?></p>
        </td>
        <td>
          <p class="titulo-campo">Ano / Ano Modelo</p>
          <p class="texto-campo"><?php echo $anoVeiculoOS.' / '.$anoModeloVeiculoOS; ?></p>
        </td>
        <td>
          <p class="titulo-campo">Quilometragem</p>
          <p class="texto-campo"><?php echo $kmVeiculoOS; ?></p>
        </td>
      </tr>
    </table>
 
    <div class="titulo-bloco">Cálculo da OS</div>
    <table>
      <tr>
        <td class="imposto">
          <p class="titulo-campo">Valor do Frete</p>
        </td>
        <td class="imposto">
          <p class="titulo-campo">Desconto</p>
        </td>
        <td class="imposto">
          <p class="titulo-campo">Outras Despesas</p>
        </td>
        <td class="imposto">
          <p class="titulo-campo">Total Serviços</p>
          <p class="texto-campo">R$ <?php echo number_format($valorTotalSomaServicos, 2, ',', '.'); ?></p>
        </td>
        <td class="imposto">
          <p class="titulo-campo">Total Produtos</p>
          <p class="texto-campo">R$ <?php echo number_format($valorTotalSomaProdutos, 2, ',', '.'); ?></p>
        </td>
        <td class="imposto">
          <p class="titulo-campo">Valor Total da OS</p>
          <p class="texto-campo">R$ <?php echo number_format($valorTotalOS, 2, ',', '.'); ?></p>
        </td>
      </tr>
    </table>
 
    <!--div class="titulo-bloco">Transportador / Volumes</div>
    <table>
      <tr>
        <td>
          <p class="titulo-campo">Razão Social</p>
        </td>
        <td class="frete-por-conta">
          <p class="titulo-campo">Frete por Conta</p>
        </td>
        <td class="codigo-antt">
          <p class="titulo-campo">Código ANTT</p>
        </td>
        <td>
          <p class="titulo-campo">Placa</p>
        </td>
        <td>
          <p class="titulo-campo">UF</p>
        </td>
        <td class="transportador-cnpj-cpf">
          <p class="titulo-campo">CNPJ / CPF</p>
        </td>
      </tr>
      <tr>
        <td>
          <p class="titulo-campo">Endereço</p>
        </td>
        <td colspan="3">
          <p class="titulo-campo">Município</p>
        </td>
        <td>
          <p class="titulo-campo">UF</p>
        </td>
        <td class="transportador-inscricao-estadual">
          <p class="titulo-campo">Inscrição Estadual</p>
        </td>
      </tr>
    </table>
    <table>
      <tr>
        <td class="sem-borda-topo volumes">
          <p class="titulo-campo">Quantidade</p>
        </td>
        <td class="sem-borda-topo volumes">
          <p class="titulo-campo">Espécie</p>
        </td>
        <td class="sem-borda-topo volumes">
          <p class="titulo-campo">Marca</p>
        </td>
        <td class="sem-borda-topo volumes">
          <p class="titulo-campo">Número</p>
        </td>
        <td class="sem-borda-topo volumes">
          <p class="titulo-campo">Peso Bruto</p>
        </td>
        <td class="sem-borda-topo volumes">
          <p class="titulo-campo">Peso Líquido</p>
        </td>
      </tr>
    </table-->
 
    <div class="titulo-bloco">Dados dos Produtos / Serviços</div>
    <table class="produtos">
      <thead>
        <tr>
          <th class="left-align">Código</th>
          <th class="left-align">Descrição dos Produtos / Serviços</th>
          <!--th>NCM / SH</th>
          <th>CST</th>
          <th>CFOP</th-->
          <th>Un.</th>
          <th>Qtde.</th>
          <th>V. Unitário</th>
          <th>V. Total</th>
          <!--th>BC ICMS</th>
          <th>V. ICMS</th>
          <th>V. IPI</th>
          <th>% ICMS</th>
          <th>% IPI</th>
          <th>V. Tributos</th-->
        </tr>
      </thead>
      <tbody>
       <?php
			$queryProdutos = $connect->prepare("SELECT * FROM of_os_produtos WHERE OS = '".$handleOS."'");
			$queryProdutos->execute();
			while($rowProdutos = $queryProdutos->fetch(PDO::FETCH_ASSOC)){
				$handleProduto = $rowProdutos['HANDLE'];
				$nomeProduto = $rowProdutos['PRODUTO'];
				$quantidadeProduto = $rowProdutos['QUANTIDADE'];
				$valorProduto = $rowProdutos['VALOR'];
				$valorTotalProduto = $rowProdutos['VALORTOTAL'];
	   ?>
        <tr>
          <td><?php echo $handleProduto; ?></td>
          <td><?php echo $nomeProduto; ?></td>
          <td>UN</td>
          <td><?php echo $quantidadeProduto; ?></td>
          <td>R$ <?php echo @number_format( $valorProduto , 2, ',', '.'); ?></td>
          <td>R$ <?php echo @number_format( $valorTotalProduto , 2, ',', '.'); ?></td>
        </tr>
       <?php
			}
	   ?>
     
       <?php
			$queryServicos = $connect->prepare("SELECT * FROM of_os_servicos WHERE OS = '".$handleOS."'");
			$queryServicos->execute();
			while($rowServicos = $queryServicos->fetch(PDO::FETCH_ASSOC)){
				$handleServicos = $rowServicos['HANDLE'];
				$nomeServicos = $rowServicos['SERVICO'];
				$quantidadeServicos = $rowServicos['QUANTIDADE'];
				$valorServicos = $rowServicos['VALOR'];
				$valorTotalServicos = $rowServicos['VALORTOTAL'];
	   ?>
        <tr>
          <td><?php echo $handleServicos; ?></td>
          <td><?php echo $nomeServicos; ?></td>
          <td>UN</td>
          <td><?php echo $quantidadeServicos; ?></td>
          <td>R$ <?php echo @number_format( $valorServicos , 2, ',', '.'); ?></td>
          <td>R$ <?php echo @number_format( $valorTotalServicos , 2, ',', '.'); ?></td>
        </tr>
       <?php
			}
	   ?>
      </tbody>
    </table>
 
    <div class="titulo-bloco">Dados Adicionais</div>
    <table>
      <tr>
        <td class="observacoes">
          <p class="titulo-campo">Descrição Serviços/Produtos</p>
          <p class="texto-campo"><?php echo $descricaoOS; ?></p>
        </td>
        <td class="observacoes">
          <p class="titulo-campo">Defeito</p>
          <p class="texto-campo"><?php echo $defeitoOS; ?></p>
        </td>
      </tr>
      <tr>
        <td class="observacoes">
          <p class="titulo-campo">Observações</p>
          <p class="texto-campo"><?php echo $observacoesOS; ?></p>
        </td>
        <td class="observacoes">
          <p class="titulo-campo">Laudo Técnico</p>
          <p class="texto-campo"><?php echo $laudoTecnicoOS; ?></p>
        </td>
      </tr>
    </table>
  </div>
</div>
   
   
</body>
</html>