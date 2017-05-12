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

$conditions = $user->getMedicalConditionList();

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
                <li>
                    <a href="dashboard.php">
                        <i class="ti-panel"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="active">
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
                    <a class="navbar-brand" href="#">User Profile</a>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="card card-user">
                            <div class="image">
                                <img src="../assets/img/background.jpg" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                  <img class="avatar border-white" src="../assets/img/faces/face-2.jpg" alt="..."/>
                                  <h4 class="title"> <?php echo($info_user->name); echo(' ');echo($info_user->last_name);?> <br />
                                  </h4>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Conditions</h4>
                            </div>
                            <div class="content">
                                <ul class="list-unstyled team-members">
                                    <?php foreach($conditions as $condition){
                                    ?>

                                            <li>
                                                <div class="row">
                                                    <div class="col-xs-9">
                                                        <?php echo($condition->condition_description)?>
                                                        <br />
                                                        <span class="text-danger"><small><?php echo($condition->condition_type)?></small></span>
                                                    </div>
                                                    
                                                    <div class="col-xs-3 text-right">
                                                        <btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-file"></i></btn>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    <?php } ?>    
                                    
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Medical Data</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="Company" value="<?php echo($info_user->name);?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="Last Name" value="<?php echo($info_user->last_name);?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Birth Date</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="Company" value="<?php echo($info_user->birth_date);?>">
                                            </div>
                                        </div>
                                    </div>                                    

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="City" value="<?php echo($info_user->age);?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="Country" value="<?php echo($info_user->gender);?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Blood Type</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="ZIP Code" value="<?php echo($info_user->blood_type);?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Emergency Contact Name</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="City" value="<?php echo($info_user->emergency_name);?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Emergency Contact Phone</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="Country" value="<?php echo($info_user->emergency_phone);?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Body Mass Index</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="City" value="<?php echo($info_user->body_mass_index);?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Height</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="City" value="<?php echo($info_user->height);?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Weight</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="City" value="<?php echo($info_user->weight);?>">
                                            </div>
                                        </div>                                        
                                    </div>                                    

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

</html>
