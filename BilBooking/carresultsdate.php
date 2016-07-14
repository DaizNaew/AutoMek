<?php
include '../Includes/config.inc';
Include '../Includes/dateRange.inc';

$resres = false;

if(!isset($_GET['dato'])){
	$date=0;
	$isset = false;
}else{
	$isset = true;
	$date = $_GET['dato'];
}
?>

<style>
th, td {padding: 5px; padding-top:0px; border-bottom: 1px solid #ddd; text-align: center;}
tr:hover {background-color: #f5f5f5;}
table {width: 100%;}
</style>
<div style="overflow-x:auto;">
<table style="border: solid 1px #ddd; " >
<tr>
<td><h3>Bil nummer</h3></td>
<td><h3>Model</h3></td>
<td><h3>Årgang</h3></td>
<td><h3>Reserveret af hold</h3></td>
</tr>



<?php
$dateRange = new dateRange();

$reserveEntry = "SELECT * FROM reserveret";

$response = @mysqli_query ( $db , $reserveEntry );

$i=1;
$dateArray = array();

if ( $response ) {
	while ( $row = mysqli_fetch_array ( $response , MYSQLI_ASSOC ) ) {

		$dateFrom = $row['ReserveretFra'];
		$dateTo = $row['ReserveretTil'];
		$bilid = $row['IDbil'];
		$dateArray += [$i => $dateRange->createDateRangeArray($dateFrom,$dateTo)];
		$reserved = false;

		if(in_array($date,$dateArray[$i])){
			$reserved = true;
			$dbentry = "SELECT * FROM biler WHERE ID = $bilid";
			$row = mysqli_fetch_array(mysqli_query($db,$dbentry),MYSQLI_ASSOC);

			$bilID = $row['ID'];
			$bilMærke = $row['Mærke'];
			$bilÅrgang = $row['Årgang'];

			$reservedsql = "SELECT * FROM reserveret WHERE IDbil = '$bilid'";
			$reserveResponse = @mysqli_query ( $db, $reservedsql );
			$reserveRow = mysqli_fetch_array(mysqli_query($db, $reservedsql));
			$klasse = $reserveRow['Klasse'];

			?>
			<tr>
			<td><a href="cardata.php?carID=<?php echo $bilID; ?>"><?php echo $bilID; ?> </a></td>
			<td><?php echo $bilMærke; ?></td>
			<td><?php echo $bilÅrgang; ?></td>
			<td><?php if ( $reserved == true) { echo $klasse; } else { echo "Ikke reserveret"; }?></td>
			</tr>

			<?php
		} //else {$resres=true;}
		$i++;
	}
}
if ($resres == true){?>
	<tr>
	<td><h3>Bil nummer</h3></td>
	<td><h3>Model</h3></td>
	<td><h3>Årgang</h3></td>
	<td><h3>Reserveret af hold</h3></td>
	</tr>
	<?php
}

?>
</table>


</div>
