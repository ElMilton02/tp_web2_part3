<?php
    require_once 'config.php';
    require_once './libs/router.php';
    require_once 'apps/api/controllers/ApiViajesController.php';

    //resourse= parametro + verbo;
    //Creo el router;
    $router = new Router();

    //Defino mi tabla de ruteo;

    //Endpoints
    //endponit para traer mi listado de viajes
    //                 endpoint     verbo       desde donde llamo   motodo

    //Listo mis categorias
    // Obtener todos los destinos
$router->addRoute('destinos', 'GET', 'ApiViajesController', 'getDestinos');

// Obtener viajes por destino específico
$router->addRoute('destinos/:ID/viajes', 'GET', 'ApiViajesController', 'getDestinos');

// Ordenar viajes por orden ascendente o descendente
$router->addRoute('viajes/order/:order', 'GET', 'ApiViajesController', 'getOrderedViajes');

// Ordenar viajes por ID de destino y orden
$router->addRoute('destinos/:ID/viajes/order/:order', 'GET', 'ApiViajesController', 'getOrderedViajesById');

// Filtrar destinos por letra inicial
$router->addRoute('destinos/filter/:letter', 'GET', 'ApiViajesController', 'getFilterDestinos');

// Obtener viajes paginados
$router->addRoute('viajes/page/:page', 'GET', 'ApiViajesController', 'getViajesPag');

// Agregar nuevo viaje (POST) 
$router->addRoute('viajes', 'POST', 'ApiViajesController', 'createViaje');

// Actualizar un viaje existente (PUT)
$router->addRoute('viajes/:ID', 'PUT', 'ApiViajesController', 'updateViaje');

// Eliminar un viaje específico (DELETE)
$router->addRoute('viajes/:ID', 'DELETE', 'ApiViajesController', 'deleteViaje');

// Maneja la solicitud de recurso con el método HTTP especificado
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);