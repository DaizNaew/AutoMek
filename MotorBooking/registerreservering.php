<?php
include '../Includes/motorer.inc';

$bilID = $_GET['IDbil'];
$klasseNavn = $_GET['klasseNavn'];
$læreNavn = $_GET['læreNavn'];
$fraNavn = $_GET['fraNavn'];
$tilNavn = $_GET['tilNavn'];

$cardata = new motorer();
if($cardata->ReserverMotor($bilID, $klasseNavn, $læreNavn, $fraNavn, $tilNavn)) {
	header ( 'location: cardata.php?carID='.$bilID ) ;
} else {
	header ( 'location: cardata.php?carID='.$bilID ) ;
}
