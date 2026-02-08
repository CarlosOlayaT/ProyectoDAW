<?php

class Client
{
    private int $id;
    private string $cedula;
    private string $nombres;
    private string $apellidos;
    private ?string $telefono;
    private ?string $correo;
    private ?string $direccion;
    private DateTime $FechaRegistro;
    private int $CantMascotas;

    public function __construct()
    {

    }


    // Getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getCedula(): string
    {
        return $this->cedula;
    }
    public function getNombres(): string
    {
        return $this->nombres;
    }
    public function getApellidos(): string
    {
        return $this->apellidos;
    }
    public function getTelefono(): ?string
    {
        return $this->telefono;
    }
    public function getCorreo(): ?string
    {
        return $this->correo;
    }
    public function getDireccion(): ?string
    {
        return $this->direccion;
    }
    public function getFechaRegistro(): DateTime
    {
        return $this->FechaRegistro;
    }
    public function getCantMascotas(): int
    {
        return $this->CantMascotas;
    }

    // Setters
    public function setCantMascotas(int $cant): void
    {
        $this->CantMascotas = $cant;
    }
    public function setId(int $Id): void
    {
        $this->id = $Id;
    }
    public function setCedula(string $cedula): void
    {
        $this->cedula = $cedula;
    }
    public function setNombres(string $nombres): void
    {
        $this->nombres = $nombres;
    }
    public function setApellidos(string $apellidos): void
    {
        $this->apellidos = $apellidos;
    }
    public function setTelefono(?string $telefono): void
    {
        $this->telefono = $telefono;
    }
    public function setCorreo(?string $correo): void
    {
        $this->correo = $correo;
    }
    public function setDireccion(?string $direccion): void
    {
        $this->direccion = $direccion;
    }
    public function setFechaRegistro(DateTime $fechaRegistro): void
    {
        $this->FechaRegistro = $fechaRegistro;
    }

}
