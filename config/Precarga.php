<?php
// Unix
setlocale(LC_TIME, 'es_ES.UTF-8');
// En windows
setlocale(LC_TIME, 'spanish');
require_once $ruta.'config/AccessoBase.php';
$acceso=new AccesoBase("prueba");
$bd=$acceso->getConexion();
?>