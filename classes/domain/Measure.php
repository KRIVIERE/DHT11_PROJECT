<?php

class Measure {
    public $id;
    public $datetime;
    public $temperature;
    public $humidite;

    public function __construct($datetime, $temperature, $humidite) {
        $this->datetime = $datetime;
        $this->temperature = $temperature;
        $this->humidite = $humidite;
    }
}