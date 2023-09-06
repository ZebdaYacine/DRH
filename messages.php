<?php
include 'dbcon.php';
session_start();
$sql = "select * from msg where toemp=".$_SESSION['ide']." order by date desc";
$result = $conn->query($sql);
echo "<div class='text-center dropdown-header' style='height: 25px'>بريد الرسائل</div>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $date0 = $row["date"];
        $name=$row["name"];
        $fromid=$row["fromemp"];
        echo "<div class='dropdown-divider'></div>";
        echo "<a href='envmsg.php?id=$fromid&user=$name'>";
        echo "<div title='$date0' class='text-right dropdown-item'>";
        echo "<h6 class='h6' style='color:#130f0f'><b>".$name."</b></h6>";
        echo "<p class='h6 dropdown-header'>".substr($row["msg"], 0, 20)."</p>";
        echo "</div></a>";
    }
}


