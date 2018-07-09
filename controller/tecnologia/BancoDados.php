<?php
class BancoDados {
	
   private static $host = "localhost";
   private static $nome = "ossystem";
   private static $usuario = "root";
   private static $senha = "";
  
   private function __construct() {
      
   }

   public static function getDns() {
     		return "mysql:host=" . self::$host . ";dbname=" .  self::$nome. ";ConnectionPooling=0;charset=utf8";
   }

   public static function getUsuario() {
      return self::$usuario;
   }

   public static function getSenha() {
      return self::$senha;
   }

}
