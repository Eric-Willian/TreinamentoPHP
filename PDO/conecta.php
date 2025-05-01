<?php
class Database {
    private $host = 'localhost';       // Nome do host
    private $dbName = 'treinamento_php';     // Nome do banco de dados
    private $username = 'root';     // Nome de usuário do banco
    private $password = '';       // Senha do banco
    private $conn;

    // Método para obter a conexão
    public function connect() {
        $this->conn = null;

        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            // Configura o PDO para lançar exceções em erros
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Erro na conexão: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
?>