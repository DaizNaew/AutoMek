<?php
include '../Includes/cardata.inc';

$bilID = $_GET['IDbil'];
$brugNavn = $_GET['brugNavn'];

$cardata = new cardata();

if($cardata -> RegisterBrug($bilID, $brugNavn) ) {
	header ( 'location: cardata.php?carID='.$bilID ) ;
}
