<?php
include '../Includes/motorer.inc';

$bilID = $_GET['IDbil'];
$fejlNavn = $_GET['fejlNavn'];
$læreNavn = $_GET['læreNavn'];

$cardata = new motorer();

if($cardata -> RegisterFejl ( $bilID, $fejlNavn, $læreNavn ) ) {
	header ( 'location: cardata.php?carID='.$bilID ) ;
}
