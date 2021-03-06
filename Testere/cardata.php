<?php
include '../Includes/config.inc';
include '../Includes/testere.inc';


$bilID = $_GET['carID'];
if(isset($_GET['reserved'])){
	$reserveFail = $_GET['reserved'];
}else{ $reserveFail = 1; }

$cardata = new testere();

$caresult = $cardata -> SelectBil($bilID);

$carArrayData = $caresult['bilData'];
$carordered = $caresult['bilBestilte'];
$carerrors = $caresult['bilFejl'];
$carequipment = $caresult['bilUdstyr'];
$carreserved = $caresult['bilReserveret'];

$bilNavn = $carArrayData['Navn'];
$bilPC = $carArrayData['PC'];
$bilPlacering = $carArrayData['Placering'];
$bilSoftware = $carArrayData['Software'];
$bilType = $carArrayData['Type'];

?>

<!DOCTYPE html>
<html>
	<head>

	<style>
	th, td {padding: 5px; padding-top:0px; border-bottom: 1px solid #ddd; text-align: center; }
	td.bordered {border-left: 1px solid #ddd; border-right: 1px solid #ddd; }
	tr.hoverable:hover {background-color: #f5f5f5;}
	td.hoverable:hover {background-color: #f5f5f5;}
	table {width: 100%;}
	#fejlForm { width: 50%; margin: auto;}
	#udstyrForm {width: 30%; margin: auto;}
	#brugForm { width: 29%; margin: auto; }
	#reservedelsForm { width: 57%; margin: auto; }
	#reserverForm { width: 48%; margin: auto; }
	#afleverForm { width: 47%; margin: auto; }
	#antalTesterForm { width: 52%; margin: auto;}
	</style>

	<title><?php echo $bilNavn." ".$bilType." ".$bilSoftware; ?></title>


	<link href="../style/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="../style/jquery-ui.css" rel="stylesheet" type="text/css">
	<link href="../style/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css">

	<script src="../script/jquery-1.9.1.min.js"></script>
	<script src="../script/bootstrap-datepicker.min.js"></script>
	<script src="../locales/bootstrap-datepicker.da.min.js"></script>
	<meta charset="UTF-8">

	</head>
	<body>
		<div class="container-fluid" style="width: 85%">

			<div class="header clearfix" style="border-bottom: hidden">
				<nav>
					<ul class="nav nav-pills pull-right">
						<li role="presentation"><a href="index.php">Hjem</a></li>
					</ul>
				</nav>
				<h3 class="text-muted" style="align: center;">Viser alle data vedrørende: <?php echo $bilNavn;?> | Af typen: <?php echo $bilType;?></h3>
				<?php if($reserveFail == 0){
					?>
					<h3 style="color: red;">Bilen er allerede reserveret til den valgte dato.</h3>
					<?php
				} ?>
			</div>

			<div class="jumbotron">

			<div style="overflow-x:auto;">

				<table style="border: solid 1px #ddd; " >
				<tr >

				<td><h3>Navn</h3></td>
				<td><h3>PC</h3></td>
				<td><h3>Placering</h3></td>
				<td><h3>Software</h3></td>
				<td><h3>Type</h3></td>

				</tr>
				<tr class="hoverable">
				<td><p class="text-muted"><?php echo $bilNavn; ?></p></td>
				<td><p class="text-muted"><?php echo $bilPC; ?></p></td>
				<td><p class="text-muted"><?php echo $bilPlacering; ?></p></td>
				<td><p class="text-muted"><?php echo $bilSoftware; ?></p></td>
				<td><p class="text-muted"><?php echo $bilType; ?></p></td>
				</tr>
				</table>
				<br>

				<div style="margin: 22px; border-bottom: solid 3px white; "></div>
				<h2>Udstyr</h2>

					<form method="GET" action="registerequipment.php" id="udstyrForm">
					<label>Udstyr: </label><input type="text" class="input-sm" name="udstyrNavn" required>
					<input type="hidden" name="IDbil" value="<?php echo $bilID; ?>">
					<input type="submit" class="btn btn-primary" name="submit" value="Registrer udstyr">
					</form>

				<br>
				<table>
				<?php echo $cardata->ConstructUdstyrTable($bilID); ?>
				</table>

				<br>



				<div style="margin: 22px; border-bottom: solid 3px white; "></div>
				<h2>Fejl</h2>

					<form method="GET" action="registerdefect.php" id="fejlForm">
					<label>Fejl Type: </label><input type="text" class="input-sm" name="fejlNavn" required>
					<label>Lærer Navn: </label><input type="text" class="input-sm" name="læreNavn">
					<input type="hidden" name="IDbil" value="<?php echo $bilID; ?>">
					<input type="submit" class="btn btn-primary" name="submit" value="Registrer fejl">
					</form>

				<br>

				<?php if(count($carerrors)/3 != 0){

				?>
				<table style="border: solid 1px #ddd; " >
				<tr>

				<td><h3>Fejl</h3></td>
				<td><h3>Godkendt af</h3></td>
				<td><h3>Slet Fejl</h3></td>

				</tr>

				<?php $arrayLength = count($carerrors) / 3;

				for($i = 0; $i < $arrayLength; $i++) {
					$o = $i+1;
					?>

					<tr class="hoverable">

					<td><p class="text-muted"><?php echo $carerrors['Fejl'.$i]; ?></p></td>

					<td><p class="text-muted"><?php echo $carerrors['Lære'.$i]; ?></p></td>

					<td><button name="sletFejl" class="btn btn-danger sletFejl" value="<?php echo $carerrors['ID'.$o] ?>">Slet</button></td>


					</tr>

					<?php }	?>

				</table>
				<br>
			<?php }?>

			<script>

			$(document).ready(function(){
			    $(".sletFejl").click(function(){
				    $.ajax( { url: 'deletedefect.php?fejlID='+ $(this).attr("value") } );
				    location.reload();
			    });
			});

			</script>

			<br>



			<div style="margin: 22px; border-bottom: solid 3px white; "></div>
			<h2>Antal</h2>

				<form method="GET" action="registeramount.php" id="antalTesterForm">
				<label>Antal Testere: </label><input type="text" class="input-sm" name="testereAntal" required>
				<label>Lærer Navn: </label><input type="text" class="input-sm" name="læreNavn">
				<input type="hidden" name="IDbil" value="<?php echo $bilID; ?>">
				<input type="submit" class="btn btn-primary" name="submit" value="Registrer fejl">
				</form>

			<br>

			<table style="border: solid 1px #ddd; " >
			<tr>

			<td><h3>Antal</h3></td>
			<td><h3>Bestilt af</h3></td>
			<td><h3>Slet Antal</h3></td>

			</tr>

			<?php $arrayLength = count($carordered) / 3;

			for($i = 0; $i < $arrayLength; $i++) {
				$o = $i+1;
				?>

				<tr class="hoverable">

				<td><p class="text-muted"><?php echo $carordered['Antal'.$i]; ?></p></td>

				<td><p class="text-muted"><?php echo $carordered['Lærer'.$i]; ?></p></td>

				<td><button name="sletAntal" class="btn btn-danger sletAntal" value="<?php echo $carordered['ID'.$o] ?>">Slet</button></td>


				</tr>

				<?php }	?>

			</table>
			<br>

		<script>

		$(document).ready(function(){
				$(".sletAntal").click(function(){
					$.ajax( { url: 'deleteamount.php?fejlID='+ $(this).attr("value") } );
					location.reload();
				});
		});

		</script>

			<script>
			$(document).ready(function(){
				$('.datepicker').datepicker({
					format: "yyyy-mm-dd",
					weekStart: 1,
					startDate: "-infinity",
					language: "da",
					daysOfWeekDisabled: "0,6",
					todayHighlight: true
				});
			});
		  </script>

			<div style="margin: 22px; border-bottom: solid 3px white; "></div>
				<h2>Reserver Testeren</h2>

					<form method="GET" action="registerreservering.php" id="reserverForm">
					<label>Klasse: </label><input type="text" class="input-sm" name="klasseNavn" required>
					<label>Lære: </label><input type="text" class="input-sm" name="læreNavn" required>
					<br><br>
						<label>Fra og til: </label><input class="datepicker" type="text" name="fraNavn" >
						<input class="datepicker" type="text" name="tilNavn" >

					<input type="hidden" name="IDbil" value="<?php echo $bilID; ?>">
					<input type="submit" class="btn btn-primary" name="submit" value="Registrer reservering">
					</form>

				<br>


				<?php if(count($carreserved)/5 != 0){

				?>

				<table style="border: solid 1px #ddd; " >

					<tr>
						<td><h3>Reserveret til</h3></td>
						<td><h3>Godkendt af</h3></td>
						<td><h3>Reserveret Fra</h3></td>
						<td><h3>Reserveret Til</h3></td>
						<td></td>
					</tr>

				<?php
				$arrayLength = count($carreserved) / 5;
				for($i = 0; $i < $arrayLength; $i++) {	$o = $i+1; ?>

					<tr class="hoverable">

					<td><p class="text-muted"><?php echo $carreserved['Klasse'.$i]; ?></p></td>
					<td><p class="text-muted"><?php echo $carreserved['Lære'.$i]; ?></p></td>
					<td><p class="text-muted"><?php echo $carreserved['ReserveretFra'.$i]; ?></p></td>
					<td><p class="text-muted"><?php echo $carreserved['ReserveretTil'.$i]; ?></p></td>
					<td><button name="sletReserve" class="btn btn-danger sletReserve" value="<?php echo $carreserved['reserveID'.$o] ?>">Slet</button></td>

					</tr>

					<?php }	?>
				</table>
				<?php } ?>
				<script>

				$(document).ready(function(){
				    $(".sletReserve").click(function(){
					    $.ajax( { url: 'deletereservation.php?reservelID='+ $(this).attr("value") } );
					    location.reload();
				    });
				});

				</script>
				<br>



			</div>

			</div>

			<div class="footer"></div>
		</div>
	</body>
</html>
