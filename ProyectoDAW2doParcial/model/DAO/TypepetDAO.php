<?php
require_once 'model/DTO/Typepet.php';
require_once 'config/Conexion.php';

//Autor: Cadena Herrera Samuel

class TypepetDAO
{
    private $conexion;


    public function __construct()
    {
        $this->conexion = Conexion::getConexion();
    }

    public function getTypes(): ?array
    {
        try {

            $sql = "SELECT 
                    Id ,
                    Nombre,
                    RutaIcono
                FROM 
                    tipomascotas
                WHERE 
                    Estado = 1";

            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll();

            $types = [];
            foreach ($rows as $row) {
                $tipo = new Typepet();
                $tipo->setNombre($row['Nombre']);
                $tipo->setRutaIcono($row['RutaIcono']);
                $tipo->setId($row['Id']);

                $types[] = $tipo;
            }


            return $types;
        } catch (PDOException $e) {
            error_log("Error en getTypes: " . $e->getMessage());
            return null;
        }
    }
}