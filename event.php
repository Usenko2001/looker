<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Template.php';
$template = new Template();

$eventId = (int)($_GET['id'] ?? 0);
$event = queryFetch("SELECT * FROM event WHERE id=?", [$eventId]);
if(!$event){
    $template->render('not_found', ['message'=>"Событие с id $eventId не найдено!"], ['title'=>'Ошибка']);
    return;
}

$dir = "/img/thumb/event_$eventId";

$images = [];
$files = null;
if(file_exists(path($dir)))
    $files = scandir(path($dir));
if($files && count($files) > 1){
    foreach ($files as $file){
        $fname = basename($file);
        $id = preg_replace("/[^\d]+/", '', $fname);

        if($fname == 'thumb.jpg' || $fname =='.' || $fname == '..')
            continue;
        $images[$id] = $dir.DIRECTORY_SEPARATOR.$fname;
    }
}


$template->render('event', ['images'=>$images, 'event'=>$event,
    'id'=>$eventId],

    ['title'=>"Event #$eventId"]);

?>


