<?php
class Menu
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

    public function obtenerMenusPorRol($rol)
    {

        $sql = "SELECT m.nombre, m.icono
                FROM menus m
                JOIN menu_roles mr ON m.id = mr.menu_id
                JOIN roles r ON mr.rol_id = r.id
                WHERE r.nombre = ?
                AND m.estado = 1
                ORDER BY m.orden";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $rol);
        $stmt->execute();

        return $stmt->get_result();
    }
}
