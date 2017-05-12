<!doctype html>

<?php
require_once "../../database/DatabaseMySQL.php";
require_once "../../models/Patient.php";

session_start();

$db = DatabaseMySQL::connect();

$thing = new Patient($db);
$procedure_id = $_GET['id'];
$procedure = $thing->getProcedureInfo($procedure_id);

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
                <a href="http://www.creative-tim.com" class="simple-text">
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
                    <a class="navbar-brand" href="#">Procedure</a>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Medicines</h4>
                            </div>
                            <div class="content">
                                <ul class="list-unstyled team-members">
                                    <li>
                                        <div class="row">

                                            <div class="col-xs-9">
                                                Medicine 1
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="row">
                                            <div class="col-xs-9">
                                                Medicine 2                                                         
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="row">
                                            <div class="col-xs-9">
                                                Medicine 3              
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <a href="javascript:showhide('uniquename')" class="btn btn-success btn-fill btn-wd">Add medicine</a><br><br>                       

                        <div class="row" id="uniquename" style="display:none;">
                            <div class="col-lg-12 col-md-5">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Add medicine</h4>
                                    </div>
                                    <div class="content">
                                        <ul class="list-unstyled team-members">
                                            <li>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <form>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Medicine name</label>
                                                                        <input type="text" class="form-control border-input" placeholder="Name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                                          
                                                            <button type="submit" class="btn btn-info btn-fill btn-wd">Add</button>
                                                            <div class="clearfix"></div>
                                                        </form>             
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>                       
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Procedure Information</h4>
                            </div>
                            <div class="content">
                                <form action="update_procedure.php" method="POST">

                                    <div class="row hidden">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Cause</label>
                                                <input type="text" class="form-control border-input" placeholder="Company" value="<?php echo($procedure_id)?>" name="procedure_id">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Cause</label>
                                                <input type="text" class="form-control border-input" placeholder="Company" value="<?php echo($procedure->cause)?>" name="cause">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <input type="text" class="form-control border-input" placeholder="Last Name" value="<?php echo($procedure->procedure_type)?>" name="procedure_type">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Observations</label>
                                            <textarea rows="5" class="form-control border-input" placeholder="Here can be your description" name="observations"><?php echo($procedure->observations)?></textarea>
                                        </div>
                                    </div>                                    

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input type="date" class="form-control border-input" placeholder="City" value="<?php echo($procedure->date_realized)?>" name="date_realized">
                                            </div>
                                        </div>
                                    </div>                                  
                                    <button type="submit" class="btn btn-info btn-fill btn-wd">Edit procedure</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>

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

	<!--  Charts Plugin -->
	<script src="../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="../assets/js/paper-dashboard.js"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="../assets/js/demo.js"></script>

    <script>
    function showhide(id) {
        var e = document.getElementById(id);
        e.style.display = (e.style.display == 'block') ? 'none' : 'block';
     }
     </script>

</html>
