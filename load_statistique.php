<?php

function mession() {
    include 'dbcon.php';
    $sql = "select COUNT(creat) as creat,id_empt as travialle from demende  GROUP BY id_empt ASC;";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        echo '<table class="table table-bordred table-hover">';
        echo "<tr>";
        echo "<th scope='col'>الموظف</th>";
        echo"<th scope='col'>المنجزة</th>";
        echo"<th scope='col'>الانتظار</th>";
        echo"<th scope='col'>الاتصال</th>";
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . get_nom("nom_emp", "empolyer", "id_emp", $row['travialle']) . "</td>";
            echo "<td>" . get_creat($row['travialle'], -1) . "</td>";
            echo "<td>" . get_later($row['travialle'], -1) . "</td>";
            if (get_from_table("connect","empolyer","id_emp", $row['travialle']) == 1) {
                echo'<td class="text-center"><span class="badge badge-pill badge-success" title="متصل">1</span></td>';
            } else {
                echo'<td class="text-center"><span class="badge badge-pill badge-danger" title="غير متصل">0</span></td>';
            }
            echo "</tr>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo ' <h5 class="text-center" >المحتوى فارغ</h5>';
    }
}

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

function get_nom($n, $n1, $n2, $n3) {
    include 'dbcon.php';
    $sql0 = "select " . $n . " from " . $n1 . " where " . $n2 . " = $n3";
    $result = $conn->query($sql0);
    $attr = "";
    while ($row = $result->fetch_assoc()) {
        $attr = $row["$n"];
    }
    return $attr;
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
            echo"<td>" . get_creat($row['id_mession'], $_REQUEST['att4']) . "</td>";
            echo"<td>" . get_later($row['id_mession'], $_REQUEST['att4']) . "</td>";
            echo "</tr>";
        }
    } else {

        echo ' <h5 class="text-center" >المحتوى فارغ</h5>';
    }
}

function get_from_table($n, $n1, $n2, $n3) {

    include 'dbcon.php';
    $sql0 = "select " . $n . " from " . $n1 . " where " . $n2 . " = '$n3'";
    $result = $conn->query($sql0) or die($conn->error);
    while ($row = $result->fetch_assoc()) {
        $attr = $row["$n"];
    }

    return $attr;
}

$path = $_REQUEST['path'];
if ($path == 4) {
    mession();
} elseif ($path == 2) {
    mession_1();
}
?>