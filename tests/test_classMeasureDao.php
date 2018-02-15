<?php
include('../classes/domain/Measure.php');
include('../classes/dao/MeasureDao.php');

$config = include('../inc/config.inc.php');

$measureDao = new MeasureDao($config);
$measure1 = new Measure('1879-03-14 00:00:00', 1, 1);

//$measureDao->createMeasure($measure1);
//var_dump($measureDao->readAllMeasure());
//var_dump($measureDao->readMeasureById(3));
//$measureDao->deleteMeasure(1);

/*$measure1->temperature = 46;
$measure1->humidite = 46;

var_dump($measure1);

$measureDao->updateMeasure($measure1, 7);*/