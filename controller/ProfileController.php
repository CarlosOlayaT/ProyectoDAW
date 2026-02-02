<?php
session_start();

class ProfileController
{

    public function index()
    {

        // datos del usuario (desde sesión)
        $rol = $_SESSION['rol'];
        $nombres = $_SESSION['nombres'];
        $apellidos = $_SESSION['apellidos'];


        // vista del cuerpo
        require_once 'view/ProfileView.php';
    }
}
