<?php
namespace dao;

use domain\Measure;

class MeasureDao extends DaoBase{
    public function __construct($config) {
        parent::__construct($config);
    }

    public function createMeasure($measure) {
        $query = $this->bdd->prepare
        ("INSERT INTO releve(datetime, temperature, humidite) VALUES(:datetime, :temperature, :humidite)");

        $query->bindParam(":datetime", $measure->datetime);
        $query->bindParam(":temperature", $measure->temperature);
        $query->bindParam(":humidite", $measure->humidite);

        $query->execute();

        $id = $this->bdd->lastInsertId();

        $measure->id = $id;

        return $id;
    }

    public function readAllMeasure() {
        $result = [];

        $query = $this->bdd->query("SELECT id, datetime, temperature, humidite FROM releve ORDER BY id DESC");

        while($datas = $query->fetch()) {
            $id = $datas['id'];
            $datetime = $datas['datetime'];
            $temperature = $datas['temperature'];
            $humidite = $datas['humidite'];

            $measure = new Measure($id, $datetime, $temperature, $humidite);

            $result[] = $measure;
        }

        return $result;
    }

    public function readMeasureById($id) {
        $query = $this->bdd->prepare("SELECT id, datetime, temperature, humidite FROM releve WHERE id = :id");

        $query->bindParam(":id", $id);

        if($query->execute()) {
            if($datas = $query->fetch()) {
                $id = $datas['id'];
                $datetime = $datas['datetime'];
                $temperature = $datas['temperature'];
                $humidite = $datas['humidite'];

                $result = new Measure($id, $datetime, $temperature, $humidite);
            }
        }

        return $result;
    }

    public function updateMeasure($measure, $id) {
        $query = $this->bdd->prepare
        ("UPDATE releve SET datetime = :datetime, temperature = :temperature, humidite = :humidite WHERE id = :id");

        $query->bindParam(":datetime", $measure->datetime);
        $query->bindParam(":temperature", $measure->temperature);
        $query->bindParam(":humidite", $measure->humidite);

        $query->bindParam(":id", $id);


        $query->execute();
    }

    public function deleteMeasure($id) {
        $query = $this->bdd->prepare("DELETE FROM releve WHERE id = :id");

        $query->bindParam(":id", $id);

        $query->execute();
    }

}

