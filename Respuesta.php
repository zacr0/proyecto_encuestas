<?php
class Respuestas
{
	private $id;
	private $respuesta;
	private $idPregunta;
	private $idInstanciaEncuesta;
	private $idEncuesta;
	private $idUsuario;
	
	public static function getRespuestas()
	{
		$obj_respuesta = new Consulta();
		$obj_respuesta->ejecutarConsulta("SELECT * FROM Respuestas");
		
		return $obj_respuesta->fetchAll();
	}
	
	function __construct($nro=0)
	{
		if ($nro != 0) {
			$obj_respuesta = new Consulta();
			$resultado = $obj_respuesta->ejecutarConsulta("SELECT * FROM Respuestas WHERE id=$nro");
			$fila = mysqli_fetch_array($resultado);
			$this->id = $fila['idRespuestas'];
			$this->respuesta = $fila['respuesta'];
			$this->idPregunta = $fila['Preguntas_idPreguntas'];
			$this->idInstanciaEncuesta = $fila['InstanciasEncuesta_idInstanciasEncuesta'];
		}
	}
}
?>