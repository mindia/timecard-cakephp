<?php
App::uses('Member', 'Model');

class MemberTest extends CakeTestCase {
    //public $fixtures = array('app.project');

    public function setUp() {
        parent::setUp();
        $this->Member = ClassRegistry::init('Member');
    }
}