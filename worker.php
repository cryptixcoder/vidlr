<?php

class Worker{
	protected $redis;

	function __construct($configs = array()){
		$this->redis = new Predis\Client($configs);
	}

	function process($queue){
		while(true){
			list($queue, $job) = $this->redis->brpop($queue, 0);
			
			if($job){
				$job = json_decode($job, true);

				log("Worker running job: ".$job['description']);

				$input = $job['args']['input'];

				$contents =	file_get_contents($input);

				file_put_contents($job['args']['input_filename'], $contents);

				if(file_exists($job['args']['input_filename'])){
					$ffmpeg_cmd = "ffmpeg -i %s %s";

					$args = array(
						$job['args']['input_filename'],
						$job['args']['output_filename']
					);

					shell_exec(sprintf($ffmpeg_cmd, $args));

					if(file_exists($job['args']['output_filename'])){
						//Conversion completed
						echo "DONE";
					}
					else{
						//Conversion didn't happen place job back in queue
					}
				}
			}

			sleep(2);
		}
	}
}