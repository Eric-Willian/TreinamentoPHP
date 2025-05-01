<?php
class Usuario {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    public function cadastrar($nome, $email, $senha) {
        // Hash da senha antes de salvar no banco
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO contas (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->conn->prepare($sql);

        try {
            $stmt->execute([
                ':nome'  => $nome,
                ':email' => $email,
                ':senha' => $senhaHash
            ]);
            return true;
        } catch (PDOException $e) {
            echo "Erro ao cadastrar usuário: " . $e->getMessage();
            return false;
        }
    }
}
?>
