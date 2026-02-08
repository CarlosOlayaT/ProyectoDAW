<?php
require_once 'model/DTO/User.php';
require_once 'config/Conexion.php';


class UserDAO
{
    private $conexion;


    public function __construct()
    {
        $this->conexion = Conexion::getConexion();
    }

    public function login(string $usuario, string $password): ?User
    {
        try {
            $sql = "
        SELECT 
            u.ID,
            u.User,
            u.Nombres,
            u.Apellidos,
            u.FechaRegistro,
            u.Contrasenia,
            u.Rol_id,
            r.nombre AS rol
        FROM usuarios u
        INNER JOIN roles r ON u.Rol_id = r.id
            WHERE u.User = ?
            AND u.Contrasenia = ?
            AND u.Estado = 1
        LIMIT 1
    ";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(1, $usuario, PDO::PARAM_STR);
            $stmt->bindValue(2, $password, PDO::PARAM_STR);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                return null;
            }


            $dto = new User();
            $dto->setId($row['ID']);
            $dto->setUsuario($row['User']);
            $dto->setNombre($row['Nombres']);
            $dto->setApellido($row['Apellidos']);
            $dto->setPassword($row['Contrasenia']); // hash
            $dto->setRolId($row['Rol_id']);
            $dto->setRolNombre($row['rol']);
            $dto->setFechaRegistro($row['FechaRegistro']);

            return $dto;
        } catch (PDOException $e) {
            error_log("Error en login: " . $e->getMessage());
            return null;
        }
    }
}