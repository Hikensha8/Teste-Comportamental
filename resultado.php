<?php
require_once './login/verifica_login.php';

/* ==========================================================
   resultado.php — Tela do resultado (FRONT-END PRONTO, com dados de exemplo)

   TODO (aluno):
   1. Receber $_POST, validar nome e as 24 respostas (se inválido, voltar ao teste)
   2. Somar os pontos de cada perfil (aguia, gato, lobo, tubarao)
   3. Descobrir o maior valor e os perfis predominantes (tratar EMPATE)
   4. Calcular o percentual: pontos / 24 * 100 (formatar com 1 ou 2 casas)
   5. Substituir os valores fixos abaixo por variáveis PHP
   6. Se houver empate: usar a classe "empate" em .destaque e o título
      "Resultado combinado: Águia + Lobo"
   7. Perfil único: trocar a classe de cor (aguia | gato | lobo | tubarao)
      no .destaque e no .descricao
   8. O CÁLCULO DEVE SER FEITO NO PHP (não vale usar JavaScript)
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
      <!-- TODO (aluno): gerar as 4 linhas com foreach. A largura da barra vem do percentual -->
      <li class="aguia">
        <div class="linha"><span>Águia</span><span>8 pontos · 33,3%</span></div>
        <div class="trilho"><span style="width:33.3%"></span></div>
      </li>
      <li class="gato">
        <div class="linha"><span>Gato</span><span>5 pontos · 20,8%</span></div>
        <div class="trilho"><span style="width:20.8%"></span></div>
      </li>
      <li class="lobo">
        <div class="linha"><span>Lobo</span><span>7 pontos · 29,2%</span></div>
        <div class="trilho"><span style="width:29.2%"></span></div>
      </li>
      <li class="tubarao">
        <div class="linha"><span>Tubarão</span><span>4 pontos · 16,7%</span></div>
        <div class="trilho"><span style="width:16.7%"></span></div>
      </li>
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
