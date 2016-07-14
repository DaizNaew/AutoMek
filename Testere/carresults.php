<?php
include '../Includes/config.inc';

	$dbentry = "SELECT * FROM testere";

$row = mysqli_fetch_array(mysqli_query($db,$dbentry),MYSQLI_ASSOC);

$count = mysqli_num_rows(mysqli_query($db,$dbentry));

$response = @mysqli_query ( $db, $dbentry );

?>
<style>
th, td {padding: 5px; padding-top:0px; border-bottom: 1px solid #ddd; text-align: center;}
tr:hover {background-color: #f5f5f5;}
table {width: 100%;}
</style>
<div style="overflow-x:auto;">
<table style="border: solid 1px #ddd; " >
<tr>
<td><h3>Tester Nummer</h3></td>
<td><h3>Navn</h3></td>
<td><h3>Type</h3></td>
<td><h3>Placering</h3></td>
<td><h3>Reserveret af hold</h3></td>
</tr>

<?php if ($response){
	while ( $row = mysqli_fetch_array ( $response ) ) {

		$reserved = false;

		$bilID = $row['ID'];
		$bilMærke = $row['Navn'];
		$bilÅrgang = $row['Type'];
		$bilPlacering = $row['Placering'];

			$reservedsql = "SELECT * FROM testere_reserveret WHERE IDtestere = '$bilID'";
			$reserveResponse = @mysqli_query ( $db, $reservedsql );
			if($reserveResponse){
				$reserveRow = mysqli_fetch_array(mysqli_query($db, $reservedsql));
				$klasse = $reserveRow['Klasse'];
				$reserved = true;
			}?>
			<tr>
			<td><a href="cardata.php?carID=<?php echo $bilID; ?>"><?php echo $bilID; ?> </a></td>
			<td><?php echo $bilMærke; ?></td>
			<td><?php echo $bilÅrgang; ?></td>
			<td><?php echo $bilPlacering; ?></td>
			<td><?php if ( $reserved == true) { echo $klasse; } else { echo "Ikke reserveret"; }?></td>
			</tr>
<?php }}?>
</table>

</div>
