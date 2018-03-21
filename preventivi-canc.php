<?php
include('db-config.php');
if(isset($_GET[ 'preventivo_id'])) {
	$preventivo_id = $_GET['preventivo_id'];
	//Cancellazione elementi moduli del preventivo.
	$result = mysqli_query($connection, "DELETE FROM ac_elementi WHERE preventivo_id=$preventivo_id") or die(mysqli_error($connection));
	//Cancellazione generalità preventivo.
	$result = mysqli_query($connection, "DELETE FROM ac_preventivi WHERE preventivo_id=$preventivo_id") or die(mysqli_error($connection));
	header("Location: preventivi-list.php");
} else {
	header("Location: preventivi-list.php");
}