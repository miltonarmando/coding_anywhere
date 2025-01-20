<?php
session_start();
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario_id'];

    // Determinar valores para cada permissão
    $pagina1 = isset($_POST['pagina1']) ? 'sim' : 'nao';
    $pagina2 = isset($_POST['pagina2']) ? 'sim' : 'nao';
    $diretorio1 = isset($_POST['diretorio1']) ? 'sim' : 'nao';
    $diretorio2 = isset($_POST['diretorio2']) ? 'sim' : 'nao';

    // Atualizar permissões no banco de dados
    $query = "UPDATE usuarios 
              SET pagina1 = :pagina1, 
                  pagina2 = :pagina2, 
                  diretorio1 = :diretorio1, 
                  diretorio2 = :diretorio2 
              WHERE usuario_id = :usuario_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':pagina1' => $pagina1,
        ':pagina2' => $pagina2,
        ':diretorio1' => $diretorio1,
        ':diretorio2' => $diretorio2,
        ':usuario_id' => $usuario_id
    ]);

    echo "Permissões atualizadas com sucesso.";
    header('Location: gerenciar_permissoes.php');
    exit;
}
?>
