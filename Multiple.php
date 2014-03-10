<?php
class Multiple{
	
	private $id;
	private $opcion;
	private $idpregunta;
	
	function __construct(){
		
		$multiple=new Consulta();
		$consulta="SELECT * FROM  `opcionesrespuestamultiple` ";
		$resultado=$multiple->ejecutarConsulta($consulta);
		$row=mysqli_fetch_array($resultado);
		
		$this-> id=$row["idOpcionesRespuestaMultiple"];
		$this-> opcion=$row["opcion"];
		$this-> idpregunta=$row["Preguntas_idPreguntas"];
		
		
	}
	
	//Metodos get
	
	function getId(){
		return $this->id;
	}
	function getOpcion(){
		return $this->opcion;
	}
	function getIdpregunta(){
		return $this->idpregunta;
	}
	//Metodos set
	
	function setOpcion($v){
		$this->id=$v;
	}
	
	
	function guardar(){
		if($this->id){
			$this->actualizarMultiple();
		}else{
			$this->insertarMultiple();
		}
	}
	
	function actualizarMultiple(){
		$obj_multiple=new Consulta();
		$consulta="UPDATE  `encuestas`.`opcionesrespuestamultiple` SET  `opcion` =  '$this->opcion' WHERE  `opcionesrespuestamultiple`.`idOpcionesRespuestaMultiple` =$this->id AND  `opcionesrespuestamultiple`.`Preguntas_idPreguntas` =$this->idpregunta;";
		$obj_multiple->ejecutarConsulta($consulta);
		return $obj_multiple->getAfectados();
	}  
	function insertarMultiple(){
		$obj_multiple=new Consulta();
		$consulta="INSERT INTO  `encuestas`.`opcionesrespuestamultiple` (`idOpcionesRespuestaMultiple` ,`opcion` ,`Preguntas_idPreguntas`)VALUES (NULL ,  '$this->opcion',  '$this->idpregunta');";
		$obj_multiple->ejecutarConsulta($consulta);
		return $obj_multiple->getAfectados();
	}  
	function eliminar(){
		$obj_multiple=new Consulta();
		$consulta="DELETE FROM `encuestas`.`opcionesrespuestamultiple` WHERE `opcionesrespuestamultiple`.`idOpcionesRespuestaMultiple` = $this->id AND `opcionesrespuestamultiple`.`Preguntas_idPreguntas` = $this->idpregunta";
		$obj_multiple->ejecutarConsula($consulta);
		return $obj_multiple->getAfectados();
	}           
}


?>