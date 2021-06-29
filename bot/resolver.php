<?php

	function url_resolver($update){
	
		$url_arr= array(
			'856661113' => 'http://localhost/fichajes/public/index.php/api',
			'323709506' => 'http://localhost/fichajes/public/index.php/api',
			'896005980' => '',

		);

		#return $url_arr[$update['message']['chat']['id']];
		return 'http://172.30.111.104/fichajes/public/index.php/api';
		
	}

?>
