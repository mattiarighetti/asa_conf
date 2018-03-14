<?php
$host = "asaplastici.mysql.database.azure.com";
$user = "asaplastici@asaplastici";
$pwd = "Bazinga1";
$db = "asaplastici";
try {
	$conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd );
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch ( Exception $e ) {
	die( var_dump( $e ) );
}