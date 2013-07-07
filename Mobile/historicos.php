<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);


    include "core/phphistoricos.php";

    include "core/user_functions.php";
    
    include "core/system_functions.php";
    
    session_start();
    
   if(!isset($_SESSION["user"])){
        
        header("location:index.php");   
        
    
    
    }else{
        
        $user=$_SESSION["user"];
        
    }
    
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <title> Control de Asistencias </title>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css"/>
    
    <link rel="stylesheet" href="css/css/table.css"/>
    
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
   
    <script src="js/functions.js"></script>
    
    <!-- estilo para el panel de cada pagina -->
    <style>
        
        
        .panel-content { padding:15px; }	
    

    img {
    max-width: 100%; 
    max-height: 100%;
        }
  
        h4 {
            
            max-height:100%;
            max-width:100%;
        }
        
        article{
            display: block;
            width: 100%;
        }
    
    </style>
    
</head>
<body>
    <div id="datos_materia" data-role="page">
       
        <div data-role="header">
           <h1> Historico de asistencias</h1>
            <a href="main-menu.php" data-role="button" data-mini="true"  data-icon="arrow-l" data-iconpos="left" data-inline="true">Atras</a>
        </div>
        
      <div data-role="content">
        
         <ul data-role="listview" data-inset="true">
             <?php  
                
                //$usuario=get_id($user);
                
               
               get_asistencia($user);
             
             ?>
         </ul> 

      </div>
         
   
<div data-role="footer" data-position="fixed">    

<div data-role="navbar">
   <ul>
      <li><a href="#" class="ui-btn-active">Menu1</a></li>
      <li><a href="main-menu.php" rel="external">Menu principal </a></li>
      <li><a id="btnlogout" href="index.php" rel='external'>Salir</a></li>
    </ul>
</div>

 </div>   
                
    </div>
     
</body>
</html>