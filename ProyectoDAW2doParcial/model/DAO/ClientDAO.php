<?php
require_once 'config/Conexion.php';
require_once 'model/DTO/Client.php';

class ClientDAO
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::getConexion();
    }


    public function GetClients(): ?array
    {
        try {

            $sql = "SELECT 
                        c.Id as ClienteId,
                        c.Nombre,
                        c.Apellido,
                        c.Cedula,
                        c.Telefono,
                        c.Direccion,
                        c.Correo,
                        c.Estado,
                        c.FechaRegistro,
                        COUNT(m.Id) AS CantidadMascotas
                    FROM clientes c 
                    LEFT JOIN mascotas m ON c.Id = m.IdCliente 
                    WHERE c.Estado = 1  
                    GROUP BY 
                        c.Id,
                        c.Nombre,
                        c.Apellido,
                        c.Cedula,
                        c.Telefono,
                        c.Direccion,
                        c.Correo,
                        c.Estado,
                        c.FechaRegistro";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute();
            $rows = $stmt->fetchAll();
            $clients = [];

            foreach ($rows as $row) {
                $client = new Client();
                $client->setId((int) ($row["ClienteId"] ?? 0));
                $client->setNombres($row["Nombre"]);
                $client->setApellidos($row["Apellido"]);
                $client->setCedula($row["Cedula"]);
                $client->setTelefono($row["Telefono"]);
                $client->setDireccion($row["Direccion"]);
                $client->setCorreo($row["Correo"]);
                $client->setFechaRegistro(new DateTime($row["FechaRegistro"]));
                $client->setCantMascotas($row["CantidadMascotas"] ? $row["CantidadMascotas"] : 0);
                $clients[] = $client;
            }
            return $clients;
        } catch (PDOException $e) {
            throw new Exception("Error en GetClients: " . $e->getMessage());
        }
    }
    public function searchCustomer(string $value): ?array
    {
        try {

            $sql = "SELECT 
                        c.Id AS ClienteId,
                        c.Nombre,
                        c.Apellido,
                        c.Cedula,
                        c.Telefono,
                        c.Direccion,
                        c.Correo,
                        c.Estado,
                        c.FechaRegistro,
                        COUNT(m.Id) AS CantidadMascotas
                    FROM clientes c
                    LEFT JOIN mascotas m 
                        ON c.Id = m.IdCliente
                    WHERE 
                        c.Estado = 1
                        AND (
                            c.Id LIKE ?
                            OR c.Cedula LIKE ?
                            OR c.Nombre LIKE ?
                            OR c.Apellido LIKE ?
                        )
                    GROUP BY 
                        c.Id,
                        c.Nombre,
                        c.Apellido,
                        c.Cedula,
                        c.Telefono,
                        c.Direccion,
                        c.Correo,
                        c.Estado,
                        c.FechaRegistro
                    ORDER BY c.Id DESC";
            $like = "%$value%";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindparam(1, $value, PDO::PARAM_STR);
            $stmt->bindparam(2, $like, PDO::PARAM_STR);
            $stmt->bindparam(3, $like, PDO::PARAM_STR);
            $stmt->bindparam(4, $like, PDO::PARAM_STR);


            $stmt->execute();
            $rows = $stmt->fetchAll();
            $clients = [];

            foreach ($rows as $row) {
                $client = new Client();
                $client->setId((int) ($row["ClienteId"] ?? 0));
                $client->setNombres($row["Nombre"]);
                $client->setApellidos($row["Apellido"]);
                $client->setCedula($row["Cedula"]);
                $client->setTelefono($row["Telefono"]);
                $client->setDireccion($row["Direccion"]);
                $client->setCorreo($row["Correo"]);
                $client->setFechaRegistro(new DateTime($row["FechaRegistro"]));
                $client->setCantMascotas($row["CantidadMascotas"] ? $row["CantidadMascotas"] : 0);
                $clients[] = $client;
            }
            return $clients;
        } catch (PDOException $e) {
            throw new Exception("Error en searchCustomer: " . $e->getMessage());
        }
    }
    public function GetClientById($id): ?Client
    {
        try {

            $sql = "SELECT 
                        Id as ClienteId,
                        Nombre,
                        Apellido,
                        Cedula,
                        Telefono,
                        Direccion,
                        Correo,
                        Estado,
                        FechaRegistro
                    FROM clientes 
                    WHERE Estado = 1 AND Id =?";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);

            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $client = new Client();
            $client->setId((int) ($row["ClienteId"] ?? 0));
            $client->setNombres($row["Nombre"]);
            $client->setApellidos($row["Apellido"]);
            $client->setCedula($row["Cedula"]);
            $client->setTelefono($row["Telefono"]);
            $client->setDireccion($row["Direccion"]);
            $client->setCorreo($row["Correo"]);
            $client->setFechaRegistro(new DateTime($row["FechaRegistro"]));

            return $client;
        } catch (PDOException $e) {
            throw new Exception("Error en GetClients: " . $e->getMessage());
        }
    }

    public function InsertClient(Client $client): bool
    {
        try {
            $sql = "INSERT INTO clientes 
                (Nombre, Apellido, Correo, Cedula, Telefono, Direccion)
                VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(1, $client->getNombres(), PDO::PARAM_STR);
            $stmt->bindValue(2, $client->getApellidos(), PDO::PARAM_STR);
            $stmt->bindValue(3, $client->getCorreo(), PDO::PARAM_STR);
            $stmt->bindValue(4, $client->getCedula(), PDO::PARAM_STR);
            $stmt->bindValue(5, $client->getTelefono(), PDO::PARAM_STR);
            $stmt->bindValue(6, $client->getDireccion(), PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error en InsertClient: " . $e->getMessage());
        }
    }
    public function updateClient(Client $client): bool
    {
        try {
            $sql = "UPDATE clientes SET
                    Nombre = ?,
                    Apellido = ?,
                    Cedula = ?,
                    Telefono = ?,
                    Direccion = ?,
                    Correo = ?
                WHERE Id = ?";

            $stmt = $this->conexion->prepare($sql);

            $stmt->bindValue(1, $client->getNombres(), PDO::PARAM_STR);
            $stmt->bindValue(2, $client->getApellidos(), PDO::PARAM_STR);
            $stmt->bindValue(3, $client->getCedula(), PDO::PARAM_STR);
            $stmt->bindValue(4, $client->getTelefono(), PDO::PARAM_STR);
            $stmt->bindValue(5, $client->getDireccion(), PDO::PARAM_STR);
            $stmt->bindValue(6, $client->getCorreo(), PDO::PARAM_STR);
            $stmt->bindValue(7, $client->getId(), PDO::PARAM_INT);

            return $stmt->execute();

        } catch (PDOException $e) {
            throw new Exception("Error updateClient: " . $e->getMessage());
        }
    }

    public function DeleteClient($id)
    {
        try {
            $sql = "UPDATE clientes SET
                        Estado = 0
                    WHERE Id = ?";

            $stmt = $this->conexion->prepare($sql);

            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            return $stmt->execute();

        } catch (PDOException $e) {
            throw new Exception("Error DeleteClient: " . $e->getMessage());
        }
    }

}
