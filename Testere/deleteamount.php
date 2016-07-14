<?php
include '../Includes/testere.inc';

$fejlID = $_GET['fejlID'];

$cardata = new testere();

if($cardata -> SletAntal($fejlID) ) {
	header ( 'location: cardata.php?carID='.$bilID ) ;
}
