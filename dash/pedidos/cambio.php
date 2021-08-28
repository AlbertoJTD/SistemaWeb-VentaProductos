<?php 
session_start();
 $menu='pedidos';
 $titulo='Pedidos';
 $ruta="../../";
  include($ruta.'config/Precarga.php');
  include($ruta.'header/header_dashboard.php');
  
  include ($ruta.'dao/Productos.php');
    $producto = new Productos('$id','$producto','$contenido','$precio','$id_categoria','$id_estado');
    $producto->setConexion($bd);
    
     if(isset($_GET["id"])){ //Saber si existe la variable
      $producto->setId($_GET["id"]);
      $producto->readProductoID();
      //$busca=$producto->getId_Categoria();
      //echo $producto;
    }
    
    $productos=$producto->readProducto();
?>

            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title"> Cambio</h4>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <?php 
                                        $pago= $_POST['pago'];
                                        $total= $_POST['total'];

                                        $cambio=$pago-$total;
                                    ?>
                                    <div class="jumbotron alert-success">
                                          <h1 class="display-4">El cambio es de: $ <?=$cambio?></h1>
                                          <hr class="my-4">
                                          <h3>Dinero recibido: $ <?=$pago?></h3>
                                          <a class="btn btn-primary btn-fill btn-lg" href="<?=$ruta?>dash/pedidos/" role="button">Regresar al menu principal</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


           
        </div>
    </div>

 <?php  
  include($ruta.'footer/footer_dashboard.php');
  ?>