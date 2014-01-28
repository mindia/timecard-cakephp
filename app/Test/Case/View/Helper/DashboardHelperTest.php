<?php
App::uses('DashboardHelper', 'View/Helper');
App::uses('View', 'View');

class DashboardHelperTest extends CakeTestCase {
    public $View;
    public $Dashboard;

    public function setUp() {
      parent::setUp();
      $controller = null;
      $this->View = new View($controller);
      $this->Dashboard = new DashboardHelper($this->View);
    }

    public function testGetThisWeekDays()
    {
      $w = date("w",time())-1;
      $beginning_week_date = date('Y-m-d', strtotime("-{$w} day", time()));
      $res = $this->Dashboard->getThisWeekDays();
      $this->assertSame(7, count($res));
      $this->assertSame($beginning_week_date, $res[0]);
    }

    public function testGetBeginningWeekDate()
    {
      $date = '2014-01-01';
      $expected = '2013-12-30';
      $res = $this->Dashboard->getBeginningWeekDate($date);
      $this->assertSame($expected, $res);

      $date = '2014-03-01';
      $expected = '2014-02-24';
      $res = $this->Dashboard->getBeginningWeekDate($date);
      $this->assertSame($expected, $res);
    }
}