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

        
        $("#valorpesokg").numerico().largo(8);
        $("#valorvolumen").numerico().largo(8)
        $("#valorxunidad").numerico().largo(8);
        
        $("#cmbDeptoTar").select2();
        $("#cmbMpioTar").select2();
        $("#cmbDeptoTar").cargarCombo("cmbMpioTar", "administrador/actualizarMunicipios");
    });
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
</script>
<div>
    <form id="frmRegTarifas" name="frmRegTarifas" method="post" action="<?php echo site_url("administrador/registrarTarifas"); ?>">
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
                    <td>Departamento:</td>
                    <td><select id="cmbDeptoTar" name="cmbDeptoTar" class="select1">
                            <option value="-">Seleccione el departamento...</option>
                            <?php
                            for ($i = 0; $i < count($departamentos); $i++) {
                                     ?>
                                        <option value="<?php echo $departamentos[$i]["codigo"]; ?>"><?php echo utf8_encode($departamentos[$i]["nombre"]); ?></option>
                                    <?php
                                
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Ciudad: </td>
                    <td><select id="cmbMpioTar" name="cmbMpioTar" class="select1">
                            <option value="-">Seleccione el municipio...</option>
                            <?php
                            for ($i = 0; $i < count($municipios); $i++) {
                                    if (in_array($departamentos[$i]["codigo"], $ciudadesTarifas)) {
                                        echo "Existe Irix";
                                    }
                                    ?>          
                                        <option value="<?php echo $municipios[$i]["codigo"]; ?>"><?php echo $municipios[$i]["codigo"].''.$municipios[$i]["nombre"]; ?></option>
                                    <?php
                                    
                               
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Tipo de carga: </td>
                    <td><select id="tipo_carga" name="tipo_carga" class="select1">
                            <option value="-">Seleccione...</option>
                            <option value="1">Peso</option>
                            <option value="2">Volumen</option>
                            <option value="3">Paquete</option>
                        </select>
                    </td>
                </tr>    
                <tr>
                    <td>Valor tarifa: </td>
                    <td><input type="text" id="valor_tarifa" name="valor_tarifa" value="" size="25" class="textbox"/></td>
                </tr>    
                <tr>
                    <td>Referencia: </td>
                    <td><input type="text" id="referencia" name="referencia" value="" size="25" class="textbox"/></td>
                </tr>  
                <tr>
                    <td>Descripci&oacute;n: </td>
                    <td><input type="text" id="descripcion" name="descripcion" value="" size="25" class="textbox"/></td>
                </tr>    
            </table>
            <br/>
            <!-- Fin Tabla-->
        </fieldset>
        <br/>
        <input type="submit" id="btnRegTarifas" name="btnRegTarifas" value="Registar tarifas" class="button"/>
        <br/><br/>
        <input type="hidden" id="IdEstablecimiento" name="IdEstablecimiento" value="<?php echo $establecimiento["nro_establecimiento"]; ?>"/>
    </form>
</div>
<div id="divDirectorio" class="table-responsive">
    <table class="tablesorter" width="100%" style="font-size: 11px;" class="table">
        <thead>
            <tr>
                <th>Ciudad</th>
                <th>Tipo de carga</th>
                <th>Valor tarifa</th>
                <th>Referencia</th>
                <th>Descripci&oacute;n</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($tarifas); $i++) {
                $class = (($i % 2) == 0) ? "row1" : "row2";
                ?>
                <tr>
                    <td><?php echo $tarifas[$i]['nomciudad']; ?></td> 
                    <td><?php echo $tarifas[$i]['tipo_carga']; ?></td> 
                    <td><?php echo $tarifas[$i]['valor_tarifa']; ?></td> 
                    <td><?php echo $tarifas[$i]['referencia']; ?></td>
                    <td><?php echo $tarifas[$i]['descripcion']; ?></td>
                    <td><a href="<?php echo site_url("administrador/formEditarTarifas/".$tarifas[$i]["id_tarifa"].""); ?>"><img src="<?php echo base_url("images/edit.png"); ?>"/></a>
                    </td>    
                </tr>
            <?php } ?>

        </tbody>

    </table>
</div>  