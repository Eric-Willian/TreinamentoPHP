<?php
ini_set('session.cookie_path', '/');
session_start();
$nomeUsuario = $_SESSION['usuario_nome'];

if(!isset($_SESSION['usuario_id'])){
    header("Location: index.html");
    exit;
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Painel do Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            text-align: center;
            padding-top: 50px;
        }
        .painel {
            background: white;
            display: inline-block;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #ccc;
        }
        a.logout {
            display: inline-block;
            margin-top: 20px;
            color: red;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="painel">
        <h1>Bem-vindo, <?php echo htmlspecialchars($nomeUsuario); ?>!</h1>
        <p>Você está logado com sucesso.</p>
        
        <a href="PDO/logout.php" class="logout">Sair</a>
    </div>
</body>
</html>
