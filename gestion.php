<?php

require "Clases/Vehiculo.php";
require "Clases/Facturados.php";
require "Clases/Tablas.php";


$patente=$_POST['patente'];
$accion=$_POST['estacionar'];
//$vehiculo= new Vehiculo();

if($accion=="ingreso")
{
	
	Vehiculo::Estacionar($patente);
}
else
{
	Vehiculo::Sacar($patente);

		//var_dump($datos);
}

header("location:index.php");
?>