<?php
$is_heroku = 0;
if($is_heroku){
  Configure::write('is_heroku', 1);
}else{
  Configure::write('is_heroku', 0);
  class DATABASE_CONFIG {
    public $default = array(
      'datasource' => 'Database/Mysql',
      'persistent' => false,
      'host' => 'localhost',
      'login' => 'root',
      'password' => '',
      'database' => 'timecard_dev',
      'prefix' => '',
      //'encoding' => 'utf8',
    );

    public $test = array(
      'datasource' => 'Database/Mysql',
      'persistent' => false,
      'host' => 'localhost',
      'login' => 'root',
      'password' => '',
      'database' => 'timecard_test',
      'prefix' => '',
      //'encoding' => 'utf8',
    );
  }
}
