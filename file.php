<?php
//get variables 
$fileType = $_GET["t"];
$fileAuthor = $_GET["a"];
$fileName = $_GET["n"];
//CHECK get  VARIABLES
if(empty($fileType)||empty($fileAuthor)||empty($fileName)){ die("<h1>Incorrect URL</h1>");}
//sql
require_once 'config.php';
// Create connection
 $conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM `files` WHERE `fileName` = '$fileName' AND `fileAuthor` = '$fileAuthor' AND `fileType` = '$fileType'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $fileDescription = $row["fileDescription"];
        $fileLink = $row["fileLink"];
      

    }
} else {
   die("<h1>File not found.</h1>");
}
mysqli_close($conn);
if ($_GET["t"]=="2") {
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php?e=403");
    exit;
}
$f_username = $_SESSION["username"];  
if ($fileAuthor!=$f_username) {die("<h1>Permission denied.</h1>");}
}
$nombre = $fileLink;  
$filename = "/var/www/opfiles/$fileLink";  
$size = filesize($filename);  
header("Content-Transfer-Encoding: binary");  
header("Content-type: application/force-download");  
header("Content-Disposition: attachment; filename=$nombre");  
header("Content-Length: $size");  
readfile("$filename");  
?> 
