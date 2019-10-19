<link rel="stylesheet" href="<?php echo base_url("css/styles.css"); ?>" type="text/css" media="screen" />
<link href="<?php echo base_url("/css/bootstrap/bootstrap.min.css"); ?>" rel="stylesheet"/>
<link href="<?php echo base_url("/css/bootstrap/sticky-footer-navbar.css"); ?>" rel="stylesheet"/>
<?php
    if($tipo_usuario!=8){
        $telefonoOperarioInterno="No. tel&eacute;fono conductor interno: ". $guia['nroTelefono'];
        $telefonoOperarioExterno="No. tel&eacute;fono conductor externo: ". $guia['telOperario'];
        $observaciones=$guia['observaciones'];
    }else{
        $telefonoOperarioInterno="";
        $telefonoOperarioExterno="";
        $observaciones=$guia['observaciones'];
    }
    echo $tipo_usuario;
?>
<div class="alert alert-success">
    <div><h3>Detalle de la guia No. <?php echo 'G-' . $guia['id_control'] ?></h3></div>
    <div>
        No. de Remesa:  <?php echo $guia['nroRemesa'] ?>
    </div>
    <div>
        Tipo de Carga: <?php echo $guia['tipoCarga'] ?>
    </div>    
    <div>
        Nombre conductor interno: <?php echo $guia['nomUsuario'] ?>
    </div>    
    <div>
        No. de placa del veh&iacute;culo: <?php echo $guia['nro_placa'] ?>
    </div>    
    <div>
        <?php echo $telefonoOperarioInterno; ?>
    </div>    
    <div>
        Nombre conductor externo: <?php echo $guia['nombreOperario'] ?>
    </div>
    <div>
        No. de placa del veh&iacute;culo: <?php echo $guia['placa_ext'] ?>
    </div>    
    <div>
        <?php echo $telefonoOperarioExterno; ?>
    </div> 
    <div>
        Observaciones de la guía: <?php echo $observaciones; ?>
    </div> 
    <hr>Registros de status</hr>
    <div id="divDirectorio" class="alert alert-warning">
        <table width="100%" class="table" style="font-size: 11px;">
            <thead class="thead">
                <tr>
                    <th>Id Estado</th>
                    <th>No. Guia</th>
                    <th>Fecha registro</th>
                    <th>Estado carga</th>
                    <th>Bitácora</th> 
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($estados); $i++) {
                    $class = (($i % 2) == 0) ? "row1" : "row2";
                    //generalmente de carácter personal, con una estructura cronológica que se actualiza regularmente y que se suele dedicar a tratar un tema concreto.
                    ?>
                    <tr class="<?php echo $class; ?>">
                        <td><?php echo $estados[$i]["id_estados"]; ?></td>
                        <td><?php echo $estados[$i]["num_guia"]; ?></td>
                        <td><?php echo $estados[$i]["fechaRegistro"]; ?></td>
                        <td><?php echo $estados[$i]["nomestado"]; ?></td>
                        <td><?php echo $estados[$i]["observaciones"]; ?></td> 
                        <td><?php echo $estados[$i]["nom_usuario"]; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                </tr>
            </tbody>

        </table>
    </div>
</div>
<script language="JavaScript">

function cerrar() {
var ventana = window.self;
ventana.opener = window.self;
ventana.close();
}
setTimeout('cerrar()',500000); //5000 = 5 segundos.
</script>