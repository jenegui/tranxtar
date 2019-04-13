
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
       $("#iddestinatario").select2();
       $("#idestablecimiento").select2();
       $("#idoperario").select2();
       $("#idoperarioext").select2();
    });
    
</script>

<form id="frmAgregarGuia" name="frmAgregarGuia" method="post" action="">
    <br/>
    
    <fieldset style="border: 1px solid #CCCCCC; padding: 10px;">
        <table>
            <tr>
                <td>Cliente: </td>
                <td><select id="idestablecimiento" name="idestablecimiento" style="width:250px;" class="select guia">
                        <option value="-">Seleccione...</option>
                        <?php for ($i = 0; $i < count($establecimiento); $i++) { ?>
                            <option value="<?php echo $establecimiento[$i]["id_establecimiento"]; ?>"><?php echo $establecimiento[$i]["establecimiento"]; ?></option> 
                        <?php } ?>
                    </select>
                </td>   
            </tr>
            <tr>
                <td>Forma de pago</td>
                <td>
                    <select id="formaPago" name="formaPago" class="select guia">
                        <option value="-">Seleccione...</option>  
                        <option value="1">Contado</option>
                        <option value="2">Contraentrega</option>
                        <option value="3">Cr&eacute;ito</option>
                    </select>
                </td>    
            </tr>
            <tr>
                <td>Fecha de recogida: </td>
                <td><input type="text" id="txtFecRecogida" name="txtFecRecogida" value="<?php echo date("d/m/Y"); ?>" class="textbox guia"/></td>
            </tr>
            <tr>
                <td>Fecha de entrega: </td>
                <td><input type="text" id="txtFecEntrega" name="txtFecEntrega" value="" class="textbox guia"/></td>
            </tr>
            <tr>
                <td>Destinatario: </td>
                <td><select id="iddestinatario" name="iddestinatario" style="width:250px;" class="select guia">
                        <option value="-">Seleccione...</option>
                        <?php for ($i = 0; $i < count($destinatario); $i++) { ?>
                            <option value="<?php echo $destinatario[$i]["id_destinatario"] . ',' . $destinatario[$i]["valor_kilo"]; ?>"><?php echo $destinatario[$i]["destinatario"]; ?></option> 
                        <?php } ?>
                    </select>
                </td>   
            </tr>
            
            <tr>
                <td>Peso (Kgs): </td>
                <td><input type="text" id="pesokg" name="pesokg" value="" size="10" class="textbox guia"/></td>
            </tr>
            <tr>
                <td>Alto (cm): </td>
                <td><input type="text" id="alto" name="alto" value="" size="5" class="textbox guia"/></td>
            </tr>
            <tr>
                <td>Ancho (cm): </td>
                <td><input type="text" id="ancho" name="ancho" value="" size="5" class="textbox guia"/></td>
            </tr>
            <tr>
                <td>Largo (cm): </td>
                <td><input type="text" id="largo" name="largo" value="" size="5" class="textbox guia"/></td>
            </tr>
            <tr>
                <td>Unidades: </td>
                <td><input type="text" id="unidades" name="unidades" value="" size="10" class="textbox guia totalFlete"/></td>
            </tr>
            <tr>
                <td>Peso a cobrar: </td>
                <td><input type="text" id="pesocobrar" name="pesocobrar" value="" size="15" class="textbox guia"/></td>
            </tr>
            <tr>
                <td>Valor declarado: </td>
                <td><input type="text" id="valorDeclarado" name="valorDeclarado" value="" size="15" class="textbox guia totalFlete"/></td>
            </tr>
            <tr>
                <td>Flete: </td>
                <td><input type="text" id="flete" name="flete" value="" size="15" class="textbox guia totalFlete"/></td>
            </tr>
            <tr>
                <td>Costo manejo</td>
                <td>
                    <select id="costomanejo" name="costomanejo" class="select guia totalFlete">
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
                <td>

                    <select id="idoperario" name="idoperario" style="width:250px;" class="select">
                        <option value="-">Seleccione...</option>
                        <?php
                        for ($i = 0; $i < count($operarios); $i++) {
                            if ($usuario == 5) {
                                if ($this->session->userdata('num_identificacion') == $operarios[$i]["num_identificacion"]) {
                                    echo '<option value="' . $operarios[$i]["num_identificacion"] . '">' . $operarios[$i]["nom_usuario"] . '</option>';
                                }
                            } else {
                                ?>
                                <option value="<?php echo $operarios[$i]["num_identificacion"]; ?>"><?php echo $operarios[$i]["nom_usuario"]; ?></option> 
                                <?php
                            }
                        }
                        ?>
                    </select>
                </td>   
            </tr>
            <tr>
                <td>No de placa: </td>
                <td><input type="text" id="numplaca" name="numplaca" value="" size="15" class="textbox"/></td>
            </tr>
            <tr>
                <td>Operario externo</td>
                <td><select id="idoperarioext" name="idoperarioext" style="width:250px;" class="select">
                        <option value="-">Seleccione...</option>
                        <?php for ($i = 0; $i < count($operariosExt); $i++) { ?>
                            <option value="<?php echo $operariosExt[$i]["nro_identificacion"]; ?>"><?php echo $operariosExt[$i]["nombre_operario"]; ?></option> 
                        <?php } ?>
                    </select>
                </td>   
            </tr>
            <tr>
                <td>Estado de la carga: </td>
                <td><select id="estadocarga" name="estadocarga" class="select">
                        <option value="-">Seleccione...</option>
                        <?php for ($i = 0; $i < count($estadocarga); $i++) { ?>
                            <option value="<?php echo $estadocarga[$i]["id_estado"]; ?>"><?php echo $estadocarga[$i]["id_estado"] . '-' . $estadocarga[$i]["nom_estado"]; ?></option> 
                        <?php } ?>
                    </select>
                </td>  
            </tr>
            <tr>
                <td>Estado del control:</td>
                <td>
                    <?php
                    if ($usuario == 5) {
                        $disabled = 'disabled="disabled"';
                    } else {
                        $disabled = "";
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
                <td><textarea name="observaciones" rows="3" cols="50"></textarea></td>
            </tr>
        </table>
    </fieldset>

    <br/>
    <input type="submit" id="btnAgregarGuia" name="btnAgregarGuia" value="Registrar Guia" class="button"/>
</form>