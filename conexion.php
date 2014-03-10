<?php 
// datos para la coneccion a mysql
define('DB_SERVER','localhost');
define('DB_NAME','encuestas');
define('DB_USER','root');
define('DB_PASS','root');
 
$conex = mysql_connect (DB_SERVER,DB_USER,DB_PASS);
mysql_select_db(DB_NAME,$conex);