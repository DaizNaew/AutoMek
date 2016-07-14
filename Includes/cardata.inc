<?php

//SELECT b.Mærke, f.Lære FROM biler b LEFT JOIN fejl f on b.ID = f.IDbil WHERE b.id = 1;//

class cardata {

	public $bilid;
	public $mærke;
	public $årgang;
	public $motortype;
	public $farve;
	public $stelnummer;
	public $fejl;
	public $lære;
	public $fejlID;
	public $udstyr;


	function RegisterBil($mærke, $årgang, $motortype, $farve, $stelnummer) {
		include 'config.inc';
		$i = 0;

		$mySqlQuery = "INSERT INTO biler (Mærke, Årgang, Motortype, Farve, Stelnummer) VALUES ('$mærke','$årgang','$motortype','$farve','$stelnummer')";
		if (mysqli_query ( $db, $mySqlQuery )) {
			$i = 1;
		}

		return $i;
	}

	function RegisterUdstyr($bilid, $udstyr) {
		include 'config.inc';
		$i = 0;
		$MySqlQuery = "INSERT INTO udstyr (IDbil, Udstyr) VALUES ('$bilid','$udstyr')";
		if ( mysqli_query ( $db, $MySqlQuery )) {
			$i = 1;
		}
		return $i;
	}

	function RegisterFejl($bilid, $fejl, $lære){
		include 'config.inc';
		$i = 0;
		$MySqlQuery = "INSERT INTO fejl (IDbil, Fejl, Lære) VALUES ('$bilid','$fejl','$lære')";
		if ( mysqli_query ( $db, $MySqlQuery )) {
			$i = 1;
		}
		return $i;
	}

	function RegisterBrug($bilid, $brug){
		include 'config.inc';
		$i = 0;
		$MySqlQuery = "INSERT INTO brug (BilID, Brug) VALUES ('$bilid','$brug')";
		if ( mysqli_query ( $db, $MySqlQuery )) {
			$i = 1;
		}
		return $i;
	}

	function RegisterReservedel($bilid, $reservedel, $lære) {
		include 'config.inc';
		$i = 0;
		$MySqlQuery = "INSERT INTO reservedele (IDbil, Reservedel, Lærer, Bestilt) VALUES ('$bilid','$reservedel','$lære','1')";
		if ( mysqli_query($db, $MySqlQuery)) {
			$i = 1;
		}
		return $i;
	}

	function AfleverBil($bilid, $lære, $dato) {
		include 'config.inc';
		$i = 0;
		$MySqlQuery = "INSERT INTO afleveret (IDbil, Lærer, Dato, Afleveret) VALUES ('$bilid','$lære','$dato','1')";
		if ( mysqli_query($db, $MySqlQuery)) {
			$i = 1;
		}
		return $i;

	}

	function ReserverBil($bilid, $klasse, $lære, $reserveretfra, $reserverettil){
		include 'config.inc';
		$i = 0;

			$MySqlQuery = "INSERT INTO reserveret (IDbil, Klasse, Lærer, ReserveretFra, ReserveretTil) VALUES ('$bilid','$klasse','$lære','$reserveretfra','$reserverettil')";
			if ( mysqli_query($db, $MySqlQuery)) {
				$i = 1;
			}

		return $i;
	}

	function SletFejl($fejlID){
		include 'config.inc';
		$i = 0;
		$MySqlQuery = "DELETE FROM fejl WHERE fejlID ='$fejlID'";
		if ( mysqli_query ( $db, $MySqlQuery )) {
			$i = 1;
		}
		return $i;
	}

	function SletReserve($reserveID){
		include 'config.inc';
		$i = 0;
		$MySqlQuery = "DELETE FROM reserveret WHERE reserveID ='$reserveID'";
		if ( mysqli_query ( $db, $MySqlQuery )) {
			$i = 1;
		}
		return $i;
	}

	function getUdstyr($bilid) {
		include 'config.inc';
		$bilUdstyr = array();
		$MySqlQuery = "SELECT * FROM udstyr WHERE IDbil='$bilid'";
		$response = @mysqli_query ( $db, $MySqlQuery );

		if($response){
			$i = 0;
			while ( $row = mysqli_fetch_array ( $response ) ) {

				$bilUdstyr +=[
						'Udstyr'.$i => $row['Udstyr']
				];
				$i++;
			}
		}
		return $bilUdstyr;
	}

	function getBrug($bilid) {
		include 'config.inc';
		$bilBrug = array();
		$MySqlQuery = "SELECT * FROM brug WHERE BilID='$bilid'";
		$response = @mysqli_query ( $db, $MySqlQuery );

		if($response){
			$i = 0;
			while ( $row = mysqli_fetch_array ( $response ) ) {

				$bilBrug +=[
						'Brug'.$i => $row['Brug']
				];
				$i++;
			}
		}
		return $bilBrug;
	}

	function getFejl($bilid){
		include 'config.inc';
		$bilFejl = array();
		$mySqlQuery = "SELECT * FROM fejl WHERE IDbil='$bilid'";

		$response = @mysqli_query ( $db, $mySqlQuery );


		if($response){
			$i = 0;
			while ( $row = mysqli_fetch_array ( $response ) ) {

				$o = $i+1;
				$bilFejl +=[
						'ID'.$o => $row['fejlID'],
						'Lære'.$i => $row['Lære'],
						'Fejl'.$i => $row['Fejl']
				];
				$i++;
			}
		}
		return $bilFejl;
	}

	function getReservedel($bilid) {
		include 'config.inc';
		$bilReservedele = array();
		$MySqlQuery = "SELECT * FROM reservedele WHERE IDbil='$bilid'";

		$response = @mysqli_query($db, $MySqlQuery);

		if($response) {
			$i =0;
			while ( $row = mysqli_fetch_array($response)) {
				$o = $i+1;
				$bilReservedele +=[
						'Reservedel'.$i => $row['Reservedel'],
						'Lære'.$i => $row['Lærer']
				];
				$i++;
			}
		}
		return $bilReservedele;
	}

	function getAfleveret($bilid) {
		include 'config.inc';
		$bilAfleveret = array();
		$MySqlQuery = "SELECT * FROM afleveret WHERE IDbil='$bilid'";

		$response = @mysqli_query($db, $MySqlQuery);

		if($response) {
			$i =0;
			while ( $row = mysqli_fetch_array($response)) {
				$bilAfleveret +=[
						'Afleveret'.$i => $row['Afleveret'],
						'Dato'.$i => $row['Dato'],
						'Lære'.$i => $row['Lærer']
				];
				$i++;

			}
		}
		return $bilAfleveret;
	}

	function getReserveret($bilid) {
		include 'config.inc';
		$bilReserveret = array();
		$MySqlQuery = "SELECT * FROM reserveret WHERE IDbil='$bilid'";

		$response = @mysqli_query($db, $MySqlQuery);

		if($response) {
			$i =0;
			while ( $row = mysqli_fetch_array($response)) {
					$o = $i+1;
				$bilReserveret +=[
						'reserveID'.$o => $row['reserveID'],
						'Klasse'.$i => $row['Klasse'],
						'Lære'.$i => $row['Lærer'],
						'ReserveretFra'.$i => $row['ReserveretFra'],
						'ReserveretTil'.$i => $row['ReserveretTil']
				];
				$i++;
			}
		}
		return $bilReserveret;
	}

	function SelectBil($bilid) {
		include 'config.inc';
		$mySqlQuery = "SELECT * FROM biler WHERE ID = '$bilid'";
		$row = mysqli_fetch_array(mysqli_query($db,$mySqlQuery),MYSQLI_ASSOC);

		$bilData = array();

		$cardata = new cardata();
		$cardata->bilid = $row['ID'];

		$bilMærke = $row['Mærke'];
		$bilÅrgang = $row['Årgang'];
		$bilMotor = $row['Motortype'];
		$bilFarve = $row['Farve'];
		$bilStelnummer = $row['Stelnummer'];
		$bilData +=[
				"Mærke" => "$bilMærke",
				"Årgang" => "$bilÅrgang",
				"Motortype" => "$bilMotor",
				"Farve" => "$bilFarve",
				"Stelnummer" => "$bilStelnummer"
		];

		$bilResult = array(
				"bilData" => $bilData,
				"bilFejl" => $cardata->getFejl($bilid),
				"bilBrug" => $cardata->getBrug($bilid),
				"bilUdstyr" => $cardata->getUdstyr($bilid),
				"bilReservedele" => $cardata->getReservedel($bilid),
				"bilAfleveret" => $cardata->getAfleveret($bilid),
				"bilReserveret" => $cardata->getReserveret($bilid)

		);
		return $bilResult;

	}

	function ConstructUdstyrTable($bilid) {

		$cardata = new cardata();
		$carequipment = $cardata->getUdstyr($bilid);

		$cararray = "<tr>";

		for($i = 0; $i < count($carequipment); $i++) {
			$cararray .= "<td class=\"hoverable\"><p class=\"text-muted\">"
					.$carequipment['Udstyr'.$i]
					."</p></td>";
			if($i %4 == 0){$cararray .= "</tr><tr>";}
		}
		return $cararray;
	}

}
