<?php

include_once 'app/controller/region.controller.php';
include_once 'app/controller/tour.controller.php';
include_once 'app/controller/auth.controller.php';
include_once 'app/controller/adminRegion.controller.php';
include_once 'app/controller/adminTour.controller.php';
include_once 'app/controller/administrador.controller.php';
include_once 'app/controller/usuario.controller.php';
include_once 'app/api/api-comments.controller.php';


// defino la base url para la construccion de links con urls semánticas
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// lee la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home'; // acción por defecto si no envían
}

// parsea la accion Ej: suma/1/2 --> ['suma', 1, 2]
$params = explode('/', $action);

// determina que camino seguir según la acción
switch ($params[0]) {
    case 'iniciar':
        $controller= new AuthController();
        $controller->mostrarLogin();
    break;
    case 'verify':
        $controller= new AuthController();
        $controller->iniciarSesion();
    break;
    case 'cerrar':
        $controller = new AuthController();
        $controller->cerrarSesion();
        break;    
    case 'registrar':
        $controller = new UsuarioController();
        $controller->mostrarRegistro();
        break;  
    case 'verificarRegistro':
        $controller = new UsuarioController();
        $controller->agregarUsuario();
        $controller->olvideContraseña();//cambiarnombre
        break;  
    case 'home':
        $controller = new RegionController();
        $controller->mostrarRegion();
    break;
    case 'region':
        if (isset($params[1])){
            $id=$params[1];
            $controller =new TourController();
            $controller->mostrarTour($id);}
    break;  
    case 'mostrar':
        $controller =new AdministradorController();
        $controller->mostrar();
    break; 
    case 'verDetalle':
        if (isset($params[1])){
            $id=$params[1];
        $controller =new TourController();
        $controller->detalleUnTour($id);}
    break; 
    case 'insertarTour':
        $controller =new AdminTourController();
        $controller->insertarTour();
    break;  
    case 'administrador':
        $controller = new AdminRegionController();
        $controller->mostrarTabla();
    break;
    case 'adminTour':
        $controller = new AdminTourController();
        $controller->mostrarTabla();
    break;
    case 'InsertarRegion':
        $controller =new AdminRegionController();
        $controller->insertarRegion();
    break;  
    case 'eliminarRegion':
        
        $controller =new AdminRegionController();
        $id=$params[1];
        $controller->eliminarRegion($id);
    break;  
    case 'actualizarRegion':
        $controller =new AdminRegionController();
        $id=$params[1];
        $controller->actualizarRegion($id);
    break;  
    case 'ActulizarRegion':
        $controller =new AdminRegionController();
        $controller->actualizar();
    break;  
    case 'actualizarTour':
        $controller =new AdminTourController();
        $id=$params[1];
        $controller->actualizarTour($id);
    break;  
    case 'ActualizarTour':
        $controller =new AdminTourController();
        $controller->actualizar();
    break;     
    case 'eliminarTour':
        if (isset($params[1]))
        $id=$params[1];
        $controller =new AdminTourController();
        $controller->eliminarTour($id);
    break;  
    case 'adminUsuarios':
        $controller =new UsuarioController();
        $controller->mostrarUsuarios();
    break; 
    
    default:
        echo('404 Page not found');
        break;
}