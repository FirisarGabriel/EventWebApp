<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$db = 'evenimente';

$mysqli = new mysqli($hostname, $username, $password,$db);

if(mysqli_connect_errno())
{
    echo 'Nu se poate connecta';
    exit();
}
