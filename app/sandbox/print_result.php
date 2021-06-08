<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Organization
require("classes/Organization.php");

//Include class Position
require("classes/Position.php");

//Include class Nominees
require("classes/Nominees.php");

?>
<!DOCTYPE HTML>
<html lang="hu-HU">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Result</title>
   <!-- Bootstrap Datatables  -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<!-- Bootstrap Datatables  -->
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../assets/css/style_admin.css">
	<script>
$(document).ready(function() {
    $('.resultTable').DataTable( {
		dom: 'Bfrtip',
		buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
		 "paging":   false,
		 "info":     false,
        "order": [[ 2, "desc" ]]
    } );
} );
</script>
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
            <a class="navbar-brand" href="../index.html">People Awards 2019</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="admin_page.php"><span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="add_org.php"><span class="glyphicon glyphicon-plus-sign"></span>Új Szervezet</a></li>
                <li><a href="add_pos.php"><span class="glyphicon glyphicon-plus-sign"></span>Új Kategória</a></li>
                <li><a href="add_nominees.php"><span class="glyphicon glyphicon-plus-sign"></span>Új Jelölt</a></li>
                <li><a href="add_voters.php"><span class="glyphicon glyphicon-plus-sign"></span>Új Szavazó</a></li>
                <li class="active"><a href="vote_result.php"><span class="glyphicon glyphicon-plus-sign"></span>Szavazás Eredménye</a></li>
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

        <div class="col-md-12">
            <?php
            if(!isset($_GET['organization'])) {
                echo "<div class='alert alert-warning'>Kérem válasszon szervezetet and kattintson az elküldéshez az eredménylistához!</div>";
            } else {
                $org = trim($_GET['organization']);
                ?>
                <?php
                $readPos = new Position();
                $rtnReadPos = $readPos->READ_POS_BY_ORG($org);
                ?>

                <?php if($rtnReadPos) { ?>

                    <?php while($rowPos = $rtnReadPos->fetch_assoc()) { ?>
                        <h5><?php echo $rowPos['pos']; ?></h5>

                        <?php
                        $readNomOrgPos = new Nominees();
                        $rtnReadNomOrgPos = $readNomOrgPos->READ_NOM_BY_ORG_POS($org, $rowPos['pos']);
                        ?>

                        <div class="table-responsive">
                            <?php if($rtnReadNomOrgPos) { ?>
                                <table id="resultTable" class="resultTable display table table-condensed table-striped" style="width:100%">
									<thead>
										<tr>
											<th>ID</th>
											<th>Name</th>
											<th>Votes</th>
										</tr>
									</thead>
									<tbody>
                                    <?php while($rowCountVotes = $rtnReadNomOrgPos->fetch_assoc()) { ?>




                                        <?php
                                        $countVotes = new Nominees();
                                        $rtnCountVotes = $countVotes->COUNT_VOTES($rowCountVotes['id'])
                                        ?>
                                        <tr>
                                            <td style="width: 20%;"><?php echo $rowCountVotes['id']; ?></td>
                                            <td style="width: 70%;"><?php echo $rowCountVotes['name']; ?></td>
                                            <td style="width: 10%;"><?php echo $rtnCountVotes->num_rows; ?></td>
                                        </tr>





                                    <?php } //End while ?>
									</tbody>
									<tfoot>
										<tr>
											<th>ID</th>
											<th>Név</th>
											<th>Szavazatok</th>
										</tr>
									</tfoot>
                                </table>
                                <?php $rtnReadNomOrgPos->free(); } //End if ?>
                        </div>

                    <?php } //End while ?>

                    <?php $rtnReadPos->free(); } //End if ?>

            <?php } //End if ?>
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

</body>
</html>
<?php
//Close database connection
    $db->close();