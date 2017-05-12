<!doctype html>
<?php

require_once "../../database/DatabaseMySQL.php";
require_once "../../models/Personal.php";

session_start();

$db = DatabaseMySQL::connect();

$user = new Personal($db);
$patients = $user->getAllPatients();

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
                        <div class="col-md-12">
                            <div class="card">

                                <div class="header">
                                    <h4 class="title">List of patients</h4>
                                    <br>
                                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
                                </div>

                                <div class="content table-responsive table-full-width">
                                    <table id="myTable" class="table table-striped">
                                      <tr class="header">
                                        <th>Last Name</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Height</th>
                                        <th>Weight</th>
                                        <th>Action</th>
                                      </tr>
                                      
                                      <?php foreach($patients as $patient){ ?>
                                      <tr>
                                        <td><?php echo($patient->last_name);?></td>
                                        <td><?php echo($patient->name);?></td>
                                        <td><?php echo($patient->age);?></td>
                                        <td><?php echo($patient->gender);?> </td>
                                        <td><?php echo($patient->height);?> </td>
                                        <td><?php echo($patient->weight);?></td>
                                        <td>
                                            <a href=<?php echo "edit_user.php?id=" . $patient->id ?> class="btn btn-info btn-fill btn-wd">Edit Profile</a>
                                            <a href=<?php echo "create_procedure.php?id=" . $patient->id ?> class="btn btn-success btn-fill btn-wd">Add procedure</a>
                                            <a href=<?php echo "procedures.php?id=" . $patient->id?> class="btn btn-warning btn-fill btn-wd">Show procedures</a>
                                        </td>
                                      </tr>
                                      <?php } ?>

                                    </table>
                                </div>

                            </div>
                             <a href="create_user.php" class="btn btn-success btn-fill btn-wd">Add user</a>
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

    <script>
        function myFunction() {
          var input, filter, table, tr, td, i;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable");
          tr = table.getElementsByTagName("tr");

          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
              if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            } 
          }
        }
</script>



</html>
