<?php

class Vacuna
{
    private int $id;
    private string $enfermedad;
    private int $idMascota;
    private string $vacuna;
    private ?DateTime $fechaPrimeraDosis;
    private ?DateTime $fechaRefuerzo;
    private ?string $observaciones;
    private string $nombreServicio;

    // --- GETTERS ---

    public function getId(): int
    {
        return $this->id;
    }
    public function getidMascota(): int
    {
        return $this->idMascota;
    }
    public function getEnfermedad(): string
    {
        return $this->enfermedad;
    }

    public function getVacuna(): string
    {
        return $this->vacuna;
    }

    public function getFechaPrimeraDosis(): ?DateTime
    {
        return $this->fechaPrimeraDosis;
    }

    public function getFechaRefuerzo(): ?DateTime
    {
        return $this->fechaRefuerzo;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function getNombreServicio(): string
    {
        return $this->nombreServicio;
    }

    // --- SETTERS ---

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setidMascota(int $idmascota): void
    {
        $this->idMascota = $idmascota;
    }

    public function setEnfermedad(string $enfermedad): void
    {
        $this->enfermedad = $enfermedad;
    }

    public function setVacuna(string $vacuna): void
    {
        $this->vacuna = $vacuna;
    }

    public function setFechaPrimeraDosis(?DateTime $fechaPrimeraDosis): void
    {
        $this->fechaPrimeraDosis = $fechaPrimeraDosis;
    }

    public function setFechaRefuerzo(?DateTime $fechaRefuerzo): void
    {
        $this->fechaRefuerzo = $fechaRefuerzo;
    }

    public function setObservaciones(?string $observaciones): void
    {
        $this->observaciones = $observaciones;
    }

    public function setNombreServicio(string $nombreServicio): void
    {
        $this->nombreServicio = $nombreServicio;
    }
}
