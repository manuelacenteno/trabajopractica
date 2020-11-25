<?php
include_once 'app/view/adminRegion.view.php';
include_once 'app/model/region.model.php';
include_once 'app/helpers/auth.helper.php';


class AdminRegionController{

    private $model;
    private $view;
    private $authHelper;

    function __construct(){

        $this->model = new RegionModel();
        
        $this->view = new AdminRegionView();

        $this->authHelper = new AuthHelper();

        // verifico que el usuario esté logueado siempre
        
        $this->authHelper->chequearAdmin();

    }

    function mostrarTabla(){
        
        $regiones = $this->model-> obtenerRegiones();
        $this->view-> mostrarTablaRegiones($regiones);
    }
    
    function insertarRegion(){
        $nombre = $_POST['nombre'];
        $informacion = $_POST['informacion'];

        if(empty($nombre) || empty($informacion)){
            $regiones = $this->model-> obtenerRegiones();
            $this->view->mostrarTablaRegiones($regiones, "Faltan datos obligatorios");
            die();
        }

        $id = $this->model->insertarRegion($nombre, $informacion);
         // redirigimos al  la tabla
         header("Location: " . BASE_URL . "administrador"); 
    }
    
    function eliminarRegion($id){
        $this->model->eliminarRegion($id);
        header("Location: " . BASE_URL . "administrador");
    }

    function actualizarRegion ($id){
       
        $region=$this->model->obtenerRegion($id);
        
        $this->view-> mostrarRegion($region);
    }

    function actualizar (){
        $nombre = $_POST['nombre'];
        $informacion = $_POST['informacion'];
        $id = $_POST['id'];

        if(empty($nombre) || empty($informacion)){
            $region=$this->model->obtenerRegion($id);
            $this->view->mostrarRegion($region, "Faltan datos obligatorios");
            die();
        }
      
        //necesito id para actualizar esa fila en particular//
        $this->model->actualizarRegion($nombre, $informacion, $id);
        
        header("Location: " . BASE_URL . "administrador");
    }
    
}