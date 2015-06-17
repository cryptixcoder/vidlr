<?php

	require_once "vendor/autoload.php";
	$redis = new Predis\Client([
		 'scheme' => 'tcp',
	    'host'   => '127.0.0.1',
	    'port'   => 6379
	]);
	

	
	// class Converter{
	// 	protected $data;

	// 	function __construct($args){
	// 		$data = $args;
	// 	}

	// 	function handle(){
	// 		echo "<p>Input File:".$this->data['input']."</p>";
	// 		echo "<p>Output File:".$this->data['output']."</p>";
	// 		echo "<p>Callback File:".$this->data['callback']."</p>";
	// 	}
	// }

	// while(true){
	// 	$j = $redis->blpop("jobs", 10);
		
	// 	if($j){

	// 		$job = json_decode($j, true);

	// 		echo $j;
	// 	}
		
	// }
	// 
	// 
	// 
	list($queue, $message) =  $redis->brpop("jobs", 0);
		$res = shell_exec("ffmpeg -i ".$message." output".time().".avi");
	
	while(1){
		list($queue, $message) =  $redis->brpop("jobs", 0);
		$res = shell_exec("ffmpeg -i ".$message." output".time().".avi");
		//file_put_contents('logs.txt', $res.PHP_EOL , FILE_APPEND);
	}


