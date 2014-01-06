<?php
App::uses('Member', 'Model');

class MemberTest extends CakeTestCase {
    public $fixtures = array('app.member', 'app.user', 'app.project', );

    public function setUp() {
        parent::setUp();
        $this->Member = ClassRegistry::init('Member');
    }

    public function testIsAdmin()
    {
    	$user_id = 1;
    	$project_id = 1;
    	$res = $this->Member->isAdmin($user_id, $project_id);
    	$this->assertTrue($res);

    	$project_id = 2;
    	$res = $this->Member->isAdmin($user_id, $project_id);
    	$this->assertFalse($res);

    	$user_id = 2222;
    	$project_id = 2222;
    	$res = $this->Member->isAdmin($user_id, $project_id);
    	$this->assertFalse($res);
    }
}