<!DOCTYPE html>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Lista de usuarios</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h2 class="mt-5 mb-5">Lista de usuarios</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<table class="table">
				  <thead class="thead-dark">
				  	<tr>
				      <th>#</th>
				      <th>Nombre usuario</th>
				      <th>N&uacute;mero de indentificaci&oacute;n</th>
				      <th>E-mail</th>
				    </tr>
				  </thead>
				  <tbody>
				  	
				  	@foreach ($datos as $usuario):
				  		<tr>
					      <th>{{ $usuario->id_usuario }}</th>
					      <td>{{ $usuario->nom_usuario }}</td>
					      <td>{{ $usuario->num_identificacion }}</td>
					      <td>{{ $usuario->mail_usuario }}</td>
					    </tr>
				  	@endforeach
				  </tbody>
				</table>	
			</div>
		</div>

		
		
	</div>	
	


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>



