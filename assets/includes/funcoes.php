<?php

// FUNÇÕES DE EDIÇÃO/SELEÇÃO DE POSTS //
// FUNÇÕES DE EDIÇÃO/SELEÇÃO DE POSTS //
// FUNÇÕES DE EDIÇÃO/SELEÇÃO DE POSTS //

if (isset($_POST['editPost'])) {
    $titulo = ($_POST["buscaTitulo"]);
    editPost($titulo);
}
if (isset($_POST['delPost'])) {
    $titulo = ($_POST["buscaTitulo"]);
    delPost($titulo);
}
if (isset($_POST['criarpost'])) {
    $titulo = ($_POST["titulo"]);
    $descricao = ($_POST["descricao"]);
    $texto = ($_POST["texto"]);
    $imagem = addslashes(file_get_contents($_FILES['imagem']['tmp_name']));
    $topico = ($_POST["topico"]);
    $usuario = ($_POST["usuario"]);
    criarPost($titulo, $imagem, $descricao, $texto, $topico, $usuario);
}
if (isset($_POST['editarpost'])) {
    $id = ($_POST["id"]);
    $titulo = ($_POST["titulo"]);
    $descricao = ($_POST["descricao"]);
    $texto = ($_POST["texto"]);
    $topico = ($_POST["topico"]);
    editarPost($id, $topico, $titulo, $descricao, $texto);
}
if (isset($_POST['deletarpost'])) {
    $id = ($_POST["id"]);
    deletarPost($id);
}

function posts()
{
    include 'conexao.php'; // Conexão com banco de dados

    $consulta = "SELECT * FROM `post`"; // Query Sql
    $con = $link->query($consulta) or die($link->error);
    return $con;
}


function postRecentes()
{
    include 'conexao.php'; // Conexão com banco de dados

    $consulta = "SELECT * FROM `post` ORDER BY `post`.`criado_em` DESC LIMIT 5"; // Query Sql
    $con = $link->query($consulta) or die($link->error);
    return $con;
}

//Barra de pesquisa
function pesquisarPost($item)
{
    include 'conexao.php'; // Conexão com banco de dados

    $query = "SELECT * FROM `post` WHERE `titulo` LIKE '%$item%'"; // Query Sql
    $con = $link->query($query) or die($link->error);
    return $con;
}

// Selecionar Post pelo nome para editar/deletar & mostrar sua Pagina
function selectPost($titulo)
{
    include 'conexao.php'; // Conexão com banco de dados

    $query = "SELECT * FROM `post` WHERE titulo = '$titulo'"; // Query Sql
    $con = $link->query($query) or die($link->error);
    return $con;
}

// Selecionar Post pelo nome e retorna pela url para editar
function editPost($titulo)
{
    include 'conexao.php'; // Conexão com banco de dados

    $query = "SELECT * FROM `post` WHERE titulo = '$titulo'"; // Query Sql
    $con = $link->query($query) or die($link->error);
    $dados = $con->fetch_array();
    $titulo = $dados['titulo'];
    $titulo_novo = preg_replace('/[ -]+/', '_', $titulo);
    header("location: ../../administracao/editar_post.php?buscaTitulo=$titulo_novo");
}

// Selecionar Post pelo nome e retorna pela url para deletar
function delPost($titulo)
{
    include 'conexao.php'; // Conexão com banco de dados

    $query = "SELECT * FROM `post` WHERE titulo = '$titulo'"; // Query Sql
    $con = $link->query($query) or die($link->error);
    $dados = $con->fetch_array();
    $titulo = $dados['titulo'];
    $titulo_novo = preg_replace('/[ -]+/', '_', $titulo);
    header("location: ../../administracao/deletar_post.php?buscaTitulo=$titulo_novo");
}


// Função Criar Post
function criarPost($titulo, $imagem, $descricao, $texto, $topico, $usuario)
{

    include 'conexao.php'; // Conexão com banco de dados
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

        $query = "INSERT INTO post (user_id, topico_id, titulo, imagem, descricao, texto, criado_em) VALUES('$usuario', '$topico', '$titulo','$imagem', '$descricao', '$texto', now())"; // Query Sql
        if (mysqli_query($link, $query)) { // Se post feito
            echo "<script language='javascript' type='text/javascript'>
            alert('Post criado com sucesso');window.location
            .href='../../adm.php';</script>";
        } else { // Se tiver erro no post
            echo "<script language='javascript' type='text/javascript'>
            alert('Erro ao criar o Post');window.location
            .href='../../adm.php';</script>";
        }
    }
}

// Função Editar Post
function editarPost($id, $topico, $titulo, $descricao, $texto)
{

    include 'conexao.php'; // Conexão com banco de dados
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

        $query = "UPDATE `post` SET `topico_id`= '$topico', `titulo` = '$titulo', `descricao` = '$descricao', `texto` = '$texto' WHERE `post`.`id` = '$id' "; // Query Sql
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

    include 'conexao.php'; // Conexão com banco de dados
    $errors = array();

    // validar formulario
    if (empty($id)) {
        array_push($errors, 1);
    }

    if (count($errors) == 0) {
        // Inserindo informaçoes ao banco de dados
        $query = "DELETE FROM `post` WHERE id = '$id'"; // Query Sql
        if (mysqli_query($link, $query)) { // Se post feito
            $resultado = "Post deletado com sucesso";
            return $resultado;
        } else { // Se tiver erro no post
            $resultado = "Erro ao deletar o Post";
            return $resultado;
        }
    }
}

// FUNÇÕES DE EDIÇÃO/SELEÇÃO DE USUARIOS //
// FUNÇÕES DE EDIÇÃO/SELEÇÃO DE USUARIOS //
// FUNÇÕES DE EDIÇÃO/SELEÇÃO DE USUARIOS //

if (isset($_POST['edituser'])) {
    $nome = ($_POST["buscaNome"]);
    editUser($nome);
}
if (isset($_POST['deluser'])) {
    $nome = ($_POST["buscaNome"]);
    delUser($nome);
}
if (isset($_POST['criaruser'])) {
    $nome = ($_POST["nome"]);
    $email = ($_POST["email"]);
    $senha = ($_POST["senhaUser"]);
    criarUser($nome, $email, $senha);
}
if (isset($_POST['editaruser'])) {
    $id = ($_POST["id"]);
    $nome = ($_POST["nome"]);
    $email = ($_POST["email"]);
    $senha = ($_POST["senhaUser"]);
    editarUser($id, $nome, $email, $senha);
}
if (isset($_POST['deletaruser'])) {
    $id = ($_POST["id"]);
    deletarUser($id);
}

//Retorna a ID do usuario Logado no Sistema
function getUser($logado)
{

    include 'conexao.php'; // Conexão com banco de dados

    $consulta = "SELECT * FROM `usuario` WHERE nome = '$logado'"; // Query Sql
    $con = $link->query($consulta) or die($link->error);
    $usuario = $con->fetch_array();
    $idUser = $usuario['id'];
    return $idUser;
}

//Retorna todos os usuarios
function usuarios()
{
    include 'conexao.php'; // Conexão com banco de dados

    $consulta = "SELECT * FROM `usuario`"; // Query Sql
    $con = $link->query($consulta) or die($link->error);
    return $con;
}

// Selecionar Usario para editar/deletar
function selectUser($nome)
{
    include 'conexao.php'; // Conexão com banco de dados

    $query = "SELECT * FROM `usuario` WHERE nome = '$nome'"; // Query Sql
    $con = $link->query($query) or die($link->error);
    return $con;
}

// Selecionar Uusario pelo nome e retorna pela url para editar
function editUser($nome)
{
    include 'conexao.php'; // Conexão com banco de dados

    $query = "SELECT * FROM `usuario` WHERE nome = '$nome'"; // Query Sql
    $con = $link->query($query) or die($link->error);
    $dados = $con->fetch_array();
    $nome = $dados['nome'];
    $nome_novo = preg_replace('/[ -]+/', '_', $nome);
    header("location: ../../administracao/editar_usuario.php?buscaNome=$nome_novo");
}

// Selecionar Uusario pelo nome e retorna pela url para deletar
function delUser($nome)
{
    include 'conexao.php'; // Conexão com banco de dados

    $query = "SELECT * FROM `usuario` WHERE nome = '$nome'"; // Query Sql
    $con = $link->query($query) or die($link->error);
    $dados = $con->fetch_array();
    $nome = $dados['nome'];
    $nome_novo = preg_replace('/[ -]+/', '_', $nome);
    header("location: ../../administracao/deletar_usuario.php?buscaNome=$nome_novo");
}

// Função Criar Usuario
function criarUser($nome, $email, $senha)
{

    include 'conexao.php'; // Conexão com banco de dados
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

        $query = "INSERT INTO `usuario`(`nome`, `email`, `senha`) VALUES ('$nome','$email','$senha')"; // Query Sql
        if (mysqli_query($link, $query)) { // Se post feito
            echo "<script language='javascript' type='text/javascript'>
            alert('Usuario criado com sucesso');window.location
            .href='../../adm.php';</script>";
        } else { // Se tiver erro no post
            echo "<script language='javascript' type='text/javascript'>
            alert('Erro ao criar o Usuario');window.location
            .href='../../adm.php';</script>";
        }
    }
}

// Função Editar Usuario
function editarUser($id, $nome, $email, $senha)
{

    include 'conexao.php'; // Conexão com banco de dados
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

        $query = "UPDATE `usuario` SET `nome` = '$nome', `email` = '$email', `senha` = '$senha' WHERE `usuario`.`id` = '$id' "; // Query Sql
        if (mysqli_query($link, $query)) { // Se post feito
            echo "<script language='javascript' type='text/javascript'>
            alert('Usuario editado com sucesso');window.location
            .href='../../adm.php';</script>";
        } else { // Se tiver erro no post
            echo "<script language='javascript' type='text/javascript'>
            alert('Erro ao editar o Usuario');window.location
            .href='../../adm.php';</script>";
        }
    }
}

// Função Deletar Usuario
function deletarUser($id)
{

    include 'conexao.php'; // Conexão com banco de dados
    $errors = array();

    // validar formulario
    if (empty($id)) {
        array_push($errors, 1);
    }

    if (count($errors) == 0) {
        // Inserindo informaçoes ao banco de dados
        $query = "DELETE FROM `usuario` WHERE id = '$id'"; // Query Sql
        if (mysqli_query($link, $query)) { // Se post feito
            echo "<script language='javascript' type='text/javascript'>
            alert('Usuario deletado com sucesso');window.location
            .href='../../adm.php';</script>";
        } else { // Se tiver erro no post
            echo "<script language='javascript' type='text/javascript'>
            alert('Erro ao deletar o Usuario');window.location
            .href='../../adm.php';</script>";
        }
    }
}

// FUNÇÕES DE EDIÇÃO/SELEÇÃO DE TOPICOS //
// FUNÇÕES DE EDIÇÃO/SELEÇÃO DE TOPICOS //
// FUNÇÕES DE EDIÇÃO/SELEÇÃO DE TOPICOS //

if (isset($_POST['criartopico'])) {
    $nome = ($_POST["nome"]);
    criarTopico($nome);
}
if (isset($_POST['editTopic'])) {
    $nome = ($_POST["buscaTopico"]);
    editTopic($nome);
}
if (isset($_POST['delTopic'])) {
    $nome = ($_POST["buscaTopico"]);
    delTopic($nome);
}
if (isset($_POST['editartopico'])) {
    $id = ($_POST["id"]);
    $nome = ($_POST["nome"]);
    editarTopico($id, $nome);
}
if (isset($_POST['deletartopico'])) {
    $id = ($_POST["id"]);
    deletarTopico($id);
}



// Selecionar Topico pelo nome e retorna pela url para editar
function editTopic($nome)
{
    include 'conexao.php'; // Conexão com banco de dados

    $consulta = "SELECT * FROM `topicos` WHERE nome = '$nome'"; // Query Sql
    $con = $link->query($consulta) or die($link->error);
    $dados = $con->fetch_array();
    $nome = $dados['nome'];
    $nome_novo = preg_replace('/[ -]+/', '_', $nome);
    header("location: ../../administracao/editar_topico.php?buscaTopico=$nome_novo");
}

// Selecionar Topico pelo nome e retorna pela url para deletar
function delTopic($nome)
{
    include 'conexao.php'; // Conexão com banco de dados

    $consulta = "SELECT * FROM `topicos` WHERE nome = '$nome'"; // Query Sql
    $con = $link->query($consulta) or die($link->error);
    $dados = $con->fetch_array();
    $nome = $dados['nome'];
    $nome_novo = preg_replace('/[ -]+/', '_', $nome);
    header("location: ../../administracao/deletar_topico.php?buscaTopico=$nome_novo");
}

//Pegar posts por um topico especifico
function getTopico($topico)
{

    include 'conexao.php'; // Conexão com banco de dados

    $consulta = "SELECT * FROM `topicos` WHERE nome = '$topico'"; // Query Sql
    $con = $link->query($consulta) or die($link->error);
    $topico = $con->fetch_array();
    $idTopico = $topico['id'];
    $consulta = "SELECT * FROM `post` WHERE topico_id = '$idTopico' ORDER BY `post`.`criado_em` DESC"; // Query Sql
    $con = $link->query($consulta) or die($link->error);
    return $con;
}

//Pegar todos os topicos
function topicos()
{

    include 'conexao.php'; // Conexão com banco de dados

    $consulta = "SELECT * FROM `topicos`"; // Query Sql
    $con = $link->query($consulta) or die($link->error);
    return $con;
}

// Selecionar Topico para editar/deletar
function selectTopico($nome)
{
    include 'conexao.php'; // Conexão com banco de dados

    $query = "SELECT * FROM `topicos` WHERE nome = '$nome'"; // Query Sql
    $con = $link->query($query) or die($link->error);
    return $con;
}

// Função Criar Topico
function criarTopico($nome)
{
    $nome = ($_POST["nome"]);

    include 'conexao.php'; // Conexão com banco de dados
    $errors = array();

    // validar formulario
    if (empty($nome)) {
        array_push($errors, 1);
    }

    if (count($errors) == 0) {
        $query = "INSERT INTO topicos (nome) VALUES('$nome')"; // Query Sql
        if (mysqli_query($link, $query)) { // Se post feito
            echo "<script language='javascript' type='text/javascript'>
            alert('Topico criado com sucesso');window.location
            .href='../../adm.php';</script>";
        } else { // Se tiver erro no post
            echo "<script language='javascript' type='text/javascript'>
            alert('Erro ao criar o Topico');window.location
            .href='../../adm.php';</script>";
        }
    }
}

// Função Editar Topico
function editarTopico($id, $nome)
{


    include 'conexao.php'; // Conexão com banco de dados
    $errors = array();

    // validar formulario
    if (empty($nome)) {
        array_push($errors, 1);
    }

    if (empty($id)) {
        array_push($errors, 2);
    }

    if (count($errors) == 0) {

        $query = "UPDATE `topicos` SET `nome` = '$nome' WHERE `topicos`.`id` = '$id' "; // Query Sql
        if (mysqli_query($link, $query)) { // Se post feito
            echo "<script language='javascript' type='text/javascript'>
            alert('Topico editado com sucesso');window.location
            .href='../../adm.php';</script>";
        } else { // Se tiver erro no post
            echo "<script language='javascript' type='text/javascript'>
            alert('Erro ao editar o Topico');window.location
            .href='../../adm.php';</script>";
        }
    }
}

// Função deletar Topico
function deletarTopico($id)
{

    include 'conexao.php'; // Conexão com banco de dados
    $errors = array();

    // validar formulario
    if (empty($id)) {
        array_push($errors, 1);
    }

    if (count($errors) == 0) {
        // Inserindo informaçoes ao banco de dados
        $query = "DELETE FROM `topicos` WHERE id = '$id'"; // Query Sql
        if (mysqli_query($link, $query)) { // Se post feito
            echo "<script language='javascript' type='text/javascript'>
            alert('Topico deletado com sucesso');window.location
            .href='../../adm.php';</script>";
        } else { // Se tiver erro no post
            echo "<script language='javascript' type='text/javascript'>
            alert('Erro ao deletar o Topico');window.location
            .href='../../adm.php';</script>";
        }
    }
}
