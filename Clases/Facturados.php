<?php

class Facturados
{
	private $vehiculo;
	private $horaSalida;
	private $importe;
	
	function __construct($vec,$hrSalida)
	{
		$this->vehiculo=$vec;
		$this->horaSalida=$hrSalida;
	}

		public static function TraerTodos()
		{
			$ListaDeFacturacion=array();

			$archivo=fopen("archivos/estacionados.txt", "r");

			while (!feof( $archivo)) 
			{
				$arcAux=fgets($archivo);
				$autos=explode("=>", $archivo);
				$autos[0]=trim($autos[0]);

				if ($autos[0]!="") {
					
					$ListaDeFacturacion[]=new Vehiculo($autos[0],$autos[1]);
				}
			}
				fclose($archivo);
			return $ListaDeFacturacion;
		}
			

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

		public static function GuardarTodos($listadoFac)
		{
			$archivo=fopen("archivos/estacionados.txt", "w"); 	

			foreach ($listadoFac as $auto) 
			{
		 		  if($auto[0]!=""){
		 		  		$dato=$auto[0] ."=>".$auto[1]."\n" ;
						fwrite($archivo, $dato);
						
		 		  }	
		 		  return true; 	
			}
			fclose($archivo);
			return false;
		}




}




?>