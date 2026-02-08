<!-- autor: David Israel Sayay Quito-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content=" David Israel Sayay Quito">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styleCustomerEdit.css">
</head>

<body>

    <main class="modal-card">

        <header class="modal-header">
            <h2>Editar cliente</h2>
        </header>

        <hr class="divider">

        <form action="index.php?c=Customer&f=EditarCliente" method="POST">
            <input type="hidden" id="IdCliente" name="IdCliente" value="<?= $client->getId() ?>">

            <div class="form-row">

                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?= $client->getNombres() ?>">
                </div>

                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="lastName" value="<?= $client->getApellidos() ?>">
                </div>
            </div>

            <div class="form-row">

                <div class="form-group">
                    <label for="email-input">Email*</label>
                    <div class="custom-input-container">
                        <img src="assets/images/mail 1.png" alt="Email" class="inner-icon">
                        <input type="text" id="email-input" name="email" value="<?= $client->getCorreo() ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="cedula">Cedula:</label>
                    <input type="text" id="cedula" name="cedula" value="<?= $client->getCedula() ?>">
                </div>
            </div>

            <div class="form-row ">


                <div class="form-group">
                    <label for="telefono">Telefono:</label>
                    <input type="text" id="telefono" name="telefono" value="<?= $client->getTelefono() ?>">
                </div>

                <div class="form-group">
                    <label for="direccion">Direccion:</label>
                    <input type="text" id="direccion" name="direccion" value="<?= $client->getDireccion() ?>">
                </div>


            </div>

            <hr class="divider">

            <footer class="modal-footer">
                <button type="reset" class="btn btn-cancel" onclick="Cerrar()">Cancelar</button>
                <button type="submit" class="btn btn-save">Guardar</button>
            </footer>

        </form>
    </main>

</body>

</html>