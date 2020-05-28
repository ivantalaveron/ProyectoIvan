<html>
    <head>
        <title>Proyecto IAW</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <?php
            if (isset($_POST['aceptar'])){
                $opcion=(isset($_POST['opcion']))?$_POST['opcion']:" ";
                if ($opcion == 'cliente'){
                    header('Location:./Registro_cliente.php');
                }
                elseif ($opcion == 'factura'){
                    header('Location:./Registro_factura.php');
                }
                elseif ($opcion == 'coche'){
                    header('Location:./Registro_coche.php');
                }
                
            }
            else{?>
                <h1>Bienvenido a la aplicación de Iván Talaverón Romero</h1>
                <p>
                    Esta es la aplicación de Iván Talaverón Romero aquí se podrá registrar, modificar, y <br/>
                    eliminar todo los relacionado con los clientes, facturas y coche del concesionario.
                </p>
                <p>
                    Elija uno de las opciones para añadir, modificar o eliminar de estos objetos y pulsa<br/>
                    Aceptar para comenzar
                </p>
                <form action=" " method="POST">
                    <table>
                        <tr>
                            <td><input type="radio" name="opcion" value="cliente"></td>
                            <td>Cliente</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="opcion" value="factura"></td>
                            <td>Factura</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="opcion" value="coche"></td>
                            <td>Coche</td>
                        </tr>
                        </table>
                    
                    <br/><input type="submit" name="aceptar" value="Aceptar">
                </form> 
        <?php } ?>
    </body>
</html>