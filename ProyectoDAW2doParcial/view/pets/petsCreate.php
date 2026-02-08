<!-- autor: Cadena Herrera Samuel -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Cadena Herrera Samuel Isaac">
    <title>Crear Mascota</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/stylePetsCreate.css">
</head>

<body>

    <main class="modal-card">

        <header class="modal-header">
            <h2>Crear Mascota</h2>
        </header>

        <hr class="divider">

        <form id="formMascota" method="POST" action="index.php?c=Pets&f=GuardarNuevaMascota">

            <div class="form-row">
                <div class="form-group">
                    <label>Escoja la Mascota</label>
                    <div class="select-wrapper">
                        <select name="idtipo" required>
                            <option value="">Escoje un animal</option>
                            <?php foreach ($types as $type): ?>
                                <option value="<?= $type->getId() ?>"><?= $type->getNombre() ?></option>
                            <?php endforeach; ?>
                        </select>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" placeholder="Coco" required>
                </div>

                <div class="form-group">
                    <label>Especie</label>
                    <input type="text" name="especie" placeholder="Canino/Felino">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Raza</label>
                    <input type="text" name="raza" placeholder="Poodle">
                </div>
                <div class="form-group">
                    <label>Fecha de nacimiento</label>
                    <input type="date" name="FechaNacimiento">
                </div>
                <div class="form-group">
                    <label>Peso</label>
                    <input type="number" name="peso" placeholder="0.00 Kg" step="0.01" min="0">
                </div>
            </div>

            <div class="form-row split-row">
                <div class="form-group">
                    <label>Sexo</label>
                    <div class="checkbox-row">
                        <label class="custom-check">
                            <!-- name debe ser el mismo para ambos radio buttons -->
                            <input type="radio" name="sexo" value="Macho" required> Macho
                        </label>
                        <label class="custom-check">
                            <input type="radio" name="sexo" value="Hembra"> Hembra
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Dueño</label>
                    <div class="select-wrapper">
                        <input type="text" list="clientesList" id="clienteInput" placeholder="Buscar dueño..." required>
                        <input type="hidden" name="id_real" id="input-id-oculto">


                        <datalist id="clientesList">
                            <?php foreach ($clients as $client): ?>
                                <option data-id="<?= $client->getId() ?>"
                                    value="<?= $client->getNombres() . ' ' . $client->getApellidos() ?>">
                                </option>
                            <?php endforeach; ?>
                        </datalist>

                        <!-- ESTE ES EL QUE VIAJA POR POST -->
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <hr class="divider">

            <footer class="modal-footer">
                <button type="button" class="btn btn-cancel" onclick="cerrarPerfil()">Cancelar</button>
                <button type="submit" class="btn btn-save">Guardar</button>
            </footer>
        </form>

    </main>
    <script src="assets/js/scriptpets.js"></script>

</body>

</html>