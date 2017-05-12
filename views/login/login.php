<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<title>SIREHMED - Login</title>
		<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
	  	<form class="login-form" action = "logcheck.php" method = "post">
	    	<h1>SIREHMED</h1>
	     	<div class="form-group ">
		       	<input type="text" class="form-control" placeholder="Username " id="email" name="email">
		       	<i class="fa fa-user"></i>
	     	</div>
	     <div class="form-group log-status">
		    <input type="password" class="form-control" placeholder="Password" id="password" name="password">
		    <i class="fa fa-lock"></i>
	     </div>
	     <span class="alert">Invalid Credentials</span>
	     <button type="submit" class="log-btn" >Log in</button> 
	   </form>

	   

	  	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	    <script src="js/index.js"></script>
	</body>
</html>
