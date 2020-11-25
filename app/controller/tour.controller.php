<?php
include_once 'app/view/tour.view.php';
include_once 'app/model/tour.model.php';
include_once 'app/helpers/auth.helper.php';

class TourController{
    private $model;
    private $view;
    

    function __construct(){
        
        $this->model = new TourModel();
       
        $this->view = new TourView();
        session_start();
        
    }

    function mostrarTour($id){
        
        $tour = $this->model-> obtenerTour($id);
       
        $this->view-> mostrarTours($tour);

    }

    function detalleUnTour($id){

        $tour = $this->model->detalleTour($id);
       
        $this->view->mostrarUnTours($tour);

                
}

    function paginacion($id){

        $cant_Xpag=3;

        $cant_tours=$this->model->contarTours($id);/*traigo los comentarios contados*/

        $paginas=ceil($cant_tours/$cant_Xpag);/*calculo la cantidad de paginas*/

        /*ceil redondea la cantidad de paginas*/

        $tour=$this->model->obtenerTour($id);/*traigo los comentarios de cada tour*/

        $paginacion=$this->model->paginacion();

        for($i=1;$i<=$paginas;$i++){

            $this->view->mostrarComentario($tour);

        }
    }
     
}