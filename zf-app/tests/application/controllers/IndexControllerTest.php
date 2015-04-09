<?php

class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');

        // FIXME do database setup
        // $this->setupDatabase();

        parent::setUp();
    }

    public function setupDatabase()
    {
        // FIXME
        // http://framework.zend.com/manual/1.12/en/zend.test.phpunit.db.html

        $db = Zend_Db::factory('Pdo_Mysql', array(
            'host'     => 'localhost',
            'username' => 'root',
            'password' => 'password',
            'dbname'   => 'app_db_test'
        ));
        $connection = new Zend_Test_PHPUnit_Db_Connection($db, 'albums');
        $databaseTester = new Zend_Test_PHPUnit_Db_SimpleTester($connection);
        $databaseFixture =
                    new PHPUnit_Extensions_Database_DataSet_FlatXmlDataSet(
                        dirname(__FILE__) . '/_files/albumsSeeds.xml'
                    );

        $databaseTester->setupDatabase($databaseFixture);
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

        // At this point, i'd like to do a basic listing count of items.
        // However, we're not using a seperate test db with controlled seeds.
        // $this->assertQueryCount('table tr', 6);
    }


    public function testAddActionAdds()
    {
      // meh, not much point in doing these without db connection or mocks...
      // another time perhaps
    }

    public function testEditActionEdits()
    {

    }

    public function testDeleteActionDeletes()
    {

    }


}

