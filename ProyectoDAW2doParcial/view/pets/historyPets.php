<!-- autor: Cadena Herrera Samuel -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Cadena Herrera Samuel Isaac">
    <title>Historial Médico</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styleHistoryPets.css">
</head>

<body>
    <?php
    $fechasCitas = [];

    if ($citas) {
        foreach ($citas as $cit) {
            if ($cit->getFechaCita()) {
                $fecha = $cit->getFechaCita()->format('Y-m-d');
                $fechasCitas[$fecha] = true;
            }
        }
    }
    ?>
    <div id="calendarData" data-citas='<?= json_encode($fechasCitas) ?>'>
    </div>
    <main class="main-container">
        <h1>Historial Medico</h1>

        <section class="profile-section" aria-label="Información de la Mascota">
            <div class="profile-info">
                <div class="avatar-circle">
                    <img src="assets/images/icons/<?= $pet->getTipo()->getRutaIcono() ?>" alt="Harry">
                </div>
                <div class="profile-details">
                    <h2><?= $pet->getNombre() ?>
                        <?php if ($pet->getSexo() === "Macho"): ?>
                            <i class="fa-solid fa-mars gender-icon "></i>
                        <?php elseif ($pet->getSexo() === "Hembra"): ?>
                            <i class="fa-solid fa-venus gender-icon"></i>
                        <?php endif; ?>
                    </h2>

                    <p><?= $pet->getRaza() ?></p>
                </div>
                <div class="profile-stats">
                    <span>Peso: <?= $pet->getPeso() ?>Kg</span>
                    <span>Edad: <?= $pet->getEdad() ?> años</span>
                    <br>
                </div>
            </div>
            <div class="profile-actions">
                <button class="btn-gold" onclick="AgendarVacuna(<?= $pet->getId() ?>)">Agregar Control/Vacunas</button>
                <button class="btn-gold" onclick="AgendarCita(<?= $pet->getId() ?>)">Agendar una Cita</button>
            </div>
        </section>

        <div class="grid-top">

            <section class="card" aria-labelledby="titulo-carta-medica">
                <header class="card-header">
                    <h3 id="titulo-carta-medica">Carta Medica</h3>
                </header>
                <table class="simple-table">
                    <thead>
                        <tr>
                            <th width="20%">Diagnostico</th>
                            <th width="45%">Tratamiento</th>
                            <th width="25%">Control</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($cartas): ?>
                            <?php foreach ($cartas as $fila): ?>

                                <tr>
                                    <td class="text-strong"><?= $fila ? $fila->getDiagnostico() : '' ?></td>
                                    <td><?= $fila ? $fila->getTratamiento() : '' ?></td>
                                    <td><?= $fila ? $fila->getFechaConsulta()->format('Y/m/d') : '' ?></td>
                                    <td style="text-align: left;"> <button type="button"
                                            onclick="EditarCarta(<?= $pet->getId() ?>,<?= $fila->getId() ?>)"><i
                                                class="fa-solid fa-pencil icon-edit"></i></button></i></td>
                                    <td style="text-align: right;"><a
                                            href="index.php?c=Pets&f=EliminarCarta&id=<?= $fila->getId() ?>"
                                            onclick="return confirm('¿Estás seguro de eliminar esta carta?')">
                                            <i class="fa-solid fa-trash icon-trash">
                                        </a></i></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>

            <section class="card" aria-labelledby="titulo-vacunas">
                <header class="card-header">
                    <h3 id="titulo-vacunas">Vacunas</h3>
                </header>
                <table class="simple-table">
                    <thead>
                        <tr>
                            <th width="25%">Enfermedad</th>
                            <th width="25%">Vacuna</th>
                            <th width="20%">Primera</th>
                            <th width="20%">Repetir</th>
                            <th width="5%"></th>
                            <th width="5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($vacunas): ?>
                            <?php foreach ($vacunas as $vac): ?>

                                <tr>
                                    <td class="text-strong"><?= $vac->getVacuna() ?>
                                    <td><?= $vac ? $vac->getEnfermedad() : '' ?></td>
                                    <td><?= $vac ? $vac->getFechaPrimeraDosis()->format('Y/m/d') : 'no aplicada' ?>
                                    </td>
                                    <td>
                                        <?= $vac->getFechaRefuerzo() ? $vac->getFechaRefuerzo()->format('Y/m/d') : 'no necesita' ?>
                                    </td>

                                    <td style="text-align: right;"> <button type="button"
                                            onclick="EditarVacuna(<?= $pet->getId() ?>,<?= $vac->getId() ?>)"><i
                                                class="fa-solid fa-pencil icon-edit"></i></button></i></td>
                                    <td style="text-align: right;"><a
                                            href="index.php?c=Pets&f=EliminarVacuna&id=<?= $vac->getId() ?>"
                                            onclick="return confirm('¿Estás seguro de eliminar esta vacuna?')">
                                            <i class="fa-solid fa-trash icon-trash">
                                        </a></i></td>


                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </tbody>
                </table>
            </section>

        </div>

        <div class="grid-bottom">

            <section class="card calendar-card-container" aria-label="Calendario de Citas">
                <div class="calendar-wrapper">

                    <header class="calendar-header">
                        <span class="current-month" id="currentMonth"></span>

                        <div class="calendar-nav">
                            <i class="fa-solid fa-chevron-left" role="button" aria-label="Mes anterior" tabindex="0"
                                onclick="changeMonth(-1)"></i>

                            <i class="fa-solid fa-chevron-right" role="button" aria-label="Mes siguiente" tabindex="0"
                                onclick="changeMonth(1)"></i>
                        </div>
                    </header>

                    <!-- GRID DEL CALENDARIO -->
                    <div class="calendar-grid" id="calendarGrid"></div>

                </div>
            </section>


            <section class="card" aria-labelledby="titulo-citas-programadas">
                <header class="card-header">
                    <h3 id="titulo-citas-programadas">Citas Programadas</h3>
                </header>
                <div class="citas-list">
                    <?php function fechaFormateada($fecha)
                    {
                        $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                        $timestamp = $fecha->getTimestamp();

                        $dia = date('d', $timestamp);
                        $mes = $meses[date('n', $timestamp) - 1];
                        $anio = date('Y', $timestamp);
                        $hora = date('H:i', $timestamp);

                        return "$dia $mes $anio, $hora";
                    } ?>
                    <?php if ($citas): ?>
                        <?php foreach ($citas as $cit): ?>
                            <article class="cita-item">
                                <div class="cita-info">



                                    <h4><?= fechaFormateada($cit->getFechaCita()) ?></h4>
                                    <p><?= $cit->getDetalles() ?></p>
                                </div>
                                <div class="cita-actions">
                                    <i class="fa-solid fa-pencil icon-edit" role="button" aria-label="Editar cita" tabindex="0"
                                        onclick="EditarCita(<?= $pet->getId() ?>,<?= $cit->getId() ?> )"></i>
                                    <a href="index.php?c=Pets&f=Eliminarcita&id=<?= $cit->getId() ?>"
                                        onclick="return confirm('¿Estás seguro de eliminar esta vacuna?')"><i
                                            class="fa-solid fa-trash icon-trash" role="button" aria-label="Eliminar cita"
                                            tabindex="0"></i></a>
                                </div>
                            </article>
                        <?php endforeach ?>
                    <?php else:
                        echo "no hay citas pendientes";
                    endif;
                    ?>


                </div>
            </section>

        </div>
    </main>


    <script src="assets/js/scriptpets.js"></script>

</body>

</html>