<?php
	include "session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>
    <script src="../assets/js/jquery-1.11.0.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css" />
    <!-- Bootstrap Core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- BOOTSTRAP STYLES-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="../assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="../assets/css/custom.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                <a class="navbar-brand" href="index.php">Log Book</a> 
            </div>

            <div style="color: white; padding: 15px 50px 5px 50px; float:right; font-size: 16px;"> Sistem Informasi Log Book Online Poltekkes Kemenkes Bengkulu  <a href="../assets/files/manualbook2017.pdf" class="btn btn-success ">Manual Book</a> | <a href="logout.php" class="btn btn-danger ">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="../assets/img/logo.png" class="user-image img-responsive"/>
                    </li>

                    <li>
                        <a class="active-menu"  href="index.php"><i class="fa fa-dashboard fa-2x"></i> Beranda</a>
                    </li>

                    <li>
                        <a href=""><i class="fa fa-desktop fa-2x"></i> Log Book<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a  href="01_tambah_logbook.php"><i class="fa fa-desktop fa-1x"></i> Input Log Book</a>
                                </li>

                                <li>
                                    <a  href="04_logbook_bulanan.php"><i class="fa fa-desktop fa-1x"></i> Log Book Bulanan</a>
                                </li>

                            </ul>
                    </li> 

                    <li>
                        <a href=""><i class="fa fa-desktop fa-2x"></i> SKP<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li>
                                    <a  href="03_tambah_skp.php"><i class="fa fa-desktop fa-1x"></i> Tambah SKP</a>
                                </li>

                                <li>
                                    <a  href="03_skp_bulanan.php"><i class="fa fa-desktop fa-1x"></i> SKP Bulanan</a>
                                </li>
                            </ul>
                    </li>

                    <li>
                        <a href=""><i class="fa fa-desktop fa-2x"></i> Penilaian<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a  href="10_validasi_logbook.php"><i class="fa fa-desktop fa-1x"></i>Log Book</a>
                                </li>
                                <li>
                                    <a  href="11_target_skp_pegawai.php"><i class="fa fa-desktop fa-1x"></i>SKP</a>
                                </li>
                                <li>
                                    <a  href="06_daftar_absensi_semua_pegawai.php"><i class="fa fa-desktop fa-1x"></i> Absensi </a>
                                </li>
                            </ul>
                    </li>

                    <li>
                        <a href=""><i class="fa fa-desktop fa-2x"></i> Import<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li>
                                    <a href="10_import_skp.php"><i class="fa fa-desktop fa-1x"></i> Import SKP</a>
                                </li>

                                <li>
                                    <a href="10_import_detail_skp.php"><i class="fa fa-desktop fa-1x"></i> Import Detail SKP</a>
                                </li>

                                <li>
                                    <a href="10_import_logbook.php"><i class="fa fa-desktop fa-1x"></i> Import Logbook</a>
                                </li>
                            </ul>
                    </li>            


                    <li>
                        <a href=""><i class="fa fa-desktop fa-2x"></i> Referensi<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a  href="01_edit_profil.php"><i class="fa fa-desktop fa-1x"></i> Edit Profil</a>
                                </li>

                                <li>
                                    <a  href="01_password.php"><i class="fa fa-desktop fa-1x"></i> Ubah Password</a>
                                </li>

                                <li>
                                    <a  href="08_daftar_help_dan_faq.php"><i class="fa fa-desktop fa-1x"></i> Help & FAQ</a>
                                </li>
                            </ul>
                    </li>

                    
                          
            </div>
            
        </nav>  
  
           
        <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <!-- JQUERY SCRIPTS -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="../assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="../assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
</body>
</head></html>