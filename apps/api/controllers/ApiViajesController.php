<?php
require_once './apps/api/controllers/ApiController.php';
require_once './apps/models/Model.php';
require_once './apps/models/DestinoModel.php';
require_once './apps/models/ViajeModel.php';

class ApiViajesController extends ApiController {
   
    private $viajeModel;
    private $destinoModel;

    function __construct() {
        // Llamada al constructor del padre, ApiController
        parent::__construct(); 
        $this->viajeModel = new ViajeModel(); 
        $this->destinoModel = new DestinoModel();
    }

    /* 
    public function getOrderedViajes($params = []) {
        $order = $params[':order']; // Captura el parámetro de orden (ASC o DESC)

        // Verifica que el parámetro de orden sea válido
        if ($order !== 'ASC' && $order !== 'DESC') {
            $this->view->response(['msg' => 'Error en el parámetro de orden'], 404);
            return;
        }
        // Obtiene los viajes ordenados según el orden especificado
        $viajes = $this->viajeModel->getViajesOrdered($order);

        if ($viajes !== false) {
            $this->view->response(['msg' => 'Datos de los viajes obtenidos ordenadas con éxito', 'viejes' => $viajes], 200);
        } else {
            $this->view->response(['msg' => 'Error al obtener los viajes'], 404);
        }
    }
    public function getOrderedViajesById($params = []) {
        $order = $params[':order']; // Captura el parámetro de orden (ASC o DESC)

        if ($order !== 'ASC' && $order !== 'DESC') {
            $this->view->response(['msg' => 'Error en el parámetro de orden'], 400);
            return;
        }
        // Verifica que se haya pasado un ID en los parámetros
        if (!isset($params[':ID'])) {
            $this->view->response(['msg' => 'Error, ID de destino no presente en la solicitud'], 400);
            return;
        }
        $id = $params[':ID']; 
        if (!$this->destinoModel->destinoExiste($id)) {
            $this->view->response(['msg' => 'El destino ' . $id .  ' especificado no existe'], 404);
            return;
        } else {
            // Obtiene viajes ordenados según el ID del destino y el orden especificado
            $viajes = $this->viajeModel->getViajesOrderedByIdDestinos($id, $order);
    
            if ($viajes !== false) {
                $this->view->response(['msg' => 'Datos de los viajes obtenidos ordenados con éxito', 'viajes' => $viajes], 200);
            } else {
                $this->view->response(['msg' => 'Error al obtener los viajes'], 400);
            }
        }

    }

    public function getFilterDestinos($params = []) {
        // Verificar si existe el parámetro letter
        if (!isset($params[':letter'])) {
            $this->view->response(['msg' => 'Parámetro de filtrado no proporcionado.'], 400);
            return;
        }
    
        $filtro = $params[':letter']; // Nota el ':' antes de letter
    
        if (empty($filtro)) {
            $this->view->response(['msg' => 'Filtrado vacío.'], 400);
            return;
        }
    
        // Obtiene los destinos filtrados por la letra inicial
        $destinosFiltrado = $this->destinoModel->getDestinosFilter($filtro);
    
        if (!empty($destinosFiltrado)) { // Corregido el nombre de la variable
            $this->view->response([
                'msg' => 'Datos de los destinos filtrados obtenidos con éxito', 
                'destinos' => $destinosFiltrado
            ], 200);
        } else {
            $this->view->response(['msg' => 'No se encontraron resultados.'], 404);
        }
    }
    */
    public function deleteViaje($params = []) {
        $idViaje = $params[':ID'];
        
        // Verifica que el viaje exista antes de eliminarla
        if (!$this->viajeModel->viajeExiste($idViaje)) {
            $this->view->response(['msg' => 'el viaje ' . $idViaje .  ' especificado no existe'], 404);
            return;
        }
        if($idViaje){
            $this->viajeModel->deleteViaje($idViaje);
            // Responde con éxito si el destino se elimino correctamente
            $this->view->response(['msg' => "Se elimino correctamente ".$idViaje], 200);
        }
    }

    // Método para crear un nuevo viaje
    public function createViaje($params = []) {
        $body =  $this->getData(); // Obtiene el cuerpo de la solicitud como un objeto JSON

        $fecha = $body->fecha;
        $hora = $body->hora;
        $destinoId = $body->destinoId; 

        if (empty($fecha) || empty($hora) || empty($destinoId)) {
            return $this->view->response(['msg' => 'Campo incompleto'], 400);   
        } else if (!$this->destinoModel->destinoExiste($destinoId)){
            return $this->view->response(['msg' => 'El destino especificado no existe'], 404);
        } else {
            $viajeId = $this->viajeModel->insertViaje($fecha, $hora, $destinoId); // Inserta el viaje
            // Crea el objeto de respuesta con la información del viaje creado
            $viaje = [
                'id' => $viajeId,
                'fecha' => $fecha,
                'hora' => $hora,
                'destinoId' => $destinoId
            ];

            $this->view->response(['msg' => 'El viaje fue agregado con éxito.', 'Viaje' => $viaje], 201);
        }
    }



    public function updateViaje($params = []) {
        $id = $params[':ID'];
    
        // Verificar que el viaje exista
        if (!$this->viajeModel->ViajeExiste($id)) {
            return $this->view->response(['msg' => 'El viaje especificado no existe'], 404);
        }
    
        $body = $this->getData();
        $newFecha = $body->fecha ?? null;
        $newHora = $body->hora ?? null;
        $newDestinoId = $body->destinoId ?? null;
    
        // Validar datos
        if (empty($newFecha) || empty($newHora) || empty($newDestinoId)) {
            return $this->view->response(['msg' => 'Campos incompletos'], 404);
        } else if (!$this->destinoModel->destinoExiste($newDestinoId)){
            return $this->view->response(['msg' => 'El destino especificado no existe'], 404);
        }

        // Actualizar el viaje
        $this->viajeModel->modifyViaje($newFecha, $newHora, $newDestinoId, $id);
    
        // Obtener datos actualizados para la respuesta
        $viajeActualizado = $this->viajeModel->getViajeById($id);
    
        return $this->view->response(['msg' => 'El viaje fue modificado con éxito.', 'viaje' => $viajeActualizado], 200);
    }


/* nuevas funciones acorde a las correcciones */

    function getAllViajes() {
        $filterBy = isset($_GET['filterBy']) ? $_GET['filterBy'] : null;
        $filterValue = isset($_GET['filterValue']) ? $_GET['filterValue'] : null;
        $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : null;
        $orderValue = isset($_GET['orderValue']) ? $_GET['orderValue'] : 'ASC';
        $page = isset($_GET['page']) ? intval($_GET['page']) : null;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : null;

        try {
            $viajes = $this->viajeModel->getViajes($filterBy, $filterValue, $orderBy, $orderValue, $page, $limit);
            if (!empty($viajes)) {
                $this->view->response(['msg' => 'Viajes obtenidos con éxito.', 'Viaje' => $viajes], 200);
            } else {
                $this->view->response(["msg" => "No se encontraron viajes"], 404);
            }
        } catch (Exception $e) {
            $this->view->response(["error" => $e->getMessage()], 500);
        }   
    }

    function getViajesById ($params = []){
        $id = $params[':ID'];
        $viaje = $this->viajeModel->getViajeById($id);
        if ($viaje) {
            $this->view->response(['msg' => 'Viaje obtenido por ID con éxito.', 'Viaje' => $viaje], 200);
        } else {
            $this->view->response(["msg" => "Viaje no encontrado"], 404);
        }
    }

/*
No se ordena opcionalmente por un campo.
No usan query params para ordenar, ni filtrar, ni paginar.
Manejan mal los códigos de error. 
En PUT y POST si el destino no existe, no manejan el error.
No funciona GET por ID. Si pueden, usen solo una tabla porque sus endpoints son muy confusos.
Re entregar
*/
}