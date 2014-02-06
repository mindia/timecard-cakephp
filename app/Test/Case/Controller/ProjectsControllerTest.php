<?php
App::uses('ProjectsController', 'Controller');

/**
 * ProjectsController Test Case
 *
 */
class ProjectsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.project',
		'app.member',
		'app.user',
		'app.issue',
		'app.comment',
		'app.workload',
		'app.authentication',
		'app.provider'
	);

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
	}

/**
 * testShow method
 *
 * @return void
 */
	public function testShow() {
	}

/**
 * testRegistration method
 *
 * @return void
 */
	public function testRegistration() {
	}

/**
 * testCreate method
 *
 * @return void
 */
	public function testCreate() {
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
		$this->testAction('/projects/1/edit');

		$this->assertEquals('mindia/timecard-cakephp', $this->vars['github_full_name']);
		$this->assertEquals('timecard-cakephp', $this->vars['ruffnote_full_name']);
		$this->assertEquals('project_parent_1', $this->vars['project']['Project']['name']);

	}
/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit_project_id_5() {
		$this->testAction('/projects/5/edit');

		$this->assertEquals('github_provider_id_2', $this->vars['github_full_name']);
		$this->assertEquals('ruffnote_provider_id_2', $this->vars['ruffnote_full_name']);
		$this->assertEquals('project_parent_5', $this->vars['project']['Project']['name']);

	}

/**
 * testUpdate method
 *
 * @return void
 */
	public function testUpdate() {
		$data = [
			'Project' => [
				'id' => '1',
				'name' => 'project',
				'description' => 'description',
				'github_full_name' => 'minda/timecard-cakephp',
				'ruffnote_full_name' => 'ruffnote',
				'is_public' => true
			]
		];
		$result =  $this->testAction('/projects/update', ['data' => $data, 
							'method' => 'post',
							'return' => 'vars' ]);
		$this->assertContains('/projects/1/edit', $this->headers['Location']);
		$flash = CakeSession::read('Message.flash');
		$this->assertEquals('The project has been saved', $flash['message']);
		debug($flash);
	}

}
