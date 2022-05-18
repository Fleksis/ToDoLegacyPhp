<?php

spl_autoload_register('autoloader');

function autoloader($className) {
    $path = "../App/Models/";
    $extension = ".php";
    $fullPath = $path . $className . $extension;

    include_once $fullPath;
}