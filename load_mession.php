<?php
function get_later($id, $nbr) {
    include 'dbcon.php';
    if ($nbr == -1) {
        $sql = "select COUNT(creat) as creat,id_empt as travialle from demende  where  id_empt=$id and  creat  =0   GROUP BY id_empt ";
    } else {
        $sql = "select COUNT(creat) as creat,id_empt as travialle from demende  where id_mession=$id and  creat =0  and id_empt=$nbr  GROUP BY id_empt";
    }
    $result = $conn->query($sql);
    $result->num_rows > 0;
    $row = $result->fetch_assoc();
    if (empty($row['creat'])) {
        $a = 0;
    } else {
        $a = $row['creat'];
    }
    return $a;
}

function get_creat($id, $nbr) {
    include 'dbcon.php';
    if ($nbr == -1) {
        $sql = "select COUNT(creat) as creat,id_empt as travialle from demende  where creat = 1 and id_empt=$id  GROUP BY id_empt ";
    } else {
        $sql = "select COUNT(creat) as creat,id_empt as travialle from demende  where id_mession=$id and  creat =1  and id_empt=$nbr  GROUP BY id_empt";
    }
    $result = $conn->query($sql);
    $result->num_rows > 0;
    $row = $result->fetch_assoc();
    if (empty($row['creat'])) {
        $a = 0;
    } else {
        $a = $row['creat'];
    }
    return $a;
}
function mession_1() {
    include 'dbcon.php';
    $sql = "select * from Effectue where id_emp=" . $_REQUEST['att4'];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<table class="table table-bordred table-hover">';
        echo "<tr>";
        echo "<th scope='col'>الشهادة</th>";
        echo"<th scope='col'>المنجزة</th>";
        echo"<th scope='col'> الانتظار</th>";
        echo "</tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo"<td>" . get_from_table("nom_cert", "Mission", "id_mession", $row['id_mession']) . "</td>";
            echo"<td>" . get_creat($row['id_mession'],  $_REQUEST['att4']) . "</td>";
            echo"<td>" . get_later($row['id_mession'],  $_REQUEST['att4']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo ' <h5 class="text-center" >المحتوى فارغ</h5>';
    }
}

mession_1();
?>