<?php
App::uses('DashboardHelper', 'View/Helper');

class DashboardsController extends AppController {
	public $uses = ['Project', 'Member', 'User', 'Issue', 'Comment', 'Workload'];
	public $helpers = ['DashBoard'];
	public $Dashboard;
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Dashboard = new DashboardHelper(new View());
	}

	public function show()
	{
		$beginning_week_date = $this->Dashboard->getBeginningWeekDate(date('Y-m-d'));
		$current_user_id = $this->Session->read('current_user')['User']['id']; 
		$workload = $this->Workload->find('all', [
			'recursive'=>-1,
			'conditions'=>[
				'Workload.start_at BETWEEN ? AND ?'=> 	[
				$beginning_week_date.' 00:00:00'
				, date('Y-m-d 23:59:59')],
				'NOT'=>['Workload.end_at'=>null], 
				'Workload.user_id'=>$current_user_id],  
			]); 
		$this->set('workload', $this->Issue->getIssueByWorkload($workload));
		$this->set('current_user_id', $current_user_id);
		$this->set('current_user_name', $this->Session->read('current_user')['User']['name']);
	}
}