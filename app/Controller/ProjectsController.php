<?php
class ProjectsController extends AppController {
  var $scaffold;
  public function index() {
    $projects = $this->Project->find("all");
    $this->set("projects", $projects);
  }
}
