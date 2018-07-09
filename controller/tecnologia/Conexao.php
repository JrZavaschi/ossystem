<?php

include_once "BancoDados.php";

class Conexao extends BancoDados {

   public static $instancia;

   private function __construct() {
      parent::__construct();
   }

   public static function getInstancia() {
      if (!isset(self::$instancia)) {
         try {
            self::$instancia = new PDO(BancoDados::getDns(), BancoDados::getUsuario(), BancoDados::getSenha());
            self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         }
         catch (Exception $ex) {
			 session_destroy();
			 session_start();

			 $retorno = "Servidor em manutenção, tente novamente em alguns minutos, obrigado!";
			 $_SESSION['retorno'] = $retorno;
			 header('Location: ../../view/estrutura/login.php');
         }
      }

      return self::$instancia;
   }
}