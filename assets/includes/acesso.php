<?php
// inicia a sessão
session_start();
// as variáveis login e senha recebem os dados digitados na página entrar.php
$login = $_POST['login'];
$senha = $_POST['senha'];

// Conexao com Banco de Dados.
include 'conexao.php';

// A variavel $result pega as varias $login e $senha, faz uma
//pesquisa na tabela de usuarios
$consulta = "SELECT * FROM `usuario` WHERE nome = '$login' AND senha = '$senha'";
$con = $link->query($consulta) or die($link->error);

// Se encontrou algum registro idêntico o seu valor será igual a 1//
if(mysqli_num_rows ($con) > 0 )
{
$_SESSION['login'] = $login;
$_SESSION['senha'] = $senha;
header('location: ../../adm.php');
}
else{
  unset ($_SESSION['login']);
  unset ($_SESSION['senha']);
  }
?>