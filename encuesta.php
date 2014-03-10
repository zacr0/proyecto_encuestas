<?php
    include 'includes/maquetacion.php';
    include 'includes/bbdd.php';
    // Sesion:
    session_start();
    if ($_SESSION['nombre'] == '') {
        header('Location: index.php');
    }
    require('conexion.php');
        $id = $_GET['id'];
    if(!isset($_GET['id'])){
        header('location: index.php');
    }
 
    if(isset($_POST['votar']))
    {
 
        if(isset($_POST['valor'])){
            $opciones = $_POST['valor'];
            $mod = mysql_query("SELECT * FROM opciones WHERE id = ".$opciones);
            while($result = mysql_fetch_object($mod)){
                $valor = $result->valor + 1; // obtenemos el valor de 'valor' y le añadimos 1 unidad
                mysql_query("UPDATE opciones SET valor =  '".$valor."' WHERE id = ".$opciones); // luego ejecutamos el query SQL
            }
            header('Location: resultado.php?id='.$id); // Por ultimo lo redireccionamos a la encuestas mostrando los resultados.
        }
    }
    inicioDocumento("Encuesta");
    navBarLogeado();
?>
 
    <div class="container">
 
    <form class="well well-lg col-md-6 col-md-offset-3" action="" method="post">
<?php
    $aux = 0;
    $sql = "SELECT a.titulo as titulo, a.fecha as fecha, b.id as id, b.nombre as nombre, b.valor as valor FROM encuestas a INNER JOIN opciones b ON a.id = b.id_encuesta WHERE a.id = ".$id;
    $req = mysql_query($sql);
 
    while($result = mysql_fetch_object($req)){
 
        if($aux == 0){
            echo '<h1>'.$result->titulo.'</h1>';
            if(!isset($_POST['valor'])){
                echo "<strong>Selecciona una opcion:</strong>";
            }
            echo '<ul class="list-unstyled">';
            $aux = 1;
        }
 
        echo '<li class="text-center">
            <div class="input-group col-md-6 col-md-offset-3">
                <span class="input-group-addon">
                    <input name="valor" type="radio" value="'.$result->id.'">
                </span>
                <input type="text" class="form-control text-center" value="'.$result->nombre.'" disabled>
            </div>
        </li>';
 
    }
        echo '</ul>';
 
        echo "<button name='votar' type='submit'class='btn btn-block btn-primary'>Votar</button>";
        echo '<hr>';
        echo "<a href='resultado.php?id=".$id."' class='pull-right'>Ver Resultados <span class='glyphicon glyphicon-arrow-right'></span></a>";
        echo "<a href='index.php' class='pull-left'><span class='glyphicon glyphicon-arrow-left'></span> Volver</a>";
 
?>
    </form>
    </div>
 
<?php
footer();
finDocumento();
?>