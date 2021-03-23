<?php
   session_start();
   unset($_SESSION["login"]);
   unset($_SESSION["senha"]);
   
   header('Refresh: 2; URL = entrar.php');
?>