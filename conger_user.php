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
        $nameErr = $prenameEr;
        include 'dbcon.php';
        include 'navbar.php';
        ?>








        <div class="row justify-content-center col-12 mt-5" > 
            <div class="form-control col-lg-11 col-md-12 col-sm-10   " id="divload1">
                <?php
                echo "<center><h4 class='mt-3'>العطل الممنوحة</h4></center><br>";
                $path="conger_user";
                include './loaddept.php';?>

            </div>
        </div>










        <script>
            $(document).ready(function () {

                $('#type').change(function (event) {
                    event.preventDefault();
                    if ($("#type").val() === "مرضية") {
                        $("#declaration").prop("disabled", false);
                    } else {
                        $("#declaration").prop("disabled", true);
                    }

                });
                $('#ferme').click(function (event) {
                    event.preventDefault();
                    $('#nom_1').val("");
                    $("#prenom_1").val("");
                    $('#type').val("");
                    $("#nbr_jour").val("");
                    $("#nbr_jour_total").val("");
                    $("#date").val("");
                    $("#adrass_1").val("");
                    $("#declaration").val("");
                    $("#declaration").prop("disabled", true);
                });

                $('#nbr_jour_total').click(function (event) {
                    event.preventDefault();
                    if ($("#declaration").val() === "") {
                        $("#declaration").val("0");
                    }
                    $("#nbr_jour_total").val(parseInt($("#declaration").val()) + parseInt($("#nbr_jour").val()));
                });


            });


          
        </script>

        <?php
        if ($_SESSION['dat'] === '0') {
            echo "<script>alert('not oki')</script>";
        } elseif ($_SESSION['dat'] === '1') {
            echo "<script>alert('oki')</script>";
        }
        ?>




    </body>
</html>