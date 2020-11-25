<?php

require_once('libs/Smarty.class.php');

class AdministradorView{

  function mostrarBotones(){

        $smarty=new smarty();


        $smarty->display('templates/administrador.tpl');
    }

  

}