<?php
$host    = "localhost";  // onde o MySQL está rodando
$banco   = "perfil-comportamental";  // nome do banco que criamos
$usuario = "root";       // usuário padrão do XAMPP
$senha   = "";          // sem senha no XAMPP local

$conn = new PDO(
    "mysql:host=$host;
    dbname=$banco;
    charset=utf8",
    $usuario,
    $senha
);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // útil para depuração, mas não recomendado em produção
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); não é necessário se a versão do php for 8.0.0 ou maior (conferir documentação)