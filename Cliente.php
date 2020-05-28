<?php 
 require_once 'Conexion.php';
 class Cliente { 
    private $id_cliente;
    private $nombre;
    private $apellido;
    private $direccion;
    private $ciudad;
    private $provincia;
    private $cod_postal;
    private $telefono;
    const TABLA = 'CLIENTE';
    public function __construct($id_cliente, $nombre, $apellido, $direccion, $ciudad, $provincia, $cod_postal, $telefono) {
      $this->id_cliente = $id_cliente;
      $this->nombre = $nombre;
      $this->apellido = $apellido;
      $this->direccion = $direccion;
      $this->ciudad = $ciudad;
      $this->provincia = $provincia;
      $this->cod_postal = $cod_postal;
      $this->telefono = $telefono;
    }
    public function devolver(){
      return 'ID del cliente '. $this->id_cliente. '</br>'.
               'Nombre '. $this->nombre. '</br>'.
               'Apellido '. $this->apellido. '</br>'.
               'Direccion '. $this->direccion. '</br>'.
               'Ciudad '. $this->ciudad. '</br>'.
               'Codigo postal '. $this->cod_postal. '</br>'.
               'Telefono '. $this->telefono;
    }
    //Get y Set
    public function get_id_cliente(){
      return $this->id_cliente;
    } 
    public function get_nombre(){
      return $this->nombre;
    } 
    public function get_apellido(){
      return $this->apellido;
    } 
    public function get_direccion(){
      return $this->direccion;
    } 
    public function get_ciudad(){
      return $this->ciudad;
    } 
    public function get_provincia(){
      return $this->provincia;
    } 
    public function get_cod_postal(){
      return $this->cod_postal;
    } 
    public function get_telefono(){
      return $this->telefono;
    } 
    public function set_nombre($nombre){
      $this->nombre = $nombre;
    }
    public function set_apellido($apellido){
      $this->apellido = $apellido;
    }
    public function set_direccion($direccion){
      $this->direccion = $direccion;
    }
    public function set_ciudad($ciudad){
      $this->ciudad = $ciudad;
    }
    public function set_provincia($provincia){
      $this->provincia = $provincia;
    }
    public function set_cod_postal($cod_postal){
      $this->cod_postal = $cod_postal;
    }
    public function set_telefono($telefono){
      $this->telefono = $telefono;
    }
    //Insertar
    public function insertar(){
      $conexion = new Conexion();
       $insertar = $conexion->prepare('INSERT INTO ' . self::TABLA .' (id_cliente, nombre, apellido, direccion, ciudad, provincia, cod_postal, telefono) 
                                        VALUES(:id_cliente, :nombre, :apellido, :direccion, :ciudad, :provincia, :cod_postal, :telefono)');
       $insertar->bindParam(':id_cliente', $this->id_cliente);
       $insertar->bindParam(':nombre', $this->nombre);
       $insertar->bindParam(':apellido', $this->apellido);
       $insertar->bindParam(':direccion', $this->direccion);
       $insertar->bindParam(':ciudad', $this->ciudad);
       $insertar->bindParam(':provincia', $this->provincia);
       $insertar->bindParam(':cod_postal', $this->cod_postal);
       $insertar->bindParam(':telefono', $this->telefono);
       $insertar->execute();
       
    }
    //Modificar
    public function modificar(){
      $conexion = new Conexion();
         $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET nombre = :nombre, apellido = :apellido, direccion = :direccion, 
                                        ciudad = :ciudad, provincia = :provincia, cod_postal = :cod_postal, telefono = :telefono
                                        WHERE id_cliente = :id_cliente');
         $consulta->bindParam(':nombre', $this->nombre);
         $consulta->bindParam(':apellido', $this->apellido);
         $consulta->bindParam(':direccion', $this->direccion);
         $consulta->bindParam(':ciudad', $this->ciudad);
         $consulta->bindParam(':provincia', $this->provincia);
         $consulta->bindParam(':cod_postal', $this->cod_postal);
         $consulta->bindParam(':telefono', $this->telefono);
         $consulta->bindParam(':id_cliente', $this->id_cliente);
         $consulta->execute();
         $conexion = null;
     }
     //Comprobar y buscar
    public static function buscarPorId($id){
      $conexion = new Conexion();
      $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA . ' WHERE id_cliente = :id');
      $consulta->bindParam(':id', $id);
      $consulta->execute();
      $registro = $consulta->fetch();
      if($registro){
         return new self($id, $registro['nombre'], $registro['apellido'], $registro['direccion'], $registro['ciudad'], $registro['provincia'],
                          $registro['cod_postal'], $registro['telefono'] );
      }else{
         return false;
      }
   }
   //Eliminar
   public static function eliminar($id){
    $conexion = new Conexion();
    $eliminar = $conexion->prepare('DELETE FROM ' . self::TABLA . ' WHERE id_cliente = :id_cliente');
    $eliminar->bindParam(':id_cliente', $id);
    $eliminar->execute();
    $conexion = null;
 }
 }
?>