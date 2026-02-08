<?php
require_once 'model/DAO/PetDAO.php';
require_once 'model/DTO/Pet.php';
require_once 'model/DTO/Typepet.php';
require_once 'model/DTO/Client.php';
require_once 'model/DAO/ClientDAO.php';
require_once 'model/DTO/HistorialMedico.php';
require_once 'model/DAO/HistorialMedicoDAO.php';
require_once 'model/DAO/TypepetDAO.php';
require_once 'model/DAO/QuotesDAO.php';
require_once 'model/DTO/Vacunas.php';

//Autor: Cadena Herrera Samuel

class PetsController
{
    //SECCIONES
    public function index()
    {
        $petsModel = new PetDAO();
        $pets = $petsModel->getLastPets();

        $quotesmodel = new QuotesDAO();
        $proximacitas = $quotesmodel->GetAllProxsQuotes();
        $content = 'view/PetsView.php';
        require_once 'view/layout.php';

    }
    public function Records()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "Mascota no encontrada";
            return;
        }


        $petmodel = new PetDAO();
        $pet = $petmodel->getPetById($id);


        $quoteModel = new QuotesDAO();
        $quote = $quoteModel->getProxQuote($id);


        $Hmmodel = new HistorialmedicoDAO();
        $Hm = $Hmmodel->getFicha($id);


        require_once 'view/RecordPetsView.php';

    }
    public function EditCitasMascotas()
    {
        $idMascota = $_GET['idm'] ?? null;
        $idCita = $_GET['idc'] ?? null;

        $petModel = new PetDAO();
        $pet = $petModel->getPetById($idMascota);

        $QuoteModel = new QuotesDAO();
        $quote = $QuoteModel->GetQuoteById($idCita);


        require_once 'view/EditQuotePetView.php';

    }

    public function HistoryPet()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "Mascota no encontrada";
            return;
        }


        $petmodel = new PetDAO();
        $pet = $petmodel->getPetById($id);

        $historialModel = new HistorialmedicoDAO();
        $cartas = $historialModel->getCartaMedica($id);

        $vacunas = $historialModel->getVacunas($id);

        $quotesmodel = new QuotesDAO();
        $citas = $quotesmodel->GetQuotesPet($id);
        require_once 'view/HistoryPetView.php';

    }
    public function AddQuotesPet()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "Mascota no encontrada";
            return;
        }

        $petmodel = new PetDAO();
        $pet = $petmodel->getPetById($id);



        require_once 'view/QuotesPetView.php';

    }
    public function PetsCreate()
    {
        $typesmodel = new TypepetDAO();
        $types = $typesmodel->getTypes();
        $clientsmodel = new ClientDAO();
        $clients = $clientsmodel->getClients();
        require_once 'view/AddPetsView.php';

    }
    public function ControlEditPets()
    {
        $id = $_GET['id'] ?? null;
        $idv = $_GET['idv'] ?? null;

        if (!$id) {
            echo "Mascota no encontrada";
            return;
        }
        if (!$idv) {
            echo "Vacuna no encontrada";
            return;
        }
        $tipo = $_GET['tipo'] ?? '';
        $esVacuna = ($tipo === 'vacuna');
        $esCarta = ($tipo === 'carta');
        $petmodel = new PetDAO();
        $pet = $petmodel->getPetById($id);
        $historialModel = new HistorialmedicoDAO();
        $vac = null;
        $carta = null;
        if ($esVacuna) {
            $vac = $historialModel->GetVacunaById($idv);
        } else {


            $carta = $historialModel->GetCartaById($idv);
        }
        require_once 'view/ControlEditPetsView.php';

    }
    function estadoClase($estado)
    {
        return match ($estado) {
            'Pagado', 'Completado' => 'estado-ok',
            'Pendiente', 'Esperando' => 'estado-pendiente',
            'No Asistió' => 'estado-error',
            default => ''
        };
    }
    public function AddCardVaccine()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "Mascota no encontrada";
            return;
        }

        $petmodel = new PetDAO();
        $pet = $petmodel->getPetById($id);

        require_once 'view/AggVaccineView.php';

    }

    //METODOS    
    public function GuardarNuevaMascota()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?c=Pets");
            exit;
        }

        $idTipo = filter_input(INPUT_POST, 'idtipo', FILTER_VALIDATE_INT);
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
        $especie = filter_input(INPUT_POST, 'especie', FILTER_SANITIZE_SPECIAL_CHARS);
        $raza = filter_input(INPUT_POST, 'raza', FILTER_SANITIZE_SPECIAL_CHARS);
        $fechaNac = $_POST['FechaNacimiento'] ?? null;
        $peso = filter_input(INPUT_POST, 'peso', FILTER_VALIDATE_FLOAT);
        $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_SPECIAL_CHARS);
        $idCliente = filter_input(INPUT_POST, 'id_real', FILTER_VALIDATE_INT);

        if (!$idTipo || !$nombre || !$idCliente || !$sexo) {
            echo "<script>alert('Faltan datos obligatorios o el dueño no es válido'); window.history.back();</script>";
            exit;
        }

        try {

            $clienteObj = new Client();
            $clienteObj->setId($idCliente);

            $tipoObj = new Typepet();
            $tipoObj->setId($idTipo);

            $nuevaMascota = new Pet();
            $nuevaMascota->setIdCliente($clienteObj);
            $nuevaMascota->setNombre($nombre);
            $nuevaMascota->setTipo($tipoObj);
            $nuevaMascota->setRaza($raza ?? 'Mestizo');
            $nuevaMascota->setEspecie($especie ?? 'N/A');
            $nuevaMascota->setPeso($peso ?: 0.0);
            $nuevaMascota->setSexo($sexo);
            $nuevaMascota->setObservaciones("");

            if ($fechaNac) {
                $fechaObj = new DateTime($fechaNac);
                $nuevaMascota->setFechaNacimiento($fechaObj);

                $hoy = new DateTime();
                $edad = $hoy->diff($fechaObj)->y;
                $nuevaMascota->setEdad($edad);
            }

            $petDao = new PetDao();
            $resultado = $petDao->InsertPet($nuevaMascota);

            if ($resultado) {
                echo "<script>alert('Mascota guardada con éxito'); window.location.href='index.php?c=Pets';</script>";
            } else {
                throw new Exception("Error al insertar en la base de datos");
            }

        } catch (Exception $e) {
            echo "<script>alert('Hubo un error al procesar el registro'" . $e->getMessage() . "); window.history.back();</script>";
        }
    }
    public function GuardarNuevaCita()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                header("Location: index.php");
                exit;
            }

            $idMascota = filter_input(INPUT_POST, 'id_mascota', FILTER_VALIDATE_INT);
            $tipo = filter_input(INPUT_POST, 'tipo_cita', FILTER_SANITIZE_SPECIAL_CHARS);
            $fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_SPECIAL_CHARS);
            $hora = filter_input(INPUT_POST, 'hora', FILTER_SANITIZE_SPECIAL_CHARS);
            $motivo = filter_input(INPUT_POST, 'motivo', FILTER_SANITIZE_SPECIAL_CHARS);
            $observaciones = filter_input(INPUT_POST, 'observaciones', FILTER_SANITIZE_SPECIAL_CHARS);

            if (!$idMascota || !$tipo || !$fecha || !$hora) {
                throw new Exception("Debe completar todos los campos obligatorios.");
            }
            try {
                $fechaCita = new DateTime("$fecha $hora");
            } catch (Exception $e) {
                throw new Exception("Fecha u hora inválida.");
            }

            if ($fechaCita < new DateTime()) {
                throw new Exception("No se puede agendar una cita en el pasado.");
            }

            $quote = new Quote();
            $quote->setTipo($tipo);
            $quote->setFechaCita($fechaCita);
            $quote->setDetalles($motivo);
            $quote->setObservaciones($observaciones ? $observaciones : null);

            $quoteDAO = new QuotesDAO();
            $result = $quoteDAO->InsertCita($quote, $idMascota);

            if ($result) {
                echo "<script>alert('Cita agendada correctamente');window.location.href='index.php?c=Pets';</script>";
            } else {
                echo "<script>alert('No se ingresaron datos válidos'); window.history.back();</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('Error en GuardarNuevaCita: '" . $e->getMessage() . "</script>";
        }

    }
    public function GuardarNuevaVacunaControl()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?c=Pets");
            exit;
        }


        $idMascota = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        $diagnostico = filter_input(INPUT_POST, 'diagnostico', FILTER_SANITIZE_SPECIAL_CHARS);
        $control = $_POST['control'] ?: null;
        $tratamiento = filter_input(INPUT_POST, 'tratamiento', FILTER_SANITIZE_SPECIAL_CHARS);

        $enfermedad = filter_input(INPUT_POST, 'enfermedad', FILTER_SANITIZE_SPECIAL_CHARS);
        $tipoVacuna = filter_input(INPUT_POST, 'tipo_vacuna', FILTER_SANITIZE_SPECIAL_CHARS);
        $fechaP = $_POST['primera_vacuna'] ?: null;
        $fechaR = $_POST['repetir_vacuna'] ?: null;

        $dao = new HistorialMedicoDAO();
        $exitoCarta = false;
        $exitoVacuna = false;

        try {

            if (!empty($diagnostico) && !empty($tratamiento && !is_null($control))) {
                $carta = new HistorialMedico();
                $carta->setIdMascota($idMascota);
                $carta->setDiagnostico($diagnostico);
                $carta->setTratamiento($tratamiento);
                $carta->setFechaConsulta($control ? new DateTime($control) : null);
                $exitoCarta = $dao->InsertCarta($carta);
            }


            if (!empty($enfermedad) && !empty($tipoVacuna)) {
                $vacuna = new Vacuna();
                $vacuna->setidMascota($idMascota);
                $vacuna->setEnfermedad($enfermedad);
                $vacuna->setVacuna($tipoVacuna);
                $vacuna->setFechaPrimeraDosis($fechaP ? new DateTime($fechaP) : null);
                $vacuna->setFechaRefuerzo($fechaR ? new DateTime($fechaR) : null);

                $exitoVacuna = $dao->InsertVacuna($vacuna);
            }

            if ($exitoCarta || $exitoVacuna) {
                echo "<script>alert('Registro guardado correctamente');window.location.href='index.php?c=Pets';</script>";
            } else {
                echo "<script>alert('No se ingresaron datos válidos'); window.history.back();</script>";
            }

        } catch (Exception $e) {
            echo "<script>alert('Error técnico al guardar: '" . $e->getMessage() . "); window.history.back();</script>";
        }
    }
    public function GuardarCambiosCita()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php");
            exit;
        }

        $id = filter_input(INPUT_POST, 'id_cita', FILTER_VALIDATE_INT);
        $tipo = filter_input(INPUT_POST, 'tipo_cita', FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_SPECIAL_CHARS);
        $hora = filter_input(INPUT_POST, 'hora', FILTER_SANITIZE_SPECIAL_CHARS);
        $detalles = filter_input(INPUT_POST, 'detalles', FILTER_SANITIZE_SPECIAL_CHARS);
        $etapa = filter_input(INPUT_POST, 'etapa', FILTER_SANITIZE_SPECIAL_CHARS);
        $observaciones = filter_input(INPUT_POST, 'observaciones', FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$id || !$tipo || !$fecha || !$hora || !$etapa) {
            throw new Exception("Datos incompletos para actualizar la cita.");
        }

        try {
            try {
                $fechaCita = new DateTime("$fecha $hora");
            } catch (Exception $e) {
                throw new Exception("Fecha u hora inválida.");
            }
            if ($fechaCita < new DateTime()) {
                throw new Exception("No se puede agendar una cita en el pasado.");
            }

            $quote = new Quote();
            $quote->setId($id);
            $quote->setTipo($tipo);
            $quote->setFechaCita($fechaCita);
            $quote->setDetalles($detalles);
            $quote->setEtapa($etapa);
            $quote->setObservaciones($observaciones);

            $quoteDAO = new QuotesDAO();
            $result = $quoteDAO->UpdateQuote($quote);

            if ($result) {
                echo "<script>alert('Cambios realizados correctamente');window.location.href='index.php?c=Pets';</script>";
            } else {
                echo "<script>alert('No se ingresaron datos válidos'); window.history.back();</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('Error técnico al editar: '" . $e->getMessage() . "); window.history.back();</script>";
        }

    }

    public function actualizar()
    {


        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?c=Pets");
            exit;
        }
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $nombre = filter_input(INPUT_POST, 'Nombre', FILTER_SANITIZE_SPECIAL_CHARS);
        $observaciones = filter_input(INPUT_POST, 'observaciones', FILTER_SANITIZE_SPECIAL_CHARS);
        try {

            $pet = new Pet();
            $pet->setId($id);
            $pet->setNombre($nombre);
            $pet->setObservaciones($observaciones);
            $petdao = new PetDAO();
            $result = $petdao->UpdateFichaPet($pet);

            if ($result) {
                echo "<script>alert('Mascota actualizada con éxito'); window.location.href='index.php?c=Pets';</script>";
            } else {
                throw new Exception("Error al actualizar en la base de datos");
            }

        } catch (Exception $e) {
            echo "<script>alert('Hubo un error al actualizar la mascota: '" . $e->getMessage() . "); window.history.back();</script>";
        }


    }
    public function GuardarCambios()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?c=Pets");
            exit;
        }
        $tipo = $_POST['tipo'];
        $id = $_POST['id_registro'];
        $dao = new HistorialMedicoDAO();

        try {
            if ($tipo === 'vacuna') {
                $enfermedad = filter_input(INPUT_POST, 'enfermedad', FILTER_SANITIZE_SPECIAL_CHARS);
                $nombreVacuna = filter_input(INPUT_POST, 'vacuna', FILTER_SANITIZE_SPECIAL_CHARS);
                $fechaP = $_POST['fecha_p'] ?? null;
                $fechaR = $_POST['fecha_r'] ?? null;

                if (empty($enfermedad) || empty($nombreVacuna)) {
                    return;
                }

                $vc = new Vacuna();
                $vc->setId($id);
                $vc->setEnfermedad($enfermedad);
                $vc->setVacuna($nombreVacuna);
                $vc->setFechaPrimeraDosis($fechaP ? (new DateTime($fechaP)) : null);
                $vc->setFechaRefuerzo($fechaR ? (new DateTime($fechaR)) : null);

                $result = $dao->UpdateVacuna($vc);


            } else {
                $diagnostico = filter_input(INPUT_POST, 'diagnostico', FILTER_SANITIZE_SPECIAL_CHARS);
                $tratamiento = filter_input(INPUT_POST, 'tratamiento', FILTER_SANITIZE_SPECIAL_CHARS);
                $control = $_POST['control'] ?? null;
                if (empty($diagnostico)) {
                    return;
                }
                $carta = new HistorialMedico();
                $carta->setId($id);
                $carta->setDiagnostico($diagnostico);
                $carta->setTratamiento($tratamiento);
                $carta->setFechaConsulta($control ? (new DateTime($control)) : null);



                $result = $dao->UpdateCarta($carta);

                if ($result) {
                    echo "<script>alert('Mascota actualizada con éxito'); window.location.href='index.php?c=Pets';</script>";
                } else {
                    throw new Exception("Error al actualizar en la base de datos");
                }
            }
        } catch (Exception $e) {
            echo "<script>alert('Hubo un error al actualizar la mascota: '" . $e->getMessage() . "); window.history.back();</script>";
        }
    }
    public function EliminarMascota()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header("Location: index.php?c=Pets");
            exit;
        }
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        try {
            $petDao = new PetDao();
            $resultado = $petDao->DeletePet($id);

            if ($resultado) {
                echo "<script>alert('Mascota eliminada con éxito'); window.location.href='index.php?c=Pets';</script>";
            } else {
                throw new Exception("Error al insertar en la base de datos");
            }
        } catch (Exception $e) {
            echo "<script>alert('Hubo un error al eliminar la mascota: '" . $e->getMessage() . "); window.history.back();</script>";
        }

    }
    public function EliminarCarta()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header("Location: index.php?c=Pets");
            exit;
        }
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        try {
            $petDao = new PetDao();
            $resultado = $petDao->DeleteCarta($id);

            if ($resultado) {
                echo "<script>alert('Carta eliminada con éxito'); window.location.href='index.php?c=Pets';</script>";
            } else {
                throw new Exception("Error al eliminar carta en la base de datos");
            }
        } catch (Exception $e) {
            echo "<script>alert('Hubo un error al eliminar la Carta: '" . $e->getMessage() . "); window.history.back();</script>";
        }

    }
    public function EliminarVacuna()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header("Location: index.php?c=Pets");
            exit;
        }
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        try {
            $petDao = new PetDao();
            $resultado = $petDao->DeleteVacuna($id);

            if ($resultado) {
                echo "<script>alert('Vacuna eliminada con éxito'); window.location.href='index.php?c=Pets';</script>";
            } else {
                throw new Exception("Error al eliminar vacuna en la base de datos");
            }
        } catch (Exception $e) {
            echo "<script>alert('Hubo un error al eliminar la vacuna: '" . $e->getMessage() . "); window.history.back();</script>";
        }

    }
    public function Eliminarcita()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header("Location: index.php?c=Pets");
            exit;
        }
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        try {
            $quotedao = new QuotesDAO();
            $resultado = $quotedao->DeleteQuote($id);


            if ($resultado) {
                echo "<script>alert('Vacuna eliminada con éxito'); window.location.href='index.php?c=Pets';</script>";
            } else {
                throw new Exception("Error al eliminar vacuna en la base de datos");
            }
        } catch (Exception $e) {
            echo "<script>alert('Hubo un error al eliminar la cita: '" . $e->getMessage() . "); window.history.back();</script>";
        }

    }
}