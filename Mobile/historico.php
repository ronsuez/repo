<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/*mostrar errores*/
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

  if(isset($_SESSION["user"])){
            
      session_unset();
      
      session_destroy();
            
        }
  

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
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
        
        .ui-page {
        background: transparent url(img/catolica.png);  
        background-size: 100% 100%;  -moz-background-size: 100% 100%;
        
        }
    
    </style>
    
    
</head>
<body>    
    
    
    
    <div data-role="page" id="historico">
            
                <div data-role="header">
                <h1>Inicio de Sesion</h1>
                </div><!-- /header -->
            
                <div data-role="content">
             
                        <?php echo $_GET["id"];?>
                    
                </div><!-- /content -->
            
                
                <div data-role="footer" data-position="fixed">
                <h4>RIF: J-00012255-5- ©2013 UCAB-Venezuela</h4>
                </div><!-- /footer -->
         
            
    
    </div><!-- /page -->
         
                 <!-- Aqui nuestro dialog con el mensaje de error  -->
             <section id="pageError" data-role="dialog">
                 <header data-role="header">
                     <h1>Error</h1>
                 </header>
                 <article data-role="content">
                     <p>Usuario o contraseña no valida</p>
                     <a href="index.php" data-role="button" data-ajax="false" >Aceptar</a>
                 </article>
             </section>
            
</body>
</html>