<?php
include '../Includes/config.inc';
include '../Includes/testere.inc';

$successRegister = false;

if ($_SERVER ["REQUEST_METHOD"] == "POST") {

	$navn = mysqli_real_escape_string ( $db, $_POST ['Navn'] );

	$type = mysqli_real_escape_string ( $db, $_POST ['Type'] );

	$software = mysqli_real_escape_string ( $db, $_POST ['Software'] );

	$pc = mysqli_real_escape_string ( $db, $_POST ['PC'] );

	$placering = mysqli_real_escape_string ( $db, $_POST ['Placering'] );

	$testere = new testere();

	if($testere ->RegisterTestere($navn, $type, $software, $pc, $placering) == 1) {
		$successRegister = true;
		header ( 'Refresh: 3; url=index.php' );
	}

}

?>

<!DOCTYPE html>
<html>
	<head>

	<title>Registrer ny tester</title>
	<link href="../style/bootstrap.css" rel="stylesheet" type="text/css">
	<meta charset="UTF-8">
	</head>
	<body>
		<div class="container-fluid" style="width: 85%">

			<div class="header clearfix" style="border-bottom: hidden">
				<nav>
					<ul class="nav nav-pills pull-right">
						<li role="presentation" class=""><a href="../index.html">Index</a></li>
						<li role="presentation" ><a href="index.php">Hjem</a></li>
						<li role="presentation" class="active"><a href="registercar.php">Registrer Tester</a></li>
						<li class="divider-vertical"></li>
						<li role="presentation" ><a href="../BilBooking/registercar.php">Bil booking</a></li>
						<li role="presentation" class="active"><a href="index.php">Testere</a></li>
						<li role="presentation" ><a href="../MotorBooking/registermotor.php">Motor booking</a></li>
					</ul>
				</nav>
				<h3 class="text-muted" style="align: center;">Registrer ny Tester til værkstedet</h3>

			</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class='panel-title'>Registrer ny tester her</h3>
					</div>

					<div class='panel-errormessages'>
					<?php if ( $successRegister == true){ ?>
						<p style="color:green;">Der er blevet indsat en ny tester i databasen, du bliver nu redirected til index siden.</p>
					<?php }?>

					</div>

					<div class="panel-body">
						<form action="" method="POST" name="">

						<div class="form-group">
							<label>Navn*</label><br>
							<input type="text" name="Navn" class="box" required />
						</div>
						<div class="form-group">
							<label>Type*</label><br>
							<input type="text" name="Type" class="box" required />
						</div>
						<div class="form-group">
							<label>Software*</label><br>
							<input type="text" name="Software" class="box" required />
						</div>
						<div class="form-group">
							<label>PC*</label><br>
							<input type="text" name="PC" class="box" required />
						</div>

						<div class="form-group">
							<label>Placering*</label><br>
							<input type="text" name="Placering" class="box" required />
						</div>

						<div class="form-group">
						<input class="btn btn-lg btn-success" type="submit" name="submit"/>
						</div>

						</form>

					</div>

				</div>

			<div class="footer"></div>
		</div>
	</body>
</html>
