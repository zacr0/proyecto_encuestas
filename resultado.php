<?php
    include 'includes/maquetacion.php';
    include 'includes/bbdd.php';
    // Sesion:
    session_start();
    if ($_SESSION['nombre'] == '') {
        header('Location: index.php');
    }

    require('conexion.php');
 
    if(!isset($_GET['id'])){
        header('location: index.php');
    }
 
    $suma = 0;
    $id = $_GET['id'];
    $mod = @mysql_query("SELECT SUM(valor) as valor FROM opciones WHERE id_encuesta = ".$id);
    while($result = @mysql_fetch_object($mod)){
        $suma = $result->valor;
    }
    inicioDocumento("Resultados de la encuesta");
    navBarLogeado();
?>

    <div class="container">
    <form action="" method="post">
<?php
    $aux = 0;
    $sql = "SELECT a.titulo as titulo, a.fecha as fecha, b.id as id, b.nombre as nombre, b.valor as valor FROM encuestas a INNER JOIN opciones b ON a.id = b.id_encuesta WHERE a.id = ".$id;
    $req = @mysql_query($sql);
 
    while($result = @mysql_fetch_object($req)){
        if($aux == 0){
                echo '<div class="col-md-6 col-md-offset-3 text-center">';
                echo "<h1 class='text-left'>".$result->titulo.":</h1>";
                echo "<ul class='list-unstyled well well-lg'>";
            $aux = 1;
        }
        echo '<li><strong>- '.$result->nombre.':</strong><div class="clearfix">Votos: '.$result->valor.'</div>';
        if($suma == 0){
            echo '<div style="width:0%;"></div></li>';
        }else{
            echo '<div class="progress progress-striped active"><div class="progress-bar " style="width:'.($result->valor*100/$suma).'%;"><strong>'.round($result->valor*100/$suma).'%</strong></div></div></li>';
        }
 
    }
    echo '</ul>'; 
 
    if(isset($aux)){
        echo '<strong>Total: </strong>'.$suma;
        echo '<a href="encuesta.php?id='.$id.'"" class="clearfix"><span class="glyphicon glyphicon-arrow-left"></span> Volver</a>';
    }
 
?>
    </ul>
    </form>
    </div>
    </div>
<?php 
footer();
finDocumento();
?>