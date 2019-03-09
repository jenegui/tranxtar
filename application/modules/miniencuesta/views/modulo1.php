<?php
?>
<h3> <center>MINI ENCUESTA DE ALOJAMIENTO</center></h3>

<?php
    echo "<p style='text-align:center; border: white 1px solid; margin: 2px;'>Fecha de diligenciamiento: <br> ". date('d/m/Y') ."</p>";
?>
<br/>
<form id="frmModuloI" name="frmModuloI" method="post" action="">
    <fieldset style="padding: 10px; border: 1px solid #CCCCCC">
        <legend><b>&nbsp;1. IDENTIFICACI&Oacute;N Y DATOS GENERALES</b></legend>
        <table>
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td><label style="display: block; float: left; width: 660px;">Raz&oacute;n Social:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="idproraz" name="idproraz" value="<?php echo $modulo1["idproraz"]; ?>" size="80" maxlength="80" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/></label>
                            </td>
                        </tr>
                    </table>
                </td>    
            </tr>
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td><label style="display: block; float: left; width: 660px;">Nombre Comercial:&nbsp;<input type="text" id="idnomcom" name="idnomcom" value="<?php echo $modulo1["idnomcom"]; ?>" size="80" maxlength="80" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/></label>
                               <!--label style="display: block; float: left; width: 200px; text-align: right;">Sigla:&nbsp;<input type="text" id="idsigla" name="idsigla" value="<?php //echo $modulo1["idsigla"];  ?>" size="20" maxlength="20" class="textbox" <?php //$this->general->bloqueoCampo($bloqueo);  ?>/></label -->
                            </td>	  
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td>
                                <?php
                                for ($i = 0; $i < $modulo1["registros"]; $i++) {
                                    $display1="";
                                    $selectedSi="";
                                    $selectedNo="";
                                    if ($modulo1["cambio_nit"] == 'N') {
                                        $display1="none";
                                        $selectedSi="";
                                        $selectedNo="selected";
                                    }elseif($modulo1["cambio_nit"] == 'S'){
                                        $display1="block"; 
                                        $selectedSi="selected";
                                        $selectedNo="";
                                    }else{
                                        $display1="none";
                                    }
                                }
                                ?>
                                <label style="display: block; float: left; width: 280px; text-align: left;">No. Identificaci&oacute;n :&nbsp;<input type="text" id="idnit" name="idnit" value="<?php echo $modulo1["idnit"]; ?>" size="20" maxlength="10" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?> disabled=""/></label>
                                <label style="display: block; float: left; text-align: right;">DV:&nbsp;<input type="text" id="iddv" name="iddv" value="<?php echo $modulo1["iddv"]; ?>" size="2" maxlength="1" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?> disabled/></label>
                                    <label style="display: block; float: left; text-align: right;">&#191;Su No. de identificaci&oacute;n cambi&oacute;?
                                        &nbsp;&nbsp;
                                        <select id="cambioNit" name="cambioNit" class="selectpeque" <?php $this->general->bloqueoCampo($bloqueo); ?>>
                                            <?php
                                            echo '<option value="-">Seleccione...</option>';
                                            echo '<option value="S" '.$selectedSi.'>SI</option>';
                                            echo '<option value="N" '.$selectedNo.'>NO</option>';
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
                    <div id="mostarCampoNit" style="display: <?php echo $display1;?>">
                        <table width="100%">
                            <tr>
                                <td>
                                   <label style="display: block; float: left; width: 320px; text-align: left;">Nuevo No. Identificaci&oacute;n :&nbsp;<input type="text" id="idnitNuevo" name="idnitNuevo" value="<?php echo $modulo1["idnit_nuevo"]; ?>" size="20" maxlength="10" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/></label>
                                    <label style="display: block; float: left; text-align: right;">Nuevo DV:&nbsp;<input type="text" id="iddvNuevo" name="iddvNuevo" value="<?php echo $modulo1["iddv_nuevo"]; ?>" size="2" maxlength="1" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/></label>
                                </td>
                            </tr>
                        </table>
                    </div>    
                </td>    
            </tr>
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td><label style="display: block; float: left; width: 820px;">Direcci&oacute;n:&nbsp;<input type="text" id="iddirecc" name="iddirecc" value="<?php echo $modulo1["iddirecc"]; ?>" size="80" maxlength="80" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/></label></td>
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
                                        <?php
                                        for ($i = 0; $i < count($departamentos); $i++) {
                                            if ($departamentos[$i]["codigo"] == $modulo1["iddepto"]) {
                                                ?>       		<option value="<?php echo $departamentos[$i]["codigo"]; ?>" selected="selected"><?php echo $departamentos[$i]["nombre"]; ?></option>
                                            <?php } else {
                                                ?>
                                                <option value="<?php echo $departamentos[$i]["codigo"]; ?>"><?php echo $departamentos[$i]["nombre"]; ?></option> 
                                            <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </label>
                            </td>
                            <td><label style="display: block; float: left; width: 400px;">&nbsp;Municipio: 
                                    <select id="idmpio" name="idmpio" class="select" <?php $this->general->bloqueoCampo($bloqueo); ?>>
                                        <option value="-">Seleccione...</option>
                                        <?php
                                        for ($i = 0; $i < count($municipios); $i++) {
                                            if ($municipios[$i]["codigo"] == $modulo1["idmpio"]) {
                                                ?>			<option value="<?php echo $municipios[$i]["codigo"]; ?>" selected="selected"><?php echo $municipios[$i]["nombre"]; ?></option>
                                            <?php } else {
                                                ?>
                                                <option value="<?php echo $municipios[$i]["codigo"]; ?>"><?php echo $municipios[$i]["nombre"]; ?></option>
                                            <?php
                                            }
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
                            <!-- td><label style="display: block; float: left; width: 195px;">Fax:&nbsp;<input type="text" id="idfaxno" name="idfaxno" value="<?php //echo $modulo1["idfaxno"];  ?>" size="13" maxlength="13" class="textbox" <?php //$this->general->bloqueoCampo($bloqueo);  ?>/></label></td-->
                            <td><label style="display: block; float: left; width: 550px;">P&aacute;gina web:&nbsp;<input type="text" id="idpagweb" name="idpagweb" value="<?php echo $modulo1["idpagweb"]; ?>" size="60" maxlength="255" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/></label></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td><label style="display: block; float: left; width: 660px;">Correo electr&oacute;nico:<input type="text" id="idcorreo" name="idcorreo" value="<?php echo $modulo1["idcorreo"]; ?>" size="80" maxlength="80" class="textbox" <?php $this->general->bloqueoCampo($bloqueo); ?>/></label></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </fieldset>
    <br/>	  	  

    <fieldset style="padding: 10px; border: 1px solid #CCCCCC">
        <legend><b>&nbsp;2. PERSONAL OCUPADO PROMEDIO</b></legend>
        <table width="100%">
            <tr>
                <td>
                    <div id="reporteOPCritico">
                        <table width="100%" class="table" style="font-size: 11px;">
                            <thead>
                                <tr>
                                    <!-- th style="border-right: 1px solid #CCCCCC;" align="center">N&uacute;mero unidad local</th -->
                                    <th style="border-right: 1px solid #CCCCCC;" align="center">Descripci&oacute;n</th>
                                    <th style="border-right: 1px solid #CCCCCC;" align="left">N&uacute;mero</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="690">N&uacute;mero promedio mensual de personas ocupadas mes en el a&ntilde;o 2017 ( propietarios, permanentes, temporales, contratados y aprendices)</td>
                                    <td style="text-align:left; border: 1px solid #CCCCCC;"><input type="text" id="pottot" name="pottot" value="<?php echo $modulo2["pottot"]; ?>" size="7" <?php $this->general->bloqueoCampo($bloqueo); ?> class="textbox"/></td>
                                </tr> 
                            </tbody>
                        </table>
                </td>
            </tr>
        </table>
    </fieldset>
    <fieldset style="padding: 10px; border: 1px solid #CCCCCC">
        <legend><b>&nbsp;3. INFRAESTRUCTURA</b></legend>
        <table width="100%">
            <tr>
                <td>
                    <div id="reporteOPCritico">
                        <table width="100%" class="table" style="font-size: 11px;">
                            <thead>
                                <tr>
                                    <!-- th style="border-right: 1px solid #CCCCCC;" align="center">N&uacute;mero unidad local</th -->
                                    <th style="border: 1px solid #CCCCCC;" align="center">Descripci&oacute;n</th>
                                    <th style="border: 1px solid #CCCCCC;" align="left">N&uacute;mero</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="450" style="border: 1px solid #CCCCCC;">1. N&uacute;mero de habitaciones ofrecidas d&iacute;a en diciembre de 2017</td>
                                    <td style="text-align:left"><input type="text" id="ihdo" name="ihdo" value="<?php echo $modulo4["ihdo"]; ?>" size="7" <?php $this->general->bloqueoCampo($bloqueo); ?> class="textbox"/></td>
                                </tr>
                                <tr>
                                    <td width="450" style="border: 1px solid #CCCCCC;">2. N&uacute;mero de camas ofrecidas d&iacute;a en diciembre de 2017 </td>
                                    <td style="text-align:left; border: 1px solid #CCCCCC;"><input type="text" id="icda" name="icda" value="<?php echo $modulo4["icda"]; ?>" size="7" <?php $this->general->bloqueoCampo($bloqueo); ?> class="textbox"/></td>
                                </tr>
                            </tbody>
                        </table>
                </td>
            </tr>
        </table>
    </fieldset>
    <fieldset style="padding: 10px; border: 1px solid #CCCCCC">
        <legend><b>&nbsp;4.  INGRESOS OPERACIONALES CAUSADOS EN 2017 (Valor en miles de  pesos) </b></legend>
        <table width="100%">
            <tr>
                <td>
                    <div id="reporteOPCritico">
                        <table width="100%" class="table" style="font-size: 11px;">
                            <thead>
                                <tr>
                                    <!-- th style="border-right: 1px solid #CCCCCC;" align="center">N&uacute;mero unidad local</th -->
                                    <th style="border: 1px solid #CCCCCC;" align="center">Descripci&oacute;n</th>
                                    <th style="border: 1px solid #CCCCCC;" align="left">Valor (Miles de pesos)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="border: 1px solid #CCCCCC;" width="450">Ingresos totales causados en el a&ntilde;o 2017</td>
                                    <td style="text-align:left; border: 1px solid #CCCCCC;"><input type="text" id="intio" name="intio" value="<?php echo $modulo3["intio"]; ?>" size="7" <?php $this->general->bloqueoCampo($bloqueo); ?> class="textbox"/></td>
                                </tr>
                                <tr>
                                    <td  style="border: 1px solid #CCCCCC;" width="450">Del valor anterior cuanto corresponde a alojamiento  </td>
                                    <td style="text-align:left"><input type="text" id="inalo" name="inalo" value="<?php echo $modulo3["inalo"]; ?>" size="7" <?php $this->general->bloqueoCampo($bloqueo); ?> class="textbox"/></td>
                                </tr>
                            </tbody>
                        </table>
                </td>
            </tr>
        </table>
    </fieldset>
    <fieldset style="padding: 10px; border: 1px solid #CCCCCC">
        <legend><b>&nbsp;5. OBSERVACIONES</b></legend>
        <table width="100%">
            <tr>
                <td>
                    <?php
                    if($tipoUsuario==2){
                    ?>    
                        <textarea name="observaciones" id="observaciones" rows="5" cols="105" disabled><?php echo $envio["observaciones"]; ?></textarea>
                        <input type="hidden" id="observaciones" name="observaciones" value="<?php echo $envio["observaciones"]; ?>"/>
                    <?php
                    }else{
                    ?>
                        <textarea name="observaciones" id="observaciones" rows="5" cols="105" <?php $this->general->bloqueoCampo($bloqueo); ?>><?php echo $envio["observaciones"]; ?></textarea>
                    <?php
                    }
                    ?>
                </td>
            </tr>
        </table>
    </fieldset>
    <fieldset style="height: 180px;">
	 <legend>Persona a quien dirigirse para consultas</legend>
	 <table>
	   <tr>
	     <td>Nombre:</td>
		 <td><input type="text" id="responde" name="responde" value="<?php echo $envio["responde"]; ?>" <?php $this->general->bloqueoCampo($bloqueo); ?> class="textbox"/></td>
	   </tr>
	   <tr>
	     <td>Cargo:</td>
	     <td><input type="text" id="respoca" name="respoca" value="<?php echo $envio["respoca"]; ?>" <?php $this->general->bloqueoCampo($bloqueo); ?> class="textbox"></td>
	   </tr>
	   <tr>
	     <td>Tel.:</td>
	     <td><input type="text" id="teler" name="teler" value="<?php echo $envio["teler"]; ?>" <?php $this->general->bloqueoCampo($bloqueo); ?> class="textbox"></td>
	   </tr>
	   <tr>
	     <td>Correo electr&oacute;nico:</td>
	     <td><input type="text" id="emailr" name="emailr" value="<?php echo $envio["emailr"]; ?>" <?php $this->general->bloqueoCampo($bloqueo); ?> class="textbox"></td>
	   </tr>
	 </table>
	 </fieldset>
         <?php
        if($tipoUsuario==2){
            if (($novedad_estado["novedad"]==99)&&($novedad_estado["estado"]>=4)){
        ?>
        <fieldset style="padding: 10px; border: 1px solid #CCCCCC">
            <legend><b>&nbsp;OBSERVACIONES DE LA CRITICA</b></legend>
            <table width="100%">
                <tr>
                    <td>
                        <textarea name="observacionesCritica" id="observacionesCritica" rows="5" cols="105" <?php $this->general->bloqueoCampo($bloqueo); ?>><?php echo $observ["descripcion"]; ?></textarea>
                    </td>
                </tr>
            </table>
        </fieldset>
        <?php
            }
        }
        ?>
    <br/>
<?php
if (!$bloqueo && $tipoUsuario==9) { 
    
    ?> 
    <input type="submit" id="btnModuloI" name="btnModuloI" value="Guardar y enviar" class="button"/>
    <?php
    /*if(($novedad_estado["novedad"]==5)&&($novedad_estado["estado"]==3)){
        echo '&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="btnModuloI" name="btnModuloI" value="Enviar formulario" class="button"/>'; 
    }*/
}elseif(!$bloqueo && $tipoUsuario==2){
    if (($novedad_estado["novedad"]==99)&&($novedad_estado["estado"]==4)){
?>
        <input type="button" id="btnModuloI" name="btnModuloI" value="Guardar y enviar" class="button"/>
<?php
    }
}
?>

    <input type="hidden" id="nro_orden" name="nro_orden" value="<?php echo $modulo1["nro_orden"]; ?>"/>
    <input type="hidden" id="finicial" name="finicial" value="<?php echo date("1/m/Y"); ?>"/>
    <input type="hidden" id="ffinal" name="ffinal" value="<?php echo date("30/m/Y"); ?>"/>
    <input type="hidden" id="nro_establecimiento" name="nro_establecimiento" value="<?php echo $modulo1["nro_establecimiento"]; ?>"/>
    <input type="hidden" id="idnit" name="idnit" value="<?php echo $modulo1["idnit"]; ?>"/>
</form>
<br>
<div id="divGuardo">
</div>