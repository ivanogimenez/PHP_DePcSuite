<?php
ini_set("display_errors", 1);
ini_set("display_startup_error", 1);
error_reporting(E_ALL);
session_start();

// Inicializar array si no existe
if (!isset($_SESSION['clientes'])) {
    $_SESSION['clientes'] = [];
}

// Agregar cliente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
    $cliente = [
        'nombre' => $_POST['nombre'],
        'dni' => $_POST['dni'],
        'telefono' => $_POST['telefono'],
        'edad' => $_POST['edad']
    ];
    $_SESSION['clientes'][] = $cliente;
}

// Eliminar un cliente individual
if (isset($_GET['eliminar'])) {
    $index = (int)$_GET['eliminar'];
    if (isset($_SESSION['clientes'][$index])) {
        unset($_SESSION['clientes'][$index]);
        $_SESSION['clientes'] = array_values($_SESSION['clientes']); // Reindexar
    }
}

// Eliminar todos los clientes
if (isset($_GET['borrar_todos'])) {
    $_SESSION['clientes'] = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de clientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row">
        <!-- Formulario -->
        <div class="col-md-4">
            <form method="post" class="bg-white p-4 rounded shadow-sm">
                <h4 class="mb-4">Agregar cliente</h4>
                <div class="mb-3">
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre y apellido" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="dni" class="form-control" placeholder="DNI" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="telefono" class="form-control" placeholder="Teléfono" required>
                </div>
                <div class="mb-3">
                    <input type="number" name="edad" class="form-control" placeholder="Edad" required>
                </div>
                <button type="submit" name="agregar" class="btn btn-primary">Enviar</button>
            </form>
        </div>

        <!-- Tabla de clientes -->
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">Tabla de clientes</h2>
                <?php if (!empty($_SESSION['clientes'])): ?>
                    <a href="?borrar_todos=1" class="btn btn-danger btn-sm"
                       onclick="return confirm('¿Estás seguro de borrar todos los clientes?');">Borrar todos</a>
                <?php endif; ?>
            </div>

            <div class="table-responsive bg-white shadow-sm rounded">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Teléfono</th>
                            <th>Edad</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['clientes'] as $index => $cliente): ?>
                            <tr>
                                <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                                <td><?= htmlspecialchars($cliente['dni']) ?></td>
                                <td><?= htmlspecialchars($cliente['telefono']) ?></td>
                                <td><?= htmlspecialchars($cliente['edad']) ?></td>
                                <td>
                                    <a href="?eliminar=<?= $index ?>" class="btn btn-sm btn-outline-danger"
                                       onclick="return confirm('¿Eliminar este cliente?');">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($_SESSION['clientes'])): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">No hay clientes registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
