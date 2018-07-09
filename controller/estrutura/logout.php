<?php
session_start();
unset($_SESSION['logou']);
unset($_SESSION['handleUsuario']);

session_destroy();
header('Location:../../view/estrutura/login.php');
?>