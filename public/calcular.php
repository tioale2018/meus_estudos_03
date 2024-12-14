<?php

require_once '../vendor/autoload.php';

use App\Controller\Controlador;
use App\Controller\OutraCoisa;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


// Logger para erros
$log = new Logger('erros');
$log->pushHandler(new StreamHandler('../logs/erros.log', Logger::ERROR));


if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    http_response_code(403); // Forbidden
    echo 'Falha de validação CSRF.';
    exit;
}


if (!isset($_POST['action'], $_POST['numero'])) {
    http_response_code(400); // Bad Request
    echo 'Requisição inválida.';
    exit;
}

$acao   = filter_var($_POST['action'], FILTER_SANITIZE_STRING);
$numero = filter_var($_POST['numero'], FILTER_VALIDATE_FLOAT);

if ($numero === false) {
    http_response_code(422); // Unprocessable Entity
    echo 'Número inválido.';
    exit;
}

try {
    if ($acao === 'somar') {
        echo Controlador::somar($numero);
    } elseif ($acao === 'multiplicar') {
        echo OutraCoisa::multiplicar($numero);
    } else {
        http_response_code(400); // Bad Request
        echo 'Ação desconhecida.';
    }
} catch (Exception $e) {
    $log->error('Erro no processamento: ' . $e->getMessage());
    http_response_code(500); // Internal Server Error
    echo 'Erro no processamento: ' . htmlspecialchars($e->getMessage());
}
