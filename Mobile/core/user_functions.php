<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


require_once("./db/db.php");

function trim_value($value) {
    $value = trim($value);

    return $value;
}


function listar_temas($array){
    
    for($i=0;$i<count($array);$i++){

        if(($i+1)== count($array)){
            
            echo $array[$i].".";
        
        }else{
            
            echo $array[$i].", ";
        }
    }
    
}

function get_semana($month, $day) {

    $month = substr($month, 0, 7);

    $dbconn = connect_db();

    $pg_sql = "SELECT semana,fecha_ini,fecha_fin FROM sem_x_periodo;  ";

    $query_result = pg_query($dbconn, $pg_sql) or die(pg_last_error());

    $r="";
    
    while ($result = pg_fetch_array($query_result)) {

        $fecha_ran = substr($result['fecha_ini'], -10, 7);


        if (strcmp(trim_value($month), trim_value($fecha_ran)) == 0) {


            $fecha_ran = substr($result['fecha_ini'], -10, 7);

            $min = substr($result['fecha_ini'], -2);

            $max = substr($result['fecha_fin'], -2);


            if (($min <= $day) && ($day <= $max)) {

                $r = $result['semana'];
            }
        }
    }

    return $r;

    disconnect_db($dbconn);
}

function get_personal_info($user) {


    $dbconn = connect_db();

    $pg_sql = "SELECT * FROM profesor,usuario 
        
            WHERE usuario.id_usuario =id_profesor AND usuario.email = '$user' ;  ";


    $query_result = pg_query($dbconn, $pg_sql) or die(pg_last_error());



    disconnect_db($dbconn);


    if (pg_num_rows($query_result) > 0) {

        while ($result = pg_fetch_array($query_result)) {

            echo "

                                  <label>Nombre: $result[nombre]</label><br>
                                  <label>Apellido: $result[apellido]</label><br>
                                   <label>Cedula: $result[ci]</label><br>
                                   <label>Cargo: $result[especialidad]</label><br>
                
                                 
                            ";     // name class and mark will be printed with one line break
        }
    } else {


        echo " Sin resultados ";     // name class and mark will be printed with one line break
    }
}

function get_id($user) {


    $dbconn = connect_db();

    $pg_sql = "SELECT id_usuario FROM usuario WHERE  email='$user'; ";


    $result = pg_query($dbconn, $pg_sql) or die(pg_last_error());



    return pg_fetch_array($result);
}

function get_info_materia($materia,$value) {

    $dbconn = connect_db();

          if($value=="id_materia"){
              
                  $pg_sql = "SELECT $value FROM materia WHERE   descripcion='$materia'; ";

              
          }else if($value=="descripcion"){
              
                  $pg_sql = "SELECT $value FROM materia WHERE   id_materia=$materia; ";

          }
     

    $result = pg_query($dbconn, $pg_sql) or die(pg_last_error());

    return pg_fetch_array($result);
}

function get_num_mats($user) {


    $pg_sql = " SELECT COUNT(id_materia) from materia,usuario

                 WHERE email='$user' AND prof_asoc=id_usuario;";

    $dbconn = connect_db();

    $query_result = pg_query($dbconn, $pg_sql) or die(pg_last_error());

    disconnect_db($dbconn);


    $result = pg_fetch_row($query_result);

    return $result[0];
}

function get_mats_prof($user,$option) {


        $materias= array();
        
    $pg_sql = " SELECT materia.id_materia,descripcion 
         
                    FROM prof_x_materia,materia,usuario
         
                    WHERE
                        email='$user' AND 
                        id_profesor=id_usuario AND
                        materia.id_materia=prof_x_materia.id_materia;";

    $dbconn = connect_db();

    $query_result = pg_query($dbconn, $pg_sql) or die(pg_last_error());

    disconnect_db($dbconn);


    if (pg_num_rows($query_result) > 0) {

        while ($result = pg_fetch_array($query_result)) {
            
            if(!strcmp($option,"list")){
                
                echo "<li><a rel='external' href='datos_materia.php?id=" . $result['id_materia'] . "'>" . $result['descripcion'] . "</a></li> ";
        
            
            }else{
                
                array_push($materias, $result['id_materia']);
            }
            
            
            }
    } else {


        echo " Sin resultados ";     // name class and mark will be printed with one line break
    }

    return $materias;
}

function get_temas_semana($materia,$semana) {

    $temas = array();
    $id_temas=array();
    
    $query = "SELECT    id_tema,descripcion 
                            FROM 
                           cronograma AS R1 , temas_x_crono AS TM 
                           
                                  WHERE R1.id_materia='$materia' AND 
                                  TM.id_cronograma=R1.id_cronograma AND
                                  $semana BETWEEN TM.semana_inicio AND TM.semana_fin 
				 ORDER BY id_tema ASC; ";

    $dbconn = connect_db();

    $query_result = pg_query($dbconn, $query) or die(pg_last_error());

    disconnect_db($dbconn);

    if (pg_num_rows($query_result) > 0) {
        
        $i=0;
           
            while($result = pg_fetch_array($query_result)) {
                
                    $temas[$i]=$result['descripcion'];
                    $id_temas[$i]=$result['id_tema'];
                     $i++;
                     
                     
            }
        
    }else{

     $state=-1;  
     
     return array($temas,$id_temas,$state);
     
    }
    $state=0;
    
   return array($temas,$id_temas,$state);
   
}

function get_contenido_tema($materia,$id_tema,$semana){
    
    $pg_query="SELECT sub_temas
                FROM tema,cronograma,materia
                WHERE 
                        cronograma.id_materia=$materia AND
                        id_tema=$id_tema AND semana=$semana;";
            
    $dbconn = connect_db();

    $query_result = pg_query($dbconn, $pg_query) or die(pg_last_error());

    disconnect_db($dbconn);

       return pg_fetch_row($query_result);
       
                     
    
}


function obtain_horario($user) {

     $date_month = date('Y-m', strtotime('+3 Days')) . "<br>";

    $date = date('d') . "<br>";

    $semana=get_semana(trim_value($date_month),$date);


    $id_user = get_id($user);

    $pg_sql = "SELECT Mat.descripcion,H.id_materia, 
                
                     H.seccion,H.dia, H.seccion, H.salon,H.hora


                        FROM prof_x_materia AS M,
                             horario AS H, materia AS Mat

                      WHERE  

                      M.id_profesor=$id_user[id_usuario] AND
                     H.id_carrera = M.id_carrera AND
                     H.id_materia = M.id_materia AND
                     Mat.id_materia=M.id_materia 
                     
                       ORDER BY  (case when H.dia = 'Lunes' then 1
                                       when H.dia = 'Martes' then 2
                                       when H.dia = 'Miercoles' then 3
                                       when H.dia = 'Jueves' then 4
                                       when H.dia = 'Viernes' then 5
                                   
                               end) , H.hora;";

    $dbconn = connect_db();

    $query_result = pg_query($dbconn, $pg_sql) or die(pg_last_error());

    disconnect_db($dbconn);



    $i = 0;

    while ($result = pg_fetch_array($query_result)) {

        $materias[$i] = $result['descripcion'];

        $dias[$i] = $result['dia'];

        $salones[$i] = $result['salon'];

        $secciones[$i] = $result['seccion'];

        $horas[$i] = $result['hora'];

        $i++;
    }


    array_walk($dias, 'trim_value');

    $cuenta = pg_num_rows($query_result);


    //escribimos la primera fila
    
    $id_materia = get_info_materia($materias[0],"id_materia");
    
    $ab_date=  maketime($dias[0]);
    
    $ab_date_format=$ab_date['dia_num']."-0".$ab_date['mes_num']."-".$ab_date['ano'];
    
    //obtenemos los temas para la semana en cuestion
   
         echo "<label> Semana " .$semana."</label><br>";

                 $count=0;
                 do{
                      
                     
                    $semana=$semana-$count;
                 
                     list($temas,$id_temas,$state)=get_temas_semana($id_materia["id_materia"], $semana);
    
                        
                     $count++;
                     
                 }while($state==-1);
                 
                
     $fc=maketime($dias[0]);
     
     $fc_format=$fc['dia'].",".$fc['dia_num']." de ".$fc['mes']." del ".$fc['ano'];
                
    echo "<li data-role='list-divider'>" . $fc_format .
    "<span class='ui-li-count'>2</span></li>";
  
    echo "  <li><a href='firmar.php?mat=$id_materia[id_materia]&sec=$secciones[0]&sem=$semana&fec=$ab_date_format' data-ajax=\"false\" > " .
    "<h2>$materias[0]</h2>";

    echo " <p>Salon : <strong>$salones[0]</strong></p>";

    echo "<p>Seccion :<strong> $secciones[0]</strong></p>";

    echo "<p class='ui-li-aside'><strong>$horas[0]</strong></p>";

        
    echo "Temas : " ;
                 listar_temas($temas);

    echo "</a></li>";

    //luego las demas      
    for ($j = 1; $j < $cuenta; $j++) {
        
          $id_materia = get_info_materia($materias[$j],"id_materia");
             
          $ab_date=  maketime($dias[$j]);
           
          $ab_date_format=$ab_date['dia_num']."-0".$ab_date['mes_num']."-".$ab_date['ano'];
    
        if ($dias[$j] == $dias[$j - 1]) {
            
           
            echo "  <li><a href='firmar.php?mat=$id_materia[id_materia]&sec=$secciones[$j]&sem=$semana&fec=$ab_date_format' data-ajax=\"false\" > " .
            "<h2>$materias[$j]</h2>";

            echo " <p>Salon: <strong>$salones[$j]</strong></p>";

            echo "<p>Seccion :$secciones[$j]</p>";

            echo "<p class='ui-li-aside'><strong>$horas[$j]</strong></p>";

            echo "Temas : " ;
            
             
                 listar_temas($temas);

            echo "</a></li>";

            $j++;
        } else {

             $fc=maketime($dias[$j]);
                
             $fc_format=$fc['dia'].",".$fc['dia_num']." de ".$fc['mes']." del ".$fc['ano'];
                
             $ab_date_format=$ab_date['dia_num']."-0".$ab_date['mes_num']."-".$ab_date['ano'];
    
                
            echo "<li data-role='list-divider'>" .$fc_format .
            "<span class='ui-li-count'>2</span></li>";


            echo "  <li><a href='firmar.php?mat=$id_materia[id_materia]&sec=$secciones[$j]&sem=$semana&fec=$ab_date_format' data-ajax=\"false\" >  " .
            "<h2>$materias[$j]</h2>";

            echo " <p>Salon :<strong>$salones[$j]</strong></p>";

            echo "<p>Seccion :<strong>$secciones[$j]</strong></p>";

            echo "<p class='ui-li-aside'><strong>$horas[$j]</strong></p>";

            $id_materia = get_info_materia($materias[$j],"id_materia");

            echo "Temas : " ;
                  listar_temas($temas);

            echo "</a></li>";
        }
    }


 
}

?>
