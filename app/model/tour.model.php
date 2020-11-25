<?php

class TourModel{
    
    private $db;

    function __construct(){
       $this->db= $this-> conectar();
    }

    private function conectar(){
        $db = new PDO('mysql:host=localhost;'.'dbname=db_agenciaviajes;charset=utf8', 'root', '');
        return $db;
    }

    function obtenerTours(){

      
        $query=$this->db->prepare('SELECT * FROM tour');
        $query->execute();

        $tours=$query->fetchAll(PDO::FETCH_OBJ);

        return $tours;
    }

    function obtenerTour($id_region=null){

        $query=$this->db->prepare('SELECT t.*, r.nombre FROM `tour` t  JOIN region r ON t.id_region = r.id WHERE id_region = ?');
        /*$query=$this->db->prepare('SELECT * FROM tour WHERE id_region = ?');*/
        $query->execute([$id_region]);

        $tour=$query->fetchAll(PDO::FETCH_OBJ);

        return $tour;
    }

    function detalleTour($id){
        $query=$this->db->prepare('SELECT * FROM tour WHERE id = ?');
        $query->execute([$id]);

        $tour=$query->fetch(PDO::FETCH_OBJ);

        return $tour;

    }

    function insertarTour($destinos, $paquete,$itinerario,$precio,$id_region,$imagen=null){

        if($imagen){
            $query=$this->db->prepare('INSERT INTO tour (destinos, paquete, itinerario, precio, id_region, imagen) VALUES(?,?,?,?,?,?)');
            
            $params=[$destinos, $paquete,$itinerario,$precio,$id_region,$imagen];

        }
        else{
            $query=$this->db->prepare('INSERT INTO tour (destinos, paquete, itinerario, precio, id_region) VALUES(?,?,?,?,?)');
            
            $params=[$destinos, $paquete,$itinerario,$precio,$id_region];
            
        }

        $query->execute($params);

        return $this->db->lastInsertId();
    }   
    
    function borrarTour($id){

        $query=$this->db->prepare('DELETE FROM tour WHERE id =?');
        $query->execute([$id]);
    
    }

    function actualizarTour($destinos, $paquete,$itinerario,$precio,$id_region,$imagen=null,$id){

        if($imagen){
            $query = $this->db->prepare('UPDATE tour SET destinos=?, paquete = ?, itinerario = ?, precio = ?, id_region = ?, imagen = ? WHERE id=? ');
            $params=[$destinos, $paquete,$itinerario,$precio,$id_region,$imagen,$id];
        }
        else{

            $query = $this->db->prepare('UPDATE tour SET destinos=?, paquete = ?, itinerario = ?, precio = ?, id_region = ? WHERE id=? ');
            $params=[$destinos, $paquete,$itinerario,$precio,$id_region,$id];
        }

        $query->execute($params);
        
    }

    function contarTours($id){//SIEMPRE DEVUELVE UN OBJETO

        $query=$this->db->prepare('SELECT COUNT(*) AS tour FROM tour WHERE id = ?');
        $query->execute([$id]);

        $tour=$query->fetch(PDO::FETCH_OBJ);

        return $tour;

    } 

    function paginacion(){

        $query=$this->db->prepare('SELECT * FROM tour LIMIT 0 , 3');
        $query->execute();

        $tours=$query->fetchAll(PDO::FETCH_OBJ);

        return $tours;

    }
}
