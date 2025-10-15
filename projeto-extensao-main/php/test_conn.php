<?php
require_once 'conn.php';

$sql = "SELECT COUNT(*) as total FROM denuncias";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    echo "Conexão estabelecida com sucesso! Registros na tabela denuncias: " . $row['total'];
} else {
    echo "Conectou, mas houve erro ao consultar a tabela: " . $conn->error;
}
