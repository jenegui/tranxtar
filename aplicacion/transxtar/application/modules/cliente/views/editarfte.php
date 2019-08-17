<script type="text/javascript">
    $(function () {
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
            jQuery("#frmEditarFuente").validate({
                rules: {
                    idnitest: {
                        required: true,
                        minlength: 4,
                        maxlength: 20
                    },
                    idnomcomest: {
                        required: true,
                        minlength: 5
                    },
                    iddireccest: {
                        required: true,
                        minlength: 5
                    },
                    idtelnoest: {
                        required: true,
                        minlength: 5
                    },
                    idcorreoest: {
                        required: true,
                        email: true
                    },
                    nom_contacto: {
                        required: true,
                        minlength: 5
                    },
                    cmbDeptoEst: {
                        comboBox: '-'
                    },
                    cmbMpioEst: {
                        comboBox: '-'
                    }
                },
                messages: {
                    idnitest: {
                        required: "El campo del NIT es obligatorio",
                        minlength: $.format("Necesitamos por lo menos {0} caracteres"),
                        maxlength: $.format("{0} caracteres son demasiados!")
                    },
                    idnomcomest: {
                        required: "El campo del nombre es obligatorio",
                        minlength: $.format("Necesitamos por lo menos {0} caracteres")
                    },
                    iddireccest: {
                        required: "El campo de la dirección es obligatorio",
                        minlength: $.format("Necesitamos por lo menos {0} caracteres")
                    },
                    idtelnoest: {
                        required: "El campo del teléfono es obligatorio",
                        minlength: $.format("Necesitamos por lo menos {0} caracteres")
                    },
                    idcorreoest: {
                        required: "El campo del teléfono es obligatorio",
                        email: "El correo electrónico con es válido"
                    },
                    nom_contacto: {
                        required: "El campo nombre del contacto es obligatorio",
                        minlength: $.format("Necesitamos por lo menos {0} caracteres")
                    },
                    cmbDeptoEst: {
                        comboBox: "Seleccione una departamento."
                    },
                    cmbMpioEst: {
                        comboBox: "Seleccione un municipio."
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

        $("#cmbDeptoEst").select2();
        $("#cmbMpioEst").select2();
        $("#cmbDeptoEst").cargarCombo("cmbMpioEst", "administrador/actualizarMunicipios");
    });

</script>

<div>
    <h1>Editar Cliente</h1>
    <form id="frmEditarFuente" name="frmEditarFuente" method="post" action="<?php echo site_url("administrador/actualizarDatosFuente"); ?>">
        <br/>
        <fieldset style="border: 1px solid #CCCCCC; padding-top:10px; padding-left:10px;">
            <legend><b>Datos del establecimiento</b>&nbsp;</legend>
            <!-- Tabla para mostrar los datos del establecimiento -->
            <table width="100%">
                <tr>
                    <td width="18%">Nombre: </td>
                    <td><input type="text" id="idnomcomest" name="idnomcomest" value="<?php echo $establecimiento["idnomcom"]; ?>" size="25" class="textbox"/></td>
                </tr>
                <tr>
                    <td>NIT: </td>
                    <td><input type="text" id="idnitest" name="idnitest" value="<?php echo $establecimiento["nit_establecimiento"]; ?>" size="25" class="textbox"/></td>
                </tr>
                <tr>
                    <td>Direcci&oacute;n: </td>
                    <td><input type="text" id="iddireccest" name="iddireccest" value="<?php echo $establecimiento["iddirecc"]; ?>" size="25" class="textbox"/></td>
                </tr>
                <tr>
                    <td>Tel&eacute;fono: </td>
                    <td><input type="text" id="idtelnoest" name="idtelnoest" value="<?php echo $establecimiento["idtelno"]; ?>" size="25" class="textbox"/></td>
                </tr>
                <!--tr>
                  <td>Fax: </td>
                  <td><input type="text" id="idfaxnoest" name="idfaxnoest" value="<?php //echo $establecimiento["idfaxno"];   ?>" size="15" class="textbox"/></td>
                </tr-->
                <tr>
                    <td>Correo Electr&oacute;nico: </td>
                    <td><input type="text" id="idcorreoest" name="idcorreoest" value="<?php echo $establecimiento["idcorreo"]; ?>" size="25" class="textbox"/></td>
                </tr>
                <tr>
                    <td>Nombre del contacto: </td>
                    <td><input type="text" id="nom_contacto" name="nom_contacto" value="<?php echo $establecimiento["nom_contacto"]; ?>" size="25" class="textbox"/></td>
                </tr>
                <tr>
                    <td>Departamento: </td>
                    <td><select id="cmbDeptoEst" name="cmbDeptoEst" class="select">
                            <option value="-">Seleccione el departamento...</option>
                            <?php
                            for ($i = 0; $i < count($departamentos); $i++) {
                                if ($establecimiento["fk_depto"] == $departamentos[$i]["codigo"]) {
                                    ?>    		
                                        <option value="<?php echo $departamentos[$i]["codigo"]; ?>" selected="selected"><?php echo utf8_encode($departamentos[$i]["nombre"]); ?></option>
                                    <?php
                                } else {
                                    ?>    		
                                        <option value="<?php echo $departamentos[$i]["codigo"]; ?>"><?php echo utf8_encode($departamentos[$i]["nombre"]); ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Municipio: </td>
                    <td><select id="cmbMpioEst" name="cmbMpioEst" class="select">
                            <option value="-">Seleccione el municipio...</option>
                            <?php
                            for ($i = 0; $i < count($municipios); $i++) {
                                if ($establecimiento["fk_mpio"] == $municipios[$i]["codigo"]) {
                                    ?>			
                                        <option value="<?php echo $municipios[$i]["codigo"]; ?>" selected="selected"><?php echo $municipios[$i]["nombre"]; ?></option>
                                    <?php
                                } else {
                                    ?>			
                                        <option value="<?php echo $municipios[$i]["codigo"]; ?>"><?php echo $municipios[$i]["nombre"]; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Estado: </td>
                    <td><select id="estado_establecimiento" name="estado_establecimiento" class="select">

                            <?php
                            //for ($i=0; $i<count($municipios); $i++){ 
                            if ($establecimiento["estado"] == 1) {
                                ?>                  <option value="1" selected="selected">Activa</option>
                                <option value="0">Inactiva</option>
                                <?php
                            } else {
                                ?>			<option value="0" selected="selected">Inactiva</option>
                                <option value="1">Activa</option>
                            <?php }
                            ?>
                        </select>
                    </td> 
                </tr>
                <tr>
                    <td>Observaciones: </td>
                    <td><input type="text" id="observaciones" name="observaciones" value="<?php echo $establecimiento["observaciones"]; ?>" size="25" class="textbox"/></td>
                </tr>
            </table>
            <br/>
            <!-- Fin Tabla-->
        </fieldset>
        <br/>
        <input type="submit" id="btnActualizarFuente" name="btnActualizarFuente" value="Actualizar Datos" class="button"/>
        <br/><br/>
        <input type="hidden" id="IdEstablecimiento" name="IdEstablecimiento" value="<?php echo $establecimiento["nro_establecimiento"]; ?>"/>
    </form>
</div>