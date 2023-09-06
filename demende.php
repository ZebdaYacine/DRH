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
        $id = $_GET['id_mession'];
        $id1 = $_GET['id_emp'];
        $sql1 = "delete from  demende  WHERE id_emp=$id and id_mession=$id1";
        if ($conn->query($sql1) === TRUE) {
            header('Location: demende.php?id=2');
        }
    
    ?>

    <body class="rtl jumbotron">
        <?php
        error_reporting(0);
        include 'dbcon.php';
        include 'navbar.php';
        $id = $_GET['id'];
        if ($id == "2") {
            $titel = "قائمة الطلبات";
        } elseif ($id == "1") {
            $titel = "قائمة الشهادات";
        }
        $id_emp = $_GET['id_emp'];
        ?>
    <center> <div class="justify-content-center col-lg-10 mt-5 ">
            <div class="card" >
                <div class="card-header">
                    <center><h5><?php echo $titel; ?></h5></center>
                </div>

                <div class="card-body" id="divload">
                    <?php
                    $path = "demende";
                    include 'loaddept.php';
                    ?>
                </div>
            </div>

        </div></center>
    <script>window.jQuery || document.write('<script src="js/jquery-3.3.1.min.js"><\/script>');</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>





    <script>
        $(document).ready(function () {

            $(".deplome").click(function () {
                var id_deplome = $(this).attr("id");
                $.ajax({
                    url: "fech.php",
                    method: "POST",
                    data: {id_deplome: id_deplome, d: "deplome"},
                    dataType: "json",
                    success: function (data) {
                        $('#id_deplome').val(data.id_deplome);
                        $('#nom_deplome').val(data.nom_deplome);
                        $('#spl').val(data.specialite);
                        $('#update_deplome').modal('show');
                    }
                });
            });


        });
        setInterval(
                function ()
                {
                    $('#divload').load('loaddept.php', {path: <?php echo $path ?>});
                }, 500);
    </script>









    <div class="modal fade bd-example-modal-md"  id="update_deplome" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل معلومات الشهادة</h5>
                </div>
                <div class="modal-body">
                    <form action="update.php"   method="post">
                        <div class="form-row text-right">
                            <div class="form-group col-md-12">
                                <input type="text"  name="nom_deplome"  class="form-control text-right" id="nom_deplome"  placeholder="اسم الشهادة">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control text-right" name="spl" id="spl" placeholder="اسم التخصص">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control text-right" readonly name="id_deplome" id="id_deplome" placeholder="رقم الشهادة">
                            </div>
                        </div>
                        <div class="row justify-content-center ml-1">
                            <input type="submit" name="update_deplome" id="update_deplome" class="btn btn-success  ml-1" value="تعديل" >
                            <button type="submit"  id="ferme" class="btn btn-secondary justify-content-center" data-dismiss="modal">الغاء</button>
                        </div>    
                    </form>
                </div>

            </div>
        </div>
    </div>






</body>
</html>