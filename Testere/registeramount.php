<?php
include '../includes/testere.inc';

$bilID = $_GET['IDbil'];
$antal = $_GET['testereAntal'];
$læreNavn = $_GET['læreNavn'];

$cardata = new testere();

if($cardata -> RegisterBestilte($bilID, $antal, $læreNavn) ) {
	header ( 'location: cardata.php?carID='.$bilID ) ;
}
