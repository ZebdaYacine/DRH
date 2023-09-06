<!doctype html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

    </head>

    <body class="rtl jumbotron">
        <script>
            function delet_mes(e,m) {
                if (confirm("هل تريد الحذف ")) {
                    window.location.href = "gestion_mession.php?id_emp="+e+"&id_cert="+m;
                }
            }
        </script>
        <?php
        error_reporting(0);
        include 'dbcon.php';
        include 'navbar.php';
        if ($_SESSION['confim_dept'] == "1") {
            echo "<script>alert('تم التسجيل بنجاح')</script>";
            $_SESSION['confim_dept'] = "";
        } elseif ($_SESSION['confim_dept'] == "0") {
            echo "<script>alert('لم يتم التسجيل المهمة')</script>";
            $_SESSION['confim_dept'] = "";
        }
        if ((isset($_GET['id_emp'])) && (isset($_GET['id_cert']))) {
            $ide = $_GET['id_emp'];
            $idm = $_GET['id_cert'];
            $sql1 = "delete from  Effectue  WHERE id_emp=$ide and id_cert=$idm";
            if ($conn->query($sql1) === TRUE) {
                header('Location: gestion_mession.php');
            }
        }
        if ($_SESSION['idr'] != 4) {
            header("Location: mypage.php");
        }
        $title = "اضافة مهمة";
        $target = "";
        $title1 = "المهام المسجلة";
        ?>
        <div class="row">
            <div class="col-1"></div>
            <div class="text-center col-10">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="gestion_dept.php">اقسام الكلية</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="gestion_grade.php">درجات العمل</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="gestion_fonction.php">المهام</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="gestion_deplome.php">الشهادات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#">الترقيات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="gestion_conger.php">العطل</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body" style="max-height: 400px;min-height: 400px;overflow: auto">

                        <div class="row justify-content-center" >
                            <div class="col-11">
                                <div class="card">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs card-header-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link" href="gestion_fonction.php">المهام المسجلة</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" href="gestion_mession.php">تحديد مهمة</a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-hover table-bordered">
                                            <?php
                                            $sql = "select*from job";

                                            $result = $conn->query($sql);
                                            $n = "";
                                            $j = 0;
                                            if ($result->num_rows > 0) {
                                                echo'
                                            <th scope = "col" class="text-center">الشهادة</th>';
                                                echo'
                                            <th scope = "col" class="text-center">اسم الموظف</th>';
                                                echo'
                                            <th scope = "col" class="text-center">حذف</th>';

                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo'<td>' . get_from_table("name_cert", "certificate", "id_cert", $row['id_cert']) . '</td>';
                                                    echo'<td>' . get_from_table("first_name", "employee", "id_emp", $row['id_emp']) . '</td>';
                                                    echo'<td><button class = "btn btn-link" onclick = "delet_mes(' . $row['id_emp'] . ',' . $row['id_cert'] . ')"><i class = "far fa-trash-alt"></i></button></td>';
                                                    echo "</tr>";
                                                    $j++;
                                                }
                                            } else {
                                                echo ' <h5 class = "text-center" >المحتوى فارغ</h5>';
                                            }
                                            ?>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="card-footer text-center">

                        <a href="#" data-toggle="modal" data-target="#count"><i class="fas fa-plus-circle fa-1x " style="color: #17a2b8">&nbsp&nbspتحديد مهمة</i></a>

                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $("input").focus(function () {
                    $(this).css("background-color", "#cccccc");
                    $(this).css("border-color", "#ffffff");
                });
                $('#ferme').click(function () {
                    document.getElementById("name").value = "";
                    document.getElementById("prename").value = "";
                    document.getElementById("code").value = "";
                    document.getElementById("phone_email").value = "";
                    document.getElementById("date").value = "";
                    document.getElementById("radio").value = "";
                });

                $("input").blur(function () {
                    $(this).css("background-color", "#ffffff");
                    if ($(this).val() === "") {
                        $(this).css("border-color", "#FF0000");
                    } else {
                        $(this).css("border-color", "#ced3d9");
                    }

                });

            });
        </script>




        <div class="modal fade bd-example-modal-lg"  id="count" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title" id="exampleModalLabel">مهمة جديدة</h5>
                    </div>
                    <div class="modal-body">
                        <form action="users/ins.php"   method="post">
                            <div class="form-row text-right">
                                <div class="form-group col-md-6">
                                    <lable>الشهادة</lable>
                                    <select class="form-control" name="cert" id="cert">
                                        <option></option>
                                        <?php
                                        $sql3 = "select*from certificate";
                                        $result = $conn->query($sql3);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo'<option>' . $row['name_cert'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <lable>الرقم التسلسلي</lable>
                                    <input type="text" class="form-control text-right" name="nbr" id="nbr" >
                                </div>
                            </div>
                            <div class="form-row text-right">
                                <div class="form-group col-md-6">
                                    <lable>الاسم</lable>
                                    <select class="form-control" name="name" id="name">

                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <lable>اللقب</lable>
                                    <select class="form-control" name="prename" id="prename">

                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-center ml-1">
                                <input type="submit" name="cree_1" id="cree_1" class="btn btn-primary  ml-1" value="اضافة" >
                                <button type="submit"  id="ferme" class="btn btn-secondary justify-content-center" data-dismiss="modal">Close</button>
                            </div>    
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('#nbr').keyup(function (event) {
                    event.preventDefault();
                    var page = $('#nbr').val();
                    $('#name').load('inscripition.php', {path: page, type: '7', att: 'name'});
                    $('#prename').load('inscripition.php', {path: page, type: '7', att: 'prename'});

                });

            });

        </script>

        <?php

        function get_name_facl($n) {
            include 'dbcon.php';
            $sql0 = 'select name_facl from faculter where id_facl = "' . $n . '"';
            $result = $conn->query($sql0);
            $row = $result->fetch_assoc();
            $name_facl = $row["name_facl"];

            return $name_facl;
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
        ?>

    </body>
</html>
