<?php
require_once 'config/Conexion.php';
require_once 'model/DTO/HistorialMedico.php';
require_once 'model/DTO/Vacunas.php';
//Autor: Cadena Herrera Samuel

class HistorialmedicoDAO
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::getConexion();
    }

    public function getFicha($idMascota): ?HistorialMedico
    {
        try {
            $sql = "SELECT 
                    Hm.id,
                    Hm.tratamiento,
                    Hm.diagnostico,
                    Hm.FechaConsulta   
                FROM historialmedico Hm
                WHERE Hm.IdMascota = ?
                ORDER BY Hm.FechaRegistro DESC
                LIMIT 1";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(1, $idMascota, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                return null;
            }


            $Hm = new HistorialMedico();
            $Hm->setId($row['id']);
            $Hm->setTratamiento($row['tratamiento']);
            $Hm->setDiagnostico($row['diagnostico']);
            if (!empty($row['FechaConsulta'])) {
                $Hm->setFechaConsulta(new DateTime($row['FechaConsulta']));
            }


            return $Hm;
        } catch (PDOException $e) {
            throw new Exception("Error en getFicha: " . $e->getMessage());
        }

    }

    public function getCartaMedica($id): ?array
    {
        try {
            $sql = "SELECT
                        H.Id,
                        H.Diagnostico,
                        H.Tratamiento,
                        H.FechaConsulta
                    FROM 
                        historialmedico H
                    INNER JOIN 
                        mascotas M ON H.IdMascota = M.Id
                    WHERE 
                        H.IdMascota = ?
                        AND H.Estado = 1  
                    ORDER BY 
                        H.FechaConsulta DESC";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);

            $stmt->execute();
            $rows = $stmt->fetchAll();

            if (!$rows) {
                return null;
            }
            $Cartas = [];
            foreach ($rows as $row) {
                $Hm = new HistorialMedico();
                $Hm->setId($row["Id"]);
                $Hm->setTratamiento($row["Tratamiento"]);
                $Hm->setFechaConsulta(new DateTime($row["FechaConsulta"]));
                $Hm->setDiagnostico($row["Diagnostico"]);

                $Cartas[] = $Hm;
            }
            return $Cartas;
        } catch (PDOException $e) {
            throw new Exception("Error en getCartaMedica: " . $e->getMessage());
        }
    }

    public function getVacunas($id): ?array
    {
        try {
            $sql = "SELECT
                        V.Id,
                        V.Enfermedad,
                        V.Vacuna,
                        V.FechaPrimeraDosis,
                        V.FechaRefuerzo,
                        V.Observaciones
                    FROM    
                        vacunas V
                    WHERE 
                        V.IdMascota = ? AND Estado = 1
                    ORDER BY 
                        V.FechaPrimeraDosis DESC";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            if (!$rows) {
                return null;
            }
            $vacunas = [];
            foreach ($rows as $row) {
                $Vc = new Vacuna();
                $Vc->setId($row["Id"]);
                $Vc->setEnfermedad($row["Enfermedad"]);
                $Vc->setVacuna($row["Vacuna"]);
                $Vc->setFechaPrimeraDosis(fechaPrimeraDosis: $row["FechaPrimeraDosis"] ? (new DateTime($row["FechaPrimeraDosis"])) : null);
                $Vc->setFechaRefuerzo($row["FechaRefuerzo"] ? (new DateTime($row["FechaRefuerzo"])) : null);
                $Vc->setObservaciones($row["Observaciones"]);

                $vacunas[] = $Vc;

            }

            return $vacunas;
        } catch (PDOException $e) {
            throw new Exception("Error en getVacunas: " . $e->getMessage());
        }
    }

    public function InsertVacuna(Vacuna $v)
    {
        try {
            $sql = "INSERT INTO vacunas (
                    IdMascota, 
                    Enfermedad, 
                    Vacuna, 
                    FechaPrimeraDosis, 
                    FechaRefuerzo
                ) VALUES (?, ?, ?, ?, ?)";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(1, $v->getidMascota(), PDO::PARAM_INT);
            $stmt->bindValue(2, $v->getEnfermedad(), PDO::PARAM_STR);
            $stmt->bindValue(3, $v->getVacuna(), PDO::PARAM_STR);
            $stmt->bindValue(4, $v->getFechaPrimeraDosis() ? $v->getFechaPrimeraDosis()->format('Y-m-d') : null, PDO::PARAM_STR);
            $stmt->bindValue(5, $v->getFechaRefuerzo() ? $v->getFechaRefuerzo()->format('Y-m-d') : null, PDO::PARAM_STR);

            return $stmt->execute();

        } catch (PDOException $e) {
            throw new Exception("Error en InsertVacuna: " . $e->getMessage());
        }
    }

    public function InsertCarta(HistorialMedico $h)
    {
        try {
            $sql = "INSERT INTO historialmedico (
                    IdMascota, 
                    Diagnostico, 
                    Tratamiento, 
                    FechaConsulta
                ) VALUES (?, ?, ?, ?)";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(1, $h->getidMascota(), PDO::PARAM_INT);
            $stmt->bindValue(2, $h->getDiagnostico(), PDO::PARAM_STR);
            $stmt->bindValue(3, $h->getTratamiento(), PDO::PARAM_STR);
            $stmt->bindValue(4, $h->getFechaConsulta() ? $h->getFechaConsulta()->format('Y-m-d') : null, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error en InsertCarta: " . $e->getMessage());
        }
    }

    public function GetCartaById($id): ?HistorialMedico
    {
        try {
            $sql = "SELECT
                    Id,
                    Diagnostico,
                    Tratamiento,
                    FechaConsulta
                FROM 
                    historialmedico 
                WHERE 
                    Id = ?
                    AND Estado = 1";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);

            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                return null;
            }

            $Hm = new HistorialMedico();
            $Hm->setId($row["Id"]);
            $Hm->setTratamiento($row["Tratamiento"]);
            $Hm->setFechaConsulta(new DateTime($row["FechaConsulta"]));
            $Hm->setDiagnostico($row["Diagnostico"]);


            return $Hm;
        } catch (PDOException $e) {
            throw new Exception("Error en GetCartaById: " . $e->getMessage());
        }
    }
    public function GetVacunaById($id): ?Vacuna
    {
        try {
            $sql = "SELECT
                    V.Id,
                    V.Enfermedad,
                    V.Vacuna,
                    V.FechaPrimeraDosis,
                    V.FechaRefuerzo,
                    V.Observaciones,
                    S.NombreServicio
                FROM 
                    vacunas V
                INNER JOIN 
                    servicios S ON V.IdServicio = S.Id
                WHERE 
                    V.Id=? AND Estado = 1";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                return null;
            }
            $Vc = new Vacuna();
            $Vc->setId($row["Id"]);
            $Vc->setEnfermedad($row["Enfermedad"]);
            $Vc->setVacuna($row["Vacuna"]);
            $Vc->setFechaPrimeraDosis($row["FechaPrimeraDosis"] ? (new DateTime($row["FechaPrimeraDosis"])) : null);
            $Vc->setFechaRefuerzo($row["FechaRefuerzo"] ? (new DateTime($row["FechaRefuerzo"])) : null);
            $Vc->setObservaciones($row["Observaciones"]);
            $Vc->setNombreServicio($row["NombreServicio"]);
        } catch (PDOException $e) {
            throw new Exception("Error en GetVacunaById: " . $e->getMessage());
        }



        return $Vc;
    }

    public function UpdateCarta($carta)
    {
        try {
            $sql = "UPDATE 
                    historialmedico 
                    SET 
                    Diagnostico = ?, 
                    Tratamiento = ?, 
                    FechaConsulta = ? 
                    WHERE Id = ? 
                    AND Estado = 1";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(1, $carta->getDiagnostico(), PDO::PARAM_STR);
            $stmt->bindValue(2, $carta->getTratamiento(), PDO::PARAM_STR);
            $stmt->bindValue(3, $carta->getFechaConsulta() ? $carta->getFechaConsulta()->format('Y-m-d H:i') : null, PDO::PARAM_STR);
            $stmt->bindValue(4, $carta->getId(), PDO::PARAM_INT);
            return $stmt->execute();

        } catch (PDOException $e) {
            throw new Exception("Error en UpdateCarta: " . $e->getMessage());
        }
    }

    public function UpdateVacuna($vacuna): bool
    {
        try {
            $sql = "UPDATE 
                    vacunas 
                    SET 
                    Enfermedad = ?, 
                    Vacuna = ?, 
                    FechaPrimeraDosis = ?, 
                    FechaRefuerzo = ?
                    WHERE Id = ? 
                    AND Estado = 1";

            $stmt = $this->conexion->prepare($sql);

            $stmt->bindValue(1, $vacuna->getEnfermedad(), PDO::PARAM_STR);
            $stmt->bindValue(2, $vacuna->getVacuna(), PDO::PARAM_STR);
            $stmt->bindValue(3, $vacuna->getFechaPrimeraDosis()->format('Y-m-d H:i'), PDO::PARAM_STR);
            $stmt->bindValue(4, $vacuna->getFechaRefuerzo() ? $vacuna->getFechaRefuerzo()->format('Y-m-d H:i') : null, PDO::PARAM_STR);
            $stmt->bindValue(5, $vacuna->getId(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error en UpdateVacuna: " . $e->getMessage());
        }
    }

}