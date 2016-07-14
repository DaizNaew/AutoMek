<?php

//SELECT b.Mærke, f.Lære FROM biler b LEFT JOIN fejl f on b.ID = f.IDbil WHERE b.id = 1;//

class motorer {

	public $motorid;
	public $mærke;
	public $årgang;
	public $motortype;
	public $stelnummer;
	public $størrelse;
	public $fejl;
	public $lære;
	public $fejlID;
	public $udstyr;


	function RegisterMotor($mærke, $årgang, $motortype, $stelnummer, $størrelse) {
		include 'config.inc';
		$i = 0;

		$mySqlQuery = "INSERT INTO motor (Mærke, Årgang, Motortype, Stelnummer, Størrelse) VALUES ('$mærke','$årgang','$motortype','$stelnummer','$størrelse')";
		if (mysqli_query ( $db, $mySqlQuery )) {
			$i = 1;
		}

		return $i;
	}

	function RegisterFejl($motorid, $fejl, $lære){
		include 'config.inc';
		$i = 0;
		$MySqlQuery = "INSERT INTO motor_fejl (IDmotore, Fejl, Lære) VALUES ('$motorid','$fejl','$lære')";
		if ( mysqli_query ( $db, $MySqlQuery )) {
			$i = 1;
		}
		return $i;
	}

	function ReserverMotor($motorid, $klasse, $lære, $reserveretfra, $reserverettil){
		include 'config.inc';
		$i = 0;

			$MySqlQuery = "INSERT INTO motor_reserveret (IDmotore, Klasse, Lærer, ReserveretFra, ReserveretTil) VALUES ('$motorid','$klasse','$lære','$reserveretfra','$reserverettil')";
			if ( mysqli_query($db, $MySqlQuery)) {
				$i = 1;
			}

		return $i;
	}

	function SletFejl($fejlID){
		include 'config.inc';
		$i = 0;
		$MySqlQuery = "DELETE FROM motor_fejl WHERE fejlID ='$fejlID'";
		if ( mysqli_query ( $db, $MySqlQuery )) {
			$i = 1;
		}
		return $i;
	}

	function SletReserve($reserveID){
		include 'config.inc';
		$i = 0;
		$MySqlQuery = "DELETE FROM motor_reserveret WHERE reserveID ='$reserveID'";
		if ( mysqli_query ( $db, $MySqlQuery )) {
			$i = 1;
		}
		return $i;
	}

	function getFejl($motorid){
		include 'config.inc';
		$bilFejl = array();
		$mySqlQuery = "SELECT * FROM motor_fejl WHERE IDmotore='$motorid'";

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

	function getReserveret($motorid) {
		include 'config.inc';
		$bilReserveret = array();
		$MySqlQuery = "SELECT * FROM motor_reserveret WHERE IDmotore='$motorid'";

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

	function SelectBil($motorid) {
		include 'config.inc';
		$mySqlQuery = "SELECT * FROM motor WHERE ID = '$motorid'";
		$row = mysqli_fetch_array(mysqli_query($db,$mySqlQuery),MYSQLI_ASSOC);

		$bilData = array();

		$cardata = new motorer();
		$cardata->bilid = $row['ID'];

		$bilMærke = $row['Mærke'];
		$bilÅrgang = $row['Årgang'];
		$bilMotortype = $row['Motortype'];
		$bilStørrelse = $row['Størrelse'];
		$bilStelnummer = $row['Stelnummer'];
		$bilData +=[
				"Mærke" => "$bilMærke",
				"Årgang" => "$bilÅrgang",
				"Motortype" => "$bilMotortype",
				"Størrelse" => "$bilStørrelse",
				"Stelnummer" => "$bilStelnummer"
		];

		$bilResult = array(
				"bilData" => $bilData,
				"bilFejl" => $cardata->getFejl($motorid),
				"bilReserveret" => $cardata->getReserveret($motorid)

		);
		return $bilResult;

	}

}
