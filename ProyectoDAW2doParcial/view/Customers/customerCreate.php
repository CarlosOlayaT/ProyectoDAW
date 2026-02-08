<!-- autor: David Israel Sayay Quito -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="David Israel Sayay Quito">
    <title>Crear cliente</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styleCustomerCreate.css">
</head>

<body>

    <main class="modal-card">

        <header class="modal-header">
            <h2>Crear cliente</h2>
        </header>

        <hr class="divider">

        <form action="index.php?c=Customer&f=CrearCliente" method="POST">

            <div class="form-row">

                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Alex" required>
                </div>

                <div class="form-group">
                    <label for="lastName">Apellido:</label>
                    <input type="text" id="lastName" name="lastName" placeholder="Intriago" required>
                </div>
            </div>

            <div class="form-row">

                <div class="form-group">
                    <label for="email-input">Email*</label>
                    <div class="custom-input-container">
                        <img src="assets/images/mail 1.png" alt="Email" class="inner-icon">
                        <input type="text" id="email-input" name="email" placeholder="alexIntriago@gmail.com">
                    </div>
                </div>

                <div class="form-group">
                    <label for="cedula">Cedula:</label>
                    <input type="text" pattern="[0-9]*" inputmode="numeric" maxlength="10" id="cedula" name="cedula"
                        placeholder="3214569871" required>
                </div>
            </div>

            <div class="form-row ">


                <div class="form-group">
                    <label for="number">Telefono:</label>
                    <input type="text" pattern="[0-9]*" inputmode="numeric" maxlength="10" id="number" name="number"
                        placeholder="0923654789">
                </div>

                <div class="form-group">
                    <label for="direction">Direccion:</label>
                    <input type="text" id="direction" name="direction" placeholder="Av. Juan Tanga M" >
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