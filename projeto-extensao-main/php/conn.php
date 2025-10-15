<?php
// conn.php - conexão com MySQL usando mysqli
$DB_HOST = "localhost";
$DB_USER = "root";      
$DB_PASS = "root";
$DB_NAME = "denuncias_db";

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Verifica conexão
if ($conn->connect_error) {
    // Em produção não exiba detalhes de erro; aqui só para desenvolvimento
    die("Conexão falhou: " . $conn->connect_error);
}

// Para garantir que os dados venham em UTF-8
$conn->set_charset("utf8mb4");
