<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Perfil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styleProfile.css">
</head>

<body>

    <div class="card-sidebar">
        <div class="header-sidebar">
            <span><?php echo $rol ?></span>
            <a href="#">
                <button class="btn-x" onclick="cerrarPerfil()">&times;</button>
            </a>
        </div>
        <div class="profile-section">
            <img src="https://i.pinimg.com/736x/7f/0d/23/7f0d2318b0a84e056b167b17fc8d08e2.jpg" alt="Admin"
                class="avatar-main">
            <h3>Hola <?php echo $nombres . ' ' . $apellidos ?></h3>
        </div>
        <div class="menu-container">
            <p class="menu-label">Perfiles:</p>
            <div class="menu-item">
                <span class="circle-icon"></span>
                <span>Perfil 1</span>
            </div>
            <div class="menu-item">
                <span class="circle-icon"></span>
                <span>Perfil 2</span>
            </div>
            <a href="index.php?c=login&f=logout">

                <div class="menu-item logout">

                    <div class="icon-box-dark">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </div>
                    <span>Salir de todos los Perfiles</span>

                </div>
            </a>
        </div>
        <button id="openModal" class="btn-gold">Editar Perfil</button>
    </div>

    <div id="modalPerfil" class="modal-overlay">
        <div class="modal-content">
            <div class="header-modal">
                <h2>Editar Perfil</h2>
                <button id="closeModal" class="btn-x">&times;</button>
            </div>
            <hr class="line">

            <form class="form-body">
                <div class="photo-group">
                    <p class="section-title">Foto de Perfil</p>
                    <div class="img-container">
                        <img src="https://manga-jam.com/wp-content/uploads/part20/how_draw_l_death_note_11.jpg"
                            class="img-perfil">
                        <div class="camera-icon-circle">
                            <i class="fa-solid fa-camera"></i>
                        </div>
                    </div>
                </div>

                <div class="inputs-group">
                    <div class="field">
                        <label>Nombre</label>
                        <input type="text" value=<?php echo $nombres ?>>
                    </div>
                    <div class="field">
                        <label>Apellido</label>
                        <input type="text" value=<?php echo $apellidos ?>>
                    </div>
                </div>
            </form>
            <button type="button" class="btn-save-oval">Guardar</button>
        </div>
    </div>

    <script src="assets/js/scriptProfile.js"></script>
</body>

</html>