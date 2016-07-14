<?php
include '../Includes/cardata.inc';

$bilID = $_GET['IDbil'];
$afleverNavn = $_GET['afleverDato'];
$læreNavn = $_GET['læreNavn'];

$cardata = new cardata();
if ($cardata->AfleverBil($bilID, $læreNavn, $afleverNavn)) {
	header ( 'location: cardata.php?carID='.$bilID ) ;
}
