<?php 

	include 'db-config.php'; 

?>

<html lang="en">

<head>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta name="author" content="Mattia Righetti (studio@mattiarighetti.it)">

	<link rel="icon" href="images/favicon.ico">

	<title>Configuratore ASA Plastici</title>

	<!-- Bootstrap core CSS -->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

	<link rel="stylesheet" href="style.css">

</head>

<body>

	<div class="container">

		<header class="header clearfix">

			<nav>

				<ul class="nav nav-pills float-right">

					<li class="nav-item">

						<a class="nav-link active" href="#">Home <span class="sr-only">(current)</span></a>

					</li>

					<li class="nav-item">

						<a class="nav-link" href="#">Preventivi</a>

					</li>

					<li class="nav-item">

						<a class="nav-link" href="#">Clienti</a>

					</li>

				</ul>

			</nav>

			<h3 class="text-muted"><img src="/images/logo.jpg" style="max-width: 100px;height: auto"></h3>

		</header>

		<main role="main">

			<div class="jumbotron">

				<?php 

				if (isset($_GET[preventivo_id])) {

					$preventivo_id = $_GET[preventivo_id];

				} else {

					$q = $conn->query("SELECT COALESCE(MAX(preventivo_id) + 1, 1) FROM ac_preventivi WHERE salvato IS TRUE");

					$f = $q->fetch();

					$preventivo_id = $f[0];

					//Se non esiste lo crea

					if($conn->query("SELECT COUNT(*) FROM ac_preventivi WHERE preventivo_id = $preventivo_id")->fetchColumn() == 0) {

						$conn->query("INSERT INTO ac_preventivi (preventivo_id) VALUES ($preventivo_id)");

					}

				}

				?>

				<h1 class="display-3">Preventivo #<?php echo $preventivo_id; ?></h1>

				<table align="center">

					<tr>

						<?php

						if($conn->query("SELECT terminale_testa FROM ac_preventivi WHERE preventivo_id = $preventivo_id")->fetchColumn() != "") {

							$terminale_id = $conn->query("SELECT terminale_testa FROM ac_preventivi WHERE preventivo_id = $preventivo_id")->fetchColumn();

							$imgurl = $conn->query("SELECT image_url FROM ac_terminali WHERE terminale_id = $terminale_id")->fetchColumn();

							echo("<td><img style=\"max width: 100px; max-height: 100px\" src=\"".$imgurl."\"></td>");

						}

						$menu = "<td></td>";

						foreach($conn->query("SELECT * FROM ac_elementi WHERE preventivo_id = $preventivo_id ORDER BY item_order") as $elemento) {

							$imgurl = $conn->query("SELECT image_url FROM ac_moduli WHERE modulo_id = ".$elemento['modulo_id'])->fetchColumn();

							echo("<td><img style=\"max-width: 100px; max-height: 100px;\" src=\"".$imgurl."\"></td>");

							//Costruisce menu sotto gli elementi

							$menu .= "<td><center><a href=\"/elementi-sposta.php?elemento_id=".$elemento['elemento_id']."&lr=l\"><img class=\"icon-bar\" src=\"/images/open-iconic/svg/arrow-left.svg\"></a><a href=\"elementi-canc.php?elemento_id=".$elemento['elemento_id']."\"><img class=\"icon-bar\" src=\"/images/open-iconic/svg/trash.svg\"></a><a href=\"/elementi-sposta.php?elemento_id=".$elemento['elemento_id']."&lr=r\"><img class=\"icon-bar\" src=\"/images/open-iconic/svg/arrow-right.svg\"></a></center></td>";

						}

						if($conn->query("SELECT terminale_coda FROM ac_preventivi WHERE preventivo_id = $preventivo_id")->fetchColumn() != "") {

							$terminale_id = $conn->query("SELECT terminale_coda FROM ac_preventivi WHERE preventivo_id = $preventivo_id")->fetchColumn();

							$imgurl = $conn->query("SELECT image_url FROM ac_terminali WHERE terminale_id = $terminale_id")->fetchColumn();

							echo("<td><img style=\"max width: 100px; max-height: 100px\" src=\"".$imgurl."\"></td>");

						}

						$menu .= "<td></td>";

						?>

					</tr>

					<tr>

						<?php echo $menu; ?>

					</tr>

				</table>

				<p style="padding-top: 25px"><a class="btn btn-md btn-success" href="#" role="button">Salva</a><a class="btn btn-md btn-warning" href="#" role="button">Cancella</a>

				</p>

			</div>

			<div class="row marketing">

				<div class="col-6">

					<h4>Aggiungi prese</h4>

					<?php $sql = 'SELECT modulo_id, denominazione, prezzo, image_url FROM ac_moduli WHERE tipo_id = 1 ORDER BY denominazione';

    					foreach ($conn->query($sql) as $presa) {

							echo("<a href=\"/conf-mngr.php?preventivo_id=".$preventivo_id."&type=add&modulo_id=".$presa['modulo_id']."\"><figure class=\"figure\"><img alt=\"".$presa['denominazione']." (".$presa['prezzo'].")\" src=\"".$presa['image_url']."\" style=\"max-height: 90px; max-height: 90px; padding: 10px 10px 10px 10px;\"><figcaption class=\"figure-caption\"><small>".$presa['denominazione']."<br> &euro;".$presa['prezzo']."</small></figcaption></figure></a>");

					}

					?>

				</div>

				<div class="col-6">

					<h4>Aggiungi moduli</h4>

					<div class="row">

						<?php $sql = 'SELECT modulo_id, denominazione, prezzo, image_url FROM ac_moduli WHERE tipo_id = 2 ORDER BY denominazione';

    					foreach ($conn->query($sql) as $presa) {

							echo("<a href=\"/conf-mngr.php?preventivo_id=".$preventivo_id."&type=add&modulo_id=".$presa['modulo_id']."\"><figure class=\"figure\"><img alt=\"".$presa['denominazione']." (".$presa['prezzo'].")\" src=\"".$presa['image_url']."\" style=\"max-height: 90px; max-height: 90px; padding: 10px 10px 10px 10px;\"><figcaption class=\"figure-caption\"><small>".$presa['denominazione']."<br> &euro;".$presa['prezzo']."</small></figcaption></figure></a>");

					}

					?>

					</div>

					<div class="row">

						<?php $sql = 'SELECT modulo_id, denominazione, prezzo, image_url FROM ac_moduli WHERE tipo_id = 3 ORDER BY denominazione';

    					foreach ($conn->query($sql) as $presa) {

							echo("<a href=\"/conf-mngr.php?preventivo_id=".$preventivo_id."&type=add&modulo_id=".$presa['modulo_id']."\"><figure class=\"figure\"><img alt=\"".$presa['denominazione']." (".$presa['prezzo'].")\" src=\"".$presa['image_url']."\" style=\"max-height: 90px; max-height: 90px; padding: 10px 10px 10px 10px;\"><figcaption class=\"figure-caption\"><small>".$presa['denominazione']."<br> &euro;".$presa['prezzo']."</small></figcaption></figure></a>");

					}

					?>

					</div>

				</div>

			</div>

			<div class="row">

				<div class="col-6">

					<h4>Scegli terminali</h4>

					<ul class="nav nav-tabs">

						<li class="nav-item">

							<a class="nav-link active" role="tab" data-toggle="tab" href="#testa">Testa</a>

						</li>

						<li class="nav-item">

							<a class="nav-link" role="tab" data-toggle="tab" href="#coda">Coda</a>

						</li>

					</ul>

					<div class="tab-content">

						<div class="tab-pane active" id="testa" role="tabpanel">

							<h5>Testa</h5>

							<?php $sql = 'SELECT terminale_id, denominazione, prezzo, image_url FROM ac_terminali ORDER BY denominazione';

    					foreach ($conn->query($sql) as $presa) {

							echo("<a href=\"conf-mngr.php?preventivo_id=".$preventivo_id."&tc=t&terminale_id=".$presa['terminale_id']."\"><figure class=\"figure\"><img alt=\"".$presa['denominazione']." (".$presa['prezzo'].")\" src=\"".$presa['image_url']."\" style=\"max-height: 90px; max-height: 90px; padding: 10px 10px 10px 10px;\"><figcaption class=\"figure-caption\"><small>".$presa['denominazione']."<br> &euro;".$presa['prezzo']."</small></figcaption></figure></a>");

					}

					?>

						</div>

						<div class="tab-pane" id="coda" role="tabpanel">

							<h5>Coda</h5>

							<?php $sql = 'SELECT terminale_id, denominazione, prezzo, image_url FROM ac_terminali ORDER BY denominazione';

    					foreach ($conn->query($sql) as $presa) {

							echo("<a href=\"conf-mngr.php?preventivo_id=".$preventivo_id."&tc=c&terminale_id=".$presa['terminale_id']."\"><figure class=\"figure\"><img alt=\"".$presa['denominazione']." (".$presa['prezzo'].")\" src=\"".$presa['image_url']."\" style=\"max-height: 90px; max-height: 90px; padding: 10px 10px 10px 10px;\"><figcaption class=\"figure-caption\"><small>".$presa['denominazione']."<br> &euro;".$presa['prezzo']."</small></figcaption></figure></a>");

					}

					?>

						</div>

					</div>

				</div>

				<div class="col-6">

					<h4>Offerta economica</h4>

								</div>

			</div>



		</main>

		<footer class="footer">

			<p>© ASA Plastici 2017 - Powered by <a href="http://www.mattiarighetti.it">Mattia Righetti</a>

			</p>

		</footer>

	</div>

	<!-- /container -->

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

</body>

</html>