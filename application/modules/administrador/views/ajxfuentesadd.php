<form id="frmAgregarFTE" name="frmAgregarFTE" method="post" action="">
<br/>
<fieldset style="border: 1px solid #CCCCCC; padding: 10px;">
<legend><b>Datos Establecimiento</b></legend>
	<table>
	<tr>
	  <td>Nro. Establecimiento: </td>
	  <td><input type="hidden" id="txtNumEstab" name="txtNumEstab" value="<?php echo $ultimoEstab+1; ?>"/><?php echo $ultimoEstab+1; ?></td>
	</tr>
	<tr>
	  <td>Nombre: </td>
	  <td><input type="text" id="txtNomEstab" name="txtNomEstab" value="" size="70" class="textbox"/></td>
	</tr>
        <tr>
            <td>Id empresa: </td>
	  <td><input type="text" id="txtNitEmpresa" name="txtNitEmpresa" value="" size="70" class="textbox"/></td>
	</tr>
	<tr>
	  <td>Direcci&oacute;n: </td>
	  <td><input type="text" id="txtDirEstab" name="txtDirEstab" value="" size="70" class="textbox"/></td>
	</tr>
        <tr>
	  <td>Tel&eacute;fono: </td>
	  <td><input type="text" id="idtelefono" name="idtelefono" value="" size="70" class="textbox"/></td>
	</tr>
        <tr>
	  <td>Correo electr&oacute;nico: </td>
	  <td><input type="text" id="idcorreo" name="idcorreo" value="" size="70" class="textbox"/></td>
	</tr>	
	<tr>
	  <td>Departamento: </td>
	  <td><select id="cmbDeptoEstab" name="cmbDeptoEstab" class="select">
	      <option value="-">Seleccione...</option>
	      <?php for ($i=0; $i<count($departamentos); $i++){ ?>
       	     <option value="<?php echo $departamentos[$i]["codigo"]; ?>"><?php echo $departamentos[$i]["nombre"]; ?></option>	
       	  <?php } ?>
	      </select>
	  </td>    
	</tr>
	<tr>
	  <td>Municipio: </td>
	  <td><select id="cmbMpioEstab" name="cmbMpioEstab" class="select">
	      <option value="-">Seleccione...</option>
	      <?php for ($i=0; $i<count($municipios); $i++){ ?>
             <option value="<?php echo $municipios[$i]["codigo"]; ?>"><?php echo $municipios[$i]["nombre"]; ?></option> 
          <?php } ?>
	      </select>
	  </td>    
	</tr>
	<tr>
	  <td>Nombre del contacto: </td>
	  <td><input type="text" id="nom_contacto" name="nom_contacto" value="" size="70" class="textbox"/></td>
	</tr>
        <tr>
	  <td>Comercial: </td>
	  <td><select id="cmbComercial" name="cmbComercial" class="select">
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
	  <td><textarea name="observaciones" rows="5" cols="50"></textarea></td>
	</tr>
	</table>
</fieldset>
<br/>
<input type="submit" id="btnAgregarFuenteInt" name="btnAgregarFuenteInt" value="Agregar Fuente" class="button"/>
</form>