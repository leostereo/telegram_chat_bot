<?php
openlog("bot_dispacher", LOG_PID | LOG_PERROR, LOG_LOCAL0);
require './resolver.php';
$TOKEN = "1225680732:AAF7yJh3oAfYitiQqZHplJael1sPgivLXXg";
$URL = "https://api.telegram.org/bot$TOKEN"; 

	$update = json_decode(file_get_contents("php://input"), TRUE);
	$update_str = json_encode($update);
	$chatId = $update["message"]["chat"]["id"];
	#syslog(LOG_INFO, "message recibed from $chatId data: $update_str");

		if($url=url_resolver($update)){

			$data_string=json_encode($update);
			syslog(LOG_INFO, "message forwarded to $url");

			$ch = curl_init($url);                                                                      
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($data_string))
			);

			$message = curl_exec($ch);
			#$message = [["boton:"]] ;
			syslog(LOG_INFO, "message forwarded: $message");

			$response = file_get_contents($URL."/sendmessage?chat_id=".$chatId."&text=$message");
			$response_arr = json_decode($response,TRUE);
			#print_r($response_arr);

			if(!$response_arr['ok']){
				file_get_contents($URL."/sendmessage?chat_id=".$chatId."&text=algo malio sal");
				#$response_str = json_encode($response_arr);
				syslog(LOG_INFO, "response: $response");
			}

		}else{
			syslog(LOG_ERR,'chat id not founded');
			file_get_contents($URL."/sendmessage?chat_id=".$chatId."&text=please register your chat id");
		}

?>
