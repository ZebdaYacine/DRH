<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>تسيير الموارد البشرية</title>
        <link href="../css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/fontawesome-all.min.css"s rel="stylesheet" type="text/css"/>
        <link href="../css/navbar-top-fixed.css" rel="stylesheet" type="text/css"/>


    </head>
    <?php
    include '../dbcon.php';
    error_reporting(0);
    session_start();
    if ($_SESSION['ide'] == "") {
        header("Location: ../login.php");
    }
    if (isset($_POST['logout'])) {
        $_SESSION['ide'] = "";
        $_SESSION['name'] = "";
        $_SESSION['password'] = "";
        $_SESSION['passwordErr'] = "";
        $_SESSION['emailErr'] = "";
        header("Location: ../login.php");
    }
    ?>

    <body class="rtl">

        <nav class="navbar navbar-expand-xl navbar-dark fixed-top bg-dark row">
            <a class="navbar-brand" href="../mypage.php"><?php echo $_SESSION['name'] ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <form class="collapse navbar-collapse" id="navbarCollapse" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                <ul class="navbar-nav mr-auto">
                    <?php
                    if ($_SESSION['idr'] == 1) {
                        
                        echo'<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-book"></i>&nbsp&nbspقائمة المهام
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../task/newtask.php">مهمة جديدة</a>
                            <a class="dropdown-item" href="../task/tasks.php">مهام الموظفين</a>
                            </div>
                            </li>';
                        echo'<li class="nav-item dropdown">
                             <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="fas fa-book"></i>&nbsp&nbspشؤون الادارة
                             </a>
                             <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                             <a class="dropdown-item" href="../gestion_user.php">شؤون الموظفين</a>
                             <a class="dropdown-item" href="../gistion_form.php">تسيير المنشآة</a>
                             </div>
                             </li>';
                    } 
                    ?>

                </ul>
                <div class="form-inline mt-2 mt-md-0">
                    <input type="text" class="form-control" placeholder="بحث">
                    <button class="btn btn-link" type="submit">
                        <i class="fa fa-search fa-1x"></i>
                    </button>
                    <button class="btn btn-link" type="submit" title="logout" name="logout" >
                        <i class="fa fa-sign-out-alt fa-1x" style="color: orangered;" title="تسجيل الحروج"></i>
                    </button>
                </div>
            </form>
        </nav>
        <script>window.jQuery || document.write('<script src="js/jquery-3.3.1.min.js"><\/script>')</script>
        <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>