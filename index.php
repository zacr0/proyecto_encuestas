<?php
include 'includes/maquetacion.php';
// Conexion BBDD
require ('conexion.php');
$sql = "SELECT * FROM encuestas ORDER BY id DESC";
$req = mysqli_query($sql);

inicioDocumento("Sistema de encuestas");
?>
<div class="container">
	<header>
		<h1>Encuestas:</h1>
	</header>
	<ul class="list-group">
		<?php
		while ($result = mysqli_fetch_object($req)) {
			echo '<li class="list-group-item"><a href="encuesta.php?id=' . $result -> id . '">' . $result -> titulo . '</a></li>';
		}
		?>
	</ul>
	<a href="agregar.php"><button class="btn btn-lg btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Crear encuesta</a></button>
</div>
<?php finDocumento(); ?>