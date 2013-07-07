<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);



function redirect_user ($page = 'index.php')
{
	# Start defining the URL...
	# URL is http:// plus the host name plus the current directory:
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

	# Remove any trailing slashes:
	$url = rtrim($url, '/\\');

	# Add the page:
	 $url .= '/' . $page;

	# Redirect the user:
	header("Location: $url");
	
        exit( );
        
        //return $url;
        
} # End of redirect_user( ) function.



    

 function fecha_actual($FechaStamp)
{ 
  $ano = date('Y',$FechaStamp);
  $mes = date('n',$FechaStamp);
  $dia = date('d',$FechaStamp);
  $diasemana = date('w',$FechaStamp);
 
  $diassemanaN= array("Domingo","Lunes","Martes","Miércoles",
                      "Jueves","Viernes","Sábado"); 
  
  $mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
                 "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    
  return array($diassemanaN[$diasemana],$dia,$mesesN[$mes],$mes,$ano);
}



 function ob_day_number($var){
     
     	setlocale(LC_TIME, 'es_VE');
	date_default_timezone_set('America/Caracas');
        
        
        //comprobamos si el dia corresponde al dia actual
         
 $fecha = time();
 

    $fecha_actual=fecha_actual($fecha);
 
  
            if(!strcmp($fecha_actual[0],$var)){
                
             
            return array(
               "dia"  => $var,
               "dia_num" => $fecha_actual[1],
               "mes"  => $fecha_actual[2],
               "mes_num" => $fecha_actual[3],
               "ano" => $fecha_actual[4],
             
            );
         
            }
            

          
        $abrv="d";
             

     switch ($var) {
        
         case  'Lunes' :
        // do some stuff
             
             $date= date($abrv, strtotime('next Monday'));
             
          break;
      
          
         case 'Martes':
        // do some stuff
             
          $date= date($abrv, strtotime('next Tuesday'));
             
        break;
    
         case 'Miercoles' :
        // do some stuff
             
             $date=date($abrv, strtotime('next Wednesday'));
             
        break;
        
    
         case 'Jueves':
        // do some stuff
             
               $date=date($abrv, strtotime('next Thursday'));
             
        break;
    
         case 'Viernes' :
        // do some stuff
             
              $date= date($abrv, strtotime('next Friday'));
             
        break;
        
        
         }
         
            ///retorna la fecha del dia , el mes, el numero del mes, el anio
         return array(
               "dia"  => $var,
               "dia_num" =>$date,
               "mes"  => $fecha_actual[2],
               "mes_num" => $fecha_actual[3],
               "ano" => $fecha_actual[4],
             
            );
         
 }
        

    
    function maketime($day){
        

            return  ob_day_number($day);

             
    }

 
 
//Para utilizar la función, se le manda una fecha como parámetro, por ejemplo, si se quisiera imprimir la fecha actual, utilizaríamos el siguiente código:

?>
