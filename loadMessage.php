<?php

session_start();
error_reporting(0);
include 'dbcon.php';
$nom = $_SESSION['id'];

$sql = "select*from message where from_user !='" . $nom . "' and to_user ='" . $nom . "' ORDER BY date_msg DESC  ";
$j = 0;

$result = $conn->query($sql);
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        if (strlen($row['vue']) <= 0) {
            $j++;
        }
    }
}

echo "<center><h3>".$j."</h3></center>";
