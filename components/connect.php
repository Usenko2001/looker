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


