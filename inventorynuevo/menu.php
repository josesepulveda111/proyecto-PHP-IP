<?php
    include 'conexion.php';
    session_start();
    if(isset($_SESSION['doc_admin'])){
        $docAdmin=$_SESSION['doc_admin'];
        $consulta="select cambio_contraseña from tbl_administradores where estado='Activo' and doc_admin='$docAdmin'";
        $resultado=mysqli_query($conexion,$consulta) or die ("Fallas en la consulta");
        while($columna=mysqli_fetch_array($resultado)){
            if($columna['cambio_contraseña']==2){
                echo "<script>window.location='login/recuperar_contraseña/codigo_actualizar_contraseña.php';</script>";
            }
        }
   include_once "menu/header.php";

   if(@$_GET['mod']==""){
      $seccion="estadisticas";
   }else 
      if(@ $_GET['mod']=="consultarproductos"){
         $seccion=$_GET['mod'];
      }else
         if(@ $_GET['mod']=="registrarproducto"){
            $seccion=$_GET['mod'];
         }else
            if(@ $_GET['mod']=="actualizarproducto"){
               $seccion=$_GET['mod']; 
            }else
               if(@ $_GET['mod']=="registrarentrada"){
                  $seccion=$_GET['mod'];
               }else
                if(@ $_GET['mod']=="registrarsalida"){
                    $seccion=$_GET['mod'];
                }else
                    if(@ $_GET['mod']=="registrardevolucion"){
                        $seccion=$_GET['mod'];
                    }else
                        if(@ $_GET['mod']=="registrarcategoria"){
                            $seccion=$_GET['mod'];
                        }else
                            if(@ $_GET['mod']=="actualizarcategoria"){
                                $seccion=$_GET['mod'];
                            }else
                                if(@ $_GET['mod']=="productosagotados"){
                                    $seccion=$_GET['mod'];
                                }else
                                    if(@ $_GET['mod']=="consultarproveedores"){
                                        $seccion=$_GET['mod'];
                                    }else
                                        if(@ $_GET['mod']=="registrarproveedor"){
                                            $seccion=$_GET['mod'];
                                        }else
                                            if(@ $_GET['mod']=="actualizarproveedor"){
                                                $seccion=$_GET['mod'];
                                            }else
                                                if(@ $_GET['mod']=="consultarsupermercados"){
                                                    $seccion=$_GET['mod'];
                                                }else
                                                    if(@ $_GET['mod']=="registrarsupermercado"){
                                                        $seccion=$_GET['mod'];
                                                    }else
                                                        if(@ $_GET['mod']=="actualizarsupermercado"){
                                                            $seccion=$_GET['mod'];
                                                        }else
                                                            if(@ $_GET['mod']=="consultarpedidos"){
                                                                $seccion=$_GET['mod'];
                                                            }else
                                                                if(@ $_GET['mod']=="registrarpedido"){
                                                                    $seccion=$_GET['mod'];
                                                                }else
                                                                    if(@ $_GET['mod']=="estadisticas"){
                                                                        $seccion=$_GET['mod'];
                                                                    }else
                                                                        if(@ $_GET['mod']=="consultarentradas"){
                                                                            $seccion=$_GET['mod'];
                                                                        }else
                                                                            if(@ $_GET['mod']=="detalleentrada"){
                                                                                $seccion=$_GET['mod'];
                                                                            }else
                                                                                if(@ $_GET['mod']=="registrarusuario"){
                                                                                    $seccion=$_GET['mod'];
                                                                                }else
                                                                                    if(@ $_GET['mod']=="consultarusuarios"){
                                                                                        $seccion=$_GET['mod'];
                                                                                    }else
                                                                                        if(@ $_GET['mod']=="actualizarusuario"){
                                                                                            $seccion=$_GET['mod'];
                                                                                        }else
                                                                                            if(@ $_GET['mod']=="consultarsalidas"){
                                                                                                $seccion=$_GET['mod'];
                                                                                            }else
                                                                                                if(@ $_GET['mod']=="detallesalida"){
                                                                                                    $seccion=$_GET['mod'];
                                                                                                }else
                                                                                                    if(@$_GET['mod'] == "actualizarcontra"){
                                                                                                        $seccion = $_GET['mod'];
                                                                                                    }else
                                                                                                        if(@$_GET['mod'] == "configuracion"){
                                                                                                            $seccion = $_GET['mod'];
                                                                                                        }

                                        

?>
   <div class="sidebar open">
        <div class="logo-details">
            <i class="icon"><a href="#">IP</a></i>
            <div class="logo_name" id="btnn">Inventory Plus</div>
            <i class='bx bx-menu btnn' id="btn" ></i>
        </div>
        <ul class="nav-links">
            <li class="menu <?php if($seccion=="consultarproductos" or $seccion=="registrarproducto" or $seccion=="actualizarproducto" or $seccion=="registrarentrada" or $seccion=="registrarsalida" or $seccion=="registrardevolucion" or $seccion=="registrarcategoria" or $seccion=="actualizarcategoria" or $seccion=="productosagotados" or $seccion=="consultarentradas" or $seccion=="detalleentrada" or $seccion=="consultarsalidas" or $seccion=="detallesalida"){ echo "showMenu"; } ?>">
                <div class="iocn-link <?php if($seccion == "consultarproductos" or $seccion=="registrarproducto" or $seccion=="actualizarproducto" or $seccion=="registrarentrada" or $seccion=="registrarsalida" or $seccion=="registrardevolucion" or $seccion=="registrarcategoria" or $seccion=="actualizarcategoria" or $seccion=="productosagotados" or $seccion=="consultarentradas" or $seccion=="detalleentrada" or $seccion=="consultarsalidas" or $seccion=="detallesalida"){ echo "active"; } ?>">
                    <a href="menu.php?mod=consultarproductos">
                        <i class='bx bx-barcode' ></i>
                        <span class="link_name">Productos</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <a class="link_name" href="menu.php?mod=consultarproductos"><li>Productos</li></a>
                    <li><a class="<?php if($seccion=="registrarproducto"){ echo "activo"; } ?>" href="menu.php?mod=registrarproducto">Registrar</a></li>
                    <li><a class="<?php if($seccion=="registrarentrada" or $seccion=="consultarentradas" or $seccion=="detalleentrada"){ echo "activo"; } ?>" href="menu.php?mod=registrarentrada">Entradas</a></li>
                    <li><a class="<?php if($seccion=="registrarsalida" or $seccion=="consultarsalidas" or $seccion=="detallesalida"){ echo "activo"; } ?>" href="menu.php?mod=registrarsalida">Salidas</a></li>
                    <li><a class="<?php if($seccion=="registrardevolucion"){ echo "activo"; } ?>" href="menu.php?mod=registrardevolucion">Devoluciones</a></li>
                    <li><a class="<?php if($seccion=="registrarcategoria" or $seccion=="actualizarcategoria"){ echo "activo"; } ?>" href="menu.php?mod=registrarcategoria">Categorías</a></li>
                    <li><a class="<?php if($seccion=="productosagotados"){ echo "activo"; } ?>" href="menu.php?mod=productosagotados">Agotados</a></li>
                </ul>
            </li>
            <li class="menu <?php if($seccion=="consultarproveedores" or $seccion=="registrarproveedor" or $seccion=="actualizarproveedor"){ echo "showMenu";} ?>">
                <div class="iocn-link <?php if($seccion=="registrarproveedor" or $seccion=="consultarproveedores" or $seccion=="actualizarproveedor"){ echo "active";} ?>">
                    <a href="menu.php?mod=consultarproveedores">
                        <i class='bx bxs-package'></i>
                        <span class="link_name">Proveedores</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow' ></i>
                </div>
                <ul class="sub-menu">
                    <a class="link_name" href="menu.php?mod=consultarproveedores"><li>Proveedores</li></a>
                    <li><a class="<?php if($seccion=="registrarproveedor"){ echo "activo"; } ?>" href="menu.php?mod=registrarproveedor">Registrar</a></li>
                </ul>
            </li>
            <li class="menu <?php if($seccion=="consultarsupermercados" or $seccion=="registrarsupermercado" or $seccion=="actualizarsupermercado"){ echo "showMenu";} ?>">
                <div class="iocn-link <?php if($seccion=="consultarsupermercados" or $seccion=="registrarsupermercado" or $seccion=="actualizarsupermercado"){ echo "active";} ?>">
                    <a href="menu.php?mod=consultarsupermercados">
                        <i class='bx bxs-store-alt'></i>
                        <span class="link_name">Supermercados</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <a class="link_name" href="menu.php?mod=consultarsupermercados"><li>Supermercados</li></a>
                    <li><a class="<?php if($seccion=="registrarsupermercado"){ echo "activo"; } ?>" href="menu.php?mod=registrarsupermercado">Registrar</a></li>
                </ul>
            </li>
            <li class="menu <?php if($seccion=="registrarpedido" or $seccion=="consultarpedidos"){ echo "showMenu"; } ?>">
                <div class="iocn-link <?php if($seccion=="registrarpedido" or $seccion=="consultarpedidos"){ echo "active"; } ?>">
                    <a href="menu.php?mod=consultarpedidos">
                        <i class='bx bx-task'></i>
                        <span class="link_name pedidos">Pedidos</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <a class="link_name" href="menu.php?mod=consultarpedidos"><li>Pedidos</li></a>
                    <li><a class="<?php if($seccion=="registrarpedido"){ echo "activo"; } ?>" href="menu.php?mod=registrarpedido">Registrar</a></li>
                </ul>
            </li>
            <li>
                <a class="etiqa <?php if($seccion=="estadisticas"){ echo "active"; } ?>" href="menu.php?mod=estadisticas"><i class='bx bxs-bar-chart-alt-2'></i>
                    <span class="link_name">Estadísticas</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="menu.php?mod=estadisticas">Estadísticas</a></li>
                </ul>
            </li>
            <li class="menu <?php if($seccion=="registrarusuario" or $seccion=="consultarusuarios" or $seccion=="actualizarusuario"){ echo "showMenu"; }?>">
                <div class="iocn-link <?php if($seccion=="registrarusuario" or $seccion=="consultarusuarios" or $seccion=="actualizarusuario"){ echo "active"; }?>">
                    <a href="menu.php?mod=consultarusuarios">
                        <i class='bx bxs-group' ></i>
                        <span class="link_name">Usuarios</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <a class="link_name" href="menu.php?mod=consultarusuarios"><li>Usuarios</li></a>
                    <li><a class="<?php if($seccion=="registrarusuario"){ echo "activo"; } ?>" href="menu.php?mod=registrarusuario">Registrar</a></li>
                </ul>
                
                <!-- <a class="etiqa" href="menu.php?mod=consultarusuarios"><i class='bx bxs-group'></i>
                    <span class="link_name">Usuarios</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="menu.php?mod=consultarusuarios">Usuarios</a></li>
                </ul> -->
            </li>
            <li>
                <a class="etiqa <?php if($seccion=="configuracion"){ echo "active"; } ?>" href="menu.php?mod=configuracion"><i class='bx bxs-cog'></i>
                    <span class="link_name">Configuración</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="menu.php?mod=configuracion">Configuración</a></li>
                </ul>
            </li>
            <li class="profile">
                <div class="profile-details">
                    <img src="#" alt="fotop">
                    <div class="name_job">
                        <div class="name"><?php echo $_SESSION['primer_n'] ." ". $_SESSION['primer_a'] ?></div>
                        <div class="job">SUPERADMINISTRADOR</div>
                    </div>
                </div>
                <a onclick="Modal()"><i class='bx bx-log-out' id="log_out"></i></a>
                <div class="ui basic modal">
                    <div class="ui icon header">
                        <img src="images/icon_logout1.png" class="img_logout">
                        <br>
                        <br>
                        ¿Desea cerrar sesión?
                    </div>
                    <div class="actions">
                        <a href="login/salir.php">
                            <div class="ui green ok inverted button btn_yes">
                                <i class="bx bx-check" id="btn_check"></i>
                                Sí
                            </div>
                        </a>
                        <div class="ui cancel inverted red button btn_no">
                        <i class="bx bx-x btn_cancel"></i>
                        No
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
    <section class="home-section">
        <div class="home-content">
        <?php
        if(@ $_GET['mod']==""){
            require_once("estadisticas/visualizar.php");
        }else 
            if(@ $_GET['mod']=="consultarproductos"){
               require_once("productos/consultarproductos.php");
            }else
                if(@ $_GET['mod']=="registrarproducto"){
                    require_once("productos/formproductos.php");
                }else
                    if(@ $_GET['mod']=="actualizarproducto"){
                        require_once("productos/formactualizar.php");
                    }else
                        if(@ $_GET['mod']=="registrarentrada"){
                            require_once("entradas/formentradas.php");
                        }else
                            if(@ $_GET['mod']=="registrarsalida"){
                                require_once("salidas/formsalidas.php");
                            }else
                                if(@ $_GET['mod']=="registrardevolucion"){
                                    require_once("devoluciones/formdevoluciones.php");
                                }else
                                    if(@ $_GET['mod']=="registrarcategoria"){
                                        require_once("categorias/formcategorias.php");
                                    }else
                                        if(@ $_GET['mod']=="actualizarcategoria"){
                                            require_once("categorias/formactualizar.php");
                                        }else
                                            if(@ $_GET['mod']=="productosagotados"){
                                                require_once("productos/agotados.php");
                                            }else
                                                if(@ $_GET['mod']=="consultarproveedores"){
                                                    require_once("proveedores/consultarproveedores.php");
                                                }else
                                                    if(@ $_GET['mod']=="registrarproveedor"){
                                                        require_once("proveedores/formproveedores.php");
                                                    }else
                                                        if(@ $_GET['mod']=="actualizarproveedor"){
                                                            require_once("proveedores/formactualizar.php");
                                                        }else
                                                            if(@ $_GET['mod']=="consultarsupermercados"){
                                                                require_once("supermercados/consultarsupermercados.php");
                                                            }else
                                                                if(@ $_GET['mod']=="registrarsupermercado"){
                                                                    require_once("supermercados/formsupermercados.php");
                                                                }else
                                                                    if(@ $_GET['mod']=="actualizarsupermercado"){
                                                                        require_once("supermercados/formactualizar.php");
                                                                    }else
                                                                        if(@ $_GET['mod']=="consultarpedidos"){
                                                                            require_once("pedidos/consultarpedidos.php");
                                                                        }else
                                                                            if(@ $_GET['mod']=="registrarpedido"){
                                                                                require_once("pedidos/formpedidos.php");
                                                                            }else
                                                                                if(@ $_GET['mod']=="estadisticas"){
                                                                                    require_once("estadisticas/visualizar.php");
                                                                                }else
                                                                                    if(@ $_GET['mod']=="consultarentradas"){
                                                                                        require_once("entradas/consultar.php");
                                                                                    }else
                                                                                        if(@ $_GET['mod']=="detalleentrada"){
                                                                                            require_once("entradas/detalle.php");
                                                                                        }else
                                                                                            if(@ $_GET['mod']=="consultarusuarios"){
                                                                                                require_once("administradores/administradores.php");
                                                                                            }else
                                                                                                if(@ $_GET['mod']=="registrarusuario"){
                                                                                                    require_once("administradores/formadmin.php");
                                                                                                }else
                                                                                                    if(@ $_GET['mod']=="actualizarusuario"){
                                                                                                        require_once("administradores/formactualizara.php");
                                                                                                    }else
                                                                                                        if(@ $_GET['mod']=="consultarsalidas"){
                                                                                                            require_once("salidas/consultar.php");
                                                                                                        }else
                                                                                                            if(@ $_GET['mod']=="detallesalida"){
                                                                                                                require_once("salidas/detalle.php");
                                                                                                            }else
                                                                                                                if(@$_GET['mod'] == "actualizarcontra"){
                                                                                                                    require_once ("administradores/actualizar_contraseña_admin.php");
                                                                                                                }else
                                                                                                                    if(@$_GET['mod'] == "configuracion"){
                                                                                                                        require_once ("configuracion/configuracion.php");
                                                                                                                    }


                                                                                                        
                                                                                                



         ?>
<script src="/inventorynuevo/js/sidebar.js"></script>
<script>
    function Modal(){
        $('.ui.basic.modal')
            .modal('show')
        ;
    }
</script>

<?php
   include_once "menu/footer.php";
    }else{
        echo "<script>window.location='login/login.php';</script>";   
    }
?>
