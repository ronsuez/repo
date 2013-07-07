<?php


    require_once '../db/db.php';
    
function get_asistencia($id_user){
    
   
    $mats=get_mats_prof($id_user,"id_materia");
    
   
   $dbconn= connect_db();
    
    $pg_sql="SELECT   fecha,descripcion,seccion,observaciones,asistencia,dia,seccion
        
            FROM
        
                clase,cronograma,temas_x_crono
                
                WHERE cronograma.id_materia=$mats[0] AND
                    temas_x_crono.id_cronograma=cronograma.id_cronograma AND 
                    clase.id_tema=temas_x_crono.id_tema AND
                    clase.id_cronograma=cronograma.id_cronograma  ORDER BY fecha DESC";
  
    $query_result = pg_query($dbconn,$pg_sql) or die(pg_last_error());
      
	disconnect_db($dbconn);
  

	if(pg_num_rows($query_result)>0){

		 while($result=pg_fetch_array($query_result)){

                     
			echo '
                            <li data-role="list-divider"> Clase del dia :'.$result['fecha'].'</li>
                            <li><a a href="#">
                            <h2>'.$result['descripcion'].'</h2>
                            <p><strong> dia : '.$result['dia'].' , seccion :'.$result['seccion'].'</strong></p>
                            <p>Observaciones : '.$result['observaciones'].'</p>
                            <p class="ui-li-aside"><strong>'.$result['asistencia'].'</strong></p>
                            </a></li> ' ;   

			}

		  	}else{


			echo " Sin resultados ";     // name class and mark will be printed with one line break

  			} 
}



?>