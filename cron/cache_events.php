<?php
$GLOBALS['_nosession'] = true;
include __DIR__.'/../connect.php';

$eventId = $_GET['event'] ?? 0;
$makeBaseThumb = true;
if($eventId > 0){
    $events1 = queryFetchAll("SELECT * FROM event WHERE id=?", [$eventId]);
    $makeBaseThumb = $_GET['baseThumb'] ?? null;
} else {
    $events1 = queryFetchAll("SELECT * FROM event WHERE  
                          exists(SELECT id FROM eventImages WHERE event_id=event.id) ORDER BY time DESC LIMIT 10");
}


function makeEventImageThumb($img, $imageId, $eventId, $desiredWidth = 600){
    return make_thumb($img, 'event_'.$eventId, "image-$imageId.jpg", $desiredWidth);
}
function eventImagesToThumbnails($event, $ids = []){
    if(count($ids) == 0)
        return;
    $imageIds = join(',', $ids);
    $images = queryFetchAll("SELECT * FROM eventImages where event_id=? and id in($imageIds)", [$event['id']]);
    foreach ($images as $img){
        makeEventImageThumb($img['image'], $img['id'], $event['id']);
    }
}
function processEventImagesToThumbs($event){
    $images = queryFetchAll("SELECT id, event_id FROM eventImages WHERE event_id=?",[$event['id']]);
    $imagesIds = [];
    $maxSize = 10;
    foreach ($images as $i){
        if(eventImageThumbnailExists($event['id'], $i['id']))
            continue;
        $imagesIds[] = $i['id'];
        if(count($imagesIds) >= 10) {
            eventImagesToThumbnails($event, $imagesIds);
            $imagesIds = [];
        }
    }
    eventImagesToThumbnails($event, $imagesIds);
}
function makeImagesThumbnailsForEventList($events){
    foreach($events as $event){
        processEventImagesToThumbs($event);
    }
}

if($makeBaseThumb)
    makeThumbnailsForEventList($events1);
makeImagesThumbnailsForEventList($events1);