<?php

require_once './config.php';
require_once './apps/models/Model.php';

class DestinoModel extends Model
{
    /*
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
    */
    //nuevas funciones

    public function destinoExiste($idDestino) {
        $query = $this->db->prepare('SELECT COUNT(*) as count FROM Destinos WHERE id = ?');
        $query->execute([$idDestino]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
    /*
    public function getDestinosFilter($filtro){
        $query = $this->db->prepare("SELECT * FROM Destinos WHERE Destino LIKE :filtro");
        // Asigna el valor a :filtro con el comodín %, asegurando que busque cualquier nombre que comience con la letra
        $query->bindValue(':filtro', $filtro . '%', PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    */
}
