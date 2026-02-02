<?php
require_once 'model/DTO/Usuario.php';
require_once 'model/DAO/UsuarioDAO.php';

class LoginController
{

    public function index()
    {
        require_once 'view/loginView.php';
    }

    public function autenticar()
    {
        session_start();

        $usuario = trim(strip_tags($_POST['usuario'] ?? ''));
        $password = trim(strip_tags($_POST['password'] ?? ''));

        if ($usuario === '' || $password === '') {
            $error = "Campos obligatorios";
            require 'view/loginView.php';
            return;
        }

        $dao = new UsuarioDAO();
        $user = $dao->login($usuario, $password);

        if (!$user) {
            $error = "Credenciales incorrectas";
            require 'view/loginView.php';
            return;
        }

        $_SESSION['nombres'] = $user->getNombre();
        $_SESSION['apellidos'] = $user->getApellido();
        $_SESSION['rol'] = $user->getRolNombre();
        $_SESSION['rol_id'] = $user->getRolId();

        header("Location: index.php");
        exit;
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
