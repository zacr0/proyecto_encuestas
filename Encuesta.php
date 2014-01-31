<?php
require 'clases_bbdd.php';

class Encuesta
{

    private $id;

    private $nombre;

    private $descripcion;

    private $idUsuario;

    public static function getEncuestas()
    {
        $obj_encuesta = new Consulta();
        $obj_encuesta->ejecutarConsulta("Select * from Encuestas");
        // recuperamos los datos obtenidos en la consulta, y los devolvemos
        return $obj_encuesta->fetchAll();
    }

    public function __construct($n = 0)
    {
        if ($n != 0) {
            $obj_encuesta = new Consulta();
            $resultado_consulta = $obj_encuesta->ejecutarConsulta("Select * from Encuestas where idEncuestas = $n");
            $row = mysqli_fetch_array($resultado_consulta);
            
            $this->id = $row["idEncuestas"];
            $this->nombre = $row["nombre"];
            $this->descripcion = $row["descripcion"];
            $this->idUsuario = $row["Usuarios_idUsuarios"];
        }
    }
    
    /*
     * getters
     */
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    
    /*
     * setters
     */
    public function setNombre($valor)
    {
        $this->nombre = $valor;
    }

    public function setDescripcion($valor)
    {
        $this->descripcion = $valor;
    }
    
    /* metodos de la clase */
    public function guardar()
    {
        if ($this->id) {
            $this->actualizarEncuesta();
        } else {
            $this->insertarEncuesta();
        }
    }

    public function eliminar()
    {
        $obj_consulta = new Consulta();
        $consulta = "DELETE FROM Encuestas WHERE idEncuestas=$this->id";
        $obj_consulta->ejecutarConsulta($consulta);
        return $obj_consulta->getAfectados();
    }

    public function actualizarEncuesta()
    {
        $obj_consulta = new Consulta();
        $consulta = "UPDATE Encuestas SET nombre='$this->nombre', descripcion='$this->descripcion' WHERE idEncuesta = $this->id";
        $obj_consulta->ejecutarConsulta($consulta);
        return $obj_consulta->getAfectados();
    }

    public function insertarEncuesta()
    {
        $obj_consulta = new Consulta();
        $consulta = "INSERT INTO `encuestas`.`Encuestas` (`idEncuesta`,`nombre`,`descripcion`,`Usuarios_idUsuarios`) VALUES (NULL , '$this->nombre', '$this->descripcion' , '$this->idUsuario')";
        $obj_consulta->ejecutarConsulta($consulta);
        return $obj_consulta->getAfectados();
    }
}
