<?php
class DaoBase {
    protected $bdd;

    public function __construct($config) {
        $this->bdd = new \PDO("mysql:host=" . $config['db.host'] . ";dbname=" . $config['db.name'] . ";charset=utf8"
            , $config['db.username'], $config['db.password']);
    }
}