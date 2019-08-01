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
        //$("#idestablecimiento").select2();
    });

</script>
<form id="frmEditarGuiaTS" name="frmEditarGuiaTS" method="post" action="">
    <br/>
    <fieldset style="border: 1px solid #CCCCCC; padding: 10px;">
        <legend><b>Actualizar estado de la carga</b></legend>
        <table>
            <tr>
                <td>Nombre operario Interno: </td>
                <td><?php echo $control["nomUsuario"]; ?></td>
            </tr>
            <tr>
                <td>Numero de tel&eacute;fono: </td>
                <td><?php echo $control["nroTelefono"]; ?></td>
            </tr>
            <tr>
                <td>No Placa Int.: </td>
                <td><?php echo $control["nro_placa"]; ?></td>
            </tr>
            <tr>
                <td>Nombre operario externo: </td>
                <td><?php echo $control["nombreOperario"]; ?></td>
            </tr>
            <tr>
                <td>Numero de tel&eacute;fono: </td>
                <td><?php echo $control["telOperario"]; ?></td>
            </tr>
             <tr>
                <td>No Placa Ext.: </td>
                <td><?php echo $control["placa_ext"]; ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
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
                <td>Estatus de la carga: </td>
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
                <td>Observaciones: </td>
                <td><textarea name="observaciones" rows="5" cols="50"><?php //echo $control["observaciones"];    ?></textarea></td>
            </tr>
        </table>
    </fieldset>

    <br/>
    <input type="submit" id="btnEditarGuiaTS" name="btnEditarGuiaTS" value="Registrar" class="button"/>
    <input type="hidden" id="id_control" name="id_control" value="<?php echo $control["id_control"]; ?>"/>
</form>
<br>
<div id="divDirectorio">
    <table width="100%" class="table" style="font-size: 11px;">
        <thead class="thead">
            <tr>
                <th>Id Estado</th>
                <th>No. Guia</th>
                <th>Fecha registro</th>
                <th>Estado carga</th>
                <th>Observaciones</th>
                <th>Usuario</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($estados); $i++) {
                $class = (($i % 2) == 0) ? "row1" : "row2";
                ?>
                <tr class="<?php echo $class; ?>">
                    <td><?php echo $estados[$i]["id_estados"]; ?></td>
                    <td><?php echo $estados[$i]["num_guia"]; ?></td>
                    <td><?php echo $estados[$i]["fechaRegistro"]; ?></td>
                    <td><?php echo $estados[$i]["nomestado"]; ?></td>
                    <td><?php echo $estados[$i]["observaciones"]; ?></td>
                    <td><?php echo $estados[$i]["nom_usuario"]; ?></td>
                </tr>
<?php } ?>
            <tr>
            </tr>
        </tbody>

    </table>
</div>