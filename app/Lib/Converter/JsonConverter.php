<?php
/**
 * Jsonを吐き出すためのclass
 *
 * @package app.Lib
 */
class JsonConverter {
	const HEADER_CONTET_TYPE = 'application/json'; //Content-type: 
	
	public static function outputJson(array $outputData){
		header('Content-type: '. self::HEADER_CONTET_TYPE);
		echo json_encode($outputData);
		exit;
	}
}
