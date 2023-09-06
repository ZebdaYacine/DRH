<!doctype html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>تسيير الموارد البشرية</title>
        <link href="css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="css/fontawesome-all.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/navbar-top-fixed.css" rel="stylesheet" type="text/css"/>


    </head>
    <?php
    include 'dbcon.php';
    error_reporting(0);
    session_start();
    if ($_SESSION['ide'] == "") {
        header("Location: login.php");
    }
    if (isset($_POST['logout'])) {
        $connect = "update empolyer set connect=0 where id_emp=" . $_SESSION['ide'];
        $conn->query($connect);
        $_SESSION['ide'] = "";
        $_SESSION['name'] = "";
        $_SESSION['password'] = "";
        $_SESSION['passwordErr'] = "";
        $_SESSION['emailErr'] = "";

        header("Location: login.php");
    }
    ?>

    <body class="rtl">

        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark row">
            <a class="navbar-brand" href="mypage.php">الرئيسية</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <form class="collapse navbar-collapse" id="navbarCollapse" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                <ul class="navbar-nav mr-auto">
                    <?php
                    if ($_SESSION['idr'] == 4) {

                        echo'<li class="nav-item dropdown">
                             <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="fas fa-book"></i>&nbsp&nbsp الادارة
                             </a>
                             <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                             <a class="dropdown-item" href="users/gestion_prof.php">شؤون الموظفين</a>
                             <a class="dropdown-item" href="gestion_dept.php?form=dept">تسيير المنشآة</a>';
                        echo'<a class = "dropdown-item" href = "gestion_mession.php">
                        تحديد المهام
                        </a>
                        </div>
                        </li>';
                    }
                    ?>

                    <li class = "nav-item dropdown">
                        <a class = "nav-link active dropdown-toggle" href = "#" id = "navbarDropdown" role = "button" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false">
                            <i class = "fas fa-file"></i>&nbsp&nbsp الوثائق
                        </a>
                        <div class = "dropdown-menu" aria-labelledby = "navbarDropdown">
                            <?php
                            if ($_SESSION['idr'] == 4 || $_SESSION['idr'] == 2) {
                                if ($_SESSION['idr'] == 4){
                                echo'<a class = "dropdown-item" href = "conger_user.php"> العطل الممنوحة</a>';
                                }
                                echo '<a class = "dropdown-item" href = "demende.php?id=1"> طلبات الموظفين</a>';
                                echo '<a class = "dropdown-item" href = "demende.php?id=2"> الاعمال المنجزة</a>';
                                echo '<a class = "dropdown-item" href = "demende_admin.php">طلب الوثائق</a>';
                            } else {
                                echo '<a class = "dropdown-item" href = "demende.php?id=2"> الاعمال المنجزة</a>';
                                echo '<a class = "dropdown-item" href = "demende.php?id=1">طلب الوثائق</a>';
                            }
                            ?>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="navChoix#"><sup><spane class="badge badge-pill badge-success">+5</spane></sup><i class="fas fa-envelope 2-fx"></i>&nbsp;البريد</a>
                    </li>

                </ul>
                <div class = "form-inline">
                    <input type = "text" class = "form-control-sm" placeholder = "بحث">
                    <button class = "btn btn-link" type = "submit">
                        <i class = "fa fa-search fa-1x"></i>
                    </button>
                    <button class = "btn btn-link" type = "submit" title = "logout" name = "logout" >
                        <i class = "fa fa-sign-out-alt fa-1x" style = "color: orangered;" title = "تسجيل الحروج"></i>
                    </button>
                </div>
            </form>
        </nav>
        <script>window.jQuery || document.write('<script src = "js/jquery-3.3.1.min.js"><\/script>')</script>
        <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>