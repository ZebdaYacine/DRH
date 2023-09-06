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
            function delet_grade(d) {
                if (confirm("هل تريد الحذف")) {
                    window.location.href = "gestion_grade.php?id_grade=" + d;
                }
            }
        </script>
        <?php
        error_reporting(0);
        include 'dbcon.php';
        include 'navbar.php';
        if (isset($_GET['id_grade'])) {
            $id = $_GET['id_grade'];
            $sql1 = "delete from  grade  WHERE id_grade='$id'";
            if ($conn->query($sql1) === TRUE) {
                header('Location: gestion_grade.php');
            }
        }
        if ($_SESSION['idr'] != 4) {
            header("Location: mypage.php");
        }
        $title = "اضافة درجة";
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
                                <a class="nav-link active" href="gestion_grade.php">درجات العمل</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="gestion_fonction.php">المهام</a>
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
                                    <div class="card-header bg-warning">
                                        <center><h5 class="h5 text-light">الدرجات المسجلة</h5></center>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-hover table-bordered">
                                            <?php
                                            $sql = "select * from grade";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                echo'<th scope = "col" class="text-center" >الدرجة</th>';
                                                echo'<th scope = "col" class="text-center">خاص بـ</th>';
                                                echo'<th scope = "col" class="text-center">الشهادة المطلوبة</th>';
                                                echo'<th scope = "col" class="text-center">النوع</th>';
                                                echo'<th scope = "col"class="text-center">تعديل</th>';
                                                echo'<th scope = "col"class="text-center">حذف</th>';
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo'<td>' . $row["name_grade"] . '</td>';
                                                    echo'<td>' . $row["special"] . '</td>';
                                                    echo'<td>' . get_from_table("name_diploma", "Diploma", "id_diploma", $row['id_diploma']) . '</td>';
                                                    echo'<td>' . $row["type"] . '</td>';
                                                    echo'<td><button type="button" class = "btn btn-link grade" id="' . $row["id_grade"] . '" ><i class = "fas fa-pencil-alt"></i></button></td>';
                                                    $id_grade = $row["id_grade"];
                                                    echo'<td><button class = "btn btn-link" onclick = "delet_grade(' . $id_grade . ')"><i class = "far fa-trash-alt"></i></button></td>';
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

                        <a href="#" data-toggle="modal" data-target="#count2"><i class="fas fa-plus-circle fa-1x " style="color: #17a2b8">&nbsp&nbsp<?php echo $title; ?></i></a>

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

                $('#cree2').click(function (event) {
                    event.preventDefault();
                    var nom = $('#nom2').val();
                    var special = $('#special').val();
                    var deplome = $("#deplome").val();
                    var typeg = $("#typeg").val();
                    var page1 = "grade";
                    $.ajax({
                        url: "inscripition.php",
                        method: "POST",
                        data: {page1: page1, nom: nom, special: special, deplome: deplome, typeg: typeg},
                        success: function (data) {

                            if (data === "0")
                                alert("حدث خطا قي التسجيل");
                            else
                                alert("تسجيل ناجح");
                        }
                    });
                });

                $(".grade").click(function () {
                    var id_grade = $(this).attr("id");
                    $.ajax({
                        url: "fech.php",
                        method: "POST",
                        data: {id_grade: id_grade, d: "grade"},
                        dataType: "json",
                        success: function (data) {
                            $('#id_grade').val(data.id_grade);
                            $('#nom_grade').val(data.name_grade);
                            $('#spel_grade').val(data.special);
                            $('#type_grade').val(data.type);
                            $('#nom_dpl').val(data.id_diploma);
                            $('#update_grade').modal('show');
                        }
                    });
                });

            });

        </script>

        <div class="modal fade bd-example-modal-lg"  id="count2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title" id="exampleModalLabel">اظافة رتبة</h5>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"   method="post">
                            <div class="form-row text-right">
                                <div class="form-group col-6">
                                    <label>الرتب الادارية</label>
                                    <input type="text" class="form-control" name="nom2" id="nom2">
                                </div>

                                <div class="form-group text-right col-6 ">
                                    <label>خاص بـ</label>
                                    <select class="form-control" id="special">
                                        <option>الكلية</option>
                                        <option>الاقسام</option> 
                                    </select>
                                </div>

                                <div class="form-group text-right col-6 ">
                                    <label>نوع الرتبة</label>
                                    <select class="form-control" id="typeg">
                                        <option>admin</option>
                                        <option>pidagogie</option>
                                        <option>agoin</option>
                                        <option>contrat</option>
                                    </select>
                                </div>
                                <div class="form-group text-right col-6  ">
                                    <label>الشهادة المطلوبة</label>
                                    <select class="form-control" id="deplome">
                                        <?php
                                        $sql3 = "select name_diploma from Diploma";
                                        $result = $conn->query($sql3);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo'<option>' . $row['name_diploma'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>

                            <div class="row justify-content-center ml-1">
                                <input type="submit" name="cree2" id="cree2" class="btn btn-primary  ml-1" value="اضافة" >
                                <button type="submit"  id="ferme" class="btn btn-secondary justify-content-center" data-dismiss="modal">Close</button>
                            </div>    
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-md"  id="update_grade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل معلومات الرتبة</h5>
                    </div>
                    <div class="modal-body">
                        <form action="update.php"    method="post">
                            <div class="form-row text-right">
                                <div class="form-group col-12">
                                    <label>رقم الرتبة</label>
                                    <input type="text" class="form-control" readonly name="id_grade" id="id_grade">
                                </div>

                                <div class="form-group col-12">
                                    <label>الرتب الادارية</label>
                                    <input type="text" class="form-control" name="nom_grade" id="nom_grade">
                                </div>

                                <div class="form-group text-right col-12 ">
                                    <label>خاص بـ</label>
                                    <input type="text" class="form-control" id="spel_grade" name="grade_spl">
                                </div>

                                <div class="form-group text-right col-12 ">
                                    <label>نوع الرتبة</label>
                                    <input type="text" class="form-control" id="type_grade" name="grade_type">
                                </div>
                                <div class="form-group text-right col-12">
                                    <label>تغير الشهادة</label>
                                    <select class="form-control" name="nom_dpl">
                                        <option></option>
                                        <?php
                                        $sql3 = "select name_diploma from Diploma";
                                        $result = $conn->query($sql3);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo'<option>' . $row['name_diploma'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>                                
                                </div>
                            </div>

                            <div class="row justify-content-center ml-1">
                                <input type="submit" name="update_grade" id="update_grade" class="btn btn-success  ml-1" value="تعديل" >
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
