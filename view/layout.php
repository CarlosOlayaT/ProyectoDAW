<?php
require_once 'model/DTO/Menu.php';

session_start();
if (!isset($_SESSION['rol'])) {
    header("Location: index.php?c=login");
    exit;
}
$menuModel = new Menu();
$menus = $menuModel->obtenerMenusPorRol($_SESSION['rol']);
$rol = $_SESSION['rol'];
$nombres = $_SESSION['nombres'];
$apellidos = $_SESSION['apellidos'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Vida Animal</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="assets/css/styleSideBar.css" rel="stylesheet">
</head>

<body>

    <div class="dashboard-container">

        <?php require_once SIDEBAR; ?>

        <main class="main-content">
            <?php require_once $content; ?>
        </main>

    </div>

</body>

</html>