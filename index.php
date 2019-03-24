<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>OPBOX</title>
    <style>
      .static {position: fixed; width: 100%;}
      .centered {text-align: center;}
      article {background-color: #4682B4; margin: auto; border: 20px solid #4682B4;  border-radius: 25px;}
      article a {color: white;}
    </style>
  </head>
  <body>
      <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4 static">
      <a class="navbar-brand" href="#">OPBOX</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <form class="form-inline mt-2 mt-md-0" action="search.php" method="GET">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="q">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
        <a href="login.php" class="btn btn-outline-info my-2 my-sm-0">Iniciar sesión</a>
        <a href="upload.php" class="btn btn-outline-info my-2 my-sm-0">Subir archivo</a>
        <a href="account.php" class="btn btn-outline-info my-2 my-sm-0">Mi cuenta</a>
      </div>
    </nav>
<br>
<br>
<br>
    <main role="main" class="container">
      <div class="jumbotron">
        <h1>OPBOX</h1>
        <p class="lead">Una simple plataforma para subir y descargar archivos. Proyecto hecho por bsodlover.</p>
      </div>
      <h2 class="centered">Ultimos archivos publicos:</h2>
<?php
require_once 'config.php';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT *
FROM `files`
WHERE `fileType` = '1'
ORDER BY `fileDate` DESC
LIMIT 50";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<article><h3>Nombre: " . $row["fileName"]. " - </h3><p>Description: " . $row["fileDescription"]. "</p><a href=". $row["fileUrl"] .">VER</a><p><i>Hecho por: " . $row["fileAuthor"] . "</p></i></article><br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?> 
    </main>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>


  