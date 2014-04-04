<?php
App::uses('WorkloadHelper', 'View/Helper');
App::uses('View', 'View');

class WorkloadHelperTest extends CakeTestCase {
    public $View;
    public $Workload;

    public function setUp() {
      parent::setUp();
      $controller = null;
      $this->View = new View($controller);
      $this->Workload = new WorkloadHelper($this->View);
    }

    public function testProgressTime()
    {
      $start_at = "2014-02-01 00:00:00";
      $end_at = "2014-02-01 02:18:40";
      $exp = '2 hour 18 min 40 sec';
      $res = $this->Workload->progressTime($start_at, $end_at);
      $this->assertSame($exp, $res);

      $start_at = "2014-02-01 00:00:00";
      $end_at = null;
      $exp = '';
      $res = $this->Workload->progressTime($start_at, $end_at);
      $this->assertSame($exp, $res);

      $start_at = null;
      $end_at = "2014-02-01 02:18:40";
      $exp = '';
      $res = $this->Workload->progressTime($start_at, $end_at);
      $this->assertSame($exp, $res);

      $start_at = "2014-02-02 00:00:00";
      $end_at = "2014-02-01 02:18:40";
      $exp = '';
      $res = $this->Workload->progressTime($start_at, $end_at);
      $this->assertSame($exp, $res);
    }
}