<?php

$dsn = 'mysql:host=localhost;dbname=company';
$dbUserName = 'kareem';
$dbPassword = '';
try {
    $con = new PDO($dsn, $dbUserName, $dbPassword)or die('error');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e;
}