<?php 
 require_once 'Conexion.php';
 class Coche { 
    private $id_coche;
    private $marca;
    private $modelo;
    private $precio;
    const TABLA = 'COCHE';
    public function __construct($id_coche, $marca, $modelo, $precio) {
        $this->id_coche = $id_coche;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->precio = $precio;
    }
    public function devolver(){
        return 'ID del coche '. $this->id_coche. '</br>'.
               'Marca '. $this->marca. '</br>'.
               'Modelo '. $this->modelo. '</br>'.
               'Precio '. $this->precio;
    }
    //Get y Set
    public function get_id_coche(){
        return $this->id_coche;
    }
    public function get_marca(){
        return $this->marca;
    }
    public function get_modelo(){
        return $this->modelo;
    }
    public function get_precio(){
        return $this->precio;
    }
    public function set_marca($marca){
        $this->marca = $marca;
    }
    public function set_modelo($modelo){
        $this->modelo = $modelo;
    }
     public function set_precio($precio){
        $this->precio = $precio;
    }
    //Insertar
    public function insertar(){
        $conexion = new Conexion();
         $insertar = $conexion->prepare('INSERT INTO ' . self::TABLA .' (id_coche, marca, modelo, precio) VALUES(:id_coche, :marca, :modelo, :precio)');
         $insertar->bindParam(':id_coche', $this->id_coche);
         $insertar->bindParam(':marca', $this->marca);
         $insertar->bindParam(':modelo', $this->modelo);
         $insertar->bindParam(':precio', $this->precio);
         $insertar->execute();
         
      }
    //Modificar
    public function modificar(){
        $conexion = new Conexion();
           $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET marca = :marca, modelo = :modelo, precio = :precio WHERE id_coche = :id_coche');
           $consulta->bindParam(':marca', $this->marca);
           $consulta->bindParam(':modelo', $this->modelo);
           $consulta->bindParam(':precio', $this->precio);
           $consulta->bindParam(':id_coche', $this->id_coche);
           $consulta->execute();
           $conexion = null;
    }
    //Comprobar y buscar
    public static function buscarPorId($id){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA . ' WHERE id_coche = :id');
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $registro = $consulta->fetch();
        if($registro){
            return new self($id, $registro['marca'], $registro['modelo'], $registro['precio']);
        }else{
            return false;
        }
    }
    //Eliminar
    public static function eliminar($id){
        $conexion = new Conexion();
        $eliminar = $conexion->prepare('DELETE FROM ' . self::TABLA . ' WHERE id_coche = :id_coche');
        $eliminar->bindParam(':id_coche', $id);
        $eliminar->execute();
        $conexion = null;
 }
 } 
?>