<?php
class Pregunta {
	var $id;
	var $enunciado;
	var $texto_ayuda;
	var $tipo;
	var $idEncuesta;

	public static function getPreguntas() {
		$obj_pregunta = new Consulta();
		$obj_pregunta -> ejecutarConsulta('SELECT * FROM Preguntas');

		return $obj_pregunta -> fetchAll();
	}

	// Constructor
	function Pregunta($nro = 0) {
		if ($nro != 0) {
			$obj_pregunta = new Consulta();
			$resultado = $obj_pregunta -> ejecutarConsulta('SELECT * FROM Preguntas WHERE idPreguntas = $nro');
			$fila = mysqli_fetch_array($resultado);
			$this -> id = $fila['idPreguntas'];
			$this -> enunciado = $fila['enunciado'];
			$this -> texto_ayuda = $fila['textoAyuda'];
			$this -> tipo = $fila['tipo'];
			$this -> idEncuesta = $fila['Encuestas_idEncuestas'];
		}
	}

	// GETTERS
	function getID() {
		return $this -> id;
	}

	function getEnunciado() {
		return $this -> enunciado;
	}

	function getTextoAyuda() {
		return $this -> texto_ayuda;
	}

	function getTipo() {
		return $this -> tipo;
	}

	function getIdEncuesta() {
		return $this -> idEncuesta;
	}

	// SETTERS
	function setEnunciado($valor) {
		$this -> enunciado = $valor;
	}

	function setTextoAyuda($valor) {
		$this -> texto_ayuda = $valor;
	}

	function setTipo() {
		$this -> tipo = $valor;
	}

	// MANEJO DB
	function guardar() {
		if ($this -> id) {
			$this -> actualizarPregunta();
		} else {
			$this -> insertarPregunta();
		}
	}

	function actualizarPregunta() {
		$obj_pregunta = new Consulta();
		$consulta = "UPDATE Preguntas SET enunciado='$this->enunciado', textoAyuda='$this->texto_ayuda', tipo='$this->tipo' WHERE idPreguntas='$this->id' AND Encuestas_idEncuestas='$this->idEncuesta'";
		$obj_pregunta -> ejecutarConsulta($consulta);

		return $obj_pregunta -> getAfectados();
	}

	function insertarPregunta() {
		$obj_pregunta = new Consulta();
		$consulta = "INSERT INTO `encuestas`.`preguntas` (`idPreguntas` ,`enunciado` ,`textoAyuda` ,`tipo` ,`Encuestas_idEncuestas`) VALUES (NULL , '$this->enunciado', '$this->texto_ayuda' , '$this->tipo', '$this->idEncuesta')";
		$obj_pregunta->ejecutarConsulta($consulta);
		
		return $obj_pregunta->getAfectados();
	}
	
	function eliminar()
	{
		$obj_pregunta = new Consulta();
		$consulta = "DELETE FROM Preguntas WHERE idPreguntas=$this->id";
		$obj_pregunta->ejecutarConsulta($consulta);
		
		return $obj_pregunta->getAfectados();
	}
	
	function limpiarCadena($cadena)
	{
		$cadena = trim($cadena);
		$cadena = mysqli_escape_string($cadena);
		$cadena = htmlspecialchars($cadena);
		
		return $cadena;
	}
}
?>