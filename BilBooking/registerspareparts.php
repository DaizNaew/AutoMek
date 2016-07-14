<?php
include '../Includes/cardata.inc';

$bilID = $_GET['IDbil'];
$reservedelNavn = $_GET['reservedelNavn'];
$læreNavn = $_GET['læreNavn'];

$cardata = new cardata();

if($cardata -> RegisterReservedel( $bilID, $reservedelNavn, $læreNavn ) ) {
	header ( 'location: cardata.php?carID='.$bilID ) ;
}
