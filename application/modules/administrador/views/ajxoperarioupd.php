<script type="text/javascript">
$(function(){
    $("#txtNumId").numerico().largo(18);
    $("#teloperario").numerico().largo(18);
    $("#txtNomUsuario").mayusculas().largo(80); 
            
	$("#cmbsede").cargarCombo("cmbsubsede","administrador/actualizarSubsedes");

	$("#txtFecCreacion").datepicker();
	$("#txtFecVencimiento").datepicker();

	$("#frmUPDusuario").validate({
		//Reglas de Validacion
		rules : {
			cmbTipoDocumento  : {	required   :   true,
									comboBox   :   '-'
			},
			txtNumId          : {	required   :   true
			},
			txtNomUsuario     : {	required   :   true
			},
			txtLogin          : {   required   : true
	        },
	        txtPassword       : {	required   : true
	        },
	        txtEmail          : {	required   : true,
	        						email      : true
	        },
	        txtFecCreacion    : {	required   : true
	        },
	        txtFecVencimiento : {	required   : true
	        },
	        cmbRol            : {	required   : true,
	        						comboBox   :'-'
	        },
	        cmbsede           : {	required   : true,
	        						comboBox   : '-'
	        }
		},
		//Mensajes de validacion
		messages : {
			cmbTipoDocumento  : {	required   :   "Debe indicar el tipo de documento del usuario.",
							        comboBox   :   "Debe indicar el tipo de documento del usuario."
			},
			txtNumId          : {	required   :   "Debe indicar el numero de documento del usuario."
			},
			txtNomUsuario     : {	required   :   "Debe indicar los nombres y apellidos del usuario."
			},
			txtLogin          : {	required   :   "Debe ingresar el login del usuario."
			},
			txtPassword       : {	required   :   "Debe ingresar la contrase&ntilde;a del usuario."
			},
			txtEmail          : {	required   :   "Debe ingresar el email del usuario.",
									email      :   "No es un email v&aacute;lido."
			},
			txtFecCreacion    : {	required   :   "Debe ingresar la fecha de creaci�n del usuario."
			},
			txtFecVencimiento : {	required   :   "Debe ingresar la fecha de vencimiento del usuario."
			},
			cmbRol            : {	required   :   "Debe seleccionar el rol del usuario.",
									comboBox   :   "Debe seleccionar el rol del usuario."
			},
			cmbsede           : {	required   :   "Debe seleccionar la sede del usuario.",
									comboBox   :   "Debe seleccionar la sede del usuario."
			}
		},
		//Mensajes de error
		errorPlacement: function(error, element) {
			element.after(error);
			error.css('display','inline');
			error.css('margin-left','10px');
			error.css('color',"#FF0000");
		},
		submitHandler: function(form) {
			form.submit();
		}
	});

});
</script>
<?php $this->load->helper("url"); ?>
<br/>
<h1>Modificar Operario</h1>
<br/>
<form id="frmUPDusuario" name="frmUPDUsuario" method="post" action="<?php echo site_url("administrador/actualizarOperario"); ?>">
<table width="100%">
<tr>
	<td width="150">Tipo documento: </td>
    <td><select id="cmbTipoDocumento" name="cmbTipoDocumento" class="select">
        <?php
        for ($i = 0; $i < count($tipodoc); $i++) {
            if ($usuario["fk_tipodoc"] == $tipodoc[$i]["id"]){
                echo '<option value="' . $tipodoc[$i]["id"] . '" selected="selected">' . $tipodoc[$i]["nombre"] . '</option>';
            }else{
                echo '<option value="' . $tipodoc[$i]["id"] . '">' . $tipodoc[$i]["nombre"] . '</option>';
            }
        }
        ?>
        </select>
    </td>
</tr>
<tr>
    <td>Num. Identificaci&oacute;n: </td>
    <td><input type="text" id="txtNumId" name="txtNumId" value="<?php echo $operario["nro_identificacion"]; ?>" class="textbox"/></td>
</tr>
<tr>
    <td>Nombre Usuario: </td>
    <td><input type="text" id="txtNomUsuario" name="txtNomUsuario" value="<?php echo $operario["nombre_operario"]; ?>" size="50" class="textbox"/></td>
</tr>
<tr>
    <td>Tel&eacute;fono operario: </td>
    <td><input type="text" id="teloperario" name="teloperario" value="<?php echo $operario["telefono_operario"]; ?>" class="textbox"/></td>
</tr>
<tr>
    <td>N&uacute;mero de placa del veh&iacute;culo: </td>
    <td><input type="text" id="nro_placa" name="nro_placa" value="<?php echo $operario["nro_placa"]; ?>" class="textbox"/></td>
</tr>
<tr>
    <td>Estado: </td>
    <td>
        <select id="estado" name="estado" class="select">
            <?php
            //for ($i = 0; $i < count($roles); $i++) {
                if ($operario["estado_operario"] == 1){
                    echo '<option value="1" selected="selected">Activo</option>';
                    echo '<option value="0">Inactivo</option>';
                }else{
                     echo '<option value="0" selected="selected">Inactivo</option>';
                    echo '<option value="1">Activo</option>';
                }
            //}
            ?>
        </select>
    </td>
</tr>

<tr>
    <td colspan="2">&nbsp;</td>
</tr>
<tr>
    <td colspan="2"><input type="submit" id="btnInsertar" name="btnInsertar" value="Modificar Datos" class="button"/></td>
</tr>
</table>
<input type="hidden" id="hddIndex" name="hddIndex" value="<?php echo $index; ?>"/>
</form>