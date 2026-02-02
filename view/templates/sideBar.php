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
                <a class="nav-item" href="index.php?c=<?= $m['controlador'] ?>&f=<?= $m['funcion'] ?>">
                    <i class="fa-solid <?= $m['icono'] ?>"></i>
                    <span><?= $m['nombre'] ?></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>


    <div class="user-profile">
        <img src="https://i.pinimg.com/736x/7f/0d/23/7f0d2318b0a84e056b167b17fc8d08e2.jpg" alt="Carlos Olaya"
            class="user-avatar">
        <a href="index.php?c=profile">
            <!--index.php?c=login&f=logout-->
            <div class="user-info">
                <span class="user-name"><?php echo $nombres . ' ' . $apellidos ?></span>
                <span class="user-role"><?php echo $rol ?></span>
            </div>
        </a>
    </div>
</aside>




<script src="assets/js/scriptSideBar.js"></script>