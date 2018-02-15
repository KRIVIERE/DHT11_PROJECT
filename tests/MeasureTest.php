<?php

include '../inc/autoload.inc.php';

use domain\Measure;

use PHPUnit\Framework\TestCase;

class MeasureTest extends TestCase
{
    public function testMeasure() {
        $measure1 = new Measure('1879-03-14 00:00:01',20,20);

        $this->assertEquals('1879-03-14 00:00:01', $measure1->datetime);
        $this->assertEquals(20, $measure1->temperature);
        $this->assertEquals(20, $measure1->humidite);
    }
}
