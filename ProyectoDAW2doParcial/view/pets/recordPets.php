<!-- autor: Cadena Herrera Samuel -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Cadena Herrera Samuel Isaac">
    <title>Ficha Médica</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styleRecordPets.css">
</head>

<body>


    <main class="modal-card">

        <header class="modal-header">
            <h2>Ficha Médica</h2>
        </header>
        <hr class="divider">

        <form id="formMascota" method="POST" action="index.php?c=Pets&f=actualizar">

            <div class="form-row-3">
                <div class="form-group">
                    <label>Mascota</label>
                    <input name="Tipo" value="<?= htmlspecialchars($pet->getTipo()->getNombre()) ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="Nombre" value="<?= htmlspecialchars($pet->getNombre()) ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Dueño</label>
                    <input id="inputCliente" name="duenioNombre"
                        value="<?= htmlspecialchars($pet->getIdCliente()->getNombres() . ' ' . $pet->getIdCliente()->getApellidos()) ?>"
                        disabled>
                </div>
            </div>

            <div class=" form-row-mixed">
                <div class="form-group">
                    <label>Diagnostico</label>
                    <input type="text" value="<?= htmlspecialchars(string: $Hm?->getDiagnostico() ?? '') ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Fecha de Control</label>
                    <input type="date" name="fecha_control"
                        value="<?= $Hm && $Hm->getFechaConsulta() ? $Hm->getFechaConsulta()->format('Y-m-d') : '' ?>"
                        readonly>

                </div>
            </div>

            <div class="form-row-mixed">
                <div class="form-group">
                    <label>Tratamiento</label>
                    <input type="text" name="tratamiento"
                        value="<?= htmlspecialchars(string: $Hm?->getTratamiento() ?? '') ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Proxima Cita</label>
                    <input type="datetime-local" name="proxima_cita"
                        value="<?= $quote ? $quote->format('Y-m-d H:i') : '' ?>" disabled>
                </div>
            </div>

            <div class=" form-group">
                <label>Observaciones</label>
                <textarea name="observaciones" rows="4"
                    disabled><?= htmlspecialchars($pet->getObservaciones()) ?></textarea>
            </div>

            <hr class="divider">

            <footer class="modal-footer">
                <button type="button" class="btn btn-cancel" onclick="Cerrar()">Cancelar</button>
                <button type="button" class="btn btn-cancel" onclick="habilitarEdicion()">Editar</button>
                <button type="submit" id="btnGuardar" class="btn btn-save" onclick="Guardar()" disabled>Guardar</button>
            </footer>

        </form>
    </main>
    <script src="assets/js/scriptpets.js"></script>

</body>

</html>