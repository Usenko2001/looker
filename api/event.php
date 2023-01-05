<?php
$GLOBALS['_nosession'] = true;
include __DIR__.'/../connect.php';
header('Content-Type: application/json');

$id = (int)($_GET['id'] ?? 0);
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = max(1, (int)($_GET['perPage'] ?? 1));
$event = queryFetch("SELECT * FROM event WHERE id=?", [$id]);

if(!$event){
    http_response_code(404);
    echo json_encode(['error'=>'Event not found!']);
    die;
}

$offset = ($page - 1) * $perPage;
$image = queryFetch("SELECT * FROM eventImages WHERE event_id=? LIMIT 1 OFFSET $offset", [$id]);
if(!$image){
    http_response_code(404);
    echo json_encode(['error'=>"Image at page $page not found!"]);
    die;
}

echo json_encode([
    'image' => $image['image']
], JSON_PRETTY_PRINT);