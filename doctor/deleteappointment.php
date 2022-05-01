<?php
include_once '../asset/conn/dbconnect.php';
// Get the variables.
$appid = $_POST['id'];
// echo $appid;

$delete = mysqli_query($con,"DELETE FROM appointment WHERE appId=$appid");
// if(isset($delete)) {
//    echo "YES";
// } else {
//    echo "NO";
// }



?>

