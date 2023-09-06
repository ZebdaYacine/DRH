<?php
include 'dbcon.php';
session_start();
                        $sql = "select * from msg";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $date0 = $row["date"];
                                if ($_SESSION['ide'] == $row["fromemp"] && $_SESSION['toid'] == $row["toemp"]) {
                                    rtl($date0, $row["msg"]);
                                } else if ($_SESSION['ide'] == $row["toemp"] && $_SESSION['toid'] == $row["fromemp"]) {
                                    ltr($date0, $row["msg"]);
                                }
                            }
                        }
                        function rtl($date0, $msg) {
                            echo "<div title='$date0'>";
                            echo "<div class='d-inline-block' style='background-color:#75CCFF;border-radius:10px 20px 0px 10px;padding:5px 10px;margin-top:10px'>" . $msg . "</div>";
                            echo "</div>";
                        }

                        function ltr($date0, $msg) {
                            echo "<div title='$date0' dir='ltr' class='text-left'>";
                            echo "<div class='alert text-right d-inline-block' style='background-color:#e9ecef;border-radius:20px 10px 10px 0px;padding:5px 10px;margin-top:10px'>" . $msg . "</div>";
                            echo "</div>";
                        }

                        $conn->close();
                       
