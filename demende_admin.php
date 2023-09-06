<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="css/fontawesome-all.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>

    </head>

    <body class="rtl jumbotron">
        <?php
        error_reporting(0);
        include 'dbcon.php';
        include 'navbar.php';
        $titel = "قائمة الشهادات";
        ?>
    <center> <div class="justify-content-center col-lg-10 mt-5 ">
            <div class="card" >
                <div class="card-header">
                    <center><h5><?php echo $titel; ?></h5></center>
                </div>

                <div class="card-body" id="divload">
                    <?php
                    $path = "demende_admin";
                    include 'loaddept.php';
                    ?>
                </div>
            </div>

        </div></center>
    <script>window.jQuery || document.write('<script src="js/jquery-3.3.1.min.js"><\/script>');</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>





    <script>

        setInterval(
                function ()
                {
                    $('#divload').load('loaddept.php', {path: <?php echo $path ?>});
                }, 500);
    </script>





</body>
</html>