<!-- autor: Cadena Herrera Samuel -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Cadena Herrera Samuel Isaac">
    <title>Editar Control/Vacunas </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styleHistoryControlPets.css">
</head>

<body>

    <main class="main-container">

        <form id="formVacunasCartas" method="POST" action="index.php?c=Pets&f=GuardarCambios">

            <h1>Editar Control/Vacunas</h1>

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
                                <?php endif; ?></i>
                            </h2>
                            <p class="breed-text"><?= $pet->getRaza() ?></p>
                        </div>

                        <div class="stats-block">
                            <span class="stat-item">Peso: <?= $pet->getPeso() ?>Kg</span>
                            <span class="stat-item">Edad: <?= $pet->getEdad() ?> años</span>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="tipo" value="<?= $tipo ?>">
                <input type="hidden" name="id_registro" value="<?= $esVacuna ? $vac->getId() : $carta->getId() ?>">

                <div class="action-buttons">
                    <button type="reset" class="btn btn-cancel" onclick="Cerrar()">Cancelar</button>
                    <button type="submit" class="btn btn-save">Guardar</button>
                </div>
            </header>
            <div class=" cards-container">
                <section class="white-card"
                    aria-labelledby="titulo-carta-medica  <?= $esVacuna ? 'section-disabled' : '' ?>">

                    <h3>Carta Medica</h3>

                    <div class=" row-inline-inputs">
                        <div class="input-group-compact">
                            <label>Diagnostico:</label>
                            <input name="diagnostico" type="text" class="input-field"
                                value="<?= $carta ? $carta->getDiagnostico() : '' ?>">
                        </div>
                        <div class="input-group-compact">
                            <label>Control:</label>
                            <input name="control" type="date" class="input-field" value=<?= $carta ? $carta->getFechaConsulta()->format('Y-m-d') : '' ?>>
                        </div>
                    </div>

                    <div class="column-input">
                        <label>Tratamiento:</label>
                        <textarea name="tratamiento"
                            class="input-field textarea-large"><?= $carta ? $carta->getTratamiento() : '' ?></textarea>
                    </div>
                </section>

                <section class="white-card" aria-labelledby="titulo-vacunas <?= $esCarta ? 'section-disabled' : '' ?>">
                    <h3>Vacunas</h3>

                    <div class=" form-grid">
                        <label>Enfermedad:</label>
                        <input name="enfermedad" type="text" class="input-field" value=<?= $vac ? $vac->getEnfermedad() : '' ?>>

                        <label>Tipo de Vacuna:</label>
                        <input name="vacuna" type="text" class="input-field" value=<?= $vac ? $vac->getVacuna() : '' ?>>

                        <label>Primera Vacuna:</label>
                        <input name="fecha_p" type="date" class="input-field" value=<?= $vac ? $vac->getFechaPrimeraDosis()->format('Y-m-d') : '' ?>>

                        <label>Repetir Vacuna:</label>
                        <input name="fecha_r" type="date" class="input-field" value=<?= ($vac && $vac->getFechaRefuerzo()) ? $vac->getFechaRefuerzo()->format('Y-m-d') : '' ?>>
                    </div>
                </section>

            </div>
        </form>

    </main>
    <script src="assets/js/scriptpets.js"></script>

</body>

</html>