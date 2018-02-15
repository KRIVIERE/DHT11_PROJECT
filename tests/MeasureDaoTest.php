<?php
/*include '../classes/dao/DaoBase.php';
include '../classes/domain/Measure.php';
include '../classes/dao/MeasureDao.php';*/

include '../inc/autoload.inc.php';

use dao\MeasureDao;
use domain\Measure;

use PHPUnit\Framework\TestCase;

class MeasureDaoTest extends TestCase
{
    private $measureDao;

    protected function setUp() {
        parent::setUp();

        $config = include '../inc/config.inc.php';

        $this->measureDao = new MeasureDao($config);
    }

    protected function tearDown() {
        $this->measureDao->close();

        $this->measureDao = null;

        parent::tearDown();
    }

    public function testCreateMeasure()
    {
        $measure1 = new Measure('1879-03-14 00:00:00', 20, 25);

        $id = $this->measureDao->createMeasure($measure1);

        $newMeasure = $this->measureDao->readMeasureById($id);

        $this->assertEquals(24, $newMeasure->id);
        $this->assertEquals('1879-03-14 00:00:00', $newMeasure->datetime);
        $this->assertEquals(20, $newMeasure->temperature);
        $this->assertEquals(25, $newMeasure->humidite);

        //$this->measureDao->deleteMeasure($id);
    }

    /*public function testReadAllMeasure()
    {

    }

    /*public function testReadMeasureById()
    {

    }

    public function testUpdateMeasure()
    {

    }

    public function testDeleteMeasure()
    {

    }*/
}
