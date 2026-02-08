<?php
require_once 'model/DTO/Quotes.php';
require_once 'model/DTO/Client.php';
require_once 'config/Conexion.php';

//Autor: Cadena Herrera Samuel


class QuotesDAO
{
    private $conexion;


    public function __construct()
    {
        $this->conexion = Conexion::getConexion();
    }
    public function getProxQuote(int $id): ?DateTime
    {
        try {
            $sql = "SELECT FechaCita
                        FROM Citas
                        WHERE IdMascota = ?
                        AND FechaCita >= CURDATE()
                        ORDER BY FechaCita ASC
                        LIMIT 1";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return null;
            }

            return new DateTime($result["FechaCita"]);
        } catch (PDOException $e) {
            throw new Exception("Error en getProxQuote: " . $e->getMessage());

        }
    }

    public function GetAllProxsQuotes(): array
    {
        try {
            $sql = "SELECT 
                        C.Id AS IdCita,
                        M.Id As IdMascota,
                        M.Nombre AS NombreMascota,
                        TM.Nombre AS TipoMascota,
                        TM.RutaIcono AS ImagenTipoMascota,
                        C.Etapa,
                        C.Detalles,
                        C.Tipo AS TipoCita, 
                        DATE(C.FechaCita) AS Fecha,        
                        TIME(C.FechaCita) AS Hora         
                    FROM 
                        mascotas M
                    INNER JOIN 
                        citas C ON M.Id = C.IdMascota     
                    INNER JOIN
                        tipomascotas TM ON M.Tipo = TM.Id
                    WHERE 
                        M.Estado = 1  
                        AND TM.Estado = 1 
                        AND C.Estado = 1
                        AND C.FechaCita >= NOW()          
                    ORDER BY 
                        C.FechaCita ASC";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);


        } catch (PDOException $e) {
            throw new Exception("Error en GetAllProxsQuotes: " . $e->getMessage());
        }

    }

    public function GetQuotesPet(int $id): ?array
    {
        try {
            $sql = "SELECT 
                        Id,
                        FechaCita,
                        Detalles
                    FROM citas
                    WHERE 
                        IdMascota = ?
                        AND Etapa = 'Pendiente'
                        AND DATE(FechaCita) > CURDATE()
                        AND Estado = 1
                    ORDER BY 
                        FechaCita DESC";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();

            if (!$rows) {
                return null;
            }

            $quotes = [];

            foreach ($rows as $row) {

                $quo = new Quote();
                $quo->setId($row['Id']);
                $quo->setFechaCita($row["FechaCita"] ? new DateTime($row["FechaCita"]) : null);
                $quo->setDetalles($row['Detalles']);
                $quotes[] = $quo;
            }

            return $quotes;

        } catch (PDOException $e) {
            throw new Exception("Error en GetQuotesPet: " . $e->getMessage());
        }
    }


    public function GetQuoteById(int $id): ?Quote
    {
        try {
            $sql = "SELECT 
                        Id,
                        Tipo,
                        FechaCita,
                        Detalles,
                        Etapa,
                        Observaciones
                    FROM citas
                    WHERE 
                        Id = ?";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                return null;
            }

            $quote = new Quote();
            $quote->setId($row['Id']);
            $quote->setTipo($row['Tipo']);
            $quote->setFechaCita($row['FechaCita'] ? new DateTime($row['FechaCita']) : null);
            $quote->setDetalles($row['Detalles']);
            $quote->setEtapa($row['Etapa']);
            $quote->setObservaciones($row['Observaciones'] ? $row['Observaciones'] : '');

            return $quote;

        } catch (PDOException $e) {
            throw new Exception("Error en GetQuoteById: " . $e->getMessage());
            return null;
        }

    }


    public function UpdateQuote(Quote $quote): bool
    {
        try {

            $sql = "UPDATE citas SET
                        Tipo = ?,
                        FechaCita = ?,
                        Detalles = ?,
                        Etapa = ?,
                        Observaciones = ?
                    WHERE Id = ?";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(1, $quote->getTipo(), PDO::PARAM_STR);
            $stmt->bindValue(2, $quote->getFechaCita()->format('Y-m-d H:i:s'), PDO::PARAM_STR);
            $stmt->bindValue(3, $quote->getDetalles(), PDO::PARAM_STR);
            $stmt->bindValue(4, $quote->getEtapa(), PDO::PARAM_STR);
            $stmt->bindValue(5, $quote->getObservaciones(), PDO::PARAM_STR);
            $stmt->bindValue(6, $quote->getId(), PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error en UpdateQuote: " . $e->getMessage());
        }

    }
    public function InsertCita(Quote $quote, int $idMascota): bool
    {
        try {

            $sql = "INSERT INTO citas (
                IdMascota,
                Tipo,
                FechaCita,
                Detalles,
                Observaciones
            ) VALUES (
                ?,?,?,?,?
            )";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(1, $idMascota, PDO::PARAM_INT);
            $stmt->bindValue(2, $quote->getTipo(), PDO::PARAM_STR);
            $stmt->bindValue(3, $quote->getFechaCita()->format('Y-m-d H:i:s'), PDO::PARAM_STR);
            $stmt->bindValue(4, $quote->getDetalles(), PDO::PARAM_STR);
            $stmt->bindValue(5, $quote->getObservaciones(), PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error en InsertCita: " . $e->getMessage());
        }
    }


    public function DeleteQuote($id): bool
    {
        try {
            $sql = "UPDATE citas 
                    SET Estado = 0 
                    WHERE Id=?";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            return $stmt->execute();

        } catch (PDOException $e) {
            throw new Exception("Error en DeleteCita: " . $e->getMessage());
        }

    }
}