<?php
//header( 'Cache-Control: no-cache' );
//header( 'Content-type: application/xml; charset="utf-8"', true );

include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();

$ufSelecionada = $_GET['uf'];
//$ufSelecionada = '24';

$cidades = array();

$queryCidades = $connect->prepare("SELECT HANDLE, CIDADE
								   FROM ms_cidade
								   WHERE UF = $ufSelecionada
								   ORDER BY CIDADE ASC
								   ");
$queryCidades->execute();

while ( $rowCidades = $queryCidades->fetch(PDO::FETCH_ASSOC) ) {
	$cidades[] = array(
		'HANDLE'	=> $rowCidades['HANDLE'],
		'CIDADE'	=> $rowCidades['CIDADE'],
	);
}

echo( json_encode( $cidades ) );
?>