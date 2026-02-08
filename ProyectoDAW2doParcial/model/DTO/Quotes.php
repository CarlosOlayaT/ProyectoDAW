<?php

class Quote
{
    private int $id;
    private string $tipo;
    private ?DateTime $fechaCita;
    private ?string $detalles;
    private string $etapa;
    private ?string $Observaciones;

    // --- GETTERS ---

    public function getId(): int
    {
        return $this->id;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function getFechaCita(): ?DateTime
    {
        return $this->fechaCita;
    }

    public function getDetalles(): ?string
    {
        return $this->detalles;
    }

    public function getEtapa(): string
    {
        return $this->etapa;
    }
    public function getObservaciones(): ?string
    {
        return $this->Observaciones;
    }

    // --- SETTERS ---

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function setFechaCita(?DateTime $fecha): void
    {
        $this->fechaCita = $fecha;
    }

    public function setDetalles(?string $detalles): void
    {
        $this->detalles = $detalles;
    }

    public function setEtapa(string $etapa): void
    {
        $this->etapa = $etapa;
    }
    public function setObservaciones(?string $observaciones): void
    {
        $this->Observaciones = $observaciones;
    }
}
