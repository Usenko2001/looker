<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Template.php';
$template = new Template();

$eventId = (int)($_GET['id'] ?? 0);
$event = queryFetch("SELECT * FROM event WHERE id=?", [$eventId]);
if(!$event){
    $template->render('not_found', ['message'=>"Событие с id $eventId не найдено!"], ['title'=>'Ошибка']);
    return;
}

$page = max(1, (int)($_GET['page'] ?? 1));
$imagePageOffset = max(1, (int)($_GET['pageOffset'] ?? 5));
$offset = ($page - 1) * $imagePageOffset;
$image = queryFetch("SELECT * FROM eventImages WHERE event_id=? LIMIT 1 OFFSET $offset", [$eventId]);


$count = queryFetch("SELECT COUNT(*) as aggregate FROM eventImages WHERE event_id=?", [$eventId])['aggregate'];
$totalPages = ceil($count / $imagePageOffset);

$template->render('event', ['image'=>$image ?? '', 'event'=>$event,
    'id'=>$eventId, 'page'=>$page, 'totalPages'=>$totalPages],

    ['title'=>"Event #$eventId"]);

?>


