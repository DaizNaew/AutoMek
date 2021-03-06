<?php
include '../Includes/config.inc';
include '../Includes/cardata.inc';

$successRegister = false;

if ($_SERVER ["REQUEST_METHOD"] == "POST") {

	$mærke = mysqli_real_escape_string ( $db, $_POST ['mærke'] );

	$årgang = mysqli_real_escape_string ( $db, $_POST ['årgang'] );

	$motortype = mysqli_real_escape_string ( $db, $_POST ['motortype'] );

	$farve = mysqli_real_escape_string ( $db, $_POST ['farve'] );

	$stelnummer = mysqli_real_escape_string ( $db, $_POST ['stelnummer'] );

	$cardata = new cardata();

	if($cardata ->RegisterBil($mærke, $årgang, $motortype, $farve, $stelnummer) == 1) {
		$successRegister = true;
		header ( 'Refresh: 3; url=index.php' );
	}

}

?>

<!DOCTYPE html>
<html>
	<head>

	<title>Registrer ny bil</title>
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
						<li role="presentation" class="active"><a href="registercar.php">Registrer Bil</a></li>
						<li class="divider-vertical"></li>
						<li role="presentation" class="active"><a href="index.php">Bil booking</a></li>
						<li role="presentation" ><a href="../Testere/registercar.php">Testere</a></li>
						<li role="presentation" ><a href="../MotorBooking/registermotor.php">Motor booking</a></li>
					</ul>
				</nav>
				<h3 class="text-muted" style="align: center;">Registrer ny bil på værkstedet</h3>

			</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class='panel-title'>Registrer ny bil her</h3>
					</div>

					<div class='panel-errormessages'>
					<?php if ( $successRegister == true){ ?>
						<p style="color:green;">Der er blevet indsat en ny bil i databasen, du bliver nu redirected til index siden.</p>
					<?php }?>

					</div>

					<div class="panel-body">
						<form action="" method="POST" name="">

						<div class="form-group">
							<label>Mærke*</label><br>
							<input type="text" name="mærke" class="box" required />
						</div>
						<div class="form-group">
							<label>Årgang*</label><br>
							<input type="number" name="årgang" class="box" required />
						</div>
						<div class="form-group">
							<label>Farve*</label><br>
							<input type="text" name="farve" class="box" required />
						</div>
						<div class="form-group">
							<label>Motortype*</label><br>
							<input type="text" name="motortype" class="box" required />
						</div>

						<div class="form-group">
							<label>Stelnummer*</label><br>
							<input type="text" name="stelnummer" class="box" required />
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
