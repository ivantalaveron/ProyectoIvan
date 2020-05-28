<?php 
 class Conexion extends PDO { 
   private $tipo_BD = 'mysql';
   private $host = 'localhost';
   private $nombre_BD = 'bd_concesionario';
   private $usuario = 'root';
   private $contrasena = '2asir'; 
   public function __construct() {
      //Sobreescribo el método constructor de la clase PDO.
      try{
         parent::__construct("{$this->tipo_BD}:dbname={$this->nombre_BD};host={$this->host}", $this->usuario, $this->contrasena);
      }catch(PDOException $e){
         echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
         exit;
      }
   } 
 } 
?>