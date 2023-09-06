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
        if ($_REQUEST["type"] == "0") {
            $d = $_REQUEST["path"];
            $name_diploma = get_from_table("name_diploma", "Diploma", "id_diploma", get_from_table("id_diploma", "grade", "name_grade", $d));
            echo'<option>' . $name_diploma . '</option>';
        }
        $_SESSION['confirm3'] = "0";
        $type = $_SESSION["type"];
        $_SESSION['nbr_srlERR'] = $_SESSION['nameErr'] = $_SESSION['phoneErr'] = $_SESSION['emailErr'] = $_SESSION['lien_nsErr'] = $_SESSION['adrass'] = $_SESSION['place_travialleErr'] = $_SESSION['prenameErr'] = $_SESSION['phone_emailErr'] = $_SESSION['genderErr'] = $_SESSION['daterErr'] = $_SESSION['date1rErr'] = $_SESSION['codeErr'] = $_SESSION['noteErr'] = "";
        $_SESSION['place_travialle'] = $_SESSION['code'] = $_SESSION['date'] = $_SESSION['note'] = $_SESSION['lien_ns'] = $_SESSION['date1'] = $_SESSION['adrass'] = $_SESSION['gender'] = $_SESSION['phone'] = $_SESSION['nom'] = $_SESSION['prenom'] = $_SESSION['adrass'] = $_SESSION['note'] = "";

        if ($_SESSION['insert'] == "insert") {

            if (isset($_POST['cree'])) {

                validation();
                if (!(!empty($_SESSION['nameErr']) || !empty($_SESSION['codeErr']) || !empty($_SESSION['prenameErr']) ||
                        !empty($_SESSION['noteErr']) || !empty($_SESSION['dateErr']) || 
                        !empty($_SESSION['lien_nsErr']) || !empty($_SESSION['adrassErr']) || !empty($_SESSION['genderErr']) || !empty($_SESSION['phoneErr']) || !empty($_SESSION['emailErr']) || !empty($_SESSION['nbr_srl_ERR']))) {
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
                    $id_role = $_POST['droit'];
                    $nbr_srl = $_POST['nbr_srl'];
                    $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));


                    $id_grad = get_from_table("id_grade", "grade", "nom_grade", $grade);
                    $id_role = get_from_table("id_role", "role", "droit", $id_role);
                    if (!empty($place_travialle1)) {
                        $id_dept1 = ",id_dept";
                        $id_dept = "," . get_from_table("id_dept", "departement", "nom_dept", $place_travialle1);
                    } else {
                        $id_dept1 = "";
                        $id_dept = "";
                    }
                    $id_deplome = get_from_table("id_deplome", "Deplome", "nom_deplome", $deplom);
                    $id_facl = get_from_table("id_facl", "faculter", "nom_facl", $place_travialle);


                    if (($_SESSION["page"] == "insert_admin.php?type=contrat" || $_SESSION["page"] == "insert_admin.php?type=admin" || $_SESSION["page"] == "insert_admin.php?type=agoin") && !empty($_SESSION['date1Err'])) {

                        $sql = "insert into empolyer(id_emp,nom_emp,prenom_emp,code,date,date_rect,adrass,"
                                . "lien_ns,note,phone,email,id_grade,gener,"
                                . " id_deplome,"
                                . " id_facl,"
                                . " id_role,photo,type_user $id_dept1)"
                                . "values ('$nbr_srl','$nom','$prenom','$code','$date','$date_rect','$adrass',"
                                . "'$lieu_ns',$note,'$phone','$email',$id_grad,"
                                . "'$radio',$id_deplome,$id_facl,$id_role,'$img','" . $_SESSION['ag'] . "'$id_dept)";
                        if ($conn->query($sql) == TRUE) {
                            $_SESSION['confirm'] = "1";
                        } else {
                            $_SESSION['confirm'] = "0";
                        }
                    } elseif ($_SESSION["page"] == "insert_prof.php") {

                        $sql = "insert into empolyer (id_emp,nom_emp,prenom_emp,code,date,"
                                . "adrass,lien_ns,note,phone,email,id_grade,gener,id_deplome,id_facl,photo,type_user,id_role)"
                                . "values ('$nbr_srl','$nom','$prenom','$code','$date','$adrass','$lieu_ns','$note','$phone','$email',$id_grad,'$radio',$id_deplome,$id_facl,'$img','prof',$id_role)";
                        if ($conn->query($sql) == TRUE) {
                            /* $sql1 = "insert into "
                              . "etudie(id_dept,id_emp,date_rect) values(" . get_from_table("id_dept", "departement", "nom_dept", $place_travialle1) . ""
                              . "," . get_from_table("id_emp", "empolyer", "nom_emp", $nom) . ",'$date_rect')";
                              if ($conn->query($sql1) == TRUE) {
                              $_SESSION['confirm1'] = "1";
                              } else {
                              $_SESSION['confirm1'] = "0";
                              } */
                            $_SESSION['confirm1'] = "1";
                        } else {
                            $_SESSION['confirm1'] = $sql;
                        }
                    }
                }
                header("Location: " . $_SESSION["page"]);
            }
        }
        if ($_SESSION['delete'] === "delete") {
            if (isset($_POST['delete'])) {
                $sql = "delete from employee where id_emp=" . $_SESSION['id_emp'];
                delete($sql);
                $_SESSION['confirm3'] = "1";
                header("Location: gestion_admin.php?user=$type");
            } elseif (isset($_POST['update'])) {
                validation();
                if (!(!empty($_SESSION['nameErr']) || !empty($_SESSION['codeErr']) || !empty($_SESSION['prenameErr']) ||
                        !empty($_SESSION['noteErr']) || !empty($_SESSION['dateErr']) || !empty($_SESSION['date1Err']) ||
                        !empty($_SESSION['lien_nsErr']) || !empty($_SESSION['adrassErr']) || !empty($_SESSION['genderErr']) ||
                        !empty($_SESSION['phoneErr']) || !empty($_SESSION['emailErr']))) {

                    if (get_from_table("id_facl", "faculty", "name_facl", $_POST['place_travialle']) != "") {
                        $id_facl = get_from_table("id_facl", "faculty", "name_facl", $_POST['place_travialle']);
                    } else {
                        $id_facl = get_from_table("id_facl", "department", "nom_dept", $_POST['place_travialle']);
                    }
                    $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));

                    $sql = "UPDATE employee SET 
                    first_name='" . $_POST["nom"] . "'
                    , last_name='" . $_POST['prenom'] . "',
                    code='" . $_POST['code'] . "',gender='" . $_POST['radio'] . "',
                    id_diploma=" . get_from_table("id_diploma", "Diploma", "name_diploma", $_POST['deplome']) . ",
                    phone='" . $_POST['phone'] . "',
                    email='" . $_POST["email"] . "',
                    address='" . $_POST["adrass"] . "',"
                            . "id_facl=" . $id_facl . ",
                    note='" . $_POST["note"] . "',DNS='" . $_POST['date'] . "',
                    id_grade='" . get_from_table("id_grade", "grade", "name_grade", $_POST['grade']) . "',
                    id_role='" . get_from_table("id_role", "role", "righte", $_POST['droit']) . "',LNS='" . $_POST["lieu_ns"] . "',
                    date_rect='" . $_POST['date_rect'] . "'"
                            . " , photo='" . $img . "' where id_emp=" . $_SESSION['id_emp'];
                    if ($conn->query($sql) == TRUE) {
                        $_SESSION['confirm2'] = "1";
                        $_SESSION['view_nom'] = $_POST["nom"];
                        $_SESSION['view_prenom'] = $_POST["prenom"];
                        $_SESSION['view_note'] = $_POST["note"];
                        $_SESSION['view_adrass'] = $_POST["adrass"];
                        $_SESSION['view_code'] = $_POST["code"];
                        $_SESSION['view_email'] = $_POST['email'];
                        $_SESSION['view_phone'] = $_POST['phone'];
                        $_SESSION['view_date'] = $_POST['date'];
                        $_SESSION['view_date_rect'] = $_POST['date_rect'];
                        $_SESSION['view_travaillera_a'] = $_POST['travaillera_a'];
                        $_SESSION['view_lien_ns'] = $_POST['lieu_ns'];
                        $_SESSION['view_grade'] = $_POST['grade'];
                        $_SESSION['view_deplome'] = $_POST['deplome'];
                        $_SESSION['view_gener'] = $_POST['radio'];
                    } else {
                        $_SESSION['confirm2'] = "0";
                    }
                } else {
                    $_SESSION['confirm2'] = "0";
                }
               echo $sql;
               header("Location: view_profile.php?id=" . $_SESSION['id_emp']);
            }
        } if ($_SESSION['select'] === "select") {
            if ($_SESSION['type'] == "prof") {
                $type = "employee where type_user='prof'";
            } elseif ($_SESSION['type'] == "admin") {
                $type = "employee where type_user='admin'";
            } elseif ($_SESSION['type'] == "agoin") {
                $type = "employee where type_user='agoin'";
            }
            if (isset($_POST['next'])) {
                $sql = "select*from $type and  id_emp > " . $_SESSION['id_emp'] . " LIMIT 1";
                next_prvios($sql);
                header("Location: view_profile.php?id=" . $_SESSION['view_id_emp']);
            } elseif (isset($_POST['previos'])) {
                $sql1 = "select*from $type and  id_emp < " . $_SESSION['id_emp'] . " order by id_emp DESC";
                $result = $conn->query($sql1);
                $f = false;
                $data = $_SESSION['id_emp'];
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $_SESSION['view_nom'] = $row['nom_emp'];
                    $_SESSION['view_prenom'] = $row['prenom_emp'];
                    $_SESSION['view_note'] = $row['note'];
                    $_SESSION['view_adrass'] = $row['adrass'];
                    $_SESSION['view_code'] = $row['code'];
                    $_SESSION['view_email'] = $row['email'];
                    $_SESSION['view_phone'] = $row['phone'];
                    $_SESSION['view_date'] = $row['date'];
                    $_SESSION['view_date_rect'] = $row['date_rect'];
                    $_SESSION['view_role'] = $row['id_role'];
                    $_SESSION['view_lien_ns'] = $row['lien_ns'];
                    $_SESSION['view_grade'] = $row['id_grade'];
                    $_SESSION['view_deplome'] = $row['id_deplome'];
                    $_SESSION['view_gener'] = $row['gener'];
                    $_SESSION['view_id_emp'] = $row['id_emp'];
                }
                header("Location: view_profile.php?id=" . $_SESSION['view_id_emp']);
            }
        }if (isset($_POST['cree3'])) {
            $type_1 = $_SESSION['tp'];

            $type = $_POST['type'];
            $declaration = $_POST['declaration'];
            $replace = $_POST['replace'];
            $acord = $_POST['acord'];
            $date = $_POST['date_1'];
            $nbr_total = $_POST['nbr_jour_total'];
            $date_entre = date('Y-m-d', strtotime($date . " + $nbr_total days"));
            $year = date('Y', strtotime($_POST['date_1']));
            $id = $_SESSION['id_emp'];
            $idt = $_SESSION['id_empt'];
            $adrass_1 = $_POST['adrass_1'];
            $cd = $_POST['cd'];
            $id_conger = get_from_table("id_conger", "conger", "type_conger", $type);
            if ($id_conger == "1" || $id_conger == "7") {
                $declaration = 0;
            } else {
                $acord = 0;
            }
            $case = true;
            if ($_SESSION['tp'] == "demende") {
                $id_emp = $_SESSION['id_emp'];
                $id_cert = $_SESSION['id_cert'];
                $type_conger = get_from_table("id_conger", "conger", "type_conger", $type);
                if ($replace != "لا يوجد مستخلف" && $replace != "") {
                    $sql = "INSERT INTO demende(id_emp,id_mession,id_conger, declaration, nbr_jours, adrass, date_conger,id_empt,remplacement)"
                            . "values ($id_emp,$id_cert,$id_conger,$declaration,'$acord','$adrass_1','$date',$idt,'$replace')";
                    if ($date == "") {
                        $_SESSION['confim_demende'] = "0";
                    } else {
                        if ($conn->query($sql) == TRUE) {
                            $_SESSION['confim_demende'] = "1";
                        } else {
                            $_SESSION['confim_demende'] = "0";
                        }
                    }
                } else {
                    $_SESSION['confim_demende'] = "-1";
                }
                header("Location: ../cert.php?type=$type_1&id_cert=" . $_SESSION['id_cert'] . "&id_emp=" . $_SESSION['id_emp'] . "&id_empt=" . $_SESSION['id_empt']);
            } elseif ($_SESSION['tp'] == "cree") {
                echo "fd";
                if (test_conger($id, $year) == "insert") {
                    $sql1 = "INSERT INTO profitier"
                            . "(id_emp, id_conger,date_sortie,date_entre, nbr_total,declaration,adrass_conger,anne)  "
                            . "values ($id,$id_conger,'$date','$date_entre','$nbr_total','$declaration','$adrass_1','$year')";
                } elseif (test_conger($id, $year) == "update") {
                    $sql1 = "UPDATE profitier SET date_sortie='$data',date_entre='$date_entre',"
                            . "nbr_total='$nbr_jour',declaration='$declaration',adrass_conger='$adrass' WHERE id_emp=$id and id_conger=$id_conger and anne='$year'";
                } else {
                    $case = false;
                }

                if ($case) {
                    if ($id_conger == "1") {
                        if ($nbr_total > 0) {
                            $sql = "UPDATE empolyer SET nbr_jour_conger=$cd WHERE id_emp=$id";
                            $conn->query($sql);
                            $f = true;
                        } else {
                            $f = false;
                        }
                    } else {
                        $cd = "0";
                    }


                    if ($f || ($id_conger == "7") || ($id_conger == "3")) {
                        if ($conn->query($sql1) == TRUE) {
                            $content = ob_get_clean();
                            require_once '../tcpdf/tcpdf.php';
                            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, TRUE, 'UTF_8', FALSE);
                            $lg = array();
                            $lg['a_meta_charset'] = 'UTF_8';
                            $lg['a_meta_dir'] = 'rtl';
                            $lg['a_meta_lnguage'] = 'ar';
                            $lg['w_page'] = 'page';
                            $pdf->SetPrintHeader(false);
                            $pdf->setLanguageArray($lg);
                            $pdf->setRTL(true);
                            $pdf->AddPage();
                            $pdf->Ln();
                            $htmlcontent = "الجمورية الجزائرية الديمقراطية الشعبية";
                            $htmlcontent1 = "وزارة التعليم العالي والبحث العلمي";
                            $htmlcontent2 = "جامعة عمار الثليجي - الاغواط";
                            $htmlcontent3 = "كلية " . get_from_table("nom_facl", "faculter", "id_facl", get_from_table("id_facl", "empolyer", "id_emp", get_from_table("nom_emp", "empolyer", " id_emp", $id)));
                            $htmlcontent4 = "مصلحة المستخدمين";
                            $htmlcontent5 = "الاغواط في : " . $date;
                            $htmlcontent6 = "سند عطلة";
                            $htmlcontent7 = "الاسم و اللقب:  " . get_from_table("nom_emp", "empolyer", " id_emp", $id) . " " . get_from_table("prenom_emp", "empolyer", " id_emp", $id);
                            $htmlcontent8 = "الوظيفة: " . get_from_table("nom_grade", "grade", "id_grade", get_from_table("id_grade", "empolyer", "id_emp", $id));
                            $htmlcontent9 = "عدد الايام بالاحرف :" . arabicNumber(get_from_table("nbr_total", "profitier", "id_emp", $id_emp));
                            ;
                            $htmlcontent10 = "نوعية العطلة:   " . $type;
                            $htmlcontent11 = "الرصيد المتبقي:  " . $cd . "يوم";
                            $htmlcontent12 = "العنوان اثناء العطلة:  " . $_POST['adrass_1'];
                            $htmlcontent13 = "من :  " . $date;
                            $htmlcontent14 = "الى:  " . $date_entre;
                            $htmlcontent15 = "المدير";

                            $pdf->Image("../img/38477-universite-de-laghouat.jpg", 60, 10, 40, 40);
                            $pdf->SetFont('aefurat', '', '12');
                            $pdf->writeHTMLCell(100, 100, 70, 10, $htmlcontent, 0, 0, 0, true);
                            $pdf->SetFont('aefurat', '', '10');
                            $pdf->writeHTMLCell(100, 100, 10, 30, $htmlcontent1, 0, 0, 0, true);
                            $pdf->writeHTMLCell(100, 100, 10, 40, $htmlcontent2, 0, 0, 0, true);
                            $pdf->writeHTMLCell(100, 100, 20, 50, $htmlcontent3, 0, 0, 0, true);
                            $pdf->writeHTMLCell(100, 100, 10, 60, $htmlcontent4, 0, 0, 0, true);
                            $pdf->writeHTMLCell(100, 100, 150, 60, $htmlcontent5, 0, 0, 0, true);
                            $pdf->SetFont('aefurat', '', '16');
                            $pdf->writeHTMLCell(100, 100, 90, 70, $htmlcontent6, 0, 0, 0, true);
                            $pdf->SetFont('aefurat', '', '12');
                            $pdf->writeHTMLCell(100, 100, 10, 80, $htmlcontent7, 0, 0, 0, true);
                            $pdf->writeHTMLCell(100, 100, 150, 80, "السنة: " . $year, 0, 0, 0, true);
                            $pdf->writeHTMLCell(100, 100, 10, 90, $htmlcontent8, 0, 0, 0, true);
                            $pdf->writeHTMLCell(100, 100, 10, 100, $htmlcontent9, 0, 0, 0, true);
                            $pdf->writeHTMLCell(100, 100, 120, 100, "بالارقام: " . $nbr_total . "يوم", 0, 0, 0, true);
                            $pdf->writeHTMLCell(100, 100, 10, 110, $htmlcontent13, 0, 0, 0, true);
                            $pdf->writeHTMLCell(100, 100, 110, 110, $htmlcontent14, 0, 0, 0, true);
                            $pdf->writeHTMLCell(100, 100, 10, 120, $htmlcontent10, 0, 0, 0, true);
                            $pdf->writeHTMLCell(100, 100, 10, 130, $htmlcontent11, 0, 0, 0, true);
                            $pdf->writeHTMLCell(100, 100, 10, 140, $htmlcontent12, 0, 0, 0, true);
                            $pdf->writeHTMLCell(100, 100, 160, 160, $htmlcontent15, 0, 0, 0, true);
                            $pdf->writeHTMLCell(100, 100, 10, 150, "المستخلف:" . $replace, 0, 0, 0, true);
                            $xc = 100;
                            $yc = 100;

                            $pdf->SetDrawColor(0, 0, 0);
                            $pdf->Line($xc - 80, $yc + 100, $xc + 100, $yc + 100);
                            $pdf->writeHTMLCell(300, 300, 10, 200, "عدم تاخر جزء او كل العطلة من السنة اخرى وفي حدود سنة على الاكثر في الاستثناءا)المادة 17 من القانون 08-81 بتاري<BR>ه 81/06/27 ويمنك تجزئة العطلة على الا تقل عن 15 بوما مننالية )م18((ت ", 0, 0, 0, true);
                            $pdf->Line($xc - 80, $yc + 120, $xc + 100, $yc + 120);
                            $pdf->writeHTMLCell(100, 30, 10, 230, "العنوان ص-ب رقم 37 ج الاغواط", 0, 0, 0, true);
                            $pdf->writeHTMLCell(100, 30, 140, 230, "الموقع:http://www.lagh-univ.dz", 0, 0, 0, true);
                            $pdf->writeHTMLCell(300, 30, 10, 240, "الهاتف:029.93.21.26 - 029.93.17.91 - 029.93.21.17 - 029.93.10.24 - 029.93.10.24 - 029.93.32.05 - 029.93.21.32  ", 0, 0, 0, true);
                            $pdf->writeHTMLCell(300, 30, 80, 250, "الفاكس:029.93.26.98 ", 0, 0, 0, true);
                            $pdf->Output('test.pdf');
                            $_SESSION['id_confim'] = "1";
                        } else {
                            $_SESSION['id_confim'] = "0";
                        }
                    } else {
                        $_SESSION['id_confim'] = "-1";
                    }
                } else {
                    $_SESSION['id_confim'] = "-2";
                }
                echo "fd" . $_SESSION['page'];

                if ($_SESSION['page'] == "view") {
                    header("Location: view_profile.php?id=" . $_SESSION['id_emp']);
                } else {
                    header("Location: ../cert.php?type=$type_1&id_conger=" . $id_conger . "&id_emp=" . $_SESSION['id_emp'] . "&id_cert=" . $_SESSION['id_cert'] . "&date=" . $date);
                }
            }
        }if (isset($_POST['cree_1'])) {
            if (($_POST['cert'] != "") && ($_POST['nbr'] != "")) {
                $cert = $_POST['cert'];
                $nbr = $_POST['nbr'];
                $id_emp= get_from_table("id_emp", "employee", "mat_emp", $nbr);
                    $sql = "insert into  `job`(`id_cert`,`id_emp`)  values (" . get_from_table("id_cert", "certificate", "name_cert", $cert) . ",$id_emp)";
                    if ($conn->query($sql) == TRUE) {
                        $_SESSION['confim_dept'] = "1";
                    } else {
                        $_SESSION['confim_dept'] = "0";
                    }
            } else {
                $_SESSION['confim_dept'] = "0";
            }
            header("Location: ../gestion_mession.php");
        }

        function test_conger($id_emp, $year) {
            include '../dbcon.php';
            $sql = "select*from profitier where id_emp=$id_emp and  anne='$year'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (date("Y-m-d") <= $row['date_entre']) {
                    $sql_1 = "don't insert";
                } else {
                    $sql_1 = "update";
                }
            } else {
                $sql_1 = "insert";
            }
            return $sql_1;
        }

        function delete($data) {
            include '../dbcon.php';
            if ($conn->query($data) == TRUE) {
                $_SESSION['confirm1'] = "1";
            } else {
                $_SESSION['confirm1'] = "0";
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function next_prvios($data) {
            include '../dbcon.php';
            $result = $conn->query($data);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['view_nom'] = $row['nom_emp'];
                $_SESSION['view_prenom'] = $row['prenom_emp'];
                $_SESSION['view_note'] = $row['note'];
                $_SESSION['view_adrass'] = $row['adrass'];
                $_SESSION['view_code'] = $row['code'];
                $_SESSION['view_email'] = $row['email'];
                $_SESSION['view_phone'] = $row['phone'];
                $_SESSION['view_date'] = $row['date'];
                $_SESSION['view_date_rect'] = $row['date_rect'];
                $_SESSION['view_id_role'] = $row['id_role'];
                $_SESSION['view_lien_ns'] = $row['lien_ns'];
                $_SESSION['view_grade'] = $row['id_grade'];
                $_SESSION['view_deplome'] = $row['id_deplome'];
                $_SESSION['view_gener'] = $row['gener'];
                $_SESSION['view_id_emp'] = $row['id_emp'];
            }
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
            if (empty($_POST["nom"])) {
                $_SESSION['nameErr'] = "ادحل اسم الاول";
            } else {
                if (preg_match("/^[0-9]*$/", $_SESSION['nom'])) {
                    $_SESSION['nameErr'] = "اسم خاطئ";
                }
                $_SESSION['nameErr'] = "";
                $_SESSION['nom'] = test_input($_POST["nom"]);
            }

            if (empty($_POST["prenom"])) {
                $_SESSION['prenameErr'] = "ادحل اسم العائلة";
            } else {
                $_SESSION['prename'] = test_input($_POST["prenom"]);
                if (preg_match("/^[0-9]*$/", $_SESSION['prename'])) {
                    $_SESSION['prenameErr'] = "اسم العائلة خاطئ";
                }
                $_SESSION['prenameErr'] = "";
            }

            if (empty($_POST["email"])) {
                $_SESSION['emailErr'] = "ادخل اميل";
            } else {
                if (!preg_match("#^[a-z0-9-A-Z._-]+@(gmail|yahoo)\.(com|fr|dz)$#", $_POST["email"])) {
                    $_SESSION['emailErr'] = "ادحال خاطئ";
                } else {
                    $_SESSION['email'] = test_input($_POST["email"]);
                    $_SESSION['emailErr'] = "";
                }
            }

            if (empty($_POST["phone"])) {
                $_SESSION['phoneErr'] = "ادخل رقم الهاتف";
            } else {
                if ((strlen($_POST['phone']) - substr_count($_POST['phone'], " ") != 10)) {
                    $_SESSION['phoneErr'] = "ادحال خاطئ";
                } else {
                    $_SESSION['phone'] = test_input($_POST["phone"]);
                    $_SESSION['phoneErr'] = "";
                }
            }


            if (empty($_POST["radio"])) {
                $_SESSION['genderErr'] = "ماهو جنسك";
            } else {
                $_SESSION['gender'] = test_input($_POST["radio"]);
                $_SESSION['genderErr'] = "";
            }
            if (empty($_POST["adrass"])) {
                $_SESSION['adrassErr'] = "اين تسكن";
            } else {
                $_SESSION['adrass'] = test_input($_POST["adrass"]);
                $_SESSION['adrassErr'] = "";
            }
            if (empty($_POST["lieu_ns"])) {
                $_SESSION['lien_nsErr'] = "اين ولدت";
            } else {
                $_SESSION['lien_ns'] = test_input($_POST["lieu_ns"]);
                $_SESSION['lien_nsErr'] = "";
            }

            if (empty($_POST["note"])) {
                $_SESSION['noterErr'] = "ادخل تقيما";
            } else {
                $_SESSION['noterErr'] = "";
                $_SESSION['note'] = test_input($_POST["note"]);
            }


            if (empty($_POST["date"])) {
                $_SESSION['daterErr'] = "ماهوتاريخ ميلادك";
            } else {
                $_SESSION['date'] = test_input($_POST["date"]);
            }

            if (empty($_POST["date_rect"])) {
                $_SESSION['date1rErr'] = "متى التحقت بالعمل";
            } else {
                $_SESSION['date1rErr'] = "";
                $_SESSION['date1'] = test_input($_POST["date_rect"]);
            }

            if (empty($_POST["code"])) {
                $_SESSION['codeErr'] = "أدخل كلمة السر";
            } else {
                if (strlen($_POST["code"]) < 5) {
                    $_SESSION['codeErr'] = "كلمة السر غير آمنة";
                } else {
                    $_SESSION['code'] = test_input($_POST["code"]);
                }
            }
        }

        function arabicNumber($num) {

            $div = floor($num / 10);
            $mod = $num - $div * 10;

            $part1 = array('واحد', 'اثنان', 'ثلاثة', 'اربعة', 'خمسة', 'ستة', 'سبعة', 'ثمانية', 'تسعة');

            $part2 = array('عشر', 'عشرون', 'ثلاثون', 'اربعون', 'خمسون', 'ستون', 'سبعون', 'ثمانون', 'تسعون');

            if ($div == 1) {
                if ($mod == 1) {
                    $num = "احدا عشر يوم";
                } else if ($mod == 2) {
                    $num = "اثناعشر يوم";
                } else {
                    $num = $part1[$mod - 1] . "" . $part2[0] . "يوم";
                }
            } else if ($div > 1) {
                if ($mod != 0) {
                    $num = $part1[$mode - 1] . "و" . $part2[0] . "يوم";
                } ELSE {
                    $num = $part2[$div - 1] . " " . "يوم";
                }
            } elseif ($div < 1) {
                if ($mod == 1) {
                    $num = "يوم واحد";
                } elseif ($mod == 2) {
                    $num = "يومان";
                } else {
                    $num = $part1[$mode - 1] . "ايام";
                }
            }

            return $num;
        }
        ?>
    </body>
</html>