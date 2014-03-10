<?php
    include 'includes/maquetacion.php';
    include 'includes/bbdd.php';

    require('conexion.php');
    $sql = "SELECT * FROM encuestas ORDER BY id DESC";
    $req = mysql_query($sql);

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
        <h1>Encuestas:</h1>
        <div class="col-md-10 col-md-offset-1">
        <div class="list-group">';
        while($result = mysql_fetch_object($req)){
                echo '<a class="list-group-item lead" href="encuesta.php?id='.$result->id.'">'.$result->titulo.'</a>';
            }
        echo '</div>
        <a href="agregar.php"><button class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus"></span> Agregar nueva encuesta</button></a>
        </div>
        </div>
    </div>
    </div>';
    }
    echo '</div>';
    footer();
    finDocumento();
?>