<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function connect_db(){
 

      
     $dbconn = pg_connect("host=localhost
                    port=5432  dbname=scaucabg
                    user=admin password=admin") or die(pg_last_error());

  return $dbconn;


}

function disconnect_db($dbconn){

	pg_close($dbconn);


}

?>
