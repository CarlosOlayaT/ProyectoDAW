<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Vida Animal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/CSS/styleLogin.css">
</head>

<body>

    <div class="watermark-background">
        <img src="assets/images/logo.png" alt="Fondo Vida Animal">
    </div>

    <div class="login-wrapper">
        <div class="login-card">

            <div class="form-content">
                <h2 class="welcome-text">Bienvenido a Vida Animal</h2>

                <div class="toggle-container">
                    <button class="toggle-btn active">Login</button>
                    <button class="toggle-btn">Register</button>
                </div>

                <p class="description">
                    Ingresa tus credenciales para entrar a la veterinaria.
                </p>

                <form method="POST" action="index.php?c=login&f=autenticar">
                        <div class="input-group">
                        <label for="username">Usuario</label>
                        <input type="text" id="username" name="usuario" placeholder="Ingresa tu usuario" required>
                    </div>

                    <div class="input-group">
                        <label for="password">Contraseña</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña"
                                required>
                            <i class="fa-solid fa-eye-slash toggle-password"></i>
                        </div>
                    </div>

                    <div class="options">
                        <label class="remember-me">
                            <input type="checkbox"> Recordarme
                        </label>
                        <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>
                    </div>

                    <button type="submit" class="btn-login">Login</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>