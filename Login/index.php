<?php

$login = $_GET["login"];
$password = $_GET["password"];

session_start();
if ($login=="SpeechNT" && $password=="332666225") {
	if(!isset($_SESSION['cuccess']))
		$_SESSION['cuccess'] = "Y";
	
	echo json_encode([]); 
}
?>