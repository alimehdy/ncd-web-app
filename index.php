<?php
	include_once('./php/login.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <title>NCD Web Application</title>

        <!-- CSS -->
        <link rel="stylesheet" href="css/font.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="./images/Medair_Logo_2013.png">
        <link rel="stylesheet" href="./css/vert_tabs.css">
    </head>
    <body>
    <!-- Top content -->
    <div class="top-content">
    	
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-5 col-sm-offset-2">
                        <h1><strong>NCD Web Application</strong></h1>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-box center">
                    	<div class="form-top">
                    		<div class="form-top-left">
                    			<h3>Clinic Login</h3>
                        		<p id="lblTxt">Enter Username and Password</p>
                    		</div>
                    		<div class="form-top-right">
                    			<i class="fa fa-lock"></i>
                    		</div>
                        </div>
                        <div class="form-bottom">
		                    <form id="myForm" role="form" class="login-form">
		                    	<div class="form-group">
		                    		<label class="sr-only" for="form-username">Username</label>
		                        	<input type="text" name="form-username" id="form-username" placeholder="Username..." class="form-username form-control" id="form-username">
		                        </div>
		                        <div class="form-group">
		                        	<label class="sr-only" for="form-password">Password</label>
		                        	<input type="password" name="form-password" id="form-password" placeholder="Password..." class="form-password form-control" id="form-password">
		                        </div>
		                        <button type="button" name="loginBtn" id="loginBtn" class="btn btn-primary">Login</button>
		                    </form>
	                    </div>

                    </div>
                </div>

            </div>
        </div>
        
    </div>
        
        <!-- Javascript -->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/login.js"></script>
   	</body>

</html>