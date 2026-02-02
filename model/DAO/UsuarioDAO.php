<?php
require_once 'model/DTO/Usuario.php';

class UsuarioDAO
{
    private $conexion;


    public function __construct()
    {
        $this->conexion = new mysqli(
            "localhost",
            DBUSER,
            DBPASSWORD,
            DBNAME
        );

        if ($this->conexion->connect_error) {
            die("Error de conexión");
        }
    }

    public function login($usuario, $password): ?Usuario
    {

        $sql = "SELECT u.ID, u.User, u.Nombres, u.Apellidos, u.FechaRegistro, u.Contrasenia, u.Rol_id, r.nombre AS rol
            FROM usuarios u
            JOIN roles r ON u.Rol_id = r.id
            WHERE u.User = ?
            AND u.Contrasenia = ?
            AND u.Estado = 1";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ss", $usuario, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            return null;
        }

        $dto = new Usuario();
        $dto->setId($row['ID']);
        $dto->setUsuario($row['User']);
        $dto->setNombre($row['Nombres']);
        $dto->setApellido($row['Apellidos']);
        $dto->setPassword($row['Contrasenia']);
        $dto->setRolId($row['Rol_id']);
        $dto->setRolNombre($row['rol']);
        $dto->setFechaRegistro($row['FechaRegistro']);

        return $dto;
    }
}