<!DOCTYPE html>

<html>
    <head>
        <title>Formularios del cliente</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <?php
        //Vinculo con la clase cliente
        require_once 'Cliente.php';
        //Variables de los datos recogidos
        $id_cliente=(isset($_POST['id_cliente']))?$_POST['id_cliente']:'';
        $nombre=(isset($_POST['nombre']))?$_POST['nombre']:'';
        $apellidos=(isset($_POST['apellidos']))?$_POST['apellidos']:'';
        $direccion=(isset($_POST['direccion']))?$_POST['direccion']:'';
        $ciudad=(isset($_POST['ciudad']))?$_POST['ciudad']:'';
        $provincia=(isset($_POST['provincia']))?$_POST['provincia']:'';
        $cod_postal=(isset($_POST['cod_postal']))?$_POST['cod_postal']:'';
        $telefono=(isset($_POST['telefono']))?$_POST['telefono']:'';
        //Registrar un nuevo cliente
        if (isset($_POST['registrar'])){
            $comprobacion = Cliente::buscarPorId($id_cliente);
            if($comprobacion){
              echo 'No se pudo insertar debido a que ya hay un registro con es ID';
           }else{
              $insertar = new Cliente ($id_cliente, $nombre, $apellidos, $direccion, $ciudad, $provincia, $cod_postal, $telefono);
              $insertar->insertar();
              echo 'Se han guardado los cambios correctamente';
           } 
        }
        //Modificar un cliente
        elseif (isset($_POST['modificar'])) {
            $comprobacion = Cliente::buscarPorId($id_cliente);
            if($comprobacion){
                $modifica = new Cliente($id_cliente, $nombre, $apellidos, $direccion, $ciudad, $provincia, $cod_postal, $telefono);
                $modifica->modificar();
                echo 'Se han guardado todos los cambios correctamente';
            }else{
                echo 'No se puede modificar los datos ya que no existe registro con ese ID';
        }
        }
        //Consultar un cliente
        elseif (isset($_POST['consultar'])) {
            $consulta = Cliente::buscarPorId($id_cliente);
            if($consulta){
                echo 'Id del cliente: ' . $consulta->get_id_cliente() . '<br/>';
                echo 'Nombre: ' . $consulta->get_nombre() . '<br/>';
                echo 'Apellidos: ' . $consulta->get_apellido() . '<br/>';
                echo 'Direccion: ' . $consulta->get_direccion() . '<br/>';
                echo 'Ciudad: ' . $consulta->get_ciudad() . '<br/>';
                echo 'Provincia: ' . $consulta->get_provincia() . '<br/>';
                echo 'Codigo postal: ' . $consulta->get_cod_postal();
            }else{
                echo 'El personaje no ha podido ser encontrado';
            }
        }
        // Eliminar un cliente
        elseif(isset($_POST['eliminar'])){
            $comprobacion = Cliente::buscarPorId($id_cliente);
            if($comprobacion){
                $elimina = Cliente::eliminar($id_cliente);
                echo 'Se ha eliminado correctamente';
            }else{
                echo 'No se puede eliminar ya que no existe ningun registro con esa ID';
            }
        }
        //Volver a la página de Inicio
        elseif(isset($_POST['volver'])){
            header('Location:./index.php');
        }
        //Formulario
        else{ ?>
            <h1>Cliente</h1>
            <form action="" method="POST">
                <label>ID del cliente:</label><br/><br/>
                <input type="text" name="id_cliente"><br/><br/>

                <label>Nombre:</label><br/><br/>
                <input type="text" name="nombre"><br/><br/>

                <label>Apellidos:</label><br/><br/>
                <input type="text" name="apellidos"><br/><br/>

                <label>Dirección:</label><br/><br/>
                <input type="text" name="direccion" value="Calle"><br/><br/>
                <input type="text" name="ciudad" value="Ciudad">
                <input type="text" name="provincia" value="Provincia"><br/><br/>
                <input type="text" name="cod_postal" value="Codigo postal"><br/><br/>

                <label>Teléfono:</label><br/><br/>
                <input type="text" name="telefono"><br/><br/>
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