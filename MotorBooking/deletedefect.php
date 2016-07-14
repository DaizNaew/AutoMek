<?php
include '../Includes/motorer.inc';

$fejlID = $_GET['fejlID'];

$cardata = new motorer();

if($cardata -> SletFejl($fejlID) ) {
	header ( 'location: cardata.php?carID='.$bilID ) ;
}
