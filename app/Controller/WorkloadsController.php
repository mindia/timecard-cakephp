<?php
class WorkloadsController extends AppController {
	public $uses = ['Project', 'Member', 'User', 'Issue', 'Comment', 'Workload'];
  	public function beforeFilter()
	{
		parent::beforeFilter();
	}

	public function start()
	{
		$current_user_id = $this->Session->read('current_user')['User']['id'];
		if($this->Workload->isRunning($current_user_id)>0)
		{
			$working_issue = $this->Workload->find('all', [
				'conditions'=>['NOT'=>['start_at'=>null], 'end_at'=>null, 'user_id'=>$current_user_id]]);
			pr($working_issue);
			die();
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
		
	}
}