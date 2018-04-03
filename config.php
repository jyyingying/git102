<?php
function getdb(){
$servername = "mysql56";
$username = "jyyingying_ying";
$password = "lovetvxq";
$db = "jyyingying_sutarrinee";
 
try {
   
    $conn = mysqli_connect($servername, $username, $password, $db);
     //echo "Connected successfully"; 
    }
catch(exception $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}
?>