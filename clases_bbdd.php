<?php

class Conexion
{
	var $con;

	function Conexion($server, $user, $pass, $bd)
	{
		//Datos del servidor de BBDD	$connection['server'] = $server;
		$connection['user'] = $user;
		$connection['pass'] = $pass;
		$connection['base'] = $bd;

		// Creacion de la conexion con los datos recibidos
		$connect = mysqli_connect($connection['server'], $connection['user'], $connection['pass'], $connection['base']);

	}
}
?>