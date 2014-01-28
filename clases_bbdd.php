<?php

class Conexion
{
	var $con;

	function Conexion($server, $user, $pass, $bd)
	{
		//Datos del servidor de BBDD	
		$connection['server'] = $server;
		$connection['user'] = $user;
		$connection['pass'] = $pass;
		$connection['base'] = $bd;

		// Creacion de la conexion con los datos recibidos
		$connect = mysqli_connect($connection['server'], $connection['user'], $connection['pass'], $connection['base']);

		// Si la conexion es exitora, accedemos a la bbdd
		if ($connect) {
			mysqli_select_db($connection['base']);
			$this->con = $connect;
		}
	}
	
	function getConexion()
	{
		return $this->con;
	}
	
	function close()
	{
		mysqli_close($this->con);
	}
}

class Consulta
{
	var $conexion, $consulta, $resultado;
	
	// Constructor
	function Consulta()
	{
		$this->conexion = new Conexion($server, $user, $pass, $bd);
	}
	
	// Ejecuta la consulta y la guarda en $consulta
	function ejecutarConsulta($cons)
	{
		$this->consulta = mysqli_query($cons, $this->conexion->getConexion());
		return $this->consulta;
	}
	
	// Devuelve la consulta en forma de result
	function getResults()
	{
		return $this->consulta;
	}
	
	// Cierra la conexion con la db
	function close()
	{
		$this->conexion->close();
	}
	
	// Libera la consulta
	function limpiar()
	{
		mysqli_free_result($this->consulta);
	}
	
	// Devuelve la cantidad de registros encontrados
	function getResultados()
	{
		return mysqli_affected_rows($this->conexion->getConexion());
	}
	
	// Cantidad de filas afectadas
	function getAfectados()
	{
		return mysqli_affected_rows($this->conexion->getConexion());
	}
	
	function fetchAll()
	{
		$filas = array();
		
		if ($this->consulta) {
			while ($fila = mysqli_fetch_array($this->consulta)) {
				$filas[] = $fila;
			}
		}
		return $filas;
	}
}

?>
