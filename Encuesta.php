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
    // getters
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
    //setters
    public function setNombre($valor){
        $this->nombre = $valor;
    }
    public function setDescripcion($valor){
        $this->descripcion = $valor;
    }
}
