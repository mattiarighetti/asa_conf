<?php

	include 'db-config.php';

	if(!isset($_GET['preventivo_id']) && (!isset($_GET['modulo_id']) || !isset($_GET['terminale_id'])) && (!isset($_GET['tc']) || !isset($_GET['elemento_id']))) {

		echo "Errore: variabile obbligatoria mancante.";

	}

	$preventivo_id = $_GET['preventivo_id'];

	$type = $_GET['type'];

	//Aggiunge modulo (elemento) a configurazione (preventivo)

	if(isset($_GET['modulo_id'])) {

		//Generazione elemento_id

		$elemento_id = $conn->query("SELECT COALESCE(MAX(elemento_id) + 1, 1) FROM ac_elementi");

		$elemento_id = $elemento_id->fetch();

		$elemento_id = $elemento_id[0];



		//Generazione item_order

		$query = $conn->query("SELECT COALESCE(MAX(item_order) + 1, 1) FROM ac_elementi");

		$item_order = $query->fetch();

		$item_order = $item_order[0];

		

		$modulo_id = $_GET['modulo_id'];

		$conn->query("INSERT INTO ac_elementi (elemento_id, preventivo_id, modulo_id, item_order) VALUES (".$elemento_id.", ".$preventivo_id.", ".$modulo_id.", ".$item_order.")");

	} elseif(isset($_GET['terminale_id']) && isset($_GET['tc'])) {

		//Aggiunge terminali di testa e di coda

		if($_GET['tc'] == "t") {

			$conn->query("UPDATE ac_preventivi SET terminale_testa = ".$_GET['terminale_id']." WHERE preventivo_id = ".$preventivo_id);

		} elseif($_GET['tc'] == "c") {

			$conn->query("UPDATE ac_preventivi SET terminale_coda = ".$_GET['terminale_id']." WHERE preventivo_id = ".$preventivo_id);

		}

	} elseif(isset($_GET['elemento_id'])) {

		$conn->query("DELETE FROM ac_elementi WHERE elemento_id = ".$elemento_id." AND preventivo_id = ".$preventivo_id);	

	}

	//Redirect a index

	header('Location: index.php');

exit;

?>