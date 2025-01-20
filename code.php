<?php
session_start();
require_once 'database.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    echo "Você precisa fazer login.";
    exit;
}

// Verificar se foi feita uma pesquisa
$pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : '';

// Modificar a query para trazer todos os usuários caso a pesquisa esteja vazia
if ($pesquisa) {
    $query = "SELECT * FROM usuarios WHERE usuario LIKE :pesquisa OR sobrenome LIKE :pesquisa";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':pesquisa' => "%" . $pesquisa . "%"]);
} else {
    $query = "SELECT * FROM usuarios";
    $stmt = $pdo->query($query);
}

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

        .search-form {
            text-align: center;
            margin-bottom: 30px;
        }

        .search-form input {
            padding: 8px;
            font-size: 16px;
            width: 300px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .search-form button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-form button:hover {
            background-color: #45a049;
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

    <!-- Formulário de Pesquisa -->
    <div class="search-form">
        <form method="POST" action="">
            <input type="text" name="pesquisa" placeholder="Pesquisar por usuário ou sobrenome" value="<?= htmlspecialchars($pesquisa) ?>">
            <button type="submit">Pesquisar</button>
        </form>
    </div>

    <!-- Tabela de Usuários -->
    <table>
        <thead>
        <tr>
            <th>Usuário</th>
            <th>Nome/Sobrenome</th>
            <th>Painel CCO</th>
            <th>Painel PX</th>
            <th>Painel CCP</th>
            <th>Gravações</th>
            <th>Macros</th>
            <th>Logs</th>
            <th>Câmeras</th>
            <th>Restrições</th>
            <th>Alarmes</th>
            <th>Posicionamento</th>
            <th>HBHW</th>
            <th>PVS</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <form method="POST" action="salvar_permissoes.php">
                    <input type="hidden" name="usuario_id" value="<?= $usuario['usuario_id'] ?>">
                    <td><?= htmlspecialchars($usuario['usuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['sobrenome']) ?></td>
                    <td>
                        <input class="checkbox" type="checkbox" name="cco" value="sim" <?= $usuario['cco'] === 'sim' ? 'checked' : '' ?>>
                    </td>
                    <td>
                        <input class="checkbox" type="checkbox" name="px" value="sim" <?= $usuario['px'] === 'sim' ? 'checked' : '' ?>>
                    </td>
                    <td>
                        <input class="checkbox" type="checkbox" name="ccp" value="sim" <?= $usuario['ccp'] === 'sim' ? 'checked' : '' ?>>
                    </td>
                    <td>
                        <input class="checkbox" type="checkbox" name="gravacoes" value="sim" <?= $usuario['gravacoes'] === 'sim' ? 'checked' : '' ?>>
                    </td>
                    <td>
                        <input class="checkbox" type="checkbox" name="macros" value="sim" <?= $usuario['macros'] === 'sim' ? 'checked' : '' ?>>
                    </td>
                    <td>
                        <input class="checkbox" type="checkbox" name="logs" value="sim" <?= $usuario['logs'] === 'sim' ? 'checked' : '' ?>>
                    </td>
                    <td>
                        <input class="checkbox" type="checkbox" name="cameras" value="sim" <?= $usuario['cameras'] === 'sim' ? 'checked' : '' ?>>
                    </td>
                    <td>
                        <input class="checkbox" type="checkbox" name="restricoes" value="sim" <?= $usuario['restricoes'] === 'sim' ? 'checked' : '' ?>>
                    </td>
                    <td>
                        <input class="checkbox" type="checkbox" name="alarmes" value="sim" <?= $usuario['alarmes'] === 'sim' ? 'checked' : '' ?>>
                    </td>
                    <td>
                        <input class="checkbox" type="checkbox" name="posicionamento" value="sim" <?= $usuario['posicionamento'] === 'sim' ? 'checked' : '' ?>>
                    </td>
                    <td>
                        <input class="checkbox" type="checkbox" name="hb" value="sim" <?= $usuario['hb'] === 'sim' ? 'checked' : '' ?>>
                    </td>
                    <td>
                        <input class="checkbox" type="checkbox" name="pvs" value="sim" <?= $usuario['pvs'] === 'sim' ? 'checked' : '' ?>>
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
