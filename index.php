<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Template.php';
$template = new Template();

$start = microtime(true);

$events1 = queryFetchAll("SELECT * FROM event WHERE camera_id=1 and 
                          exists(SELECT id FROM eventImages WHERE event_id=event.id) ORDER BY time DESC LIMIT 8");
$events2 = queryFetchAll("SELECT * FROM event WHERE camera_id=8 and 
                          exists(SELECT id FROM eventImages WHERE event_id=event.id) ORDER BY time DESC LIMIT 8");

$eventIds = [];
foreach ($events1 as $e){$eventIds[] = $e['id'];}
$eventIds = join(',', $eventIds);
$images = queryFetchAll("SELECT * FROM eventImages WHERE event_id IN ($eventIds) GROUP BY event_id;");
foreach ($events1 as $i=>$event){
    foreach ($images as $img){
        if($event['id'] == $img['event_id']){
            $event['image'] = $img['image'] ?? null;
            $events1[$i] = $event;
            break;
        }
    }
}
//foreach ($events2 as $i=>$event){
//    $stmt->execute([$event['id']]);
//    $image = $stmt->fetch(PDO::FETCH_ASSOC);
//    $event['image'] = $image['image'] ?? null;
//    $events2[$i] = $event;
//}
$end = microtime(true);
$loadTime = round( $end - $start, 3);


$template->render('index', ['events1'=>$events1, 'events2'=>$events2, 'name'=>"Vasya 228", 'loadTime'=>$loadTime], ['title'=>'Main page']);

?>


