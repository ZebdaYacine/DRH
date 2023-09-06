<!doctype html>
<html>
    <?php
    include 'dbcon.php';
    session_start();
    $sq = "select * from emp";
    if (isset($_POST['envoyer'])) {
                        $msg=$_POST['msg'];
                        if ($msg != "") {
                            $name = $_SESSION['name'];
                            $fromid = $_SESSION['ide'];
                            $sql = "insert into msg (msg,name,fromemp,toemp) values ('$msg','$name',$fromid,".$_GET['id'].")";
                            $conn->query($sql);
                            
                        }
                        header("Location: envmsg.php?id=".$_GET['id']."&user=".$_GET['user']);
                        exit();
                    }
    ?>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>الرسائل</title>
        <link href="css/Style.css" rel="stylesheet" type="text/css"/>
    </head>


    <body>
        <?php
        include 'navbar.php';
        ?>

        <div class="row ">
            <div class="col-lg-2 col-sm-2 col-xl-2 col-md-2  text-center">
                <table class="table table-hover">
                    <tr ><th>    
                            <h2 class="h4">جهات الاتصال</h2>
                        </th></tr>
                    <?php
                    
                    $resul = $conn->query($sq);
                    if ($resul->num_rows > 0) {
                        while ($row = $resul->fetch_assoc()) {
                            $user = $row["firstname"];
                            $ide = $row["ide"];
                            if ($ide != $_SESSION['ide']) {
                                echo "<tr><td>" . "<a class='alert active' href='?" . "id=" . $ide . "&user=" . $user . "'>";
                                echo $row["firstname"];
                                echo "</a>" . "</td></tr>";
                            }
                        }
                    }

                    
                    ?>

                </table>
            </div>

            <div class="col-lg-8 col-sm-8 col-xl-8 col-md-8 form-control">
                <div  class="h4 text-center">
                    <?php echo $_GET['user']?>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $_GET['id'] . "&user=" . $_GET['user']); ?>" method="post"> 
                    <div class="form-control pre-scrollable" style="min-height: 350px" id="div1">
                        <?php
                        $_SESSION['toid'] =  $_GET['id'];
                        include 'msg.php';
                        ?>
                    </div >
                    <div class="input-group-text">
                        <textarea class="form-control text-right pre-scrollable auto-text-area" style="max-height: 60px;min-height: 40px;height: 40px " id="texta" name="msg"></textarea>
                        <button class="btn btn-link" type="submit" name="envoyer">
                            إرسال
                        </button>
                    </div>                                    
                </form>
            </div>
        </div>
        <script>
            $('#div1').scrollTop($('#div1')[0].scrollHeight - $('#div1')[0].clientHeight);
            $(document).ready(function () {
                setInterval(function () {
                    $("#div1").load("msg.php");
                }, 500);
            });
            var count = 1;
            var chars = 50;
            $('#texta').keydown(function () {
                var v = $(this).val();
                var vl = v.replace(/(\r\n|\n|\r)/gm, "").length;
                if (parseInt(vl / count) === chars) {
                    $(this).val(v + '\n');
                    count++;
                }
            });
        </script>
    </body>
</html>