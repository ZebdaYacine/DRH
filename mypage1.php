<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>كلية العلوم</title>
    </head>

    <body class="rtl jumbotron" >
        <?php
        session_start();
        include 'navbar.php';
        $_SESSION['pg'] = "mypage1.php";
        if ($_SESSION['idr'] != 4 && $_SESSION['idr'] != 2) {
            header("Location: mypage.php");
        }
        ?>


        <div class="mt-3 col-lg-112 form-row" style="margin: 0 auto">
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
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><center><?php
                                if ($_SESSION['idr'] == 4) {
                                    echo 'احصائيات العمال';
                                } else {
                                    echo 'قائمة المهام';
                                }
                                ?></center></h5>
                    </div>
                    <div class="card-body scroll">

                        <div class="table-responsive">
                            <div class="table-full-width table-responsive" id="d">



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script>
            setInterval(
                    function ()
                    {
                        $('#advert').load('loadst.php');
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
            setInterval(
                    function ()
                    {
                        $('#d').load('load_statistique.php', {path: "<?php echo $_SESSION['idr']; ?>", att4: "<?php echo $_SESSION['ide']; ?>"});
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
