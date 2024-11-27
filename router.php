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

  /*
    // Obtener todos los destinos
    // ej:http://localhost/tp_web2_part3/api/destinos
    $router->addRoute('viajes', 'GET', 'ApiViajesController', 'getViajes');

    // Obtener viajes por destino específico
    // ej:http://localhost/tp_web2_part3/api/destinos/1/viajes
    $router->addRoute('destinos/:ID/viajes', 'GET', 'ApiViajesController', 'getDestinos');

    // Ordenar viajes por orden ascendente o descendente
    // http://localhost/tp_web2_part3/api/viajes/order/DESC
    $router->addRoute('viajes/order/:order', 'GET', 'ApiViajesController', 'getOrderedViajes');

    // Ordenar viajes por ID de destino y orden
    // http://localhost/tp_web2_part3/api/destinos/1/viajes/order/DESC
    $router->addRoute('destinos/:ID/viajes/order/:order', 'GET', 'ApiViajesController', 'getOrderedViajesById');

    // Filtrar destinos por letra inicial
    // http://localhost/tp_web2_part3/api/destinos/filter/a
    $router->addRoute('destinos/filter/:letter', 'GET', 'ApiViajesController', 'getFilterDestinos');

    // Obtener viajes paginados
    // http://localhost/tp_web2_part3/api/viajes/page/1
    $router->addRoute('viajes/page/:page', 'GET', 'ApiViajesController', 'getViajesPag');

    // Agregar nuevo viaje (POST) 
    // http://localhost/tp_web2_part3/api/viajes
    // ej:
    //    {
    //       "fecha": "2024-11-15",
    //         "hora": "14:30:00",
    //         "destinoId": 1
    //     }
    $router->addRoute('viajes', 'POST', 'ApiViajesController', 'createViaje');

    // Actualizar un viaje existente (PUT)
    // http://localhost/tp_web2_part3/api/viajes/63
    // ej:
    //    {
    //      "fecha": "2000-11-15",
    //      "hora": "14:40:00",
    //      "destinoId": 3
    //    }
    $router->addRoute('viajes/:ID', 'PUT', 'ApiViajesController', 'updateViaje');

    // Eliminar un viaje específico (DELETE)
    // http://localhost/tp_web2_part3/api/viajes/63
    $router->addRoute('viajes/:ID', 'DELETE', 'ApiViajesController', 'deleteViaje');

    nuevos endpoints acorde a los comentario echos */

    $router->addRoute('viajes', 'GET', 'ApiViajesController', 'getAllViajes'); // Obtener todos los viajes (filtros/paginación incluidos)
    $router->addRoute('viajes/:ID', 'GET', 'ApiViajesController', 'getViajesById'); // Obtener un viaje por ID
    $router->addRoute('viajes', 'POST', 'ApiViajesController', 'createViaje'); // Crear un viaje
    $router->addRoute('viajes/:ID', 'PUT', 'ApiViajesController', 'updateViaje'); // Actualizar un viaje por ID
    $router->addRoute('viajes/:ID', 'DELETE', 'ApiViajesController', 'deleteViaje'); // Eliminar un viaje por ID

    // Maneja la solicitud de recurso con el método HTTP especificado
    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);