<?php
include '../Includes/cardata.inc';

$reserveID = $_GET['reservelID'];

$cardata = new cardata();

if($cardata -> SletReserve($reserveID) ) {
	header ( 'location: cardata.php?carID='.$bilID ) ;
}
