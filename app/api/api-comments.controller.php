<?php
require_once 'app/model/comentario.model.php';
require_once 'app/api/api.view.php';

class ApiCommentsController{

    private $model;

    private $view;

    function __construct(){

        $this->model = new ApiModel();

        $this->view = new ApiView();

        $this->data= file_get_contents('php://input');
        
    }

    function getData(){

        return json_decode($this->data);

    }

    function getAll(){//FUNCIONA

        $comentarios=$this->model->getAll();
       
        $this->view->response($comentarios,200);


   
    }

    function get($params=null){
        //el router me manda un arreglo asociativo de parametros llamado $params, null por si no lo uso
        $id=$params[':ID'];

        $comentario = $this->model->get($id);
     
        //PARA VER SI EXISTE EL COMENTARIO, SINO 404 NOT FOUND
        if ($comentario){
            $this->view->response($comentario, 200);
        }else{
            $this->view->response("El comentario con el id = $id no existe", 404);
        }
    }

    function delete($params=null){

        $idComments= $params[':ID'];

        $success=$this->model->remove($idComments);

        if($success){

            $this->view->response('El comentario se elimino exictosamente',200);

        }
        else{

            $this->view->response("Error al obtener el comentario id = $idComments, puede ser que no exista",404);

        }
    }

    function add($params=null){

        $body = $this->getData();

        $texto=$body->texto;

        $calificacion=$body->calificacion;

        $id_tour=$body->id_tour;
        
        $id=$this->model->insert($texto,$calificacion,$id_tour);

        if($id > 0){

            $this->view->response('El comentario se inserto bien',200);

        }
        else{

            $this->view->response('Error al subir el comentario',500);
        }

    }

    function update($params=null){

        $idComments= $params[':ID'];

        $body = $this->getData();

        $texto=$body->texto;

        $calificacion=$body->calificacion;

        $id_tour=$body->id_tour;
        
        $success=$this->model->update($idComments,$texto,$calificacion,$id_tour);

        if($success){

            $this->view->response('El comentario se modifico bien',200);

        }
        else{

            $this->view->response('Error al subir la modificacion el comentario',500);
        }

    }


}