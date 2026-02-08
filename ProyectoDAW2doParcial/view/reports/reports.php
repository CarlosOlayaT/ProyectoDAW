<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link  rel="stylesheet" href="assets/css/styleReports.css">

</head>


<body>


    <div class="page-title">
        <h1>Reportes</h1>
    </div>

    <!-- FACTURAS -->
    <div class="card">
        <div class="card-header">
            <h3>Ultimas Facturas</h3>
        </div>

        <table class="table-reportes">
            <thead>
                <tr>
                    <th class="col-id">ID</th>
                    <th class="col-mascota">Mascota</th>
                    <th>Dueño</th>
                    <th>Ciudad</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($facturas as $f): ?>
                    <tr>
                        <td class="col-id"><?= $f['id'] ?></td>
                        <td class="col-mascota"><img class="icons" src="<?= $f['mascota'] ?>"></td>
                        <td><?= $f['dueno'] ?></td>
                        <td><?= $f['ciudad'] ?></td>
                        <td><?= $f['fecha'] ?></td>
                        <td>$<?= number_format($f['total'], 2) ?></td>
                        <td>
                            <span class="estado <?= estadoClase($f['estado']) ?>">
                                <?= $f['estado'] ?>
                            </span>
                        </td>
                        <td><i class="fa fa-trash"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- CITAS -->
    <div class="card">
        <div class="card-header">
            <h3>Ultimas Citas</h3>
        </div>

        <table class="table-reportes">
            <thead>
                <tr>
                    <th class="col-id">ID</th>
                    <th class="col-mascota">Mascota</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Detalle</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($citas as $c): ?>
                    <tr>
                        <td class="col-id"><?= $c['id'] ?></td>
                        <td class="col-mascota"><img class="icons" src="<?= $c['mascota'] ?>"></td>
                        <td><?= $c['nombre'] ?></td>
                        <td><?= $c['tipo'] ?></td>
                        <td><?= $c['fecha'] ?></td>
                        <td><?= $c['hora'] ?></td>
                        <td><?= $c['detalle'] ?></td>
                        <td>
                            <span class="estado <?= estadoClase($c['estado']) ?>">
                                <?= $c['estado'] ?>
                            </span>
                        </td>
                        <td><i class="fa fa-trash"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


</body>

</html>