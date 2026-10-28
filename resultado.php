<?php
require_once './login/verifica_login.php';
require_once 'dados/perguntas.php';

$respostas = $_POST['respostas'] ?? null;
$respostasValidas = ($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && is_array($respostas);

if ($respostasValidas) {
    $respostasValidas = count($respostas) === count($perguntas);

    foreach ($perguntas as $indice => $pergunta) {
        $perfisValidos = array_column($pergunta['alternativas'], 'perfil');
        if (!isset($respostas[$indice]) || !in_array($respostas[$indice], $perfisValidos, true)) {
            $respostasValidas = false;
            break;
        }
    }
}

if (!$respostasValidas) {
    $_SESSION['erro_teste'] = 'respostas';
    header('Location: teste.php');
    exit;
}

$perfis = array_column($perguntas[0]['alternativas'], 'perfil');
$pontuacoes = array_fill_keys($perfis, 0);

foreach ($respostas as $perfil) {
    $pontuacoes[$perfil]++;
}

$maiorPontuacao = max($pontuacoes);
$perfisPredominantes = [];

foreach ($pontuacoes as $perfil => $pontuacao) {
    if ($pontuacao === $maiorPontuacao) {
        $perfisPredominantes[] = $perfil;
    }
}

$nomesPerfis = [
    'aguia' => 'Águia',
    'gato' => 'Gato',
    'lobo' => 'Lobo',
    'tubarao' => 'Tubarão',
];
$descricoesPerfis = [
    'aguia' => [
        'caracteristicas' => 'Sonhador / Inovador',
        'descricao' => 'Criativo e visionário, gosta de mudanças, inovação e possibilidades futuras. Pode ter muitas ideias e dar menos atenção aos detalhes.',
    ],
    'gato' => [
        'caracteristicas' => 'Comunicativo / Relacional',
        'descricao' => 'Comunicativo e sociável, valoriza relacionamentos, colaboração e o contato com outras pessoas.',
    ],
    'lobo' => [
        'caracteristicas' => 'Organizado / Planejador',
        'descricao' => 'Organizado e cuidadoso, valoriza planejamento, informações claras e segurança antes de agir.',
    ],
    'tubarao' => [
        'caracteristicas' => 'Executor / Prático',
        'descricao' => 'Prático e determinado, gosta de desafios, decisões rápidas e foco em resultados.',
    ],
];
$percentuais = [];

foreach ($pontuacoes as $perfil => $pontuacao) {
    $percentuais[$perfil] = $pontuacao / count($perguntas) * 100;
}

$nomeUsuario = htmlspecialchars($_SESSION['usuario_nome'], ENT_QUOTES, 'UTF-8');
$nomesPredominantes = [];
foreach ($perfisPredominantes as $perfil) {
    $nomesPredominantes[] = $nomesPerfis[$perfil];
}
$empate = count($perfisPredominantes) > 1;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Seu resultado — Teste de perfil</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<main class="container">

  <section class="destaque <?= $empate ? 'empate' : htmlspecialchars($perfisPredominantes[0], ENT_QUOTES, 'UTF-8') ?>">
    <?php if ($empate): ?>
    <div class="pequeno"><?= $nomeUsuario ?>, você teve</div>
    <h1>Resultado combinado: <?= htmlspecialchars(implode(' + ', $nomesPredominantes), ENT_QUOTES, 'UTF-8') ?></h1>
    <p>Os perfis predominantes empataram com <?= $maiorPontuacao ?> pontos cada.</p>
    <?php else: ?>
    <?php $perfilPredominante = $perfisPredominantes[0]; ?>
    <div class="pequeno"><?= $nomeUsuario ?>, seu perfil predominante é</div>
    <h1><?= htmlspecialchars($nomesPerfis[$perfilPredominante], ENT_QUOTES, 'UTF-8') ?></h1>
    <p><strong><?= htmlspecialchars($descricoesPerfis[$perfilPredominante]['caracteristicas'], ENT_QUOTES, 'UTF-8') ?></strong> — <?= $maiorPontuacao ?> pontos · <?= number_format($percentuais[$perfilPredominante], 1, ',', '.') ?>%</p>
    <?php endif; ?>
  </section>

  <section class="painel">
    <h2>Sua pontuação</h2>
    <ul class="placar">
      <?php foreach ($pontuacoes as $perfil => $pontuacao): ?>
      <?php $percentual = $percentuais[$perfil]; ?>
      <li class="<?= htmlspecialchars($perfil, ENT_QUOTES, 'UTF-8') ?>">
        <div class="linha"><span><?= htmlspecialchars($nomesPerfis[$perfil], ENT_QUOTES, 'UTF-8') ?></span><span><?= $pontuacao ?> pontos · <?= number_format($percentual, 1, ',', '.') ?>%</span></div>
        <div class="trilho"><span style="width:<?= number_format($percentual, 1, '.', '') ?>%"></span></div>
      </li>
      <?php endforeach; ?>
    </ul>

    <?php foreach ($perfisPredominantes as $perfil): ?>
    <div class="descricao <?= htmlspecialchars($perfil, ENT_QUOTES, 'UTF-8') ?>">
      <h3><?= htmlspecialchars($nomesPerfis[$perfil], ENT_QUOTES, 'UTF-8') ?> — <?= htmlspecialchars($descricoesPerfis[$perfil]['caracteristicas'], ENT_QUOTES, 'UTF-8') ?></h3>
      <p><?= htmlspecialchars($descricoesPerfis[$perfil]['descricao'], ENT_QUOTES, 'UTF-8') ?></p>
    </div>
    <?php endforeach; ?>
  </section>

  <div class="acoes">
    <a class="btn" href="index.php">Fazer o teste novamente</a>
    <button class="btn secundario" type="button" onclick="window.print()">Imprimir resultado</button>
  </div>

</main>
</body>
</html>
