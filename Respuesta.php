<?php
class Respuestas {
	private $id;
	private $respuesta;
	private $idPregunta;
	private $idInstanciaEncuesta;
	private $idEncuesta;
	private $idUsuario;

	public static function getRespuestas() {
		$obj_respuesta = new Consulta();
		$obj_respuesta -> ejecutarConsulta("SELECT * FROM Respuestas");

		return $obj_respuesta -> fetchAll();
	}

	public function __construct($nro = 0) {
		if ($nro != 0) {
			$obj_respuesta = new Consulta();
			$resultado = $obj_respuesta -> ejecutarConsulta("SELECT * FROM Respuestas WHERE id=$nro");
			$fila = mysqli_fetch_array($resultado);
			$this -> id = $fila['idRespuestas'];
			$this -> respuesta = $fila['respuesta'];
			$this -> idPregunta = $fila['Preguntas_idPreguntas'];
			$this -> idInstanciaEncuesta = $fila['InstanciasEncuesta_idInstanciasEncuesta'];
			$this -> idEncuesta = $fila['InstanciasEncuesta_Encuestas_idEncuestas'];

			if (isset($idUsuario)) {
				$this -> idEncuesta = $fila['Usuarios_idUsuarios'];
			}
		}
	}

	// GETTERS:
	public function getID() {
		return $this -> id;
	}

	public function getRespuesta() {
		return $this -> respuesta;
	}

	public function getIdPregunta() {
		return $this -> idPregunta;
	}

	public function getIdInstancia() {
		return $this -> idInstanciaEncuesta;
	}

	public function getIdEncuesta() {
		return $this -> idEncuesta;
	}

	public function getIdUsuario() {
		return $this -> idUsuario;
	}

	// SETTERS:
	public function setRespuesta($valor) {
		$this -> respuesta = $valor;
	}

	// MANEJO DB
	public function guardar() {
		if ($this -> id) {
			$this -> actualizarRespuesta();
		} else {
			$this -> insertarRespuesta();
		}
	}

	public function actualizarRespuesta() {
		$obj_respuesta = new Consulta();
		$consulta = "UPDATE `encuestas`.`respuestas` SET `respuesta` = '$this->respuesta', `Preguntas_idPreguntas` = '$this->idPregunta', `InstanciasEncuesta_idInstanciasEncuesta` = '$this->idInstanciaEncuesta', `InstanciasEncuesta_Encuestas_idEncuestas` = '$this->idEncuesta', `Usuarios_idUsuarios` = '$this->idUsuario' WHERE `respuestas`.`idRespuestas` = $this->id";
		$obj_respuesta -> ejecutarConsulta($consulta);
		return $obj_respuesta -> getAfectados();
	}

	public function insertarRespuesta() {
		$obj_respuesta = new Consulta();
		$consulta = "INSERT INTO `encuestas`.`respuestas` (`idRespuestas`, `respuesta`, `Preguntas_idPreguntas`, `InstanciasEncuesta_idInstanciasEncuesta`, `InstanciasEncuesta_Encuestas_idEncuestas`, `Usuarios_idUsuarios`) VALUES (NULL, '$this->respuesta', '$this->idPregunta', '$this->idInstanciaEncuesta', '$this->idEncuesta', '$this->idUsuario')";
		$obj_respuesta -> ejecutarConsulta($consulta);
		return $obj_respuesta -> getAfectados();
	}

	public function eliminar() {
		$obj_respuesta = new Consulta();
		$consulta = "DELETE FROM Respuestas WHERE id=$this->id";
		$obj_respuesta -> ejecutarConsulta($consulta);
		return $obj_respuesta -> getAfectados();
	}

}
?>