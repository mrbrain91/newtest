<?php
ob_start();
session_start();

date_default_timezone_set('Asia/Tashkent');

define('MYSQL_SERVER', 'localhost');

define('MYSQL_USER', 'root');

define('MYSQL_PASSWORD', 'root');

define('MYSQL_DB', 'orto_db');

define('API_KEY', $api);

date_default_timezone_set('Asia/Tashkent');


function db_connect(){

	$connect = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB)

		or die("Er1ror: ".mysqli_error($connect));

	if(!mysqli_set_charset($connect, "utf8mb4")){

		print("Error: ".mysqli_error($connect));

	}

	return $connect;
}

$connect = db_connect();


//libsiz botni yozish funktsiyasi

function bot($method, $data = []){

	$url = "https://api.telegram.org/bot".API_KEY."/".$method;

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	$res = curl_exec($ch);

	if (curl_error($ch)) {

		var_dump(curl_error($ch));

	}

	else {

		return json_decode($res);

	}

}


?>