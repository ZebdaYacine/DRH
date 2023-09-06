<?php
session_start();
include '../dbcon.php';
$sql1 = "select photo from empolyer where id_emp=".$_GET['id'];
$result = $conn->query($sql1);
$image=$result->fetch_assoc();
header("Content-type: image/jpeg");
echo $image['photo'];
