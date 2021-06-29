<?php
openlog("bot_dispacher", LOG_PID | LOG_PERROR, LOG_LOCAL0);
require './resolver.php';
$TOKEN = "1225680732:AAF7yJh3oAfYitiQqZHplJael1sPgivLXXg";
$URL = "https://api.telegram.org/bot$TOKEN"; 
$chatId = '856661113';
$message = 'test';
			#syslog(LOG_INFO, "message forwarded: $message");
		$response = file_get_contents($URL."/sendmessage?chat_id=".$chatId."&text=$message");
		echo $response;	
		$response_arr = json_decode($response,TRUE);
		print_r($response_arr);
		echo $response_arr['']['']
?>
