<?php date_default_timezone_set("Etc/GMT+8"); ?>
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

<body class="bg-dark" onload="otp()">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"></nav>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card 0-hidden border-0 shadow-lg my-500">
                    <div class="card-body p-100">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block"><img src="image/logo.png" height="100%"
                                    width="100%" /></div>
                            <div class="col-lg-6">
                                <div class="p-500">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Change Password</h1>
                                    </div>
                                    <form method="POST" class="user" action="checker.php">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="email"
                                                placeholder="Enter email address.." required="required">
                                        </div>
                                        <input type="hidden" name="otp" id="otp"/>
                                       
                                        <button type="submit" class="btn btn-primary btn-user btn-block mt-3 exec_otp"
                                            name="login">Send OTP</button>
                                        </select>
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
            <tbody>
                <tr>
                    <td align="center">
                        <label style="color:#ffffff;">
                            <p>&copy; LAGUNA UNIVERSITY CREDIT COOPERATIVE LOAN MANAGEMENT SYSTEM All Rights Reserved
                                2023
                        </label>
                        <p>
    </nav>
</body>
<script>
function otp() {
    document.getElementById("otp").value = <?php  echo(rand(1000,9999));?>;
       document.cookie = "otp_id="+document.getElementById("otp").value;
}
      

</script>
</html>