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
<form id="frmEditarGuiaCon" name="frmEditarGuiaCon" method="post" action="">
<br/>
<fieldset style="border: 1px solid #CCCCCC; padding: 10px;">
<legend><b>Actualizar estado contable</b></legend>
	<table>
	<tr>
	  <td>Estado contable: </td>
	  <td>
                <select id="estadocont" name="estadocont" class="select">
                  <option value="-">Seleccione...</option>
                  <?php 
                        $selected1="";
                        $selected2="";
                        if($control["estado_contable"]==0){
                            $selected1="selected";
                        }else{
                            $selected2="selected";
                        }
                  ?>
                    <option value="0" <?php echo $selected1; ?>>No contabilizado</option>
                    <option value="1" <?php echo $selected2; ?>>Contabilizado</option>
                </select>
	  </td>  
	</tr>
        
	</table>
</fieldset>

<br/>
<input type="submit" id="btnEditarGuiaCon" name="btnEditarGuiaCon" value="Editar Guia" class="button"/>
<input type="hidden" id="id_control" name="id_control" value="<?php echo $control["id_control"]; ?>"/>
</form>