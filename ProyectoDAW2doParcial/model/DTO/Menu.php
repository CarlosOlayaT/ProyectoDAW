<?php
class Menu
{
    private int $Id;
    private string $Controlador;
    private string $Funcion;
    private string $Icono;
    private string $Nombre;




    // Getters
    public function getId(): int
    {
        return $this->Id;
    }
    public function getNombre(): string
    {
        return $this->Nombre;
    }
    public function getControlador(): string
    {
        return $this->Controlador;
    }
    public function getFuncion(): string
    {
        return $this->Funcion;
    }
    public function getIcono(): string
    {
        return $this->Icono;
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
    public function setControlador($Controlador): void
    {
        $this->Controlador = $Controlador;
    }
    public function setFuncion($funcion): void
    {
        $this->Funcion = $funcion;
    }
    public function setIcono($icono): void
    {
        $this->Icono = $icono;
    }
}
?>