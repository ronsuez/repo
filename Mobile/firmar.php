<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "core/user_functions.php";

include "core/system_functions.php";

session_start();
if (!isset($_SESSION["user"])) {

    header("location:index.php");
}

    $materia= get_info_materia($_GET["mat"],"descripcion");
    
    	setlocale(LC_TIME, 'es_ES');
	date_default_timezone_set('America/Caracas');


    $current_date = date("F j, Y, g:i a"); 
     

        $semana=$_GET['sem'];
        
        $dat_cmp=strcmp(date("d-m-Y"), $_GET['fec']);
     
     if($dat_cmp){
         
     $disable='disabled="disabled"';
         
     }else{
         
     $disable="";
         
     }
     
      list($temas,$id_temas)=get_temas_semana($_GET['mat'], $_GET['sem']);
        
     $disable="";
         
      
?>  


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> SCAUCAB-G | firmar asistencia </title>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css"/>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>

        <script src="js/functions.js"></script>
        
        <script language="javascript" src="js/liveclock.js"></script>

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

    <div data-role="page" id="firmar">

        <div data-role="header">
            <h1>SCAUCAB-G</h1>
            <a href="#opciones" data-role="button" data-mini="true"  data-icon="arrow-l" data-iconpos="left" data-inline="true">Opciones</a>

            <a href="#perfil" data-role="button" data-mini="true"  data-icon="arrow-r" data-iconpos="right" data-inline="true">Perfil</a>
        </div>

        <div data-role="content">

            <label>Fecha actual:<?php echo $current_date;?></label>
            
            <?php  if($dat_cmp){  echo '<h2>La firma de esta clase esta bloqueada </h2>';}?>
            
            <form method="POST" action="php-responses/firmar.php" data-ajax="false" >
                
                
                <ul data-role="listview" data-inset="true">
                    
                    <li data-role="fieldcontain">
                        <label >Materia :</label>
                        
                        <?php echo $materia['descripcion'];?>
                    
                    </li>
                    
                    <li data-role="fieldcontain">
                        <label>Semana : </label>
                            
                           <?php echo $semana;?>
                    
                    </li>
                    
                    <li data-role="fieldcontain">
                        <label>Fecha:</label>
                        
                         <?php echo $_GET["fec"];?>
             
                    </li>
                    
                      <li data-role="fieldcontain">
                          <label>Temas:</label>

                         <?php  listar_temas($temas);?>
             
                    </li>
                    
                     
              
                    
                      <li data-role="fieldcontain">
                          <label>Contenido :</label>
                            
                            <?php 
                            
                            for($i=0;$i<count($id_temas);$i++){
                                
                                
                                $sub_temas=get_contenido_tema($_GET["mat"], $id_temas[$i], $semana);
                                
                                        listar_temas($sub_temas);
                                              
                            }?>
             
                    </li>
                    
                        <li data-role="fieldcontain">
                            
                            <input type="hidden" name="estado" value="1">
                            <input type="hidden" name="semana" value="<?php echo $_GET['sem'];?>">
                             <input type="hidden" name="materia" value="<?php echo $_GET['mat'];?>">
                             <input type="hidden" name="fecha" value="<?php echo $_GET['fec'];?>">
                            <input type="hidden" name="funcion" value="<?php echo "firmar_asistencia";?>">
                            
                            
                    </li>
                    
                    

                    <li data-role="fieldcontain">
                        <label >Observaciones:</label>
                    <textarea cols="40" rows="8" name="obv" id="obv"></textarea>
                    </li>
                        
                    <li class="ui-body ui-body-b">
                        <fieldset class="ui-grid-a">
                                <div class="ui-block-a"><button type="reset" data-theme="d">Cancelar</button></div>
                                <div class="ui-block-b"><button type="submit" data-theme="a" <?php echo $disable ?>>Firmar</button></div>
                        </fieldset>
                    </li>
                </ul>
        </form>
             
         
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


            <?php
            get_personal_info($_SESSION['user']);
            ?>


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

