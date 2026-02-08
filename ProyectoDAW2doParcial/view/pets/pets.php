<!-- autor: Cadena Herrera Samuel -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Cadena Herrera Samuel Isaac">
    <title>Mascotas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/stylePets.css">
</head>

<body>

    <main class="main-content">
        <header class="top-bar">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchPet" placeholder="Buscar...">
            </div>

            <h1>Mascotas</h1>

            <button class="btn-new" onclick="NuevoPet()">
                <i class="fa-solid fa-plus"></i> Nueva Mascota
            </button>
        </header>

        <section class="card" aria-label="Listado de Mascotas">
            <table class="table-pets">
                <thead>
                    <tr>
                        <th class="col-id">ID</th>
                        <th class="col-mascota">Mascota</th>
                        <th>Nombre</th>
                        <th>Especie</th>
                        <th>Raza</th>
                        <th>Sexo</th>
                        <th>Peso</th>
                        <th>Edad</th>
                        <th>Dueño</th>
                        <th class="text-center">Ficha</th>
                        <th class="text-center">Historial</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($pets): ?>
                        <?php foreach ($pets as $p): ?>
                            <tr>
                                <td class="col-id">M<?= $p->getId(); ?>
                                </td>
                                <td class="mascota-avatar"><img class="icons"
                                        src="assets/images/icons/<?= $p->getTipo()->getRutaIcono() ?>"></td>
                                <td>
                                    <?= $p->getNombre() ?>
                                </td>
                                <td>
                                    <?= $p->getEspecie() ?>
                                </td>
                                <td>
                                    <?= $p->getRaza() ?>
                                </td>
                                <td>
                                    <?= $p->getSexo() ?>
                                </td>
                                <td>
                                    <?= $p->getPeso() ?>Kg
                                </td>
                                <td>
                                    <?= $p->getEdad() ?> años
                                </td>

                                <td>
                                    <?= $p->getIdCliente()->getNombres() . ' ' . $p->getIdCliente()->getApellidos() ?>
                                </td>

                                <td class="text-center"> <button type="button" onclick="VerFicha(<?= $p->getId() ?>)"> <i
                                            class="fa-solid fa-eye action-icon"></i></button></td>
                                <td class="text-center"><button type="button" onclick="VerHistorial(<?= $p->getId() ?>)"><i
                                            class="fa-solid fa-clipboard-list action-icon"></i></button></td>
                                <td class="text-center">
                                    <a href="index.php?c=Pets&f=EliminarMascota&id=<?= $p->getId() ?>"
                                        onclick="return confirm('¿Estás seguro de eliminar esta mascota?')">
                                        <i class="fa-solid fa-trash btn-delete"></i>
                                    </a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </tbody>
            </table>
        </section>

        <section class="card" aria-labelledby="titulo-citas">
            <div class="card-header">
                <h3>Ultimas Citas</h3>
            </div>

            <table class="table-pets">
                <thead>
                    <tr>
                        <th class="col-id">ID</th>
                        <th class="col-mascota">Mascota</th>
                        <th>Nombre</th>
                        <th>Tipo de Cita</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Detalle de la cita</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($proximacitas): ?>

                        <?php foreach ($proximacitas as $c): ?>
                            <tr>
                                <td>C<?= $c->IdCita ?></td>
                                <td><img src="assets/images/icons/<?= $c->ImagenTipoMascota ?>" class="mascota-avatar"
                                        alt="Perro"></td>
                                <td>
                                    <?= $c->NombreMascota ?>
                                </td>
                                <td>
                                    <?= $c->TipoCita ?>
                                </td>
                                <td>
                                    <?= $c->Fecha ?>
                                </td>
                                <td>
                                    <?= (new DateTime($c->Hora))->format('h:i A') ?>
                                </td>

                                <td class="text-muted"><?= $c->Detalles ?></td>
                                <td class="text-center"><span class="estado">
                                        <?= htmlspecialchars($c->Etapa) ?>
                                    </span></td>
                                <td class="text-center"><button type="button" class="btn-edit"
                                        onclick="EditarCita(<?= $c->IdMascota ?>,<?= $c->IdCita ?>)">
                                        <i class="fa-solid fa-pencil action-icon"></i>
                                    </button></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </tbody>
            </table>
        </section>
    </main>


</body>
<script src="assets/js/scriptpets.js"></script>

</html>