    <?php
    require_once 'Client.php';
    require_once 'Typepet.php';

    class Pet
    {
        private int $id;
        private Client $idCliente;
        private string $nombre;
        private Typepet $tipo;
        private string $raza;
        private float $peso;
        private DateTime $fechaNacimiento;
        private string $sexo;
        private string $etapa;
        private string $especie;
        private string $observaciones;
        private int $Edad;

        // Getters
        public function getId(): int
        {
            return $this->id;
        }
        public function getIdCliente(): Client
        {
            return $this->idCliente;
        }
        public function getNombre(): string
        {
            return $this->nombre;
        }
        public function getTipo(): Typepet
        {
            return $this->tipo;
        }
        public function getRaza(): string
        {
            return $this->raza;
        }
        public function getPeso(): string
        {
            return $this->peso;
        }
        public function getFechaNacimiento(): DateTime
        {
            return $this->fechaNacimiento;
        }
        public function getSexo(): string
        {
            return $this->sexo;
        }
        public function getEtapa(): string
        {
            return $this->etapa;
        }
        public function getEspecie(): string
        {
            return $this->especie;
        }
        public function getObservaciones(): string
        {
            return $this->observaciones;
        }

        public function getEdad(): string
        {
            return $this->Edad;
        }
        // Setters
        public function setId(int $id): void
        {
            $this->id = $id;
        }

        public function setIdCliente($idCliente): void
        {
            $this->idCliente = $idCliente;
        }
        public function setNombre($nombre): void
        {
            $this->nombre = $nombre;
        }
        public function setTipo($tipo): void
        {
            $this->tipo = $tipo;
        }
        public function setRaza($raza): void
        {
            $this->raza = $raza;
        }
        public function setPeso($peso): void
        {
            $this->peso = $peso;
        }
        public function setFechaNacimiento($fecha): void
        {
            $this->fechaNacimiento = $fecha;
        }
        public function setSexo($sexo): void
        {
            $this->sexo = $sexo;
        }
        public function setEtapa($etapa): void
        {
            $this->etapa = $etapa;
        }
        public function setEspecie($especie): void
        {
            $this->especie = $especie;
        }
        public function setObservaciones($obs): void
        {
            $this->observaciones = $obs;
        }
        public function setEdad($edad): void
        {
            $this->Edad = $edad;
        }
    }
