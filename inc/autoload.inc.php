<?php
spl_autoload_register(function ($class_name) {

    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);

    include '../classes/'.$path . '.php';
});