<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Mattia Righetti (studio@mattiarighetti.it)">
	<link rel="icon" href="images/favicon.ico">
	<title>Configuratore ASA Plastici - Aggiungi cliente</title>
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
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="preventivi-list.php">Preventivi</a>
					</li>					
					<li class="nav-item">
						<a class="nav-link active" href="clienti-list.php">Clienti</a>
					</li>
				</ul>
			</nav>
			<h3 class="text-muted"><img src="/images/logo.jpg" style="max-width: 100px;height: auto"></h3>
		</header>
		<main role="main">
				<h3>Nuovo cliente</h3>
				<form action="clienti-add.php" method="post">
					<div class="form-group">
    <label for="nominativo">Nominativo</label>
    <input type="text" class="form-control" id="nominativo" name="nominativo" placeholder="e.g.: Azienda SRL">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="email@azienda.it">
  </div>
					<div class="form-group">
    <label for="referente">Referente</label>
    <input type="text" class="form-control" id="referente" name="referente" placeholder="Mario Rossi">
  </div>
  <div class="form-group">
    <label for="telefono">Telefono</label>
    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="+39 123432198">
  </div>	
					<button type="submit" name="submit" value="submit" class="btn btn-default">CREA</button>
				</form>
		</main>
		<footer class="footer">
			<p>© ASA Plastici 2017 - Powered by <a href="http://www.mattiarighetti.it">Mattia Righetti</a></p>
		</footer>
	</div><!-- /container -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
<?php
 if(isset($_POST['submit'])){
	 include( 'db-config.php' );
	$cliente_id = $conn->query("SELECT COALESCE(MAX(cliente_id) + 1, 1) AS cliente_id FROM ac_clienti")->fetch(PDO::FETCH_ASSOC);
	 $cliente_id = $cliente_id['cliente_id'];
	 $nominativo = $_POST['nominativo'];
	$email = $_POST['email'];
		$referente = $_POST['referente'];
		$telefono = $_POST['telefono'];
   $conn->query("INSERT INTO ac_clienti (cliente_id, nominativo, email, referente, telefono) VALUES ($cliente_id, '$nominativo', '$email', '$referente', '$telefono')");
			header( "Location: clienti-list.php" );
}
	?>