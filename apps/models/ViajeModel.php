<?php

require_once './config.php';
require_once './apps/models/Model.php';

class viajeModel extends Model
{

    function getViajesByDestino($href)
    {
        $query = $this->db->prepare('SELECT * FROM viajes WHERE id_destinos = ?');
        $query->execute([$href]);
        $viajes = $query->fetchAll(PDO::FETCH_OBJ);
        return $viajes;
    }


    function deleteViaje($idViaje)
    {
        $query = $this->db->prepare('DELETE FROM viajes WHERE id = ?');
        $query->execute([$idViaje]);
    }

    function insertViaje($fecha, $hora, $id_destinos)
    {  
        $query = $this->db->prepare('INSERT INTO viajes (fecha, hora, id_destinos) VALUES(?, ?, ?)');
        $query->execute([$fecha, $hora, $id_destinos]);
        return $this->db->lastInsertId();
    }

    public function modifyViaje($newFecha, $newHora, $newDestinoId, $viajeId)
    {  
        $query = $this->db->prepare('UPDATE viajes SET fecha = ?, hora = ?, id_destinos = ? WHERE id = ?');
        $query->execute([$newFecha, $newHora, $newDestinoId, $viajeId]);
    }

    //nuevas funciones

    public function getViajesPaginated($page, $perPage) {
        // Calcula el desplazamiento (offset) en base al número de página y elementos por página
        $offset = ($page - 1) * $perPage;

        // Prepara una consulta SQL que limita los resultados por página y se desplaza hasta la posición especificada por el offset
        $query = $this->db->prepare("SELECT * FROM Viajes LIMIT :perPage OFFSET :offset");
        // Asigna el valor de :perPage y :offset de manera segura (PDO::PARAM_INT fuerza los valores a ser enteros)
        $query->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getViajesOrdered($order) {
        $query = $this->db->prepare("SELECT * FROM Viajes ORDER BY id_destinos $order");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getViajesOrderedByIdDestinos($id, $order) {
        $query = $this->db->prepare("SELECT * FROM Viajes ORDER BY id $order");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function viajeExiste($idViaje) {
        $query = $this->db->prepare('SELECT COUNT(*) as count FROM Viajes WHERE id = ?');
        $query->execute([$idViaje]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        // Retorna true si el conteo es mayor a cero, indicando que el viaje existe
        return $result['count'] > 0;
    }

    /* nuevas funciones acorde a las correcciones  */

    public function getViajes($filterBy = null, $filterValue = null, $orderBy = null, $orderValue = 'ASC', $page = null, $limit = null) {
        $sql = 'SELECT viajes.*, destinos.destino 
                FROM viajes 
                LEFT JOIN destinos ON viajes.id_destinos = destinos.id 
                WHERE 1=1';
    
        $params = [];
    
        // Filtro
        if ($filterBy && $filterValue) {
            $validFilters = ['fecha', 'hora', 'id_destinos'];
            if (in_array($filterBy, $validFilters)) {
                $sql .= " AND viajes.$filterBy = ?";
                $params[] = $filterValue;
            }
        }
    
        // Ordenación
        if ($orderBy) {
            $validOrders = ['fecha', 'hora', 'id'];
            if (in_array($orderBy, $validOrders)) {
                $sql .= " ORDER BY viajes.$orderBy " . (strtoupper($orderValue) === 'DESC' ? 'DESC' : 'ASC');
            }
        }
    
        // Paginación
        if ($page && $limit) {
            $offset = ($page - 1) * $limit;
            $sql .= " LIMIT $offset, $limit";
        }
    
        $query = $this->db->prepare($sql);
        $query->execute($params);
    
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

            
    public function getViajeById($id){
        $query = $this->db->prepare('SELECT * FROM viajes WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
