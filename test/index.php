<?php
date_default_timezone_set('Asia/Calcutta');

$servername = "localhost";
$username = "mygallerybook_knr";
$password = "Mygallery@123$";
$dbname = "mygallerybook_knr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
else
{
    $cId = $_POST['cId'];
    $pId = $_POST['pId'];
    $aId = $_POST['aId'];
    $today = date('Y-m-d H:i:s');
    if(isset($_POST['bFinal']) && !is_null($_POST['bFinal']) && !empty($_POST['bFinal'])){
        $bFinal = strtoupper($_POST['bFinal']);
        if($bFinal === "YES")
            $bFinal = 4;
        elseif($bFinal === "NO")
            $bFinal = 1;
    }
    else{
        $bFinal = 1; 
    }

    if(isset($_POST['albumId']) && !is_null($_POST['albumId']) && !empty($_POST['albumId']))
    {
        $albumId = $_POST['albumId'];
        $sql = "UPDATE booking set bFinal='".$bFinal."' where albumId='".$albumId."'";
        mysqli_query($conn, $sql);
    }
    else
    {
        $oQuantity = $_POST['oQuantity'];
        $oNote = $_POST['oNote'];

        $count1 = 0;
        $sql1 = "SELECT COUNT(albumId) as count FROM booking";
        $result1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($result1)){
            $row1 = $result1->fetch_assoc();
            $count1 = $row1["count"]+1;
        }
        $albumId = "MGB".$cId.date('ymd').$count1;

        $sql = "select * from payment where pId=$pId";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            $row = $result->fetch_assoc();
            if($row['sRemainAlbums']>0){
                $paid = $row['sRemainAlbums'] - $oQuantity;
                if($paid == 0){
                    $sEndDate = date('Y-m-d');
                    $sql = "UPDATE payment  set sRemainAlbums='".$paid."',sEndDate='".$sEndDate."' where pId='".$pId."' ";
                        mysqli_query($conn, $sql);
                }
                else{
                    $sql = "UPDATE payment  set sRemainAlbums='".$paid."' where pId='".$pId."' ";
                        mysqli_query($conn, $sql);
                }
            }
            else{
                echo json_encode(array("status" => 500, "message" => "Your Albums are Closed "));
            }
$sql1 ="insert into booking (albumId,oQuantity,oReorder,oNote,bookingAt,bHistory,bFinal,bStatus) values ('$albumId',$oQuantity,0,'$oNote','$today','',$bFinal,1) ";
            mysqli_query($conn, $sql1);
        }
    }


    if(!empty($albumId)){
        $imageCount = 0;
        $fileCount = count($_FILES['image']['name']);
        $targetDir = "../uploads/images/";
        for ($i = 0;$i < $fileCount;$i++)
        {
            $file = $_FILES["image"]["name"][$i];
            $ext = end((explode(".", $file)));

            $fileName = $cId.'_'.date('ymdhsi').''.$i.'.'.$ext;
            $sql = "INSERT INTO orders (cId,aId,pId,albumId,image,oStatus,orderAt,modifiedAt) VALUES ($cId,$aId,$pId,'$albumId','$fileName',1,'$today','$today')";
            if (mysqli_query($conn, $sql))
            {
                move_uploaded_file($_FILES['image']['tmp_name'][$i], $targetDir . $fileName);
            }
            $imageCount = $i+1;
        }
        if($imageCount>0)
        {
            $count1 = 0;
            $sql1 = "SELECT COUNT(albumId) as count FROM orders where albumId='".$albumId."'";
            $result1 = mysqli_query($conn, $sql1);
            if(mysqli_num_rows($result1)){
                $row1 = $result1->fetch_assoc();
                $count1 = $row1["count"];
            }
            echo json_encode(array("status" => 200, "message" => "Complete ".$count1));
        }
        else{
            echo json_encode(array("status" => 500, "message" => "Upload Error "));
        }
    }
}
?>

