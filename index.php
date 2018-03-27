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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


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
			<div class="content">
				<h3>Imposta un nuovo preventivo</h3>
				<form>
					<div class="row">
						<?php
						$tipi = $conn->query("SELECT tipo_id, denominazione FROM ac_modelli_tipi")->fetchAll();
							foreach ($tipi as $tipo) {
    							echo ("<table class=\"table\"><tr><td><h4>".$tipo['denominazione']."</h4></td></tr>");
								$modelli = $conn->query("SELECT modello_id, denominazione, image_url FROM ac_modelli WHERE tipo_id =".$tipo['tipo_id'])->fetchAll();
								echo("<tr><td><div class=\"form-check\">");
								foreach ($modelli as $modello) {
									echo("<input class=\"form-check-input\" type=\"radio\" name=\"modello_id\" id=\"modello_".$modello['modello_id']."\" value=\"".$modello['modello_id']." checked><label class=\"form-check-label\" for=\"modello_".$modello['modello_id']."\">".$modello['denominazione']."</label><br></br>");
								}
								echo("</div></td></tr></table>");
							}
						?>
					</div>
					<div class="row">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<label class="input-group-text" for="cliente">CLIENTE</label>
						</div>
						<select class="custom-select" id="cliente">
							<option selected>Scegli...</option>
							<?php
						$clienti = $conn->query("SELECT cliente_id, nominativo FROM ac_clienti");
							foreach ($clienti as $cliente) {
    						echo("<option value=\"".$cliente["cliente_id"]."\">".$cliente["nominativo"]."</option>");
							}
						?>
						</select>
						<a class="btn btn-primary" href="clienti-add.php" role="button">NUOVO</a>
					</div>
						<a class="btn btn-primary" href="preventivi-add.php" role="button">CREA</a>
					<!--<input class="btn btn-primary" type="button" value="CREA">-->
					</div>
				</form>
					</div>
		</main>

		<footer class="footer">

			<p>© ASA Plastici 2017 - Powered by <a href="http://www.mattiarighetti.it">Mattia Righetti</a>

			</p>

		</footer>

	</div>

	<!-- /container -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>