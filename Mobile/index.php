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
        
        
    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["error"]) ){
    
        $error="<h2>Usuario o contrasena no validos</h2>";
        
    }else{
        
        $error="";
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
    
    
    
    <div data-role="page" id="login">
            
                <div data-role="header">
                <h1>Inicio de Sesion</h1>
                </div><!-- /header -->
            
                <div data-role="content">
                 <center><Img src=img/logo.png></center><br>

            <form id="login" method="POST" action="php-responses/login.php" data-ajax="false">
                
                    <label for="email">Correo Ucab</label>
                    <input type="email" data-clear-btn="true" name="email" id="email" val="" required>
                    
                    <label for="password">Contraseña</label>
                    <input type="password" data-clear-btn="true" name="password" id="password" val="" autocomplete="off" required>
                   
                     <input  type="submit" value="Enviar" />
           
            </form>
                   
                 
                    <?php echo $error;?>
                
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