<?php
App::uses('AppHelper', 'View/Helper');
class DashboardHelper extends AppHelper
{
	//todo もっとスマートにできないものか。。。
	public function getThisWeekDays()
	{
		$beginning_week_date = $this->getBeginningWeekDate(date('Y-m-d'));
		return array_map(
			function($val) use($beginning_week_date)
			{
				if($val === 0) return $beginning_week_date;
				return date('Y-m-d', strtotime($beginning_week_date) + 86400*$val) ;
			},
			[0,1,2,3,4,5,6]
		);
	}

	public function getBeginningWeekDate($ymd) {
		$w = date("w",strtotime($ymd)) - 1;
		$beginning_week_date = date('Y-m-d', strtotime("-{$w} day", strtotime($ymd)));
		return $beginning_week_date;
	}
}