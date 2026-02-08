<?php
class User
{

    private int $id;
    private string $usuario;

    private string $Nombre;
    private string $Apellido;
    private string $password;
    private int $rolId;
    private string $rolNombre;
    private DateTime $fechaRegistro;

    // ===== GETTERS =====
    public function getId(): int
    {
        return $this->id;
    }

    public function getUsuario(): string
    {
        return $this->usuario;
    }
    public function getNombre(): string
    {
        return $this->Nombre;
    }
    public function getApellido(): string
    {
        return $this->Apellido;
    }
    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRolId(): int
    {
        return $this->rolId;
    }

    public function getRolNombre(): string
    {
        return $this->rolNombre;
    }

    public function getFechaRegistro(): DateTime
    {
        return $this->fechaRegistro;
    }
    // ===== SETTERS =====
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setUsuario(string $usuario): void
    {
        $this->usuario = $usuario;
    }
    public function setNombre(string $nombreCompleto): void
    {
        $this->Nombre = $nombreCompleto;
    }
    public function setApellido(string $apellido): void
    {
        $this->Apellido = $apellido;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setRolId(int $rolId): void
    {
        $this->rolId = $rolId;
    }

    public function setRolNombre(string $rolNombre): void
    {
        $this->rolNombre = $rolNombre;
    }

    public function setFechaRegistro(string $fecha): void
    {
        $this->fechaRegistro = new DateTime($fecha);
    }

}
