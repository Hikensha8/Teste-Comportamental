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
$percentuais = [];

foreach ($pontuacoes as $perfil => $pontuacao) {
    $percentuais[$perfil] = $pontuacao / count($perguntas) * 100;
}

/* ==========================================================
   resultado.php — Tela do resultado (FRONT-END PRONTO, com dados de exemplo)

   TODO (aluno):
   1. Se houver empate: usar a classe "empate" em .destaque e o título
      "Resultado combinado: Águia + Lobo"
   2. Perfil único: trocar a classe de cor (aguia | gato | lobo | tubarao)
      no .destaque e no .descricao
   ========================================================== */
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

  <!-- MODELO A: perfil único. Troque "aguia" pela classe do perfil vencedor -->
  <section class="destaque aguia">
    <div class="pequeno"><?= htmlspecialchars($_SESSION['usuario_nome'], ENT_QUOTES, 'UTF-8') ?>, seu perfil predominante é</div>
    <h1>Águia</h1>
    <p><strong>Sonhador / Inovador</strong> — 8 pontos · 33,3%</p>
  </section>

  <!-- MODELO B: empate. Use no lugar do modelo A quando houver mais de um vencedor
  <section class="destaque empate">
    <div class="pequeno">Nome do participante, você teve</div>
    <h1>Resultado combinado: Águia + Lobo</h1>
    <p>Dois ou mais perfis empataram com a maior pontuação.</p>
  </section>
  -->

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

    <!-- TODO (aluno): mostrar a descrição do(s) perfil(is) predominante(s) -->
    <div class="descricao aguia">
      <h3>Águia — Sonhador / Inovador</h3>
      <p>Criativo, visionário, gosta de mudanças, inovação e possibilidades futuras. Pode ter muitas ideias e menor atenção aos detalhes.</p>
    </div>
  </section>

  <div class="acoes">
    <a class="btn" href="index.php">Fazer o teste novamente</a>
    <button class="btn secundario" type="button" onclick="window.print()">Imprimir resultado</button>
  </div>

</main>
</body>
</html>
