<?php
require_once 'model/DAO/ClientDAO.php';
/* autor: David Israel Sayay Quito */

class CustomerAJAXController
{
    public function search()
    {
        $value = $_GET['q'] ?? '';
        $dao = new ClientDAO();
        $customers = [];

        if (trim($value) === '') {
            $rows = $dao->GetClients();
        } else {
            $rows = $dao->searchCustomer($value);
        }

        if ($rows) {
            foreach ($rows as $row) {
                $customers[] = [
                    'id' => $row->getId(),
                    'cedula' => $row->getCedula(),
                    'nombres' => $row->getNombres() . ' ' . $row->getApellidos(),
                    'direccion' => $row->getDireccion(),
                    'telefono' => $row->getTelefono(),
                    'correo' => $row->getCorreo(),
                    'cantMascotas' => $row->getCantMascotas(),
                ];
            }
        }

        header('Content-Type: application/json');
        echo json_encode($customers);
    }
}
