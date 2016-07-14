<?php
include '../Includes/cardata.inc';

$bilID = $_GET['IDbil'];
$fejlNavn = $_GET['fejlNavn'];
$læreNavn = $_GET['læreNavn'];

$cardata = new cardata();

if($cardata -> RegisterFejl ( $bilID, $fejlNavn, $læreNavn ) ) {
	header ( 'location: cardata.php?carID='.$bilID ) ;
}
