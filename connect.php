
<?php

error_reporting(0);
session_start();
include 'dbcon.php';
$sql = "select * from empolyer  where  type_user='admin' and id_dept is null ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        if ($row['id_emp'] != $_SESSION['ide']) {
            echo"<td class='text-center'>" . $row["nom_emp"] . "</td>";
            if ($row["connect"] == 1) {
                echo'<td class="text-center"><span class="badge badge-pill badge-success" title="متصل">' . $row["connect"] . '</span></td>';
            } else {
                echo'<td class="text-center"><span class="badge badge-pill badge-danger" title="غير متصل">' . $row["connect"] . '</span></td>';
            }
            echo "</tr>";
        }
    }
} else {
    echo ' <h5 class="text-center" ><center>المحتوى فارغ</center></h5>';
}

function get_from_table($n, $n1, $n2, $n3) {

    $sql0 = "select " . $n . " from " . $n1 . " where " . $n2 . " = '$n3'";
    include 'dbcon.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } $result = $conn->query($sql0);
    while ($row = $result->fetch_assoc()) {
        $attr = $row["$n"];
    }
    return $attr;
}
