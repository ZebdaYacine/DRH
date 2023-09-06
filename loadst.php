<?php

include 'dbcon.php';
session_start();
$sql1 = "select * from advert order by id_adv desc";
$res = $conn->query($sql1);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        if (confirm($row['id_facl'],$row['id_dept'])) {
            echo '<div class="card mt-3 ">'
            . '<div class="card-header" style="height:45px">'
            . '<div class="form-row"><div class="col-8">'
            . '<h6 class="h6">' . getnom($row['id_emp']) . '</h6></div>'
            . '<div class="col-4 text-left">' . $row['dt'] . '</div></div></div>'
            . '<div class="card-body">' . $row['content'] . '</div></div>';
        }
    }
}

function getnom($ide) {
    include 'dbcon.php';
    $sql = "select first_name,last_name from employee where id_emp=$ide";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nom = $row['first_name']." ".$row['last_name'];
    }
    return $nom;
}

function confirm($id1, $id2) {
    if ($id1 == $_SESSION['id_facl']) {
        if (empty($id2)) {
            $a = true;
        } elseif ($id2 == $_SESSION['dept']) {
            $a = true;
        } else {
            $a = false;
        }
    } else {
        $a = false;
    }


    return $a;
}
