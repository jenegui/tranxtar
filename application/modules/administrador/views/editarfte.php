<script type="text/javascript">

	$(function(){
		$("#btnPruebas").click(function(){				
			$("#divCambioEST").html("<br/>&iquest; Realmente desea cambiar el estado de este formulario ?");
			$("#divCambioEST").append('<br/><input type="button" id="btnCambiarYES" name="btnCambiarYES" value="Aceptar" class="button"/>'); 
			$("#divCambioEST").append('&nbsp;&nbsp;<input type="button" id="btnCambiarNO" name="btnCambiarNO" value="Cancelar" class="button"/>');
			$("#btnCambiarYES").bind("click", function() {
				var numord = $("#hddNroOrden").val();
				var numest = $("#hddNroEstablecimiento").val();
				var novestado = ($("#cmbNovestado").val()).split("-");
				$.ajax({
					type: "POST",
					url: base_url + "administrador/cambiarFuente",
					data: {'novedad': novestado[0], 'estado': novestado[1], 'numord':numord, 'numest':numest}, 
					dataType: "html", 
				    cache: false,
					success: function(data){
						$("#divCambioEST").css("color","#E00078");
						$("#divCambioEST").css("font-weight","bolder");
						$("#divCambioEST").html("<br/>Se ha modificado el estado del formulario.");
						$("#divCambioEST").effect('slide','',1500,'');				
					}					
				});				
			});
			$("#btnCambiarNO").bind("click", function() {
				  $("#divCambioEST").html("");
			});
		});		
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
  <td width="10%">Nombre Comercial: </td>
  <td><input type="text" id="idnomcomest" name="idnomcomest" value="<?php echo $establecimiento["idnomcom"]; ?>" size="70" class="textbox"/></td>
</tr>
<tr>
  <td>NIT: </td>
  <td><input type="text" id="idsiglaest" name="idsiglaest" value="<?php echo $establecimiento["nit_establecimiento"]; ?>" size="15" class="textbox" readonly="readonly"/></td>
</tr>
<tr>
  <td>Direcci&oacute;n: </td>
  <td><input type="text" id="iddireccest" name="iddireccest" value="<?php echo $establecimiento["iddirecc"]; ?>" size="70" class="textbox"/></td>
</tr>
<tr>
  <td>Tel&eacute;fono: </td>
  <td><input type="text" id="idtelnoest" name="idtelnoest" value="<?php echo $establecimiento["idtelno"]; ?>" size="15" class="textbox"/></td>
</tr>
<!--tr>
  <td>Fax: </td>
  <td><input type="text" id="idfaxnoest" name="idfaxnoest" value="<?php //echo $establecimiento["idfaxno"]; ?>" size="15" class="textbox"/></td>
</tr-->
<tr>
  <td>Correo Electr&oacute;nico: </td>
  <td><input type="text" id="idcorreoest" name="idcorreoest" value="<?php echo $establecimiento["idcorreo"]; ?>" size="70" class="textbox"/></td>
</tr>
<tr>
  <td>Nombre del contacto: </td>
  <td><input type="text" id="nom_contacto" name="nom_contacto" value="<?php echo $establecimiento["nom_contacto"]; ?>" size="70" class="textbox"/></td>
</tr>
<tr>
  <td>Departamento: </td>
  <td><select id="cmbDeptoEst" name="cmbDeptoEst" class="select">
      <option value="-">Seleccione el departamento...</option>
      <?php for ($i=0; $i<count($departamentos); $i++){
      	    	if ($establecimiento["fk_depto"]==$departamentos[$i]["codigo"]){
      ?>    		<option value="<?php echo $departamentos[$i]["codigo"]; ?>" selected="selected"><?php echo utf8_encode($departamentos[$i]["nombre"]); ?></option>
      <?php 	} 
      	    	else{
      ?>    		<option value="<?php echo $departamentos[$i]["codigo"]; ?>"><?php echo utf8_encode($departamentos[$i]["nombre"]); ?></option>
      <?php    	}
      		}
      ?>
      </select>
  </td>
</tr>
<tr>
  <td>Municipio: </td>
  <td><select id="cmbMpioEst" name="cmbMpioEst" class="select">
      <option value="-">Seleccione el municipio...</option>
      <?php for ($i=0; $i<count($municipios); $i++){ 
      			if ($establecimiento["fk_mpio"]==$municipios[$i]["codigo"]){
      ?>			<option value="<?php echo $municipios[$i]["codigo"]; ?>" selected="selected"><?php echo $municipios[$i]["nombre"]; ?></option>
      <?php     }
      			else{
      ?>			<option value="<?php echo $municipios[$i]["codigo"]; ?>"><?php echo $municipios[$i]["nombre"]; ?></option>
      <?php 	}
      		} 
      ?>
      </select>
  </td>
</tr>

<tr>
    <td>Estado: </td>
    <td><select id="estado_establecimiento" name="estado_establecimiento" class="select">
    
    <?php //for ($i=0; $i<count($municipios); $i++){ 
                      if ($establecimiento["estado"]==1){
    ?>                  <option value="1" selected="selected">Activa</option>
                        <option value="0">Inactiva</option>
    <?php     }
                      else{
    ?>			<option value="0" selected="selected">Inactiva</option>
                        <option value="1">Activa</option>
    <?php 	}
            
    ?>
    </select>
    </td> 
</tr>
<tr>
  <td>Observaciones: </td>
  <td><input type="text" id="observaciones" name="observaciones" value="<?php echo $establecimiento["observaciones"]; ?>" size="70" class="textbox"/></td>
</tr>
</table>
<br/>
<!-- Fin Tabla-->
</fieldset>
<br/>
<input type="submit" id="btnActualizarFuente" name="btnActualizarFuente" value="Actualizar Datos" class="button"/>
<br/><br/>
<input type="hidden" id="hddNroEstablecimiento" name="hddNroEstablecimiento" value="<?php echo $establecimiento["nro_establecimiento"]; ?>"/>
</form>
</div>