<?php 
 require_once 'Conexion.php';
 class Factura { 
    private $id_factura;
    private $id_cliente;
    private $id_coche;
    private $fecha;
    private $garantia;
    private $precio;
    const TABLA = 'FACTURA';
    public function __construct($id_factura, $id_cliente, $id_coche, $fecha, $garantia, $precio) {
        $this->id_factura = $id_factura;
        $this->id_cliente = $id_cliente;
        $this->id_coche = $id_coche;
        $this->fecha = $fecha;
        $this->garantia = $garantia;
        $this->precio = $precio;
    }
    public function devolver(){
        return 'ID de la factura '. $this->id_factura. '</br>'.
               'ID del cliente '. $this->id_cliente. '</br>'.
               'ID del coche '. $this->id_coche. '</br>'.
               'Fecha '. $this->fecha. '</br>'.
               'Garantia '. $this->garantia. '</br>'.
               'Precio '. $this->precio;
    }
    //Get y Set
    public function get_id_factura(){
        return $this->id_factura;
    }
    public function get_id_cliente(){
        return $this->id_cliente;
    }
    public function get_id_coche(){
        return $this->id_coche;
    }public function get_fecha(){
        return $this->fecha;
    }
    public function get_garantia(){
        return $this->garantia;
    }
    public function get_precio(){
        return $this->precio;
    }
    public function set_fecha($fecha){
        $this->fecha = $fecha;
    }
    public function set_garantia($garantia){
        $this->garantia = $garantia;
    }
    public function set_precio($precio){
        $this->precio = $precio;
    }
    //Insertar
    public function insertar(){
        $conexion = new Conexion();
         $insertar = $conexion->prepare('INSERT INTO ' . self::TABLA .' (id_factura, id_cliente, id_coche, fecha, garantia, precio) 
                                        VALUES(:id_factura, :id_cliente, :id_coche, :fecha, :garantia, :precio)');
         $insertar->bindParam(':id_factura', $this->id_factura);
         $insertar->bindParam(':id_cliente', $this->id_cliente);
         $insertar->bindParam(':id_coche', $this->id_coche);
         $insertar->bindParam(':fecha', $this->fecha);
         $insertar->bindParam(':garantia', $this->garantia);
         $insertar->bindParam(':precio', $this->precio);
         $insertar->execute();
         
      }
    //Modificar
    public function modificar(){
        $conexion = new Conexion();
           $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET id_cliente = :id_cliente, id_coche = :id_coche, fecha = :fecha,garantia = :garantia, precio = :precio WHERE id_factura = :id_factura');
           $consulta->bindParam(':id_factura', $this->id_factura);
           $consulta->bindParam(':id_cliente', $this->id_cliente);
           $consulta->bindParam(':id_coche', $this->id_coche);
           $consulta->bindParam(':fecha', $this->fecha);
           $consulta->bindParam(':garantia', $this->garantia);
           $consulta->bindParam(':precio', $this->precio);
           $consulta->execute();
           $conexion = null;
    }
    //Comprobar y buscar
    public static function buscarPorId($id){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA . ' WHERE id_factura = :id');
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $registro = $consulta->fetch();
        if($registro){
            return new self($id, $registro['id_cliente'], $registro['id_coche'], $registro['fecha'], $registro['garantia'], $registro['precio']);
        }else{
            return false;
        }
    }
    //Eliminar
    public static function eliminar($id){
        $conexion = new Conexion();
        $eliminar = $conexion->prepare('DELETE FROM ' . self::TABLA . ' WHERE id_factura = :id_factura');
        $eliminar->bindParam(':id_factura', $id);
        $eliminar->execute();
        $conexion = null;
 }
 }
?>