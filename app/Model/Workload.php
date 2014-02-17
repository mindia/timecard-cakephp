<?php
class Workload extends AppModel {
	public $belongsTo = [
		'Issue' => [
			'className' => 'Issue'
		],
		'User' => [
			'className' => 'User'
		]
	];

	public $validate = [
		'start_at' => [
			'required' => [
		              'rule' => ['notEmpty'],
		              'message' => 'start_at is required'
		       ],
		]
	];

	public function beforeSave($options = [])
	{
		if(is_null($this->data[$this->alias]['id'])){
			$this->data[$this->alias]['created_at'] = $this->data[$this->alias]['updated_at'] 
	    		= date('Y-m-d H:i:s');
	    	}else{
	    		$this->data[$this->alias]['updated_at'] = date('Y-m-d H:i:s');
	    	}
	}
	
	public function isRunning($user_id=null)
	{
		if(is_null($user_id)){
			$count = $this->find('count', ['conditions'=>['NOT'=>['start_at'=>null], 'end_at'=>null] ]);
		}else{
			$count = $this->find('count', ['conditions'=>['NOT'=>['start_at'=>null], 'end_at'=>null, 'user_id'=>$user_id] ]);
		}

		if((int)$count === 0) return false;

		return true;
	}

	public function isRunningLists($user_id=null)
	{
		if(is_null($user_id)) return $this->find('all', ['conditions'=>['NOT'=>['start_at'=>null], 'end_at'=>null] ]);
			
		return $this->find('all', ['conditions'=>['NOT'=>['start_at'=>null], 'end_at'=>null, 'user_id'=>$user_id] ]);
	}

	public function addProgressTime(array $workloads)
	{
		foreach($workloads as $key=>$workload){
			if(isset($workload['Workload']['start_at']))
			{
				$workload['Workload']['start_at_time'] = strtotime($workload['Workload']['start_at']);
			}else{
				$workload['Workload']['start_at_time'] = null;
			}

			if(isset($workload['Workload']['end_at']))
			{
				$workload['Workload']['end_at_time'] = strtotime($workload['Workload']['end_at']);
			}else{
				$workload['Workload']['end_at_time'] = null;
			}

			if( !is_null($workload['Workload']['end_at_time']) && !is_null($workload['Workload']['start_at_time']))
			{
				$workload['Workload']['progress_time'] = $this->oClock( 
					($workload['Workload']['end_at_time']-$workload['Workload']['start_at_time']));
			}else{
				$workload['Workload']['progress_time'] = null;
			}

			$workloads[$key]['Workload'] = $workload['Workload'];
		}

		return $workloads;
	}

	public function oClock ($s)
	{
		$h = 0;
		$m = 0;
		while ($s >= 60) {
			if ($s >= 3600) { 
				$s -= 3600;
				$h++;
			} else {
				$s -= 60;
				$m++;
			}
		}
		return "{$h}:{$m}:{$s}";
	}
}
