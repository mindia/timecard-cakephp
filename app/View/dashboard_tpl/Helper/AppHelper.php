<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AppHelper extends Helper {

	public function is_admin($user, $project_member)
	{
		foreach($project_member as $member)
		{
			if((int)$user['id'] === (int)$member['user_id'])
			{
				return ((int)$member['is_admin'] === 1);
			}
		}
		return false;
	}

	public function is_member($user, $project_member)
	{
		foreach($project_member as $member)
		{
			if((int)$user['id'] === (int)$member['user_id'])
			{
				return true;
			}
		}
		return false;
	}

	public function timeAgo($time)
	{
		$time = (!is_int($time)) ? strtotime($time) : $time;
 
		$now = time();
		
		$remainder = $now - $time;
		
		if($remainder < 60) {
			return $remainder . ' seconds ago';
		} else if($remainder < 3600) {
			$number = ceil($remainder / 60);
			$suffix = ($number > 1) ? 's' : '';
			return $number . ' minute' . $suffix . ' ago';
		} else if($remainder < 86400) {
			$number = floor($remainder / 3600);
			$suffix = ($number > 1) ? 's' : '';
			return $number . ' hour' . $suffix . ' ago';
		} else {
			$number = floor($remainder / 86400);
			$suffix = ($number > 1) ? 's' : '';
			return $number . ' day' . $suffix . ' ago';
		}
	}

	public function convertTimeToHms($seconds) {
		$hours = floor($seconds / 3600);
		$minutes = floor(($seconds / 60) % 60);
		$seconds = $seconds % 60;
		$hms = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
		return $hms;
	}
}
