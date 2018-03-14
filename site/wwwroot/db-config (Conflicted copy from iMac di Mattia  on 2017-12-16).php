<?php
$host = "eu-cdbr-azure-west-b.cloudapp.net";
$user = "ba9e63575812e6";
$pwd = "81f4dd44";
$db = "asaplastici";
try {
	$conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd );
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch ( Exception $e ) {
	die( var_dump( $e ) );
}