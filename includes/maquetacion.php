<?php
function inicioDocumento($titulo) {
	echo '<!DOCTYPE html>
	<html lang="es">
		<head>
			<meta charset="UTF-8">
			<title>' . $titulo . '</title>
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
			<label for="nombre">Usuario:</label>
			<input type="text" name="nombre" id="nombre" placeholder="Nombre de usuario" class="form-control" required/>
		</div>
		<div class="form-group">
			<label for="password">Contraseña:</label>
			<input type="password" name="password" id="password" class="form-control" required/>
		</div>
		<button type="submit" name="entrar" class="btn btn-lg btn-primary">Entrar</button>
		<button type="reset" class="btn btn-lg btn-default">Limpiar</button>
	</form>';
}

function formularioRegistro() {
	echo '<form action=' . htmlspecialchars($_SERVER["PHP_SELF"]) . ' method="post" class="well">
		<h3>Registro de usuario:</h3>
		<div class="form-group">
			<label for="nombre">Usuario:</label>
			<input type="text" name="nombre" id="nombre" placeholder="Nombre de usuario" class="form-control" required/>
		</div>
		<div class="form-group">
			<label for="password">Contraseña:</label>
			<input type="password" name="password" id="password" class="form-control" required/>
		</div>
		<button type="submit" name="registrar" class="btn btn-lg btn-primary">Registrar</button>
		<button type="reset" class="btn btn-lg btn-default">Limpiar</button>
	</form>';
}

function navBar()
{
	echo '<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
        	<div class="container">
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                </button>
	                <a class="navbar-brand" href="#">Publipreguntas</a>
	            </div>
        	</div>
    </nav>';
};

function navBarLogeado()
{
	echo '<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
        	<div class="container">
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                </button>
	                <a class="navbar-brand" href="#">Publipreguntas</a>
	            </div>
	        	<div class="navbar-collapse collapse">
	                <ul class="nav navbar-nav">
	                	<li><a href="index.php">Inicio</a></li>
	                	<li><a href="agregar.php"><span class="glyphicon glyphicon-plus"></span> Nueva encuesta</a></li>
	                </ul>
	                <ul class="nav navbar-nav navbar-right">
        				<li><a href="index.php">Usuario: ' . $_SESSION['nombre'] . '</a></li>
	                	<li><a href="cerrarsesion.php" class="btn btn-danger">Cerrar Sesión</a></li>
        			</ul>
	            </div>
	        </div>
    </nav>';
}

function jumbotronPrincipal()
{
	echo '<div class="jumbotron">
  <div class="container">
    <h1>Publipreguntas</h1>
    <p>Lanza preguntas al viento y deja que cualquier usuario las responda,
    podrás obtener respuestas por parte de los usuarios y estadísticas sobre ellas.</p>
  </div>
</div>';
}

function footer()
{
	echo '<div class="row text-center">
		<hr>
		<p>Autores:</p>
		<p><a href="https://github.com/riberot">Francisco Morales Urbano</a></p>
		<p><a href="https://github.com/zacr0/proyecto_encuestas">Pablo Medina Suárez</a></p>
		<p><a href="https://github.com/rurbanojimenez">Rafael Urbano Jiménez</a></p>
		<p>&copy;&copy; - 2014</p>
	</div>';
}

?>
