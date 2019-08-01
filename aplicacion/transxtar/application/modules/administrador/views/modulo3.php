<?php $this->load->library("general"); ?>
<h3>M&oacute;dulo III - Ingresos operacionales causados en el mes (miles de pesos)</h3>
<p>En los valores parciales no incluya impuestos indirectos (IVA, Consumo)</p>
<br/>
<form id="frmModuloIII" name="frmModuloIII" method="post" action="">
  <table width="100%">
  <tr>
     <td width="70%">
            1. Ingresos por alojamiento
    </td> 
    <!--td width="70%">
    	<table>
    		<tr>
    			<td width="45%" rowspan="2">
    				1. Ingresos por alojamiento:
    			</td>
    			<td>
    				a) Ventas directas.
    			</td>
    			<td>
    				<td><input type="text" id="inalovd" name="inalovd" value="<?php //echo $modulo3["inalovd"]; ?>" <?php //$this->general->bloqueoCampo($bloqueo); ?> class="textbox sumaring" size="7"/></td>
    			</td>
    		</tr>
    		<tr>	
    			<td>
    				b) Administraci&oacute;n por tiempo compartido.
    			</td>
    			<td>
    				<td><input type="text" id="inaloatc" name="inaloatc" value="<?php //echo $modulo3["inaloatc"]; ?>" <?php //$this->general->bloqueoCampo($bloqueo); ?> class="textbox sumaring" size="7"/></td>
    			</td>
    		</tr>
    	</table>
    </td-->
    <td width="45%">
        <input type="text" id="inalo" name="inalo" value="<?php echo $modulo3["inalo"]; ?>" <?php $this->general->bloqueoCampo($bloqueo); ?> class="textbox" size="7"/>
    </td>
    
	
  </tr>
  <tr>
	<td><span id="inalii">2. Servicios de restaurante y catering para eventos (alimentos y bebidas no alcoh&oacute;licas), no incluidos en el<br/> valor de la tarifa de alojamiento.</span></td>
    <td><input type="text" id="inali" name="inali" value="<?php echo $modulo3["inali"]; ?>" <?php $this->general->bloqueoCampo($bloqueo); ?> class="textbox" size="7"/></td>
  </tr>
  <tr>
	<td>3. Servicios de bar (bebidas alcoh&oacute;licas y cigarrilos), no incluidos en el valor de la tarifa de alojamiento.</td>
	<td><input type="text" id="inba" name="inba" value="<?php echo $modulo3["inba"]; ?>" <?php $this->general->bloqueoCampo($bloqueo); ?> class="textbox" size="7"/></td>
  </tr>
  <tr>
	<td><span id="insrr">4. Servicios receptivos y conexos.</span></td>
	<td><input type="text" id="insr" name="insr" value="<?php echo $modulo3["insr"]; ?>" <?php $this->general->bloqueoCampo($bloqueo); ?> class="textbox" size="7"/></td>
  </tr>
  <tr>
	<!--td><span id="inoee">5. Organizacion de convenciones (MICE).</span></td>
	<td><input type="text" id="inoe" name="inoe" value="<?php //echo $modulo3["inoe"]; ?>" <?php //$this->general->bloqueoCampo($bloqueo); ?> class="textbox" size="7"/></td-->
    <td width="70%">
    	<table>
    		<tr>
    			<td width="50%" rowspan="2">
    				5. Organizacion de eventos:
    			</td>
    			<td>
                            <span id="inoee">
    				a) Convenciones (MICE).
                            </span>    
    			</td>
    			<td>
    				<td><input type="text" id="inoeconv" name="inoeconv" value="<?php echo $modulo3["inoeconv"]; ?>" <?php $this->general->bloqueoCampo($bloqueo); ?> class="textbox sumaring" size="7"/></td>
    			</td>
    		</tr>
    		<tr>	
    			<td>
    				b) Eventos sociales. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    			</td>
    			<td>
    				<td><input type="text" id="inoeeven" name="inoeeven" value="<?php echo $modulo3["inoeeven"]; ?>" <?php $this->general->bloqueoCampo($bloqueo); ?> class="textbox sumaring" size="7"/></td>
    			</td>
    		</tr>
    	</table>
    </td>
    <td width="45%">
        <input type="text" id="inoe" name="inoe" value="<?php echo $modulo3["inoe"]; ?>" <?php $this->general->bloqueoCampo($bloqueo); ?> class="textbox" size="7"/>
    </td>
  </tr>  
  <!-- tr>
	<td><span id="incat">6. Servicios de catering para eventos.</span></td> 
	<td><input type="text" id="incat" name="incat" value="<?php //echo $modulo3["incat"]; ?>" <?php //$this->general->bloqueoCampo($bloqueo); ?> class="textbox" size="7"/></td>
  </tr-->
  <tr>
	<td><span id="inoioo"> 6. Otros ingresos  operacionales no solicitados anteriormente.&nbsp;</span></td>
    <td><input type="text" id="inoio" name="inoio" value="<?php echo $modulo3["inoio"]; ?>" <?php $this->general->bloqueoCampo($bloqueo); ?> class="textbox" size="7"/></td>
  </tr>
  <tr>
	<td>7. Total de ingresos operacionales (Sin IVA)</td>
    <td><input type="text" id="intio" name="intio" value="<?php echo $modulo3["intio"]; ?>" <?php $this->general->bloqueoCampo($bloqueo); ?> class="textbox" size="7"/></td>
  </tr>
  </table>
  <br/>
  <div id="observaciones2"></div>
  <br/>
  <?php //Validar que el formulario esté en estado 99 - 5 para poder ser activado por el administrador 
	  if (($novedad_estado["novedad"]==99)&&($novedad_estado["estado"]==5)){  
  ?>  	<center><input type="button" id="btnOBSAdminIII" name="btnOBSAdminIII" value="Observaciones Administrador" class="button"/></center>        
  <?php } ?>
  <input type="hidden" id="op" name="op" value="<?php echo $modulo3["op"]; ?>"/>
  <input type="hidden" id="nro_orden" name="nro_orden" value="<?php echo $nro_orden; ?>"/> 
  <input type="hidden" id="nro_establecimiento" name="nro_establecimiento" value="<?php echo $nro_establecimiento; ?>"/>
</form>