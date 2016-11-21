<?php
include 'db.php';
$errorMsg = "";

if ( isset($_POST['cadena']) ){
    
    $cadena       = mysqli_real_escape_string($con,$_POST['cadena']);    

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
        $estado = 0;//1
        $varAux = strtolower($var[$i]).';';
        
        for ($x=0; $x < strlen($varAux) ; $x++) { 
            $ascii      = ord($varAux[$x]);
            $consulta   = "SELECT l".$ascii." FROM matriz  where id=".$estado.' LIMIT 1';
            $resultado  = $con->query($consulta);
            $est        = $resultado->fetch_array();
            $estado     = $est['l'.$ascii];
        }
        $consultaFinal  = "SELECT cat FROM matriz  where id=".$estado.' LIMIT 1';
        $resulFinal     = $con->query($consultaFinal);
        $final          = $resulFinal->fetch_array(MYSQLI_ASSOC);
        echo $final['cat'].' ';
    }
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
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Code Editor - Basic example</h5>
                </div>
                <div class="ibox-content">
                    <p  class="m-b-lg">
                        <strong>CodeMirror</strong> is a versatile text editor implemented in JavaScript for the browser. It is specialized for editing code, and comes with a number of language modes and addons that implement more advanced editing functionality.
                    </p>

<textarea id="code1">
<script>
    // Code goes here

    // For demo purpose - animation css script
    function animationHover(element, animation)
        element = $(element);
        element.hover(
                function()
                    element.addClass('animated ' + animation);
                },
                function()
                    //wait for animation to finish before removing classes
                    window.setTimeout( function()
                        element.removeClass('animated ' + animation);
                    }, 2000);
                });
    }
</script>
</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Code Editor - Theme Example</h5>
                        </div>
                        <div class="ibox-content">

                            <p class="m-b-lg">
                                A rich programming API and a CSS theming system are available for customizing CodeMirror to fit your application, and extending it with new functionality. For mor info go to
                                <a href="http://codemirror.net/" target="_blank">http://codemirror.net/</a>
                            </p>
                            <textarea id="code2">
                                var SpeechApp = angular.module('SpeechApp', []);

                                function VoiceCtrl($scope)

                                    $scope.said='...';

                                    $scope.helloWorld = function()
                                        $scope.said = "Hello world!";
                                    }

                                    $scope.commands =
                                        'hello (world)': function()
                                            if (typeof console !== "undefined") console.log('hello world!')
                                            $scope.$apply($scope.helloWorld);
                                        },
                                        'hey': function()
                                            if (typeof console !== "undefined") console.log('hey!')
                                            $scope.$apply($scope.helloWorld);
                                        }
                                    };

                                    annyang.debug();
                                    annyang.init($scope.commands);
                                    annyang.start();
                                }
                            </textarea>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Analisis Lexico <small>Lenguaje de programaci&oacuten EAD.</small></h5>
                        </div>
                        <div class="ibox-content">
                            <form method="post" class="form-horizontal">
                            <?php echo $errorMsg; ?>
                                <div class="form-group"><label class="col-sm-2 control-label">Capture su Linea de codigo</label>

                                    <div class="col-sm-10">
                                        <div class="input-group"><input type="text" class="form-control" name="cadena"> <span class="input-group-btn"> <button type="submit" class="btn btn-primary"> Validar
                                        </button> </span></div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-6 col-sm-offset-2">
                                        <button class="btn btn-success" type="submit">Cargar</button>
                                        <button class="btn btn-white" type="submit">Limpiar</button>
                                        <button class="btn btn-primary" type="submit">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div>
                <strong>Copyright</strong> EAD &copy; 2015-2016
            </div>
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
         $(document).ready(function(){

             var editor_one = CodeMirror.fromTextArea(document.getElementById("code1"), {
                 lineNumbers: true,
                 matchBrackets: true,
                 styleActiveLine: true,
                 theme:"ambiance"
             });

             var editor_two = CodeMirror.fromTextArea(document.getElementById("code2"), {
                 lineNumbers: true,
                 matchBrackets: true,
                 styleActiveLine: true
             });

        });
    </script>

<style>

</style>

</body>

</html>
