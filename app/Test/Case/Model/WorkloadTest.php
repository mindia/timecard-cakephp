<?php
App::uses('Workload', 'Model');
class WorkloadTest extends CakeTestCase {
    //public $fixtures = array('app.project');

    public function setUp() {
        parent::setUp();
        $this->Workload = ClassRegistry::init('Workload');
    }

    public function test登録時のバリデーション()
    {
    	$data['Workload']['start_at'] = '';
       $this->Workload->set($data);
       $res = $this->Workload->validates();
       $this->assertFalse($res);
       unset($data);

       $data['Workload']['start_at'] = null;
       $this->Workload->set($data);
       $res = $this->Workload->validates();
       $this->assertFalse($res);
       unset($data);
    }
}