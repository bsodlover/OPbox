<?php
/* PUT ON HERE YOUR DB SETTINGS */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'laweb');
define('DB_PASSWORD', 'mateomolaxdd');
define('DB_NAME', 'opbox');
//Put on here your directory for files. Not recommended to be the same as your web files
$saveLocation = "/var/www/opfiles";
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$servername = DB_SERVER;
$username = DB_USERNAME;
$password = DB_PASSWORD;
$dbname = DB_NAME;
?>
