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
            function delet_dept(d) {
                if (confirm("هل تريد الحذف")) {
                    window.location.href = "gestion_dept.php?id_dept=" + d;
                }
            }
        </script>
        <?php
        error_reporting(0);
        include 'dbcon.php';
        include 'navbar.php';
        if (isset($_GET['id_dept'])) {
            $id = $_GET['id_dept'];
            $sql1 = "delete from  department  WHERE id_dept='$id'";
            if ($conn->query($sql1) === TRUE) {
                header('Location: gestion_dept.php');
            }
        }
        if ($_SESSION['idr'] != 4) {
            header("Location: mypage.php");
        }
            $title = "اضافة قسم";
       
        ?>
        <div class="row">
            <div class="col-1"></div>
            <div class="text-center col-10">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="gestion_dept.php">اقسام الكلية</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="gestion_grade.php">درجات العمل</a>
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
                                    <div class="card-header bg-info">
                                        <center><h5 class="h5 text-light"> الاقسام المسجلة</h5></center>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-hover table-bordered">
                                            <?php
                                                $sql = "select*from department";
                                                $result = $conn->query($sql);
                                                $j = 0;
                                                if ($result->num_rows > 0) {
                                                    echo'<th scope = "col" class="text-center">الكلية</th>
                                                         <th scope = "col" class="text-center">القسم</th>';
                                                    echo'<th scope = "col"class="text-center">تعديل</th>';
                                                    echo'<th scope = "col"class="text-center">حذف</th>';
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        $id_facl = $row["id_facl"];
                                                        echo'<td>' . get_nom_facl($id_facl) . '</td>';
                                                        echo'<td>' . $row["name_dept"] . '</td>';
                                                        echo'<td><button type="button" class = "btn btn-link edit_data" id="' . $row["id_dept"] . '" ><i class = "fas fa-pencil-alt"></i></button></td>';
                                                        $id_dept = $row["id_dept"];
                                                        echo'<td><button class = "btn btn-link" onclick = "delet_dept(' . $id_dept . ')"><i class = "far fa-trash-alt"></i></button></td>';
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

                        <a href="#" data-toggle="modal" data-target="#count"><i class="fas fa-plus-circle fa-1x " style="color: #17a2b8">&nbsp&nbsp<?php echo $title; ?></i></a>

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
                $('#cree').click(function (event) {
                    event.preventDefault();
                    var nom = $('#nom').val();
                    var prenom = $("#prenom").val();
                    var page = "dept";
                    $.ajax({
                        url: "inscripition.php",
                        method: "POST",
                        data: {page: page, prenom: prenom, nom: nom},
                        success: function (data) {
                            if (data === "0")
                                alert("حدث خطا قي التسجيل");
                            else
                                alert("تسجيل ناجح");
                        }
                    });
                });
           
                $(".edit_data").click(function () {
                    var id_dept = $(this).attr("id");
                    $.ajax({
                        url: "fech.php",
                        method: "POST",
                        data: {id_dept: id_dept, d: "dept"},
                        dataType: "json",
                        success: function (data) {
                            $('#id_dept').val(data.id_dept);
                            $('#dept').val(data.name_dept);
                            $('#update_dept').modal('show');
                        }
                    });
                });
                

            });

            
           
        </script>

        <div class="modal fade bd-example-modal-lg"  id="count" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title" id="exampleModalLabel">إضافة قسم</h5>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"   method="post">
                            <div class="form-row text-right">
                                <div class="form-group col-md-6">
                                    <lable>الكلية</lable>
                                    <select class="form-control" name="prenom" id="prenom">
                                        <option></option>
                                        <?php
                                        $sql3 = "select * from faculty";
                                        $result = $conn->query($sql3);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo'<option>' . $row['name_facl'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <lable>القسم</lable>
                                    <input type="text" class="form-control text-right" name="nom" id="nom" >
                                </div>
                            </div>
                            <div class="row justify-content-center ml-1">
                                <input type="submit" name="cree" id="cree" class="btn btn-primary  ml-1" value="اضافة" >
                                <button type="submit"  id="ferme" class="btn btn-secondary justify-content-center" data-dismiss="modal">Close</button>
                            </div>    
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-md"  id="update_dept" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل معلومات الكلية</h5>
                    </div>
                    <div class="modal-body">
                        <form action="update.php"   method="post">
                            <div class="form-row text-right">
                                
                                <div class="form-group col-md-12">
                                    <lable>رقم القسم</lable>
                                    <input class="form-control" readonly   name="id_dept" id="id_dept">
                                </div>
                                <div class="form-group col-md-12">
                                    <lable>القسم</lable>
                                    <input type="text" class="form-control text-right" name="dept" id="dept" >
                                </div>
                            </div>
                            <div class="row justify-content-center ml-1">
                                <input type="submit" name="update_dept" id="update_dept" class="btn btn-success  ml-1" value="تعديل" >
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
            $sql0 = 'select name_facl from faculty where id_facl = "' . $n . '"';
            $result = $conn->query($sql0);
            $row = $result->fetch_assoc();
            $nom_facl = $row["name_facl"];

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
