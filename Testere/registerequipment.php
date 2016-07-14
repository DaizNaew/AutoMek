<?php
include '../Includes/testere.inc';

$bilID = $_GET['IDbil'];
$udstyrNavn = $_GET['udstyrNavn'];

$cardata = new testere();

if($cardata -> RegisterUdstyr($bilID, $udstyrNavn) ) {
	header ( 'location: cardata.php?carID='.$bilID ) ;
}
