<?php

include "vidlr.php";

$vidlr = new Vidlr();

$vidlr->create_job("videoconversion", "THis is converting a video", array(
	"input" => "",
	"input_filename" => "",
	"output_filename" => ""
));