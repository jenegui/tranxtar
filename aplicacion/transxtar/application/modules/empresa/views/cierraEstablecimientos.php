<?php
//El bloqueo se deja en 0, ya que la empresa no está atada al estado, ni a la novedad, ya que en control
//se registra es por unidad local
$bloqueo=0;
?>
<h3>M&oacute;dulo I - Cierre establacimientos</h3>
<br/>
<form id="frmCierreEst" name="frmCierreEst" method="post" action="">
<fieldset style="padding: 10px; border: 1px solid #CCCCCC">
<legend><b>&nbsp;Cierre del establecimiento&nbsp;</b></legend>
<table width="100%">
<tr>
<td>
	<table width="100%">
	<tr>
	  <td><label style="display: block; float: left; width: 720px;">Nombre del establecimiento:&nbsp;&nbsp;&nbsp;<input type="text" id="idnomcomest" name="idnomcomest" value="<?php echo $establec['idnomcom'] ?>" size="80" maxlength="80" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?> /></label>
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
	  <td width="20%"><label style="display: block; float: left; width: 550px;">Estado:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	      <select id="estado_establecimiento" name="estado_establecimiento" class="select" <?php $this->general->bloqueoCampo($bloqueo); ?>>
          <option value="0">Cerrado</option>
          <option value="1">Abierto</option>
	  	  
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
      <td><label style="display: block; float: left; width: 185px;">Motivo del cierre:&nbsp; <textarea cols="120" rows="5" name="motivoCierre" id="motivoCierre"><?php echo $establec["observaciones"] ?></textarea></label></td>
    </tr>
    </table>
</td>
</tr>
</table>
</fieldset>
	  	  
<br/>
<?php if (!$bloqueo){ ?> 
<input type="submit" id="btnCierreEst" name="btnCierreEst" value="Guardar y continuar" class="button"/>
<?php } ?>
<input type="hidden" id="nro_orden" name="nro_orden" value="<?php echo $nro_orden ?> "/>
<input type="hidden" id="nro_estab" name="nro_estab" value="<?php echo $establec["nro_establecimiento"] ?> "/>
<input type="hidden" id="anio" name="anio" value="<?php echo $anio ?>"/>
<input type="hidden" id="mes" name="mes" value="<?php echo $mes ?>"/>
</form>

<div id="mensaje">
</div>
<div>
<?php
	echo ("<br><center><<<<a href='javascript:history.back(1)'>Regresar</a></center>");
?>
</div>