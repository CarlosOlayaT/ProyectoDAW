<?php
require_once 'model/Menu.php';

class IndexController
{

    public function index()
    {
        session_start();

        // NO logueado => login
        if (!isset($_SESSION['rol'])) {
            require_once 'view/loginView.php';
            return;
        }

        //  preparar datos
        $menuModel = new Menu();
        $menus = $menuModel->obtenerMenusPorRol($_SESSION['rol']);
        $rol = $_SESSION['rol'];
        $user = $_SESSION['usuario'];

        // Logueado => dashboard
        require_once 'view/homeView.php';
    }
}
