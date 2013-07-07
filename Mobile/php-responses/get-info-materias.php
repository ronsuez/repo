
<?php

function get_info_materias($id_materia){
    
    
    
    $dbconn= connect_db();
    
    $pg_sql="SELECT * FROM materias WHERE id_materia = '$id_materia' ;  ";
  
    $query_result = pg_query($dbconn,$pg_sql) or die(pg_last_error());
      
	disconnect_db($dbconn);
  

	if(pg_num_rows($query_result)>0){

		 while($result=pg_fetch_array($query_result)){

			echo "

                                  <label> Id_Materia: $result[id_materia]</label><br>
                                  <label> Id_Carrera: $result[id_carrera]</label><br>
                                  <label> Descripcion: $result[descripcion]</label><br>
                                  <label> UC: $result[uc]</label><br>
                                  <label> Semestre: $result[semestre]</label><br>    
                                 <label> Prof_Asoc: $result[prof_asoc]</label><br>
                            ";     // name class and mark will be printed with one line break

			}

		  	}else{


			echo " Sin resultados ";     // name class and mark will be printed with one line break

  			} 
}

?>