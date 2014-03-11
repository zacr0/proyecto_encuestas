<?php
	session_start();
	unset($_SESSION['id']);
	unset($_SESSION['nombre']);
	// Destruye la sesion iniciada
	session_destroy();
	header('Location: index.php');
?>