<!doctype html>
<?php
session_start();
include 'dbcon.php';
$sql = "select * from employee";
$_SESSION['emailErr'] = "";
$_SESSION['passwordErr'] = "";


if ($_SESSION['email_phone'] == "") {
    $_SESSION['emailErr'] = "ادحل بريد او رقم الهاتف";
} else {
    if (!preg_match("#^[a-z0-9-A-Z._-]+@(gmail|yahoo)\.(com|fr|dz)$#", $_SESSION['email_phone']) && (!preg_match("#^0[5-7][0-9]+$#", $_SESSION['email_phone']) && strlen($_SESSION['email_phone']) != 10)) {
        $_SESSION['emailErr'] = "ادخال خاطئ";
    } else {
        $result = $conn->query($sql);
        $p = true;
        if ($result->num_rows > 0) {
            while (($row = $result->fetch_assoc()) && $p) {
                if ($_SESSION['email_phone'] == $row["email"] || $_SESSION['email_phone'] == $row["phone"]) {
                    $_SESSION['emailErr'] = "";
                    $p = false;
                    if ($_SESSION['password'] == "") {
                        $_SESSION['passwordErr'] = "أدخل كلمة السر";
                    } else {

                        if ($_SESSION['password'] == $row["code"]) {
                            $_SESSION['firstname'] = $row["first_name"];
                            $_SESSION['lastname'] = $row["last_name"];
                            $_SESSION['email'] = $row["email"];
                            $_SESSION['ide'] = $row["id_emp"];
                            $_SESSION['name_grade'] = get("name_grade", "grade", "id_grade", $row['id_grade']);
                            $_SESSION['phone'] = $row["phone"];
                            $_SESSION['id_facl'] = $row["id_facl"];
                            if (!empty($row["id_dept"])) {
                                $_SESSION['dept'] = $row["id_dept"];
                            }
                            $_SESSION['idr'] = $row["id_role"];
                            $connect = "update empolyer set connect=1 where id_emp=" . $_SESSION['ide'];
                            $conn->query($connect);
                            if ($_SESSION["idr"] == 4 || $_SESSION["idr"] == 2) {
                                header("Location: mypage1.php");
                            }
                        } else {
                            $_SESSION['passwordErr'] = "كلمة السر غير صحيحة ";
                        }
                    }
                } else {
                    $_SESSION['emailErr'] = "ايميل او رقم غير موجود";
                    if ($_SESSION['password'] == "") {
                        $_SESSION['passwordErr'] = "أدخل كلمة السر";
                    }
                }
            }
        } else {
            $_SESSION['emailErr'] = "ايميل او رقم غير موجود";
            if ($_SESSION['password'] == "") {
                $_SESSION['passwordErr'] = "أدخل كلمة السر";
            }
        }
    }
}
if ($_SESSION['ide'] == "") {
    header("Location: login.php");
}
if ($_SESSION['idr'] == 4 || $_SESSION['idr'] == 2) {
    header("Location: mypage1.php");
}

if (isset($_POST['logout'])) {
    $_SESSION['name'] = "";
    $_SESSION['password'] = "";
    $_SESSION['passwordErr'] = "";
    $_SESSION['emailErr'] = "";
    header("Location: login.php");
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>كلية العلوم</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap-rtl.min.css" rel="stylesheet">
        <link href="css/fontawesome-all.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/navbar-top-fixed.css" rel="stylesheet">
    </head>


    <body class="rtl jumbotron">
        <?php
        include 'navbar.php';
        $_SESSION['pg']="mypage.php";
        ?>
        <div class="mt-3 col-lg-12 form-row" style="margin: 0 auto">
            <div class="col-lg-3">
                <div class="card border-info" >
                    <div class="card-body bg-info">
                        <div class="form-row text-light ">  
                            <div class="col-7 mt-3">
                                <h5 class="card-title"><?php  echo $_SESSION['firstname']." ".$_SESSION['lastname'];?></h5>
                                <h5 class="card-title"><?php  echo $_SESSION['name_grade'] ;?></h5>
                            </div>
                            <div class="col-2">
                                <center><img src="users/img.php?id=<?php echo $_SESSION['ide'] ?>" style="width:80px;height:80px;border-radius: 80px 80px 80px 80px"></center>
                            </div>
                        </div>
                    </div>
                    <a href="users/view_profile_1.php?id=<?php echo $_SESSION['ide'] ?>" class="text-info"><div class="card-footer" >
                            <div class="row">
                                <div class="col-10">إظهار الملف الشخصي</div>
                                <span class="col-1"><i class="fa fa-arrow-circle-left"></i></span>
                            </div>
                        </div></a>
                </div>
            </div>
            <div class="col-lg-6">
                <form class="card " action="insstat.php" method="post">
                    <div class="card-header" style="height:40px">
                        <h6 class="h6"> اضافة اعلان</h6>
                    </div>
                    <div class="card-body">
                        <textarea name="text" class="form-control" id="sh"></textarea>
                    </div>
                    <div class="card-footer" id="divsh">
                        <div class="form-row" style="height: 25px">
                            <div class="col-8">تحديد من يمكنه رؤية الاعلان</div>
                            <select class="col-3 btn-outline-primary btn-sm" name="sel">
                                <option>جميع اقسام الكلية</option>
                                <?php
                                $sql = "select name_dept from department";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo'<option>' . $row['name_dept'] . '</option>';
                                    }
                                }
                                ?>

                            </select>
                            <input type="submit" name="advert" class="btn-sm btn btn-link" class="col-1" value="اعلان">
                        </div>
                    </div>
                </form>
                <div class="mt-3 " id="advert" style="max-height: 1000px;overflow: auto">
                    <?php
                    $_SESSION['load'] = 0;
                    include 'loadst.php';
                    ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card ">
                    <div class="card-header">
                        <h5 class="card-title"><center>قائمة الموظفين</center></h5>
                    </div>
                    <div class="card-body " style="max-height: 400px;overflow: auto">

                        <table class="table-responsive " >
                            <table class="table table-hover table-bordered" >
                                <thead class="text-primary">
                                <th class="text-center">
                                    الاسم
                                </th>
                                <th  class="text-center" >
                                    الاتصال
                                </th>
                                </thead>
                                <tbody id="tbody">
                                    <?php
                                    include 'connect.php';
                                    ?>
                                </tbody>
                            </table>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <script>
            setInterval(
                    function ()
                    {
                        $('#stat').load('loadst.php', {att1: "<?php echo $_SESSION['idf']; ?>", att2: "<?php echo $_SESSION['id_dept']; ?>"});
                    }, 500);
            setInterval(
                    function ()
                    {
                        $('#tbody').load('connect.php');
                    }, 500);
            setInterval(
                    function ()
                    {
                        $('#card1').load('loadMessage.php', {path: "message"});
                    }, 500);

        </script>


        <?php

        function get($n, $n1, $n2, $n3) {
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
