<?php
if(!isset($GLOBALS['_nosession']) || !$GLOBALS['_nosession'])
    session_start();

$v = 222;

function dbConnectData(){
    $_host = '172.20.3.233';
    $_user = 'ivanUser';
    $_password = 'Qwerty!@#456';
    $_db = 'vcontrol';
    return [
        'host'=>$_host,
        'user'=>$_user,
        'password'=>$_password,
        'db'=>$_db,
    ];
}

function createPdo(){
    $connect = dbConnectData();
    return new PDO("mysql:host={$connect['host']};dbname={$connect['db']}", $connect['user'], $connect['password']);


}
function createMysqli(){
    $connect = dbConnectData();
    return mysqli_connect($connect['host'], $connect['user'], $connect['password'], $connect['db']);

}

function prepareQuery($sql){
    $pdo = createPdo();
    return $pdo->prepare($sql);
}
function executeQuery($sql, $params = []){
    $stmt = prepareQuery($sql);
    $stmt->execute($params);
    return $stmt;
}

function queryFetchAll($sql, $params = []){



    $stmt = executeQuery($sql, $params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function queryFetch($sql, $params = []){
    //mysqli
//    $mysql = createMysqli();
//    $result = $mysql->query($sql);
//    $row = $result->fetch_assoc();
//    return $row;

    //pdo
    $stmt = executeQuery($sql, $params);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function path($path){
    if(isset($_SERVER) && isset($_SERVER['DOCUMENT_ROOT']) && $_SERVER["DOCUMENT_ROOT"]) {
        $pathRoot = $_SERVER['DOCUMENT_ROOT'];
    }
    else
        $pathRoot = __DIR__;
    return $pathRoot . DIRECTORY_SEPARATOR . trim($path, DIRECTORY_SEPARATOR);
}

function make_thumb($img, $dir, $name, $desired_width) {

    /* read the source image */
    $tmp = path('/img/thumb/tmp.jpg');
    file_put_contents($tmp, base64_decode($img), LOCK_EX);
    try {
//        chmod($tmp, 0666);
    }catch (Exception $e){}

    $source_image = imagecreatefromjpeg($tmp);
    $width = imagesx($source_image);
    $height = imagesy($source_image);

    /* find the "desired height" of this thumbnail, relative to the desired width  */
    $desired_height = floor($height * ($desired_width / $width));

    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

    if($dir)
        $localdir = '/img/thumb/'. trim($dir, '/');
    else
        $localdir = '/img/thumb';
    $dir = path($localdir);

    mkdir($dir);
    try {
        chmod($dir, 0777);
    }catch (Exception $e){}

    /* create the physical thumbnail image to its destination */
    $name = trim($name, '/');
    $path = $localdir.'/'.$name;
    $dest = $dir.'/'.$name;
    imagejpeg($virtual_image, $dest);
    try {
        chmod($dest, 0666);
    }catch (Exception $e){}

    return $path;
}

function makeEventThumb($img, $eventId, $desiredWidth = 300){
    return make_thumb($img, 'event_'.$eventId, 'thumb.jpg', $desiredWidth);
}

function eventThumbnailExists($eventId){
    $local = '/img/thumb/event_'.$eventId.'/thumb.jpg';
    $file = path($local);
    return file_exists($file);
}
function getThumbImageForEvent($eventId, $img = null){
    $local = '/img/thumb/event_'.$eventId.'/thumb.jpg';
    $file = path($local);
    if(file_exists($file))
        return $local;
    if($img)
        return 'data:image/jpeg;base64,'.$img;
    return false;
}
function eventIdListForThumbnail($events){
    $eventIds = [];
    foreach ($events as $e){
        if(!eventThumbnailExists($e['id']))
            $eventIds[] = $e['id'];
    }
    return $eventIds;
}

function makeThumbnailsForEventList($events){
    $eventIds = eventIdListForThumbnail($events);
    $eventIds = join(',', $eventIds);
    $images = queryFetchAll("SELECT * FROM eventImages WHERE event_id IN ($eventIds) GROUP BY event_id;");
    foreach ($images as $img){
        if($img['image'])
            makeEventThumb($img['image'], $img['event_id']);
    }
}

function log_message($message){
    $message = "[" . date("Y-m-d H:i:s") . "] " . $message . PHP_EOL;
    file_put_contents(path('looker.log'), $message, FILE_APPEND);
}
