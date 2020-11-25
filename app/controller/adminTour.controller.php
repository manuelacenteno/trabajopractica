<?php
include_once 'app/view/adminTour.view.php';
include_once 'app/model/tour.model.php';
include_once 'app/helpers/auth.helper.php';

class AdminTourController{

    private $model;
    private $view;
    private $authHelper;

    function __construct(){

        $this->model = new TourModel();
      
        $this->view = new AdminTourView();

        $this->authHelper = new AuthHelper();

        $this->authHelper->chequearLogin();

    }

    function mostrarTabla(){
        
        $tours = $this->model-> obtenerTours();
        
        $this->view->mostrarTablaTours($tours);
    }

    /**
     * Construye un nombre unico de archivo y ademas lo mueve a 
     * mi carpeta de imagenes
     */
    function uniqueSaveName($realName, $tempName) {
        
        $filePath = "img/" . uniqid("", true) . "." 
            . strtolower(pathinfo($realName, PATHINFO_EXTENSION));

        move_uploaded_file($tempName, $filePath);

        return $filePath;
    }

    function insertarTour(){
        
        $destinos=$_POST['destinos'];
        $paquete=$_POST['paquete'];
        $itinerario=$_POST['itinerario'];
        $precio=$_POST['precio'];
        $id_region=$_POST['id_region'];

        if( empty ($destinos) || empty ($paquete)|| empty ($itinerario)|| empty ($precio)|| empty ($id_region)){
            $tours = $this->model-> obtenerTours();
            $this->view->mostrarTablaTours($tours,'Faltan datos obligatorios');
            die();
        }
        // tiene que tener algun de estos formatos
        if($_FILES['input_name']['type'] == "image/jpg" || $_FILES['input_name']['type'] == "image/jpeg" || $_FILES['input_name']['type'] == "image/png" ){
            
            $imagen=$this->uniqueSaveName($_FILES['input_name']['name'], 
                                            $_FILES['input_name']['tmp_name']);

            $id=$this->model->insertarTour($destinos, $paquete,$itinerario,$precio,$id_region,$imagen);
        }
        else {//si no tengo imagen

        $id=$this->model->insertarTour($destinos, $paquete,$itinerario,$precio,$id_region);
        }

        header("location: " . BASE_URL . "adminTour");
    }

    function eliminarTour($id){

        $this->model->borrarTour($id);
        header("location: " . BASE_URL . "adminTour");
    }

    function actualizarTour ($id){
       
        $tour=$this->model->detalleTour($id);
        
        $this->view-> mostrarTour($tour);

    }

    function actualizar (){

        $destinos=$_POST['destinos'];
        $paquete=$_POST['paquete'];
        $itinerario=$_POST['itinerario'];
        $precio=$_POST['precio'];
        $id_region=$_POST['id_region'];
        $id = $_POST['id'];
        $imagen=$_POST['input_name'];
        

        if( empty ($destinos) || empty ($paquete)|| empty ($itinerario)|| empty ($precio)|| empty ($id_region)){
            $tour=$this->model->detalleTour($id);
            $this->view->mostrarTour($tour,'Faltan datos obligatorios');
            die();
        }

        
        if($_FILES['input_name']['type'] == "image/jpg" || $_FILES['input_name']['type'] == "image/jpeg" || $_FILES['input_name']['type'] == "image/png" ){
            
            $id=$this->model->actualizarTour($destinos, $paquete,$itinerario,$precio,$id_region,$imagen);
        }
        else {//si no tengo imagen

            $this->model->actualizarTour($destinos, $paquete, $itinerario,$precio,$id_region,$id);

        }
       
        header("Location: " . BASE_URL . "adminTour");
    }

   
}