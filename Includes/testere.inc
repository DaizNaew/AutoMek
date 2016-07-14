<?php

//SELECT b.Mærke, f.Lære FROM biler b LEFT JOIN fejl f on b.ID = f.IDbil WHERE b.id = 1;//

class testere {

	public $testerid;
	public $navn;
	public $type;
	public $software;
	public $pc;
	public $placering;
	public $fejl;
	public $lære;
	public $fejlID;
	public $udstyr;


	function RegisterTestere($navn, $type, $software, $pc, $placering) {
		include 'config.inc';
		$i = 0;

		$mySqlQuery = "INSERT INTO testere (Navn, Type, Software, PC, Placering) VALUES ('$navn','$type','$software','$pc','$placering')";
		if (mysqli_query ( $db, $mySqlQuery )) {
			$i = 1;
		}

		return $i;
	}

	function RegisterUdstyr($testerid, $udstyr) {
		include 'config.inc';
		$i = 0;
		$MySqlQuery = "INSERT INTO testere_udstyr (IDtestere, Udstyr) VALUES ('$testerid','$udstyr')";
		if ( mysqli_query ( $db, $MySqlQuery )) {
			$i = 1;
		}
		return $i;
	}

	function RegisterFejl($testerid, $fejl, $lære){
		include 'config.inc';
		$i = 0;
		$MySqlQuery = "INSERT INTO testere_fejl (IDtestere, Fejl, Lære) VALUES ('$testerid','$fejl','$lære')";
		if ( mysqli_query ( $db, $MySqlQuery )) {
			$i = 1;
		}
		return $i;
	}

	function RegisterBestilte($testerid, $antal, $lære){
		include 'config.inc';
		$i = 0;
		$MySqlQuery = "INSERT INTO testere_bestilte (IDtestere, Antal, Lærer) VALUES ('$testerid','$antal','$lære')";
		if ( mysqli_query ( $db, $MySqlQuery )) {
			$i = 1;
		}
		return $i;
	}

	function ReserverTester($testerid, $klasse, $lære, $reserveretfra, $reserverettil){
		include 'config.inc';
		$i = 0;

			$MySqlQuery = "INSERT INTO testere_reserveret (IDtestere, Klasse, Lærer, ReserveretFra, ReserveretTil) VALUES ('$testerid','$klasse','$lære','$reserveretfra','$reserverettil')";
			if ( mysqli_query($db, $MySqlQuery)) {
				$i = 1;
			}

		return $i;
	}

	function SletFejl($fejlID){
		include 'config.inc';
		$i = 0;
		$MySqlQuery = "DELETE FROM testere_fejl WHERE fejlID ='$fejlID'";
		if ( mysqli_query ( $db, $MySqlQuery )) {
			$i = 1;
		}
		return $i;
	}

	function SletAntal($antalID) {
		Include 'config.inc';
		$i = 0;
		$MySqlQuery = "DELETE FROM testere_bestilte WHERE ID = '$antalID'";
		if( mysqli_query($db, $MySqlQuery)) {
			$i = 0;
		}
		return $i;
	}

	function SletReserve($reserveID){
		include 'config.inc';
		$i = 0;
		$MySqlQuery = "DELETE FROM testere_reserveret WHERE reserveID ='$reserveID'";
		if ( mysqli_query ( $db, $MySqlQuery )) {
			$i = 1;
		}
		return $i;
	}

	function getUdstyr($testerid) {
		include 'config.inc';
		$bilUdstyr = array();
		$MySqlQuery = "SELECT * FROM testere_udstyr WHERE IDtestere='$testerid'";
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

	function getFejl($testerid){
		include 'config.inc';
		$bilFejl = array();
		$mySqlQuery = "SELECT * FROM testere_fejl WHERE IDtestere='$testerid'";

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

	function getBestilte($testerid) {
		include 'config.inc';
		$bilBestilte = array();
		$MySqlQuery = "SELECT * FROM testere_bestilte WHERE IDtestere='$testerid'";
		$response = @mysqli_query ( $db, $MySqlQuery );

		if($response){
			$i = 0;
			while ( $row = mysqli_fetch_array ( $response ) ) {
				$o = $i+1;
				$bilBestilte +=[
						'ID'.$o => $row['ID'],
						'Antal'.$i => $row['Antal'],
						'Lærer'.$i => $row['Lærer']
				];
				$i++;
			}
		}
		return $bilBestilte;
	}

	function getReserveret($testerid) {
		include 'config.inc';
		$bilReserveret = array();
		$MySqlQuery = "SELECT * FROM testere_reserveret WHERE IDtestere='$testerid'";

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

	function SelectBil($testerid) {
		include 'config.inc';
		$mySqlQuery = "SELECT * FROM testere WHERE ID = '$testerid'";
		$row = mysqli_fetch_array(mysqli_query($db,$mySqlQuery),MYSQLI_ASSOC);

		$bilData = array();

		$cardata = new testere();
		$cardata->bilid = $row['ID'];

		$bilNavn = $row['Navn'];
		$bilPC = $row['PC'];
		$bilPlacering = $row['Placering'];
		$bilSoftware = $row['Software'];
		$bilType = $row['Type'];
		$bilData +=[
				"Navn" => "$bilNavn",
				"PC" => "$bilPC",
				"Placering" => "$bilPlacering",
				"Software" => "$bilSoftware",
				"Type" => "$bilType"
		];

		$bilResult = array(
				"bilData" => $bilData,
				"bilFejl" => $cardata->getFejl($testerid),
				"bilBestilte" => $cardata->getBestilte($testerid),
				"bilUdstyr" => $cardata->getUdstyr($testerid),
				"bilReserveret" => $cardata->getReserveret($testerid)

		);
		return $bilResult;

	}

	function ConstructUdstyrTable($testerid) {

		$cardata = new testere();
		$carequipment = $cardata->getUdstyr($testerid);

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
