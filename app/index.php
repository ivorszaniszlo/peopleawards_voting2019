<?php
/* After closed voting */
/*header("HTTP/1.1 301 Moved Permanently"); 
header("Location: http://localhost/peopleawards_voting2019/html/"); 
exit();*/


//Start session
session_start();

unset($_SESSION['ID']);
unset($_SESSION['NAME']);
unset($_SESSION['EMPLOYEE_ID']);
unset($_SESSION['USERNAME']);
?>
<!DOCTYPE HTML>
<html lang="hu-HU">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>People Awards 2019</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style_voter.css">
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.html">People Awards 2019</a>
        </div>

    </div><!-- /.container-fluid -->
</nav>
<!-- End Header -->

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-con">
                <h3>Belépés a szavazáshoz</h3>
                <?php
                if (isset($_SESSION['ERROR_MSG_ARRAY']) && is_array($_SESSION['ERROR_MSG_ARRAY']) && COUNT($_SESSION['ERROR_MSG_ARRAY']) > 0) {
                    foreach ($_SESSION['ERROR_MSG_ARRAY'] as $msg) {
                        echo "<div class='alert alert-danger'>";
                        echo $msg;
                        echo "</div>";
                    }
                    unset($_SESSION['ERROR_MSG_ARRAY']);
                }

                ?>
                <form method="post" action="process/login.php" role="form">
                    <div class="form-group has-warning has-feedback" >
                        <label class="arrow" role="tooltip" for="employee_id" data-toggle="tooltip" title="@ringieraxelspringer.hu, @profession.hu, @raspartner.hu, @blikk.hu, stb...">Add meg a vállalati email-címed!</label>
                        <input required type="text" value="" name="employee_id" id="employee_id" role="tooltip" class="form-control" autocomplete="off">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-warning has-feedback">
                        <label class="arrow" role="tooltip" for="password" data-toggle="tooltip" title="Ez az a jelszó, amivel belépsz a számítógépedbe. A szavazáshoz nincs szükséged bármilyen más, újonnan létrehozott jelszóra.">Add meg a Windows belépéshez használt jelszavad!</label>
                        <input required type="password" value="" name="password" id="password" class="form-control" autocomplete="off">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <button type="submit" name="submit" value="submit"  class="btn btn-info">Elküld</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">

    <div class="container">
        <div class="navbar-text pull-left">
            Copyright 2019 @ Ringier Axel Springer
        </div>
    </div>

</nav>
<!-- End Footer -->
<script>
$(function () {
$('[data-toggle="tooltip"]').tooltip()
})
</script>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>