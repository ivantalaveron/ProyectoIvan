<html>
    <head>
        <title>Formularios de coches</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <?php
        //Vinculo con la clase Coche
        require_once 'Coche.php';
        //Variables de los datos recogidos
        $id_coche=(isset($_POST['id_coche']))?$_POST['id_coche']:'';
        $marca=(isset($_POST['marca']))?$_POST['marca']:'';
        $modelo=(isset($_POST['modelo']))?$_POST['modelo']:'';
        $precio=(isset($_POST['precio']))?$_POST['precio']:'';
        //Registrar un nuevo coche
        if (isset($_POST['registrar'])){
            $comprobacion = Coche::buscarPorId($id_coche);
            if($comprobacion){
              echo 'No se pudo insertar debido a que ya hay un registro con es ID';
           }else{
              $insertar = new Coche ($id_coche, $marca, $modelo, $precio);
              $insertar->insertar();
              echo 'Se han guardado los cambios correctamente';
           } 
        }
        //Modificar un coche
        elseif (isset($_POST['modificar'])) {
            $comprobacion = Coche::buscarPorId($id_coche);
            if($comprobacion){
                $modifica = new Coche($id_coche, $marca, $modelo, $precio);
                $modifica->modificar();
                echo 'Se han guardado todos los cambios correctamente';
            }else{
            echo 'No se puede modificar los datos ya que no existe registro con ese ID';
            } 
        }
        //Consultar un coche
        elseif (isset($_POST['consultar'])) {
            $consulta = Coche::buscarPorId($id_coche);
            if($consulta){
                echo 'Id del coche: ' . $consulta->get_id_coche() . '<br/>';
                echo 'Marca: ' . $consulta->get_marca() . '<br/>';
                echo 'Modelo: ' . $consulta->get_modelo() . '<br/>';
                echo 'Precio: ' . $consulta->get_precio();
                
            }else{
                echo 'El registro no se ha encontrado';
            }
        }
        // Eliminar un coche
        elseif(isset($_POST['eliminar'])){
            $comprobacion = Coche::buscarPorId($id_coche);
            if($comprobacion){
                $elimina = Coche::eliminar($id_coche);
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
        <h1>Coches</h1>
        <form action="" method="POST">
            <label>ID del coche:</label><br/><br/>
            <input type="text" name="id_coche"><br/><br/>

            <label>Marca:</label><br/><br/>
                <?php  $marca = array('Audi','Mercedes','Audi','BMW','Renault','Skoda','Citroen','Ford')?>    
                <select name="marca">
                <?php foreach ($marca as $value) { ?>
                <option value="<?php echo $value ?>"><?php echo $value?>
                <?php } ?>
                </select><br/><br/>

            <label>Modelo:</label><br/><br/>
            <input type="text" name="modelo"><br/><br/>

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