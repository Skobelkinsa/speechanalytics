<?php
// Подключаем библиотеку
date_default_timezone_set("Europe/Moscow");
header('Content-Type: application/json');
header('Authorization: Bearer Q1BXRGcZIbNRgSjxKL3QBrqzCnOhqgKFN8xC6WWsAeooOHBPQcw4eDlk1NNTfRIGT6H2lNgvbQ');
require 'rb.php';
function pr($arr){
    echo "<pre>".print_r($arr, true)."</pre>";
}

// Подключение БД
R::setup('mysql:host=168.168.88.203:3306;dbname=asteriskcrd', 'user-api1', 'ZmDpg34AkRtyo1P');
R::freeze(true);
// Проверка подключения БД
if ( !R::testConnection() ){
    // Выводить если БД не подключена
    exit ('Нет соединения с базой данных');
}
?>