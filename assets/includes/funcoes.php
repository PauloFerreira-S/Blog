<?php

function getUser($logado){

    include 'conexao.php';// Conexão com banco de dados

    $consulta = "SELECT * FROM `usuario` WHERE nome = '$logado'";// Query Sql
    $con = $link->query($consulta) or die($link->error);
    $usuario = $con->fetch_array();
    $idUser = $usuario['id'];
    return $idUser;
}

function getTopico($topico){

    include 'conexao.php';// Conexão com banco de dados

    $consulta = "SELECT * FROM `topicos` WHERE nome = '$topico'";// Query Sql
    $con = $link->query($consulta) or die($link->error);
    $topico = $con->fetch_array();
    $idTopico = $topico['id'];
    $consulta = "SELECT * FROM `post` WHERE topico_id = '$idTopico' ORDER BY `post`.`criado_em` DESC";// Query Sql
    $con = $link->query($consulta) or die($link->error);
    return $con;
}

function topicos(){

    include 'conexao.php';// Conexão com banco de dados

    $consulta = "SELECT * FROM `topicos`";// Query Sql
    $con = $link->query($consulta) or die($link->error);
    return $con;
}

// Selecionar Usario para editar/deletar
function selectTopico($nome)
{
    include 'conexao.php';// Conexão com banco de dados

    $query = "SELECT * FROM `topicos` WHERE nome = '$nome'";// Query Sql
    $con = $link->query($query) or die($link->error);
    return $con;
}

// Função Criar Topico
function criarTopico($nome)
{
    $nome = ($_POST["nome"]);
    
    include 'conexao.php';// Conexão com banco de dados
    $errors = array();

    // validar formulario
    if (empty($nome)) {
        array_push($errors, 1);
    }  

    if (count($errors) == 0) {
        $query = "INSERT INTO topicos (nome) VALUES('$nome')";// Query Sql
        if (mysqli_query($link, $query)) { // Se post feito
            $resultado = "Topico criado com sucesso";
            return $resultado;
        } else { // Se tiver erro no post
            $resultado = "Erro ao criar o Topico";
            return $resultado;
        }
    }
}

// Função Editar Topico
function editarTopico($id, $nome)
{
    $id = ($_POST["id"]);
    $nome = ($_POST["nome"]);


    include 'conexao.php';// Conexão com banco de dados
    $errors = array();

    // validar formulario
    if (empty($nome)) {
        array_push($errors, 1);
    }  
    
    if (empty($id)) {
        array_push($errors, 2);
    }

    if (count($errors) == 0) {

        $query = "UPDATE `topicos` SET `nome` = '$nome' WHERE `topicos`.`id` = '$id' ";// Query Sql
        if (mysqli_query($link, $query)) { // Se post feito
            $resultado = "Topico editado com sucesso";
            return $resultado;
        } else { // Se tiver erro no post
            $resultado = "Erro ao editar o Topico";
            return $resultado;
        }
    }
}

// Função Topico Post
function deletarTopico($id)
{
    $id = ($_POST["id"]);

    include 'conexao.php';// Conexão com banco de dados
    $errors = array();

    // validar formulario
    if (empty($id)) {
        array_push($errors, 1);
    }

    if (count($errors) == 0) {
        // Inserindo informaçoes ao banco de dados
        $query = "DELETE FROM `topicos` WHERE id = '$id'";// Query Sql
        if (mysqli_query($link, $query)) { // Se post feito
            $resultado = "Topico deletado com sucesso";
            return $resultado;
        } else { // Se tiver erro no post
            $resultado = "Erro ao deletar o Topico";
            return $resultado;
        }
    }
}

function posts()
{
    include 'conexao.php';// Conexão com banco de dados

    $consulta = "SELECT * FROM `post`";// Query Sql
    $con = $link->query($consulta) or die($link->error);
    return $con;
}


function postRecentes()
{
    include 'conexao.php';// Conexão com banco de dados

    $consulta = "SELECT * FROM `post` ORDER BY `post`.`criado_em` DESC LIMIT 5";// Query Sql
    $con = $link->query($consulta) or die($link->error);
    return $con;
}

//Barra de pesquisa
function pesquisarPost($item)
{
    include 'conexao.php';// Conexão com banco de dados

    $query = "SELECT * FROM `post` WHERE `titulo` LIKE '%$item%'";// Query Sql
    $con = $link->query($query) or die($link->error);
    return $con;
}

// Selecionar Post para editar/deletar & mostrar sua Pagina
function selectPost($titulo)
{
    include 'conexao.php';// Conexão com banco de dados

    $query = "SELECT * FROM `post` WHERE titulo = '$titulo'";// Query Sql
    $con = $link->query($query) or die($link->error);
    return $con;
}

// Função Criar Post
function criarPost($titulo, $imagem, $descricao, $texto, $topico, $usuario)
{
    $titulo = ($_POST["titulo"]);
    $descricao = ($_POST["descricao"]);
    $texto = ($_POST["texto"]);
    $imagem = addslashes(file_get_contents($_FILES['imagem']['tmp_name']));
    $topico = ($_POST["topico"]);
    $usuario = ($_POST["usuario"]);

    include 'conexao.php';// Conexão com banco de dados
    $errors = array();

    // validar formulario
    if (empty($titulo)) {
        array_push($errors, 1);
    }
    if (empty($descricao)) {
        array_push($errors, 2);
    }
    if (empty($texto)) {
        array_push($errors, 3);
    }
    if (empty($topico)) {
        array_push($errors, 4);
    }
    if (empty($usuario)) {
        array_push($errors, 5);
    }   

    if (count($errors) == 0) {

        $query = "INSERT INTO post (user_id, topico_id, titulo, imagem, descricao, texto, criado_em) VALUES('$usuario', '$topico', '$titulo','$imagem', '$descricao', '$texto', now())";// Query Sql
        if (mysqli_query($link, $query)) { // Se post feito
            $resultado = "Post criado com sucesso";
            return $resultado;
        } else { // Se tiver erro no post
            $resultado = "Erro ao criar o Post";
            return $resultado;
        }
    }
}

// Função Editar Post
function editarPost($id, $topico, $titulo, $descricao, $texto)
{
    $id = ($_POST["id"]);
    $titulo = ($_POST["titulo"]);
    $descricao = ($_POST["descricao"]);
    $texto = ($_POST["texto"]);
    $topico = ($_POST["topico"]);

    include 'conexao.php';// Conexão com banco de dados
    $errors = array();

    // validar formulario
    if (empty($titulo)) {
        array_push($errors, 1);
    }
    if (empty($descricao)) {
        array_push($errors, 2);
    }
    if (empty($texto)) {
        array_push($errors, 3);
    }
    if (empty($id)) {
        array_push($errors, 4);
    }
    if (empty($topico)) {
        array_push($errors, 5);
    }

    if (count($errors) == 0) {

        $query = "UPDATE `post` SET `topico_id`= '$topico', `titulo` = '$titulo', `descricao` = '$descricao', `texto` = '$texto' WHERE `post`.`id` = '$id' ";// Query Sql
        if (mysqli_query($link, $query)) { // Se post feito
            $resultado = "Post editado com sucesso";
            return $resultado;
        } else { // Se tiver erro no post
            $resultado = "Erro ao editar o Post";
            return $resultado;
        }
    }
}

// Função Deletar Post
function deletarPost($id)
{
    $id = ($_POST["id"]);

    include 'conexao.php';// Conexão com banco de dados
    $errors = array();

    // validar formulario
    if (empty($id)) {
        array_push($errors, 1);
    }

    if (count($errors) == 0) {
        // Inserindo informaçoes ao banco de dados
        $query = "DELETE FROM `post` WHERE id = '$id'";// Query Sql
        if (mysqli_query($link, $query)) { // Se post feito
            $resultado = "Post deletado com sucesso";
            return $resultado;
        } else { // Se tiver erro no post
            $resultado = "Erro ao deletar o Post";
            return $resultado;
        }
    }
}

function usuarios()
{
    include 'conexao.php';// Conexão com banco de dados

    $consulta = "SELECT * FROM `usuario`";// Query Sql
    $con = $link->query($consulta) or die($link->error);
    return $con;
}

// Selecionar Usario para editar/deletar
function selectUser($nome)
{
    include 'conexao.php';// Conexão com banco de dados

    $query = "SELECT * FROM `usuario` WHERE nome = '$nome'";// Query Sql
    $con = $link->query($query) or die($link->error);
    return $con;
}

// Função Criar Usuario
function criarUser($nome,$email,$senha)
{
    $nome = ($_POST["nome"]);
    $email = ($_POST["email"]);
    $senha = ($_POST["senhaUser"]);


    include 'conexao.php';// Conexão com banco de dados
    $errors = array();

    // validar formulario
    if (empty($nome)) {
        array_push($errors, 1);
    }
    if (empty($email)) {
        array_push($errors, 2);
    }
    if (empty($senha)) {
        array_push($errors, 3);
    }    

    if (count($errors) == 0) {

        $query = "INSERT INTO `usuario`(`nome`, `email`, `senha`) VALUES ('$nome','$email','$senha')";// Query Sql
        if (mysqli_query($link, $query)) { // Se post feito
            $resultado = "Usuario criado com sucesso";
            return $resultado;
        } else { // Se tiver erro no post
            $resultado = "Erro ao criar o Usuario";
            return $resultado;
        }
    }
}

// Função Editar Usuario
function editarUser($id, $nome, $email, $senha)
{
    $id = ($_POST["id"]);
    $nome = ($_POST["nome"]);
    $email = ($_POST["email"]);
    $senha = ($_POST["senhaUser"]);

    include 'conexao.php';// Conexão com banco de dados
    $errors = array();

    // validar formulario
    if (empty($nome)) {
        array_push($errors, 1);
    }
    if (empty($email)) {
        array_push($errors, 2);
    }
    if (empty($senha)) {
        array_push($errors, 3);
    }
    if (empty($id)) {
        array_push($errors, 4);
    }

    if (count($errors) == 0) {

        $query = "UPDATE `usuario` SET `nome` = '$nome', `email` = '$email', `senha` = '$senha' WHERE `usuario`.`id` = '$id' ";// Query Sql
        if (mysqli_query($link, $query)) { // Se post feito
            $resultado = "Usuario editado com sucesso";
            return $resultado;
        } else { // Se tiver erro no post
            $resultado = "Erro ao editar o Usuario";
            return $resultado;
        }
    }
}

// Função Deletar Usuario
function deletarUser($id)
{
    $id = ($_POST["id"]);

    include 'conexao.php';// Conexão com banco de dados
    $errors = array();

    // validar formulario
    if (empty($id)) {
        array_push($errors, 1);
    }

    if (count($errors) == 0) {
        // Inserindo informaçoes ao banco de dados
        $query = "DELETE FROM `usuario` WHERE id = '$id'";// Query Sql
        if (mysqli_query($link, $query)) { // Se post feito
            $resultado = "Usuario deletado com sucesso";
            return $resultado;
        } else { // Se tiver erro no post
            $resultado = "Erro ao deletar o Usuario";
            return $resultado;
        }
    }
}
