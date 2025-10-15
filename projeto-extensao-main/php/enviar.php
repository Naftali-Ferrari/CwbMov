<?php
require_once 'conn.php';

$response = ['success' => false, 'message' => 'Erro desconhecido'];

$nome = $_POST['usuario_nome'] ?? '';
$bairro = $_POST['bairro'] ?? '';
$categoria = $_POST['categoria'] ?? '';
$descricao = $_POST['descricao'] ?? '';
$latitude = $_POST['latitude'] ?? '';
$longitude = $_POST['longitude'] ?? '';
$foto_nome = null;

// Validação mínima
if (empty($nome) || empty($bairro) || empty($categoria) || empty($descricao) || $latitude === '' || $longitude === '') {
    $response['message'] = 'Preencha todos os campos e selecione o local no mapa.';
    echo json_encode($response);
    exit;
}

// Upload da foto (opcional)
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $permitidas = ['jpg','jpeg','png'];

    if (in_array(strtolower($extensao), $permitidas)) {
        $foto_nome = time() . "_" . preg_replace("/[^a-zA-Z0-9._-]/", "", $_FILES['foto']['name']);
        $destino = __DIR__ . "/../uploads/" . $foto_nome;
        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
            $response['message'] = 'Erro ao salvar a imagem.';
            echo json_encode($response);
            exit;
        }
    } else {
        $response['message'] = 'Formato de imagem não permitido (jpg, jpeg, png).';
        echo json_encode($response);
        exit;
    }
}

// Inserção no banco
$stmt = $conn->prepare("INSERT INTO denuncias (usuario_nome, bairro, categoria, descricao, foto, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $nome, $bairro, $categoria, $descricao, $foto_nome, $latitude, $longitude);

if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = 'Denúncia enviada com sucesso!';
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>