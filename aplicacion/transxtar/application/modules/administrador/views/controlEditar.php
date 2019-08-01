<script type="text/javascript">

    $(function () {

        $("#unidades").numerico();
        $("#peso").numerico();
        $("#pesokg").numerico();
        $("#ancho").numerico();
        $("#alto").numerico();
        $("#largo").numerico();
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
<form id="frmEditarGuia" name="frmEditarGuia" method="post" action="">
    <br/>
    <fieldset style="border: 1px solid #CCCCCC; padding: 10px;">
        <legend><b>Registrar Guia</b></legend>
        <table>
            <tr>
                <td>Nro. de remesa: </td>
                <td><input type="text" id="numremesa" name="numremesa" value="<?php echo $control["nroRemesa"]; ?>" size="10" class="textbox guia"/></td>
            </tr>
            <tr>
                <td>Cliente: </td>
                <td><select id="idestablecimiento" name="idestablecimiento" style="width:250px;" class="select guia">
                        <option value="-">Seleccione...</option>
                        <?php
                        for ($i = 0; $i < count($establecimiento); $i++) {
                            if ($control["id_establecimiento"] == $establecimiento[$i]["id_establecimiento"]) {
                                ?>
                                <option value="<?php echo $establecimiento[$i]["id_establecimiento"]; ?>" selected="selected"><?php echo $establecimiento[$i]["establecimiento"]; ?></option>
                            <?php
                            } else {
                                ?>    		
                                <option value="<?php echo $establecimiento[$i]["id_establecimiento"]; ?>"><?php echo $establecimiento[$i]["establecimiento"]; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </td>   
            </tr>
            <tr>
                <td>Forma de pago</td>
                <td>
                    <select id="formaPago" name="formaPago" class="select guia">

                        <?php
                        $selectd1 = '';
                        $selectd2 = '';
                        $selectd3 = '';
                        if ($control["forma_pago"] == 1) {
                            $selectd1 = 'selected="selected"';
                        } elseif ($control["forma_pago"] == 2) {
                            $selectd2 = 'selected="selected"';
                        } elseif ($control["forma_pago"] == 3) {
                            $selectd3 = 'selected="selected"';
                        }
                        ?>
                        <option value="1" <?php echo $selectd1; ?>>Contado</option>
                        <option value="2" <?php echo $selectd2; ?>>Contraentrega</option>
                        <option value="3" <?php echo $selectd3; ?>>Cr&eacute;dito</option>
                    </select>
                </td>    
            </tr>
            <tr>
                <td>Fecha de recogida: </td>
                <td><input type="text" id="txtFecRecogida" name="txtFecRecogida" value="<?php echo date("d/m/Y", strtotime($control["fecha_recogida"])); ?>" class="textbox guia"/></td>
            </tr>
            <tr>
                <td>Fecha de entrega: </td>
                <td><input type="text" id="txtFecEntrega" name="txtFecEntrega" value="<?php echo date("d/m/Y", strtotime($control["fecha_entrega"])); ?>" class="textbox guia"/></td>
            </tr>
            <tr>
                <td>Destinatario: </td>
                <td><select id="iddestinatario" name="iddestinatario" style="width:250px;" class="select guia">
                        <option value="-">Seleccione...</option>
                        <?php
                        for ($i = 0; $i < count($destinatario); $i++) {
                            if ($control["id_dest"] == $destinatario[$i]["id_destinatario"]) {
                                ?>
                                <option value="<?php echo $destinatario[$i]["id_destinatario"] . ',' . $destinatario[$i]["valor_kilo"]; ?>" selected="selected"><?php echo $destinatario[$i]["destinatario"]; ?></option>
                            <?php
                            } else {
                                ?>    		
                                <option value="<?php echo $destinatario[$i]["id_destinatario"] . ',' . $destinatario[$i]["valor_kilo"]; ?>"><?php echo $destinatario[$i]["destinatario"]; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </td>   
            </tr>

            <tr>
                <td>Peso (Kgs): </td>
                <td><input type="text" id="pesokg" name="pesokg" value="<?php echo $control["peso"]; ?>" size="10" class="textbox guia"/></td>
            </tr>
            <tr>
                <td>Alto (cm): </td>
                <td><input type="text" id="alto" name="alto" value="<?php echo $control["alto"]; ?>" size="5" class="textbox guia"/></td>
            </tr>
            <tr>
                <td>Ancho (cm): </td>
                <td><input type="text" id="ancho" name="ancho" value="<?php echo $control["ancho"]; ?>" size="5" class="textbox guia"/></td>
            </tr>
            <tr>
                <td>Largo (cm): </td>
                <td><input type="text" id="largo" name="largo" value="<?php echo $control["largo"]; ?>" size="5" class="textbox guia"/></td>
            </tr>
            <tr>
                <td>Unidades: </td>
                <td><input type="text" id="unidades" name="unidades" value="<?php echo $control["unidades"]; ?>" size="10" class="textbox guia"/></td>
            </tr>

            <tr>
                <td>Peso a cobrar: </td>
                <td><input type="text" id="pesocobrar" name="pesocobrar" value="<?php echo $control["peso_cobrar"]; ?>" size="15" class="textbox guia"/></td>
            </tr>
            <tr>
                <td>Valor declarado: </td>
                <td><input type="text" id="valorDeclarado" name="valorDeclarado" value="<?php echo $control["valor_declarado"]; ?>" size="15" class="textbox guia"/></td>
            </tr>
            <tr>
                <td>Flete: </td>
                <td><input type="text" id="flete" name="flete" value="<?php echo $control["flete"]; ?>" size="15" class="textbox guia"/></td>
            </tr>
            <tr>
                <td>Costo manejo</td>
                <td>
                    <select id="costomanejo" name="costomanejo" class="select guia">
                        <?php
                        $selectd1 = '';
                        $selectd2 = '';
                        $selectd3 = '';
                        if ($control["costo_manejo"] == 0.0100) {
                            $selectd1 = 'selected="selected"';
                        } elseif ($control["costo_manejo"] == 0.0300) {
                            $selectd2 = 'selected="selected"';
                        } elseif ($control["costo_manejo"] == 0.0500) {
                            $selectd3 = 'selected="selected"';
                        }
                        ?>  
                        <option value="-">Seleccione...</option>
                        <option value="0.01" <?php echo $selectd1; ?>>1%</option>
                        <option value="0.03" <?php echo $selectd2; ?>>3%</option>
                        <option value="0.05" <?php echo $selectd3; ?>>5%</option>
                    </select>
                </td>    
            </tr>
            <tr>
                <td>Total Flete: </td>
                <td><input type="text" id="totalflete" name="totalflete" value="<?php echo $control["total_fletes"]; ?>" size="15" class="textbox"/></td>
            </tr>
            <tr>
                <td>Tipo de carga: </td>
                <td><input type="text" id="tipocarga" name="tipocarga" value="<?php echo $control["tipoCarga"]; ?>" size="25" class="textbox guia" placeholder="paquetes, cajas, rollos, palets, etc."/></td>
            </tr>
            <tr>
                <td>Operario interno </td>
                <td><select id="idoperario" name="idoperario" class="select">
                        <option value="-">Seleccione...</option>
                        <?php
                        for ($i = 0; $i < count($operarios); $i++) {
                            if ($control["id_usuario_operario"] == $operarios[$i]["num_identificacion"]) {
                                ?>
                                <option value="<?php echo $operarios[$i]["num_identificacion"]; ?>" selected="selected"><?php echo $operarios[$i]["nom_usuario"]; ?></option> 
                            <?php
                            } else {
                                ?>    	<option value="<?php echo $operarios[$i]["num_identificacion"]; ?>"><?php echo $operarios[$i]["nom_usuario"]; ?></option> 
                                <?php
                            }
                        }
                        ?>
                    </select>
                </td>   
            </tr>
            <tr>
                <td>No de placa: </td>
                <td><input type="text" id="numplaca" name="numplaca" value="<?php echo $control["nro_placa"]; ?>" size="15" class="textbox"/></td>
            </tr>
            <tr>
                <td>Operario externo:</td>
                <td><select id="idoperarioext" name="idoperarioext" class="select">
                        <option value="-">Seleccione...</option>
                        <?php
                        for ($i = 0; $i < count($operariosExt); $i++) {
                            if ($control["id_operario"] == $operariosExt[$i]["id_operario"]) {
                                ?>
                                <option value="<?php echo $operariosExt[$i]["id_operario"]; ?>" selected="selected"><?php echo $operariosExt[$i]["nombre_operario"]; ?></option> 
                            <?php
                            } else {
                                ?>    	<option value="<?php echo $operariosExt[$i]["id_operario"]; ?>"><?php echo $operariosExt[$i]["nombre_operario"]; ?></option> 
        <?php
    }
}
?>
                    </select>
                </td>   
            </tr>
            <tr>
                <td>Estado de la carga: </td>
                <td><select id="estadocarga" name="estadocarga" class="select">
                        <option value="-">Seleccione...</option>
                        <?php
                        for ($i = 0; $i < count($estadocarga); $i++) {
                            if ($control["estado_carga"] == $estadocarga[$i]["id_estado"]) {
                                ?>
                                <option value="<?php echo $estadocarga[$i]["id_estado"]; ?>" selected="selected"><?php echo $estadocarga[$i]["id_estado"] . '-' . $estadocarga[$i]["nom_estado"]; ?></option> 
                            <?php
                            } else {
                                ?>    	<option value="<?php echo $estadocarga[$i]["id_estado"]; ?>"><?php echo $estadocarga[$i]["id_estado"] . '-' . $estadocarga[$i]["nom_estado"]; ?></option>  
        <?php
    }
}
?>
                    </select>
                </td>  
            </tr>
            <tr>
                <td>Estado del control:</td>
                <td>
                    <?php
                    $selectd1 = '';
                    $selectd2 = '';
                    if ($control["estado_control"] == 0) {
                        $selectd1 = 'selected="selected"';
                    } elseif ($control["estado_control"] == 1) {
                        $selectd2 = 'selected="selected"';
                    }
                    if ($usuario == 1 || $usuario == 2 || $usuario == 4) {
                        $disabled = "";
                    } else {
                        $disabled = 'disabled="disabled"';
                        echo '<input type="hidden" id="estadoRecogida" name="estadoRecogida" value="' . $control["estado_control"] . '"/>';
                    }
                    ?>    
                    <select id="estadoRecogida" name="estadoRecogida" class="select" <?php echo $disabled; ?>>
                        <option value="-">Seleccione...</option>
                        <option value="0" <?php echo $selectd1; ?>>No aprobada</option>
                        <option value="1" <?php echo $selectd2; ?>>Aprobada</option>
                    </select>
                </td>    
            </tr>	
            <tr>
                <td>Observaciones: </td>
                <td><textarea name="observaciones" rows="5" cols="50"><?php echo $control["observaciones"]; ?></textarea></td>
            </tr>
        </table>
    </fieldset>

    <br/>
    <input type="submit" id="btnEditarGuia" name="btnEditarGuia" value="Guardar" class="button"/>
    <input type="hidden" id="id_control" name="id_control" value="<?php echo $control["id_control"]; ?>"/>
</form>