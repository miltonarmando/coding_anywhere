<?php
// Configurações do banco de dados
$host = 'localhost'; // Endereço do servidor do banco de dados
$dbname = 'nome_do_banco'; // Nome do banco de dados
$username = 'usuario_do_banco'; // Nome de usuário do banco de dados
$password = 'senha_do_banco'; // Senha do banco de dados
$charset = 'utf8mb4'; // Charset para suporte a caracteres especiais

try {
    // Criação da conexão PDO
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=$charset",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Lançar exceções em caso de erro
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Configurar o modo de busca como associativo
            PDO::ATTR_PERSISTENT => false, // Conexões não persistentes (recomendado para evitar problemas de memória)
        ]
    );
} catch (PDOException $e) {
    // Em caso de erro, exibir uma mensagem e encerrar o script
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>
