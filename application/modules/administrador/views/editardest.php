<div>
<h1>Editar Destinatario</h1>
<form id="frmEditarDestinatario" name="frmEditarDestinatario" method="post" action="<?php echo site_url("administrador/actualizarDatosDestinatario"); ?>">
<br/>
<fieldset style="border: 1px solid #CCCCCC; padding-top:10px; padding-left:10px;">
<legend><b>Datos del destinatario</b>&nbsp;</legend>
<!-- Tabla para mostrar los datos del establecimiento -->
<table width="100%">
<tr>
  <td width="15%">Nombre Destinatario: </td>
  <td><input type="text" id="idnomdest" name="idnomdest" value="<?php echo $destinatario["nombre_destinatario"]; ?>" size="70" class="textbox"/></td>
</tr>
<tr>
    <td>No. identificaci&oacute;n: </td>
  <td><input type="text" id="identificacion" name="identificacion" value="<?php echo $destinatario["nro_identificacion"]; ?>" size="15" class="textbox"/></td>
</tr>
<tr>
    <td width="150">Tipo documento: </td>
        <td><select id="tipoDocumento" name="tipoDocumento" class="select">
            <?php
            for ($i = 0; $i < count($tipodocs); $i++) {
                if ($destinatario["tipo_identificacion"] == $tipodocs[$i]["id"]){
                    echo '<option value="' . $tipodocs[$i]["id"] . '" selected="selected">' . $tipodocs[$i]["nombre"] . '</option>';
                }else{
                    echo '<option value="' . $tipodocs[$i]["id"] . '">' . $tipodocs[$i]["nombre"] . '</option>';
                }
            }
            ?>
            </select>
        </td>
    </tr>
<tr>
  <td>Direcci&oacute;n: </td>
  <td><input type="text" id="direccion" name="direccion" value="<?php echo $destinatario["direccion_destinatario"]; ?>" size="70" class="textbox"/></td>
</tr>
<tr>
  <td>Tel&eacute;fono: </td>
  <td><input type="text" id="telefono" name="telefono" value="<?php echo $destinatario["telefono_destinatario"]; ?>" size="15" class="textbox"/></td>
</tr>
<!--tr>
  <td>Fax: </td>
  <td><input type="text" id="idfaxnoest" name="idfaxnoest" value="<?php //echo $establecimiento["idfaxno"]; ?>" size="15" class="textbox"/></td>
</tr-->
<tr>
  <td>Correo Electr&oacute;nico: </td>
  <td><input type="text" id="idcorreoest" name="idcorreoest" value="<?php echo $destinatario["correo_destinatario"]; ?>" size="70" class="textbox"/></td>
</tr>
<tr>
  <td>Nombre del contacto: </td>
  <td><input type="text" id="nom_contacto" name="nom_contacto" value="<?php echo $destinatario["contacto_destinatario"]; ?>" size="70" class="textbox"/></td>
</tr>
<tr>
  <td>Departamento: </td>
  <td><select id="cmbDeptoEst" name="cmbDeptoEst" class="select">
      
      <?php for ($i=0; $i<count($departamentos); $i++){
      	    	if ($destinatario["depto_destinatario"]==$departamentos[$i]["codigo"]){
      ?>    		<option value="<?php echo $departamentos[$i]["codigo"]; ?>" selected="selected"><?php echo $departamentos[$i]["nombre"]; ?></option>
      <?php 	} 
      	    	else{
      ?>    		<option value="<?php echo $departamentos[$i]["codigo"]; ?>"><?php echo $departamentos[$i]["nombre"]; ?></option>
      <?php    	}
      		}
      ?>
      </select>
  </td>
</tr>
<tr>
  <td>Municipio: </td>
  <td><select id="cmbMpioEst" name="cmbMpioEst" class="select">
          <?php
          for ($i = 0; $i < count($municipios); $i++) {
              if ($destinatario["ciudad_destinatario"] == $municipios[$i]["codigo"]) {
                  ?>	<option value="<?php echo $municipios[$i]["codigo"]; ?>" selected="selected"><?php echo $municipios[$i]["nombre"]; ?></option>
                  <?php
              } else {
                  ?>	<option value="<?php echo $municipios[$i]["codigo"]; ?>"><?php echo $municipios[$i]["codigo"] . '-' . $destinatario["ciudad_destinatario"] . '-' . $municipios[$i]["nombre"]; ?></option>
                  <?php
              }
          }
          ?>
      </select>
  </td>
</tr>
</table>
<br/>
<!-- Fin Tabla-->
</fieldset>
<br/>
<center><input type="submit" id="btnActualizarDest" name="btnActualizarDest" value="Actualizar Datos" class="button"/></center>
<br/><br/>
<input type="hidden" id="id_destinatario" name="id_destinatario" value="<?php echo $destinatario["id_destinatario"]; ?>"/>
</form>
</div>