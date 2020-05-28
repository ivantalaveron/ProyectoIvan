<html>
    <head>
        <title>Formularios de la factura</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <?php
        //Vinculo con la clase Factura
        require_once 'Factura.php';
        //Variables de los datos recogidos
        $id_factura=(isset($_POST['id_factura']))?$_POST['id_factura']:'';
        $id_cliente=(isset($_POST['id_cliente']))?$_POST['id_cliente']:'';
        $id_coche=(isset($_POST['id_coche']))?$_POST['id_coche']:'';
        $fecha=(isset($_POST['fecha']))?$_POST['fecha']:'';
        $garantia=(isset($_POST['garantia']))?$_POST['garantia']:'';
        $precio=(isset($_POST['precio']))?$_POST['precio']:'';
        //registrar nueva factura
        if (isset($_POST['registrar'])){
            $comprobacion = Factura::buscarPorId($id_factura);
            if($comprobacion){
              echo 'No se pudo insertar debido a que ya hay un registro con es ID';
           }else{
              $insertar = new Factura ($id_factura, $id_cliente, $id_coche, $fecha, $garantia, $precio);
              $insertar->insertar();
              echo 'Se han guardado los cambios correctamente';
           }
        }
        //Modificar una factura
        elseif (isset($_POST['modificar'])) {
            $comprobacion = Factura::buscarPorId($id_factura);
            if($comprobacion){
                $modifica = new Factura($id_factura, $id_cliente, $id_coche, $fecha, $garantia, $precio);
                $modifica->modificar();
                echo 'Se han guardado todos los cambios correctamente';
            }else{
                echo 'No se puede modificar los datos ya que no existe registro con ese ID';
            }
        }
        //Consultar una factura
        elseif (isset($_POST['consultar'])) {
            $consulta = Factura::buscarPorId($id_factura);
            if($consulta){
                echo 'Id de la factura: ' . $consulta->get_id_factura() . '<br/>';
                echo 'Id del cliente: ' . $consulta->get_id_cliente() . '<br/>';
                echo 'Id del coche: ' . $consulta->get_id_coche() . '<br/>';
                echo 'Fecha de compra: ' . $consulta->get_fecha() . '<br/>';
                echo 'Fecha de garantia: ' . $consulta->get_garantia() . '<br/>';
                echo 'Precio: ' . $consulta->get_precio() . '€';
                
            }else{
                echo 'El personaje no ha podido ser encontrado';
             }
        }
        // Eliminar un coche
        elseif(isset($_POST['eliminar'])){
            $comprobacion = Factura::buscarPorId($id_factura);
            if($comprobacion){
                $elimina = Factura::eliminar($id_factura);
                echo 'Se ha eliminado correctamente';
            }else{
                echo 'No se puede eliminar ya que no existe ningun registro con esa ID';
            }
        }
        //Volver a la página de Inicio
        elseif(isset($_POST['volver'])){
            header('Location:./index.php');
        }
        else{ ?>
        <h1>Facturas</h1>
        <form action="" method="POST">
            <label>ID de la factura:</label><br/><br/>
            <input type="text" name="id_factura"><br/><br/>

            <label>ID del cliente:</label><br/><br/>
            <input type="text" name="id_cliente"><br/><br/>

            <label>ID del coche:</label><br/><br/>
            <input type="text" name="id_coche"><br/><br/>

            <label>Fecha de compra:</label><br/><br/>
            <input type="date" name="fecha"
                min="2015-01-01" max="2030-12-31"><br/><br/>

            <label>Fecha de garantía:</label><br/><br/>
            <input type="date" name="garantia"
                min="2015-01-01" max="2030-12-31"><br/><br/>

            <label>Precio:</label><br/><br/>
            <input type="text" name="precio"><br/><br/>

            <input type="submit" name="registrar" value="Registrar">
            <input type="submit" name="modificar" value="Modificar">
            <input type="submit" name="consultar" value="Consultar">
            <input type="submit" name="eliminar" value="Eliminar">
            <input type="reset" value="Limpiar">
            <input type="submit" name="volver" value="Volver al Inicio">
        </form>
        <?php } ?>
    </body>
</html>