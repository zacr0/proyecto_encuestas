<?php

class Usuario {

	private $id;
	private $nick;
	private $pass;
	private $nivel;

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

	function guardar(){
		if($this->id){
			$this->actualizarUsuario();
		}else{
			$this->insertarUsuario();
		}
	}
	function actualizarUsuario(){
		$obj_usuario= new Consulta();
		$consulta="UPDATE  encuestas.usuarios SET  login =  '$this->nick',password = '$this->pass',nivel = '$this->nivel' WHERE  usuarios.idUsuarios =$this->id;";
		$obj_usuario->ejecutarConsulta($consulta);
		return $obj_usuario->getAfectados();
	}
	function insertarUsuario(){
		$obj_usuario= new Consulta();
		$consulta="INSERT INTO `encuestas`.`usuarios` (`idUsuario`, `login`, `password`,`nivel`) VALUES (NULL, '$this->nick', '$this->pass', '$this->nivel');";
		$obj_usuario->ejecutarConsulta($consulta);
		return $obj_usuario-> getAfectados();
	}
	function eliminar(){
		$comprueba= new Consulta();
		$concomprueba="SELECT COUNT( * )as resul FROM usuarios, encuestas WHERE usuarios.idUsuarios = encuestas.Usuarios_idUsuariosAND usuarios.idUsuarios =$this->id";
		$a=$comprueba->ejecutarConsulta($concomprueba);
		$row= mysqli_fetch_array($a);
		if($row["resul"]==0){
			$obj_usuario=new Consulta();
			$consulta="DELETE FROM `encuestas`.`usuarios` WHERE `usuarios`.`idUsuarios` = $this->id";
			$obj_usuario->ejecutarConsula($consulta);
			return $obj_usuario->getAfectados();
		}
	}
	
	
}
?>
