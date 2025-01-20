<?php
session_start();
require_once 'database.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    echo "Você precisa fazer login.";
    exit;
}

// Obter todos os usuários
$query = "SELECT * FROM usuarios";
$stmt = $pdo->query($query);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Permissões de Acesso</title>
</head>
<body>
    <h1>Gerenciar Permissões de Acesso</h1>
    <?php foreach ($usuarios as $usuario): ?>
        <form method="POST" action="salvar_permissoes.php">
            <input type="hidden" name="usuario_id" value="<?= $usuario['usuario_id'] ?>">
            <h3><?= htmlspecialchars($usuario['nome']) ?></h3>

            <!-- Permissões para páginas -->
            <label>
                <input type="checkbox" name="pagina1" value="sim" <?= $usuario['pagina1'] === 'sim' ? 'checked' : '' ?>>
                Página 1
            </label><br>

            <label>
                <input type="checkbox" name="pagina2" value="sim" <?= $usuario['pagina2'] === 'sim' ? 'checked' : '' ?>>
                Página 2
            </label><br>

            <!-- Permissões para diretórios -->
            <label>
                <input type="checkbox" name="diretorio1" value="sim" <?= $usuario['diretorio1'] === 'sim' ? 'checked' : '' ?>>
                Diretório 1 (/diretorio1/)
            </label><br>

            <label>
                <input type="checkbox" name="diretorio2" value="sim" <?= $usuario['diretorio2'] === 'sim' ? 'checked' : '' ?>>
                Diretório 2 (/diretorio2/)
            </label><br>

            <button type="submit">Salvar Permissões</button>
        </form>
    <?php endforeach; ?>
</body>
</html>
