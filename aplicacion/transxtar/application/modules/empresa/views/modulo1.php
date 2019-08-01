<?php
//El bloqueo se deja en 0, ya que la empresa no está atada al estado, ni a la novedad, ya que en control
//se registra es por unidad local
$bloqueo=0;

?>
<h3>M&oacute;dulo I - Identificaci&oacute;n y datos generales</h3>
<br/>
<form id="frmModuloI" name="frmModuloI" method="post" action="">
<fieldset style="padding: 10px; border: 1px solid #CCCCCC">
<legend><b>&nbsp;1. Ubicaci&oacute;n y datos generales de la empresa&nbsp;</b></legend>
<table>
<tr>
<td>
  <table width="100%">
  <tr>
    <td><label style="display: block; float: left; width: 660px;">Raz&oacute;n Social:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="idproraz" name="idproraz" value="<?php echo $modulo1["idproraz"]; ?>" size="80" maxlength="80" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/></label>
    	<label style="display: block; float: left; width: 62px; text-align: right;">NIT:&nbsp;<?php echo $modulo1["idnit"]; ?></label>
    </td>
  </tr>
  </table>
</td>    
</tr>
<!-- tr>
<td>
	<table width="100%">
	<tr>
	  <td><label style="display: block; float: left; width: 660px;">Nombre Comercial:&nbsp;<input type="text" id="idnomcom" name="idnomcom" value="<?php //echo $modulo1["idnomcom"]; ?>" size="80" maxlength="80" class="textbox" <?php //$this->general->bloqueoCampo($bloqueo); ?>/></label>
	     <label style="display: block; float: left; width: 200px; text-align: right;">Sigla:&nbsp;<input type="text" id="idsigla" name="idsigla" value="<?php //echo $modulo1["idsigla"]; ?>" size="20" maxlength="20" class="textbox" <?php //$this->general->bloqueoCampo($bloqueo); ?>/></label>
	  </td>	  
	</tr>
	</table>
</td>
</tr -->
<tr>
<td>
	<table width="100%">
	<tr>
	  <td><label style="display: block; float: left; width: 820px;">Domicilio principal de la gerencia:&nbsp;<input type="text" id="iddirecc" name="iddirecc" value="<?php echo $modulo1["iddirecc"]; ?>" size="80" maxlength="80" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/></label></td>
	</tr>
	</table>
</td>
</tr>
<tr>
<td>
	<table width="100%">
	<tr>
	  <td width="20%"><label style="display: block; float: left; width: 550px;">Departamento:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	      <select id="iddepto" name="iddepto" class="select" <?php $this->general->bloqueoCampo($bloqueo); ?>>
          <option value="-">Seleccione...</option>
	      <?php for ($i=0; $i<count($departamentos); $i++){ 
	   		 		if ($departamentos[$i]["codigo"]==$modulo1["iddepto"]){
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
	      <select id="idmpio" name="idmpio" class="select" <?php $this->general->bloqueoCampo($bloqueo); ?>>
          <option value="-">Seleccione...</option>
	      <?php for ($i=0; $i<count($municipios); $i++){
	  				if ($municipios[$i]["codigo"]==$modulo1["idmpio"]){ 
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
	  <td><label style="display: block; float: left; width: 235px;">Tel&eacute;fono:&nbsp;<input type="text" id="idtelno" name="idtelno" value="<?php echo $modulo1["idtelno"]; ?>" size="13" maxlength="13" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/></label></td>
	  <!-- td><label style="display: block; float: left; width: 195px;">Fax:&nbsp;<input type="text" id="idfaxno" name="idfaxno" value="<?php //echo $modulo1["idfaxno"]; ?>" size="13" maxlength="13" class="textbox" <?php //$this->general->bloqueoCampo($bloqueo); ?>/></label></td-->
	  <td><label style="display: block; float: left; width: 550px;">P&aacute;gina web:&nbsp;<input type="text" id="idpagweb" name="idpagweb" value="<?php echo $modulo1["idpagweb"]; ?>" size="60" maxlength="255" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/></label></td>
	</tr>
	</table>
</td>
</tr>
<tr>
<td>
    <table width="100%">
    <tr>
      <td><label style="display: block; float: left; width: 820px;">Correo electr&oacute;nico de la gerencia:<input type="text" id="idcorreo" name="idcorreo" value="<?php echo $modulo1["idcorreo"]; ?>" size="80" maxlength="80" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/></label></td>
    </tr>
    </table>
</td>
</tr>
<tr>
	<td>
		<label style="display: block; float: left; width: 660px;">
			Establecimientos de la empresa a nivel nacional:
		</label>
	</td>
</tr>
<tr>
	<td>
		<label style="display: block; float: left; width: 170px;"> 
			1. Al iniciar el mes:&nbsp;<input type="text" id="esini" name="esini" value="<?php echo $numEst["establecimientos"]; ?>" size="3" maxlength="3" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/>
		</label>
		<label style="display: block; float: left; width: 200px;">
			2. Aperturas en el mes:&nbsp;<input type="hidden" id="esape" name="esape" value="<?php echo $numEstApertMes["establecimientos"]; ?>" size="3" maxlength="3" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/>
			<?php
			$nro_orden= $modulo1["nro_orden"];
			echo '<a href="'.site_url("/empresa/aper_establecimientos/$nro_orden").'" title="Haga click aqui para registrar la apertura de un establecimineto">'.$numEstApertMes["establecimientos"].'</a>'; 
			?>
		</label>
		<label style="display: block; float: left; width: 170px;">
			3. Cierres en el mes:&nbsp;<input type="hidden" id="escie" name="escie" value="<?php echo $numEstCierreMes["establecimientos"]; ?>" size="3" maxlength="3" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/>
			<?php
			$nro_orden= $modulo1["nro_orden"];
			$listaEst="ListaEst";
			echo '<a href="'.site_url("/empresa/cierre_establecimientos/$nro_orden/$listaEst").'" title="Haga click aqui para registrar el cierre un establecimineto">'.$numEstCierreMes["establecimientos"].'</a>'; 
			?>
		</label>
		<label style="display: block; float: left; width: 210px;">
			<div id="estot">
				4. Total nacional en el mes:&nbsp;<input type="text" id="estot" name="estot" value="<?php echo $numEst["establecimientos"]+$numEstApertMes["establecimientos"]-$numEstCierreMes["establecimientos"]; ?>" size="3" maxlength="3" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/>
			</div>
		</label>
		
	</td>
	
</tr>
</table>
</fieldset>
<br/>	  	  

<fieldset style="padding: 10px; border: 1px solid #CCCCCC">
<legend><b>&nbsp;2. Unidad local&nbsp;</b></legend>
<table width="100%">
	<tr>
		<td>
			<div id="reporteOPCritico">
			<table width="100%" class="table" style="font-size: 11px;">
			<thead>
			<tr>
			  <!-- th style="border-right: 1px solid #CCCCCC;" align="center">N&uacute;mero unidad local</th -->
			  <th style="border-right: 1px solid #CCCCCC;" align="center">Unidad local</th>
			  <th style="border-right: 1px solid #CCCCCC;" align="center">N&uacute;mero de establecimientos</th>
			</tr>
			</thead>
			<tbody>
			<?php 
			$sum=0;
			for($i=0; $i<count($unidadesLocales); $i++){ 
					$var = ($i%2!=0)?"row2":"row1";
					$unidadLocal=$nro_orden.$unidadesLocales[$i]["codmpio"];
					$codmpio=$unidadesLocales[$i]["codmpio"];
					$html='<tr class="'.$var.'">';
						//$html.='<td align="center">'.$nro_orden.''.$unidadesLocales[$i]["codmpio"].'</td>';
						$listaEstUlocal="ListaEstUlocal";
						$html.='<td align="center"><a href="'.site_url("/empresa/cierre_establecimientos/$codmpio/$listaEstUlocal").'">'.$unidadesLocales[$i]["nompio"].'</a></td>';
				  		$html.='<td align="center"><a href="'.site_url("/empresa/cierre_establecimientos/$codmpio/$listaEstUlocal").'">'.$unidadesLocales[$i]["establecimientos"].'</a></td>';
				  		$html.='<input type="hidden" id="codmpio'.$i.'" name="codmpio'.$i.'" value="'.$unidadesLocales[$i]["codmpio"].'"/>';
				  	$html.='</tr>';
			  	echo $html; 
			  	$sum +=$unidadesLocales[$i]["establecimientos"];
			}
			echo '<tr>
    			<td align="center"><b>Total establecimientos</b></td>
    			<td align="center"><b>'.$sum.'</b></td>
    		</tr>';
			?>	
			</tbody>
			</table>
		</td>
	</tr>
</table>
</fieldset>	  	  
	  	  
<br/>
<?php if (!$bloqueo){ ?> 
<input type="submit" id="btnModuloI" name="btnModuloI" value="Guardar y continuar" class="button"/>
<?php } ?>
<input type="hidden" id="nro_orden" name="nro_orden" value="<?php echo $modulo1["nro_orden"]; ?>"/>
<input type="hidden" id="idfaxno" name="idfaxno" value="0"/>
<input type="hidden" id="idfaxnoest" name="idfaxnoest" value="0"/>
<input type="hidden" id="finicial" name="finicial" value="<?php echo date("1/m/Y"); ?>"/>
<input type="hidden" id="ffinal" name="ffinal" value="<?php echo date("30/m/Y"); ?>"/>
<input type="hidden" id="nro_establecimiento" name="nro_establecimiento" value="0"/>
<input type="hidden" id="idnit" name="idnit" value="<?php echo $modulo1["idnit"]; ?>"/>
</form>

<div id="mensaje">
</div>