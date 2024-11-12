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

    public function getViajeById($id)
    {
        $query = $this->db->prepare('SELECT * FROM viajes WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
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

    public function modifyViaje($newFecha, $newHora, $viajeid)
    {  
        $query = $this->db->prepare('UPDATE viajes SET fecha = ?, hora = ? WHERE id = ?');
        $query->execute([$newFecha, $newHora, $viajeid]);
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

     // Método que obtiene las categorías ordenadas por un campo específico
     public function getViajesOrdered($order) {
        // Se prepara una consulta SQL que selecciona todas las columnas de la tabla 'categorias' y las ordena según el parámetro $order
        $query = $this->db->prepare("SELECT * FROM Viajes ORDER BY id_destinos $order");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getViajesOrderedByIdDestinos($id, $order) {

        $query = $this->db->prepare("SELECT * FROM Viajes ORDER BY id $order");
        $query->execute([$id]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function viajeExiste($idViaje) {
        // Prepara una consulta SQL que cuenta el número de categorías con el ID dado
        $query = $this->db->prepare('SELECT COUNT(*) as count FROM Viajes WHERE id = ?');
        // Ejecuta la consulta, pasando el ID como parámetro
        $query->execute([$idViaje]);

        // Almacena el resultado como un arreglo asociativo
        $result = $query->fetch(PDO::FETCH_ASSOC);

        // Retorna true si el conteo es mayor a cero, indicando que la categoría existe
        return $result['count'] > 0;
    }

    function getViajes() {
        $query = $this->db->prepare('SELECT * FROM Viajes');
        $query->execute();
        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }
}
