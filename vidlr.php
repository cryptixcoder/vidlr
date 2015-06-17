<?php

class Jobs{
	protected $redis;

	function __construct($configs = array()){
		$this->redis = new Predis\Client($configs);
	}

	function create_job($queue, $description, $args){
		$j = array(
			"description" => $description,
			"args" => $args
		);

		$this->redis->rpush($queue, json_encode($j));
	}
}