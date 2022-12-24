<?php

session_start();

$v = 222;

function createPdo(){
    $_host = '172.20.3.231';
    $_user = 'ilya';
    $_password = 'Qwerty!23456';
    $_db = 'test';
    return new PDO("mysql:host=$_host;dbname=$_db", $_user, $_password);
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
    $stmt = executeQuery($sql, $params);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


