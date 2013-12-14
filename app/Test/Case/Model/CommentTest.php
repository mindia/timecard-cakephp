<?php
App::uses('Comment', 'Model');
class CommentTest extends CakeTestCase {
    //public $fixtures = array('app.project');

    public function setUp() {
        parent::setUp();
        $this->Comment = ClassRegistry::init('Comment');
    }

    public function test登録時のバリデーション()
    {
    	$data['Comment']['body'] = '';
       $this->Comment->set($data);
       $res = $this->Comment->validates();
       $this->assertFalse($res);
       unset($data);
       
       $data['Comment']['body'] = 'test_comment';
       $this->Comment->set($data);
       $res = $this->Comment->validates();
       $this->assertTrue($res);
       unset($data);
    }
}