<?php
class UsuarioModel{
    
    private $db;
  
    function __construct(){
       $this->db= $this-> conectar();
    }

    private function conectar(){
        //1- Abro la conexion
        $db = new PDO('mysql:host=localhost;'.'dbname=db_agenciaviajes;charset=utf8', 'root', '');
        return $db;
    }

    /*Devuelve el usuario*/
    function obtenerEmail($email){
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE email = (?)');

        $query->execute([$email]);

        return $query->fetch(PDO::FETCH_OBJ);

    }

    function obtenerUsuarios(){

        $query = $this->db->prepare('SELECT * FROM  usuarios');

        $query->execute();

        $usuarios=$query->fetchAll(PDO::FETCH_OBJ);

        return $usuarios;

    }

    function insertarUsuario($email,$password,$permiso){

        $query=$this->db->prepare ("INSERT INTO usuarios (email, password,permiso) VALUES(?,?,?)");

        $query->execute([$email,$password,$permiso]);

        return $this->db->lastInsertId();

    }

    function detalleUsuario($id){

        $query=$this->db->prepare('SELECT * FROM usuarios WHERE id = ?');
        $query->execute([$id]);

        $usuario=$query->fetch(PDO::FETCH_OBJ);

        return $usuario;

    }

    function actualizarUsuario($email,$password,$permiso,$id){

        $query = $this->db->prepare('UPDATE usuarios SET email = ?, password = ?, permiso= ? WHERE id = ?');
        
        $query->execute([$email, $password,$permiso,$id]);

    }

}