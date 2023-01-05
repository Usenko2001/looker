<?php
$GLOBALS['_nosession'] = true;
include __DIR__.'/../connect.php';

//$events1 = queryFetchAll("SELECT * FROM event WHERE camera_id=1 and
//                          exists(SELECT id FROM eventImages WHERE event_id=event.id) ORDER BY time DESC LIMIT 10");
$events1 = queryFetchAll("SELECT * FROM event WHERE  
                          exists(SELECT id FROM eventImages WHERE event_id=event.id) ORDER BY time DESC LIMIT 10");

makeThumbnailsForEventList($events1);