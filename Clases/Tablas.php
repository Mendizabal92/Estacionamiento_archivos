<?php


class Tablas
{
	

	public static function CrearTablaEstacionados()
	{
		$lista =Vehiculo::Leer();
		$archivo=fopen("archivos/tablaestacionados.php","w");


		$TablaCompleta=" <table border=1><th> patente </th><th> Ingreso</th>";
		$renglon="";
		
		foreach ($lista as $auto) 
		{
			$renglon= $renglon."<tr> <td> ".$auto[0] ." </td> <td> ". $auto[1]."</td> </tr>" ; 
		
  		}
		$TablaCompleta =$TablaCompleta.$renglon." </table>";

			fwrite($archivo, $TablaCompleta);

	}

		public static function CrearTablaFacturado()
		{
			if(file_exists("archivos/facturacion.txt"))
			{
				$cadena=" <table border=1><th> patente </th><th> Importe </th>";

				$archivo=fopen("archivos/facturacion.txt", "r");

			    while(!feof($archivo))
			    {
				      $archAux=fgets($archivo);
				      //http://www.w3schools.com/php/func_filesystem_fgets.asp
				      $auto=explode("=>",$archAux);
				      //http://www.w3schools.com/php/func_string_explode.asp
				      $auto[0]=trim($auto[0]);
				      if($auto[0]!="")
				       $cadena =$cadena."<tr> <td> ".$auto[0]."</td> <td>  ".$auto[1] ."</td> </tr>" ; 
				}

		   		$cadena =$cadena." </table>";
		    	fclose($archivo);

				$archivo=fopen("archivos/tablaFacturacion.php", "w");
				fwrite($archivo, $cadena);




			}	else
			{
				$cadena= "no hay facturación";

				$archivo=fopen("archivos/tablaFacturacion.php", "w");
				fwrite($archivo, $cadena);
			}

		}





		


}

?>