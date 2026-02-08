<?php
class HistorialMedico
{
    private int $id;
    private int $idMascota;
    private int $idServicio;
    private string $diagnostico;
    private string $tratamiento;
    private ?DateTime $fechaConsulta;
    private ?DateTime $proximacita;
    private ?DateTime $fechaRegistro = null;
    private bool $estado;

    // ID
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    //Proxima cita
    public function getProximaCita(): ?DateTime
    {
        return $this->proximacita;
    }
    public function setProximaCita(?DateTime $proximacita): void
    {
        $this->proximacita = $proximacita;
    }
    // ID Mascota
    public function getIdMascota(): int
    {
        return $this->idMascota;
    }

    public function setIdMascota(int $idMascota): void
    {
        $this->idMascota = $idMascota;
    }

    // ID Servicio
    public function getIdServicio(): int
    {
        return $this->idServicio;
    }

    public function setIdServicio(int $idServicio): void
    {
        $this->idServicio = $idServicio;
    }

    // Diagnóstico
    public function getDiagnostico(): string
    {
        return $this->diagnostico;
    }

    public function setDiagnostico(string $diagnostico): void
    {
        $this->diagnostico = $diagnostico;
    }

    // Tratamiento
    public function getTratamiento(): string
    {
        return $this->tratamiento;
    }

    public function setTratamiento(string $tratamiento): void
    {
        $this->tratamiento = $tratamiento;
    }

    // Fecha Consulta
    public function getFechaConsulta(): ?DateTime
    {
        return $this->fechaConsulta;
    }

    public function setFechaConsulta(?DateTime $fechaConsulta): void
    {
        $this->fechaConsulta = $fechaConsulta;
    }

    // Fecha Registro 
    public function getFechaRegistro(): ?DateTime
    {
        return $this->fechaRegistro;
    }

    // Estado
    public function getEstado(): bool
    {
        return $this->estado;
    }

    public function setEstado(bool $estado): void
    {
        $this->estado = $estado;
    }
}
