<?php
//El bloqueo se deja en 0, ya que la empresa no está atada al estado, ni a la novedad, ya que en control
//se registra es por unidad local
$bloqueo=0;
?>
<h3>M&oacute;dulo I - Identificaci&oacute;n y datos generales</h3>
<br/>
<form id="frmModuloEst" name="frmModuloEst" method="post" action="">
<fieldset style="padding: 10px; border: 1px solid #CCCCCC">
<legend><b>&nbsp;Informaci&oacute;n general del establecimiento&nbsp;</b></legend>
<table width="100%">
<tr>
<td>
	<table width="100%">
	<tr>
	  <td><label style="display: block; float: left; width: 720px;">Nombre del establecimiento:&nbsp;&nbsp;&nbsp;<input type="text" id="idnomcomest" name="idnomcomest" value="" size="80" maxlength="80" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?> /></label>
	      <!-- label style="display: block; float: left; width: 200px;">Sigla:&nbsp;<input type="text" id="idsiglaest" name="idsiglaest" value="" size="20" maxlength="20" class="textbox" <?php //$this->general->bloqueoCampo($bloqueo); ?>/></label -->
	  </td>
	</tr>
	</table>
</td>
</tr>
<tr>
<td>
	<table width="100%">	
	<tr>
	  <td><label style="display: block; float: left; width: 720px;">Direcci&oacute;n del establecimiento:&nbsp;<input type="text" id="iddireccest" name="iddireccest" value="" size="80" maxlength="80" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/></label></td>
	</tr>
	</table>
</td>
</tr>
<tr>
	<td>
		<table width="100%">
			<tr>
			  <td>Actividad: </td>
			  <td><select id="idactivest" name="idactivest" class="select" style="width: 570px;">
			      <option value="-">Seleccione...</option>
			      <?php for ($i=0; $i<count($actividades); $i++){ ?>
		      	     <option value="<?php echo $actividades[$i]["id"]; ?>"><?php echo $actividades[$i]["id"]; ?>&nbsp;-&nbsp;<?php echo $actividades[$i]["nombre"]; ?></option>
		          <?php } ?>
			      </select>
			  	</td>
		  	</tr>
	  	</table>
	      
	</td>
</tr>

<tr>
<td>
	<table width="100%">
	<tr>
	  <td width="20%"><label style="display: block; float: left; width: 550px;">Departamento:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	      <select id="iddeptoest" name="iddeptoest" class="select" <?php $this->general->bloqueoCampo($bloqueo); ?>>
          <option value="-">Seleccione...</option>
	  	  <?php for ($i=0; $i<count($departamentos); $i++){ 
	   		 		if ($departamentos[$i]["codigo"]==$modulo1["iddeptoest"]){
	      ?>       		<option value="<?php echo $departamentos[$i]["codigo"]; ?>" selected="selected"><?php echo $departamentos[$i]["nombre"]; ?></option>
	      <?php 	}
	         		else{ ?>
	   					<option value="<?php echo $departamentos[$i]["codigo"]; ?>"><?php echo $departamentos[$i]["nombre"]; ?></option> 
	      <?php 	} 
	   		    }
	      ?>
          </select>
          </label>
      </td>
	  <td><label style="display: block; float: left; width: 400px;">&nbsp;Municipio:
	      <select id="idmpioest" name="idmpioest" class="select" <?php $this->general->bloqueoCampo($bloqueo); ?>>
          <option value="-">Seleccione...</option>
	      <?php for ($i=0; $i<count($municipios); $i++){
	  				if ($municipios[$i]["codigo"]==$modulo1["idmpioest"]){ 
	      ?>			<option value="<?php echo $municipios[$i]["codigo"]; ?>" selected="selected"><?php echo $municipios[$i]["nombre"]; ?></option>
	      <?php     }
	  				else{ ?>
	  					<option value="<?php echo $municipios[$i]["codigo"]; ?>"><?php echo $municipios[$i]["nombre"]; ?></option>
	      <?php		} 
	  			}
	  	  ?>
          </select>
          </label>
      </td>	
	</tr>
	</table>
</td>
</tr>
<tr>
<td>
	<table width="100%">
	<tr>
	  <td><label style="display: block; float: left; width: 220px;">Tel&eacute;fono:&nbsp;<input type="text" id="idtelnoest" name="idtelnoest" value="" size="13" maxlength="13" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/></label></td>
	  <td><label style="display: block; float: left; width: 180px;">Fax:&nbsp;<input type="text" id="idfaxnoest" name="idfaxnoest" value="<?php //echo $modulo1["idfaxnoest"]; ?>" size="13" maxlength="13" class="textbox" <?php //$this->general->bloqueoCampo($bloqueo); ?>/></label></td>
	  <td><label style="display: block; float: left; width: 550px;">Email establecimiento:&nbsp;<input type="text" id="idcorreoest" name="idcorreoest" value="" size="60" maxlength="80" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/></label></td>
	</tr>
	</table>
</td>  
</tr>
<tr>
<td>
    <table width="100%">
    <tr>
      <td><label style="display: block; float: left; width: 820px;">Cadena hotelera al que pertenece:&nbsp; <input type="text" id="nom_cadena" name="nom_cadena"  value="" size="50" maxlength="80" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/></label></td>
    </tr>
    </table>
</td>
</tr>
<tr>
<td>
    <table width="100%">
    <tr>
      <td><label style="display: block; float: left; width: 820px;">Operador hotelero al que pertenece:&nbsp; <input type="text" id="nom_operador" name="nom_operador"  value="" size="50" maxlength="80" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/></label></td>
    </tr>
    </table>
</td>
</tr>
</table>
</fieldset>
	  	  
<br/>
<?php if (!$bloqueo){ ?> 
<input type="submit" id="btnEstablecimientos" name="btnEstablecimientos" value="Guardar y continuar" class="button"/>
<?php } ?>
<input type="hidden" id="nro_orden" name="nro_orden" value="<?php echo $nro_orden ?> "/>
<input type="hidden" id="idfaxno" name="idfaxno" value="0"/>
<input type="hidden" id="idfaxnoest" name="idfaxnoest" value="0"/>
<input type="hidden" id="finicial" name="finicial" value=""/>
<input type="hidden" id="ffinal" name="ffinal" value=""/>
<input type="hidden" id="nro_establecimiento" name="nro_establecimiento" value=""/>
<input type="hidden" id="idnit" name="idnit" value=""/>
</form>

<div id="mensaje">
</div>
<div>
<?php
	echo ("<br><center><<<<a href='javascript:history.back(1)'>Regresar</a></center>");
?>
</div>