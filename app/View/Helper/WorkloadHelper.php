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
}