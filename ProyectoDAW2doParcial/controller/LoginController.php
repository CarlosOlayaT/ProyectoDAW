<?php
require_once 'model/DTO/User.php';
require_once 'model/DAO/UserDAO.php';

class LoginController
{

    public function index()
    {
        require_once 'view/loginView.php';
    }

    public function autenticar()
    {
        session_start();

        $usuario = trim($_POST['usuario'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($usuario === '' || $password === '') {
            $error = "Campos obligatorios";
            require 'view/loginView.php';
            return;
        }

        // Validaciones mínimas (opcional pero pro)
        if (strlen($usuario) > 50 || strlen($password) > 255) {
            $error = "Datos inválidos";
            require 'view/loginView.php';
            return;
        }

        $dao = new UserDAO();
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
