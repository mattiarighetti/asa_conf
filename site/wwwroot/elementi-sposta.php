<?php
if ( isset( $_GET[ 'elemento_id' ] ) && isset( $_GET[ 'lr' ] ) ) {
	include 'db-config.php';

	//Estraggo preventivo_id e item_order
	$q = $conn->query( "SELECT preventivo_id, item_order FROM ac_elementi WHERE elemento_id = " . $_GET[ 'elemento_id' ] );
	$f = $q->fetch();
	$preventivo_id = $f[ 0 ];
	$item_order = $f[ 1 ];

	//Controllo max e min per non sforare
	$q = $conn->query( "SELECT max(item_order), min(item_order) FROM ac_elementi WHERE preventivo_id = " . $preventivo_id );
	$f = $q->fetch();
	$max_io = $f[ 0 ];
	$min_io = $f[ 1 ];
	if ( ( $item_order == $max_io && $_GET[ 'lr' ] == 'r' ) || ( $item_order == $min_io && $_GET[ 'lr' ] == 'l' ) ) {
		//ERRORE
		//Redirect al preventivo
		header( "Location: /index.php?preventivo_id=" . $preventivo_id );
	} else {
		//Aggiorno item_order
		if ( $_GET[ 'lr' ] == 'l' ) {
			//Estraggo elemento_id precedente
			$item_order_prec = $item_order - 1;
			$q = $conn->query( "SELECT elemento_id FROM ac_elementi WHERE item_order = " . $item_order_prec . " AND preventivo_id = " . $preventivo_id . " LIMIT 1" );
			$f = $q->fetch();
			$elemento_prec = $f[ 0 ];
			//Sistemo elemento precendete
			$conn->query( "UPDATE ac_elementi SET item_order = " . $item_order . " WHERE elemento_id = " . $elemento_prec );
			//Sistemo elemento 
			$conn->query( "UPDATE ac_elementi SET item_order = " . $item_order_prec . " WHERE elemento_id = " . $_GET[ 'elemento_id' ] );
		} elseif ( $_GET[ 'lr' ] == 'r' ) {
			//Estraggo elemento_id successivo
			$item_order_succ = $item_order + 1;
			$q = $conn->query( "SELECT elemento_id FROM ac_elementi WHERE item_order = " . $item_order_succ . " AND preventivo_id = " . $preventivo_id . " LIMIT 1" );
			$f = $q->fetch();
			$elemento_succ = $f[ 0 ];
			//Sistemo elemento successivo
			$conn->query( "UPDATE ac_elementi SET item_order = " . $item_order_succ . " WHERE elemento_id = " . $_GET[ 'elemento_id' ] );
			//Sistemo elemento 
			$conn->query( "UPDATE ac_elementi SET item_order = " . $item_order . " WHERE elemento_id = " . $elemento_succ );

		}
	}
	//Redirect al preventivo
	header( "Location: /index.php?preventivo_id=" . $preventivo_id );
} else {
	echo "Variabile elemento_id non impostata.";
}
?>