<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Organization
require("classes/Organization.php");

//Include class Position
require("classes/Position.php");

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
                <li class="active"><a href="add_pos.php"><span class="glyphicon glyphicon-plus-sign"></span>Új Kategória</a></li>
                <li><a href="add_nominees.php"><span class="glyphicon glyphicon-plus-sign"></span>Új Jelölt</a></li>
                <li><a href="add_voters.php"><span class="glyphicon glyphicon-plus-sign"></span>Új Szavazó</a></li>
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
        <div class="col-md-4">
            <h4>Új Kategória</h4><hr>
            <?php

            if(isset($_POST['submit'])) {

                $organization   = trim($_POST['organization']);
                $pos            = trim($_POST['position']);

                $insertPos = new Position();
                $rtnInsertPos = $insertPos->INSERT_POS($organization, $pos);
            }
            ?>
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form">
                <?php
                $readOrg = new Organization();
                $rtnReadOrg = $readOrg->READ_ORG();
                ?>
                <div class="form-group-sm">
                    <label for="organization">Szervezet</label>
                    <?php if($rtnReadOrg) { ?>
                    <select required name="organization" class="form-control">
                        <option value="">*****Válasszon Szervezetet*****</option>
                        <?php while($rowOrg = $rtnReadOrg->fetch_assoc()) { ?>
                        <option value="<?php echo $rowOrg['org']; ?>"><?php echo $rowOrg['org']; ?></option>
                        <?php } //End while ?>
                    </select>
                    <?php $rtnReadOrg->free(); ?>
                    <?php } //End if ?>
                </div>
                <div class="form-group-sm">
                    <label for="position">Kategória</label>
                    <input required type="text" name="position" class="form-control">
                </div><hr/>
                <div class="form-group-sm">
                    <input type="submit" name="submit" value="Hozzáad" class="btn btn-info">
                </div>
            </form>
        </div>

        <?php
        $readPos = new Position();
        $rtnReadPos = $readPos->READ_POS();
        ?>
        <div class="col-md-8">
            <h4>Kategórialista</h4><hr>
            <div class="table-responsive">
                <?php if($rtnReadPos) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th>Szervezet</th>
                        <th>Kategória</th>
                        <th><span class="glyphicon glyphicon-edit"></span></th>
                        <th><span class="glyphicon glyphicon-remove"></span></th>
                    </tr>
                    <?php while($rowPos = $rtnReadPos->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $rowPos['org']; ?></td>
                        <td><?php echo $rowPos['pos']; ?></td>
                        <td><a href="http://localhost/peopleawards_voting2019/app/sandbox/edit_pos.php?id=<?php echo $rowPos['id']; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                        <td><a href="http://localhost/peopleawards_voting2019/app/sandbox/delete_pos.php?id=<?php echo $rowPos['id']; ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
                    </tr>
                    <?php } //End while ?>
                </table>
                    <?php $rtnReadPos->free(); ?>
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


<?php
//Close database connection
$db->close();