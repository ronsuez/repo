<?php

 define( "DB_SERVER",    getenv('OPENSHIFT_POSTGRESQL_DB_HOST') );
 
  define( "DB_PORT",    getenv('OPENSHIFT_POSTGRESQL_DB_PORT') );
  
 define( "DB_USER",      getenv('OPENSHIFT_POSTGRESQL_DB_USERNAME') );
 
 define( "DB_PASSWORD",  getenv('OPENSHIFT_POSTGRESQL_DB_PASSWORD') );
 
 define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );
 
 
 define( "CUSTOM_DATABASE", "scaucabg1.0");


function connect_db(){
 
     $host=DB_SERVER;
    
     $port=DB_PORT;
       
     $db=CUSTOM_DATABASE;
       
     $user=DB_USER;
        
     $pass=DB_PASSWORD;
        
      
     $dbconn = pg_connect("host=$host
                    port=$port  dbname=$db
                    user=$user password=$pass") or die(pg_last_error());

  return $dbconn;


}




function disconnect_db($dbconn){

	pg_close($dbconn);


}



function get_usuario(){
    
    
     $dbconn=connect_db();

    $pgquery="SELECT * FROM usuario";
    
    
	 $result=pg_query($pgquery);    



	 disconnect_db($dbconn);
         
         
         return pg_fetch_row($result);
         
    
}




function get_nro_them_week($carrera , $materia){

	$dbconn=connect_db();

	$pgquery="SELECT MAX(cronograma.id_tema) AS nro_tema ,
	MAX(cronograma.semana) AS nro_semana 

	FROM cronograma

	WHERE cronograma.id_carrera='$carrera' AND

	      cronograma.id_materia='$materia';";

	 $result=pg_query($pgquery);    



	 disconnect_db($dbconn);


	   return pg_fetch_row($result);

	
}



function get_nro_sub_them($carrera , $materia , $tema){

	$dbconn=connect_db();

	$pgquery="SELECT MAX(R1.id_tema) AS nro_tema ,MAX(R1.id_subtema) AS nro_sub_tema 

					FROM crono_sub_tema AS R1

					WHERE R1.id_carrera='$carrera' AND

					      R1.id_materia='$materia' AND

					      R1.id_tema ='$tema';";

	 $result=pg_query($pgquery);    


	 disconnect_db($dbconn);


	   return pg_fetch_row($result);

	
}


?>