<?php

include_once '../Models/calculadoraModel.php';

$datos = new CalculadoraModel();
$registros = $datos->getAll();
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>calculadora</title>
</head>

<body class="m-3">
    <div class="container">
        
        <div class="row">
            <div class="col">
                <h1>Calculadora</h1>
                <form action="../Controllers/calculadoraController.php" method="POST">
                    <input type="hidden" name="c" value="1">
                    <div class="mb-3">
                        <label for="" class="form-label">Número uno </label>
                        <input class="form-control" type="number" name="n1" id="n1">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Número dos</label>
                        <input class="form-control" type="number" name="n2" id="n2">
                    </div>
                    <div class="mb-3">
                        <label for="">Seleccione Operación</label>
                        <select class="form-select" name="operacion" id="operacion">
                            <option value="1">Sumar</option>
                            <option value="2">Restar</option>
                            <option value="3">Multiplicar</option>
                            <option value="4">Dividir</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-sm btn-primary" type="submit">Calcular</button>
                    </div>
                </form>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Primer Numero</th>
                        <th scope="col">Segundo Numero</th>
                        <th scope="col">operacion</th>
                        <th scope="col">Resultado</th>
                        <th scope="col" colspan="2">Opcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($registros) {
                        foreach ($registros as $row) {

                    ?>
                            <tr>

                                <td><?= $row->id ?></td>
                                <td><?= $row->n1 ?></td>
                                <td><?= $row->n2 ?></td>
                                <td><?= $row->operacion ?></td>
                                <td><?= $row->resultado ?></td>
                                <!-- <th scope="col" >Opciones</th> -->
                            
                            <td>
                                <a class="btn btn-sm btn-outline-warning" href="../Controllers/calculadoraController.php?c=2&id=<?= $row->getId() ?>">Actualizar</a>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-outline-danger " href="../Controllers/calculadoraController.php?c=4&id=<?= $row->getId() ?>">Eliminar</a>
                            </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr class=" text-center">
                            <td colspan="6">Sin datos</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>