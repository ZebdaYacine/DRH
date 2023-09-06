<?php

session_start();
error_reporting(0);
include './dbcon.php';

if ($_REQUEST["type"] == "0") {
    $d = $_REQUEST["path"];
    $nom_deplome = get_from_table("name_diploma", "Diploma", "id_diploma", get_from_table("id_diploma", "grade", "name_grade", $d));
    echo'<option>' . $nom_deplome . '</option>';
} elseif ($_REQUEST["type"] == "1") {
    $d = $_REQUEST["path"];
    $id = $_REQUEST["id"];
    $id_dept = get_from_table("id_dept", "employee", "id_emp", $id);
    $sql = "select * from department where id_dept!=$id_dept and id_facl=" . get_from_table("id_facl", "faculty", "name_facl", $d);
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo'<option>' . get_from_table("name_dept", "department", "id_dept", get_from_table("id_dept", "employee", "id_emp", $id)) . '</option>';
        while ($row = $result->fetch_assoc()) {
            echo'<option>' . $row['name_dept'] . '</option>';
        }
    }
} elseif ($_REQUEST["type"] == "5") {

    $d = $_REQUEST["path"];
    $sql = "select*from empolyer where id_emp='$d'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            echo'<option>' . $row['nbr_jour_conger'] . '</option>';
        }
    }
} elseif ($_REQUEST["type"] == "6") {

    $d = $_REQUEST["path"];
    $sql = "select*from conger where type_conger='$d'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            echo'<option>' . $row['nomber_jour'] . '</option>';
        }
    }
} elseif ($_REQUEST["type"] == "7") {

    $d = $_REQUEST["path"];
    $att = $_REQUEST["att"];
    $sql = "select*from employee where mat_emp='$d' and type_user='admin' and id_dept is null";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            if ($att == "name") {
                echo'<option>' . $row['first_name'] . '</option>';
            } elseif ($att == "prename") {
                echo'<option>' . $row['last_name'] . '</option>';
            } else {
                echo'<option></option>';
            }
        }
    }
}

if ($_POST['mission'] == "mission") {
    $sql = 'INSERT INTO certificate(nom_cert) VALUES ("' . $_POST["nom_mission"] . '")';
    if (($conn->query($sql) == TRUE)) {
        echo "1";
    } else {
        echo "0";
    }
} elseif ($_POST['user'] == "user") {
    $d = $_POST['nom_mission'];
    $d1 = $_POST['nom_user'];
    $sql1 = "select id from Mission where nom_cert= '$d'";
    $result = $conn->query($sql1);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
        }
    }
    $sql2 = 'INSERT INTO effect  VALUES ( ' . $id . ',"' . $d1 . '" )';
    if (($conn->query($sql2) == TRUE)) {
        echo "1";
    } else {
        echo "0";
    }
} elseif ($_POST['page'] == "dept") {
    if (($_POST['prenom'] != "") && ($_POST['nom'] != "")) {
        $name = $_POST['nom'];
        $prename = $_POST['prenom'];
        $sql0 = "select * from faculty where name_facl='$prename'";
        $result = $conn->query($sql0);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id_facl = $row['id_facl'];
            }
        }
        $sql = "insert into  department(id_facl,name_dept) values ('$id_facl','$name')";
        if ($conn->query($sql) == TRUE) {
            echo "1";
        } else {
            echo "0";
        }
    }
} elseif ($_POST['page1'] == "grade") {
    $n = $_POST['nom'];
    $n1 = $_POST['special'];
    $n3 = $_POST['typeg'];
    $n2 = $_POST['deplome'];
    $n2 = get_from_table("id_diploma", "Diploma", "name_diploma", $n2);
    $sql = "INSERT INTO grade (name_grade,id_diploma,special,type) VALUES ('$n',$n2,'$n1','$n3')";
    if ($conn->query($sql) == TRUE) {
        echo "1";
    } else {
        echo "0";
    }
} elseif ($_POST['page'] == "deplome") {
    if ($_POST['prenom'] != "") {
        $n1 = $_POST['prenom'];
        $sql = "insert into Diploma (name_diploma) values ('$n1')";
        if ($conn->query($sql) == TRUE) {
            echo "1";
        } else {
            echo "0";
        }
    }
} elseif ($_POST['page'] == "fonction") {
    $n = $_POST['nom'];
    $sql = "insert into certificate(name_cert) values ('$n')";
    if ($conn->query($sql) == TRUE) {
        echo "1";
    } else {
        echo "0";
    }
} elseif ($_POST['page'] == "admin_inscri") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date = $_POST['date'];
    $code = $_POST['code'];
    $date_rect = $_POST['date_rect'];
    $adrass = $_POST['adrass'];
    $lieu_ns = $_POST['lieu_ns'];
    $note = $_POST['note'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $grade = $_POST['grade'];
    $place_travialle = $_POST['place_travialle'];
    $radio = $_POST['radio'];
    $deplom = $_POST['deplome'];

    $id_grad = get_from_table("id_grade", "grade", "nom_grade", $grade);
    $id_deplome = get_from_table("id_deplome", "Deplome", "nom_deplome", $deplom);
    if (!empty(get_from_table("id_facl", "faculter", "nom_facl", $place_travialle))) {
        $id_facl = get_from_table("id_facl", "faculter", "nom_facl", $place_travialle);
    } else {
        $id_facl = get_from_table("id_facl", "departement", "nom_dept", $place_travialle);
    }
    $sql = "insert into administrateur (nom_admin,prenom_admin,code,date,date_rect,"
            . "adrass,lien_ns,note,phone,email,id_grade,travaillera_a,gener,id_deplome,id_facl)"
            . "values ('$nom','$prenom','$code','$date','$date_rect','$adrass','$lieu_ns','$note','$phone','$email',$id_grad,'$place_travialle','$radio',$id_deplome,$id_facl)";

    if ($conn->query($sql) == TRUE) {
        echo "1";
    } else {
        echo "0";
    }
} elseif ($_POST['page'] == "conger") {

    $type = $_POST['typec'];
    $jours = $_POST['jours'];
    $sql = "insert into conger  (type_conger,nomber_jour)"
            . "values ('$type','$jours')";

    if ($conn->query($sql) == TRUE) {
        echo "1";
    } else {
        echo "0";
    }
}

function get_from_table($n, $n1, $n2, $n3) {
    include './dbcon.php';
    $sql0 = "select " . $n . " from " . $n1 . " where " . $n2 . " = '$n3'";
    $result = $conn->query($sql0);
    while ($row = $result->fetch_assoc()) {
        $attr = $row["$n"];
    }
    return $attr;
}
?>

