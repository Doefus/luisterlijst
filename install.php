
<?php

require "config.php";

try {
    $connection = new PDO("mysql:host=$host", $username, $password, $options);
    $sql = file_get_contents("data/init.sql"); // Lees deze regel extra goed. Wat gebeurt hier denk je?
    $connection->exec($sql); // En hier?

    echo "Database en tabellen zijn succesvol aangemaakt.";
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
