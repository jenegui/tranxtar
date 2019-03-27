<script type="text/javascript">

$(function(){

	$("#unidades").numerico();
	$("#peso").numerico();
	$("#pesovolumen").numerico();
	$("#pesocobrar").numerico();
	$("#flete").numerico();
	$("#valorDeclarado").numerico();
	$("#totalflete").numerico();
	$("#txtNomDest").mayusculas();
	$("#numplaca").mayusculas();
        $("#nom_contacto").mayusculas();
	$("#txtFecRecogida").datepicker();
	$("#txtFecEntrega").datepicker();
	$("#cmbsede").cargarCombo("cmbSubsede","administrador/actualizarSubsedes");
        //$("#idestablecimiento").select2();
 });

</script>
<form id="frmEditarGuiaTS" name="frmEditarGuiaTS" method="post" action="">
<br/>
<fieldset style="border: 1px solid #CCCCCC; padding: 10px;">
<legend><b>Actualizar estado de la carga</b></legend>
	<table>
	<tr>
	  <td>Estado de la carga: </td>
	  <td><select id="estadocarga" name="estadocarga" class="select">
                <option value="-">Seleccione...</option>
                <?php for ($i=0; $i<count($estadocarga); $i++){ 
                    if($control["estado_carga"]==$estadocarga[$i]["id_estado"]){
                ?>
                    <option value="<?php echo $estadocarga[$i]["id_estado"]; ?>" selected="selected"><?php echo $estadocarga[$i]["id_estado"] .'-'. $estadocarga[$i]["nom_estado"]; ?></option> 
                 <?php 	} 
                    else{
                ?>    	<option value="<?php echo $estadocarga[$i]["id_estado"]; ?>"><?php echo $estadocarga[$i]["id_estado"] .'-'. $estadocarga[$i]["nom_estado"]; ?></option>  
                <?php
                    }
                } 
                ?>
              </select>
	  </td>  
	</tr>
        <tr>
	  <td>Observaciones: </td>
	  <td><textarea name="observaciones" rows="5" cols="50"><?php echo $control["observaciones"]; ?></textarea></td>
	</tr>
        </table>
</fieldset>

<br/>
<input type="submit" id="btnEditarGuiaTS" name="btnEditarGuiaTS" value="Editar Guia" class="button"/>
<input type="hidden" id="id_control" name="id_control" value="<?php echo $control["id_control"]; ?>"/>
</form>