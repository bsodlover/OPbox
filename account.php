<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php?e=403");
    exit;
}
$f_username = $_SESSION["username"];
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Perfil de <?php echo $f_username; ?></title>
  </head>
  <body>
   
    <main role="main" class="container">

      <div class="starter-template">
        <h1>Bienvenido, <i><?php echo $f_username; ?></i></h1>
        <p class="lead">Escojer una opción.</p>
        <a href="account.php?t=myposts" class="btn btn-info">Tus posts publicos</a>
        <a href="account.php?t=myprivate" class="btn btn-info">Tus posts privados</a>
      </div>
<?php 
if ($_GET["t"]=="myposts") {
$t = "1";
} 
if ($_GET["t"]=="myprivate") {
$t = "2";
}
require_once 'config.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM `files` WHERE `fileAuthor` = '$f_username' AND `fileType` = '$t' ORDER BY `fileDate` DESC LIMIT 200";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
         echo "<article><h3>Nombre: " . $row["fileName"]. " - </h3><p>Description: " . $row["fileDescription"]. "</p><a href=". $row["fileUrl"] .">VER</a><a class='btn btn-danger' href='?deleteID=" . $row["fileID"] . "'> DELETE</a><p><i>Fecha: " . $row["fileDate"] . "</p></i></article><br>";
    }
} else {
    echo "";
}

if (isset($_GET["deleteID"])) {
    $deleteID  = $_GET["deleteID"];
    $sql = "DELETE FROM `files` WHERE ((`fileID` = '$deleteID'));";
    
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("OK");</script>';
    } else {
        die("Error: " . $sql . "<br>" . $conn->error);
    }
    
    $conn->close();
}
?>
    </main><!-- /.container -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
