<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Template.php';
$template = new Template();

$start = microtime(true);

$events1 = queryFetchAll("SELECT * FROM event WHERE camera_id=1 and 
                          exists(SELECT id FROM eventImages WHERE event_id=event.id) ORDER BY time DESC LIMIT 8");
$events2 = queryFetchAll("SELECT * FROM event WHERE camera_id=8 and 
                          exists(SELECT id FROM eventImages WHERE event_id=event.id) ORDER BY time DESC LIMIT 8");


$allEvents = array_merge($events1, $events2);

makeThumbnailsForEventList($allEvents);

$end = microtime(true);
$loadTime = round( $end - $start, 3);


$template->render('index', ['events1'=>$events1, 'events2'=>$events2, 'loadTime'=>$loadTime], ['title'=>'Main page']);

?>


