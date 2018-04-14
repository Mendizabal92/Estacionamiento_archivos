<?php
require"Clases/Vehiculo.php";
require "Clases/Tablas.php";
$path = "gestion.php";

Vehiculo::CrearJSAutocompletar();
Tablas::CrearTablaFacturado();
Tablas::CrearTablaEstacionados();

?>
<!doctype html>
<html lang="en-US">
<head>

  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <title> Archivos </title>

  <link rel="stylesheet" type="text/css" href="css/estilo.css">
  <link rel="stylesheet" type="text/css" href="css/animacion.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/style.css">
 
  <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.autocomplete.min.js"></script>
  <script type="text/javascript" src="js/funcionAutoCompletar.js"></script>
  <script type="text/javascript">

  function MostrarBoton(control)
  {
    if(control.value.length==0)
    {
        $('#botonIngreso').css('display','block');
         $('#outputcontent').html("...");
    }
  }

  </script>
  <!--script type="text/javascript" src="js/currency-autocomplete.js"></script-->
</head>
	<body>
    <div class="CajaUno animated bounceInDown">

            <form action="<?php echo $path; ?>" method="post" >
            <input type="text" onkeydown="MostrarBoton(this)" name="patente" title="formato de patente: AAA 666" id="autocomplete" required pattern="[a-z]{3}[0-9]{3}" />
            <br>
            <input type="submit" id="botonIngreso" class="MiBotonUTN" value="ingreso"  name="estacionar" />
            <br/>
            <input type="submit" class="MiBotonUTNLinea" value="egreso" name="estacionar" />
          </form>

<div id="outputbox">
    <p id="outputcontent">...</p>
  </div>

    </div>
      <div class="CajaEnunciado animated bounceInLeft">
      <h2>autos:</h2>
     

     <?php 

      include("archivos/tablaestacionados.php");

     ?>
      
      
    </div>

     <div class="CajaEnunciadoDerecha animated bounceInLeft">
      <h2>Facturado:</h2>
     

     <?php 

      include("archivos/tablaFacturacion.php");

     ?>
      
      
    </div>
      		
	</body>
</html>