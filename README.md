# Teste-Comportamental-
Projeto acadêmico desenvolvido para colocar em prática o que aprendemos sobre PHP em back-end.

1: Abra a pasta htdocs do XAMPP no terminal
2: git clone https://github.com/Hikensha8/Teste-Comportamental.git
3: ative o Apache e o MySQL
4: abra o phpmyadmin
5: crie uma tabela chamada perfil-comportamental 
6: em SQL: 

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

7: acesse
http://localhost/teste-comportamental/index.php
8: Não se esqueça de apagar os cookies ao sair!
