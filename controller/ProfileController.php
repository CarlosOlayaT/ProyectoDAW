<?php
session_start();

class ProfileController
{

    public function index()
    {

        // datos del usuario (desde sesión)
        $rol = $_SESSION['rol'];
        $user = $_SESSION['usuario'];

        // vista del cuerpo
        require_once 'view/profile/profile.php';
    }
}
