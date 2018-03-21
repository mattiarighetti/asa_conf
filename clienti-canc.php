<?php
include('db-config.php');
if(isset($_GET[ 'cliente_id'])) {
	$prenotazione_id = $_GET['cliente_id'];
	$result = mysqli_query($connection, "DELETE FROM ac_clienti WHERE cliente_id=$cliente_id") or die(mysqli_error($connection));
	header("Location: clienti-list.php");
} else {
	header("Location: clienti-list.php");
}