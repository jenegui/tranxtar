<div class="jumbotron text-center">
	 
	 <h1>Bienvenidos a la aplicacion web de Gabriel David Neira G&oacute;mez</h1>
	 <img src="images/husky.png" width="75px" height="120px">
</div>
<?php 
	
	$primerNum = rand(10, 99);
	$segundoNum = rand(10, 99);
	$tercerNum = rand(10, 99);
	$cuartoNum = rand(10, 99);
	if($cuartoNum <= $tercerNum){
		$cuartoNumero=$cuartoNum;
	}else{
		$cuartoNumero=0;
	}
?>
<html>
	<head>
		<link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
		<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="alert alert-success" role="alert" align="center"><h2>Welcome to grabriel's challenge</h2></div>
		<div align="center">
			<form action="resultado.php" method="post">
				<div>Suma
					
						<div>&nbsp;&nbsp;&nbsp;<?php echo  $primerNum; ?></div>
						<div>+ <?php echo  $segundoNum; ?></div>
						 <p><input type="hidden" name="primernum" value="<?php echo  $primerNum; ?>" /></p>
						 <p><input type="hidden" name="segundonum" value="<?php echo  $segundoNum; ?>"/></p>
						 <p>=<input type="text" name="resultadoSuma" value=""/></p>
					

					<hr/>	
				</div>
				<div> Resta
					
						 <div>&nbsp;&nbsp;&nbsp;<?php echo  $tercerNum; ?></div>
						<div>- <?php echo  $cuartoNumero; ?></div>
						 <p><input type="hidden" name="tercerNum" value="<?php echo  $tercerNum; ?>" /></p>
						 <p><input type="hidden" name="cuartoNumero" value="<?php echo  $cuartoNumero; ?>"/></p>
						 <p>=<input type="text" name="resultadoResta" value=""/></p>
						 
					
				</div>
				<div >
					<button id="calcular" name="calcular" value="Calcular" class="btn btn-primary btn-xl text-uppercase" type="submit">Calcular</button>
				</div>
			</form>
			<hr/>
		</div>
	</body>
</html>

