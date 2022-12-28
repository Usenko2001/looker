<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Template.php';
$template = new Template();

$cameraId = (int)($_GET['id'] ?? 1);
$page = max(1, (int)($_GET['page'] ?? 0));
$perpage = 12;
$offset = ($page - 1) * $perpage;

$events = queryFetchAll("SELECT * FROM event WHERE camera_id=? and 
                          exists(SELECT id FROM eventImages WHERE event_id=event.id) ORDER BY time DESC LIMIT $perpage OFFSET $offset", [$cameraId]);
$total = queryFetch("SELECT count(*) as aggregate FROM event WHERE camera_id=? and 
                          exists(SELECT id FROM eventImages WHERE event_id=event.id)", [$cameraId])['aggregate'];
$pages = ceil($total / $perpage);
$pagination = [
    'count'=>count($events),
    'total'=>$total,
    'page'=>$page,
    'totalPages'=>$pages,
];

makeThumbnailsForEventList($events);


$template->render('camera', ['cameraId'=>$cameraId, 'events'=>$events,'pagination'=>$pagination], ['title'=>"Камера #$cameraId"]);

?>


