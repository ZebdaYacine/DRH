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
        include '../dbcon.php';
        error_reporting(0);
        session_start();
        $_SESSION['deptErr']=$_SESSION['nbr_srlERR'] = $_SESSION['nameErr'] = $_SESSION['phoneErr'] = $_SESSION['emailErr'] = $_SESSION['lien_nsErr'] = $_SESSION['place_travialleErr'] = $_SESSION['prenameErr'] = $_SESSION['genderErr'] = $_SESSION['daterErr'] = $_SESSION['date1rErr'] = $_SESSION['codeErr'] = $_SESSION['adrassErr'] = $_SESSION['noterErr'] = "";
        $_SESSION['nbr_srl'] = $_SESSION['place_travialle'] = $_SESSION['code'] = $_SESSION['date'] = $_SESSION['note'] = $_SESSION['lien_ns'] = $_SESSION['date1'] = $_SESSION['adrass'] = $_SESSION['gender'] = $_SESSION['phone'] = $_SESSION['nom'] = $_SESSION['prenom'] = $_SESSION['adrass'] = $_SESSION['note'] = "";


        if (isset($_POST['insert'])) {


            if (validation()) {
                $nom = $_SESSION['nom'];
                $prenom = $_SESSION['prename'];
                $date = $_SESSION['date'];
                $code = $_SESSION['code'];
                $date_rect = $_SESSION['date1'];
                $adrass = $_SESSION['adrass'];
                $lieu_ns = $_SESSION['lien_ns'];
                $note = $_SESSION['note'];
                $phone = $_SESSION['phone'];
                $email = $_SESSION['email'];
                $grade = $_POST['grade'];
                $place_travialle = $_POST['place_travialle'];
                $place_travialle1 = $_POST['place_travialle1'];
                $radio = $_SESSION['gender'];
                $deplom = $_POST['deplome'];
                $right_e = $_POST['droit'];
                $nbr_srl = $_POST['nbr_srl'];
                $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                $id_grad = get_from_table("id_grade", "grade", "name_grade", $grade);
                $id_sp = get_from_table("id_sp", "specialty", "name_sp", $_POST['sp']);
                $id_role = get_from_table("id_role", "role", "righte", $right_e);
                if (empty($place_travialle1)) {
                    $id_dept1="";
                    $id_dept="";
                } else {
                    $id_dept1=",id_dept";
                    $id_dept = ",".get_from_table("id_dept", "department", "name_dept", $place_travialle1);
                }
                $id_diploma = get_from_table("id_diploma", "Diploma", "name_diploma", $deplom);
                $id_facl = get_from_table("id_facl", "faculty", "name_facl", $place_travialle);


                if (($_SESSION["page"] == "insert_admin.php?type=contrat" || $_SESSION["page"] == "insert_admin.php?type=admin" || $_SESSION["page"] == "insert_admin.php?type=agoin")) {

                    $sql = "insert into employee (mat_emp,id_sp,first_name,last_name,`code`,DNS,"
                                . "address,LNS,note,phone,email,id_grade,gender,id_diploma,id_facl$id_dept1,photo,type_user,date_rect,id_role)"
                                . "values ('$nbr_srl',$id_sp,'$nom','$prenom','$code','$date','$adrass','$lieu_ns',$note,'$phone','$email',$id_grad,'$radio',$id_diploma,$id_facl$id_dept,'$img','".$_SESSION['ag']."','$date_rect',$id_role)";
                     echo $sql;   
                   if ($conn->query($sql) == TRUE) {
                        $_SESSION['confirm'] = "1";
                    } else {
                        $_SESSION['confirm'] = "0";
                    }
                    echo $sql;
                } elseif ($_SESSION["page"] == "insert_admin.php?type=prof") {
                    if (empty($_POST['place_travialle1'])) {
                        $_SESSION['deptErr'] = "أدخل قسم";
                        header("Location: " . $_SESSION["page"]);
                    } else {
                        $_SESSION['deptErr']="";
                        $id_dept= get_from_table("id_dept", "department", "name_dept", $_POST['place_travialle1']);
                        $sql = "insert into employee (mat_emp,id_sp,first_name,last_name,code,DNS,"
                                . "address,LNS,note,phone,email,id_grade,gender,id_diploma,id_facl,id_dept,photo,type_user,date_rect,id_role)"
                                . "values ('$nbr_srl',$id_sp,'$nom','$prenom','$code','$date','$adrass','$lieu_ns',$note,'$phone','$email',$id_grad,'$radio',$id_diploma,$id_facl,$id_dept,'$img','prof','$date_rect',$id_role)";
                        
                       if ($conn->query($sql) == TRUE) {
                            $_SESSION['confirm'] = "1";
                        } else {
                            $_SESSION['confirm'] = "0";
                        }
                    }
                }
            }
        }
      header("Location: " . $_SESSION["page"]);

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function get_from_table($n, $n1, $n2, $n3) {

            $sql0 = "select " . $n . " from " . $n1 . " where " . $n2 . " = '$n3'";
            include '../dbcon.php';
            $result = $conn->query($sql0);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $attr = $row["$n"];
                }
            }
            return $attr;
        }

        function validation() {
            $p = true;
            if (empty($_POST["nom"])) {
                $_SESSION['nameErr'] = "ادخل الاسم الاول";
                $p = false;
            } else {
                if (preg_match("/^[0-9]*$/", $_POST['nom'])) {
                    $_SESSION['nameErr'] = "اسم خاطئ";
                    $p = false;
                } else {
                    $_SESSION['nameErr'] = "";
                    $_SESSION['nom'] = test_input($_POST["nom"]);
                }
            }
            if (empty($_POST["nbr_srl"])) {
                $_SESSION['nbr_srlERR'] = "ادخل الرقم التسلسلي";
                $p = false;
            } else {
                $_SESSION['nbr_srlERR'] = "";
                $_SESSION['nbr_srl'] = test_input($_POST["nbr_srl"]);
            }

            if (empty($_POST["prenom"])) {
                $_SESSION['prenameErr'] = "ادخل اسم العائلة";
                $p = false;
            } else {

                if (!preg_match("/^[0-9]*$/", $_POST['prename'])) {
                    $_SESSION['prenameErr'] = "اسم العائلة خاطئ";
                    $p = false;
                } else {
                    $_SESSION['prename'] = test_input($_POST["prenom"]);
                    $_SESSION['prenameErr'] = "";
                }
            }

            if (!preg_match("#^[a-z0-9-A-Z._-]+@(gmail|yahoo)\.(com|fr|dz)$#", $_POST["email"])) {
                $_SESSION['emailErr'] = "ادخال خاطئ";
                $p = false;
            } else {
                $_SESSION['email'] = test_input($_POST["email"]);
                $_SESSION['emailErr'] = "";
            }

            if (empty($_POST["phone"])) {
                $_SESSION['phoneErr'] = "ادخل رقم الهاتف";
                $p = false;
            } else {
                if ((strlen($_POST['phone']) - substr_count($_POST['phone'], " ") != 10)) {
                    $_SESSION['phoneErr'] = "ادخال خاطئ";
                    $p = false;
                } else {
                    $_SESSION['phone'] = test_input($_POST["phone"]);
                    $_SESSION['phoneErr'] = "";
                }
            }


            if (empty($_POST["radio"])) {
                $_SESSION['genderErr'] = "حدد الجنس";
                $p = false;
            } else {
                $_SESSION['gender'] = test_input($_POST["radio"]);
                $_SESSION['genderErr'] = "";
            }
            if (empty($_POST["adrass"])) {
                $_SESSION['adrassErr'] = "حدد العنوان";
                $p = false;
            } else {
                $_SESSION['adrass'] = test_input($_POST["adrass"]);
                $_SESSION['adrassErr'] = "";
            }
            if (empty($_POST["lieu_ns"])) {
                $_SESSION['lien_nsErr'] = "حدد مكان الميلاد";
                $p = false;
            } else {
                $_SESSION['lien_ns'] = test_input($_POST["lieu_ns"]);
                $_SESSION['lien_nsErr'] = "";
            }

            if (empty($_POST["note"])) {
                $_SESSION['noterErr'] = "ادخل تقيما";
                $p = false;
            } else {
                $_SESSION['noterErr'] = "";
                $_SESSION['note'] = test_input($_POST["note"]);
            }
            
            if (empty($_POST["date"])) {
                $_SESSION['daterErr'] = "ادخل تاريخ الميلاد";
                $p = false;
            } else {
                $_SESSION['date'] = test_input($_POST["date"]);
            }

            if (empty($_POST["date_rect"])) {
                $_SESSION['date1rErr'] = "ادخل تاريخ الالتحاق";
                $p = false;
            } else {
                $_SESSION['date1rErr'] = "";
                $_SESSION['date1'] = test_input($_POST["date_rect"]);
            }

            if (empty($_POST["code"])) {
                $_SESSION['codeErr'] = "أدخل كلمة السر";
                $p = false;
            } else {
                if (strlen($_POST["code"]) < 5) {
                    $_SESSION['codeErr'] = "كلمة السر غير آمنة";
                    $p = false;
                } else {
                    $_SESSION['code'] = test_input($_POST["code"]);
                }
            }
            return $p;
        }

        ?>
    </body>
</html>