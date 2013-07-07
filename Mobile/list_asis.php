<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

    include "core/user_functions.php";
    
    include "core/system_functions.php";
    
    session_start();
    if(!isset($_SESSION["user"])){
        
    header("location:index.php");   
      
    
    }
        
 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <title> Control de Asistencias </title>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css"/>
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
    
<div data-role="page" id="list_asis">
            
               <div data-role="header">
            <h1>SCAUCAB-G</h1>
            <a href="#opciones" data-role="button" data-mini="true"  data-icon="arrow-l" data-iconpos="left" data-inline="true">Opciones</a>
           
            <a href="#perfil" data-role="button" data-mini="true"  data-icon="arrow-r" data-iconpos="right" data-inline="true">Perfil</a>
        </div>
        
      <div data-role="content">

          <ul data-role="listview" data-inset="true"> <?php obtain_horario($_SESSION['user']);?> </ul>
          
      </div>
     
    
        <!-- opciones -->
       <div data-role="panel" id="opciones" data-theme="b">
             
           <div class="panel-content">
               
               
               <div data-role="controlgroup">
                   
                <a href="#user-main-asistencias" data-role="button">Inicio</a>
                <a href="#firmar-clase" data-role="button">Firmar Clase</a>
                <a href="#ver-listado" data-role="button">Ver Listado</a>
                <a href="#" data-role="button">Ver por fecha</a>
                
               </div>
                
               <a href="#demo-links" data-rel="close" data-role="button" data-theme="c" data-icon="delete" data-inline="true">Cerrar Panel</a>
                
           
           </div><!-- /content wrapper for padding -->
               
       
       </div><!-- /defaultpanel -->

       
       
       
         <div data-role="panel" id="perfil" data-display="push" data-position="right" data-theme="c">
             
                
                <?php get_personal_info($_SESSION['user']); ?>
                 <a href="#" data-rel="close" data-role="button" data-mini="true" data-inline="true" data-icon="delete" data-iconpos="right">Cerrar</a>
          
         
         </div><!-- /panel -->
         
         

        <div data-role="footer" data-position="fixed">    

        <div data-role="navbar">
           <ul>
              <li><a href="login.html" class="ui-btn-active">Menu1</a></li>
              <li><a href="main-menu.php" data-ajax="false"  >Menu principal</a></li>
              <li><a id="btnlogout" data-ajax="false"  >Salir</a></li>
            </ul>
        </div>

         </div>   

            
    
    </div><!-- /page -->
    
    
</body>
</html>

