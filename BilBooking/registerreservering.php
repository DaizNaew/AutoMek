<?php
include '../Includes/cardata.inc';

$bilID = $_GET['IDbil'];
$klasseNavn = $_GET['klasseNavn'];
$læreNavn = $_GET['læreNavn'];
$fraNavn = $_GET['fraNavn'];
$tilNavn = $_GET['tilNavn'];

$cardata = new cardata();
if($cardata->ReserverBil($bilID, $klasseNavn, $læreNavn, $fraNavn, $tilNavn)) {
	header ( 'location: cardata.php?carID='.$bilID ) ;
} else {
	header ( 'location: cardata.php?carID='.$bilID ) ;
}
