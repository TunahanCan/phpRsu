<?php
//error_reporting(E_ALL ^ E_DEPRECATED);
include("connect.php");
$link=Connection();

//dikkatinin çekerim pdo nesnesi kullandım :D
$result =  $link->query("SELECT * FROM `GecisUstunlugu` ORDER BY `ustunluk` DESC LIMIT 10",PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Road Side Unit Admin Page</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
<div id="wrapper">
    <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"> Admin </a>
        </div>
        <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"><a href="./cikis.php" title="cikis" class="btn btn-danger square-btn-adjust">Cikis Yap</a> </div>
    </nav>
    <!-- /. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
                <li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
                </li>


                <li>
                    <a  href="adminAnasayfa.php"><i class="fa fa-dashboard fa-3x"></i> AnaSayfa</a>
                </li>
                <li>
                    <a  href="adminRsuGoster.php"><i class="fa fa-desktop fa-3x"></i>Rsu Verileri</a>
                </li>
                <li>
                    <a  href="adminSensorGoster.php"><i class="fa fa-qrcode fa-3x"></i> Sensör Bilgileri</a>
                </li>
                <li  >
                    <a   href="kazaLokasyonlari.php"><i class="fa fa-bar-chart-o fa-3x"></i> Lokasyon Bilgileri</a>
                </li>
                <li  >
                    <a  class="active-menu"  href="adminKullaniciGoster.php"><i class="fa fa-table fa-3x"></i> Kullacilari Goster </a>
                </li>
                <li  >
                    <a  href="HaritaGoster.php"><i class="fa fa-edit fa-3x"></i> RSU Bilgileri </a>
                </li>

            </ul>

        </div>

    </nav>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Admin Sayfası</h2>
                </div>
            </div>



            <!-- /. ROW  -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Araç Kullanicilari
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>Arac ID</th>
                                        <th>Ustunluk</th>
                                        <th>Bilgi</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if($result!==FALSE){

                                        if($result->rowCount()) {

                                            foreach( $result as $row ){


                                                printf("<tr class='danger'><td> %s </td><td> %s </td><td> %s </td><td>",
                                                    $row["Aracid"], $row["ustunluk"], $row["bilgi"]);


                                            }


                                        }
                                        echo $result->errorCode();

                                    }
                                    ?>


                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
                <!-- /. ROW  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <div id="footer">
        <small> <!-- Remove this notice or replace it with whatever you want -->
            &#169; Copyright 2017 | Powered by <a href="http://www.sakarya.edu.tr">Rsu Proje geliştirme grubu</a>.
        </small>
    </div><!-- End #footer -->


    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- MORRIS CHART SCRIPTS -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>


</body>
</html>
