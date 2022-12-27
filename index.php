<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Template.php';
$template = new Template();

$start = microtime(true);

$events1 = queryFetchAll("SELECT * FROM event WHERE camera_id=1 and 
                          exists(SELECT id FROM eventImages WHERE event_id=event.id) ORDER BY time DESC LIMIT 8");
$events2 = queryFetchAll("SELECT * FROM event WHERE camera_id=8 and 
                          exists(SELECT id FROM eventImages WHERE event_id=event.id) ORDER BY time DESC LIMIT 8");

$stmt = prepareQuery("SELECT * FROM eventImages WHERE event_id=? LIMIT 1");
foreach ($events1 as $i=>$event){
    $stmt->execute([$event['id']]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);
    $event['image'] = $image['image'] ?? null;
    $events1[$i] = $event;
}
foreach ($events2 as $i=>$event){
    $stmt->execute([$event['id']]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);
    $event['image'] = $image['image'] ?? null;
    $events2[$i] = $event;
}
$end = microtime(true);
$loadTime = round( $end - $start, 3);


$template->render('index', ['events1'=>$events1, 'events2'=>$events2, 'name'=>"Vasya 228", 'loadTime'=>$loadTime], ['title'=>'Main page']);

?>


