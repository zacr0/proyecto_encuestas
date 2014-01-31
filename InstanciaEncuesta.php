<?php
require 'clases_bbdd.php';
require 'Encuesta.php';

class InstanciaEncuesta extends Encuesta {

	private $id;

	private $idEncuesta;

	private $fIni;

	private $fFin;

	private $esPrivada;

	public static function getInscanciasEncuesta() {
		$obj_encuesta = new Consulta();
		$obj_encuesta -> ejecutarConsulta("Select * from InstanciasEncuesta");
		// recuperamos los datos obtenidos en la consulta, y los devolvemos
		return $obj_encuesta -> fetchAll();
	}

	public function __construct($nEncuesta = 0, $nInstancia = 0) {
		if ($nEncuesta != 0 && $nInstancia != 0) {
			$obj_encuesta = new Consulta();
			$resultado_consulta = $obj_encuesta -> ejecutarConsulta("Select * from InstanciasEncuesta where Encuestas_idEncuestas = $nEncuesta AND idInstanciasEncuesta = $nInstancia");
			$row = mysqli_fetch_array($resultado_consulta);

			parent::__construct($nEncuesta);
			$this -> id = $row["idInstanciasEncuesta"];
			$this -> idEncuesta = $row["Encuestas_idEncuestas"];
			$this -> fIni = $row["fechaInicio"];
			$this -> fFin = $row["fechaFin"];
			$this -> esPrivada = $row["esPrivada"];
		}
	}

	/* getters */
	public function getIdInstancia() {
		return $this -> id;
	}

	public function getIdEncuesta() {
		return $this -> idEncuesta;
	}

	public function getEsPrivada() {
		return $this -> esPrivada;
	}

	public function getFechaInicio() {
		return $this -> fIni;
	}

	public function getFechaFin() {
		return $this -> fFin;
	}

	/* setters */
	public function setFechaInicio() {
		$this -> fIni = $valor;
	}

	public function setFechaFin($valor) {
		$this -> fFin = $valor;
	}

	public function setEsPrivada($valor) {
		$this -> esPrivada = $valor;
	}

	/* metodos de la clase */
	public function guardar() {
		if ($this -> id) {
			$this -> actualizarInstancia();
		} else {
			$this -> insertarInstancia();
		}
	}

	public function eliminar() {
		$obj_consulta = new Consulta();
		$consulta = "DELETE FROM InstanciasEncuesta WHERE idInstanciasEncuesta=$this->id";
		$obj_consulta -> ejecutarConsulta($consulta);
		return $obj_consulta -> getAfectados();
	}

	public function actualizarInstancia() {
		$obj_consulta = new Consulta();
		$consulta = "UPDATE InstanciasEncuesta SET fechaInicio='$this->fIni', fechaFin='$this->fFin', esPrivada=$this->esPrivada WHERE idInstanciasEncuesta = $this->id AND Encuestas_idEncuestas=$this->idEncuesta";
		$obj_consulta -> ejecutarConsulta($consulta);
		return $obj_consulta -> getAfectados();
	}

	public function insertarInstancia() {
		$obj_consulta = new Consulta();
		$consulta = "INSERT INTO `encuestas`.`InstanciasEncuesta` (`idInstanciasEncuesta`,`fechaInicio`,`fechaFin`,`esPrivada`,`Encuestas_idEncuestas`) VALUES (NULL , '$this->fIni', '$this->fFin' , $this->esPrivada , $this->idEncuesta)";
		$obj_consulta -> ejecutarConsulta($consulta);
		return $obj_consulta -> getAfectados();
	}

}
?>