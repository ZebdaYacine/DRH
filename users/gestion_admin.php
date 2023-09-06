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
        error_reporting(0);
        session_start();
        include '../dbcon.php';
        include 'navbar.php';
        if ($_SESSION['idr'] != 4) {
            header("Location: ../mypage.php");
        }
        ?>


        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="gestion_prof.php">الاساتذة</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="gestion_admin.php?in=fcl">الموظفين</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="gestion_agoin.php">الاعوان</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="gestion_idm.php">الادماج</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body justify-content-center" style="max-height: 400px;min-height: 400px;overflow: auto">
                        <center class="col-12">
                            <div class="card ">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link <?php
                                            if ($_GET["in"] == "fcl") {
                                                echo 'active';
                                            }
                                            ?>" href="gestion_admin.php?in=fcl">في الكلية</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?php
                                            if ($_GET["in"] == "dept") {
                                                echo 'active';
                                            }
                                            ?>" href="gestion_admin.php?in=dept">في القسم</a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="card-body"  id="divload">
                                    <?php
                                    if ($_GET["in"] == "fcl") {
                                        $path = "admin";
                                    }elseif($_GET["in"] == "dept"){
                                        $path = "admdept";
                                    }
                                    
                                    include '../loaddept.php';
                                    ?>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div class="card-footer text-center">

                        <a href="insert_admin.php?type=admin"><i class="fas fa-plus-circle fa-1x " style="color: #17a2b8">&nbsp&nbsp اضافة موظف</i></a>

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


        <?php
        if ($_SESSION['confirm3'] == "1") {
            echo "<script>alert('تم الحذف بنجاح')</script>";
            $_SESSION['confirm3'] = "";
        } else if ($_SESSION['confirm1'] == "0") {
            echo "<script>alert('تعذر الحذف')</script>";
            $_SESSION['confirm1'] = "";
        }
        ?>

    </body>
</html>