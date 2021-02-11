<?php
if (isset($_POST)) {
	$city = $_POST['city'];
	$apikey = '720ce66b79b33d7d0c42614285e12a6f';
	$wheatherApi = "http://api.openweathermap.org/data/2.5/weather?id=".$city."&lang=en&units=metric&APPID=".$apikey;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $wheatherApi);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	print_r($data);
}

?>