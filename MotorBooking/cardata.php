<?php
include '../Includes/config.inc';
include '../Includes/motorer.inc';


$bilID = $_GET['carID'];
if(isset($_GET['reserved'])){
	$reserveFail = $_GET['reserved'];
}else{ $reserveFail = 1; }

$cardata = new motorer();

$caresult = $cardata -> SelectBil($bilID);

$carArrayData = $caresult['bilData'];
$carerrors = $caresult['bilFejl'];
$carreserved = $caresult['bilReserveret'];

$bilMærke = $carArrayData['Mærke'];
$bilÅrgang = $carArrayData['Årgang'];
$bilStørrelse = $carArrayData['Størrelse'];
$bilMotor = $carArrayData['Motortype'];
$bilStelnummer = $carArrayData['Stelnummer'];

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
	</style>

	<title><?php echo $bilMærke." ".$bilÅrgang." ".$bilStelnummer; ?></title>


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
				<h3 class="text-muted" style="align: center;">Viser alle data vedrørende: <?php echo $bilMærke;?> | stelnummer: <?php echo $bilStelnummer;?></h3>
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

				<td><h3>Stelnummer</h3></td>
				<td><h3>Mærke</h3></td>
				<td><h3>Årgang</h3></td>
				<td><h3>Størrelse</h3></td>
				<td><h3>Motortype</h3></td>

				</tr>
				<tr class="hoverable">
				<td><p class="text-muted"><?php echo $bilStelnummer; ?></p></td>
				<td><p class="text-muted"><?php echo $bilMærke; ?></p></td>
				<td><p class="text-muted"><?php echo $bilÅrgang; ?></p></td>
				<td><p class="text-muted"><?php echo $bilStørrelse; ?></p></td>
				<td><p class="text-muted"><?php echo $bilMotor; ?></p></td>
				</tr>
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
				<h2>Reserver motor</h2>

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

			</div>

			</div>

			<div class="footer"></div>
		</div>
	</body>
</html>
