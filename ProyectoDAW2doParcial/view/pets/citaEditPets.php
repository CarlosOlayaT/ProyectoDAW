<!-- autor: Cadena Herrera Samuel -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Cadena Herrera Samuel Isaac">
    <title>Editar Cita </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styleCitaEditPets.css">

</head>

<body>

    <main class="main-container">
        <form action="index.php?c=Pets&f=GuardarCambiosCita" method="POST" style="display: contents;">

            <h1>Cita Programada</h1>

            <header class="header-section">
                <div class="profile-info">
                    <div class="avatar-circle">
                        <img src="assets/images/icons/<?= $pet->getTipo()->getRutaIcono() ?>" alt="Harry">
                    </div>

                    <div class="text-data-container">
                        <div class="name-block">
                            <h2><?= $pet->getNombre() ?>
                                <?php if ($pet->getSexo() === "Macho"): ?>
                                    <i class="fa-solid fa-mars gender-icon "></i>
                                <?php elseif ($pet->getSexo() === "Hembra"): ?>
                                    <i class="fa-solid fa-venus gender-icon"></i>
                                <?php endif; ?>
                            </h2>
                            <p class="breed-text"><?= $pet->getRaza() ?></p>
                        </div>

                        <div class="stats-block">
                            <span class="stat-item">Peso: <?= $pet->getPeso() ?>Kg</span>
                            <span class="stat-item">Edad: <?= $pet->getEdad() ?> años</span>
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <button type="reset" class="btn btn-cancel" onclick="Cerrar()">Cancelar</button>
                    <button type="submit" class="btn btn-save">Guardar</button>
                </div>
            </header>

            <section class="form-card" aria-label="Detalles de la Cita">
                <input type="hidden" name="id_cita" value="<?= $quote->getId() ?>">

                <div class="form-row">
                    <span class="label-text">Tipo de Cita:</span>
                    <div class="radio-group">
                        <label class="radio-option">
                            <input type="radio" name="tipo_cita" value="Cirugia" <?= $quote->getTipo() === 'Cirugia' ? 'checked' : '' ?>>
                            Cirugía
                        </label>

                        <label class="radio-option">
                            <input type="radio" name="tipo_cita" value="Consulta" <?= $quote->getTipo() === 'Consulta' ? 'checked' : '' ?>>
                            Consulta
                        </label>

                        <label class="radio-option">
                            <input type="radio" name="tipo_cita" value="Vacunas" <?= $quote->getTipo() === 'Vacunas' ? 'checked' : '' ?>>
                            Vacunas
                        </label>
                    </div>
                </div>

                <div class="date-time-row">
                    <span class="label-text">Fecha:</span>
                    <input type="date" name="fecha" class="input-field"
                        value="<?= $quote->getFechaCita()->format('Y-m-d') ?>">

                    <span class="label-text" style="min-width: auto; margin-left: 20px;">Hora:</span>
                    <input type="time" name="hora" class="input-field"
                        value="<?= $quote->getFechaCita()->format('H:i') ?>">
                </div>

                <div class="date-time-row">
                    <span class="label-text">Motivo de la cita:</span>
                    <input type="text" name="detalles" class="input-field" value="<?= $quote->getDetalles() ?>">

                    <span class="label-text" style="min-width: auto; margin-left: 20px;">Estado:</span>
                    <select class="input-field" name="etapa">
                        <option value="Pendiente" <?= $quote->getEtapa() === 'Pendiente' ? 'selected' : '' ?>>
                            Pendiente
                        </option>

                        <option value="Completado" <?= $quote->getEtapa() === 'Completado' ? 'selected' : '' ?>>
                            Completado
                        </option>

                        <option value="No Asistio" <?= $quote->getEtapa() === 'No Asistio' ? 'selected' : '' ?>>
                            No Asistió
                        </option>

                        <option value="Cancelado" <?= $quote->getEtapa() === 'Cancelado' ? 'selected' : '' ?>>
                            Cancelado
                        </option>
                    </select>

                </div>

                <div class="form-row" style="align-items: flex-start;"> <span class="label-text"
                        style="margin-top: 10px;">Observaciones:</span>
                    <textarea class="input-field" name="observaciones"><?= $quote->getObservaciones() ?></textarea>
            </section>

        </form>

    </main>
    <script src="assets/js/scriptpets.js"></script>

</body>

</html>