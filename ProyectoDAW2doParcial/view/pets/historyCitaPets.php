<!-- autor: Cadena Herrera Samuel -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Cadena Herrera Samuel Isaac">
    <title>Agendar Cita - Harry</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styleHistoryCitaPets.css">

</head>

<body>

    <main class="main-container">

        <form action="index.php?c=Pets&f=GuardarNuevaCita" method="POST" style="display: contents;">

            <h1>Agendar Cita</h1>
            <input type="hidden" name="id_mascota" value="<?= $pet->getId() ?>">

            <header class="header-section">
                <div class="profile-info">
                    <figure class="avatar-circle">
                        <img src="assets/images/icons/<?= $pet->getTipo()->getRutaIcono() ?>" alt="Foto de perfil">
                    </figure>

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

                <div class="action-buttons">
                    <button type="button" class="btn btn-cancel" onclick="Cerrar()">Cancelar</button>
                    <button type="submit" class="btn btn-save">Guardar Cita</button>
                </div>
            </header>
            <section class="form-card" aria-label="Detalles de la Cita">

                <div class="form-row">
                    <span class="label-text" id="label-tipo-cita">Tipo de Cita:</span>
                    <div class="radio-group" role="radiogroup" aria-labelledby="label-tipo-cita">
                        <label class="radio-option">
                            <input type="radio" name="tipo_cita" value="cirugia"> Cirugia
                        </label>
                        <label class="radio-option">
                            <input type="radio" name="tipo_cita" value="consulta"> Consulta
                        </label>
                        <label class="radio-option">
                            <input type="radio" name="tipo_cita" value="vacunas"> Vacunas
                        </label>
                    </div>
                </div>

                <div class="date-time-row">
                    <label class="label-text" for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" class="input-field">

                    <label class="label-text" for="hora" style="min-width: auto; margin-left: 20px;">Hora:</label>
                    <input type="time" id="hora" name="hora" class="input-field">
                </div>

                <div class="form-row">
                    <label class="label-text" for="motivo">Motivo de la cita:</label>
                    <input type="text" id="motivo" name="motivo" class="input-field">
                </div>

                <div class="form-row" style="align-items: flex-start;">
                    <label class="label-text" for="observaciones" style="margin-top: 10px;">Observaciones:</label>
                    <textarea id="observaciones" name="observaciones" class="input-field"></textarea>
                </div>

            </section>

        </form>

    </main>
    <script src="assets/js/scriptpets.js"></script>

</body>

</html>