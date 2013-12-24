<?php
App::uses('Project', 'Model');

class ProjectTest extends CakeTestCase {
    public $fixtures = array('app.project');

    public function setUp() {
        parent::setUp();
        $this->Project = ClassRegistry::init('Project');
    }

    public function test登録時のバリデーション()
    {
    	$data['Project']['name'] = '';
       $this->Project->set($data);
       $res = $this->Project->validates();
       $this->assertFalse($res);
       unset($data);
       
       $data['Project']['name'] = 'test_project';
       $this->Project->set($data);
       $res = $this->Project->validates();
       $this->assertTrue($res);
       unset($data);
    }
}