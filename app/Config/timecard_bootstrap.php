<?php

App::import('Vendor', '/Spyc/Spyc');

if(file_exists(dirname(__FILE__) . DS . 'omniauth.yml')){
	$var = Spyc::YAMLLoad(dirname(__FILE__) . DS . 'omniauth.yml');

	$auth = $var['auth'];
	foreach ($auth as $key => $value) {
		Configure::write('Opauth.Strategy.' . $key, array(
				'client_id' => $value["key"],
				'client_secret' => $value["secret"]
				));
	}
}

App::build([
	'Lib' => [
		APP . 'Lib' . DS . 'Converter' . DS,
	],
],App::APPEND);