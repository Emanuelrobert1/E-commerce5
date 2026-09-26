<?php
header('Content-Type: application/json; charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error'=>'Méthode POST requise']);
    exit;
}
$data = json_decode(file_get_contents('php://input'), true) ?? [];
foreach (['name','email','phone','address'] as $field) {
    if (empty($data[$field])) {
        http_response_code(400);
        echo json_encode(['error'=>"Champ manquant: $field"]);
        exit;
    }
}
echo json_encode(['message'=>'Commande reçue en démonstration','order'=>$data], JSON_UNESCAPED_UNICODE);
