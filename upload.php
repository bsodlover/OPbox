<?php
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php?e=403");
    exit;
}
$f_username = $_SESSION["username"];

   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","zip","rar","png","exe","docx","odt","rtf","wav","mp4");
      
      if(in_array($file_ext,$expensions)=== false){
        // $errors[]="Solo puedes subir archvios .zip, .rar, o .jpeg";
      }
      
      if($file_size > 20971520000000) {
       //  $errors[]='Archivo demasiado grande';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"/var/www/opfiles/".$file_name);
         $success++;
      }else{
         die(print_r($errors));
      }
   }
?>
<html>
  <head><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><title>Subir archivo</title><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"></head>
   <body>
     <header class=" bg-dark jumbotron">
        <style>
        h1{

        }
        </style>
       <h1 class="text-light text-center font-weight-bold"> Subiendo archivo como: <?php echo "$f_username"; ?> </h1></header>
      <div class="d-flex justify-content-center text-center">
       <form action = "" method = "POST" enctype = "multipart/form-data" class="">
<div id="formm" class="alert-success alert">
     <div>   Titulo del Archivo: <input type = "text" name="title" required placeholder="Titulo"/></div>
     <div> <br> Descripcion del archivo: <input type = "text" name="description" required placeholder="Descripcion"/> <br>     </div> 
         <div> <br> <input type="checkbox" name="fileType" value="2"> Marcar si el archivo es privado.<br>     </div> 
<div> <br>       <input type = "file" name = "image" /><br></div>
 
 
 <div> <br><input type = "submit" class="btn btn-success"/> <br> </div>
 <div> <br>
   <li class="font-weight-bold">Nombre archivo:<br> <?php echo $_FILES['image']['name'];  ?><br>
   <li class="font-weight-bold">Peso archivo:<br> <?php echo $_FILES['image']['size'];  ?><br>
   <li class="font-weight-bold">Tipo de archivo:<br> <?php echo $_FILES['image']['type']; ?><br>
      </div>
  </div>
      </div>


      </form>

      
   </body>
<footer>
   <style>  

   </style>



</footer>
</html>

<?php 
$fileLocation = $_FILES['image']['name'];
$fileName = $_POST["title"];
$fileNamespace = rawurlencode($fileName);
$fileDescription = $_POST["description"];
$fileType = "1";
if ($_POST["fileType"]=="2") {$fileType = "2";}
$check = $_POST["ok"];
require_once 'config.php';
if (isset($_POST["title"])) {
} else {die();}
$url = "file.php?t=$fileType&a=$f_username&n=$fileNamespace";
echo "Link: $url";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO `files` (`fileUrl`, `fileLink`, `fileDescription`, `fileType`, `fileAuthor`, `fileName`, `fileDate`)
VALUES ('$url', '$fileLocation', '$fileDescription', '$fileType', '$f_username', '$fileName', now())";

if ($conn->query($sql) === TRUE) {
    $success++;
} else {
    die($conn->error);
}

$conn->close();
if($success == 2){echo '<script>alert("OK");</script>';} else {echo '<script>alert("Error");</script>';}

 ?>
