<?php

session_start();
error_reporting(0);
$text = $_POST['text'];
$sel = $_POST['sel'];
include 'dbcon.php';
if (isset($_POST['advert'])) {
    if (!empty($text)) {
        if ($sel == "جميع اقسام الكلية") {
            $sql = "insert into advert (id_emp,content,id_facl) values (" . $_SESSION['ide'] . ",'$text',".$_SESSION['id_facl'].")";
        } else {
            $id = getd($sel);
            $sql = "insert into advert (id_emp,content,id_facl,id_dept) values (" . $_SESSION['ide'] . ",'$text',".$_SESSION['id_facl']."," . $id . ")";
        }
        if ($conn->query($sql) == TRUE) {
            $_SESSION['conf'] = "1";
        } else {
            $_SESSION['conf'] = "0";
        }
    }
    header("Location: ".$_SESSION['pg']);
}

function getd($name_dept) {
    include 'dbcon.php';
    $sql = "select id_dept from department where name_dept='$name_dept'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id_dept'];
    }
    return $id;
}
