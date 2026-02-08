<?php
require_once 'model/DTO/Pet.php';
require_once 'model/DTO/Typepet.php';
require_once 'model/DTO/Client.php';
require_once 'config/Conexion.php';

//Autor: Cadena Herrera Samuel


class PetDAO
{
    private $conexion;


    public function __construct()
    {
        $this->conexion = Conexion::getConexion();
    }

    public function InsertPet($pet): bool
    {
        try {
            $sql = ' INSERT INTO
                mascotas(Nombre, Tipo, Raza, FechaNacimiento, Peso, IdCliente,Sexo, Especie, Observaciones)
                VALUES
                (?,?,?,?,?,?,?,?,?)';
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(1, $pet->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(2, $pet->getTipo()->getId(), PDO::PARAM_INT);
            $stmt->bindValue(3, $pet->getRaza(), PDO::PARAM_STR);
            $stmt->bindValue(4, $pet->getFechaNacimiento()->format('Y-m-d'), PDO::PARAM_STR);
            $stmt->bindValue(5, $pet->getPeso(), PDO::PARAM_STR); // PDO no tiene PARAM_FLOAT, se usa STR o el valor directo
            $stmt->bindValue(6, $pet->getIdCliente()->getId(), PDO::PARAM_INT);
            $stmt->bindValue(7, $pet->getSexo(), PDO::PARAM_STR);
            $stmt->bindValue(8, $pet->getEspecie(), PDO::PARAM_STR);
            $stmt->bindValue(9, $pet->getObservaciones(), PDO::PARAM_STR);

            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Error en InsertPet: " . $e->getMessage());
            return false;
        }

    }
    public function GetPetsAndClients(): ?array
    {
        try {
            $sql = "SELECT 
                M.Id AS IdMascota,
                M.Nombre AS NombreMascota,
                TM.Nombre AS TipoMascota,
                TM.RutaIcono AS ImagenTipoMascota,
                M.Especie,
                M.Raza,
                M.Peso,
                M.Sexo,
                YEAR(CURDATE()) - YEAR(M.FechaNacimiento)
                - CASE
                    WHEN DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(M.FechaNacimiento, '%m%d')
                    THEN 1
                    ELSE 0
                END AS Edad,
                M.FechaRegistro,
                M.Observaciones,
                C.Id AS IdCliente,
                C.Nombre AS NombreDuenio,
                C.Apellido AS ApellidoDuenio
            FROM 
                mascotas M
            INNER JOIN 
                clientes C ON M.IdCliente = C.Id
            INNER JOIN
                tipomascotas TM ON M.Tipo = TM.Id
            WHERE 
                M.Estado = 1 AND C.Estado = 1 AND TM.Estado = 1";

            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll();

            $pets = [];
            foreach ($rows as $row) {
                $pet = new Pet();
                $pet->setId($row['IdMascota']);
                $pet->setNombre($row['NombreMascota']);
                $tipo = new Typepet();
                $tipo->setNombre($row['TipoMascota']);
                $tipo->setRutaIcono($row['ImagenTipoMascota']);

                $pet->setTipo($tipo);
                $pet->setEspecie($row['Especie']);
                $pet->setEdad($row['Edad']);
                $client = new Client();
                $client->setId($row['IdCliente']);
                $client->setNombres($row['NombreDuenio']);
                $client->setApellidos($row['ApellidoDuenio']);

                $pet->setIdCliente($client);

                $pet->setNombre($row['NombreMascota']);
                $pet->setPeso($row['Peso']);
                $pet->setRaza($row['Raza']);
                $pet->setSexo($row['Sexo']);
                $pet->setObservaciones(!empty($row['Observaciones']) ? $row['Observaciones'] : '');

                $pets[] = $pet;
            }
        } catch (PDOException $e) {
            error_log("Error en GetPetsAndClients: " . $e->getMessage());
            return null;
        }

        return $pets;
    }
    public function getLastPets(int $limit = 5): ?array
    {
        try {
            $sql = "SELECT 
                M.Id AS IdMascota,
                M.Nombre AS NombreMascota,
                TM.Nombre AS TipoMascota,
                TM.RutaIcono AS ImagenTipoMascota,
                M.Especie,
                M.Raza,
                M.Peso,
                M.Sexo,
                YEAR(CURDATE()) - YEAR(M.FechaNacimiento)
                - CASE
                    WHEN DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(M.FechaNacimiento, '%m%d')
                    THEN 1
                    ELSE 0
                END AS Edad,
                M.FechaRegistro,
                M.Observaciones,
                C.Id AS IdCliente,
                C.Nombre AS NombreDuenio,
                C.Apellido AS ApellidoDuenio
            FROM 
                mascotas M
            INNER JOIN 
                clientes C ON M.IdCliente = C.Id
            INNER JOIN
                tipomascotas TM ON M.Tipo = TM.Id
            WHERE 
                M.Estado = 1 AND C.Estado = 1 AND TM.Estado = 1
            ORDER BY M.Id DESC
            LIMIT ?";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(1, $limit, PDO::PARAM_INT);
            $stmt->execute();

            $rows = $stmt->fetchAll();

            $pets = [];
            foreach ($rows as $row) {
                $pet = new Pet();
                $pet->setId($row['IdMascota']);
                $pet->setNombre($row['NombreMascota']);
                $tipo = new Typepet();
                $tipo->setNombre($row['TipoMascota']);
                $tipo->setRutaIcono($row['ImagenTipoMascota']);

                $pet->setTipo($tipo);
                $pet->setEspecie($row['Especie']);
                $pet->setEdad($row['Edad']);
                $client = new Client();
                $client->setId($row['IdCliente']);
                $client->setNombres($row['NombreDuenio']);
                $client->setApellidos($row['ApellidoDuenio']);

                $pet->setIdCliente($client);
                $pet->setPeso($row['Peso']);
                $pet->setRaza($row['Raza']);
                $pet->setSexo($row['Sexo']);
                $pet->setObservaciones(!empty($row['Observaciones']) ? $row['Observaciones'] : '');

                $pets[] = $pet;
            }
            return $pets;

        } catch (PDOException $e) {
            error_log("Error en GetLastPets: " . $e->getMessage());
            return null;
        }
    }

    public function DeletePet($id)
    {
        try {

            $sql = "UPDATE mascotas SET Estado = 0 WHERE Id=?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            return $stmt->execute();


        } catch (PDOException $e) {
            error_log("Error en InsertPet: " . $e->getMessage());
            return false;
        }
    }
    public function DeleteVacuna($id)
    {
        try {

            $sql = "UPDATE vacunas SET Estado = 0 WHERE Id=?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            return $stmt->execute();


        } catch (PDOException $e) {
            error_log("Error en DeleteVacuna: " . $e->getMessage());
            return false;
        }
    }
    public function DeleteCarta($id)
    {
        try {

            $sql = "UPDATE historialmedico SET Estado = 0 WHERE Id=?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            return $stmt->execute();


        } catch (PDOException $e) {
            error_log("Error en DeleteCarta: " . $e->getMessage());
            return false;
        }
    }
    public function UpdateFichaPet(Pet $pet)
    {
        try {
            $sql = "UPDATE mascotas
            SET 
                Nombre = ?,
                Tipo = ?,
                Observaciones = ?,
                IdCliente=?
            WHERE Id = ?";

            $stmt = $this->conexion->prepare($sql);

            // Asignar valores
            $stmt->bindValue(1, $pet->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(2, $pet->getTipo()->getId(), PDO::PARAM_INT);
            $stmt->bindValue(3, $pet->getObservaciones(), PDO::PARAM_STR);
            $stmt->bindValue(4, $pet->getIdCliente()->getId(), PDO::PARAM_INT);
            $stmt->bindValue(5, $pet->getId(), PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en InsertPet: " . $e->getMessage());
            return false;
        }
    }
    public function searchPets(string $value): ?array
    {
        try {
            $sql = "SELECT  
                        M.Id AS IdMascota,
                        M.Nombre AS NombreMascota,
                        TM.Nombre AS TipoMascota,
                        TM.RutaIcono AS ImagenTipoMascota,
                        M.Especie,
                        M.Raza,
                        M.Peso,
                        M.Sexo,
                        YEAR(CURDATE()) - YEAR(M.FechaNacimiento)
                        - CASE
                            WHEN DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(M.FechaNacimiento, '%m%d')
                            THEN 1
                            ELSE 0
                        END AS Edad,
                        M.FechaRegistro,
                        M.Observaciones,
                        C.Id AS IdCliente,
                        C.Nombre AS NombreDuenio,
                        C.Apellido AS ApellidoDuenio
                    FROM 
                        mascotas M
                    INNER JOIN 
                        clientes C ON M.IdCliente = C.Id
                    INNER JOIN
                        tipomascotas TM ON M.Tipo = TM.Id
                    WHERE 
                        M.Estado = 1 AND C.Estado = 1 AND TM.Estado = 1
                        AND (
                            M.Id LIKE ?
                            OR M.Nombre LIKE ?
                            OR M.Raza LIKE ?
                            OR CONCAT(C.Nombre,' ',C.Apellido) LIKE ?
                        )
                    ORDER BY M.Id DESC";

            $like = "%$value%";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindparam(1, $like, PDO::PARAM_STR);
            $stmt->bindparam(2, $like, PDO::PARAM_STR);
            $stmt->bindparam(3, $like, PDO::PARAM_STR);
            $stmt->bindparam(4, $like, PDO::PARAM_STR);
            $stmt->execute();

            $rows = $stmt->fetchAll();
            $data = [];

            foreach ($rows as $row) {
                $data[] = [
                    'id' => $row['IdMascota'],
                    'nombre' => $row['NombreMascota'],
                    'especie' => $row['Especie'],
                    'raza' => $row['Raza'],
                    'sexo' => $row['Sexo'],
                    'peso' => $row['Peso'],
                    'edad' => $row['Edad'],
                    'dueno' => $row['NombreDuenio'] . ' ' . $row['ApellidoDuenio'],
                    'tipo' => [
                        'icono' => $row['ImagenTipoMascota'],
                        'nombre' => $row['TipoMascota']
                    ]
                ];
            }

            return $data;
        } catch (PDOException $e) {
            error_log("Error en searchPets: " . $e->getMessage());
            return null;
        }
    }
    public function getPetById(int $id): ?Pet
    {
        try {
            $sql = "SELECT 
        M.Id AS IdMascota,
        M.Nombre AS NombreMascota,
        Tm.Nombre AS Tipomascota,
        Tm.RutaIcono AS Icono,
        Tm.Id As IdTipo,
		M.Especie,
        M.Raza,
        M.Peso,
        YEAR(CURDATE()) - YEAR(M.FechaNacimiento)
                - CASE
                    WHEN DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(M.FechaNacimiento, '%m%d')
                    THEN 1
                    ELSE 0
                END AS Edad,
        M.Sexo,
        M.FechaRegistro,
        M.Etapa,
		M.Observaciones,
        C.Id AS IdCliente,
        C.Nombre AS NombreDuenio,
        C.Apellido AS ApellidoDuenio
    FROM 
        mascotas M
    INNER JOIN 
        clientes C ON M.IdCliente = C.Id
    INNER JOIN 
    	tipomascotas Tm on M.Tipo = Tm.Id
    WHERE 
        M.Estado = 1 AND C.Estado = 1 AND M.Id =?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindparam(1, $id, PDO::PARAM_INT);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                return null;
            }

            // 🔐 Verificación de contraseña

            $pet = new Pet();
            $pet->setId($row['IdMascota']);
            $pet->setNombre($row['NombreMascota']);
            $tipo = new Typepet();
            $tipo->setId($row['IdTipo']);
            $tipo->setNombre($row['Tipomascota']);
            $tipo->setRutaIcono($row['Icono']);
            $pet->setTipo($tipo);
            $pet->setEspecie($row['Especie']);
            $pet->setEdad($row['Edad']);
            $client = new Client();
            $client->setId($row['IdCliente']);
            $client->setNombres($row['NombreDuenio']);
            $client->setApellidos($row['ApellidoDuenio']);

            $pet->setIdCliente($client);
            $pet->setNombre($row['NombreMascota']);
            $pet->setPeso($row['Peso']);
            $pet->setRaza($row['Raza']);
            $pet->setSexo($row['Sexo']);
            $pet->setObservaciones(!empty($row['Observaciones']) ? $row['Observaciones'] : '');

            return $pet;
        } catch (PDOException $e) {
            error_log("Error en getPetById: " . $e->getMessage());
            return null;
        }
    }

}