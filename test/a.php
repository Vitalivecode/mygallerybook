<?php
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
    $cId = 100;
    $count1 = 0;
    $sql1 = "SELECT COUNT(DISTINCT albumId) as count FROM orders";
    $result1 = mysqli_query($conn, $sql1);
    if(mysqli_num_rows($result1)){
        $row1 = $result1->fetch_assoc();
        $count1 = $row1["count"]+1;
    }
    echo "MGB".$cId.date('ymd').$count1;
}
?>