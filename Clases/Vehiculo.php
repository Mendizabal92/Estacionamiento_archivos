<?php

class Vehiculo
{
	private $patente;
	private	$horaIngreso;
	
	function __construct($pat,$hIng=null)
	{
		$this->patente=$pat;
		$this->horaIngreso=$hIng;
	}


	public function GetPatente()
	{
		return $this->patente;
	} 
		
		/*public function ToString()
		{
			return $this->patente."=>".$this->$horaIngreso."\n";
		}*/

		public static function Estacionar($patente)
		{
			$resultado= FALSE;
			$archivo=fopen("archivos/estacionados.txt", "a");//escribe y mantiene la informacion existente
			$ahora=date("Y-m-d H:i:s"); 		
			$renglon=$patente."=>".$ahora."\n";
			$cant=fwrite($archivo,$renglon);//$this->GetPatente()."=>".$this->horaIngreso."\n";
			//fwrite($archivo, $renglon); 
			if ($cant > 0) 
			{
				$resultado= TRUE;			 	
			 }
			 		fclose($archivo);		 
			
			 return $resultado;
		}

	public static function Sacar($patente)
	{

		$listado=Vehiculo::Leer();
		$ListadoAdentro=array();
		$estaElVehiculo=false;
		foreach ($listado as $auto) 
		{
			if($auto[0]==$patente)
			{
				$estaElVehiculo=true;
				$inicio=$auto[1];	
				$ahora=date("Y-m-d H:i:s"); 			 
 				$diferencia = strtotime($ahora)- strtotime($inicio) ;
 				//http://www.w3schools.com/php/func_date_strtotime.asp
 				$importe=$diferencia*15;
				$mensaje= "tiempo transcurrido:".$diferencia." segundos <br> costo $importe ";
				
				$archivo=fopen("archivos/facturacion.txt", "a"); 		  
		 		$dato=$patente ."=> $".$importe."\n" ;
		 		fwrite($archivo, $dato);
		 		fclose($archivo);


			}
			else
			{
				$ListadoAdentro[]=$auto;				
			}
		}// fin del foreach

		if(!$estaElVehiculo)
		{
			$mensaje= "no esta esa patente!!!";
		}


		Vehiculo::GuardarTodos($ListadoAdentro);


		echo $mensaje;
		return $importe;
	}

		public static function TraerTodos()
		{
			$ListaDeAutosLeida=array();

			$archivo=fopen("archivos/estacionados.txt", "r");

			while (!feof( $archivo)) 
			{
				$arcAux=fgets($archivo);
				$autos=explode("=>", $archivo);
				$autos[0]=trim($autos[0]);

				if ($autos[0] !="") {
					
					$ListaDeAutosLeida[]=new Vehiculo($autos[0], $autos[1]);
				}
			}
				fclose($archivo);
			return $ListaDeAutosLeida;
		}

	public static function Leer()
	{
		$ListaDeAutosLeida=   array();
		$archivo=fopen("archivos/estacionados.txt", "r");//escribe y mantiene la informacion existente

			
		while(!feof($archivo))
		{
			$renglon=fgets($archivo);
			//http://www.w3schools.com/php/func_filesystem_fgets.asp
			$auto=explode("=>", $renglon);
			//http://www.w3schools.com/php/func_string_explode.asp
			$auto[0]=trim($auto[0]);
			if($auto[0]!="")
				$ListaDeAutosLeida[]=$auto;
		}

		fclose($archivo);
		return $ListaDeAutosLeida;
		

	}

		public static function CrearJSAutocompletar()
		{		
			$cadena="";

			$archivo=fopen("archivos/estacionados.txt", "r");

		    while(!feof($archivo))
		    {
			      $archAux=fgets($archivo);
			      //http://www.w3schools.com/php/func_filesystem_fgets.asp
			      $auto=explode("=>",$archAux);
			      //http://www.w3schools.com/php/func_string_explode.asp
			      $auto[0]=trim($auto[0]);

			      if($auto[0]!="")
			      {
			      	 $auto[1]=trim($auto[1]);
			      $cadena=$cadena." {value: \"".$auto[0]."\" , data: \" ".$auto[1]." \" }, \n"; 
		 


			      }
			}
		    fclose($archivo);

			 $archivoJS="$(function(){
			  var patentes = [ \n\r
			  ". $cadena."
			   
			  ];
			  
			  // setup autocomplete function pulling from patentes[] array
			  $('#autocomplete').autocomplete({
			    lookup: patentes,
			    onSelect: function (suggestion) {
			      var thehtml = '<strong>patente: </strong> ' + suggestion.value + ' <br> <strong>ingreso: </strong> ' + suggestion.data;
			      $('#outputcontent').html(thehtml);
			         $('#botonIngreso').css('display','none');
      						console.log('aca llego');
			    }
			  });
			  

			});";
			
			$archivo=fopen("js/funcionAutoCompletar.js", "w");
			fwrite($archivo, $archivoJS);
		}


	public static function GuardarTodos($listado)
	{
		$archivo=fopen("archivos/estacionados.txt", "w"); 	

		foreach ($listado as $auto) 
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