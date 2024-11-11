<?php

require_once './config.php';
require_once './app/models/Model.php';

class DestinoModel extends Model
{

    function getDestinos()
    {

        $query = $this->db->prepare('SELECT * FROM destinos');
        $query->execute();

      
        $destinos = $query->fetchAll(PDO::FETCH_OBJ);

        return $destinos;
    }

    function deleteDestino($idDestino)
    {
        $query = $this->db->prepare('DELETE FROM destinos WHERE id = ?');
        $query->execute([$idDestino]);
    }

    function insertDestino($destino, $img)
    {
        $query = $this->db->prepare('INSERT INTO destinos (destino, imagen_destino) VALUES(?, ?)');
        $query->execute([$destino, $img]);
        return $this->db->lastInsertId();
    }

    public function getDestinoById($id)
    {
        $query = $this->db->prepare('SELECT * FROM destinos WHERE id = ?');
        $query->execute([$id]);
        $destino = $query->fetch(PDO::FETCH_OBJ);
        return $destino;
    }
    

    public function modifyDestino($idDestino, $destino, $img)
    {
        $query = $this->db->prepare('UPDATE destinos SET destino = ?, imagen_destino = ? WHERE id = ?');
        $query->execute([$destino, $img, $idDestino]);
    }

    //nuevas funciones

    public function destinoExiste($idDestino) {
        // Prepara una consulta SQL que cuenta el número de categorías con el ID dado
        $query = $this->db->prepare('SELECT COUNT(*) as count FROM Destinos WHERE id = ?');
        $query->execute([$idDestino]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }

    public function getDestinosFilter($filtro){
        // Se prepara una consulta SQL que selecciona todas las columnas de 'categorias' donde 'categoria' comienza con el valor del filtro
        $query = $this->db->prepare("SELECT * FROM Destinos WHERE Destino LIKE '$filtro%'");
        // Ejecuta la consulta
        $query->execute();
        
        // Retorna el resultado como un arreglo de objetos
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
