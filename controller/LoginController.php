<?php
require_once 'model/Usuario.php';

class LoginController
{

    public function index()
    {
        require_once 'view/loginView.php';
    }

    public function autenticar()
    {
        session_start();

        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        $model = new Usuario();
        $user = $model->login($usuario, $password);

        if ($user) {
            $_SESSION['usuario'] = $user['NombreCompleto'];
            $_SESSION['rol'] = $user['rol'];



            header("Location: index.php");
        } else {
            echo "Usuario o contraseña incorrectos";
        }
    }

    public function logout()
    {
        session_start();

        // Limpiar variables de sesión
        $_SESSION = [];

        // Destruir la sesión
        session_destroy();

        // Volver a la página principal
        header("Location: index.php");
        exit;
    }
}
