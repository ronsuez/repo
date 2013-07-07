<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

  include "./db/db.php";

$_POST["estado"];

$_POST["semana"];

$_POST["materia"];
$_POST["fecha"];

    function validar_clase(){
        
        
        
    }
    
    function firmar_asistencia(){
        

             echo $_POST["estado"];

             echo  $_POST["semana"];

             echo $_POST["materia"];
           
             echo  $_POST["fecha"];

             echo  $_POST["obv"];
             
              $url='http://' .$_SERVER['HTTP_HOST'].'/app/Mobile';
        
            header("location:  $url/historico.php?id=1");
            
        
    }
    
    if(!strcmp($_POST["funcion"],"firmar_asistencia")){
        
        firmar_asistencia();
        
    }
    
    

 ?>
