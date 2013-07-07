<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
   

    include "core/user_functions.php";
    
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
    <div id="login" data-role="page">
       
        <div data-role="header">
            <h1>SCAUCAB-G</h1>
            <a href="#opciones" data-role="button" data-mini="true"  data-icon="arrow-l" data-iconpos="left" data-inline="true">Opciones</a>
           
            <a href="#perfil" data-role="button" data-mini="true"  data-icon="arrow-r" data-iconpos="right" data-inline="true">Perfil</a>
        </div>
        
      <div data-role="content">
        
          <div data-role="collapsible" data-collapsed=true data-theme="b" data-content-theme="d">
     <h4> Mis Materias</h4>
    <ul data-role="listview">
        <?php  get_mats_prof($user,"list");?>
    </ul>
</div>
          
          <div data-role="collapsible" data-collapsed=true data-theme="b" data-content-theme="d">
    <h4> Asistencias</h4>
    <ul data-role="listview">
         <li><a href="list_asis.php" rel="external" >Ver fechas</a></li>
    </ul>
</div>
          
          <div data-role="collapsible" data-collapsed="true" data-theme="b" data-content-theme="d">
    <h4>Historico</h4>
    <ul data-role="listview">
        <li><a href="historicos.php">Clases Firmadas</a></li>
        <li><a href="#">Clases No Firmadas</a></li>
        <li><a href="#">Historico de Firmas de clases</a></li>
    </ul>
</div>
          
      </div>
      
        <!-- defaultpanel -->
       <div data-role="panel" id="opciones" data-theme="b">
             
           <div class="panel-content">
               
               
               <div data-role="controlgroup">
                   
                <a href="#user-main-asistencias" data-role="button">Inicio</a>
                <a href="#firmar-clase" data-role="button">Firmar Clase</a>
                <a href="#ver-listado" data-role="button">Ver Listado</a>
                <a href="#notificaciones" data-role="button">Notificaciones</a>
                
               </div>
                
               <a href="#demo-links" data-rel="close" data-role="button" data-theme="c" data-icon="delete" data-inline="true">Cerrar Panel</a>
                
           
           </div><!-- /content wrapper for padding -->
               
       
       </div><!-- /defaultpanel -->

       
         <div data-role="panel" id="perfil" data-display="push" data-position="right" data-theme="c">
             
                
                <?php
                
                get_personal_info($_SESSION['user']);
                
                ?>
       
                
          <a href="#" data-rel="close" data-role="button" data-mini="true" data-inline="true" data-icon="delete" data-iconpos="right">Cerrar</a>
          
         
         </div><!-- /panel -->
         
         
   
<div data-role="footer" data-position="fixed">    

<div data-role="navbar">
   <ul>
      <li><a href="login.html" class="ui-btn-active">Menu1</a></li>
      <li><a href="#">Menu2</a></li>
      <li><a id="btnlogout" href="index.php" rel='external' >Salir</a></li>
    </ul>
</div>

 </div>   
                
    </div>
 
   <div data-role="page" id="notificaciones">

	<div data-role="header">
	 <h1>Notificaciones</h1>
	 <a href="#page" data-role="button" data-mini="true"  data-icon="arrow-l" data-iconpos="left" data-inline="true">Atras</a>
	</div><!-- /header -->

	<div data-role="content">
		<h4> Frecuencia de Notificaciones </h4>
		
        <form>
        <div data-role="fieldcontain">
        <label for="select-native-1">Basic:</label>
        <select name="select-native-1" id="select-native-1">
        <option value="1">Cada hr</option>
        <option value="2">cada 12 hrs</option>
        <option value="3">Cada Dia</option>
        <option value="4">Cada Semana</option>
        </select>
        </div>
        </form>
		
	</div><!-- /content -->

	<div data-role="footer">
    <h4>RIF: J-00012255-5- ©2013 UCAB-Venezuela</h4>
	</div><!-- /footer -->
</div><!-- /page -->
            
            
</body>
</html>


