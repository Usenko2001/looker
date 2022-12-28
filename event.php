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
$perPage = max(1, (int)($_GET['perPage'] ?? 20));
$offset = ($page - 1) * $perPage;

$period = [];
$period['start'] = microtime(true);
$images = queryFetchAll("SELECT * FROM eventImages WHERE event_id=$eventId LIMIT $perPage OFFSET $offset", [$eventId]);
$period['end'] = microtime(true);
$period['time'] = $period['end'] - $period['start'];


$count = queryFetch("SELECT COUNT(*) as aggregate FROM eventImages WHERE event_id=?", [$eventId])['aggregate'];
$totalPages = ceil($count / $perPage);

$template->render('event', ['images'=>$images ?? '', 'event'=>$event,
    'id'=>$eventId, 'perPage'=>$perPage, 'page'=>$page, 'totalPages'=>$totalPages, 'loading'=>$period],

    ['title'=>"Event #$eventId"]);

?>


