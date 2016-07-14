<?php
include '../Includes/testere.inc';

$bilID = $_GET['IDbil'];
$fejlNavn = $_GET['fejlNavn'];
$læreNavn = $_GET['læreNavn'];

$cardata = new testere();

if($cardata -> RegisterFejl ( $bilID, $fejlNavn, $læreNavn ) ) {
	header ( 'location: cardata.php?carID='.$bilID ) ;
}
