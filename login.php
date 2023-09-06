<!doctype html>
<?php
error_reporting(0);
$_SESSION['emailErr'] = $_SESSION['passwordErr'] = "";
session_start();

if ($_SESSION['ide'] != "") {
    header("Location: mypage.php");
}
if (isset($_POST["login"])) {
    $_SESSION['email_phone'] = htmlspecialchars($_POST["email_phone"]);
    $_SESSION['password'] = htmlspecialchars($_POST["password"]);
    header("Location: mypage.php");
}
?>
<html
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>كلية العلوم</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap-rtl.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/floating-labels.css" rel="stylesheet">
      
    </head>
    <body id="login" class="jumbotron rtl" background="img/image1.jpg">


        <form class="form-signin form-control" style="background-image: url('img/a.jpg');background-size: cover;" action="login.php" method="post">
            <div class="text-center mb-4">
                <a href="http://www.lagh-univ.dz/"><img src="img/s5_logo.png" style="width: 100%"></a>
                <h1 class="h3 mb-3 font-weight-normal">تسجيل الدخول</h1>
                <p>مرحبا بك</p>
            </div>

            <div class="form-label-group">
                <input type="text" id="inputEmail" name='email_phone' value="<?php echo $_SESSION['email_phone'] ?>" class="form-control" placeholder="البريد الإلكتروني او رقم الهاتف" >
                <label for="inputEmail">البريد الإلكتروني او رقم الهاتف</label><span class="alert-danger"><?php echo $_SESSION['emailErr'] ?></span>
            </div>

            <div class="form-label-group">
                <input type="password" name='password' id="inputPassword" class="form-control" placeholder="كلمة السر">
                <label for="inputPassword">كلمة السر</label><span class="alert-danger"><?php echo $_SESSION['passwordErr'] ?></span>
            </div>
            <a class="btn btn-link" href="enrgister.php">هل نسيت كلمة السر</a>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">تسجيل الدخول</button>
            <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
        </form>
        <div id="re">

        </div>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
    </body>



</html>