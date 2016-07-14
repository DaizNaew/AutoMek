<?php
include '../Includes/testere.inc';

$reserveID = $_GET['reservelID'];

$cardata = new testere();

if($cardata -> SletReserve($reserveID) ) {
	header ( 'location: cardata.php?carID='.$bilID ) ;
}
