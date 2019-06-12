<?php 
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    //header("location: index.php");
    //exit;
    // echo "logged";
    function getToken() {
        $user_agent = $_SERVER["HTTP_USER_AGENT"];
        //Test if it is a shared client
        if (!empty($_SERVER['HTTP_CLIENT_IP'])){
          $ip=$_SERVER['HTTP_CLIENT_IP'];
        //Is it a proxy address
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
          $ip=$_SERVER['REMOTE_ADDR'];
        }
        //echo "sesion:" . $_SESSION["tokenH"] . "client:" . md5($ip . ":" . $user_agent); 
        return md5($ip . ":" . $user_agent);   
    }
    if(empty($_SESSION['tokenH'])) {
        $_SESSION['tokenH'] = getToken();
    } else {
    if($_SESSION['tokenH'] !== getToken()) {
      session_regenerate_id();
    die('<h1> Ha ocurrido un problema, <a href="logout.php">vuelva a iniciar sesion. </a> Disculpe las molestias</h1><h2>Si el problema persiste, pruebe reiniciar.');
    }}
} else {header("Location: login.php");}
?>
