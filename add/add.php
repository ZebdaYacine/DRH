<!doctype html>
<html>
<?php
        session_start();
        include '../dbcon.php';
        if($_SESSION['confirm']=="1"){
            echo "<script>alert('تم التسجيل بنجاح')</script>";
            $_SESSION['confirm']="";
        }else if($_SESSION['confirm']=="0"){
            echo "<script>alert('هناك خطأ')</script>";
            $_SESSION['confirm']="";
        }
        ?>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        

        <title>إنشاء</title>
        <!-- Bootstrap core CSS -->
        
        
    </head>


    <body >
        <?php
          include 'navbar.php';
        ?>
        <div class="row">
            <div class="col-2">
                
            </div>
            <form class="form-control col-8" style="background-color: #e9ecef" action="ins.php"  method="post">
                <div class="col-12">
                    <center><h2 class="h2">إضافة كلية</h2></center>
                </div>
                <br>
                <div class="text-center">
                    <div class="form-group col-md-6">
                        <input type="text" value="<?php echo $_SESSION['nom_faculter'];?>"  name="nom_faculter" class="form-control"  placeholder="اسم الكلية">
                        <span class="alert-danger"><?php echo $_SESSION['nom_faculterErr'] ?></span>
                    </div>
                    <br>
                <input type="submit" name="faculter" class="btn btn-primary" value="إضافة كلية">
                </div>
                <br>
            </form>
        </div>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-2">
                
            </div>
            <form class="form-control col-8" style="background-color: #e9ecef" action="ins.php"  method="post">
                <div class="col-12">
                    <center><h2 class="h2">إضافة قسم</h2></center>
                </div>
                <br>
                <div class="text-center">
                    <div class="row">
                    <div class="input-group mb-3 col-md-6">
                        <div class="input-group-append">
                            <span class="input-group-text">اسم الكلية</span>
                            </div>
                        <select value="<?php echo $_SESSION['nom_faculter1'];?>" class="form-control" name="nom_faculter1">
                            <option></option>
                            <?php
                                $sql="select * from faculter";
                                $r=$conn->query($sql);
                                if ($r->num_rows > 0) {
                                    while ($row = $r->fetch_assoc()) {
                                        echo "<option>".$row['nom_facl']."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" value="<?php echo $_SESSION['nom_depart'];?>"  name="nom_depart" class="form-control"  placeholder="اسم القسم">
                        <span class="alert-danger"><?php echo $_SESSION['nom_departErr'] ?></span>
                    </div>
                    </div>
                    <br>
                <input type="submit" name="depart" class="btn btn-primary" value="إضافة قسم">
                </div>
                <br>
            </form>
        </div>
        
        <script>window.jQuery || document.write('<script src="../js/jquery-3.3.1.min.js"><\/script>')</script>
        <script src="../js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $("input").focus(function () {
                    $(this).css("border-color", "#ffffff");
                });
                $("input").blur(function () {
                    if ($(this).val() === "") {
                        $(this).css("border-color", "#FF0000");
                    }
                    else {
                        $(this).css("border-color", "#ffffff");
                    }

                });

            });
        </script>
    </body>
</html>
