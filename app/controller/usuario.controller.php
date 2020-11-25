<?php
include_once 'app/view/usuario.view.php';
include_once 'app/model/usuario.model.php';


class UsuarioController{

    private $model;
    private $view;

    function __construct(){
        
        $this->model = new UsuarioModel();
       
        $this->view = new UsuarioView();
        
    }

    function mostrarUsuarios(){

        $usuarios=$this->model->obtenerUsuarios();

        $this->view->mostrarUsuarios($usuarios);

    }

    function mostrarRegistro(){

        $this->view->mostrarRegistro();

    }

    function agregarUsuario(){

        $email=$_POST['email'];
      
        $password=$_POST['password'];

        $permiso = 0;
        

        if( empty ($email) || empty ($password)){
            $usuario=$this->model->obtenerUsuarios();
            $this->view->mostrarRegistro($usuario,'Faltan ingresar datos');
            die();
        }

        $controlarEmail=$this->model->obtenerEmail($email);//controla que no este el mismo nombre
        if(empty($controlarEmail)){

            $password=password_hash($password, PASSWORD_DEFAULT);

        
            $this->model->insertarUsuario($email, $password,$permiso);
                
            $this->view->mostrarRegistro('Gracias por registrarse');
            
        }
        else{
            $this->view->mostrarRegistro('El usuario ya existe');
        }
    }

    function actualizarContraseña($id){


        $usuario=$this->model->detalleUsuario($id);
        
        $this->view-> mostrarRegistro($usuario);


    }

    function olvideContraseña(){

        $id=$_POST['id'];
        $email = $_POST['email'];
        $password = $_POST['contraseña'];
        $permiso = 0;

        if( empty ($email) || empty ($password)){
            $this->view->mostrarRegistro('Faltan ingresar datos');
            die();
        }
      
        
        $this->model->actualizarUsuario($email, $password, $permiso,$id);
        
        header("Location: " . BASE_URL . "iniciar");



    }

}