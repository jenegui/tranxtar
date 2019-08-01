<link rel="stylesheet" href="include/tablesorter/css/bootstrap.min.css">
<!-- bootstrap css theme -->
<!--link rel="stylesheet" href="include/tablesorter/css/theme.bootstrap_4.css"-->
<link rel="stylesheet" href="<?php echo base_url("js/tablesorter/css/theme.bootstrap_4.css"); ?>">
<link rel="stylesheet" href="<?php echo base_url("js/tablesorter/css/theme.default.css"); ?>">
<link rel="stylesheet" href="<?php echo base_url("js/tablesorter/css/theme.blue.css"); ?>">
<link rel="stylesheet" href="<?php echo base_url("js/tablesorter/css/theme.green.css"); ?>">
<link rel="stylesheet" href="include/tablesorter/css/theme.grey.css">
<link rel="stylesheet" href="include/tablesorter/css/theme.ice.css">
<link rel="stylesheet" href="include/tablesorter/css/theme.black-ice.css">
<link rel="stylesheet" href="include/tablesorter/css/theme.dark.css">
<link rel="stylesheet" href="include/tablesorter/css/theme.dropbox.css">

<link href="<?php echo base_url("js/tablesorter/dist/css/theme.default.min.css"); ?>" rel="stylesheet">
<script src="<?php echo base_url("js/tablesorter/dist/js/jquery.tablesorter.min.js"); ?>"></script>
<script src="<?php echo base_url("js/tablesorter/dist/js/jquery.tablesorter.widgets.min.js"); ?>"></script>
<script src="include/tablesorter/js/extras/jquery.dragtable.mod.js"></script>
<link rel="stylesheet" href="include/tablesorter/addons/pager/jquery.tablesorter.pager.css">
<script src="include/tablesorter/addons/pager/jquery.tablesorter.pager.js"></script>
<script language="javascript">
   /* var jq = jQuery.noConflict(true);
    jq(document).ready(function ($) {
        $(".botonExcel").click(function () {
            $("#reporte_hdd").val($("<div>").append($("#reporte").eq(0).clone()).html());
            $("#FormularioExportacion").submit();
        });


    });
    jq('.collapse').collapse();*/
    
    $(function () {

    $('.tablesorter').tablesorter({
    theme: "green",
            checkboxClass: 'checked', // default setting
            widthFixed: true,
            headerTemplate : '{content} {icon}',
            widgets: ["zebra", "stickyHeaders", "filter", "uitheme", "output"],
            usNumberFormat: false,
            sortReset: true,
            sortRestart: true

    });
        
//     $( ".status" ).each(function(){
//       var value = parseInt( $( this ).html() );
//       if ( value < 0 )
//       {
//           $( this ).parent().css('color', 'red');
//       }
//   });
   
    });
</script>
<br/>
<form id="frmDir" name="frmDir" method="post" action="<?php echo site_url("administrador/descargadirectorio"); ?>"></form>
<div class="row">
    <div class="fivecol"><h1>&nbsp; &nbsp;  &nbsp;Reporte hist&oacute;rico Guias</h1></div>
    <div style="text-align: right;" class="sixcol">
        <?php
        if ($usuario == 6) {
            $campo1 = "Estado contable";
            $campo2 = "Estado Recaudo";
            $campo3 = "Valor flete";
        } elseif ($usuario == 2) {
            $campo1 = "Imprimir";
            $campo2 = "Estado control";
            $campo3 = "Valor flete";
        } elseif ($usuario == 7) {
            $campo1 = "Imprimir";
            $campo2 = "Fecha registro";
            $campo3 = "Unidades";
        } else {
            $campo1 = "Imprimir";
            $campo2 = "Fecha registro";
            $campo3 = "Valor flete";
        }
        
        ?>
    </div>
</div>
<br/>
               
<div id="divDirectorio" class="table-responsive">
    <table class="tablesorter" width="100%" style="font-size: 11px;" class="table">
        <thead>
            <tr>
                <th>No. Guia</th>
                <th>No. Remesa</th>
                <th>No. Identificaci&oacute;n cliente</th>
                <th>Nombre cliente</th>
                <th>Ciudad cliente</th>
                <th>Fecha recogida</th>
                <th>Fecha entrega</th>
                <th>Nombre destinatario</th>
                <th>Ciudad Destinatario</th>
                <th>Departamento Destinatario</th>
                <th>Direcci&oacute;n Destinatario</th>
                <th>Forma de pago</th>
                <th>Unidades</th>
                <th>Valor flete</th>
                <th>Tipo de carga</th>
                <th>Estatus de la carga</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($control); $i++) {
                $class = (($i % 2) == 0) ? "row1" : "row2";
                if($control[$i]['forma_pago']==1){
                    $forma_pago="Contado";
                }elseif ($control[$i]['forma_pago']==2) {
                    $forma_pago="Contra entrega";
                }elseif ($control[$i]['forma_pago']==3) {
                    $forma_pago="Cr&eacute;dito";
                }
                ?>
                <tr>
                    <td><?php echo $control[$i]['id_control']; ?></td> 
                    <td><?php echo $control[$i]['nroRemesa']; ?></td> 
                    <td><?php echo $control[$i]['id_establecimientos']; ?></td> 
                    <td><?php echo $control[$i]['idnomcom']; ?></td> 
                    <td><?php echo $control[$i]['ciudadOrigen']; ?></td> 
                    <td><?php echo $control[$i]['fecha_recogida']; ?></td> 
                    <td><?php echo $control[$i]['fecha_entrega']; ?></td> 
                    <td><?php echo $control[$i]['nombre_destinatario']; ?></td> 
                    <td><?php echo $control[$i]['ciudadDest']; ?></td> 
                    <td><?php echo $control[$i]['deptoDest']; ?></td> 
                    <td><?php echo $control[$i]['direccion_destinatario']; ?></td> 
                    <td><?php echo $forma_pago; ?></td> 
                    <td><?php echo $control[$i]['unidades']; ?></td> 
                    <td><?php echo $control[$i]['total_fletes']; ?></td> 
                    <td><?php echo $control[$i]['tipoCarga']; ?></td> 
                    <td><?php echo $control[$i]['nom_estado']; ?></td> 
                </tr>
            <?php } ?>

        </tbody>

    </table>
</div>


<!-- Div para ageragr empresas -->
<div id="editarCliente" style="display: none">
    <?php
    $data["tipodocs"] = $tipodocs;
    $data["departamentos"] = $departamentos;
    $data["municipios"] = $municipios;
    $data["ultimoEstab"] = $NoEstab;
    $this->load->view("consultarfte", $data);
    ?>
</div>



<!-- Div para agregar establecimientos -->
<div id="agregarGuia" style="display: none">
    <?php
    //Preparo array para terminar de enviarlo como parametro a la vista AJAX
    $this->load->model("establecimiento");
    $this->load->model("usuario");
    $this->load->model("estado");
    $data["tipo_usuario"] = $this->session->userdata("tipo_usuario");
    $data["id_usuario"] = $this->session->userdata('num_identificacion');
    $data["establecimiento"] = $this->establecimiento->obtenerEstablecimientos();
    $data["destinatario"] = $this->usuario->obtenerDestinatarios();
    $data["operarios"] = $this->usuario->obtenerOperariosInternos();
    $data["operariosExt"] = $this->usuario->obtenerOperariosExternos();
    $data["estadocarga"] = $this->estado->estadoCarga();
    $data["tipodocs"] = $tipodocs;
    $data["departamentos"] = $departamentos;
    $data["municipios"] = $municipios;
    $data["ultimoEstab"] = $NoEstab;
    $data["usuario"] = $this->session->userdata("tipo_usuario");
    $this->load->view("ajxguiaadd", $data);
    ?>
</div>
<!-- Div para remover fuentes -->
