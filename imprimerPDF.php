<!doctype html>
<html >
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
        
        function arabicNumber($num) {

            $div = floor($num / 10);
            $mod = $num - $div * 10;

            $part1 = array('واحد', 'اثنان', 'ثلاثة', 'اربعة', 'خمسة', 'ستة', 'سبعة', 'ثمانية', 'تسعة');

            $part2 = array('عشر', 'عشرون', 'ثلاثون', 'اربعون', 'خمسون', 'ستون', 'سبعون', 'ثمانون', 'تسعون');

            if ($div == 1) {
                if ($mod == 1) {
                    $num = "احدا عشر يوم";
                } else if ($mod == 2) {
                    $num = "اثناعشر يوم";
                } else {
                    $num = $part1[$mod - 1] . "" . $part2[0] . "يوم";
                }
            } else if ($div > 1) {
                if ($mod != 0) {
                    $num = $part1[$mode - 1] . "و" . $part2[0] . "يوم";
                } ELSE {
                    $num = $part2[$div - 1] . " " . "يوم";
                }
            } elseif ($div < 1) {
                if ($mod == 1) {
                    $num = "يوم واحد";
                } elseif ($mod == 2) {
                    $num = "يومان";
                } else {
                    $num = $part1[$mode - 1] . "ايام";
                }
            }

            return $num;
        }

        include './dbcon.php';
        $id_emp = $_GET['id'];
        $type = $_GET['type'];
        if ($type == "print_conger") {
            $content = ob_get_clean();
            require_once './tcpdf/tcpdf.php';
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, TRUE, 'UTF_8', FALSE);
            $lg = array();
            $lg['a_meta_charset'] = 'UTF_8';
            $lg['a_meta_dir'] = 'rtl';
            $lg['a_meta_lnguage'] = 'ar';
            $lg['w_page'] = 'page';
            $pdf->SetPrintHeader(false);
            $pdf->setLanguageArray($lg);
            $pdf->setRTL(true);
            $pdf->AddPage();
            $pdf->Ln();
            $htmlcontent = "الجمهورية الجزائرية الديمقراطية";
            $htmlcontent1 = "وزارة التعليم العالي والبحث العلمي";
            $htmlcontent2 = "جامعة عمار الثليجي-الاغواط";
            $htmlcontent3 = "كلية";
            $htmlcontent4 = "مصلحة المستخدمين";
            $htmlcontent5 = "الاغواط في :";
            $htmlcontent6 = "سند عطلة";
            $htmlcontent7 = "الاسم و اللقب: " . get_from_table("nom_emp", "empolyer", "id_emp", $id_emp) . " " . get_from_table("prenom_emp", "empolyer", "id_emp", $id_emp);
            $htmlcontent8 = "الوظيفة: " . get_from_table("nom_grade", "grade", "id_grade", get_from_table("id_grade", "empolyer", "id_emp", $id_emp));
            $htmlcontent9 = "عدد الايام بالحروف :" . arabicNumber(get_from_table("nbr_total", "profitier", "id_emp", $id_emp));
            $htmlcontent10 = "نوعية العطلة: " . get_from_table("type_conger", "conger", "id_conger", get_from_table("id_conger", "profitier", "id_emp", $id_emp));
            $htmlcontent11 = "الرصيد المتبقي: " . get_from_table("nbr_jour_conger", "empolyer", "id_emp", $id_emp) . "يوم";
            $htmlcontent12 = "العنوان اثناء العطلة: " . get_from_table("adrass_conger", "profitier", "id_emp", $id_emp);
            $htmlcontent13 = "من: " . get_from_table("date_sortie", "profitier", "id_emp", $id_emp);
            $htmlcontent14 = "الى: " . get_from_table("date_entre", "profitier", "id_emp", $id_emp);
            $htmlcontent15 = "المدير";





            $pdf->Image("img/38477-universite-de-laghouat.jpg", 60, 10, 40, 40);
            $pdf->SetFont('aefurat', '', '12');
            $pdf->writeHTMLCell(100, 100, 80, 10, $htmlcontent, 0, 0, 0, true);
            $pdf->SetFont('aefurat', '', '10');
            $pdf->writeHTMLCell(100, 100, 10, 30, $htmlcontent1, 0, 0, 0, true);
            $pdf->writeHTMLCell(100, 100, 10, 40, $htmlcontent2, 0, 0, 0, true);
            $pdf->writeHTMLCell(100, 100, 20, 50, $htmlcontent3 . " " . get_from_table("nom_facl", "faculter", "id_facl", get_from_table("id_facl", "empolyer", "id_emp", $id_emp)), 0, 0, 0, true);
            $pdf->writeHTMLCell(100, 100, 10, 60, $htmlcontent4, 0, 0, 0, true);
            $pdf->writeHTMLCell(100, 100, 150, 60, $htmlcontent5 . " " . get_from_table("date_sortie", "profitier", "id_emp", $id_emp), 0, 0, 0, true);
            $pdf->SetFont('aefurat', '', '16');
            $pdf->writeHTMLCell(100, 100, 90, 70, $htmlcontent6, 0, 0, 0, true);
            $pdf->SetFont('aefurat', '', '12');
            $pdf->writeHTMLCell(100, 100, 10, 80, $htmlcontent7, 0, 0, 0, true);
            $pdf->writeHTMLCell(100, 100, 150, 80, "السنة : " . get_from_table("anne", "profitier", "id_emp", $id_emp), 0, 0, 0, true);
            $pdf->writeHTMLCell(100, 100, 10, 90, $htmlcontent8, 0, 0, 0, true);
            $pdf->writeHTMLCell(100, 100, 10, 100, $htmlcontent9, 0, 0, 0, true);
            $pdf->writeHTMLCell(100, 100, 120, 100, "بالارقام: " . get_from_table("nbr_total", "profitier", "id_emp", $id_emp) . "يوم", 0, 0, 0, true);
            $pdf->writeHTMLCell(100, 100, 10, 110, $htmlcontent13, 0, 0, 0, true);
            $pdf->writeHTMLCell(100, 100, 110, 110, $htmlcontent14, 0, 0, 0, true);
            $pdf->writeHTMLCell(100, 100, 10, 120, $htmlcontent10, 0, 0, 0, true);
            $pdf->writeHTMLCell(100, 100, 10, 130, $htmlcontent11, 0, 0, 0, true);
            $pdf->writeHTMLCell(100, 100, 10, 140, $htmlcontent12, 0, 0, 0, true);
            $pdf->writeHTMLCell(100, 100, 160, 160, $htmlcontent15, 0, 0, 0, true);
            $pdf->writeHTMLCell(100, 100, 10, 150, "المستخلف: " . get_from_table("remplacement", "demende", "id_emp", $_GET['id']), 0, 0, 0, true);
            $xc = 100;
            $yc = 100;

            $pdf->SetDrawColor(0, 0, 0);
            $pdf->Line($xc - 80, $yc + 100, $xc + 100, $yc + 100);
            $pdf->writeHTMLCell(300, 300, 10, 200, "عدم تاخر جزء او كل العطلة من السنة اخرى وفي حدود سنة على الاكثر في الاستثناءا)المادة 17 من القانون 08-81 بتاري<BR>ه 81/06/27 ويمنك تجزئة العطلة على الا تقل عن 15 بوما مننالية )م18((ت ", 0, 0, 0, true);
            $pdf->Line($xc - 80, $yc + 120, $xc + 100, $yc + 120);
            $pdf->writeHTMLCell(100, 30, 10, 230, "العنوان ص-ب رقم 37 ج الاغواط", 0, 0, 0, true);
            $pdf->writeHTMLCell(100, 30, 140, 230, "الموقع:http://www.lagh-univ.dz", 0, 0, 0, true);
            $pdf->writeHTMLCell(300, 30, 10, 240, "الهاتف:029.93.21.26 - 029.93.17.91 - 029.93.21.17 - 029.93.10.24 - 029.93.10.24 - 029.93.32.05 - 029.93.21.32  ", 0, 0, 0, true);
            $pdf->writeHTMLCell(300, 30, 80, 250, "الفاكس:029.93.26.98 ", 0, 0, 0, true);
            $pdf->Output('test.pdf');
        } else {

            echo "en creation!!!<br>";
            $date = $_GET['date_return'];
            echo $date . "<br>";
            echo get_from_table("date_sortie", "profitier", "id_emp", $_GET['id']) . "<br>";
            echo date("Y-m-d") . "<br>";

            if (date("Y-m-d") >= get_from_table("date_sortie", "profitier", "id_emp", $_GET['id'])) {
                $day_curent = date("d");
                $month_curent = date("m");
                $year_curent = date("Y");
                $day = date('d', strtotime($date));
                $month = date("m", strtotime($date));
                $year = date("Y", strtotime($date));
                $deff = abs(365 * ((int) $year_curent - (int) $year) + 30 * ((int) $month_curent - (int) $month) + ((int) $day_curent - (int) $day));
                if ($_GET['type_conger'] == "سنوية") {
                    $sql = "delete from profitier where id_emp=$id_emp and id_conger =" . get_from_table("id_conger", "conger", "type_conger", "سنوية");
                    $conn->query($sql);
                    echo $deff . "<br>";
                    $deff = (int) $deff + (int) get_from_table("nbr_jour_conger", "empolyer", "id_emp", $id_emp);
                    echo $deff;
                    $sql = "UPDATE empolyer SET nbr_jour_conger=$deff WHERE id_emp=$id_emp";
                    $conn->query($sql);
                    $_SESSION['dat'] = "1";
                }
            } else {
                $_SESSION['dat'] = "0";
            }
            header("Location: conger_user.php");
        }

        function get_from_table($n, $n1, $n2, $n3) {

            include 'dbcon.php';
            $sql0 = "select " . $n . " from " . $n1 . " where " . $n2 . " = '$n3'";
            $result = $conn->query($sql0) or die($conn->error);
            while ($row = $result->fetch_assoc()) {
                $attr = $row["$n"];
            }

            return $attr;
        }
        ?>







    </body>
</html>

