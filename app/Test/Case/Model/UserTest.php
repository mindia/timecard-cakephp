<?php
App::uses('User', 'Model');

class UserTest extends CakeTestCase {
    public $fixtures = array('app.user');

    public function setUp() {
        parent::setUp();
        $this->User = ClassRegistry::init('User');
    }

    public function testサインアップ時のバリデーション()
    {
       $data['User']['email'] = '';
       $this->User->set($data);
       $res = $this->User->validates();
       $this->assertFalse($res);
       unset($data);
       
       $data['User']['email'] = 'test1@timecard-cakephp.com';
       $this->User->set($data);
       $res = $this->User->validates();
       $this->assertFalse($res);
       unset($data);

       $data['User']['email'] = 'test1@timecard-cakephp';
       $this->User->set($data);
       $res = $this->User->validates();
       $this->assertFalse($res);
       unset($data);

       $data['User']['name'] = '';
       $this->User->set($data);
       $res = $this->User->validates();
       $this->assertFalse($res);
       unset($data);

       $data['User']['encrypted_password'] = '';
       $this->User->set($data);
       $res = $this->User->validates();
       $this->assertFalse($res);
       unset($data);

       $data['User']['password_confirmation'] = '';
       $this->User->set($data);
       $res = $this->User->validates();
       $this->assertFalse($res);
       unset($data);

       $data['User']['email'] = 'aa@hoge.com';
       $data['User']['name'] = 'hoge';
       $data['User']['encrypted_password'] = 'aaaa';
       $data['User']['password_confirmation'] = 'aaaa';
       $this->User->set($data);
       $res = $this->User->validates();
       $this->assertFalse($res);
       unset($data);

       $data['User']['email'] = 'aa@hoge.com';
       $data['User']['name'] = 'hoge';
       $data['User']['encrypted_password'] = 'hogehoge123';
       $data['User']['password_confirmation'] = 'aaaa';
       $this->User->set($data);
       $res = $this->User->validates();
       $this->assertFalse($res);
       unset($data);

       $data['User']['email'] = 'aa@hoge.com';
       $data['User']['name'] = 'hoge';
       $data['User']['encrypted_password'] = 'hogehoge123';
       $data['User']['password_confirmation'] = 'hogehoge123';
       $this->User->set($data);
       $res = $this->User->validates();
       $this->assertTrue($res);
       unset($data);
    }

    public function testHashedPassword()
    {
    	$passwordHasher = new SimplePasswordHasher();
    	$data['User']['encrypted_password'] = 'hogehoge123';
    	$this->User->set($data);
    	$this->User->beforeSave();
    	$this->assertNotSame($this->User->data['User']['encrypted_password'], 'hogehoge123');
    	$this->assertSame($this->User->data['User']['encrypted_password'], $passwordHasher->hash('hogehoge123'));
    	unset($data);
    }
}
