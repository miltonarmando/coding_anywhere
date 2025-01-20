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
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Permissões de Acesso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px 15px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td {
            background-color: #f2f2f2;
        }

        .checkbox {
            margin: 0;
        }

        .save-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .save-button:hover {
            background-color: #45a049;
        }

        .form-row {
            text-align: center;
            margin-top: 20px;
        }

        .form-title {
            font-size: 18px;
            color: #333;
            margin: 10px 0;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Gerenciar Permissões de Acesso</h1>
    <table>
        <thead>
        <tr>
            <th>Usuário</th>
            <th>Página 1</th>
            <th>Página 2</th>
            <th>Diretório 1</th>
            <th>Diretório 2</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <form method="POST" action="salvar_permissoes.php">
                    <input type="hidden" name="usuario_id" value="<?= $usuario['usuario_id'] ?>">
                    <td><?= htmlspecialchars($usuario['nome']) ?></td>
                    <td>
                        <input class="checkbox" type="checkbox" name="pagina1"
                               value="sim" <?= $usuario['pagina1'] === 'sim' ? 'checked' : '' ?>>
                    </td>
                    <td>
                        <input class="checkbox" type="checkbox" name="pagina2"
                               value="sim" <?= $usuario['pagina2'] === 'sim' ? 'checked' : '' ?>>
                    </td>
                    <td>
                        <input class="checkbox" type="checkbox" name="diretorio1"
                               value="sim" <?= $usuario['diretorio1'] === 'sim' ? 'checked' : '' ?>>
                    </td>
                    <td>
                        <input class="checkbox" type="checkbox" name="diretorio2"
                               value="sim" <?= $usuario['diretorio2'] === 'sim' ? 'checked' : '' ?>>
                    </td>
                    <td>
                        <button type="submit" class="save-button">Salvar</button>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
