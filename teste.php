<?php
require_once './login/verifica_login.php';
require_once 'dados/perguntas.php';

$totalPerguntas = count($perguntas);
$erroTeste = $_SESSION['erro_teste'] ?? null;
unset($_SESSION['erro_teste']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Teste de perfil — perguntas</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<!-- Barra de progresso (JavaScript no final do arquivo só atualiza a barra; não calcula resultado) -->
<div class="topo-progresso">
  <div class="container" style="padding:0">
    <div class="texto"><span>Olá, <?= htmlspecialchars($_SESSION['usuario_nome'], ENT_QUOTES, 'UTF-8') ?></span><span id="contador">0 de <?= $totalPerguntas ?> respondidas</span></div>
    <div class="barra"><span id="preenchimento"></span></div>
  </div>
</div>

<main class="container">
  <h1 class="titulo-pagina">Escolha uma alternativa por pergunta</h1>

  <?php if ($erroTeste === 'respostas'): ?>
  <div class="alerta" role="alert">
    <strong>Faltam perguntas sem resposta.</strong>
    Responda todas as perguntas para ver seu resultado.
  </div>
  <?php endif; ?>

  <form action="resultado.php" method="post" id="form-teste">
    <?php foreach ($perguntas as $indice => $pergunta): ?>
    <fieldset class="pergunta" style="margin-left:0;margin-right:0">
      <legend class="numero" style="padding:0">Pergunta <?= $indice + 1 ?> de <?= $totalPerguntas ?></legend>
      <h2><?= htmlspecialchars($pergunta['texto'], ENT_QUOTES, 'UTF-8') ?></h2>

      <?php foreach ($pergunta['alternativas'] as $indiceAlternativa => $alternativa): ?>
      <label class="opcao">
        <input type="radio" name="respostas[<?= $indice ?>]" value="<?= htmlspecialchars($alternativa['perfil'], ENT_QUOTES, 'UTF-8') ?>"<?= $indiceAlternativa === 0 ? ' required' : '' ?>>
        <span><?= htmlspecialchars($alternativa['texto'], ENT_QUOTES, 'UTF-8') ?></span>
      </label>
      <?php endforeach; ?>
    </fieldset>
    <?php endforeach; ?>

    <div class="acoes">
      <button class="btn" type="submit">Ver meu resultado</button>
      <a class="btn secundario" href="index.php">Voltar ao início</a>
    </div>
  </form>
</main>

<script>
/* Apenas visual: atualiza a barra de progresso conforme as respostas marcadas. */
(function () {
  var form = document.getElementById('form-teste');
  var total = <?= $totalPerguntas ?>;
  function atualizar() {
    var nomes = {};
    form.querySelectorAll('input[type=radio]:checked').forEach(function (r) { nomes[r.name] = true; });
    var feitas = Object.keys(nomes).length;
    document.getElementById('contador').textContent = feitas + ' de ' + total + ' respondidas';
    document.getElementById('preenchimento').style.width = (feitas / total * 100) + '%';
  }
  form.addEventListener('change', atualizar);
  atualizar();
})();
</script>
</body>
</html>
