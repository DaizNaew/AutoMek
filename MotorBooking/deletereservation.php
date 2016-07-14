<?php
include '../Includes/motorer.inc';

$reserveID = $_GET['reservelID'];

$cardata = new motorer();

if($cardata -> SletReserve($reserveID) ) {
	header ( 'location: cardata.php?carID='.$bilID ) ;
}
