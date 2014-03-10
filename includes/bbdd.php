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
?>