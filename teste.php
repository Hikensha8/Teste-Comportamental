<?php
require_once './login/verifica_login.php';
require_once 'dados/perguntas.php';
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
    <div class="texto"><span>Olá, <?= htmlspecialchars($_SESSION['usuario_nome'], ENT_QUOTES, 'UTF-8') ?></span><span id="contador">0 de 24 respondidas</span></div>
    <div class="barra"><span id="preenchimento"></span></div>
  </div>
</div>

<main class="container">
  <h1 class="titulo-pagina">Escolha uma alternativa por pergunta</h1>

  <!-- TODO (aluno): exiba somente se a validação falhar -->
  <div class="alerta" role="alert">
    <strong>Faltam perguntas sem resposta.</strong>
    Responda todas para ver seu resultado. (mensagem de exemplo)
  </div>

  <form action="resultado.php" method="post" id="form-teste">
    <!-- ===== MODELO DE UMA PERGUNTA — repita com foreach ===== -->
    <fieldset class="pergunta" style="margin-left:0;margin-right:0">
      <legend class="numero" style="padding:0">Pergunta 1 de 24</legend>
      <h2>Quando surge um problema inesperado, eu costumo...</h2>

      <label class="opcao">
        <input type="radio" name="respostas[0]" value="aguia">
        <span>Pensar em uma solução inovadora e diferente.</span>
      </label>
      <label class="opcao">
        <input type="radio" name="respostas[0]" value="gato">
        <span>Conversar com outras pessoas para buscar apoio.</span>
      </label>
      <label class="opcao">
        <input type="radio" name="respostas[0]" value="lobo">
        <span>Analisar as informações antes de decidir.</span>
      </label>
      <label class="opcao">
        <input type="radio" name="respostas[0]" value="tubarao">
        <span>Agir rapidamente para resolver o problema.</span>
      </label>
    </fieldset>
    <!-- ===== FIM DO MODELO ===== -->

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
  var total = 24;
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
