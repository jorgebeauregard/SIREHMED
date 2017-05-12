<!doctype html>
<?php

require_once "../../database/DatabaseMySQL.php";
require_once "../../models/Patient.php";

session_start();

$db = DatabaseMySQL::connect();

$user = new Patient($db);
$e=$_SESSION['email'];
$id_obj = $user->getId($e);
$user->setId($id_obj->id);
$info_user = $user->get();

$procedures = $user->getMedicalProceduresList();


?>
<html lang="en">
<head>

	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>SIREHMED</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="../assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/themify-icons.css" rel="stylesheet">

</head>
<body>

    <div class="wrapper">
        <div class="sidebar" data-background-color="white" data-active-color="danger">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a class="simple-text">
                        SIREHMED
                    </a>
                </div>

                <ul class="nav">
                    <li class="active">
                        <a href="dashboard.php">
                            <i class="ti-panel"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li>
                        <a href="profile.php">
                            <i class="ti-user"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar2"></span>
                            <span class="icon-bar bar3"></span>
                        </button>
                        <a class="navbar-brand" href="#">Home</a>
                    </div>
                </div>
            </nav>


            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                    <?php foreach($procedures as $procedure){?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-info text-center">
                                                <i class="ti-notepad"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p><?php echo($procedure->procedure_type)?></p>
                                                <?php echo($procedure->cause)?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <br>
                                        <div>
                                            <a class="btn btn-info btn-fill btn-wd" href= <?php echo "procedure.php?id=".$procedure->id ?> >More information</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        

                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

    <!--   Core JS Files   -->
    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="../assets/js/bootstrap-checkbox-radio.js"></script>



</html>
