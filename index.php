<?php
    include 'includes/maquetacion.php';
    include 'includes/bbdd.php';

    //require('conexion.php');
    $conexion = mysqli_connect("localhost","root","root", "encuestas");
    $sql = "SELECT * FROM encuestas ORDER BY id DESC";
    $req = mysqli_query($conexion,$sql);

    session_start();

    if (!isset($_SESSION['nombre'])) {
        $_SESSION['id'] = '';
        $_SESSION['nombre'] = '';
    }

    // Maquetacion
    inicioDocumento("Sistema de encuestas");
    if ($_SESSION['nombre'] == '') {
        navBar();
        echo '<div class="container">';
        jumbotronPrincipal();
        echo '<h1 class="text-primary">¡Únete!</h1>
        <hr>';
        echo '<div class="col-md-6">';
            formularioLogin();
        echo '</div>';
        echo '<div class="col-md-6">';
            formularioRegistro();
        echo '</div>';

        if (isset($_POST['entrar'])) {
            loginUsuario($_POST['nombre'],$_POST['password']);
        }

        if (isset($_POST['registrar'])) {
            registrarUsuario($_POST['nombre'],$_POST['password']);
        }
    } else {
        navBarLogeado();
        echo '<div class="container"><div class="container">
            <div class="col-md-8 col-md-offset-2">
                
                    <h1>Encuestas:</h1>';
                    formularioBusqueda();
                echo '
            <div class="col-md-10 col-md-offset-1">
        <ul class="list-group">';
        while($result = mysqli_fetch_object($req)){
                echo '<li class="list-group-item "><a class="lead" href="encuesta.php?id='.$result->id.'">'.$result->titulo.'</a><a href="resultado.php?id='.$result->id.'" class="pull-right">Ver Resultados <span class="glyphicon glyphicon-arrow-right"></span></a></li>';
            }
        echo '</ul>
        <a href="agregar.php"><button class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus"></span> Agregar nueva encuesta</button></a>
        </div>
    </div>
    </div>';
    }
    echo '</div>';
    footer();
    finDocumento();
?>