<?php
App::uses('Issue', 'Model');
class IssueTest extends CakeTestCase {
    //public $fixtures = array('app.project');

    public function setUp() {
        parent::setUp();
        $this->Issue = ClassRegistry::init('Issue');
    }

    public function test登録時のバリデーション()
    {
    	$data['Issue']['subject'] = '';
       $this->Issue->set($data);
       $res = $this->Issue->validates();
       $this->assertFalse($res);
       unset($data);
       
       $data['Issue']['subject'] = 'test_Issue';
       $this->Issue->set($data);
       $res = $this->Issue->validates();
       $this->assertTrue($res);
       unset($data);
    }
}