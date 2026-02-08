<?php
class Typepet
{
    private int $Id;
    private string $Nombre;
    private string $RutaIcono;
    private DateTime $FechaRegistro;




    // Getters
    public function getId(): int
    {
        return $this->Id;
    }
    public function getNombre(): string
    {
        return $this->Nombre;
    }
    public function getRutaIcono(): string
    {
        return $this->RutaIcono;
    }
    public function getFechaRegistro(): DateTime
    {
        return $this->FechaRegistro;
    }

    // Setters

    public function setId($id): void
    {
        $this->Id = $id;
    }
    public function setNombre($nombre): void
    {
        $this->Nombre = $nombre;
    }
    public function setRutaIcono($rutaIcono): void
    {
        $this->RutaIcono = $rutaIcono;
    }
    public function setFechaRegistro($fechaRegistro): void
    {
        $this->FechaRegistro = $fechaRegistro;
    }
}
?>