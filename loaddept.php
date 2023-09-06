
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="css/fontawesome-all.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <script>

        function tslm_demende(d1, d2) {
            if (confirm("سيتم حذف الطلب عند التسليم هل انت متاكد من التسليم")) {
                window.location.href = "demende.php?id=2&id_emp=" + d2 + "&id_mession=" + d1;
            }
        }
        function delet_demende(d1, d2) {
            if (confirm("سيتم حذف الطلب عند التسليم هل انت متاكد من التسليم")) {
                window.location.href = "demende.php?id=2&id_emp=" + d2 + "&id_mession=" + d1;
            }
        }
        function delet_dept(d) {
            if (confirm("هل تريد الحذف")) {
                window.location.href = "gestion_dept.php?form=dept&id_dept=" + d;
            }
        }
        function delet_conger(d) {
            if (confirm("هل تريد الحذف")) {
                window.location.href = "gestion_dept.php?form=conger&id_conger=" + d;
            }
        }
        function delet_grade(d) {
            if (confirm("هل تريد الحذف")) {
                window.location.href = "gestion_dept.php?form=grade&id_grade=" + d;
            }
        }
        function delet_deplome(d) {
            if (confirm("هل تريد الحذف")) {
                window.location.href = "gestion_dept.php?form=deplome&id_deplome=" + d;
            }
        }

        function  delet_effect(d) {
            if (confirm("هل تريد الحذف")) {
                window.location.href = "Mession.php?id_emp=" + d;
            }
        }
        function delet_mession(d) {
            if (confirm("هل تريد الحذف")) {
                window.location.href = "gestion_dept.php?form=mession&id_mession=" + d;
            }
        }
    </script>
    <body class="rtl">
        <?php ?>
        <table class="table table-hover table-bordered ">

            <?php
            session_start();
            include 'dbcon.php';
            if ($path == "demende_admin") {
                $sql = "select * from Effectue ";
                $result = $conn->query($sql);
                $j = 0;
                if ($result->num_rows > 0) {
                    echo'<th scope = "col" class="text-center">الشهادة</th>';
                    echo '<th scope = "col" class="text-center">الموظف المكلف</th>';
                    echo '<th scope = "col" class="text-center">طلب الشهادة</th>';
                    echo '<th scope = "col" class="text-center">مراسلة الموظف</th>';


                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo'<td class="text-center">' . get_from_table("nom_cert", "Mission", "id_mession", $row['id_mession']) . '</td>';
                        echo'<td class="text-center">' . get_from_table("nom_emp", "empolyer", "id_emp", $row['id_emp']) . '</td>';
                        echo'<td class="text-center"><a href="cert.php?type=demende&id_cert=' . $row['id_mession'] . '&id_emp=' . $_SESSION['ide'] . '&id_empt=' . $row['id_emp'] . '"><i class="fas fa-file"></i></a></td>';
                        echo '<td class="text-center"><center><a href="#"><i class="fas fa-envelope"></i></a></center></td>';

                        echo "</tr>";
                    }
                } else {
                    echo ' <h5 class = "text-center" >المحتوى فارغ</h5>';
                }
            } elseif ($path == "demende") {
                if (get_from_table("id_dept", "empolyer", "id_emp", $_SESSION['ide']) == "" && get_from_table("type_user", "empolyer", "id_emp", $_SESSION['ide']) == "admin") {
                    $n = 1;
                    if ($_GET['id'] == 1) {
                        $sql = "select * from demende where  id_empt=" . $_SESSION['ide'] . " and  creat=0";
                    } else if ($_GET['id'] == 2) {
                        $sql = "select * from demende where id_empt=" . $_SESSION['ide'] . " and   creat!=0 ";
                    }
                } else {
                    if ($titel == "قائمة الطلبات") {
                        $sql = "select*from demende where id_emp=" . $_SESSION['ide'];
                    } else {
                        $sql = "select * from Effectue ";
                    }
                    $n = 0;
                }
                $result = $conn->query($sql);
                $j = 0;
                if ($result->num_rows > 0) {
                    echo'<th scope = "col" class="text-center">الشهادة</th>';
                    if (get_from_table("id_dept", "empolyer", "id_emp", $_SESSION['ide']) == "" && get_from_table("type_user", "empolyer", "id_emp", $_SESSION['ide']) == "admin") {
                        echo'
                        <th scope = "col" class="text-center">اسم الموظف </th>
                        <th scope = "col" class="text-center">مكان العمل</th>
                        <th scope = "col" class="text-center">الدرجة</th>';
                        echo '<th scope = "col" class="text-center">التاريخ</th>';
                        if ($titel != "قائمة الطلبات") {
                            echo '<th scope = "col" class="text-center">انجاز الطلب</th>';
                        }

                        echo '<th scope = "col" class="text-center">مراسلة المستخدم</th>';
                        if ($titel == "قائمة الطلبات") {
                            echo '<th scope = "col" class="text-center">حالة الطلب</th>';
                        }
                    } else {
                        echo '<th scope = "col" class="text-center">الموظف المكلف</th>';
                        if ($titel != "قائمة الطلبات") {
                            echo '<th scope = "col" class="text-center">طلب الشهادة</th>';
                        } else {
                            echo '<th scope = "col" class="text-center">الانجاز</th>';
                        }
                        echo '<th scope = "col" class="text-center">مراسلة الموظف</th>';
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo'<td class="text-center">' . get_from_table("nom_cert", "Mission", "id_mession", $row['id_mession']) . '</td>';
                        if ($n == 1) {
                            echo'<td class="text-center">' . get_from_table("nom_emp", "empolyer", "id_emp", $row['id_emp']) . '</td>';
                            if (get_from_table("id_dept", "empolyer", "id_emp", $row['id_emp']) != "") {
                                echo'<td class="text-center">' . get_from_table("nom_dept", "departement", "id_dept", get_from_table("id_dept", "empolyer", "id_emp", $row['id_emp'])) . '</td>';
                            } else {
                                echo'<td class="text-center">' . get_from_table("nom_facl", "faculter", "id_facl", get_from_table("id_facl", "empolyer", "id_emp", $row['id_emp'])) . '</td>';
                            }
                            echo'<td class="text-center">' . get_from_table("nom_grade", "grade", "id_grade", get_from_table("id_grade", "empolyer", "id_emp", $row['id_emp'])) . '</td>';
                            echo'<td class="text-center">' . $row['date_conger'] . '</td>';
                            if ($titel != "قائمة الطلبات") {
                                echo '<td class="text-center"><center><a href="cert.php?type=cree&id_conger=' . $row['id_conger'] . '&id_emp=' . $row['id_emp'] . '&id_cert=' . $row['id_mession'] . '&date=' . $row['date_conger'] . '"><i class="fas fa-file"></i></a></center></td>';
                            }
                            echo '<th scope = "col" class="text-center"><a href="#"><i class="fas fa-envelope"></i></a></th>';
                            if ($titel == "قائمة الطلبات") {
                                if ($row["creat"] == 0) {
                                    echo '<th scope = "col" class="text-center"><span class="badge badge-pill badge-danger" >قيد الانجاز</span></a></th>';
                                } elseif ($row["creat"] == 1) {
                                    echo '<th scope = "col" class="text-center"><span class="badge badge-pill badge-success" > تم الانجاز</span></a></th>';
                                    echo'<td><button class = "btn btn-link" onclick = "tslm_demende(' . $row['id_emp'] . ',' . $row['id_mession'] . ')">تسليم الطلب</button></td>';
                                } elseif ($row["creat"] == -1) {
                                    echo '<th scope = "col" class="text-center"><span class="badge badge-pill badge-info" >غير منجز</span></a></th>';
                                    echo'<td><button class = "btn btn-link" onclick = "delet_demende(' . $row['id_emp'] . ',' . $row['id_mession'] . ')">حذف الطلب</button></td>';
                                }
                            }
                        } elseif ($n == 0) {
                            echo'<td class="text-center">' . get_from_table("nom_emp", "empolyer", "id_emp", $row['id_emp']) . '</td>';
                            if ($titel != "قائمة الطلبات") {
                                echo'<td class="text-center"><a href="cert.php?type=demende&id_cert=' . $row['id_mession'] . '&id_emp=' . $_SESSION['ide'] . '&id_empt=' . $row['id_emp'] . '"><i class="fas fa-file"></i></a></td>';
                            } elseif ($titel == "قائمة الطلبات") {
                                if ($row["creat"] == 0) {
                                    echo '<th scope = "col" class="text-center"><span class="badge badge-pill badge-danger" >قيد الانجاز</span></a></th>';
                                } elseif ($row["creat"] == 1) {
                                    echo '<th scope = "col" class="text-center"><span class="badge badge-pill badge-success" >تم الانجاز</span></a></th>';
                                } elseif ($row["creat"] == -1) {
                                    echo '<th scope = "col" class="text-center"><span class="badge badge-pill badge-info" >غير منجز</span></a></th>';
                                }
                            }
                            echo '<td class="text-center"><center><a href="#"><i class="fas fa-envelope"></i></a></center></td>';
                        }
                        echo "</tr>";
                        $j++;
                    }
                } else {
                    echo ' <h5 class = "text-center" >المحتوى فارغ</h5>';
                }
            } elseif ($path == "place") {

                $n = $_REQUEST['page'];

                if ($_SESSION['type'] == "admin") {
                    $class = "admin";
                } elseif ($_SESSION['type'] == "prof") {
                    $class = "pidagogie";
                }
                $sql3 = "select*from grade ";
                $result = $conn->query($sql3);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo'<option>' . $row['nom_grade'] . '</option>';
                    }
                }
            } elseif ($path == "admin") {
                set_user("employee where type_user='admin' and id_dept  is null", $conn);
            } elseif ($path == "admdept") {
                set_user("employee where type_user='admin' and id_dept is not null", $conn);
            } elseif ($path == "agoin") {
                set_user("employee where type_user='agoin'", $conn);
            } elseif ($path == "idm") {
                set_user("employee where type_user='contrat'", $conn);
            } elseif ($path == "conger_user") {


                $sql1 = "select*from profitier";
                $result = $conn->query($sql1);
                if ($result->num_rows > 0) {
                    echo'<th scope = "col" >الاسم</th>';
                    echo'<th scope = "col">اللقب</th>';
                    echo'<th scope = "col">العطلة</th>';
                    echo'<th scope = "col">عدد الايام</th>';
                    echo'<th scope = "col">تاريخ المنح</th>';
                    echo'<th scope = "col">تاريخ العودة</th>';
                    echo'<th scope = "col">طبع الوثيقة</th>';
                    echo'<th scope = "col">الالتزام بالمواعيد</th>';
                    echo'<th scope = "col">قطع العطلة</th>';
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo'<td>' . get_from_table("nom_emp", "empolyer", "id_emp", $row["id_emp"]) . '</td>';
                        echo'<td>' . get_from_table("prenom_emp", "empolyer", "id_emp", $row["id_emp"]) . '</td>';
                        echo'<td>' . get_from_table("type_conger", "conger", "id_conger", $row["id_conger"]) . '</td>';
                        echo'<td>' . $row['nbr_total'] . '</td>';
                        echo'<td>' . $row['date_sortie'] . '</td>';
                        echo'<td>' . $row['date_entre'] . '</td>';
                        echo'<td><a href = "imprimerPDF.php' . '?id=' . $row["id_emp"] . '&type=print_conger"><center><i class = "fas fa-file-powerpoint"></i></center></a></td>';
                        if (date("Y-m-d") == $row['date_entre']) {
                            echo'<td><span class = "badge badge-success badge-pill mr-5" >انتهاء العطلة</span></td>';
                        } elseif (date("Y-m-d") < $row['date_entre']) {
                            echo'<td><span class = "badge badge-primary badge-pill mr-5" ><small>قي عطلة</small></span></td>';
                        } else {
                            echo'<td><span class = "badge badge-danger badge-pill mr-5" >تاخر في تاكيد العودة<small></small></span></td>';
                        }
                        if (get_from_table("type_conger", "conger", "id_conger", $row["id_conger"]) == "سنوية") {
                            echo'<td><a href = "imprimerPDF.php' . '?id=' . $row["id_emp"] . '&type=couper_conger&date_return=' . $row['date_entre'] . '&type_conger=' . get_from_table("type_conger", "conger", "id_conger", $row["id_conger"]) . '"><center><i class = "fas fa-cut"></i></center></a></td>';
                        }
                        echo "</tr>";
                    }
                } else {
                    echo ' <h5 class = "text-center" >المحتوى فارغ</h5>';
                }
            } elseif ($path == "mession") {
                
            }

            function get_nom_facl($n) {
                include 'dbcon.php';
                $sql0 = "select nom_facl from faculter where id_facl =  $n ";
                $result = $conn->query($sql0);
                $row = $result->fetch_assoc();
                $nom_facl = $row["nom_facl"];

                return $nom_facl;
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

            function set_user($data, $conn) {

                $sql1 = "select*from $data ";
                $result = $conn->query($sql1);
                if ($result->num_rows > 0) {
                    echo'<th scope = "col" >الرقم التسلسلي</th>';
                    echo'<th scope = "col" >اسم</th>';
                    echo'<th scope = "col" >القب</th>';
                    echo'<th scope = "col" >الدرجة</th>';
                    echo'<th scope = "col" >الشهادة</th>';
                    echo'<th scope = "col">اظهار</th>';
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo'<td>' . $row["mat_emp"] . '</td>';
                        echo'<td>' . $row["first_name"] . '</td>';
                        echo'<td>' . $row["last_name"] . '</td>';
                        echo'<td>' . get_from_table("name_grade", "grade", "id_grade", $row["id_grade"]) . '</td>';
                        echo'<td>' . get_from_table("name_diploma", "Diploma", "id_diploma", $row["id_diploma"]) . '</td>';
                        echo'<td><a href = "view_profile.php' . '?id=' . $row["id_emp"] . '"><i class = "fas  fa-pencil-alt"></i><a></td>';
                        echo "</tr>";
                    }
                } else {
                    echo ' <h5 class = "text-center" >المحتوى فارغ</h5>';
                }
            }
            ?>
        </table>


    </body>
</html>