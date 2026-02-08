<?php
require_once 'model/DAO/PetDAO.php';
//Autor: Cadena Herrera Samuel

class PetsAJAXController
{
    public function search()
    {
        $value = $_GET['q'] ?? '';

        $dao = new PetDAO();

        if (trim($value) === '') {
            $rows = $dao->getLastPets();
            $pets = [];

            foreach ($rows as $row) {
                $pets[] = [
                    'id' => $row->getId(),
                    'nombre' => $row->getNombre(),
                    'especie' => $row->getEspecie(),
                    'raza' => $row->getRaza(),
                    'sexo' => $row->getSexo(),
                    'peso' => $row->getPeso(),
                    'edad' => $row->getEdad(),
                    'dueno' => $row->getIdCliente()->getNombres() . ' ' . $row->getIdCliente()->getApellidos(),
                    'tipo' => [
                        'nombre' => $row->getTipo()->getNombre(),
                        'icono' => $row->getTipo()->getRutaIcono(),
                    ]
                ];
            }
        } else {
            $rows = $dao->searchPets($value);
            $pets = $rows;
        }


        header('Content-Type: application/json');
        echo json_encode($pets);
    }
}
