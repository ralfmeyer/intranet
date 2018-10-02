<?php

try {
	
	$servername = "ep-sql\\epsql, 49395";
	$database ="eipro";
	$user = "sqlreader";
	$pw = "sqlReader123!";
	
	/*
	$servername = "EP-LP01\\SQLEXPRESS, 49395";
	$database = "eipro1";
	$user = "test";
	$pw = "test";
	*/
	
	$conn = new PDO( "sqlsrv:server=$servername; Database=$database", $user, $pw);
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(Exception $e)
{
	die( print_r( $e->getMessage() ) );
}
Echo "Kein Abbruch!, somit besteht die Verbindung!!!<br>";

$params = array(["100"]);

$tsql = "SELECT top 100 * from [Eipro].[dbo].[sy0012_00109]";
try{
	$getProducts = $conn->prepare($tsql);
	$getProducts->execute();
	$products = $getProducts->fetchAll(PDO::FETCH_ASSOC);
}
catch(Exception $e){
	die( "<br>Fehler-Nummer: ".print_r( $e->getMessage() ) );
	echo "Fehler";
}

echo "Ausgabe<br>";
echo "<pre>";
var_dump($products);
echo "</pre>";

?>
