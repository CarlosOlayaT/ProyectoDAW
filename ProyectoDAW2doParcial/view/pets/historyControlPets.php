<!-- autor: Cadena Herrera Samuel -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Cadena Herrera Samuel Isaac">
    <title>Agregar Control/Vacunas </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styleHistoryControlPets.css">
</head>

<body>

    <main class="main-container">
        <form action="index.php?c=Pets&f=GuardarNuevaVacunaControl" method="POST" style="display: contents;">

            <h1>Agregar Control/Vacunas</h1>

            <header class="header-section">
                <div class="profile-info">
                    <figure class="avatar-circle">
                        <input type="hidden" name="id" value="<?= $pet->getId() ?>">
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
                    <button type="submit" class="btn btn-save">Registrar</button>
                </div>
            </header>
            <div class="cards-container">

                <section class="white-card" aria-labelledby="titulo-carta-medica">
                    <h3 id="titulo-carta-medica">Carta Medica</h3>

                    <div class="row-inline-inputs">
                        <div class="input-group-compact">
                            <label for="diagnostico">Diagnostico:</label>
                            <input type="text" id="diagnostico" name="diagnostico" class="input-field">
                        </div>
                        <div class="input-group-compact">
                            <label for="control">Control:</label>
                            <input type="date" id="control" name="control" class="input-field">
                        </div>
                    </div>

                    <div class="column-input">
                        <label for="tratamiento">Tratamiento:</label>
                        <textarea id="tratamiento" name="tratamiento" class="input-field textarea-large"></textarea>
                    </div>
                </section>

                <section class="white-card" aria-labelledby="titulo-vacunas">
                    <h3 id="titulo-vacunas">Vacunas</h3>

                    <div class="form-grid">
                        <label for="enfermedad">Enfermedad:</label>
                        <input type="text" id="enfermedad" name="enfermedad" class="input-field">

                        <label for="tipo_vacuna">Tipo de Vacuna:</label>
                        <input type="text" id="tipo_vacuna" name="tipo_vacuna" class="input-field">

                        <label for="primera_vacuna">Primera Vacuna:</label>
                        <input type="date" id="primera_vacuna" name="primera_vacuna" class="input-field">

                        <label for="repetir_vacuna">Repetir Vacuna:</label>
                        <input type="date" id="repetir_vacuna" name="repetir_vacuna" class="input-field">
                    </div>
                </section>

            </div>

        </form>

    </main>
    <script src="assets/js/scriptpets.js"></script>

</body>

</html>