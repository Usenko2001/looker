<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Template.php';
$template = new Template();

$events = queryFetchAll("SELECT * FROM event ORDER BY time DESC LIMIT 12");


$template->render('index', ['events'=>$events, 'name'=>"Vasya 228"], ['title'=>'Main page']);

?>


