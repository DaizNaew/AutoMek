<!DOCTYPE html>
<html>
	<head>

	<title>Automekaniker Booking</title>
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

			<div class="header clearfix" style="border-bottom:hidden">
				<nav>
					<ul class="nav nav-pills pull-right">
						<li role="presentation" class=""><a href="../index.html">Index</a></li>
						<li role="presentation" class="active"><a href="index.php">Hjem</a></li>
						<li role="presentation" ><a href="registermotor.php">Registrer Motor</a></li>
						<li class="divider-vertical"></li>
						<li role="presentation" ><a href="../BilBooking/index.php">Bil booking</a></li>
						<li role="presentation" ><a href="../Testere/index.php">Testere</a></li>
						<li role="presentation" class="active"><a href="index.php">Motor booking</a></li>
					</ul>
				</nav>
				<h3 class="text-muted" style="align: center;">Velkommen til Automekanikernes Motor booking system</h3>

			</div>
			<div class="søgefelt">
				<label>Søg efter Motor via dato: </label><input id="datepicker" type="text" name="dato" autocomplete="off">
				<button id="dateSearch2" class="btn btn-primary">søg </button>
				<button id="showAll" class="btn btn-primary">Vis Alle</button>
			</div>

			<script>

			function datePicker($theID){
				$($theID).datepicker({
					format: "yyyy-mm-dd",
					weekStart: 1,
					startDate: "-infinity",
					language: "da",
					daysOfWeekDisabled: "0,6",
					todayHighlight: true
				});
			}

			function getVal() {
				var dato = $("#datepicker").val();
				return dato;
			}

			function getDateResult($date){
				var resultpage = "carresultsdate.php?dato="+$date;
				$('#carresult2').load(resultpage);
			}

			function loadPage() {
				$('#carresult').load('carresults.php');
				//$('#carresult2').load('carresultsdate.php?dato=');
			}

			$('#dateSearch2').click(function() {
				$('#carresult').html("");

				//#Slet Comments for at ordne filen. Dette er bare til debugging.
				getDateResult(getVal());
				//alert(getVal());
			});

			$('#showAll').click(function(){
				loadPage();
				$('#carresult2').html("");
			});

			$(document).ready(function() {
				loadPage();
				datePicker('#datepicker');
			});
		  </script>

			<div class="jumbotron">



			<div id="carresult"></div>
			<div id="carresult2"></div>
			</div>

			<div class="footer"></div>
		</div>
	</body>
</html>
