<?php
$this->load->helper("url");
$url = site_url();
?>

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
<script type="text/javascript">
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
        /*$.fn.cargarCombo = function(element,url){
    return this.change(function(event){
      $.ajax({
        type: "POST",
        url: base_url + url,
        data: "id=" + $(this).val(),
          dataType: "html",
        cache: false,
        success: function(html){
          var target = "#" + element;
          $(target).html("");
          $(html).appendTo(target);                 
        }
      });
    });
  };*/

        $.validator.addMethod("comboBox", function (value, element, param) {
            var idx = (param).toString();
            if ($(element).val() == idx)
                return false;
            else
                return true;
        }, "")

        jQuery(function () {
            jQuery("#frmRegTarifas").validate({
                rules: {
                    cmbDeptoTar: {
                        comboBox: '-'
                    },
                    cmbMpioTar: {
                        comboBox: '-'
                    },
                    valorpesokg: {
                        required: true
                    },
                    valorvolumen: {
                        required: true
                    },
                    valorxunidad: {
                        required: true
                    }
                },
                messages: {
                    cmbDeptoTar: {
                        comboBox: "Seleccione una departamento."
                    },
                    cmbMpioTar: {
                        comboBox: "Seleccione un municipio."
                    },
                    valorpesokg: {
                        required: "El campo valor peso kg es obligatorio."
                    },
                    valorvolumen: {
                        required: "El campo valor volumen es obligatorio."
                    },
                    valorxunidad: {
                        required: "El campo valor por unidad es obligatorio."
                    }
                },
                errorPlacement: function (error, element) {
                    element.after(error);
                    error.css('opacity', '0.47');
                    error.css('z-index', '991');
                    error.css('background', '#ee0101');
                    //error.css('float','right');
                    error.css('position', 'absolute');
                    error.css('margin-top', '1px');
                    error.css('color', '#fff');
                    error.css('font-size', '11px');
                    error.css('border', '2px solid #ddd');
                    error.css('box-shadow', '0 0 6px #000');
                    error.css('-moz-box-shadow', '0 0 6px #000');
                    error.css('-webkit-box-shadow', '0 0 6px #000');
                    error.css('padding', '4px 10px 4px 10px');
                    error.css('border-radius', '6px');
                    error.css('-moz-border-radius', '6px');
                    error.css('-webkit-border-radius', '6px');
                }
            });
        });
        $("#valorpesokg").numerico().largo(8);
        $("#valorvolumen").numerico().largo(8)
        $("#valorxunidad").numerico().largo(8);
        
        $("#cmbDeptoTar").select2();
        $("#cmbMpioTar").select2();
        $("#cmbDeptoTar").cargarCombo("cmbMpioTar", "administrador/actualizarMunicipios");
    });

</script>
<div>
    <form id="frmRegTarifas" name="frmRegTarifas" method="post" action="<?php echo site_url("administrador/editarTarifas"); ?>">
        <br/>
        <fieldset style="border: 1px solid #CCCCCC; padding-top:10px; padding-left:10px;">
            <legend><b>Registro de tarifas</b>&nbsp;</legend>
            <!-- Tabla para mostrar los datos del establecimiento -->
            <table width="100%">
                <tr>
                    <td width="18%">Nombre: </td>
                    <td><input type="text" id="idnomcomest" name="idnomcomest" value="<?php echo $establecimiento["idnomcom"]; ?>" size="25" class="textbox" disabled="disabled"/></td>
                </tr>
                <tr>
                    <td>NIT: </td>
                    <td><input type="text" id="idnitest" name="idnitest" value="<?php echo $establecimiento["nit_establecimiento"]; ?>" size="25" class="textbox" disabled="disabled"/></td>
                </tr>
                <tr>
                    <td>Municipio: </td>
                    <td><input type="text" id="idnomcomest" name="idnomcomest" value="<?php echo $tarifa["nomciudad"]; ?>" size="25" class="textbox" disabled="disabled"/></td>
                </tr>
                <tr>
                    <td>Valor peso Kg: </td>
                    <td><input type="text" id="valorpesokg" name="valorpesokg" value="<?php echo $tarifa["valor_kilo"]; ?>" size="25" class="textbox"/></td>
                </tr>    
                <tr>
                    <td>Valor volumen: </td>
                    <td><input type="text" id="valorvolumen" name="valorvolumen" value="<?php echo $tarifa["valor_volumen"]; ?>" size="25" class="textbox"/></td>
                </tr>    
                <tr>
                    <td>Valor por unidades: </td>
                    <td><input type="text" id="valorxunidad" name="valorxunidad" value="<?php echo $tarifa["valorx_unidad"]; ?>" size="25" class="textbox"/></td>
                </tr>    
            </table>
            <br/>
            <!-- Fin Tabla-->
        </fieldset>
        <br/>
        <input type="submit" id="btnEditTarifas" name="btnEditTarifas" value="Editar tarifas" class="button"/>
        <br/><br/>
        <input type="hidden" id="IdTarifa" name="IdTarifa" value="<?php echo $tarifa["id_tarifa"]; ?>"/>
        <input type="hidden" id="IdEstablecimiento" name="IdEstablecimiento" value="<?php echo $tarifa["id_establecimientos"]; ?>"/>
    </form>
</div>
