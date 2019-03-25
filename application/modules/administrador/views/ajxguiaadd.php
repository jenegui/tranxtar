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
<form id="frmAgregarGuia" name="frmAgregarGuia" method="post" action="">
<br/>
<fieldset style="border: 1px solid #CCCCCC; padding: 10px;">
<legend><b>Registrar Guiaa</b></legend>
	<table>
	<tr>
	  <td>Cliente: </td>
            <td><select id="idestablecimiento" name="idestablecimiento" class="select">
                <option value="-">Seleccione...</option>
                <?php for ($i=0; $i<count($establecimiento); $i++){ ?>
                <option value="<?php echo $establecimiento[$i]["id_establecimiento"]; ?>"><?php echo $establecimiento[$i]["establecimiento"]; ?></option> 
                <?php } ?>
	      </select>
	  </td>   
	</tr>
        <tr>
            <td>Fecha de recogida: </td>
            <td><input type="text" id="txtFecRecogida" name="txtFecRecogida" value="<?php echo date("d/m/Y"); ?>" class="textbox"/></td>
	</tr>
	<tr>
            <td>Fecha de entrega: </td>
            <td><input type="text" id="txtFecEntrega" name="txtFecEntrega" value="" class="textbox"/></td>
	</tr>
        <tr>
	  <td>Destinatario: </td>
	  <td><select id="iddestinatario" name="iddestinatario" class="select selectDest">
                 <option value="-">Seleccione...</option>
                <?php for ($i=0; $i<count($destinatario); $i++){ ?>
                <option value="<?php echo $destinatario[$i]["id_destinatario"].','.$destinatario[$i]["valor_kilo"]; ?>"><?php echo $destinatario[$i]["destinatario"]; ?></option> 
                <?php } ?>
	      </select>
	  </td>   
	</tr>
        <tr>
	  <td>Forma de pago</td>
	  <td>
            <select id="formaPago" name="formaPago" class="select">
              <option value="-">Seleccione...</option>  
	      <option value="1">Contado</option>
              <option value="2">Contraentrega</option>
              <option value="3">Cr&eacute;ito</option>
            </select>
          </td>    
	</tr>
        <tr>
           <td colspan="2">
           <div class="form-group">
             Peso (Kgs): &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="checkbox" name="pesokg" id="pesokg" value="1"><br>
            Peso Volumen: &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; 
            <input type="checkbox" name="pesovol" id="pesovol" value="2"></div>
            <div id="mensaje"></div>
        </td>
	</tr>
	<tr>
	  <td>Unidades: </td>
	  <td><input type="text" id="unidades" name="unidades" value="" size="10" class="textbox"/></td>
	</tr>
	
	<tr>
	  <td>Peso a cobrar: </td>
	  <td><input type="text" id="pesocobrar" name="pesocobrar" value="" size="15" class="textbox"/></td>
	</tr>
	<tr>
	  <td>Valor declarado: </td>
	  <td><input type="text" id="valorDeclarado" name="valorDeclarado" value="" size="15" class="textbox"/></td>
	</tr>
	<tr>
	  <td>Flete: </td>
	  <td><input type="text" id="flete" name="flete" value="" size="15" class="textbox calculatotflet"/></td>
	</tr>
        <tr>
	  <td>Costo manejo</td>
	  <td>
            <select id="costomanejo" name="costomanejo" class="select calculatotflet">
	      <option value="-">Seleccione...</option>
              <option value="0.01">1%</option>
              <option value="0.03">3%</option>
              <option value="0.05">5%</option>
            </select>
          </td>    
	</tr>
        <tr>
	  <td>Total Flete: </td>
	  <td><input type="text" id="totalflete" name="totalflete" value="" size="15" class="textbox"/></td>
	</tr>
        <tr>
	  <td>Operario interno </td>
            <td><select id="idoperario" name="idoperario" class="select">
                <option value="-">Seleccione...</option>
                <?php for ($i=0; $i<count($operarios); $i++){ ?>
                <option value="<?php echo $operarios[$i]["num_identificacion"]; ?>"><?php echo $operarios[$i]["nom_usuario"]; ?></option> 
                <?php } ?>
	      </select>
	  </td>   
	</tr>
        <tr>
	  <td>No de placa: </td>
	  <td><input type="text" id="numplaca" name="numplaca" value="" size="15" class="textbox"/></td>
	</tr>
        <tr>
	  <td>Operario externo</td>
            <td><select id="idoperarioext" name="idoperarioext" class="select">
                <option value="-">Seleccione...</option>
                <?php for ($i=0; $i<count($operariosExt); $i++){ ?>
                <option value="<?php echo $operariosExt[$i]["nro_identificacion"]; ?>"><?php echo $operariosExt[$i]["nombre_operario"]; ?></option> 
                <?php } ?>
	      </select>
	  </td>   
	</tr>
        <tr>
	  <td>Estado de la carga: </td>
	  <td><select id="estadocarga" name="estadocarga" class="select">
                <option value="-">Seleccione...</option>
                <?php for ($i=0; $i<count($estadocarga); $i++){ ?>
                <option value="<?php echo $estadocarga[$i]["id_estado"]; ?>"><?php echo $estadocarga[$i]["id_estado"] .'-'. $estadocarga[$i]["nom_estado"]; ?></option> 
                <?php } ?>
	      </select>
	  </td>  
	</tr>
        <tr>
	  <td>Estado del control:</td>
	  <td>
            <?php
            if($usuario==1 || $usuario==2){
                $disabled="";
            }else{
                $disabled='disabled="disabled"';
            }
            ?>
            <select id="estadoRecogida" name="estadoRecogida" class="select" <?php echo $disabled; ?>>
              <option value="-">Seleccione...</option>
              <option value="0">No aprobada</option>
              <option value="1">Aprobada</option>
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
<input type="submit" id="btnAgregarGuia" name="btnAgregarGuia" value="Registrar Guia" class="button"/>
</form>