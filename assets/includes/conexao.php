
<?php

# Usuario, Senha e o nome do Banco de Dados
$user = "root";
$password = "";
$dbname = "blog";

# Endereço do Banco de Dados
$hostname = "localhost:3306";

# Conecta com o servidor de banco de dados 
$link = mysqli_connect($hostname, $user, $password, $dbname) or die(' Erro na conexão ');


?>