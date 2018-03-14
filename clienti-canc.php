<?php

	include 'db-config.php';

	$conn->query("DELETE FROM ac_clienti ")if ($conn->query($sql) === TRUE) {

    echo "Record deleted successfully";

} elsheader("location: /nuova-pagina.php");

: " . $conn->error;

}