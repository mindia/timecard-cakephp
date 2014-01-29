<?php
class WorkloadsController extends AppController {
	public $uses = ['Project', 'Member', 'User', 'Issue', 'Comment', 'Workload'];
  	public function beforeFilter()
	{
		parent::beforeFilter();
	}

	public function index()
	{
		$workload = null;
		if($this->request->params['user_id'])
		{
			if($this->request->params['day'])
			{
				$current_user_id = $this->Session->read('current_user')['User']['id'];
				$begin_date = date('Y-m-d H:i:s', strtotime($this->request->params['year'].'-'.$this->request->params['month'].'-'.$this->request->params['day'].' 00:00:00'));
				$end_date = date('Y-m-d H:i:s', strtotime($this->request->params['year'].'-'.$this->request->params['month'].'-'.$this->request->params['day'].' 23:59:59'));
				$conditions = ['start_at >=' => $begin_date, 'start_at <=' => $end_date, 'NOT'=>['end_at'=>null], 'user_id'=>$current_user_id];
				$workload = $this->Workload->find('all', ['conditions'=>$conditions,'recursive'=>-1,]);
				$workload = $this->Issue->getIssueByWorkload($workload);
			}else{
				$conditions = ['NOT'=>['end_at'=>null], 'user_id'=>$current_user_id];
				$workload = $this->Workload->find('all', ['conditions'=>$conditions,'recursive'=>-1,]);
				$workload = $this->Issue->getIssueByWorkload($workload);
			}
		}

		$this->viewClass = 'Json';
		$this->set(compact('workload'));
		$this->set('_serialize', 'workload');
	}

	public function start()
	{
		$current_user_id = $this->Session->read('current_user')['User']['id'];
		if($this->Workload->isRunning($current_user_id)>0)
		{
			$working_issue = $this->Workload->find('all', [
				'conditions'=>['NOT'=>['start_at'=>null], 'end_at'=>null, 'user_id'=>$current_user_id]]);
			$update_workload = array_map(
				function($val)
				{
					if( !is_null($val['Workload']['start_at']) && is_null($val['Workload']['end_at']) )
					{
						return ['id' => $val['Workload']['id'], 'end_at'=>gmdate("Y-m-d H:i:s", time()+9*60*60)];
					}
				},
				$working_issue
			);
			$this->Workload->saveMany($update_workload);
		}

		$issue = $this->Issue->find('first',['conditions'=>['Issue.id'=>$this->request->params['id']]]);
		$data = ['Workload'=>['issue_id'=>$issue['Issue']['id'], 'user_id'=>$current_user_id, 'start_at'=>gmdate("Y-m-d H:i:s", time()+9*60*60)] ];

		$this->Workload->create();
		if($this->Workload->save($data['Workload']))
		{
			$this->Session->setFlash(__('Workload was successfully started.'));
		}else{
			$this->Session->setFlash(__('Workload could not started.'));
		}

		$this->redirect('/projects/'.$issue['Project']['id']);
	}

	public function stop()
	{
		$issue = $this->Issue->find('first',['conditions'=>['Issue.id'=>$this->request->params['id']]]);

		foreach($issue['Workload'] as $key=>$val)
		{
			if( !is_null($val['start_at']) && is_null($val['end_at']) )
			{
				$update_workload[] = ['id' => $val['id'], 'end_at'=>gmdate("Y-m-d H:i:s", time()+9*60*60)];
			}
		}

		if($this->Workload->saveMany($update_workload))
		{
			$this->Session->setFlash(__('Workload was successfully stoped.'));
		}else{
			$this->Session->setFlash(__('Workload could not stoped.'));
		}

		$this->redirect('/projects/'.$issue['Project']['id']);
	}
}