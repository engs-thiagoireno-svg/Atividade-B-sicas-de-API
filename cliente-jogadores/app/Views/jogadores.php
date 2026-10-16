<?php /** @var array $jogadores */ ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Jogadores</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { border-collapse: collapse; width: 100%; max-width: 700px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background: #222; color: #fff; }
    </style>
</head>
<body>
    <h1>Jogadores</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Time</th>
            <th>Posição</th>
            <th>Camisa</th>
        </tr>
        <?php foreach ($jogadores as $jogador): ?>
            <tr>
                <td><?= esc($jogador['id']) ?></td>
                <td><?= esc($jogador['nome']) ?></td>
                <td><?= esc($jogador['time']) ?></td>
                <td><?= esc($jogador['posicao']) ?></td>
                <td><?= esc($jogador['numero_camisa']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>