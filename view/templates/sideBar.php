<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vida Animal Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="assets/css/styleSideBar.css" rel="stylesheet">

</head>

<body>

    <div class="dashboard-container">

        <aside class="sidebar">
            <div class="brand">
                <div class="brand-logo-container">
                    <img src="assets/images/logo.png" alt="Logo Vida Animal" class="brand-img">
                    <h1 class="brand-text">Vida Animal</h1>
                </div>
            </div>

            <ul class="nav-menu">
                <?php foreach ($menus as $m): ?>
                    <li>
                        <a class="nav-item" href="index.php">
                            <i class="fa-solid <?= $m['icono'] ?>"></i>
                            <span><?= $m['nombre'] ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>


            <div class="user-profile">
                <img src="https://i.pravatar.cc/150?img=11" alt="Carlos Olaya" class="user-avatar">
                <a href="index.php?c=profile">
                    <!--index.php?c=login&f=logout-->
                    <div class="user-info">
                        <span class="user-name"><?php echo $user ?></span>
                        <span class="user-role"><?php echo $rol ?></span>
                    </div>
                </a>
            </div>
        </aside>

        <main class="main-content">
            <h2>Contenido del Panel</h2>
        </main>

    </div>

    <script src="assets/js/scriptSideBar.js"></script>
</body>

</html>