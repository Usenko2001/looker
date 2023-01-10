<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Template.php';
$template = new Template();

$start = microtime(true);

$events1 = queryFetchAll("SELECT * FROM event WHERE camera_id=1 and 
                          exists(SELECT id FROM eventImages WHERE event_id=event.id) ORDER BY time DESC LIMIT 16");
$events2 = queryFetchAll("SELECT * FROM event WHERE camera_id=8 and 
                          exists(SELECT id FROM eventImages WHERE event_id=event.id) ORDER BY time DESC LIMIT 16");


$allEvents = array_merge($events1, $events2);

if(isset($_GET['cache_new']) && $_GET['cache_new'])
    makeThumbnailsForEventList($events1);

$neededCache = count(eventIdListForThumbnail($events1)) > 0;

$end = microtime(true);
$loadTime = round( $end - $start, 3);


$template->render('index', ['events1'=>$events1, 'events2'=>$events2, 'loadTime'=>$loadTime,
    'neededCache'=>$neededCache], ['title'=>'Main page']);

?>


