<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "wdt_project";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}
