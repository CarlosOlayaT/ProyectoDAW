<?php
require_once 'config/Conexion.php';
require_once 'model/DTO/Menu.php';

class MenuDAO
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::getConexion();
    }


    public function GetMenuforRol($rol): ?array
    {
        try {

            $sql = "SELECT m.id,m.nombre, m.icono, m.controlador, m.funcion
                    FROM menus m
                    JOIN menu_roles mr ON m.id = mr.menu_id
                    JOIN roles r ON mr.rol_id = r.id
                    WHERE r.nombre = ?
                    AND m.estado = 1
                    ORDER BY m.orden";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindparam(1, $rol, PDO::PARAM_STR);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            $menus = [];
            foreach ($rows as $row) {
                $menu = new Menu();
                $menu->setId($row["id"]);
                $menu->setNombre($row["nombre"]);
                $menu->setControlador($row["controlador"]);
                $menu->setFuncion($row["funcion"]);
                $menu->setIcono($row["icono"]);
                $menus[] = $menu;
            }
            return $menus;
        } catch (PDOException $e) {
            error_log("Error en obtenerMenusPorRol: " . $e->getMessage());
            return null;
        }
    }
}