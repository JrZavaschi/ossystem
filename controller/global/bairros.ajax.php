<?php
//header( 'Cache-Control: no-cache' );
//header( 'Content-type: application/xml; charset="utf-8"', true );

include('../../controller/tecnologia/Sistema.php');
$connect = Sistema::getConexao();

$cidadeSelecionada = $_GET['cidade'];
//$ufSelecionada = '24';

$Bairros = array();

$queryBairros = $connect->prepare("SELECT HANDLE, NOME
								   FROM ms_bairro
								   WHERE CIDADE = $cidadeSelecionada
								   ORDER BY NOME ASC
								   ");
$queryBairros->execute();

while ( $rowBairros = $queryBairros->fetch(PDO::FETCH_ASSOC) ) {
	$Bairros[] = array(
		'HANDLE'	=> $rowBairros['HANDLE'],
		'NOME'	=> $rowBairros['NOME'],
	);
}

echo( json_encode( $Bairros ) );
?>