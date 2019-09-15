<form id="frmRegistrarGuia" name="frmRegistrarGuia" method="post" action="">
    <br/>
    <fieldset style="border: 1px solid #CCCCCC; padding: 10px;">
        <table>
            <tr>
                <td>Selccione el tipo de tarifa: </td>
                <td><select id="tipo_tarifa" name="tipo_tarifa" class="select1">
                        <option value="-">Seleccione...</option>
                        <option value="1">Referencia</option>
                        <option value="2">General</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nro. de remesa: </td>
                <td>
                    <?php
                    if ($usuario == 8) {
                        $disabled = 'disabled="disabled"';
                    } else {
                        $disabled = "";
                    }
                    ?>
                    <input type="text" id="numremesa" name="numremesa" value="" size="10" class="textbox guia" <?php echo $disabled; ?>/>
                </td>
            </tr>
            <tr>
                <td>Cliente: </td>
                <td>
                    <?php
                    if ($tipo_usuario == 8) {
                        ?>
                        <select id="idestablecimiento" name="idestablecimiento" style="width:250px;" class="select guia">
                            <option value="-">Seleccione...</option>
                            <?php
                            for ($i = 0; $i < count($establecimiento); $i++) {
                                if ($establecimiento[$i]["nit_establecimiento"] == $id_usuario) {
                                    ?>
                                    <option value="<?php echo $establecimiento[$i]["id_establecimiento"]; ?>" selected="selected"><?php echo $establecimiento[$i]["establecimiento"]; ?></option> 
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <?php
                    } else {
                        ?>
                        <select id="idestablecimiento" name="idestablecimiento" style="width:250px;" class="select guia">
                            <option value="-">Seleccione...</option>
                            <?php for ($i = 0; $i < count($establecimiento); $i++) { ?>
                                <option value="<?php echo $establecimiento[$i]["id_establecimiento"]; ?>"><?php echo $establecimiento[$i]["establecimiento"]; ?></option> 
                            <?php } ?>
                        </select>
                        <?php
                    }
                    ?>

                </td>   
            </tr>
            <tr>
                <td>Forma de pago</td>
                <td>
                    <select id="formaPago" name="formaPago" class="select guia">
                        <option value="-">Seleccione...</option>  
                        <option value="1">Contado</option>
                        <option value="2">Contraentrega</option>
                        <option value="3">Cr&eacute;dito</option>
                    </select>
                </td>    
            </tr>
            <tr>
                <td>Fecha de recogida: </td>
                <td><input type="text" id="txtFecRecogida" name="txtFecRecogida" value="<?php echo date("d/m/Y"); ?>" class="textbox guia"/></td>
            </tr>
            <tr>
                <td>Destinatario: </td>
                <td>
                    <?php
                    if ($tipo_usuario == 8) {
                        ?>
                        <select id="iddestinatario" name="iddestinatario" style="width:250px;" class="select guia">
                            <option value="-">Seleccione...</option>
                            <?php
                            for ($i = 0; $i < count($destinatario); $i++) {
                                if ($destinatario[$i]["id_establecimiento"] == $id_usuario) { 
                            ?>
                                <option value="<?php echo $destinatario[$i]["id_destinatario"] . '-' . $destinatario[$i]["nro_identificacion"]; ?>"><?php echo $destinatario[$i]["destinatario"]; ?></option> 
                            <?php
                                }
                            }
                        ?>
                        </select>
                        <?php
                    }else{
                    ?>
                    <select id="iddestinatario" name="iddestinatario" style="width:250px;" class="select guia">
                            <option value="-">Seleccione...</option>
                            <?php
                            for ($i = 0; $i < count($destinatario); $i++) {
                            ?>
                                <option value="<?php echo $destinatario[$i]["id_destinatario"] . '-' . $destinatario[$i]["nro_identificacion"]; ?>"><?php echo $destinatario[$i]["destinatario"]; ?></option> 
                            <?php
                            }
                        ?>
                        </select>
                        <?php 
                    }
                    ?>
                </td>
                <td>
                     <a href="<?php echo site_url("administrador/destinatarios"); ?>">Registrar destinatarios</a> 
                </td>   
            </tr>
            <tr>
                <td>Ciudad destino: </td>
                <td><select id="idmpioDest" name="idmpioDest" style="width:250px;" class="select">
                        <option value="-">Seleccione...</option>
                        <?php for ($i = 0; $i < count($municipios); $i++) { ?>
                            <option value="<?php echo $municipios[$i]["codigo"]; ?>"><?php echo $municipios[$i]["nombre"]; ?></option> 
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
                <td>Valor unitario: </td>
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
                <td>Tipo de carga: </td>
                <td><input type="text" id="tipocarga" name="tipocarga" value="" size="25" class="textbox guia" placeholder="paquetes, cajas, rollos, palets, etc."/></td>
            </tr>
            <tr>
                <td>Operario interno </td>
                <td>
                     <?php
                    if ($usuario == 8) {
                        $disabled = 'disabled="disabled"';
                    } else {
                        $disabled = "";
                    }
                    ?>
                    <select id="idoperario" name="idoperario" style="width:250px;" class="select" <?php echo $disabled; ?>>
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
                <td>
                    <?php
                    if ($usuario == 8) {
                        $disabled = 'disabled="disabled"';
                    } else {
                        $disabled = "";
                    }
                    ?>
                    <input type="text" id="numplaca" name="numplaca" value="" size="15" class="textbox" <?php echo $disabled; ?>/>
                </td>
            </tr>
            <tr>
                <td>Operario externo</td>
                <td>
                    <?php
                    if ($usuario == 8) {
                        $disabled = 'disabled="disabled"';
                    } else {
                        $disabled = "";
                    }
                    ?>
                    <select id="idoperarioext" name="idoperarioext" style="width:250px;" class="select" <?php echo $disabled; ?>>
                        <option value="-">Seleccione...</option>
                        <?php for ($i = 0; $i < count($operariosExt); $i++) { ?>
                            <option value="<?php echo $operariosExt[$i]["id_operario"]; ?>"><?php echo $operariosExt[$i]["nombre_operario"]; ?></option> 
                        <?php } ?>
                    </select>
                </td>   
            </tr>
            <tr>
                <td>Estatus de la carga:</td>
                <td>
                    <?php
                    if ($usuario == 8) {
                        $disabled = 'disabled="disabled"';
                    } else {
                        $disabled = "";
                    }
                    ?>
                    <select id="estadocarga" name="estadocarga" class="select" <?php echo $disabled; ?>>
                        <option value="-">Seleccione...</option>
                        <?php
                        if ($usuario == 5) {
                            ?>
                            <option value="1">1-Recolecci&oacute;n</option> 
                            <?php
                        } else {
                            for ($i = 0; $i < count($estadocarga); $i++) {
                                ?>
                                <option value="<?php echo $estadocarga[$i]["id_estado"]; ?>"><?php echo $estadocarga[$i]["id_estado"] . '-' . $estadocarga[$i]["nom_estado"]; ?></option> 
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
                    if ($usuario == 5 || $usuario == 7 || $usuario == 8) {
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
    <input type="submit" id="btnRegistrarGuia" name="btnRegistrarGuia" value="Registrar Guia" class="button"/>
</form>