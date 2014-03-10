<?php
// datos para la coneccion a mysql
define('DB_SERVER', 'localhost');
define('DB_NAME', 'encuestas');
define('DB_USER', 'root');
define('DB_PASS', 'root');

$conex = mysql_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Error en la conexión con la base de datos");