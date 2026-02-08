<!-- autor: Cadena Herrera Samuel -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Cadena Herrera Samuel Isaac">
    <title>Farmacia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styleRecipes.css">
</head>

<body>

    <div class="main-content">
        <div class="top-bar">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Buscar...">
            </div>

            <h1>Farmacia</h1>

            <button class="btn-new">
                <i class="fa-solid fa-plus"></i> Nueva Medicina
            </button> <button class="btn-new">
                <i class="fa-solid fa-plus"></i> Crear Receta
            </button>
        </div>

        <div class="card">
            <table class="table-pets">
                <thead>
                    <tr>
                        <th class="col-id col">ID</th>
                        <th class="col-mascota col">Medicamento</th>
                        <th class="col-id col">Tipo</th>
                        <th class="col-id col">Stock</th>
                        <th class="col-id col">Precio</th>
                        <th class="col-id col">Fecha de Vencimiento</th>
                        <th class="col-id col">Estado</th>
                        <th class="text-center col" colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>M01</td>
                        <td>Paracetamol 500mg</td>
                        <td>Analgésico</td>
                        <td>120</td>
                        <td>$2.50</td>
                        <td>2026-05-12</td>
                        <td>Disponible</td>
                        <td class="text-center">
                            <i class="fa-solid fa-pencil action-icon"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-trash btn-delete"></i>
                        </td>
                    </tr>

                    <tr>
                        <td>M02</td>
                        <td>Amoxicilina 250mg</td>
                        <td>Antibiótico</td>
                        <td>45</td>
                        <td>$6.80</td>
                        <td>2025-11-20</td>
                        <td>Bajo stock</td>
                        <td class="text-center">
                            <i class="fa-solid fa-pencil action-icon"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-trash btn-delete"></i>
                        </td>
                    </tr>

                    <tr>
                        <td>M03</td>
                        <td>Ivermectina</td>
                        <td>Antiparasitario</td>
                        <td>0</td>
                        <td>$4.00</td>
                        <td>2025-08-01</td>
                        <td>Agotado</td>
                        <td class="text-center">
                            <i class="fa-solid fa-pencil action-icon"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-trash btn-delete"></i>
                        </td>
                    </tr>

                    <tr>
                        <td>M04</td>
                        <td>Vacuna Antirrábica</td>
                        <td>Vacuna</td>
                        <td>30</td>
                        <td>$12.00</td>
                        <td>2027-01-15</td>
                        <td>Disponible</td>
                        <td class="text-center">
                            <i class="fa-solid fa-pencil action-icon"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-trash btn-delete"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>



</body>

</html>