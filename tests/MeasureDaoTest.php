<?php
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
        $measure = new Measure('1879-03-14 00:00:00', 20, 25);

        $id = $this->measureDao->createMeasure($measure);

        $newMeasure = $this->measureDao->readMeasureById($id);

        $this->assertEquals('1879-03-14 00:00:00', $newMeasure->datetime);
        $this->assertEquals(20, $newMeasure->temperature);
        $this->assertEquals(25, $newMeasure->humidite);

        $this->measureDao->deleteMeasure($id);
    }

    public function testReadAllMeasure()
    {
        $measures = $this->measureDao->readAllMeasure();

        $this->assertEquals(4, count($measures));

        $this->assertEquals("1879-03-14 00:00:00", $measures[0]->datetime);
        $this->assertEquals(20, $measures[0]->temperature);
        $this->assertEquals(25, $measures[0]->humidite);

        $this->assertEquals("1879-03-14 00:00:00", $measures[1]->datetime);
        $this->assertEquals(20, $measures[1]->temperature);
        $this->assertEquals(25, $measures[1]->humidite);
    }

    public function testReadMeasureById()
    {
        $measure = $this->measureDao->readMeasureById(2);

        $this->assertEquals('1879-03-14 00:00:00', $measure->datetime);
        $this->assertEquals(23, $measure->temperature);
        $this->assertEquals(23, $measure->humidite);
    }

    public function testUpdateMeasure()
    {
        $measure = new Measure('1879-03-14 00:00:00', 23, 23);

        $id = $this->measureDao->createMeasure($measure);

        $newMeasure = $this->measureDao->readMeasureById($id);

        $newMeasure->datetime = '1879-03-14 10:00:00';
        $newMeasure->temperature = 20;
        $newMeasure->humidite = 25;

        $this->measureDao->updateMeasure($newMeasure, $id);

        $updatedMeasure = $this->measureDao->readMeasureById($id);

        $this->assertEquals('1879-03-14 10:00:00', $updatedMeasure->datetime);
        $this->assertEquals(20, $updatedMeasure->temperature);
        $this->assertEquals(25, $updatedMeasure->humidite);

        $this->measureDao->deleteMeasure($id);
    }

    public function testDeleteMeasure()
    {
        $measure = new Measure('1879-03-14 00:00:00', 23, 23);

        $id = $this->measureDao->createMeasure($measure);

        $newMeasure = $this->measureDao->readMeasureById($id);

        $this->assertNotNull($newMeasure);

        $this->measureDao->deleteMeasure($id);

        $deletedUser = $this->measureDao->readMeasureById($id);

        $this->assertNull($deletedUser);
    }
}