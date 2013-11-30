<?php
class ProjectsController extends AppController {
  	var $scaffold;
  	public function beforeFilter()
	{
		parent::beforeFilter();
	}
	public function index() {
		$projects = $this->Project->find("all");
		$this->set("projects", $projects);
	}
}
