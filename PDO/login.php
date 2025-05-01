<?php
ini_set('session.cookie_path', '/');
session_start();
require_once 'conecta.php';
require_once 'usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $senha = isset($_POST['senha']) ? $_POST['senha']       : '';

    if (!empty($email) && !empty($senha)) {
        $db = new Database();
        $conn = $db->connect();

        $usuario = new Usuario($conn);
        $dadosUsuario = $usuario->buscarPorEmail($email);

        if ($dadosUsuario && password_verify($senha, $dadosUsuario['senha'])) {

            $_SESSION['usuario_id'] = $dadosUsuario['cod'];
            $_SESSION['usuario_nome'] = $dadosUsuario['nome'];
            header('Location: ../painel.php');
            exit;
        } else {
            echo '<p style="color:red; text-align:center;">E-mail ou senha inválidos.</p><p href:"../login.php">Voltar a pagina de login</p>';
        }
    } else {
        echo '<p style="color:red; text-align:center;">Preencha todos os campos.</p>';
    }
} else {
    echo 'Requisição inválida.';
}
?>
