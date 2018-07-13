<?php

// Configure for student server or localhost
$pos = strpos($_SERVER['REQUEST_URI'], "~siwa15");
if ($pos == false) {
    return [
        "dsn"             => "mysql:host=localhost;dbname=oophp",
        "username"        => "user",
        "password"        => "pass",
        "driver_options"  => [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
    ];
} else {
    return [
        "dsn"             => "mysql:host=blu-ray.student.bth.se;dbname=siwa15",
        "username"        => "siwa15",
        "password"        => "pFXiRRTahMW9",
        "driver_options"  => [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
    ];
}
