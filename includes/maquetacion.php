<?php
function inicioDocumento($titulo) {
	echo '<!DOCTYPE html>
	<html lang="es">
		<head>
			<meta charset="UTF-8">
			<title>Sistema de respuestas</title>
			<link rel="stylesheet" href="css/bootstrap.min.css">
		</head>
		<body>';
}

function finDocumento() {
	echo '<script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>';
}

function formularioLogin() {
	echo '<form action=' . htmlspecialchars($_SERVER["PHP_SELF"]) . ' method="post" class="well">
		<h3>Inicio de sesión:</h3>
		<div class="form-group">
			<label for="login">Usuario:</label>
			<input type="text" name="login" id="login" placeholder="login de usuario" class="form-control" required/>
		</div>
		<div class="form-group">
			<label for="password">Contraseña:</label>
			<input type="password" name="password" id="password" class="form-control" required/>
		</div>
		<button type="submit" name="entrar" class="btn btn-lg btn-success">Entrar</button>
		<button type="reset" class="btn btn-lg btn-danger">Limpiar</button>
	</form>';
}

function formularioRegistro() {
	echo '<form action=' . htmlspecialchars($_SERVER["PHP_SELF"]) . ' method="post" class="well">
		<h3>Registro de usuario:</h3>
		<div class="form-group">
			<label for="login">login:</label>
			<input type="text" name="login" id="login" placeholder="Pepito" class="form-control" required/>
		</div>
		<div class="form-group">
			<label for="password">Contraseña:</label>
			<input type="password" name="password" id="password" class="form-control" required/>
		</div>
		<button type="submit" name="registrar" class="btn btn-lg btn-success">Registrar</button>
		<button type="reset" class="btn btn-lg btn-danger">Limpiar</button>
	</form>';
}
?>
