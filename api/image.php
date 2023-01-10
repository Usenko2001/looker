<?php
$GLOBALS['_nosession'] = true;
include __DIR__.'/../connect.php';
header('Content-Type: application/json');

$id = (int)($_GET['id'] ?? 0);
$image = queryFetch("SELECT * FROM eventImages WHERE id=? LIMIT 1", [$id]);
if(!$image){
    http_response_code(404);
    echo json_encode(['error'=>"Image at page $page not found!"]);
    die;
}

echo json_encode([
    'image' => $image['image']
], JSON_PRETTY_PRINT);