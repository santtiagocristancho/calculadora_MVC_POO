<?php

require_once '../Models/calculadoraModel.php';
$calculadora = new calculadoraController;


class CalculadoraController
{
    
    private $calculadora;

    public function __construct()
    {
        $this->calculadora = new CalculadoraModel();
        var_dump($_REQUEST);
        echo "<hr>";
        if (isset($_REQUEST['c'])) {
            switch ($_REQUEST['c']) {
                case 1: //Almacenar en la base de datos
                    self::store();
                    break;
                case 2: //Ver usuario
                    self::show();
                    break;
                case 3: //Actualizar el registro 
                    self::update();
                    break;
                case 4: //Actualizar el registro 
                    self::delete();
                    break;
                default:
                    self::index();
                    break;
            }
        }
    }

    public function index()
    {
        return $this->calculadora->getAll();
    }

    
    public function store()
    {
        $datos = [
            'n1' => $_REQUEST['n1'],
            'n2' => $_REQUEST['n2'],
            'operacion' => $_REQUEST['operacion']
        ];
        
        
        $result = $this->calculadora->store($datos);
        
        if ($result) {
            header("Location:  ../views/index.php");
            exit();
        }
        
        return $result;
    }
    public function show()
    {
        $id = $_REQUEST['id'];
        header("Location:  ../Views/editar.php?id=$id");
    }

    public function update()
    {

        $datos = [
            'id'        => $_REQUEST['id'],
            'n1'   => $_REQUEST['n1'],
            'n2'   => $_REQUEST['n2'],
            'operacion' => $_REQUEST['operacion']
        ];

        $result = $this->calculadora->update($datos);

        if ($result) {
            header("Location: ../Views/index.php");
        }
        exit();

        return $result;
    }

    public function delete()
    {
        // var_dump($_REQUEST);
        $id = $_REQUEST['id'];
        $result = $this->calculadora->delete($id);
        if ($result) {
            header("Location: ../Views/index.php");
            exit();
        }
    }
}
