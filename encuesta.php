<?php
include 'includes/maquetacion.php';

require ('conexion.php');
$id = $_GET['id'];
if (!isset($_GET['id'])) {
	header('location: index.php');
}

if (isset($_POST['votar'])) {

	if (isset($_POST['valor'])) {
		$opciones = $_POST['valor'];
		$mod = mysqli_query("SELECT * FROM opciones WHERE id = " . $opciones);
		while ($result = mysqli_fetch_object($mod)) {
			$valor = $result -> valor + 1;
			// obtenemos el valor de 'valor' y le añadimos 1 unidad
			mysqli_query("UPDATE opciones SET valor =  '" . $valor . "' WHERE id = " . $opciones);
			// luego ejecutamos el query SQL
		}
		header('location: resultado.php?id=' . $id);
		// Por ultimo lo redireccionamos a la encuestas mostrando los resultados.
	}
}
inicioDocumento("Responder encuesta");
?>

<div class="wrap">

	<form action="" method="post">
		<?php
		$aux = 0;
		$sql = "SELECT a.titulo as titulo, a.fecha as fecha, b.id as id, b.nombre as nombre, b.valor as valor FROM encuestas a INNER JOIN opciones b ON a.id = b.id_encuesta WHERE a.id = " . $id;
		$req = mysqli_query($sql);

		while ($result = mysqli_fetch_object($req)) {

			if ($aux == 0) {
				echo '<h1>' . $result -> titulo . '</h1>';

				echo '<ul class="votacion">';
				$aux = 1;
			}

			echo '<li><input name="valor" type="radio" value="' . $result -> id . '"><span>' . $result -> nombre . '</span></li>';

		}
		echo '</ul>';

		if (!isset($_POST['valor'])) {
			echo "<div class='text-error'>Selecciona una opcion.</div>";
		}

		echo "<input name='votar' type='submit' value='Votar' class='votar'>";
		echo "<a href='resultado.php?id=" . $id . "' class='resultado'>Ver Resultados</a>";
		echo "<a href='index.php' class='volver'>&larr; Volver</a>";
		?>
	</form>
</div>

<?php
finDocumento();
?>