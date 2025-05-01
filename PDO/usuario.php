<?php
class Usuario {
    private $conn;

    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM contas WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);  // Retorna os dados do usuário
        } else {
            return false;
        }
    }

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    public function emailExiste($email) {
        $sql = "SELECT cod FROM contas WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
    
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    
    public function cadastrar($nome, $email, $senha) {
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
