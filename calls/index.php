<?php
require($_SERVER["DOCUMENT_ROOT"]."/dbconn.php");

$date_from = date("Y-m-d H:i:s", $_GET["date_from"]);
$date_till = date("Y-m-d H:i:s", $_GET["date_till"]);

//$date_from = date("Y-m-d H:i:s", strtotime("2020-08-14 00:00:00"));
//$date_till = date("Y-m-d H:i:s", strtotime("2020-08-14 23:59:59")); 

$arResult["calls"] = [];
//$arResult["response_date"][] = $date_from;
//$arResult["response_date"][] = $date_till;

$status = [
    "FAILED" => "REJECTED",
    "NO ANSWER" => "REJECTED",
    "BUSY" => "REJECTED",
    "ANSWERED" => "ACCEPTED",
];

$type = [
    "ivr-main" => "INCOMING",
    "call-out" => "OUTGOING",
    "LOCAL" => "LOCAL",
];

$calls = R::find('cdr', 'calldate > :date_from AND calldate < :date_till', [':date_from' => $date_from, ':date_till' => $date_till]);;

foreach ($calls as $call){
	
    $arResult["calls"][] = [
        "id" => $call->uniqueid, // (string) – ID звонка
        "type" => $type[$call->dcontext], // (string) – тип звонка, один из INCOMING, OUTGOING, LOCAL – входящий, исходящий или внутренний.
        "date" => strtotime($call->calldate), // (integer) – дата (и время) звонка, в виде UNIX timestamp.
        "duration_answer" => $call->duration - $call->billsec, // (float) – время до снятия трубки, сек
        "status" => $status[$call->disposition], // (string) – статус звонка – успешный или несостоявшийся  – ACCEPTED, REJECTED
        "phone_number_client" => $call->dst, // (string) – номер клиента, например +79250001122
        "phone_number_operator" => $call->src, //(string) – номер оператора (короткий номер, для идентификации), например: 402
    ];
}

echo json_encode($arResult);

$content = file_get_contents($file);
$content .= "\n".json_encode($arResult)."\n";
$content .= "\n";
file_put_contents($_SERVER['DOCUMENT_ROOT'].'/calls/log.txt', $content);

R::close();
?>