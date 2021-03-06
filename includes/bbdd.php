<?php
function conectarDB()
{
	try {
		$bd = new PDO('mysql:host=localhost;dbname=encuestas', 'root', 'root');
		$bd->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
		return($bd);
	} catch (PDOException $e) {
		//echo $e->getMessage();	//uestra traza de error
		echo '<p class="text-danger">ERROR: no se pudo establecer conexión con la base de datos.</p>';
		return false;
	}
};

function registrarUsuario($nombre,$password)
{
	$db = conectarDB();
	$consulta = 'INSERT INTO usuarios (nombre,password) VALUES (:nombre, :password)';
	$resultado = $db->prepare($consulta);

	if ($resultado->execute(array(':nombre' => $nombre, ':password' => $password))) {
		echo '<h2 class="text-success">Registrado con éxito</h2>';
		echo '<p class="text-info">Por favor, inicie sesión</p>';
	} else {
		echo '<h2 class="text-danger">Ocurrió un error, no se pudo registrar al usuario</h2>';
	}
	$db = null;
}

function loginUsuario($nombre,$password)
{
	$db = conectarDB();
	$consulta = 'SELECT * FROM usuarios WHERE nombre=:nombre AND password=:password';
	$resultado = $db->prepare($consulta);
	if ($resultado->execute(array(':nombre' => $nombre, ':password' => $password))) {
		foreach ($resultado as $usuarios) {
			$_SESSION['id'] = $usuarios['id'];
			$_SESSION['nombre'] = $usuarios['nombre'];
		}
		header('Location: index.php');
	} else {
		echo '<h2 class="text-danger">Ocurrió un error, no se pudo iniciar sesión</h2>';
	}
	$db = null;
}

function haRespondido($idUsuario,$idEncuesta)
{
	$db = conectarDB();
	$consulta = 'SELECT * FROM encuestas_respondidas WHERE id_usuario="' . $idUsuario . '" AND id_encuesta="' . $idEncuesta . '"';
	$resultado = $db->prepare($consulta);
	$resultado->execute();
	if ($resultado->fetchColumn() == 0) {
		return false;
	}
	return true;
	$db = null;
}

function responderEncuesta($idUsuario, $idEncuesta)
{
	$db = conectarDB();
	$consulta = 'INSERT INTO encuestas_respondidas (id_usuario, id_encuesta) VALUES ('.$idUsuario.','.$idEncuesta.')';
	$resultado = $db->prepare($consulta);
	if (!$resultado->execute()) {
		echo '<h2 class="text-danger">No se ha podido realizar la votación.</h2>';
	}
	$db = null;
}

function buscarEncuestas($busqueda)
{
	$db = conectarDB();
	$consultaCuenta = 'SELECT COUNT(*) FROM encuestas WHERE id IN (SELECT id FROM encuestas WHERE titulo LIKE "%' . $busqueda . '%")';
	$resultadoCuenta = $db->prepare($consultaCuenta);
	$resultadoCuenta->execute();
	if ($resultadoCuenta->fetchColumn() != 0) {
		$consulta = 'SELECT id,titulo FROM encuestas WHERE titulo LIKE "%' . $busqueda . '%"';
		$resultado = $db->prepare($consulta);
		if ($resultado->execute()) {
			foreach ($resultado as $encuesta) {
				echo '<li class="list-group-item ">
				<a class="lead" href="encuesta.php?id=' . $encuesta['id'] . '">' . $encuesta['titulo'] . '</a>
				<a href="resultado.php?id=' . $encuesta['id'] . '" class="pull-right">Ver Resultados <span class="glyphicon glyphicon-arrow-right"></span></a>
				</li>';
			}
		}
	} else {
		echo '<p class="lead">No se encontraron encuestas similares a ' . $busqueda . '</p>';
	}
	$db = null;
}
?>