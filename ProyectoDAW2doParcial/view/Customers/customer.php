<!-- autor:David Israel Sayay Quito -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="David Israel Sayay Quito">
    <title>Clientes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styleCustomer.css">
</head>

<body>

    <main class="main-content">

        <form action="#" method="POST" style="display: contents;">
            <header class="top-bar">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                    <input type="text" id="searchCustomer" placeholder="Buscar...">
                </div>

                <h1>Clientes</h1>

                <button class="btn-new" type="button" onclick="CrearCliente()">
                    <i class="fa-solid fa-plus" aria-hidden="true"></i> Nuevo Cliente
                </button>
            </header>

            <section class="card" aria-label="Listado de clientes">
                <!-- <table class="table-customers table-customers"> -->
                <table class="table-customers">

                    <thead>
                        <tr>
                            <th class="col-id" scope="col">ID</th>
                            <th scope="col">Cedula</th>
                            <th scope="col">Nombre y apellido</th>
                            <th scope="col">Direccion</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mascotas</th>
                            <th class="text-center" scope="col"><span style="display:none;">Editar</span></th>
                            <th class="text-center" scope="col"><span style="display:none;">Eliminar</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($clients): ?>
                            <?php foreach ($clients as $client): ?>
                                <tr>
                                    <td>C<?= $client->getId() ?></td>
                                    <td><?= $client->getCedula() ?></td>
                                    <td><?= $client->getNombres() ?>         <?= $client->getApellidos() ?> </td>
                                    <td><?= $client->getDireccion() ?></td>
                                    <td><?= $client->getTelefono() ?></td>
                                    <td><?= $client->getCorreo() ?></td>
                                    <td><?= $client->getCantMascotas() ?></td>
                                    <td class="text-center"><button type="button"
                                            onclick="EditarCliente(<?= $client->getId() ?>)"><i
                                                class="fa-solid fa-pencil action-icon" aria-label="Editar Cliente"></i></button>
                                    </td>
                                    <td class="text-center"><a
                                            href="index.php?c=Customer&f=EliminarCliente&id=<?= $client->getId() ?>"
                                            onclick="return confirm('¿Estás seguro de eliminar este cliente?')">
                                            <i class="fa-solid fa-trash btn-delete"></i>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>



                    </tbody>
                </table>
            </section>


        </form>
    </main>

</body>
<script src="assets/js/scriptCustomer.js"></script>

</html>