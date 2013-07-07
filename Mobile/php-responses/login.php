
<?php

require_once("../db/db.php");

require_once ("../core/system_functions.php");

function get_personal_info($user) {



    $dbconn = connect_db();

    $pg_sql = "SELECT * FROM profesor,usuario WHERE usuario.id_usuario =id_profesor AND usuario.email = '$user' ;  ";


    $query_result = pg_query($dbconn, $pg_sql) or die(pg_last_error());



    disconnect_db($dbconn);


    if (pg_num_rows($query_result) > 0) {

        while ($result = pg_fetch_array($query_result)) {

            echo "

                                  <label>Nombre: $result[nombre]</label><br>
                                  <label>Apellido: $result[apellido]</label><br>
                                   <label>Cedula: $result[cedula]</label><br>
                                   <label>Cargo: $result[especialidad]</label><br>
                
                                 
                            ";     // name class and mark will be printed with one line break
        }
    } else {


        echo " Sin resultados ";     // name class and mark will be printed with one line break
    }
}

function set_token($user) {

    session_start();

    $_SESSION["user"] = $user;
}

function login() {

    $email = $_POST["email"];

    $password = $_POST["password"];

    $dbconn = connect_db();

    $pgquery = "SELECT email,password 
                        FROM usuario WHERE email='" . $email . "' AND 
                             password='" . $password . "';";


    $result = pg_query($dbconn, $pgquery) or die(pg_last_error());

    $user = pg_fetch_array($result);

  disconnect_db($dbconn);
  
  
    if ($result) {
        if (pg_num_rows($result) > 0) {

            set_token($user["email"]);

             
             $url='http://' .$_SERVER['HTTP_HOST'].'/app/Mobile';
        
            header("location:  $url/main-menu.php");
        
        } else {
            $url='http://' .$_SERVER['HTTP_HOST'].'/app/Mobile';
        
            header("location:  $url/index.php?error=1");
        
    }


  
}

}


function logout() {


    session_start();

  # Limpiamos las variables:
	$_SESSION = array( );

	# Destruimos la sesión como tal:
	session_destroy( );

	# Destruimos el cookie:
	setcookie ('PHPSESSID', '');

	# Redirigimos al usuario:

          $url='http://' .$_SERVER['HTTP_HOST'].'/app/Mobile';
        
          header("location:  $url/index.php");
        
}

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        
    
    if(isset($_POST["email"]) &&  isset($_POST["password"]) ){
        
        login();
        
            }else if($_POST["email"]!="" && $_POST["password"]!=""){
        
            
             $url='http://' .$_SERVER['HTTP_HOST'].'/app/Mobile';
        
            header("location:  $url/index.php?st=error");
        
    }
    
    }
    
    
    if($_POST["option"]==2){
        
        logout();
        
    }
?>
         
