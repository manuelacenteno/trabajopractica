<?php
include_once 'app/helpers/db.helper.php';

class RegionModel{

    private $db;

    private $dbHelper;
  
    function __construct(){

        $this->dbHelper = new DBHelper();

        $this->db = $this->dbHelper->connect();

    }

    function obtenerRegiones(){
       //2-Enviar la consulta (preparar y ejecutar)
        $query = $this->db->prepare('SELECT * FROM region');
        $query->execute();

        //3-procesar la respuesta para generar html
        $region = $query->fetchAll(PDO::FETCH_OBJ);
        //4- cerrar la conexion (PDO lo hace solo)
        return $region;
     
    }
    function insertarRegion($nombre, $informacion){

        //2-Enviar la consulta(los datos), lindeo los parametros (?,?,?)
        $query = $this->db->prepare('INSERT INTO region (nombre, informacion) VALUES (?,?)');
        $query->execute([$nombre, $informacion]);

        //3-no necesito obtener respuesta xq estoy insertando
        return $this->db->lastInsertId();

    }

    function eliminarRegion($id){

        $query = $this->db->prepare('DELETE FROM region WHERE id = ?');

        $query->execute([$id]);
    }
    
    function actualizarRegion( $nombre, $informacion, $id){


        $query = $this->db->prepare('UPDATE region SET nombre = ?, informacion = ? WHERE id = ?');
        
        $query->execute([$nombre, $informacion, $id]);
        
        
    }

    function obtenerRegion($id){
        //2-Enviar la consulta (preparar y ejecutar)
         $query = $this->db->prepare('SELECT * FROM region WHERE id=?');
         $query->execute([$id]);
 
         //3-procesar la respuesta para generar html
         $region = $query->fetch(PDO::FETCH_OBJ);
         //4- cerrar la conexion (PDO lo hace solo)
         return $region;
      
     }

    
};