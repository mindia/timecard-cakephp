<?php
App::uses('AppHelper', 'View/Helper');
class WorkloadHelper extends AppHelper
{

	public function isWorkInProgress($issue)
	{
		if(count($issue['Workload']) == 0) return false;

		foreach ($issue['Workload'] as $key => $value) {
			if( !is_null($value['end_at']) ) continue;
			if( (int)$value['issue_id'] === (int)$issue['Issue']['id'])
			{
				return true;
			}
		}
		return false;
	}

	public function progressTime($start_at, $end_at)
	{
		if(is_null($start_at) || is_null($end_at)) return "";
		$start_at_time = strtotime($start_at);
		$end_at_time = strtotime($end_at);
		$s = $end_at_time - $start_at_time;
		if($s<0) return "";

		$h=0;
		$m=0;
		while($s>=3600)
		{
			$s-=3600;
			$h++;
		}
		while($s>=60){
			$s-=60;
			$m++;
		}
		return "{$h} hour {$m} min {$s} sec";
	}
}