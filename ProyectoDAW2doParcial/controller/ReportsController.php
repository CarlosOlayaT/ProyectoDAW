<?php
class ReportsController
{



    public function index()
    {
        //   Datos quemados

        // FACTURAS
        $facturas = [
            [
                'id' => 'FAC-01',
                'mascota' => 'assets/images/icons/perro.png',
                'dueno' => 'Luis Gómez',
                'ciudad' => 'Quito',
                'fecha' => '15/01/2025',
                'total' => 451.56,
                'estado' => 'Pagado'
            ],
            [
                'id' => 'FAC-02',
                'mascota' => 'assets/images/icons/gato.png',
                'dueno' => 'Carlos Vera',
                'ciudad' => 'Quito',
                'fecha' => '15/01/2025',
                'total' => 451.56,
                'estado' => 'Pagado'
            ],
            [
                'id' => 'FAC-03',
                'mascota' => 'assets/images/icons/loro.png',
                'dueno' => 'Pedro Ramírez',
                'ciudad' => 'Quito',
                'fecha' => '15/01/2025',
                'total' => 451.56,
                'estado' => 'Esperando'
            ],
            [
                'id' => 'FAC-04',
                'mascota' => 'assets/images/icons/tortuga.png',
                'dueno' => 'Juan Pérez',
                'ciudad' => 'Quito',
                'fecha' => '15/01/2025',
                'total' => 451.56,
                'estado' => 'Esperando'
            ]
        ];

        // CITAS
        $citas = [
            [
                'id' => 'C01',
                'mascota' => 'assets/images/icons/perro.png',
                'nombre' => 'Coco',
                'tipo' => 'Cirugía',
                'fecha' => '25/07/2025',
                'hora' => '15:30',
                'detalle' => 'Chequeo post operatorio',
                'estado' => 'Completado'
            ],
            [
                'id' => 'C02',
                'mascota' => 'assets/images/icons/gato.png',
                'nombre' => 'Coco',
                'tipo' => 'Consulta',
                'fecha' => '25/07/2025',
                'hora' => '15:30',
                'detalle' => 'Consulta general',
                'estado' => 'Completado'
            ],
            [
                'id' => 'C03',
                'mascota' => 'assets/images/icons/loro.png',
                'nombre' => 'Coco',
                'tipo' => 'Vacunas',
                'fecha' => '25/07/2025',
                'hora' => '15:30',
                'detalle' => 'Vacunación anual',
                'estado' => 'Pendiente'
            ],
            [
                'id' => 'C04',
                'mascota' => 'assets/images/icons/tortuga.png',
                'nombre' => 'Coco',
                'tipo' => 'Cirugía',
                'fecha' => '25/07/2025',
                'hora' => '15:30',
                'detalle' => 'Cirugía menor',
                'estado' => 'No Asistió'
            ]
        ];
        // Función para clases de estado
        function estadoClase($estado)
        {
            return match ($estado) {
                'Pagado', 'Completado' => 'estado-ok',
                'Pendiente', 'Esperando' => 'estado-pendiente',
                'No Asistió' => 'estado-error',
                default => ''
            };
        }
        $content = 'view/ReportsView.php';
        require_once 'view/layout.php';
    }
}


