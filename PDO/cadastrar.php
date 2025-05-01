<?php
require_once 'conecta.php';  // Responsável pela conexão com o banco de dados
require_once 'usuario.php';  // Contém a classe de cadastro e outras funcionalidades

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = isset($_POST['nome'])  ? trim($_POST['nome'])  : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $senha = isset($_POST['senha']) ? $_POST['senha']       : '';

    if (!empty($nome) && !empty($email) && !empty($senha)) {
        $db = new Database();
        $conn = $db->connect();

        $usuario = new Usuario($conn);

        // Verifica se o e-mail já está cadastrado
        if ($usuario->emailExiste($email)) {
            echo '
            <div style="color: red; font-family: Arial; text-align: center; padding: 20px;">
                Este e-mail já está cadastrado. <a href="../index.html">Voltar para o Login</a>
            </div>';
            exit;
        }

        // Tenta cadastrar o novo usuário
        if ($usuario->cadastrar($nome, $email, $senha)) {
            // Telinha de sucesso + redirecionamento
            echo '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8">
                <title>Cadastro realizado</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        margin: 0;
                    }
                    .message-box {
                        background-color: #e0ffe0;
                        border: 2px solid #4CAF50;
                        padding: 30px;
                        border-radius: 10px;
                        text-align: center;
                        box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    }
                    .message-box h2 {
                        color: #2e7d32;
                    }
                </style>
                <script>
                    setTimeout(function() {
                        window.location.href = "../index.html";  // Redireciona para a página de login
                    }, 3000);
                </script>
            </head>
            <body>
                <div class="message-box">
                    <h2>Cadastro realizado com sucesso!</h2>
                    <p>Redirecionando para a página de login...</p>
                </div>
            </body>
            </html>';
            exit;
        } else {
            echo "Erro ao cadastrar o usuário.";
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
} else {
    echo "Requisição inválida.";
}

?>
