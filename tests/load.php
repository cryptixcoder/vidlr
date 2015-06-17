<?php

	require_once "vendor/autoload.php";
	
	$redis = new Predis\Client([
		 'scheme' => 'tcp',
	    'host'   => '127.0.0.1',
	    'port'   => 6379
	]);
	
	$redis->rpush("jobs","test.mov");



