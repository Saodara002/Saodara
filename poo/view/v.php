<?php
declare(strict_types=1);

require_once __DIR__ . '/../control/c.php';

$controlador = new Controlador();
$dados = $controlador->dados_view();
$usuarios = $dados['usuarios'];
$resultados = $dados['resultados'];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MVC POO</title>

    <link rel="stylesheet" href="view.css">
</head>

<body>
    <div class="container">
        <h1>Resultado do login e demonstração de POO</h1>
        <div class="card">
            <h2>Usuários instanciados</h2>
            <div class="usuario-box">

                <?php foreach ($usuarios as $usuario): ?>

                    <div class="usuario-card">
                        <h3><?= htmlspecialchars($usuario->saudacao()); ?></h3>
                        <ul>
                            <li>ID: <?= htmlspecialchars((string) $usuario->id); ?></li>
                            <li>Nome: <?= htmlspecialchars($usuario->nome); ?></li>
                            <li>Email: <?= htmlspecialchars($usuario->email); ?></li>
                            <li>Tipo: <?= htmlspecialchars($usuario->tipo_formatado()); ?></li>

                            <?php if ($usuario instanceof Professor): ?>
                                <li>Matérias: <?= htmlspecialchars(implode(', ', $usuario->materias_leciona)); ?></li>
                            <?php endif; ?>

                            <?php if ($usuario instanceof Aluno): ?>
                                <li>XP Total: <?= htmlspecialchars((string) $usuario->xp_total); ?></li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php foreach ($resultados as $resultado): ?>
            <?php $classe = $resultado['sucesso'] ? 'sucesso' : 'erro'; ?>

            <div class="card <?= $classe; ?>">

                <h2><?= htmlspecialchars($resultado['label']); ?></h2>
                <p><strong>Status:</strong> <?= $resultado['sucesso'] ? 'Sucesso' : 'Erro'; ?></p>
                <p><strong>Mensagem:</strong> <?= htmlspecialchars($resultado['mensagem']); ?></p>

                <?php if ($resultado['usuario'] instanceof Usuario): ?>
                    <p><strong>Nome:</strong> <?= htmlspecialchars($resultado['usuario']->nome); ?></p>
                    <p><strong>Saudação:</strong> <?= htmlspecialchars($resultado['usuario']->saudacao()); ?></p>
                    <p><strong>Tipo:</strong> <?= htmlspecialchars($resultado['usuario']->tipo_formatado()); ?></p>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>