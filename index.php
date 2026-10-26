<?php
/* ==========================================================
   index.php — Página inicial (FRONT-END PRONTO)
   TODO (aluno): 
   - Ler a mensagem de erro (ex.: nome vazio) e exibi-la dentro do bloco .alerta
   - Decidir como o nome chega ao teste.php (POST, GET ou $_SESSION)
   ========================================================== */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Qual é o seu perfil? — Águia, Gato, Lobo ou Tubarão</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<main class="container">

  <div class="capa" aria-hidden="true">
    <div class="aguia">Águia</div><div class="gato">Gato</div>
    <div class="lobo">Lobo</div><div class="tubarao">Tubarão</div>
  </div>

  <h1 class="titulo-pagina">Qual animal é o seu perfil?</h1>
  <p>São 24 perguntas rápidas com quatro alternativas cada. Escolha a que mais combina com você. No final, você descobre seu perfil predominante.</p>

  <section class="painel">
    <!-- TODO (aluno): exiba este bloco SOMENTE quando houver erro de validação -->
    <div class="alerta" role="alert">
      <strong>Informe seu nome para começar.</strong>
      (mensagem de exemplo — troque por uma variável PHP)
    </div>

    <!-- TODO (aluno): definir method e o tratamento dos dados enviados -->
    <form action="teste.php" method="post">
      <label class="campo" for="nome">Seu nome</label>
      <input type="text" id="nome" name="nome" placeholder="Digite seu nome" autocomplete="name">
      <button class="btn" type="submit">Começar o teste</button>
    </form>

    <ul class="perfis-lista">
      <li class="aguia"><strong>Águia</strong> — Sonhador / Inovador</li>
      <li class="gato"><strong>Gato</strong> — Comunicativo / Relacional</li>
      <li class="lobo"><strong>Lobo</strong> — Organizado / Planejador</li>
      <li class="tubarao"><strong>Tubarão</strong> — Executor / Prático</li>
    </ul>
  </section>

</main>
</body>
</html>
