<?php
session_start();
 $menu='pedidos';
 $titulo='Pedidos';
 $ruta="../../";
  include($ruta.'config/Precarga.php');
  include($ruta.'header/header_dashboard.php');
  include($ruta.'dao/Pedidos.php');

  $pedido = new Pedidos('$id','$nombreCliente','$telefono','$montoFinal','$fecha','$id_estado');
  $pedido->setConexion($bd);
  

  if(isset($_GET["id"])){ //Saber si existe la variable
      $pedido->setId($_GET["id"]);
      $pedido->readPedidoID();
      $busca=$pedido->getId_Estado();
    }

    $pedidos=$pedido->readPedidos();


  //________________________EstadoPedido
    include($ruta.'dao/EstadoPedido.php');
    $estado = new EstadoPedido('$id','$estado');
    $estado->setConexion($bd);

    if(isset($_GET["id"])){ //Saber si existe la variable
      $estado->setId($busca);
      $estado->readCategoriaID();
    }
    
    $estados=$estado->readEstado();



  //________________________Productos
    include ($ruta.'dao/Productos.php');
    $producto = new Productos('$id','$producto','$contenido','$precio','$id_categoria','$id_estado');
    $producto->setConexion($bd);
    
     if(isset($_GET["id"])){ //Saber si existe la variable
      $producto->setId($_GET["id"]);
      $producto->readProductoID();
      //$busca1=$producto->getId_Categoria();
      //$busca2=$producto->getId_Estado();
      //echo $producto;
    }

    $productos=$producto->readProducto();

    include ($ruta.'dao/Categoria.php');
?>

            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h3 class="card-title"><?=isset($_GET["id"])?"Editar":"Registrar"?> pedido</h3>
                                </div>
                                <div class="card-body table-full-width table-responsive">

                                    <div class="row">
                                        <form action="listaProductos.php" method="post">
                                            <?php if (isset($_GET['id'])){?>
                                            <div class="col-md-6 pr-1">
                                              <div class="form-group">
                                                <label>Id Pedido</label>
                                                <input type="text" name="id" class="form-control" 
                                                value="<?=$pedido->getId() ?>" readonly>
                                              </div>
                                            </div>
                                            <?php } ?>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Nombre del cliente</label>
                                                    <input type="text" class="form-control" placeholder="Nombre" required name="nombre" 
                                                    <?php if(isset($_GET["id"])){ ?>
                                                                value="<?=$pedido->getNombreCliente()?>"
                                                       <?php }?>
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Telefono </label>
                                                    <input type="number" class="form-control" placeholder="Teléfono" required name="telefono" 
                                                    <?php if(isset($_GET["id"])){ ?>
                                                                value="<?=$pedido->getTelefono()?>"
                                                       <?php }?>
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                            
                                        <div class="row">
                                            
<!--
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Estado del pedido:</label>
                                                    <select name="estadoPedido" class="form-control" required>
                                                    <?php if(isset($_GET["id"])){?>
                                                            <option value="<?=$pedido->getId_Estado()?>">
                                                                <?php $categ= $estado->getEstado()?>
                                                                <?=$estado->getEstado()?> 
                                                            </option>
                                                    <?php }else{?>
                                                            <option value=""> Selecciona una estado</option>
                                                                <?php } ?>
                                                        
                                                        <?php 
                                                        foreach ($estados as $estado){
                                                            if(isset($_GET["id"])){ ?>
                                                                <?php if($categ != $estado->getEstado()){ ?>
                                                                    <option value="<?=$estado->getId()?>">
                                                                        <?=$estado->getEstado()?> 
                                                                    </option>
                                                                <?php } ?>
                                                            <?php }else{ ?>
                                                                
                                                                <option value="<?=$estado->getId()?>">
                                                                    <?=$estado->getEstado()?> 
                                                                </option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            -->

                                        </div>
                                    <h3 class="p-2 alert-dark">Selecciona los productos</h3>
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>ID</th>
                                            <th>Producto</th>
                                            <th>Contenido</th>
                                            <th>Precio</th>
                                            <th>Categoria</th>
                                            <th>Unidades</th>
                                        </thead>
                                        <tbody>


                                            <?php
                                            $i=0;

                                            $palabra='unidades';
                                            $palabra2='idProducto';

                                            foreach ($productos as $producto) {

                                                $idC=$producto->getId_Categoria();

                                                //Instanciar las categorias
                                                $categoria = new Categoria('','');
                                                $categoria->setConexion($bd);

                                                $categoria->setId($idC);
                                                $categoria->readCategoriaID();

                                            ?>
                                              <tr>
                                                <td><?=$producto->getId()?></td>
                                                <td><?=$producto->getProducto()?></td>
                                                <td><?=$producto->getContenido()?></td>
                                                <td>$ <?=$producto->getPrecio()?></td>
                                                <td>  <?=$categoria->getCategoria()?></td>
                                                
                                                    <td>
                                                        <input class="form-control" type="number" min="0" value="0" 
                                                        name="<?=$palabra.$i?>"> 
                                                    
                                                        <input type="hidden" name="<?=$palabra2.$i?>" 
                                                            value="<?=$producto->getId()?>">
                                                    </td>
                                              </tr>
                                                
                                                
                                            <?php 

                                                $i++;
                                            } ?>


                                        </tbody>
                                    </table>
                                        <input type="hidden" name="i" value="<?=$i?>">
                                        <button type="submit" class="btn btn-primary btn-fill btn-round "> Visualizar pedido</button>

                                    </form>

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