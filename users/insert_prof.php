<!doctype html>
<html >
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
        $_SESSION['insert'] = "insert";
        $_SESSION['ag'] = "prof";
        $_SESSION['page'] = "insert_prof.php";
        ?>

    <center class="mt-3"><div class="col-10 text-right">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة استاذ جديد</h5>
                </div>
                <div class="modal-body">
                    <form    method="post" enctype="multipart/form-data" action="insertdata.php">
                        <h4>المعلومات الشخصية</h4>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <input type="text"  name="prenom" class="form-control text-right" id="prenom"  placeholder="اسم العائلة">
                                <span class="alert-danger"><?php echo $_SESSION['prenameErr'] ?></span>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control text-right"  name="nom" id="nom" placeholder="الاسم الاول">
                                <span class="alert-danger"><?php echo $_SESSION['nameErr'] ?></span>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="file" class="form-control  text-right" accept="image/jpeg,image/jpg,image/png"  name="image" id="image">
                            </div>
                        </div>
                        <div class="form-row text-right">
                            <div class="form-group text-right col-4">
                                <input type="text"  class="form-control" name="nbr_srl" id="nbr_srl"  placeholder="الرقم التسلسلي">
                                <span class="alert-danger"><?php echo $_SESSION['nbr_srlERR'] ?></span>
                            </div>
                            <div class="form-group text-right col-4">
                                <input type="text"  class="form-control text-right" name="phone" id="phone"  placeholder="رقم الهاتف">
                                <span class="alert-danger"><?php echo $_SESSION['phoneErr']; ?></span>
                            </div>
                            <div class="form-group text-right col-4">
                                <input type="text"  class="form-control" name="email" id="email"  placeholder="البريد الالكتروني">
                                <span class="alert-danger"><?php echo $_SESSION['emailErr'] ?></span>
                            </div>

                        </div>

                        <div class="form-group text-right">
                            <input type="password"  class="form-control text-right " name="code" id="code" placeholder="الرقم السري">
                            <span class="alert-danger"><?php echo $_SESSION['codeErr']; ?></span>                
                        </div>
                        <div class="form-row text-right ">
                            <div class="form-group text-right col-4">
                                <label>تاريخ الميلاد</label>
                                <input type="date" name="date"  id="date" class="form-control text-right" style="height: 35px;border-radius:5px;">
                                <span class="alert-danger"><?php echo $_SESSION['daterErr'] ?></span>
                            </div>
                            <div class="form-group text-right col-4">
                                <label>مكان الازدياد</label>
                                <input type="text" name="lieu_ns"   id="lieu_ns" class="form-control text-right" style="height: 35px;border-radius:5px;">
                                <span class="alert-danger"><?php echo $_SESSION['lien_nsErr'] ?></span>
                            </div>
                            <div class="form-group col-4">
                                <label>عنوان</label>
                                <input type="text" name="adrass"  id="adrass" class="form-control text-right">
                                <span class="alert-danger"><?php echo $_SESSION['adrassErr'] ?></span>
                            </div>
                        </div>
                            <div class="input-group">
                                <div class="form-control col-1">
                                            ذكر
                                     </div>
                                 <div class="input-group-prepend">
                                     <div class="input-group-text">
                                        <input type="radio"  name="radio" value="male" >
                                     </div>
                                 </div>
                                       <div class="form-control col-1">
                                            أنثى
                                     </div>
                                 <div class="input-group-prepend">
                                     <div class="input-group-text">
                                        <input type="radio"  name="radio" value="female" >
                                     </div>
                                 </div>
                                </div>
                                <span class="alert-danger mr-3"><?php echo $_SESSION['genderErr'] ?></span>
                        <br> 
                        <h4>المعلومات الادارية</h4>
                        <div class="form-row ">
                            <div class="form-group col-3">
                                <label>الكلية</label>
                                <select class="form-control" id="place_travialle" name="place_travialle">
                                    <?php
                                    $sql1 = "select name_facl from faculty where id_facl=" . $_SESSION['id_facl'];
                                    $result = $conn->query($sql1);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo'<option>' . $row['name_facl'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label>درجة العمل</label>
                                <select class="form-control" name="grade" id="grade">
                                    <option></option>
                                    <?php
                                    $class = "pidagogie";
                                    $sql3 = "select * from grade where type='$class'";
                                    $result = $conn->query($sql3);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo'<option>' . $row['name_grade'] . '</option>';
                                        }
                                    }
                                    ?>

                                </select>
                            </div>

                            <div class="form-group col-3">
                                <label>الشهادة</label>
                                <select class="form-control" name="diploma" id="diploma">

                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label>رصيد النقاط</label>
                                <input type="text" name="note"  id="note" class="form-control " style="height: 35px;border-radius:5px;">
                                <span class="alert-danger"><?php echo $_SESSION['noterErr'] ?></span>
                            </div>
                        </div>
                        <h4>مسجل في </h4>
                        <div class="form-row">
                            <div class="form-group col-4" >
                                <label>القسم</label>
                                <select class="form-control" name="dept">
                                    <option></option>
                                    <?php
                                    $sql = "select * from department where id_facl=".$_SESSION['id_facl'];
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {

                                        while ($row = $result->fetch_assoc()) {
                                            echo'<option>' . $row['name_dept'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <span class="alert-danger"><?php echo $_SESSION['deptErr'] ?></span>
                            </div>
                            <div class="form-group col-4">
                                <label>تاريخ الالتحاق</label>
                                <input type="date" name="date_rect"  id="date_rect" class="form-control" >
                                <span class="alert-danger"><?php echo $_SESSION['date1rErr'] ?></span>
                            </div>
                            <div class="form-group col-4">
                                <label>الصلاحية</label>
                                <select class="form-control" id="droit" name="droit">
                                    <option></option>
                                    <?php
                                    $sql = "select * from role where id_role!=1";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {

                                        while ($row = $result->fetch_assoc()) {
                                            echo'<option>' . $row['right'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <input type="submit" name="insert" id="cree" class="btn btn-primary" value="اضافة استاذ" >
                        </div>    
                    </form>
                </div>

            </div>
        </div></center>

    <?php
    echo $_SESSION['confirm1'];
    if ($_SESSION['confirm'] == "1") {
        echo "<script>alert('تم التسجيل بنجاح')</script>";
        $_SESSION['confirm'] = "";
    } elseif ($_SESSION['confirm'] == "0") {
        echo "<script>alert('لم يتم التسجيل')</script>";
        $_SESSION['confirm'] = "";
    }
    ?>

    <script>window.jQuery || document.write('<script src="js/jquery-3.3.1.min.js"><\/script>');</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>

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
        });</script>


    <script>
        $(document).ready(function () {

            $('#grade').change(function (event) {
                event.preventDefault();
                var page = $('#grade').val();
                $('#diploma').load('ins.php', {path: page, type: '0'});
            });
        });

    </script>









</body>
</html>