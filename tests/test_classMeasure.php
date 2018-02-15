<?php
include('../classes/domain/Measure.php');

$donnees = new Measure('23/08/1993', '25°C', '30%');

var_dump($donnees);