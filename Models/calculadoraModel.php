<?php
include_once dirname(__FILE__). '../../config/config_example.php';

require_once 'conexionModel.php';


class CalculadoraModel extends stdClass
{
    public $id;
    public $n1;
    public $n2;
    public $operacion;
    public $resultado;
    private $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getbyId($id)
    {
        $operacion = [];

        try {
            $sql = "SELECT * FROM operaciones WHERE id = $id";
            $query  = $this->db->conect()->query($sql);


            while ($row = $query->fetch()) {
                $item            = new CalculadoraModel();
                $item->id        = $row['id'];
                $item->n1   = $row['n1'];
                $item->n2   = $row['n2'];
                $item->operacion = $row['operacion'];
                $item->resultado = $row['resultado'];

                array_push($operacion, $item);
            }

            return $operacion;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    public function getAll()
    {
        $items = [];

        try {

            $sql = 'SELECT operaciones.id, operaciones.n1, operaciones.n2, operacion.nombre AS operacion, operaciones.resultado FROM operaciones JOIN operacion ON operaciones.operacion = operacion.id';
            $query  = $this->db->conect()->query($sql);


            while ($row = $query->fetch()) {
                $item            = new CalculadoraModel();
                $item->id        = $row['id'];
                $item->n1   = $row['n1'];
                $item->n2   = $row['n2'];
                $item->operacion = $row['operacion'];
                $item->resultado = $row['resultado'];

                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function store($datos)
    {

        try {

            $resultado = self::resultadoOperacion($datos);
            $sql = 'INSERT INTO operaciones(n1, n2, operacion, resultado) VALUES(:n1, :n2, :operacion, :resultado)';

            $prepare = $this->db->conect()->prepare($sql);
            $query = $prepare->execute([
                'n1'   => $datos['n1'],
                'n2'   => $datos['n2'],
                'operacion' => $datos['operacion'],
                'resultado' => $resultado,
            ]);

            if ($query) {
                return true;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function update($datos)
    {
        try {

            $resultado = self::resultadoOperacion($datos);
            $sql = 'UPDATE operaciones SET n1 = :n1, n2 = :n2, operacion = :operacion, resultado = :resultado WHERE id = :id';

            $prepare = $this->db->conect()->prepare($sql);
            $query = $prepare->execute([
                'id'        => $datos['id'],
                'n1'   => $datos['n1'],
                'n2'   => $datos['n2'],
                'operacion' => $datos['operacion'],
                'resultado' => $resultado,
            ]);

            if ($query) {
                return true;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM operaciones WHERE id = :id";
            $prepare = $this->db->conect()->prepare($sql);
            $query = $prepare->execute([
                'id'   => $id,
            ]);

            if ($query) {
                return true;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function resultadoOperacion($datos)
    {
        switch ($datos['operacion']) {
            case '1': //Suma
                return $datos['n1'] + $datos['n2'];
                break;
            case '2': //Resta
                # code...
                return $datos['n1'] - $datos['n2'];
                break;
            case '3': //Multiplicación
                return $datos['n1'] * $datos['n2'];
                # code...
                break;
            case '4': //División
                return $datos['n1'] / $datos['n2'];
                # code...
                break;

            default:
                return false;
                break;
        }
    }
}
