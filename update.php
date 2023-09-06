<?php

include 'dbcon.php';

if (isset($_POST['update_conger'])) {
    if (($_POST['nbr_jour_conger'] != "") && ($_POST['nbr_conger'] != "") && ($_POST['type_conger'] != "")) {
        $n1 = $_POST['nbr_jour_conger'];
        $n2 = $_POST['type_conger'];
        $sql = "UPDATE conger SET type_conger='$n2' , nomber_jour='$n1' WHERE id_conger=" . $_POST['nbr_conger'];
        $conn->query($sql);
    }
    header("Location: gestion_dept.php?form=conger");
} elseif (isset($_POST['update_dept'])) {
    if ($_POST['dept'] != "") {
        $n1 = $_POST["id_dept"];
        $n2 = $_POST['dept'];
        $sql = "UPDATE department SET name_dept='$n2'  WHERE id_dept= $n1";
        $conn->query($sql);
    }
    header("Location: gestion_dept.php?form=dept");
} elseif (isset($_POST['update_grade'])) {
    if (($_POST['nom_grade']) && ($_POST['grade_spl'] != "") && ($_POST['grade_type'] != "") && ($_POST['nom_dpl'] != "")) {
        $n1 = $_POST['nom_grade'];
        $n2 = $_POST['grade_spl'];
        $n3 = $_POST['grade_type'];
        $n4 = $_POST['nom_dpl'];


        $sql = "UPDATE grade SET name_grade='$n1' , special='$n2' , type='$n3' ,id_diploma='" . get_from_table("id_diploma", "Diploma", "name_diploma", $n4) . "'  WHERE id_grade=" . $_POST['id_grade'];
        $conn->query($sql);
    }
    echo $sql;
    header("Location: gestion_grade.php");
} elseif (isset($_POST['update_cert'])) {
    if ($_POST['cert'] != "") {
        $n2 = $_POST['cert'];
        $n1 = $_POST['id_cert'];
        $sql = "UPDATE certificate SET name_cert='$n2'  WHERE id_cert= $n1";
        $conn->query($sql);
    }
    header("Location: gestion_fonction.php");
} elseif (isset($_POST['update_dpl'])) {
    if (($_POST['dpl'] != "") && ($_POST['id_dpl'] != "") ) {
        $n2 = $_POST['id_dpl'];
        $n1 = $_POST['dpl'];
        $sql = "UPDATE Diploma SET name_diploma='$n1'   WHERE id_diploma=" . $n2;
        $conn->query($sql);
    }
   
   header("Location: gestion_deplome.php");
}

function get_from_table($n, $n1, $n2, $n3) {

    $sql0 = "select " . $n . " from " . $n1 . " where " . $n2 . " = '$n3'";
    include 'dbcon.php';
    $result = $conn->query($sql0);
    $attr = "";
    while ($row = $result->fetch_assoc()) {
        $attr = $row["$n"];
    }
    return $attr;
}
