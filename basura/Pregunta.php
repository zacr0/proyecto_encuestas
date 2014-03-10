<?php
class Pregunta {
	private $id;
	private $enunciado;
	private $texto_ayuda;
	private $tipo;
	private $idEncuesta;

	public static function getPreguntas() {
		$obj_pregunta = new Consulta();
		$obj_pregunta -> ejecutarConsulta('SELECT * FROM Preguntas');

		return $obj_pregunta -> fetchAll();
	}

	// Constructor
	public function __construct($nro = 0) {
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
	public function getID() {
		return $this -> id;
	}

	public function getEnunciado() {
		return $this -> enunciado;
	}

	public function getTextoAyuda() {
		return $this -> texto_ayuda;
	}

	public function getTipo() {
		return $this -> tipo;
	}

	public function getIdEncuesta() {
		return $this -> idEncuesta;
	}

	// SETTERS
	public function setEnunciado($valor) {
		$this -> enunciado = $valor;
	}

	public function setTextoAyuda($valor) {
		$this -> texto_ayuda = $valor;
	}

	public function setTipo() {
		$this -> tipo = $valor;
	}

	// MANEJO DB
	public function guardar() {
		if ($this -> id) {
			$this -> actualizarPregunta();
		} else {
			$this -> insertarPregunta();
		}
	}

	public function actualizarPregunta() {
		$obj_pregunta = new Consulta();
		$consulta = "UPDATE Preguntas SET enunciado='$this->enunciado', textoAyuda='$this->texto_ayuda', tipo='$this->tipo' WHERE idPreguntas='$this->id' AND Encuestas_idEncuestas='$this->idEncuesta'";
		$obj_pregunta -> ejecutarConsulta($consulta);

		return $obj_pregunta -> getAfectados();
	}

	public function insertarPregunta() {
		$obj_pregunta = new Consulta();
		$consulta = "INSERT INTO `encuestas`.`preguntas` (`idPreguntas` ,`enunciado` ,`textoAyuda` ,`tipo` ,`Encuestas_idEncuestas`) VALUES (NULL , '$this->enunciado', '$this->texto_ayuda' , '$this->tipo', '$this->idEncuesta')";
		$obj_pregunta -> ejecutarConsulta($consulta);

		return $obj_pregunta -> getAfectados();
	}

	public function eliminar() {
		$obj_pregunta = new Consulta();
		$consulta = "DELETE FROM Preguntas WHERE idPreguntas=$this->id";
		$obj_pregunta -> ejecutarConsulta($consulta);

		return $obj_pregunta -> getAfectados();
	}

}
?>