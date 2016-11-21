<?php
include 'php/db.php';
$errorMsg = "";
$cadenaTokens = "";

if ( isset($_POST['cadena']) ){
    
    $cadena = mysqli_real_escape_string($con,$_POST['cadena']);
    //$file = mysqli_real_escape_string($con,$_POST['file']);
    //$cadena = trim($cadena);
    $cadena = trim($cadena);
    //$cadena = str_replace('/\r\n/', " ", $cadena);
   // $cadena = preg_replace('/\r\r+/', ' ',$cadena);
    //$cadena = preg_replace('/\n/', '',$cadena);
    //$cadena = preg_replace('/\r\r+/', '',$cadena);
    //$cadena = preg_replace('/\n',' ',$cadena);
    //$cadena = trim($cadena,'\n')

    //$cadena = preg_replace('/\s+/', ' ',trim($cadena2));
    //echo $cadena;
   // $string = preg_replace('/\s+/', ' ', trim($string));

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
    $token = array();
    $renglon = explode('\n',$cadena);
    var_dump($renglon);
    for ($k=0; $k < count($renglon); $k++) { 
        $c = trim($renglon[$k],'\r');
        $var = explode(" ", $c);
    //var_dump($var);
    for ($i=0; $i < count($var); $i++) { 
            //echo  '<h2>'.$var[$i].'</h2>';
        $estado = 0;
        $varAux = strtolower($var[$i])/*.';'*/;
        
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

        //echo $final['cat'].' ';
        array_push($token, $final['cat']);
        //$stoken = $final['cat'].' ';
        
    }
    }
    for ($t=0; $t < count($token); $t++) { 
        $cadenaTokens = $cadenaTokens.' '.$token[$t];
    }   
        
        //array_push($token,);

    /*$errorMsg = '<div class="alert alert-success">
        <i class="fa fa-times"></i> '.$cadenaTokens.'
        </div>';*/
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EAD | Analisis Lexico</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/plugins/codemirror/codemirror.css" rel="stylesheet">
    <link href="css/plugins/codemirror/ambiance.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<div id="" class="gray-bg">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Analisis L&eacutexico</h2>
            <h5>Lenguaje de programaci&oacuten EAD.</h5>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <form action="" method="post" class="form-horizontal" name="lex">
                            <div class="form-group"><label class="col-sm-4 control-label">Capture su Linea de codigo</label>
                                <div class="col-sm-8">
                                    <div class="input-group"> <textarea contenteditable="true" cols="50" rows="10" type="text" class="form-control" name="cadena" id="cadena" required></textarea><span class="input-group-btn"><button type="submit" class="btn btn-primary"  > Verificar
                                    </button> </span></div>
                                </div>
                            </div>
                        </form>
                        <div class="hr-line-dashed"></div>
                        <form>
                            <div class="form-group">
                                <label class="col-sm-offset-2"></label>
                                <label class="btn btn-success">
                                    Cargar&hellip; <input type="file" name="archivo" style="display: none;" onchange="openFile(event)" accept='text/plain'>
                                </label>
                                <button name="limpiar" class="btn btn-white" type="submit" onclick="ClearInput()">Limpiar</button>
                               <button type="button" class="btn btn-primary" value="save" id="save"> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5> Archivo Cargado</h5>
                    </div>
                    <div class="ibox-content">
                    <form action="" method="" name="lexfile" class="form-horizontal" >
                    <!-- aqui imprime el resultado de el file reader -->
                    <pre contenteditable="true" id="pre" name="file" ></pre>

                    <button type="submit" class="btn btn-primary"  > Verificar </button>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Palabras Reservadas</h5>
                    </div>
                    <div class="ibox-content">
                        <p  class="m-b-lg">
                            <strong>Aqui se muestra una lista de las palabras reservadas que han sido invocadas, y se muestran en el orden en que an sido escritas.
                            </strong> 
                            <br>
                        </p>
                        <textarea id="code1" value = ''><?php echo $cadenaTokens ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div class="footer">
        <strong>Copyright</strong> EAD &copy; 2015-2016
    </div>
</div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- CodeMirror -->
    <script src="js/plugins/codemirror/codemirror.js"></script>
    <script src="js/plugins/codemirror/mode/javascript/javascript.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
    <script>
            function saveTextAsFile() {
                var textToWrite = document.getElementById('code1').value;
                var textFileAsBlob = new Blob([textToWrite], {
                    type: 'text/plain'
                });
                var fileNameToSaveAs = "token.txt";

                var downloadLink = document.createElement("a");
                downloadLink.download = fileNameToSaveAs;
                downloadLink.innerHTML = "Download File";
                if (window.webkitURL != null) { 
                    // Chrome allows the link to be clicked
                    // without actually adding it to the DOM.
                    downloadLink.href = window.webkitURL.createObjectURL(textFileAsBlob);
                } else {
                    // Firefox requires the link to be added to the DOM
                    // before it can be clicked.
                    downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
                    downloadLink.onclick = destroyClickedElement;
                    downloadLink.style.display = "none";
                    document.body.appendChild(downloadLink);
                }

                downloadLink.click();
            }

            var button = document.getElementById('save');
            button.addEventListener('click', saveTextAsFile);

            function destroyClickedElement(event) {
                // remove the link from the DOM
                document.body.removeChild(event.target);
            }
    </script>

    <script>
         $(document).ready(function(){

             var editor_one = CodeMirror.fromTextArea(document.getElementById("code1"), {
                 lineNumbers: true,
                 matchBrackets: true,
                 styleActiveLine: true,
             });
        });
    </script>

</body>

</html>