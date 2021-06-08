<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Voters
require("classes/Voters.php");

?>
<!DOCTYPE HTML>
<html lang="hu-HU">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style_admin.css">
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../../index.html">People Awards 2019</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="admin_page.php"><span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="add_org.php"><span class="glyphicon glyphicon-plus-sign"></span>Új Szervezet</a></li>
                <li><a href="add_pos.php"><span class="glyphicon glyphicon-plus-sign"></span>Új Kategória</a></li>
                <li><a href="add_nominees.php"><span class="glyphicon glyphicon-plus-sign"></span>Új Jelölt</a></li>
                <li class="active"><a href="add_voters.php"><span class="glyphicon glyphicon-plus-sign"></span>Új Szavazó</a></li>
                <li><a href="vote_result.php"><span class="glyphicon glyphicon-plus-sign"></span>Szavazás Eredménye</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="process/logout.php">Kijelentkezés</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->

    </div><!-- /.container-fluid -->
</nav>
<!-- End Header -->




<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php
            if(isset($_POST['submit'])) {
                $name       = trim($_POST['name']);
                $username       = trim($_POST['username']);
                $company   = trim($_POST['company']);
                $employee_id    = trim($_POST['employee_id']);

                $insertVoter = new Voters();
                $rtnInsertVoter = $insertVoter->INSERT_VOTER($name, $username, $company, $employee_id);
            }
            ?>

            <h4>Új Szavazó</h4><hr>
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form">
                <div class="form-group-sm">
                    <label for="name">Név</label>
                    <input required type="text" name="name" class="form-control" placeholder="Vezetéknév Keresztnév">
                </div>
                <div class="form-group-sm">
                    <label for="company">Cégnév</label>
                    <input required type="text" name="company" class="form-control" placeholder="Cég">
                </div>
                <div class="form-group-sm">
                    <label for="username">Felhasználónév</label>
                    <input required type="text" name="username" class="form-control">
                </div>
                <div class="form-group-sm">
                    <label for="employee_id">Email cím</label>
                    <input required type="text" name="employee_id" class="form-control">
                </div><hr>
                <div class="form-group-sm">
                    <input type="submit" name="submit" value="Hozzáad" class="btn btn-info">
                </div>
            </form>
        </div>

        <?php
        $readVoters = new Voters();
        $rtnReadVoters = $readVoters->READ_VOTERS();
        ?>
        <div class="col-md-9">
            <h4>Szavazók Listája</h4><hr>
            <div class="table-responsive">
                <?php if($rtnReadVoters) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th>Név</th>
                        <th>Felhasználónév</th>
                        <th>Cég</th>
                        <th>Azonosító (Email cím)</th>
                        <th><span class="glyphicon glyphicon-edit"></span></th>
                        <th><span class="glyphicon glyphicon-remove"></span></th>
                    </tr>
                    <?php while($rowVoter = $rtnReadVoters->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $rowVoter['name']; ?></td>
                        <td><?php echo $rowVoter['username']; ?></td>
                        <td><?php echo $rowVoter['company']; ?></td>
                        <td><?php echo $rowVoter['employee_id']; ?></td>
                        <td><a href="http://localhost/peopleawards_voting2019/app/sandbox/edit_voter.php?id=<?php echo $rowVoter['id']; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                        <td><a href="http://localhost/peopleawards_voting2019/app/sandbox/delete_voter.php?id=<?php echo $rowVoter['id']; ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
                    </tr>
                    <?php } //End while ?>
                </table>
                    <?php $rtnReadVoters->free(); ?>
                <?php } //End if ?>
            </div>
        </div>
    </div>
</div>






<!-- Footer -->
<nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">

    <div class="container">
        <div class="navbar-text pull-left">
            Copyright 2018 @ Ringier Axel Springer
        </div>
    </div>

</nav>
<!-- End Footer -->

<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

</body>
</html>