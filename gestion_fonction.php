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
            function delet_fonction(d) {
                if (confirm("هل تريد الحذف")) {
                    window.location.href = "gestion_fonction.php?id_cert=" + d;
                }
            }
        </script>
        <?php
        error_reporting(0);
        include 'dbcon.php';
        include 'navbar.php';
        if (isset($_GET['id_mession'])) {
            $id_mession = $_GET['id_mession'];
            $sql1 = "delete from  certificate  WHERE id_cert='$id_mession'";
            if ($conn->query($sql1) === TRUE) {
                header('Location: gestion_fonction.php');
            }
        }
        if ($_SESSION['idr'] != 4) {
            header("Location: mypage.php");
        }
        $_SESSION['t'] = $_GET['form'];
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
                                                <a class="nav-link active" href="gestion_fonction.php">المهام المسجلة</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="gestion_mession.php">تحديد مهمة</a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-hover table-bordered">
                                            <?php
                                            $sql = "select * from certificate";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                echo'<th scope = "col" class="text-center">المهمة</th>';
                                                echo'<th scope = "col" class="text-center">تعديل</th>';
                                                echo'<th scope = "col" class="text-center">حذف</th>';
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo'<td>' . $row["name_cert"] . '</td>';
                                                    echo'<td><button type="button" class = "btn btn-link edit_data" id="' . $row["id_cert"] . '" ><i class = "fas fa-pencil-alt"></i></button></td>';
                                                    $id_mession = $row["id_cert"];
                                                    echo'<td><button class = "btn btn-link" onclick = "delet_fonction(' . $id_mession . ')"><i class = "far fa-trash-alt"></i></button></td>';
                                                    echo "</tr>";
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

                        <a href="#" data-toggle="modal" data-target="#count3"><i class="fas fa-plus-circle fa-1x " style="color: #17a2b8">&nbsp&nbsp<?php echo $title; ?></i></a>

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
                    document.getElementById("nom").value = "";
                    document.getElementById("prenom").value = "";
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
            $(document).ready(function () {

                $('#cree3').click(function (event) {
                    event.preventDefault();
                    var nom = $('#nom3').val();
                    var page = "fonction";
                    $.ajax({
                        url: "inscripition.php",
                        method: "POST",
                        data: {page: page, nom: nom},
                        success: function (data) {

                            if (data === "0") {
                                alert("حدث خطا في التسجيل");
                            } else {
                                alert("تسجيل ناجح");
                            }
                        }
                    });
                });


            });
            $(".edit_data").click(function () {
                var id_cert = $(this).attr("id");
                $.ajax({
                    url: "fech.php",
                    method: "POST",
                    data: {id_cert: id_cert, d: "cert"},
                    dataType: "json",
                    success: function (data) {
                        $('#cert').val(data.name_cert);
                        $('#id_cert').val(data.id_cert);
                        $('#update_cert').modal('show');

                    }
                });
            });

        </script>




        <div class="modal fade bd-example-modal-lg"  id="count3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title" id="exampleModalLabel">اضافة وظيفة جديدة</h5>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"   method="post">
                            <div class="form-row text-right">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control text-right" name="nom3" id="nom3" placeholder="اسم الوظيفة">
                                    <span class="alert-danger"><?php echo $nameErr ?></span>
                                </div>
                            </div>
                            <div class="row justify-content-center ml-1">
                                <input type="submit" name="cree3" id="cree3" class="btn btn-primary  ml-1" value="اضافة كلية" >
                                <button type="submit"  id="ferme" class="btn btn-secondary justify-content-center" data-dismiss="modal">Close</button>
                            </div>    
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-md"  id="update_cert" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل معلومات الوثائق</h5>
                    </div>
                    <div class="modal-body">
                        <form action="update.php"   method="post">
                            <div class="form-row text-right">
                                <div class="form-group col-md-12">
                                    <lable>الرقم</lable>
                                    <input class="form-control" readonly   name="id_cert" id="id_cert">
                                </div> 
                                <div class="form-group col-md-12">
                                    <lable>الوثيقة</lable>
                                    <input class="form-control"    name="cert" id="cert">
                                </div>                              
                            </div>
                            <div class="row justify-content-center ml-1">
                                <input type="submit" name="update_cert" id="update_cert" class="btn btn-success  ml-1" value="تعديل" >
                                <button type="submit"  id="ferme" class="btn btn-secondary justify-content-center" data-dismiss="modal">الغاء</button>
                            </div>    
                        </form>
                    </div>

                </div>
            </div>
        </div>


        <?php

        function get_nom_facl($n) {
            include 'dbcon.php';
            $sql0 = 'select nom_facl from faculter where id_facl = "' . $n . '"';
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
        ?>

    </body>
</html>
