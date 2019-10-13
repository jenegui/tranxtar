<script type="text/javascript">

    $(function () {

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
        $("#cmbsede").cargarCombo("cmbSubsede", "administrador/actualizarSubsedes");
       $("#cmbDeptoEstab").select2();
       $("#cmbMpioEstab").select2();
       $("#cmbComercial").select2();
       $("#idoperarioext").select2();
       $("#costomanejo").select2();
    });
    
</script>
<form id="frmAgregarFTE" name="frmAgregarFTE" method="post" action="">
<br/>
<fieldset style="border: 1px solid #CCCCCC; padding: 10px;">

	<table>
	<!--tr>
	  <td>Nro. Establecimiento: </td>
	  <td><input type="hidden" id="txtNumEstab" name="txtNumEstab" value="<?php echo $ultimoEstab+1; ?>"/><?php echo $ultimoEstab+1; ?></td>
	</tr-->
	<tr>
	  <td>Nombre: </td>
          <td><input type="text" id="txtNomEstab" name="txtNomEstab" value="" size="35" class="textbox"/><div id="errorNumID"></div></td>
	</tr>
        <tr>
            <td>NIT empresa: </td>
	  <td><input type="text" id="txtNitEmpresa" name="txtNitEmpresa" value="" size="35" class="textbox"/></td>
	</tr>
	<tr>
	  <td>Direcci&oacute;n: </td>
	  <td><input type="text" id="txtDirEstab" name="txtDirEstab" value="" size="35" class="textbox"/></td>
	</tr>
        <tr>
	  <td>Tel&eacute;fono: </td>
	  <td><input type="text" id="idtelefono" name="idtelefono" value="" size="35" class="textbox"/></td>
	</tr>
        <tr>
	  <td>Correo electr&oacute;nico: </td>
	  <td><input type="text" id="idcorreo" name="idcorreo" value="" size="35" class="textbox"/></td>
	</tr>	
	<tr>
	  <td>Departamento: </td>
	  <td><select id="cmbDeptoEstab" name="cmbDeptoEstab" style="width:250px;" class="select">
	      <option value="-">Seleccione...</option>
	      <?php for ($i=0; $i<count($departamentos); $i++){ ?>
       	     <option value="<?php echo $departamentos[$i]["codigo"]; ?>"><?php echo $departamentos[$i]["nombre"]; ?></option>	
       	  <?php } ?>
	      </select>
	  </td>    
	</tr>
	<tr>
	  <td>Municipio: </td>
	  <td><select id="cmbMpioEstab" name="cmbMpioEstab" style="width:250px;" class="select">
	      <option value="-">Seleccione...</option>
	      <?php for ($i=0; $i<count($municipios); $i++){ ?>
             <option value="<?php echo $municipios[$i]["codigo"]; ?>"><?php echo $municipios[$i]["nombre"]; ?></option> 
          <?php } ?>
	      </select>
	  </td>    
	</tr>
	<tr>
	  <td>Nombre del contacto: </td>
	  <td><input type="text" id="nom_contacto" name="nom_contacto" value="" size="35" class="textbox"/></td>
	</tr>
	<tr>
        <td>Costo manejo</td>
        <td>
            <select id="costomanejo" name="costomanejo" class="select guia totalFlete">
                <option value="-">Seleccione...</option>
                <option value="0">0%</option>
                <option value="0.005">0.5%</option>
                <option value="0.01">1%</option>
                <option value="0.015">1.5%</option>
                <option value="0.03">3%</option>
                <option value="0.05">5%</option>
            </select>
        </td>    
    </tr> 
    <tr>
	  <td>Comercial: </td>
	  <td><select id="cmbComercial" name="cmbComercial" style="width:250px;" class="select">
                  <option value="-">Seleccione...</option>
                  <?php
                  for ($i = 0; $i < count($comerciales); $i++) {
                      if ($id_usuario == $comerciales[$i]["num_identificacion"]) {
                          ?> <option value="<?php echo $comerciales[$i]["num_identificacion"]; ?>" selected><?php echo $comerciales[$i]["nom_usuario"]; ?></option> <?php
                      } else {
                          ?>
                          <option value="<?php echo $comerciales[$i]["num_identificacion"]; ?>"><?php echo $comerciales[$i]["nom_usuario"]; ?></option>	
                          <?php
                      }
                  }
                  ?>
              </select>
	  </td>    
	</tr>
        <tr>
	  <td>Observaciones: </td>
	  <td><textarea name="observaciones" rows="5" cols="35"></textarea></td>
	</tr>
	</table>
</fieldset>
<br/>
<input type="submit" id="btnAgregarFuenteInt" name="btnAgregarFuenteInt" value="Agregar Fuente" class="button"/>
</form>
<?php //echo $mensaje ?>