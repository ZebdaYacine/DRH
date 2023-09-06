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
            
            function delet_conger(d) {
                if (confirm("هل تريد الحذف")) {
                    window.location.href = "gestion_conger.php?id_conger=" + d;
                }
            }
            
        </script>
        <?php
        error_reporting(0);
        include 'dbcon.php';
        include 'navbar.php';
        if (isset($_GET['id_conger'])) {
            $id = $_GET['id_conger'];
            $sql1 = "delete from  conger  WHERE id_conger='$id'";
            if ($conn->query($sql1) === TRUE) {
                header('Location: gestion_conger.php');
            }
        }
        if ($_SESSION['idr'] != 4) {
            header("Location: mypage.php");
        }
            $title = "اضافة عطلة";
        
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
                                <a class="nav-link" href="gestion_fonction.php">المهام</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="gestion_deplome.php">الشهادات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#">الترقيات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="gestion_conger.php">العطل</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body" style="max-height: 400px;min-height: 400px;overflow: auto">

                        <div class="row justify-content-center" >
                            <div class="col-11">
                                <div class="card">
                                    <div class="card-header bg-secondary">
                                        <center><h5 class="h5 text-light"> العطل المسجلة</h5></center>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-hover table-bordered">
                                            <?php
                                            
                                                $sql1 = "select*from holiday ";
                                                $result = $conn->query($sql1);
                                                if ($result->num_rows > 0) {
                                                    echo'<th scope = "col" class="text-center">العطلة</th>';
                                                    echo'<th scope = "col" class="text-center">النوع</th>';
                                                    echo'<th scope = "col" class="text-center"> عدد الايام</th>';
                                                    echo'<th scope = "col" class="text-center">تعديل</th>';
                                                    echo'<th scope = "col" class="text-center">حذف</th>';
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo'<td>' . $row["id_hold"] . '</td>';
                                                        echo'<td>' . $row["type_hold"] . '</td>';
                                                        echo'<td>' . $row["nomber_days"] . '</td>';
                                                        echo'<td><button type="button" class = "btn btn-link ed" id="' . $row["id_conger"] . '" ><i class = "fas fa-pencil-alt"></i></button></td>';
                                                        $id_conger = $row["id_conger"];
                                                        echo'<td><button class = "btn btn-link" onclick = "delet_conger(' . $id_conger . ')"><i class = "far fa-trash-alt"></i></button></td>';
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

                        <a href="#" data-toggle="modal" data-target="#count4"><i class="fas fa-plus-circle fa-1x " style="color: #17a2b8">&nbsp&nbsp<?php echo $title; ?></i></a>

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
                $('#cree4').click(function (event) {
                    event.preventDefault();
                    var typec = $('#typec').val();
                    var jours = $("#nbr_jour").val();
                    var page = "conger";
                    $.ajax({
                        url: "inscripition.php",
                        method: "POST",
                        data: {page: page, jours: jours, typec: typec},
                        success: function (data) {

                            if (data === "0")
                                alert("حدث خطا قي التسجيل");
                            else
                                alert("تسجيل ناجح");
                        }
                    });
                });
                $(".ed").click(function () {
                    var id_conger = $(this).attr("id");
                    $.ajax({
                        url: "fech.php",
                        method: "POST",
                        data: {id_conger: id_conger, d: "conger"},
                        dataType: "json",
                        success: function (data) {
                            $('#nbr_conger').val(data.id_conger);
                            $('#type_conger').val(data.type_conger);
                            $('#nbr_jour_conger').val(data.nomber_jour);
                            $('#conger_update').modal('show');
                        }
                    });
                });
               

            });

        </script>
        <div class="modal fade bd-example-modal-lg"  id="count4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title" id="exampleModalLabel">انشاء عطلة جديدة</h5>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"   method="post">
                            <div class="form-row text-right ">
                                <div class="form-group text-right col-6">
                                    <label>نوع العطلة</label>
                                    <select class="form-control" name="typec" id="typec">
                                        <option>سنوية</option>
                                        <option>استدراكية</option>
                                        <option>مرضية</option>
                                    </select>
                                </div>
                                <div class="form-group text-right col-6">
                                    <label>عدد الايام</label>
                                    <input type="text" name="nbr_jour"  id="nbr_jour" class="form-control text-right" style="height: 35px;border-radius:5px;">
                                    <span class="alert-danger"></span>
                                </div>
                            </div>
                            <div class="row justify-content-center ml-1">
                                <input type="submit" name="cree4" id="cree4" class="btn btn-primary  ml-1" value="اضافة" >
                                <button type="submit"  id="ferme" class="btn btn-secondary justify-content-center" data-dismiss="modal">Close</button>
                            </div>    
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-md"  id="conger_update" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title" id="exampleModalLabel">التغير معلمومات العطلة</h5>
                    </div>
                    <div class="modal-body">
                        <form action="update.php"   method="post">
                            <div class="form-row text-right ">
                                <div class="form-group text-right col-12">
                                    <label>رقم العطلة</label>
                                    <input type="text" name="nbr_conger"  readonly id="nbr_conger" class="form-control text-right" style="height: 35px;border-radius:5px;">
                                    <span class="alert-danger"></span>
                                </div>
                                <div class="form-group text-right col-12">
                                    <label>العطلة</label>
                                    <input type="text" name="type_conger" readonly id="type_conger" class="form-control text-right" style="height: 35px;border-radius:5px;">
                                    <span class="alert-danger"></span>
                                </div>
                                <div class="form-group text-right col-12">
                                    <label>عدد الايام</label>
                                    <input type="text" name="nbr_jour_conger"  id="nbr_jour_conger" class="form-control text-right" style="height: 35px;border-radius:5px;">
                                    <span class="alert-danger"></span>
                                </div>
                            </div>
                            <div class="row justify-content-center ml-1">
                                <input type="submit" name="update_conger" id="update_conger" class="btn btn-success  ml-1" value="تعديل" >
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
