<?php

class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testCallWithoutActionShouldPullFromIndexAction()
    {
        $this->dispatch('/index');
        $this->assertController('index');
        $this->assertAction('index');
    }

    // Sanity check test.
    // This basically says "if i get the index, do i get the basic stuff?"
    // This sort of high level testing prevents stupid bugs getting through for
    // a very low amount of effort.
    public function testIndexActionHasExpectedData()
    {
        $this->dispatch('/index');
        $this->assertQueryContentContains('h1', 'My Albums');

        // At this point, i'd like to do a count of items.
        // However, we're not using a seperate test db with controlled seeds.
        // $this->assertQueryCount('table tr', 6);
    }
}

