<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\controller\controlador;
use App\Controller\OutraCoisa;

$pagina = new controlador();
echo $pagina->index();


$outra = new outracoisa();
echo $outra->mostrar();

echo geraNumero();