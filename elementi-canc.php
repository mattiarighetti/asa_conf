<?php

if ( isset( $_GET[ 'elemento_id' ] ) ) {

	include 'db-config.php';

	

	//Estraggo preventivo_id e item_order

	$q = $conn->query("SELECT preventivo_id, item_order FROM ac_elementi WHERE elemento_id = ".$_GET['elemento_id']);

					$f = $q->fetch();

					$preventivo_id = $f[0];

					$item_order = $f[1];



	//Ciclo per sistemare item_order

	$elementi = $conn->query("SELECT elemento_id FROM ac_elementi WHERE preventivo_id = ".$preventivo_id." AND item_order > ".$item_order." ORDER BY item_order");

	foreach ($elementi as $elemento) {

		$conn->query("UPDATE ac_elementi SET item_order = ".$item_order." WHERE elemento_id = ".$_GET['elemento_id']);

		++$item_order;

	}

	

	//Query cancellazione elemento

	$conn->query("DELETE FROM ac_elementi WHERE elemento_id = ".$_GET['elemento_id']);

	

	//Redirect al preventivo

	header("Location: /index.php?preventivo_id=".$preventivo_id);

} else {

	echo "Variabile elemento_id non impostata.";

}

?>