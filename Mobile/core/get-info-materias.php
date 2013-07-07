
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
    include "./db/db.php";
    session_start();
    if(!isset($_SESSION["user"])){
    header("location:index.php");   

        }


?>



<?php

function get_info_materias($id_materia){
    
    
    
    $dbconn= connect_db();
    
    $pg_sql="SELECT * FROM materia WHERE id_materia = '$id_materia' ;  ";
  
    $query_result = pg_query($dbconn,$pg_sql) or die(pg_last_error());
      
	disconnect_db($dbconn);
  

	if(pg_num_rows($query_result)>0){

		 while($result=pg_fetch_array($query_result)){

                     
			echo "
                    
                            <center><h4> Datos de la Materia</h4></center>
                                  <li>Id_Materia: $result[id_materia]</li>
                                  <li> Id_Carrera: $result[id_carrera]</li>
                                  <li> Descripcion: $result[descripcion]</li>
                                  <li> UC: $result[uc]</li>
                                  <li> Semestre: $result[semestre]</li>    
                            ";     // name class and mark will be printed with one line break

			}

		  	}else{


			echo " Sin resultados ";     // name class and mark will be printed with one line break

  			} 
}

function get_info_temas_materia($id_materia){
    
    
    
    $dbconn= connect_db();
    
    $pg_sql="SELECT id_tema,descripcion,(semana_fin-semana_inicio)as duracion
             FROM cronograma AS R1, temas_x_crono AS TM
             WHERE R1.id_materia='$id_materia' AND
             TM.id_cronograma=R1.id_cronograma
             ORDER BY id_tema ASC;";
  
    $query_result = pg_query($dbconn,$pg_sql) or die(pg_last_error());
      
	disconnect_db($dbconn);
  

	if(pg_num_rows($query_result)>0){

		 while($result=pg_fetch_array($query_result)){

                     
			echo "
                            <li>$result[id_tema]   $result[descripcion] $result[duracion] </li>
                            ";     // name class and mark will be printed with one line break

			}

		  	}else{


			echo " Sin resultados ";     // name class and mark will be printed with one line break

  			} 
}


function get_info_temas_materia_1($id_materia){
    
    
    
    $dbconn= connect_db();
    
    $pg_sql="SELECT id_tema,descripcion,(semana_fin-semana_inicio)+1 as duracion
             FROM cronograma AS R1, temas_x_crono AS TM
             WHERE R1.id_materia='$id_materia' AND
             TM.id_cronograma=R1.id_cronograma
             ORDER BY id_tema ASC;";
  
    $query_result = pg_query($dbconn,$pg_sql) or die(pg_last_error());
      
	disconnect_db($dbconn);
  

	if(pg_num_rows($query_result)>0){

		 while($result=pg_fetch_array($query_result)){

                     
			echo "
                            <tr>
                            <td>$result[id_tema]</td>
                            <td>$result[descripcion]</td>
                            <td>$result[duracion]</td>
                            </tr>
                            ";     // name class and mark will be printed with one line break

			}

		  	}else{


			echo " Sin resultados ";     // name class and mark will be printed with one line break

  			} 
}


function get_descripcion_materia($id_materia) {
    
    
    
    $dbconn= connect_db();
    
    $pg_sql="SELECT descripcion FROM materia 
             WHERE id_materia='$id_materia';";
  
    $query_result = pg_query($dbconn,$pg_sql) or die(pg_last_error());
      
	disconnect_db($dbconn);
  

	if(pg_num_rows($query_result)>0){

		 while($result=pg_fetch_array($query_result)){

                     
			echo "
                            <tr>
                            <th>$result[descripcion]</th>
                            </tr>
                            ";     // name class and mark will be printed with one line break

			}

		  	}else{


			echo " Sin resultados ";     // name class and mark will be printed with one line break

  			} 
    
    
    
}

?>
