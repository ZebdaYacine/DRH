<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

    </head>

    <body class="rtl jumbotron">
        <?php
        session_start();
        include 'navbar.php';
        error_reporting(0);
        include '../dbcon.php';
        $_SESSION['page'] = "view";
        $_SESSION['tp'] = "cree";
        if ($_SESSION['confirm2'] == "1") {
            echo "<script>alert('تم التعديل')</script>";
            $_SESSION['confirm2'] = "";
        } else if ($_SESSION['confirm2'] == "0") {
            echo "<script>alert('لم يتم التعديل')</script>";
            echo $_SESSION['confirm2'] = "";
        }
        $id = $_GET['id'];

        $_SESSION['delete'] = "delete";
        $_SESSION['select'] = "select";
        $_SESSION['user'] = "admin";
        $_SESSION['id_emp'] = $_GET['id'];
        $t = $t2 = "";
        $sql3 = "select*from employee where id_emp=".$id;
        $result = $conn->query($sql3);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['view_nom'] = $row['first_name'];
            $_SESSION['view_prenom'] = $row['last_name'];
            $_SESSION['view_note'] = $row['note'];
            $_SESSION['view_adrass'] = $row['address'];
            $_SESSION['view_code'] = $row['code'];
            $_SESSION['view_email'] = $row['email'];
            $_SESSION['view_phone'] = $row['phone'];
            $_SESSION['view_date'] = $row['DNS'];
            $_SESSION['view_date_rect'] = $row['date_rect'];
            $_SESSION['view_lien_ns'] = $row['LNS'];
            $_SESSION['view_grade'] = $row['id_grade'];
            $_SESSION['view_deplome'] = $row['id_diploma'];
            $_SESSION['view_gener'] = $row['gender'];
            $_SESSION['view_facl'] = $row['id_facl'];
            $_SESSION['view_role'] = $row['id_role'];
            $_SESSION['view_dept'] = $row['id_dept'];
        }
        if ($_SESSION['view_gener'] == "male") {
            $t = "checked=true";
        } else {
            $t1 = "checked=true";
        }
        $a = $_SESSION['view_dept'];
        ?>



        <div class="row ">
            <div class="col-1">

            </div>
            <div class="col-10 card mt-3">
                <center><div class="row card-header">
                        <div class="col-4">
                            <button class="btn btn-info btn-outline-info col-10" data-toggle="modal" data-target="#count1">منح عطلة</button>
                        </div>
                        <div class="col-4 ">
                            <button class="btn btn-success btn-outline-success col-10">منح ترقية</button>
                        </div>
                        <div class="col-4 ">
                            <button class="btn btn-warning btn-outline-warning col-10">الاحالة الى التقاعد</button>
                        </div>
                    </div></center>
                <div class="card-body">
                    <div class="card mt-3">
                        <div class="card-header bg-info">
                            <form class="row" method="post" enctype="multipart/form-data" action="ins.php">
                                <div class="col-lg-4">
                                    <button type="submit" name="previos" class="btn btn-default">
                                        <i class="fas fa-chevron-circle-right"></i>السابق
                                    </button>
                                </div>
                                <div class="col-lg-4 text-center">
                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $_SESSION['view_prenom'] . " " . $_SESSION['view_nom'] ?></h5>
                                </div>
                                <div class="col-lg-4 text-left">
                                    <button type="submit" name="next" class="btn btn-default ml-1">
                                        التالي<i class="fas fa-chevron-circle-left"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-body" style="background-color:#e9ecef;">
                            <form method="post" enctype="multipart/form-data" action="ins.php">
                                <h4>المعلومات الشخصية</h4>
                                <div class="form-row ">
                                    <div class="form-group col-md-8">
                                        <input type="text" value="<?php echo $_SESSION['view_prenom']; ?>" name="prenom" class="form-control " id="prenom"  placeholder="اسم العائلة">
                                        <span class="alert-danger"><?php echo $_SESSION['prenameErr'] ?></span>
                                        <input type="text" value="<?php echo $_SESSION['view_nom']; ?>" class="form-control  mt-3"  name="nom" id="nom" placeholder="الاسم الاول">
                                        <span class="alert-danger"><?php echo $_SESSION['nameErr'] ?></span>
                                        <input type="text" value="<?php echo $_SESSION['view_phone']; ?> "class="form-control  mt-3" name="phone" id="phone"  placeholder="رقم الهاتف">
                                        <span class="alert-danger"><?php echo $_SESSION['phoneErr']; ?></span>
                                        <input type="text" value="<?php echo $_SESSION['view_email']; ?>" class="form-control  mt-3" name="email" id="email"  placeholder="البريد الالكتروني">
                                        <span class="alert-danger"><?php echo $_SESSION['emailErr'] ?></span>
                                        <input type="password" value="<?php echo $_SESSION['view_code']; ?>" class="form-control  mt-3" name="code" id="code" placeholder="الرقم السري">
                                        <span class="alert-danger"><?php echo $_SESSION['codeErr']; ?></span>                
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="file" class="form-control  "   name="image" id="image">
                                        <br>
                                        <?php echo'<center><img src=img.php?id=' . $id . ' style="width:200px;height:200px"></center>'; ?>
                                    </div>

                                </div>
                                <div class="form-row ">
                                    <div class="form-group col-4">
                                        <label>تاريخ الميلاد</label>
                                        <input type="date" value="<?php echo $_SESSION['view_date']; ?>" name="date"   id="date" class="form-control" style="height: 35px;border-radius:5px;">
                                        <span class="alert-danger"><?php echo $_SESSION['daterErr'] ?></span>
                                    </div>
                                    <div class="form-group  col-4">
                                        <label>مكان الازدياد</label>
                                        <input type="text" name="lieu_ns" value="<?php echo $_SESSION['view_lien_ns']; ?>"  id="lieu_ns" class="form-control " style="height: 35px;border-radius:5px;">
                                        <span class="alert-danger"><?php echo $_SESSION['lien_nsErr'] ?></span>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>عنوان</label>
                                        <input type="text" name="adrass" value="<?php echo $_SESSION['view_adrass']; ?>"  id="adrass" class="form-control " style="height: 35px;border-radius:5px;">
                                        <span class="alert-danger"><?php echo $_SESSION['adrassErr'] ?></span>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-check">
                                        <label class="form-check-label mr-4 ml-4">
                                            ذكر
                                        </label>
                                        <input class="form-check-input ml-2 " type="radio"  name="radio" id="radio" value="masqlin" <?php echo $t; ?>>
                                        <label class="form-check-label mr-4 ml-4" >
                                            انثى
                                        </label>
                                        <input class="form-check-input " type="radio" id="radio" name="radio" value="fimina" <?php echo $t1; ?>>
                                        <span class="alert-danger mr-3"><?php echo $_SESSION['genderErr'] ?></span>
                                    </div>
                                </div>
                                <br> 
                                <h4>مكان العمل</h4>
                                <div class="row justify-content-strat">
                                    <div class="form-group col-4 ">
                                        <lable>موظف بكلية</lable>
                                        <select class="form-control" id="place_travialle" name="place_travialle">
                                            <option><?php echo get_from_table("name_facl", "faculty", "id_facl", $_SESSION['view_facl']); ?></option>
                                            <?php
                                            $sql = "select*from faculty where id_facl !=" . $_SESSION['view_facl'];
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {

                                                while ($row = $result->fetch_assoc()) {
                                                    echo'<option>' . $row['name_facl'] . '</option>';
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="form-group  col-4 ">
                                        <lable>قسم</lable>
                                        <select class="form-control" id="place_travialle1" name="place_travialle1">
                                            <option><?php echo get_from_table("name_dept", "department", "id_dept", $a); ?></option>
                                            <?php
                                            $sql = "select*from department where   id_dept!=" . $_SESSION['view_dept'];
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo'<option>' . $row['name_dept'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-4 ">
                                        <lable>بدرجة عمل</lable>
                                        <select class="form-control" name="grade" id="grade">
                                            <option><?php echo get_from_table("name_grade", "grade", "id_grade", $_SESSION['view_grade']); ?></option>
                                            <?php
                                            $grade = $_SESSION['grade'];
                                            $sql = "select*from grade where type='admin' and id_grade!=" . $_SESSION['view_grade'];
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo'<option>' . $row['name_grade'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <h4>المعلومات الادارية</h4>
                                <div class="form-row ">
                                    <div class="form-group col-3">
                                        <label>تاريح الالتحاق </label>
                                        <input type="date" value="<?php echo $_SESSION['view_date_rect']; ?>" name="date_rect" id="date_rect" class="form-control " style="height: 35px;border-radius:5px;">
                                        <span class="alert-danger"><?php echo $_SESSION['date1rErr'] ?></span>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>شهادة</label>
                                        <select class="form-control" name="deplome" id="deplome">
                                            <option><?php echo get_from_table("name_diploma", "Diploma", "id_diploma", $_SESSION['view_deplome']); ?></option>
                                            <?php
                                            $d = $_SESSION['view_deplome'];
                                            $sql = "select*from Diploma where id_diploma!=$d";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo'<option>' . $row['name_diploma'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group  col-3">
                                        <label>رصيد النقاط</label>
                                        <input type="text" name="note" value="<?php echo $_SESSION['view_note']; ?>"  id="note" class="form-control " style="height: 35px;border-radius:5px;">
                                        <span class="alert-danger"><?php echo $_SESSION['noterErr'] ?></span>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>الصلاحية</label>
                                        <select class="form-control" id="droit" name="droit">
                                            <option><?php echo get_from_table("righte", "role", "id_role", $_SESSION['view_role']) ?></option>
                                            <?php
                                            $sql = "select*from role where id_role=" . $_SESSION['view_role'];
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {

                                                while ($row = $result->fetch_assoc()) {
                                                    echo'<option>' . $row['droit'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row justify-content-center ml-1">

                                    <input type="submit" name="delete" id="cree" class="btn btn-danger btn-outline-danger ml-1" value="حذف" >
                                    <input type="submit" name="update" id="cree" class="btn btn-success btn-outline-success  ml-1" value="تعديل" >

                                </div>    
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script>window.jQuery || document.write('<script src="js/jquery-3.3.1.min.js"><\/script>');</script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>



        <script>
            $(document).ready(function () {
                var place = $('#place_travialle').val();
                /*$('#place_travialle1').load('../inscripition.php', {path: place,", type: "1"});*/
                $('#place_travialle').change(function (event) {
                    event.preventDefault();
                    var place = $('#place_travialle').val();
                    $('#place_travialle1').load('../inscripition.php', {path: place, type: "1"});
                });
                $('#grade').change(function (event) {
                    event.preventDefault();
                    var page = $('#grade').val();
                    $('#deplome').load('../inscripition.php', {path: page, type: '0'});
                });



                $('#type').change(function (event) {
                    event.preventDefault();
                    var d;
                    if ($("#type").val() === "مرضية") {
                        d = "2";
                        $("#declaration").prop("disabled", false);
                        $("#cd").prop("disabled", true);
                        $("#nbr_jour").prop("disabled", true);
                    } else {
                        $("#acord").prop("disabled", false);
                        if ($("#type").val() === "استدراكية") {
                            d = "3";
                        } else {

                            d = "1";
                        }
                        $("#declaration").prop("disabled", true);
                    }
                    var page;
                    if (d === "1") {
                        page = "<?php echo $id; ?>";
                        $('#nbr_jour').load('../inscripition.php', {path: page, type: '5'});
                    } else {
                        page = $("#type").val();
                        $('#nbr_jour').load('../inscripition.php', {path: page, type: '6'});
                    }

                });

                $('#ferme').click(function (event) {
                    event.preventDefault();
                    $('#type').val("");
                    $("#nbr_jour").val("");
                    $("#nbr_jour_total").val("");
                    $("#date").val("");
                    $("#adrass_1").val("");
                    $("#declaration").val("");
                    $("#acord").val("");
                    $("#cd").val("");
                    $("#declaration").prop("disabled", true);
                });
                $('#cree3').click(function (event) {
                    event.preventDefault();
                    $('#type').val("");
                    $("#nbr_jour").val("");
                    $("#nbr_jour_total").val("");
                    $("#date").val("");
                    $("#adrass_1").val("");
                    $("#declaration").val("");
                    $("#acord").val("");
                    $("#cd").val("");
                    $("#declaration").prop("disabled", true);
                });

                $("#declaration").keyup(function (event) {
                    $("#nbr_jour_total").val(parseInt($("#declaration").val()));
                    $("#acord").prop("disabled", true);
                });


                $("#acord").keyup(function (event) {
                    event.preventDefault();
                    if ($("#declaration").val() === "") {
                        $("#declaration").val("0");
                    }
                    if ($("#type").val() !== "مرضية") {
                        if (parseInt($("#acord").val()) <= parseInt($("#nbr_jour").val())) {
                            $("#cd").val(parseInt($("#nbr_jour").val()) - parseInt($("#acord").val()));
                            $("#nbr_jour_total").val(parseInt($("#declaration").val()) + parseInt($("#acord").val()));
                        } else {
                            alert("الايام الموافق عليها اكبر من الحجم القانوني");
                            $("#acord").val("");
                            $("#cd").val("");
                        }
                    }


                });


            });

        </script>
        <?php

        function get_from_table($n, $n1, $n2, $n3) {

            $sql0 = "select " . $n . " from " . $n1 . " where " . $n2 . " = '$n3'";
            include '../dbcon.php';
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } $result = $conn->query($sql0);
            while ($row = $result->fetch_assoc()) {
                $attr = $row["$n"];
            }
            return $attr;
        }
        ?>


        <div class="modal fade bd-example-modal-lg"  id="count1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title" id="exampleModalLabel">منح عطلة</h5>
                    </div>
                    <div class="modal-body">
                        <form action="ins.php"   method="post">
                            <div class="form-row text-right">
                                <div class="form-group col-md-6">
                                    <label>الاسم</label>
                                    <input type="text"  name="nom_1"  value="<?php echo $_SESSION['view_prenom']; ?>" class="form-control text-right" id="nom_1">
                                    <span class="alert-danger"><?php echo $_SESSION['prenameErr'] ?></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>اللقب</label>
                                    <input type="text" class="form-control text-right" value="<?php echo $_SESSION['view_nom']; ?>"  name="prenom_1" id="prenom_1">
                                    <span class="alert-danger"><?php echo $_SESSION['nameErr'] ?></span>
                                </div>
                            </div>

                            <div class="form-row text-right ">
                                <div class="form-group text-right col-4">
                                    <label>نوع العطلة</label>
                                    <select class="form-control" name="type" id="type">
                                        <option></option>
                                        <?php
                                        $sql = "select type_conger from conger";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {

                                            while ($row = $result->fetch_assoc()) {
                                                echo'<option>' . $row['type_conger'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group text-right col-4">
                                    <label>عدد الايام القانوني</label>
                                    <select class="form-control" name="nbr_jour" id="nbr_jour">

                                    </select>                            
                                </div>
                                <div class="form-group col-md-4">
                                    <label>الموافقة على منح</label>
                                    <input type="text" class="form-control text-right" disabled="true"   name="acord" id="acord">
                                </div>

                            </div>
                            <div class="form-row text-right">
                                <div class="form-group col-md-6">
                                    <label>عنوان اثناء العطلة</label>
                                    <input type="text" class="form-control text-right"   name="adrass_1" id="adrass_1">
                                </div>

                                <div class="form-group text-right col-6">
                                    <label>منحت بتاريخ</label>
                                    <input type="date" name="date_1"  id="date_1" min="<?php echo date("Y-m-d") ?>" max="<?php echo date("Y-12-31") ?>"  class="form-control text-right" style="height: 35px;border-radius:5px;">
                                    <span class="alert-danger"></span>
                                </div>
                            </div>
                            <div class="form-row text-right">
                                <div class="form-group text-right col-4">
                                    <label>تصريح الطبيب </label>
                                    <input type="text"  disabled="true"   name="declaration"  id="declaration" class="form-control text-right" style="height: 35px;border-radius:5px;">
                                </div>
                                <div class="form-group text-right col-4">
                                    <label>الرصيد المتبقي</label>
                                    <input type="text"     name="cd"  id="cd" class="form-control text-right" style="height: 35px;border-radius:5px;">
                                </div>
                                <div class="form-group text-right col-4">
                                    <label>عدد الايام الاجمالي</label>
                                    <input type="text" name="nbr_jour_total"  id="nbr_jour_total" class="form-control text-right" style="height: 35px;border-radius:5px;">
                                </div>
                            </div>

                            <div class="row justify-content-center ml-1">
                                <input type="submit" name="cree3" id="cree" class="btn btn-primary  ml-1" value="اضافة" >
                                <button type="submit"  id="ferme" class="btn btn-secondary justify-content-center" data-dismiss="modal">Close</button>
                            </div>    
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <?php
        if ($_SESSION['id_confim'] == "0") {
            echo "<script>alert('خدث خطا ما يرجى اعادة المحاولة')</script>";
        } elseif ($_SESSION['id_confim'] == "-1") {
            echo "<script>alert('هذا الموظف لايملك الحق في عطلة سنوية لانه استوفى كل الايام')</script>";
        } elseif ($_SESSION['id_confim'] == "-2") {
            echo "<script>alert('هذا العامل في عطلةمسبقا')</script>";
        }

        $_SESSION['id_confim'] = "";
        ?>






    </body>
</html>