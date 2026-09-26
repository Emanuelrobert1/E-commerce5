<?php
header('Content-Type: application/json; charset=utf-8');
$path = __DIR__ . '/../../data/produits.json';
if (!file_exists($path)) {
    http_response_code(404);
    echo json_encode(['error'=>'Fichier produits introuvable']);
    exit;
}
echo file_get_contents($path);
