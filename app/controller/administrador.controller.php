<?php
include_once 'app/view/administrador.view.php';
include_once 'app/helpers/auth.helper.php';

class AdministradorController{
    
    private $view;
    private $authHelper;

    function __construct(){
       
        $this->view = new AdministradorView();

        $this->authHelper = new AuthHelper();

        $this->authHelper->chequearAdmin();
    }
        
    function mostrar(){

        $this->view-> mostrarBotones();

    }
     
}