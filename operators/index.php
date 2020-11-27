<?php
require($_SERVER["DOCUMENT_ROOT"]."/dbconn.php");

$operators = R::getAll("SELECT * FROM operatorlt");

foreach ($operators as $operator){
    $arResult["operators"][] = $operator;
}

echo json_encode($arResult);

R::close();
?>