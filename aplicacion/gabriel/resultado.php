<html>
	<head>
		<link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div align="center">
			<?php 
				if(isset($_REQUEST['calcular'])){
					if(($_REQUEST['primernum'] + $_REQUEST['segundonum']) == $_REQUEST['resultadoSuma']){
						echo "<div class='alert alert-success' role='alert'>Muy bien con el resultado de la suma, ".$_REQUEST['primernum']." + ".$_REQUEST['segundonum']." = ".$_REQUEST['resultadoSuma']."</div>";
						echo '<img src="images/huskySi.gif" alt="Funny image" width="100px" height="100px"><br>';
					}else{
						echo "<div class='alert alert-danger' role='alert'>Vuelve a intentarlo con la suma...</div>";
						echo '<img src="images/huskyNo.gif" alt="Funny image" width="75px" height="100px"><br>';
					}
					if(($_REQUEST['tercerNum'] - $_REQUEST['cuartoNumero']) == $_REQUEST['resultadoResta']){
						echo "<div class='alert alert-success' role='alert'>Muy bien con el resultado de la resta, ".$_REQUEST['tercerNum']." - ".$_REQUEST['cuartoNumero']." = ".$_REQUEST['resultadoResta']."</div>";
						echo '<img src="images/huskySi.gif" alt="Funny image" width="100px" height="100px"><br>';
					}
					else{
						echo "<div class='alert alert-danger' role='alert'>Vuelve a intentarlo con la resta...</div>";
						echo '<img src="images/huskyNo.gif" alt="Funny image" width="75px" height="100px"><br>';
					}
				}
				echo '<div class="alert alert-info" role="alert"><a href="index.php">Intenta otro reto>>>></a></div>';
				
			?>
		</div>
	</body>
</html>
