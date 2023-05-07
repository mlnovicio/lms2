<?php date_default_timezone_set("Etc/GMT+8");?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>LAGUNA UNIVERSITY CREDIT COOPERATIVE LOAN MANAGEMENT SYSTEM</title>

    <link href="css/all.css" rel="stylesheet" type="text/css">
  
   
    <link href="css/sb-admin-2.css" rel="stylesheet">
    
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
         <table style="width: 100%;" cellspacing="0" cellpadding="0" class="form_tab">
                <tbody><tr>
                  <td align="center">
		<!-- <a class="navbar-brand" href="">PRMSU Multi-Purpose Cooperative Web Based System</a> -->
        </div>
	</nav>
    <div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card 0-hidden border-0 shadow-lg my-500">
                    <div class="card-body p-100">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block"><img src="image/logo.png" height="100%" width="100%"/></div>
                            <div class="col-lg-6">
                                <div class="p-500">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">LOGIN NOW</h1>
                                    </div>
                                    <form method="POST" class="user" action="login.php">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" placeholder="Enter Username here..." required="required">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" placeholder="Enter Password here..." required="required">
                                        </div>
										<?php 
											session_start();
											if(ISSET($_SESSION['message'])){
												echo "<center><label class='text-danger'>".$_SESSION['message']."</label></center>";
											}
										?>
                                        <button type="submit" class="btn btn-primary btn-user btn-block mt-3" name="login">Login</button>
                                        </select>
                                        <p>Don't have an account? <a href="register_form.php">Register now<action="register_form.php"><src="LMS/register/register_form.php"></a></p>
                                        <!-- custom css file link  -->
                                    </form>
                                    <div class="form-group">
                                    <!--<a target="_blank" href="https://docs.google.com/document/d/1pkAoOOoXfX6Rc0EW7L7vkWrOtHMFHVl5/edit?usp=share_link&ouid=103119561855284624842&rtpof=true&sd=true"><i class="fa-sharp fa-solid fa-download"></i> Download Form </a>-->
                                    </div>
                                    <link rel="stylesheet" href="css/style.css">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <nav class="navbar fixed-bottom navbar-dark bg-dark"> 
    <table style="width: 100%;" cellspacing="0" cellpadding="0" class="form_tab">
                <tbody><tr>
                  <td align="center">
		<label style="color:#ffffff;"><p>&copy; LAGUNA UNIVERSITY CREDIT COOPERATIVE LOAN MANAGEMENT SYSTEM All Rights Reserved 2023</label><p>
	</nav>
</body>

</html>