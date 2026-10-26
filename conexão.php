<?php
$host    = "localhost";  // onde o MySQL está rodando
$banco   = "perfil-comportamental";  // nome do banco que criamos
$usuario = "root";       // usuário padrão do XAMPP
$senha   = "";          // sem senha no XAMPP local

$conn = new PDO(
    "mysql:host=$host;dbname=$banco;charset=utf8",
    $usuario,
    $senha
);