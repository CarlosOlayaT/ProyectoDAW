<?php
require_once 'model/DTO/Client.php';
require_once 'model/DAO/ClientDAO.php';

/* autor: David Israel Sayay Quito */

class CustomerController
{

    public function index()
    {

        $clientsModel = new ClientDAO();

        $clients = $clientsModel->GetClients();

        $content = 'view/CustomerView.php';
        require_once 'view/layout.php';

    }

    public function CutomerCreate()
    {


        require_once 'view/CustomerCreateView.php';

    }


    public function CustomerEdit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "Cliente no encontrado";
            return;
        }
        $clientModel = new ClientDAO();
        $client = $clientModel->GetClientById($id);
        require_once 'view/CustomerEditView.php';

    }



    public function CrearCliente()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception("Método no permitido");
            }

            $nombre = trim(filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS));
            $apellido = trim(filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS));
            $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
            $cedula = trim(filter_input(INPUT_POST, 'cedula', FILTER_SANITIZE_SPECIAL_CHARS));
            $telefono = trim(filter_input(INPUT_POST, 'number', FILTER_SANITIZE_SPECIAL_CHARS));
            $direccion = trim(filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_SPECIAL_CHARS));

            $client = new Client();
            $client->setNombres($nombre);
            $client->setApellidos($apellido);
            $client->setCorreo($email ? $email : null);
            $client->setCedula($cedula);
            $client->setTelefono($telefono ? $telefono : null);
            $client->setDireccion($direccion ? $direccion : null);

            $dao = new ClientDAO();
            $result = $dao->InsertClient($client);
            if ($result) {
                echo "<script>alert('Cliente guardado con éxito'); window.location.href='index.php?c=Customer';</script>";
            } else {
                throw new Exception("Error al insertar en la base de datos");
            }

        } catch (Exception $e) {
            echo "<script>alert('Hubo un error al guardar un cliente: '" . $e->getMessage() . "); window.history.back();</script>";
        }
    }
    public function EditarCliente()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception("Método no permitido");
            }

            // 🔹 SANITIZACIÓN
            $id = filter_input(INPUT_POST, 'IdCliente', FILTER_VALIDATE_INT);
            $nombre = trim(filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS));
            $apellido = trim(filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS));
            $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
            $cedula = trim(filter_input(INPUT_POST, 'cedula', FILTER_SANITIZE_SPECIAL_CHARS));
            $telefono = trim(filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_SPECIAL_CHARS));
            $direccion = trim(filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_SPECIAL_CHARS));

            // 🔹 VALIDACIONES
            if (!$id) {
                throw new Exception("ID inválido");
            }

            if ($nombre === '' || $apellido === '') {
                throw new Exception("Nombre y apellido son obligatorios");
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Correo electrónico inválido");
            }

            if (strlen($cedula) < 10) {
                throw new Exception("Cédula inválida");
            }

            $client = new Client();
            $client->setId($id);
            $client->setNombres($nombre);
            $client->setApellidos($apellido);
            $client->setCorreo($email);
            $client->setCedula($cedula);
            $client->setTelefono($telefono);
            $client->setDireccion($direccion);

            $dao = new ClientDAO();
            $result = $dao->updateClient($client);
            if ($result) {
                echo "<script>alert('Cliente guardado con éxito'); window.location.href='index.php?c=Customer';</script>";
            } else {
                throw new Exception("Error al insertar en la base de datos");
            }

        } catch (Exception $e) {
            echo "<script>alert('Hubo un error al guardar un cliente: '" . $e->getMessage() . "); window.history.back();</script>";
        }
    }

    public function EliminarCliente()
    {
        try {

            $id = $_GET['id'] ?? null;
            if (!$id) {
                echo "Cliente no encontrado";
                return;
            }
            $clientModel = new ClientDAO();
            $result = $clientModel->DeleteClient($id);
            if ($result) {
                echo "<script>alert('Cliente eliminado con éxito'); window.location.href='index.php?c=Customer';</script>";
            } else {
                throw new Exception("Error al eliminar en la base de datos");
            }

        } catch (Exception $e) {
            echo "<script>alert('Hubo un error al eliminar un cliente: '" . $e->getMessage() . "); window.history.back();</script>";
        }
    }

}