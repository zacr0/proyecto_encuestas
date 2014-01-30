<?php
require  'clases_bbdd.php';
class Usuario {
	
	var $id;
	var $nick;
	var $pass;
	var $nivel;
	
	public static function getUsuarios(){
		
		$obj_usuario = new Consulta();
		//Ejecuta la consulta para ver los usuarios
		$obj_usuario-> ejecutarConsulta("Select * from Usuarios");
		//Recupera los datos de la consulta y los devuelve
		return $obj_usuario-> fetchAll();
		
	}
	
	function Usuario($nro=0){
		
		if ($nro!=0){
			
			$obj_usuario = new Consulta();
			$resultado=$obj_usuario-> ejecutarConsulta("Select * from Usuarios where idUsuarios = $nro");
			$row= mysqli_fetch_array($resultado);
			
			$this-> id = $row["idUsuarios"];
			$this-> nick=$row["login"];
			$this-> pass=$row["password"];
			$this-> nivel=$row["nivel"];
		}
	} 
	//Metodso que devuelven valores
	function getId(){
		return $this->id;
	}
	function getNick(){
		return $this->nick;
	}
	function getPassword(){
		return $this->pass;
	}
	function getNivel(){
		return $this->nivel;
	}
	//Metodos que recojen valores
	
	function setId($val){
		$this->id=$val;
	}
	function setNick($val){
		$this->nick=$val;
	}
	function setPassword($val){
		$this->pass=$val;
	}
	function setNivel($val){
		$this->nivel=$val;
	}
	
	function Guardar(){
		if($this->id){
			$this->actualizarUsuario();
		}else{
			$this->insertarUsuario();
		}
	}
	function actualizarUsuario(){
		$obj_usuario= new Consulta();
		$consulta="";
	}
}
?>
