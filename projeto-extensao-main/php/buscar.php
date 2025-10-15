<?php
require_once 'conn.php';
header('Content-Type: application/json');

$sql = "SELECT * FROM denuncias";
$result = $conn->query($sql);

$denuncias = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Converte latitude e longitude para float
        $row['latitude'] = floatval($row['latitude']);
        $row['longitude'] = floatval($row['longitude']);
        $denuncias[] = $row;
    }
}

echo json_encode($denuncias);
$conn->close();
?>
