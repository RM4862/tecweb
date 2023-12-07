<?php

abstract class Database {
    protected $conexion;

    public function __construct($bd)
    {
        $this->conexion = @mysqli_connect(
            'localhost',
            'root',
            '9GJBuXtwzDMSU6Ia',
            $bd
        );

        if(!$this->conexion) {
            die('¡Base de datos NO conectada!');
        }
    }
}

class Productos extends Database {
    private $response;

    public function __construct($res = array()) {
        $this->response = $res;
        parent::__construct('marketzone');
    }

    public function add() {
        $data = array(
            'status'  => 'error',
            'message' => 'Ya existe un producto con ese nombre'
        );
        if(isset($_POST['nombre'])) {
            // SE TRANSFORMA EL POST A UN STRING EN JSON, Y LUEGO A OBJETO
            $jsonOBJ = json_decode( json_encode($_POST) );
            // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
            $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
            $result = $this->conexion->query($sql);
            
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
                $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";
                if($this->conexion->query($sql)){
                    $data['status'] =  "success";
                    $data['message'] =  "Producto agregado";
                } else {
                    $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                }
            }
    
            $result->free();
            // Cierra la conexion
            $this->conexion->close();
        }
    
        // SE HACE LA CONVERSIÓN DE ARRAY A JSON
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    public function delete() {
        echo $this->resultado.'<br>';
    }

    public function edit() {
        echo $this->resultado.'<br>';
    }

    public function list() {
        echo $this->resultado.'<br>';
    }

    public function search() {
        echo $this->resultado.'<br>';
    }

    public function single() {
        echo $this->resultado.'<br>';
    }

    public function singleByName() {
        echo $this->resultado.'<br>';
    }

    public function getResponse() {
        echo $this->response.'<br>';
    }
}
