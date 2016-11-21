<?php
include 'db.php';
$errorMsg = "";

if ( isset($_POST['cadena']) ){
    
    $cadena = mysqli_real_escape_string($con,$_POST['cadena']);
    $cadena = substr(trim($cadena),0,-1);

    /*if ( mysqli_query($con,
        "INSERT INTO cadenas 
                SET cadena ='".$cadena."'") ) {
        $errorMsg = '<div class="alert alert-success">
        <i class="fa fa-check"></i> Cadena Enviada y Guardada en bd
        </div>';
    } else {
        $errorMsg = '<div class="alert alert-danger">
        <i class="fa fa-times"></i> Error, intenta nuevamente.
        </div>';
    }*/
    $var = $cadena; 
    
    $var = explode(" ", $var);
    for ($i=0; $i < count($var); $i++) { 
            //echo  '<h2>'.$var[$i].'</h2>';
        $estado = 0;
        $varAux = strtolower($var[$i]).';';
        
        for ($x=0; $x < strlen($varAux) ; $x++) { 
            $ascii      = ord($varAux[$x]);
            $consulta   = "SELECT l".$ascii." FROM matriz  where id=".$estado.' LIMIT 1';
            
            $resultado  = $con->query($consulta);
            $est        = $resultado->fetch_array(MYSQLI_ASSOC);
            $estado     = $est['l'.$ascii];
        }
        $consultaFinal  = "SELECT cat FROM matriz  where id=".$estado.' LIMIT 1';
        //print_r($consultaFinal);
        $resulFinal     = $con->query($consultaFinal);
        $final          = $resulFinal->fetch_array(MYSQLI_ASSOC);

        echo $final['cat'].' ';
    }
}

?>