<?php
include_once "Conexao.php";
ob_start();
session_start();

//define inicializações do php com seus parametros
ini_set('max_file_uploads', '100');
ini_set('upload_max_filesize', '1024M');
ini_set('post_max_size ', '2500M');
set_time_limit(99000);

date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$date = date('Y-m-d');
$time = date('H:i:s');
$datetime = date('Y-m-d H:i:s');
$datahora = date('d/m/Y H:i:s');

function limitarTexto($texto, $limite){
  $contador = strlen($texto);
  if ( $contador >= $limite ) {      
      $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '';
      return $texto;
  }
  else{
    return $texto;
  }
} 


function Valor($valor) {
       $verificaPonto = ".";
       if(strpos("[".$valor."]", "$verificaPonto")):
           $valor = str_replace('.','', $valor);
           $valor = str_replace(',','.', $valor);
           else:
             $valor = str_replace(',','.', $valor);   
       endif;

       return $valor;
}



function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
{
$lmin = 'abcdefghijklmnopqrstuvwxyz';
$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$num = '1234567890';
$simb = '!@#$%*-';
$retorno = '';
$caracteres = '';
$caracteres .= $lmin;
if ($maiusculas) $caracteres .= $lmai;
if ($numeros) $caracteres .= $num;
if ($simbolos) $caracteres .= $simb;
$len = strlen($caracteres);
for ($n = 1; $n <= $tamanho; $n++) {
$rand = mt_rand(1, $len);
$retorno .= $caracteres[$rand-1];
}
return $retorno;
}

class Sistema {
   
   static function getConexao($transacao = true) {
      $conexao = Conexao::getInstancia();
      
      if ($transacao) {
         $conexao->beginTransaction();
      }
      
      return $conexao;
   }
   
   static function getFiltroSuperGlobal($superGlobal, $variavel, $tipoVariavel) {
      return filter_input($superGlobal, $variavel, $tipoVariavel);
   }

   static function getPost($variavel, $tipoVariavel = FILTER_SANITIZE_STRING) {
      return self::getFiltroSuperGlobal(INPUT_POST, $variavel, $tipoVariavel);
   }
   
   static function getGet($variavel, $tipoVariavel = FILTER_SANITIZE_STRING) {
      return self::getFiltroSuperGlobal(INPUT_GET, $variavel, $tipoVariavel);
   }

   static function getServer($variavel, $tipoVariavel = FILTER_SANITIZE_STRING) {
      return self::getFiltroSuperGlobal(INPUT_SERVER, $variavel, $tipoVariavel);
   }
}

?>