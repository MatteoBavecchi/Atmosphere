<?php
    date_default_timezone_set('Europe/Rome');
	$curdate = date("Y-n-d g:i:sA"); //ci si procura l' ora e la data dal server php
	//si mette nelle variabili i dati ricevuti con il metodo GET
	$temp = $_GET['t'];
	$hum = $_GET['h'];
	$GPL = $_GET['gpl'];
	$CO2 = $_GET['co2'];
	$CO = $_GET['co'];
	$MAC = $_GET['mac'];
	
	$servername = "localhost";
	$username = "u790033170_user";
	$dbname = "u790033170_1";
	$password = "atmosphere";

	$mysql= new mysqli($servername, $username, $password, $dbname); //ci si collega al DB
    $mysql->autocommit(true);
	$SQL0 = "SELECT COD_USR FROM UTENTE WHERE MAC_ADDR_DEVICE = '$MAC'"; //si seleziona il codice utente degli account con il MAC            															 //address dato
	$Query=$mysql->query($SQL0);
	$Dati = $Query -> fetch_assoc();
	if($Dati['COD_USR']>0){ //se esiste un codice corrispondente si inserisce la rilevazione
	        $Sql = "INSERT INTO RILEVAZIONE (ID_RILEVAZIONE, COD_USR, DATA_ORA, TEMPERATURA, UMIDITA, CO2, CO, GPL)
	                VALUES (NULL, '".$Dati['COD_USR']."', '$curdate', '$temp', $hum, $CO2, $CO, $GPL)";
	        $Query2=$mysql->query($Sql);
		if ($Query2) echo "OK";
		else echo "Fail";
	}
	else echo "Fail";
	$mysql->close();
?>
