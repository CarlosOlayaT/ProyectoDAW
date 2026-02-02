<?php
<<<<<<< HEAD
require_once 'model/Menu.php';
=======
require_once 'model/DTO/Menu.php';
>>>>>>> 217f547de6f1b89aabf41f733ba1805816ab3a20

class IndexController
{

<<<<<<< HEAD
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
=======

    public function index()
    {

        $content = 'view/homeView.php';
        require_once 'view/layout.php';






        // Logueado => dashboard
>>>>>>> 217f547de6f1b89aabf41f733ba1805816ab3a20
    }
}
