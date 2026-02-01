<?php
class Usuario
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

    public function login($usuario, $password)
    {

        $sql = "SELECT u.ID, u.NombreCompleto, r.nombre AS rol
            FROM usuarios u
            JOIN roles r ON u.Rol_id = r.id
            WHERE u.User = ?
            AND u.Contrasenia = ?
            AND u.Estado = 1";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ss", $usuario, $password);
        $stmt->execute();

        $resultado = $stmt->get_result();

        return $resultado->fetch_assoc(); // solo uno
    }
}
