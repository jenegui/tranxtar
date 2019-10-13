<div class="form-group">
    <fieldset style="border: 1px solid #CCCCCC; padding: 10px;">
        <form id="frmConsultarCliente" name="frmConsultarCliente" method="post" action="<?php //echo site_url("guias/index"); ?>" accept-charset="utf-8">
        <div class="form-group">
            Cliente: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php
            if ($tipo_usuario == 8) {
                ?>
                <select id="idestab" name="idestab" style="width:250px;" class="select guia">
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
                <select id="idestab" name="idestab" style="width:250px;" class="select guia">
                    <option value="-">Seleccione...</option>
                    <?php for ($i = 0; $i < count($establecimiento); $i++) { 
                            if($establecimiento[$i]["id_establecimiento"]==$idestab){
                            echo '<option value="'.$establecimiento[$i]["id_establecimiento"].'" selected="selected">'.$establecimiento[$i]["establecimiento"] .'</option>';
                        }else{ 
                        ?>
                            <option value="<?php echo $establecimiento[$i]["id_establecimiento"]; ?>"><?php echo $establecimiento[$i]["establecimiento"]; ?></option> 
                        <?php
                        }
                    } 
                     ?>
                </select>
                <?php

            }
            ?>
        </div>
        <div class="form-group">
            Destinatario: 
            <select id="iddestinatario" name="iddestinatario" style="width:250px;" class="select guia">
                <option value="-">Seleccione...</option>
                <?php
                for ($i = 0; $i < count($dest); $i++) {
                    if($dest[$i]["id_destinatario"]==$iddestin){
                        echo '<option value="'.$dest[$i]["id_destinatario"].'" selected="selected">'.$dest[$i]["nombre_destinatario"] .' - '.$dest[$i]["direccion_destinatario"].'</option>';
                    }else{
                ?>
                    <option value="<?php echo $dest[$i]["id_destinatario"]; ?>"><?php echo $dest[$i]["nombre_destinatario"] ." - ".$dest[$i]["direccion_destinatario"]; ?></option> 
                    <?php
                    }
                }
            ?>
            </select>
        </div>
        <div class="form-group">
            Tipo de tarifa:
            <select id="tipo_tarifa" name="tipo_tarifa" class="select1 tarifa_referencia">
                <?php
                    $selectd1 = '';
                    $selectd2 = '';
                    if ($tipTar == 1) {
                        $selectd1 = 'selected="selected"';
                    } elseif ($tipTar == 2) {
                        $selectd2 = 'selected="selected"';
                    }
                ?>
                <option value="-">Seleccione...</option>
                <option value="1"<?php echo $selectd1; ?>>Referencia</option>
                <option value="2"<?php echo $selectd2; ?>>General</option>
            </select>
        </div>     
        <div>
            <button id="btnConsultarCliente" name="btnConsultarCliente" value="Consultar" class="btn btn-primary btn-xl text-uppercase" type="submit">Consultar</button>
            <br/><br/>
        </div>
        </form>
    </fieldset>
</div>

<?php 
if(!isset($_REQUEST['idestab'])){
    echo "";
}else{
    if ($tipTar == 1) {        
?>
    <div class="form-group">
        <fieldset style="border: 1px solid #CCCCCC; padding: 10px;">
            <form id="frmRegTarifasGuias" name="frmRegTarifasGuias" method="post" action="" accept-charset="utf-8">
                <div class="form-group">
                    <?php 
                    echo '<table>
                            <tr> 
                                <th>Referencia</td> 
                                <th>Cantidad</td> 
                                
                            </tr>';
                        if(count($ctrlTarifas)>0){
                            for ($j = 0; $j < count($ctrlTarifas); $j++) {
                                $html1='<tr>';
                                    $html1.='<td>';
                                        $html1.=$ctrlTarifas[$j]["referencia"].': ';
                                    $html1.='</td>';
                                    $html1.='<td valign="top">';
                                        $html1.=$ctrlTarifas[$j]["tarifas_cantidad"];
                                    $html1.='</td>';
                                   
                                $html1.='</tr>';
                            
                                echo  $html1;
                            }
                        }else{
                            for ($i = 0; $i < count($IdTarifa); $i++) {
                                $html='<tr>';
                                    $html.='<td>';
                                        $html.=$IdTarifa[$i]["referencia"].': ';
                                    $html.='</td>';
                                    $html.='<td valign="top" width="15%">';
                                        $html.='<input type="checkbox" id="idtarifa'.$IdTarifa[$i]["id_tarifa"].'" name="idtarifa[]" value="'.$IdTarifa[$i]["id_tarifa"].'" class="tarifa"/>';
                                    $html.='</td>';
                                    $html.='<td valign="top">';
                                        $html.='<input type="text" id="cantidad'.$IdTarifa[$i]["id_tarifa"].'" name="cantidad[]" value="" size="10" class="textbox cantidad" disabled="disabled"/>';
                                    $html.='</td>';
                                    $html.='<td valign="top">';
                                        $html.='<input type="hidden" id="valor_tarifa'.$IdTarifa[$i]["id_tarifa"].'" name="valor_tarifa[]" value="'.$IdTarifa[$i]["valor_tarifa"].'" disabled="disabled"/>';
                                    $html.='</td>';
                                    $html.='<td valign="top">';
                                        $html.='<input type="hidden" id="valor_minima'.$IdTarifa[$i]["id_tarifa"].'" name="valor_minima[]" value="'.$IdTarifa[$i]["valor_minima"].'" disabled="disabled"/>';
                                    $html.='</td>';
                                $html.='</tr>';
                            
                            echo  $html;
                        }
                    }
                    echo '</table>';
                    ?>
                </div>
                <div>
                    <?php 
                    if(count($ctrlTarifas)>0){
                        echo "";    
                    }else{
                    ?>
                        <button id="btnGuardarTarifasGuia" name="btnGuardarTarifasGuia" value="Enviar" class="btn btn-primary btn-xl text-uppercase" type="submit">Enviar</button>
                        <input type="hidden" id="idestab" name="idestab" value="<?php echo $idestab; ?>"/>
                        <input type="hidden" id="iddestinatario" name="iddestinatario" value="<?php echo $iddestin; ?>"/>
                        <input type="hidden" id="tipo_tarifa" name="tipo_tarifa" value="1"/>
                    <?php 
                    }
                    ?>
                    <br/>
                </div>
            </form>
        </fieldset>
    </div>
    <?php 
    }else{
        echo "";
    }?>
    <form id="frmRegistrarGuia" name="frmRegistrarGuia" method="post" action="">
        <br/>
        <fieldset style="border: 1px solid #CCCCCC; padding: 10px;">
            <table>
                <tr>
                    <td>Cliente: </td>
                    <td>
                        <?php
                            echo $estab["nit_establecimiento"]." - ".$estab["idnomcom"];
                        ?>

                    </td>   
                </tr>
                <tr>
                    <td>Tipo de tarifa: </td>
                    <td><select id="tipo_tarifa" name="tipo_tarifa" class="select1 tarifa_referencia">
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
                    <td>Ciudad destino: </td>
                    <td><select id="idmpioDest" name="idmpioDest" style="width:250px;" class="select">
                            <option value="-">Seleccione...</option>
                            <?php for ($i = 0; $i < count($municipios); $i++) { ?>
                                <option value="<?php echo $municipios[$i]["codigo"]; ?>"><?php echo $municipios[$i]["nombre"]; ?></option> 
                            <?php } ?>
                        </select>
                    </td>    
                </tr>
                <?php
                    if ($tipTar == 2) {
                ?> 
                <tr class="normal"> 
                    <td>Peso (Kgs): </td>
                    <td><input type="text" id="pesokg" name="pesokg" value="" size="10" class="textbox normal"/></td>
                </tr>
                <tr class="normal">
                    <td>Alto (cm): </td>
                    <td><input type="text" id="alto" name="alto" value="" size="5" class="textbox normal"/></td>
                </tr>
                <tr class="normal">
                    <td>Ancho (cm): </td>
                    <td><input type="text" id="ancho" name="ancho" value="" size="5" class="textbox normal"/></td>
                </tr>
                <tr class="normal">
                    <td>Largo (cm): </td>
                    <td><input type="text" id="largo" name="largo" value="" size="5" class="textbox normal"/></td>
                </tr>
                <tr class="normal">
                    <td>Unidades: </td>
                    <td><input type="text" id="unidades" name="unidades" value="" size="10" class="textbox normal totalFlete"/></td>
                </tr>
                <?php
                    }
                ?> 
                <!--tr class="normal">
                    <td>Valor unitario: </td>
                    <td><input type="text" id="pesocobrar" name="pesocobrar" value="" size="15" class="textbox normal"/></td>
                </tr-->
                <tr>
                    <td>Valor declarado: </td>
                    <td><input type="text" id="valorDeclarado" name="valorDeclarado" value="" size="15" class="textbox tarifa_referencia totalFlete"/></td>
                </tr>
                <tr>
                    <td>Flete: </td>
                    <?php 
                    if(count($ctrlTarifas)>0){ 
                        echo '<td><input type="text" id="flete" name="flete" value="'.$sumaTarifas["sumaTotal"].'" size="15" class="textbox guia totalFlete"/></td>';
                    }else{
                        echo '<td><input type="text" id="flete" name="flete" value="" size="15" class="textbox guia totalFlete"/></td>';
                    }
                    ?>
                   
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
        <!--input type="submit" id="btnRegistrarGuias" name="btnRegistrarGuias" value="Registrar Guia" class="button"/-->
        <div>
            <button id="btnRegistrarGuias" name="btnRegistrarGuias" value="Registrar Guia" class="btn btn-primary btn-xl text-uppercase" type="submit">Consultar Cliente</button>
            <br/><br/>
        </div>
    </form>
<?php
}   
?>