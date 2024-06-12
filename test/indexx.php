<?php
date_default_timezone_set('Asia/Calcutta');

$sEndDate = date('Y-m-d');
$pId = 65;
$paid = 0;

$servername = "localhost";
$username = "mygaller_book";
$password = "Mygallery@123$";
$dbname = "mygaller_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
else
{
   $sql = "UPDATE payment  set sRemainAlbums='".$paid."',sEndDate='".$sEndDate."' where pId='".$pId."' ";
   echo $sql;
    $a = mysqli_query($conn, $sql); 
    echo "success".$a;
}
?>