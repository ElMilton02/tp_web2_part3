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

        // Obtener la categoría como un objeto
        $destino = $query->fetch(PDO::FETCH_OBJ);

        return $destino;
    }
    

    public function modifyDestino($idDestino, $destino, $img)
    {
        $query = $this->db->prepare('UPDATE destinos SET destino = ?, imagen_destino = ? WHERE id = ?');
        $query->execute([$destino, $img, $idDestino]);
    }
}
