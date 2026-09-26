<?php
header('Content-Type: application/json; charset=utf-8');
echo json_encode([
  'name' => 'BoutiquePro API PHP',
  'status' => 'ok'
], JSON_UNESCAPED_UNICODE);
