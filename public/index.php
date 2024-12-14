<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\controller\controlador;
use App\controller\OutraCoisa;

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo Assíncrono</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css" />
    
</head>
<body>
    <h1>Cálculo Assíncrono</h1>
    <label for="numero">Digite um número:</label>
    <input type="text" id="numero">
    <input type="hidden" id="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
    <a href="#" id="somar">Somar</a>
    <a href="#" id="multiplicar">Multiplicar</a>
    <div id="resultado" style="margin-top: 20px; color: blue;">O resultado aparecerá aqui.</div>

    <script src="./js/funcoes.js?v=<?= filemtime(__DIR__ . '/./js/funcoes.js') ?>"></script>
    <script src="./bootstrap/js/bootstrap.bundle.min.css"></script>
</body>
</html>