<?php
require_once('../Models/conexionModel.php');
include_once '../Models/calculadoraModel.php';

$datos = new CalculadoraModel();
$registros = $datos->getbyId($_REQUEST['id']);

foreach ($registros as $operacion) {
    $id        = $operacion->getId();
    $n1   = $operacion->n1;
    $n2   = $operacion->n2;
    $operador  = $operacion->operacion;
    $resultado = $operacion->resultado;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Editar Operación</title>
</head>

<body class="my-3">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Calculadora</h1>
                <hr>
                <h3>Formulario para editar operaciones</h3>
                <form action="../Controllers/CalculadoraController.php" method="post">
                    <input type="hidden" name="c" value="3">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="mb-3">
                        <label for="n1" class="form-label">Número Uno</label>
                        <input type="number" class="form-control" id="n1" name="n1" value="<?= $n1 ?>">
                    </div>
                    <div class="mb-3">
                        <label for="n2" class="form-label">Número Dos</label>
                        <input type="number" class="form-control" id="n2" name="n2" value="<?= $n2 ?>">
                    </div>
                    <div class="mb-3">
                        <label for="operacion" class="form-label">Operación</label>
                        <select class="form-select" id="operacion" name="operacion" value="<?= '' ?>">
                            <option value="1">Sumar</option>
                            <option value="2">Restar</option>
                            <option value="3">Multiplicar</option>
                            <option value="4">Dividir</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary mb-3">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>