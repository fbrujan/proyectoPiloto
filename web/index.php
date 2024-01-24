<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
date_default_timezone_set("America/Santo_Domingo");        
error_reporting(E_ALL);

require_once "Config/Config.php";

$ruta = "";
$controlador = "";
$metodo = "";
$parametro = "";


if (!empty($_GET['url'])) {
	$ruta = $_GET['url'];
}else{
	$ruta = "Home/index";
}

$ruta_array = explode("/", $ruta);
$controlador = ucwords($ruta_array[0]);

$ruta_controlador = "Controllers/" . $controlador . ".php";

if (!empty($ruta_array[1])){
	$metodo = $ruta_array[1];
}else{
	$metodo = "index";
}

for ($i=2; $i < count($ruta_array) ; $i++) { 
	$parametro .= $ruta_array[$i] . "," ;
}

$parametro = trim($parametro,",");

require_once "Config/App/autoload.php";

if (file_exists($ruta_controlador)) {
	require_once $ruta_controlador;
	$controller = new $controlador;
	if (method_exists($controller, $metodo)) {
		$controller->$metodo($parametro);
	}else{
		print ("<h2>No existe el metodo: '" . $metodo . "' </h2>");
	}
}else{
	print ('El controlador no existe');
}

/*
print ("Ruta: " . $ruta . "<br />" );
print ("Controlador: " . $ruta_controlador . "<br />");
print ("Metodo: " . $metodo . "<br />");
print ("Parametros: " . $parametro . "<br />");
*/

?>