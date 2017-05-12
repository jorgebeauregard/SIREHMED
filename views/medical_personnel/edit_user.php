<!doctype html>

<?php
require_once "../../database/DatabaseMySQL.php";
require_once "../../models/Personal.php";
require_once "../../models/Condition.php";


session_start();

$db = DatabaseMySQL::connect();

$user = new Personal($db);
$patient = $user->getPatientInfo((int)$_GET['id']);

$thing = new Condition($db);
$conditions = $thing->get((int)$_GET['id']);

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
                <a class="navbar-brand" href="#">Patient Edition</a>
            </div>
        </div>
    </nav>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Conditions</h4>
                            </div>
                            <div class="content">
                                <ul class="list-unstyled team-members">
                                    <li>
                                    <?php foreach($conditions as $condition){ ?>
                                        <div class="row">
                                            <div class="col-xs-9">
                                                <?php echo($condition->description)?>
                                            </div>
                                            <span><?php echo($condition->type)?></span>
                                        </div>
                                    <?php } ?>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <a href="javascript:showhide('uniquename')" class="btn btn-success btn-fill btn-wd">Add condition</a><br><br>                       
                        <div class="row" id="uniquename" style="display:none;">
                            <div class="col-lg-12 col-md-5">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Add condition</h4>
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
                                                                        <label>Condition name</label>
                                                                        <input type="text" class="form-control border-input" placeholder="Name" name="condition_description">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Condition </label>
                                                                        <select name="condition_type" class="form-control border-input">
                                                                            <option value="allergy">Allergy</option>
                                                                            <option value="suffering">Suffering</option>
                                                                        </select>                                                                    
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
                        <h4 class="title">Edit an existing patient</h4>
                    </div>
                    <div class="content">
                        <form action="update_patient.php" method="POST">
                            <div class="row hidden">                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control border-input" placeholder="Name" name="id" value="<?php echo($patient->id);?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control border-input" placeholder="Name" name="name" value="<?php echo($patient->name);?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control border-input" placeholder="Last Name" name="last_name" value="<?php echo($patient->last_name);?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Birth Date</label>
                                        <input type="date" class="form-control border-input" placeholder="Company" name="birth_date" value="<?php echo($patient->birth_date);?>">
                                    </div>
                                </div>
                            </div>                                    

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input type="number" class="form-control border-input" placeholder="Age in years" name="age" value="<?php echo($patient->age);?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control border-input" value="<?php echo($patient->gender);?>">
                                            <option selected hidden= "<?php echo($patient->gender)?>"> <?php echo($patient->gender)?> </option>
                                            <option value="masculine">Masculine</option>
                                            <option value="femenine">Femenine</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Blood Type</label>
                                        <select name="blood_type" class="form-control border-input" value ="<?php echo($patient->blood_type);?>">
                                            <option selected hidden= "<?php echo($patient->blood_type)?>"> <?php echo($patient->blood_type)?> </option>
                                            <option value="O-">O-</option>
                                            <option value="O+">O+</option>
                                            <option value="B-">B-</option>
                                            <option value="B+">B+</option>
                                            <option value="A-">A-</option>
                                            <option value="A+">A+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="AB+">AB+</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Emergency Contact Name</label>
                                        <input type="text" class="form-control border-input" placeholder="Name of the contact" name="emergency_name" value="<?php echo($patient->emergency_name);?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Emergency Contact Phone</label>
                                        <input type="text" class="form-control border-input" placeholder="Phone of the contact" name="emergency_phone" value="<?php echo($patient->emergency_phone);?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Height</label>
                                        <input type="text" class="form-control border-input" placeholder="Height in meters" name="height" value="<?php echo($patient->height);?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Weight</label>
                                        <input type="text" class="form-control border-input" placeholder="Weight in kilograms" name="weight" value="<?php echo($patient->weight);?>">
                                    </div>
                                </div>                                        
                            </div> 

                            <button type="submit" class="btn btn-info btn-fill btn-wd">Edit patient</button>

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
