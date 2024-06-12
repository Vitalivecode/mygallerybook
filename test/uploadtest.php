<?php

include 'connection.php';

$fileCount = count($_FILES['image']['name']);
$targetDir = "upload/";

for($i=0; $i<$fileCount ; $i++){
    $fileName = $_FILES['image']['name'][$i];
    $sql = "INSERT INTO imagestest (image) VALUES ('$targetDir$fileName')";

    if($con -> query($sql) === TRUE){
        
    move_uploaded_file($_FILES['image']['tmp_name'][$i], $targetDir.$fileName);
        echo "Success";
    } else {
        echo "Error";
    }
}

?>