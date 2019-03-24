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
         $errors[]="Solo puedes subir archvios .zip, .rar, o .jpeg";
      }
      
      if($file_size > 20971520000000) {
         $errors[]='Archivo demasiado grande';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"/var/www/opfiles/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   }
?>
<html>
  <head><title>Subir archivo</title><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"></head>
   <body>
     <header class="jumbotron">
       <h1> Subiendo archivo como : <?php echo "$f_username"; ?> </h1></header>
      <form action = "" method = "POST" enctype = "multipart/form-data" class="form-control">
         <input type = "file" name = "image" /><br>
         <input type = "text" name="title" required placeholder="Titulo"/>
         <input type = "text" name="description" required placeholder="Descripcion"/> <br>
        <input type="checkbox" name="fileType" value="2"> MARCAR SI QUIERE QUE EL ARCHIVO SEA PRIVADO<br>
  <!-- <input type="radio" name="fileType" value="2"> ARCHIVO PRIVADO NO USAR ESTA EN BETA NO USAR<br> -->
        <input type="checkbox" name="ok" value="true" required>Confirmacion de subir archivo<br>    
        <input type = "submit" class="btn btn-success"/>
         <ul>
            <li>Nombre archivo: <?php echo $_FILES['image']['name'];  ?>
            <li>Peso archivo: <?php echo $_FILES['image']['size'];  ?>
            <li>Tipo de archivo: <?php echo $_FILES['image']['type']; ?>
         </ul>
            
      </form>
      
   </body>
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
if ($check=="true") {
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
    echo "<br> Insertado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

 ?>