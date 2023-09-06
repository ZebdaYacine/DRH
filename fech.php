<?php



include 'dbcon.php';


if ($_POST['d'] == "dept") {
    if (isset($_POST["id_dept"])) {
        $query = "SELECT * FROM department WHERE id_dept = '" . $_POST["id_dept"] . "'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
    }
} elseif ($_POST['d'] == "conger") {
    if (isset($_POST["id_conger"])) {
        $query = "SELECT * FROM conger WHERE id_conger = '" . $_POST["id_conger"] . "'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
    }
}elseif($_POST['d']=="deplome"){
    if (isset($_POST["id_deplome"])) {
        $query = "SELECT * FROM Deplome WHERE id_deplome = '" . $_POST["id_deplome"] . "'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
    }
}elseif($_POST['d']=="grade"){
    if (isset($_POST["id_grade"])) {
        $query = "SELECT * FROM grade WHERE id_grade = '" . $_POST["id_grade"] . "'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
    }
}elseif ($_POST['d'] == "cert") {
    if (isset($_POST["id_cert"])) {
        $query = "SELECT * FROM certificate WHERE id_cert = '" . $_POST["id_cert"] . "'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
    }
}elseif ($_POST['d'] == "dpl") {
    if (isset($_POST["id_dpl"])) {
        $query = "SELECT * FROM Diploma WHERE id_diploma = '" . $_POST["id_dpl"] . "'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
    }
}

