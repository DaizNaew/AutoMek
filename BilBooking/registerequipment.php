<?php
include '../Includes/cardata.inc';

$bilID = $_GET['IDbil'];
$udstyrNavn = $_GET['udstyrNavn'];

$cardata = new cardata();

if($cardata -> RegisterUdstyr($bilID, $udstyrNavn) ) {
	header ( 'location: cardata.php?carID='.$bilID ) ;
}
