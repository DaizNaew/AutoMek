<?php
include '../Includes/cardata.inc';

$fejlID = $_GET['fejlID'];

$cardata = new cardata();

if($cardata -> SletFejl($fejlID) ) {
	header ( 'location: cardata.php?carID='.$bilID ) ;
}
