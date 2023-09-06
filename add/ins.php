<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        include '../dbcon.php';
        if ($_SESSION['ide'] == "") {
            header("Location: ../login.php");
        }
        $_SESSION['faculterErr'] = $_SESSION['departErr'] = $_SESSION['faculter1Err'] = "";
        $_SESSION['nom_faculter'] = $_SESSION['nom_depart'] = $_SESSION['nom_faculter1'] = "";



        if (isset($_POST['faculter'])) {

            if (empty($_POST["nom_faculter"])) {
                $_SESSION['faculterErr'] = "ادخل اسم الكلية";
            } else {
                $_SESSION['faculter'] = test_input($_POST["nom_faculter"]);
                if (preg_match("/^[0-9]*$/", $_SESSION['faculter'])) {
                    $_SESSION['faculterErr'] = "اسم خاطئ";
                }
            }
            if ($_SESSION['faculterErr'] == "") {
                $sql = "insert into faculter (nom_facl) values ('" . $_SESSION['faculter'] . "')";
                if ($conn->query($sql) == TRUE) {
                    $_SESSION['confirm'] = "1";
                } else {
                    $_SESSION['confirm'] = "0";
                }
            }
            header("Location: add.php");
        }
        if (isset($_POST['depart'])) {
            if (empty($_POST["depart"])) {
                $_SESSION['departErr'] = "ادخل اسم القسم";
            } else {
                $_SESSION['nom_depart'] = test_input($_POST["nom_depart"]);
                if (preg_match("/^[0-9]*$/", $_SESSION['depart'])) {
                    $_SESSION['departErr'] = "اسم خاطئ";
                }
            }
            if ($_SESSION['departErr'] == "") {
                $_SESSION['nom_faculter1'] = $_POST['nom_faculter1'];
                $sq = "select id_facl from faculter where nom_facl='" . $_SESSION['nom_faculter1'] . "'";
                $r = $conn->query($sq);
                if ($r->num_rows > 0) {
                    $row = $r->fetch_assoc();
                    $id = $row['id_facl'];
                }
                $sql = "insert into departement (id_facl,nom_dept) values (" . $id . ",'" . $_SESSION['nom_depart'] . "')";
                if ($conn->query($sql) == TRUE) {
                    $_SESSION['confirm'] = "1";
                } else {
                    $_SESSION['confirm'] = "0";
                }
            }
            header("Location: add.php");
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
    </body>
</html>
