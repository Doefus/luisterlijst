<?php

$host       = "localhost";
$username   = "root"; // pas deze eventueel aan
$password   = "root"; // pas deze eventueel aan
$dbname     = "LuisterLijst";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
