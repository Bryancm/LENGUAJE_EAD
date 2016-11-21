<?php
$serv = "localhost";
$user = "root";
$pass = "";
$data = "matriztransicion";

### FUNCIONES DE SEGURIDAD ###
function xss($vuln){
	return htmlentities(strip_tags($vuln));
}
function sqli($vuln){
	return mysql_real_escape_string($vuln);
}
##############################

$con = mysqli_connect($serv, $user, $pass);
mysqli_select_db($con, $data);

$errorMsg = "";
?>
