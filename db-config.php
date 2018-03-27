<?php
$host = "mattiarivuapp.mysql.db";
$user = "mattiarivuapp";
$pwd = "Bazinga1";
$db = "mattiarivuapp";
try {
	$conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd );
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch ( Exception $e ) {
	die( var_dump( $e ) );
}