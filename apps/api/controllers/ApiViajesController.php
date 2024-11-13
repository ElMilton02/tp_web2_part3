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

    public function getDestinos($params = []) {
        // Verifica si no se han pasado parámetros
        if (empty($params)) {
            $destinos = $this->destinoModel->getDestinos();
            $this->view->response(['msg' => 'Datos de los destinos obtenidos con éxito', 'destinos' => $destinos], 200);
        } else {
          
            $viajes =  $this->viajeModel->getViajesByDestino($params[':ID']);
            if (!empty($viajes)) {
                // Responde con las prendas obtenidas y un mensaje de éxito
                $this->view->response(['msg' => 'Datos del los viajes por destino obtenidos con éxito', 'viajes' => $viajes], 200);
            } else {
                $this->view->response(['msg' => "El ID ".$params[':ID'].": no existe"], 404);
                return;
            }
        }
    }
    // Método para obtener viajes de forma paginada
    public function getViajesPag($params = []) { 
        // Establece la página por defecto en 1 si no se proporciona
        $page = isset($params[':page']) ? $params[':page'] : 1;
        $perPage = 3; // Número fijo de viajes por página
        // Obtiene los viajes paginados
        $viajes = $this->viajeModel->getViajesPaginated($page, $perPage);
        if (!empty($viajes)) {
            $this->view->response(['msg' => 'Datos de los viajes obtenidos con éxito', 'viajes' => $viajes], 200);
        } else {
            $this->view->response(['msg' => 'Error al obtener los viajes o la página solicitada no tiene resultados'], 404);
        }
    }

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
            $this->view->response(['msg' => 'Campo incompleto'], 400);
            return;
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
        $Viaje = $this->viajeModel->getViajeById($id);

        if (!$this->viajeModel->ViajeExiste($id)) {
            $this->view->response(['msg' => 'El viaje ' . $id .  ' especificado no existe'], 401);
            return;
        }
        if(!empty($id)){
            if($Viaje){
                $body = $this->getData();
                $newFecha = $body->fecha;
                $newHora = $body->hora;
                $newDestinoId = $body->destinoId;

                // Actualizar el viaje
                $this->viajeModel->modifyViaje($newFecha, $newHora, $newDestinoId, $id);

                $this->view->response(['msg' => 'El viaje fue modificado con éxito.', 'Viaje' => $Viaje], 201);
            } else {
                $this->view->response(['msg' => "El ID ".$id.": no existe"], 404);
                return;
            }
        } else {
            $this->view->response(['msg' => "Campo vacio"], 400);
            return;
        }
    }
}