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
        $titel = "الاساتذة المسجلين";
        $_SESSION['mod'] = "اضافة استاذ";
        $_SESSION['href'] = "insert_admin.php?type=prof";
        $_SESSION["type"] = "prof";
        ?>


        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="card">
                    <div class="card-header text-center">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="gestion_prof.php">الاساتذة</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="gestion_admin.php?in=fcl">الموظفين</a>
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
                                    <center><h5><?php echo $titel; ?></h5></center>
                                </div>
                                <div class="card-body"  id="divload">
                                    <table class="table table-hover table-bordered ">
                                        <?php
                                        $sql1 = "select * from employee where type_user='prof' ";
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

                                        function get_from_table($n, $n1, $n2, $n3) {

                                            $sql0 = "select " . $n . " from " . $n1 . " where " . $n2 . " = '$n3'";
                                            include '../dbcon.php';
                                            $result = $conn->query($sql0);
                                            $attr = "";
                                            while ($row = $result->fetch_assoc()) {
                                                $attr = $row["$n"];
                                            }
                                            return $attr;
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div class="card-footer text-center">

                        <a href="<?php echo $_SESSION['href']; ?>"><i class="fas fa-plus-circle fa-1x " style="color: #17a2b8">&nbsp&nbsp <?php echo $_SESSION['mod'] ?></i></a>

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