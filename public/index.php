<?php

ini_set('display_errors', 1);
ini_set('display_startup', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
session_start();

if (file_exists("../.env")) {
	$dotenv = new Dotenv\Dotenv(__DIR__ .'/..');
	$dotenv->load();
}

use Aura\Router\RouterContainer;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
		'driver'    => getenv('DB_DRIVER'),
		'host'      => getenv('DB_HOST'),
		'database'  => getenv('DB_NAME'),
		'username'  => getenv('DB_USER'),
		'password'  => getenv('DB_PASS'),
		'charset'   => 'utf8',
		'collation' => 'utf8_unicode_ci',
		'prefix'    => '',
	]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$contenedorDeRutas = new RouterContainer();

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
	$_SERVER,
	$_GET,
	$_POST,
	$_COOKIE,
	$_FILES
);

$mapa = $contenedorDeRutas->getMap();
//--Login-----------------------------------------------------------------------------------------------------------------

//generación de nuevas rutas 
$mapa->get('home', //identificador de la ruta
			'/MVC-masterC/home', //dirección de la ruta (la que va en el buscador del navegador)
			['controller'=>'App\controllers\HomeController', //App es nombre definido en composer
			'action'=>'getHome']);
/*En las ultimas dos lineas se define el controlador que maneja la ruta, y el método que se utiliza
en la clase definida en el mismo*/

$mapa->get('alumnos', '/MVC-masterC/alumnos',['controller'=>'App\controllers\AlumnosController', 'action'=>'getName']);
$mapa->get('ayuda', '/MVC-masterC/ayuda', ['controller'=>'App\controllers\AyudaController', 'action'=>'getHelp']);	
$mapa->get('nosotros', '/MVC-masterC/nosotros', ['controller'=>'App\controllers\HomeController', 'action'=>'getInfo']);

//------Mach whit route-------------
$matcher = $contenedorDeRutas->getMatcher();

$route = $matcher->match($request);
//------Mach whit route-------------

if (!$route) {
	echo 'no encuentro esa ruta';
} else {

	$capturadorDeDatos = $route->handler;

	$nombreControlador = $capturadorDeDatos['controller'];
	$nombreDeFuncion   = $capturadorDeDatos['action'];
	$Autentificacion   = $capturadorDeDatos['auth']??false;

	$log = $_SESSION['login'][2]??null;

	if ($Autentificacion && !$log) {
		$controlador     = new App\controllers\loginController;
		$nombreDeFuncion = 'getLogin';
		$response        = $controlador->$nombreDeFuncion($request);
	} else {

		$controlador = new $nombreControlador;
		$response    = $controlador->$nombreDeFuncion($request);

	}

	echo $response->getBody();

}
