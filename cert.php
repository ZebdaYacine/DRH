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
        include 'dbcon.php';
        include 'navbar.php';
        $_SESSION['page'] = "cert";
        $dis1 = $dis2 = $dis3 = '';
        $date = $jours = $jours_demender = $jours_rester = $adrass = $conger = $jours_declarer = $jours_totale = $replace = "";
        $_SESSION['id_emp'] = $_GET['id_emp'];
        $_SESSION['id_empt'] = $_GET['id_empt'];
        $_SESSION['id_cert'] = $_GET['id_cert'];
        $tp = $_GET['type'];
        $_SESSION['tp'] = $_GET['type'];
        $nom = get_from_table("nom_emp", "empolyer", "id_emp", $_SESSION['id_emp'], 1);
        $prenom = get_from_table("prenom_emp", "empolyer", "id_emp", $_SESSION['id_emp'], 1);
        if ($tp == "cree") {
            $titel = "انجاز الطلب";
            $conger = get_from_table("type_conger", "conger", "id_conger", $_GET['id_conger'], 1);
            $date = $_GET['date'];
            $adrass = get_from_table("adrass", "demende", "id_mession", $_SESSION['id_cert'] . " and id_emp=" . $_SESSION['id_emp'] . " and date_conger= '$date'", 0);
            $replace = get_from_table("remplacement", "demende", "id_mession", $_SESSION['id_cert'] . " and id_emp=" . $_SESSION['id_emp'] . " and date_conger= '$date'", 0);
            if ($_GET['id_conger'] == 1) {
                $dis1 = 'disabled="true"';
                $jours_demender = get_from_table("nbr_jours", "demende", "id_mession", $_SESSION['id_cert'] . " and id_emp=" . $_SESSION['id_emp'] . " and date_conger= '$date'", 0);
                $jours = get_from_table("nbr_jour_conger", "empolyer", "id_emp", $_SESSION['id_emp'], 1);
                $jours_rester = $jours - $jours_demender;
                $jours_totale = $jours_demender;
            } else {
                $jours = get_from_table("nomber_jour", "conger", "id_conger", $_GET['id_conger'], 1);
                if ($_GET['id_conger'] == 3) {
                    $dis2 = 'disabled="true"';
                    $jours_declarer = get_from_table("declaration", "demende", "id_mession", $_SESSION['id_cert'] . " and id_emp=" . $_SESSION['id_emp'] . " and date_conger= '$date'", 0);
                    $jours_rester = $jours_declarer;
                    $jours_totale = $jours_declarer;
                } else {
                    $jours_totale = get_from_table("nbr_jours", "demende", "id_mession", $_SESSION['id_cert'] . " and id_emp=" . $_SESSION['id_emp'] . " and date='$date'", 0);
                    $dis3 = 'disabled="true"';
                    $jours_rester = $jours - $jours_demender;
                }
            }
        } elseif ($tp == "demende") {
            $titel = "تاكيد الطلب";
        }
        ?>

        <div class="modal-dialog modal-lg mt-3">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title" id="exampleModalLabel">منح عطلة</h5>
                </div>
                <div class="modal-body"  >
                    <form action="users/ins.php"   method="post">
                        <div class="form-row text-right">
                            <div class="form-group col-md-6">
                                <label>الاسم</label>
                                <input   type="text"  name="nom_1"  value="<?php echo $nom; ?>" class="form-control text-right" id="nom_1">
                            </div>
                            <div class="form-group col-md-6">
                                <label>اللقب</label>
                                <input type="text" class="form-control text-right" value="<?php echo $prenom; ?>"  name="prenom_1" id="prenom_1">
                            </div>
                        </div>

                        <div class="form-row text-right ">
                            <div class="form-group text-right col-4">
                                <label>نوع العطلة</label>
                                <select class="form-control" name="type" id="type">
                                    <?php
                                    if ($tp == "demende") {
                                        echo '<option></option>;';
                                        $sql = "select type_conger from conger";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {

                                            while ($row = $result->fetch_assoc()) {
                                                echo'<option>' . $row['type_conger'] . '</option>';
                                            }
                                        }
                                    } else {
                                        echo '<option>' . $conger . '</option>;';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group text-right col-4">
                                <label>رصيد الايام المتوفر</label>
                                <select class="form-control" name="nbr_jour"  id="nbr_jour">
                                    <option><?php echo $jours; ?></option>
                                </select>                            
                            </div>
                            <div class="form-group col-md-4">
                                <label>عدد الايام المطلوبة</label>
                                <input type="text" class="form-control text-right"  value="<?php echo $jours_demender; ?>"  <?php echo $dis3 ?> <?php echo $dis2 ?> name="acord" id="acord">
                            </div>

                        </div>
                        <div class="form-row text-right">
                            <div class="form-group col-md-4">
                                <label>عنوان اثناء العطلة</label>
                                <input type="text" class="form-control text-right" value="<?php echo $adrass; ?>"  name="adrass_1" id="adrass_1">
                            </div>

                            <div class="form-group text-right col-4">
                                <label>التاريخ</label>
                                <input type="date" name="date_1"  id="date_1" value="<?php echo $date; ?>" min="<?php echo date("Y-m-d") ?>" max="<?php echo date("Y-12-31") ?>"  class="form-control text-right" style="height: 35px;border-radius:5px;">
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group text-right col-4">
                                <label>المستخلف</label>
                                <select class="form-control" name="replace" id="replace">
                                    <?php
                                    if ($tp == "demende") {
                                        echo '<option></option>;';
                                        if (!empty(get_from_table("id_dept", "etudie", "id_emp", $_GET['id_emp'], 0))) {
                                            $n = get_from_table("id_dept", "etudie", "id_emp", $_GET['id_emp'], 0);
                                            $t = get_from_table("type_user", "empolyer", "id_emp", $_GET['id_emp'], 0);
                                        } else {
                                            if (empty(get_from_table("id_dept", "empolyer", "id_emp", $_GET['id_emp'], 0))) {
                                                $n = get_from_table("id_facl", "empolyer", "id_emp", $_GET['id_emp'], 0);
                                                $t = get_from_table("type_user", "empolyer", "id_emp", $_GET['id_emp'], 0);
                                            } else {
                                                $n = get_from_table("id_dept", "empolyer", "id_emp", $_GET['id_emp'], 0);
                                                $t = get_from_table("type_user", "empolyer", "id_emp", $_GET['id_emp'], 0);
                                            }
                                        }
                                        $sql = "select nom_emp,id_emp,type_user from empolyer where 
                                            (id_emp not in (select E.id_emp  from empolyer E,profitier P where E.type_user='$t' 
                                            and E.id_emp=P.id_emp ))  and type_user='$t' and id_emp != ".$_SESSION['ide'];
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo'<option>' . $row['id_emp'] . '</option>';
                                            }
                                        } else {
                                            echo'<option>لا يوجد مستخلف</option>';
                                        }
                                    } else {
                                        echo '<option>' . $replace . '</option>;';
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-row text-right">
                            <div class="form-group text-right col-4">
                                <label>تصريح الطبيب </label>
                                <input type="text"     name="declaration" <?php echo $dis1 ?> <?php echo $dis3 ?> value="<?php echo $jours_declarer; ?>"  id="declaration" class="form-control text-right" style="height: 35px;border-radius:5px;">
                            </div>
                            <div class="form-group text-right col-4">
                                <label>الرصيد المتبقي</label>
                                <input type="text"    name="cd"  id="cd" value="<?php echo $jours_rester; ?>"  id="cd" class="form-control text-right" style="height: 35px;border-radius:5px;">
                            </div>
                            <div class="form-group text-right col-4">
                                <label>عدد الايام الاجمالي</label>
                                <input type="text" name="nbr_jour_total"  id="nbr_jour_total" value="<?php echo $jours_totale; ?>" class="form-control text-right" style="height: 35px;border-radius:5px;">
                            </div>
                        </div>

                        <div class="row justify-content-center ml-1">
                            <input type="submit" name="cree3" id="cree" class="btn btn-primary  ml-1" value="<?php echo $titel; ?>" >
                        </div>    
                    </form>
                </div>

            </div>
        </div>



        <script>
            $(document).ready(function () {
                $('#type').change(function (event) {
                    event.preventDefault();
                    var d;
                    if ($("#type").val() === "مرضية") {
                        d = "2";
                        $("#declaration").prop("disabled", false);
                        $("#cd").prop("disabled", true);
                        $("#nbr_jour").prop("disabled", true);
                        $("#acord").prop("disabled", true);
                    } else {
                        $("#acord").prop("disabled", false);
                        if ($("#type").val() === "استدراكية") {
                            d = "3";
                        } else {
                            d = "1";
                        }
                        $("#declaration").prop("disabled", true);
                    }
                    var page;
                    if (d === "1") {
                        page = "<?php echo $_SESSION['id_emp']; ?>";
                        $('#nbr_jour').load('inscripition.php', {path: page, type: '5'});
                    } else {
                        page = $("#type").val();
                        $('#nbr_jour').load('inscripition.php', {path: page, type: '6'});
                    }

                });


                $('#cree3').click(function (event) {
                    event.preventDefault();
                    $('#type').val("");
                    $("#nbr_jour").val("");
                    $("#nbr_jour_total").val("");
                    $("#date").val("");
                    $("#adrass_1").val("");
                    $("#declaration").val("");
                    $("#acord").val("");
                    $("#cd").val("");
                    $("#declaration").prop("disabled", true);
                });

                $("#declaration").keyup(function (event) {
                    $("#nbr_jour_total").val(parseInt($("#declaration").val()));
                    $("#acord").prop("disabled", true);
                });


                $("#acord").keyup(function (event) {
                    event.preventDefault();
                    if ($("#declaration").val() === "") {
                        $("#declaration").val("0");
                    }
                    if ($("#type").val() !== "مرضية") {
                        if (parseInt($("#acord").val()) <= parseInt($("#nbr_jour").val())) {
                            $("#cd").val(parseInt($("#nbr_jour").val()) - parseInt($("#acord").val()));
                            $("#nbr_jour_total").val(parseInt($("#declaration").val()) + parseInt($("#acord").val()));
                        } else {
                            alert("الايام الموافق عليها اكبر من الحجم القانوني");
                            $("#acord").val("");
                            $("#cd").val("");
                        }
                    }


                });
            });

        </script>


        <?php

        function get_from_table($n, $n1, $n2, $n3, $n4) {
            if ($n4 == 0) {
                $sql0 = "select " . $n . " from " . $n1 . " where " . $n2 . " = $n3";
            } elseif ($n4 == 1) {
                $sql0 = "select " . $n . " from " . $n1 . " where " . $n2 . " = '$n3'";
            }
            include 'dbcon.php';
            $result = $conn->query($sql0);
            $attr = "";
            while ($row = $result->fetch_assoc()) {
                $attr = $row["$n"];
            }
            return $attr;
        }
        ?>

        <?php
        if ($_SESSION['confim_demende'] == "0") {
            echo "<script>alert('تم رفض الطلب تاكد اذا كانت المعلومات المدخلة صحيحة فانك قدارسلن طلب مسبقا بنفس المعلومات ')</script>";
            $_SESSION['confim_demende'] = "";
        } elseif ($_SESSION['confim_demende'] == "1") {
            echo "<script>alert('تم تلقي الطلب بنجاح')</script>";
            $_SESSION['confim_demende'] = "";
        } elseif ($_SESSION['confim_demende'] == "-1") {
            echo "<script>alert('لا يمكن قبول الطلب لعدم وجود مستخلف')</script>";
            $_SESSION['confim_demende'] = "";
        }

        if ($_SESSION['id_confim'] == "0") {
            echo "<script>alert('خدث خطا ما يرجى اعادة المحاولة')</script>";
            update(-1, $_GET['id_emp'], $_GET['id_cert'], $_GET['date']);
        } elseif ($_SESSION['id_confim'] == "-1") {
            echo "<script>alert('هذا الموظف لايملك الحق في عطلة سنوية لانه استوفى كل الايام')</script>";
            update(-1, $_GET['id_emp'], $_GET['id_cert'], $_GET['date']);
        } elseif ($_SESSION['id_confim'] == "-2") {
            update(-1, $_GET['id_emp'], $_GET['id_cert'], $_GET['date']);

            echo "<script>alert('هذا العامل في عطلة مسبقا')</script>";
        } elseif ($_SESSION['id_confim'] == "1") {
            update(1, $_GET['id_emp'], $_GET['id_cert'], $_GET['date']);
        }

        $_SESSION['id_confim'] = "";

        function update($n1, $n2, $n3, $n4) {

            include 'dbcon.php';

            $sql = "UPDATE demende SET creat=$n1 WHERE id_emp=$n2 and id_mession=$n3 and date_conger='$n4'";

            $conn->query($sql);
        }
        ?>



    </body>
</html>