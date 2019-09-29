<?php
$this->load->helper("url");
$url = site_url();
?>

<link rel="stylesheet" href="include/tablesorter/css/bootstrap.min.css">
<!-- bootstrap css theme -->
<!--link rel="stylesheet" href="include/tablesorter/css/theme.bootstrap_4.css"-->
<link rel="stylesheet" href="<?php echo base_url("js/tablesorter/css/theme.bootstrap_4.css"); ?>">
<link rel="stylesheet" href="<?php echo base_url("js/tablesorter/css/theme.default.css"); ?>">
<link rel="stylesheet" href="<?php echo base_url("js/tablesorter/css/theme.blue.css"); ?>">
<link rel="stylesheet" href="<?php echo base_url("js/tablesorter/css/theme.green.css"); ?>">
<link rel="stylesheet" href="include/tablesorter/css/theme.grey.css">
<link rel="stylesheet" href="include/tablesorter/css/theme.ice.css">
<link rel="stylesheet" href="include/tablesorter/css/theme.black-ice.css">
<link rel="stylesheet" href="include/tablesorter/css/theme.dark.css">
<link rel="stylesheet" href="include/tablesorter/css/theme.dropbox.css">

<link href="<?php echo base_url("js/tablesorter/dist/css/theme.default.min.css"); ?>" rel="stylesheet">
<script src="<?php echo base_url("js/tablesorter/dist/js/jquery.tablesorter.min.js"); ?>"></script>
<script src="<?php echo base_url("js/tablesorter/dist/js/jquery.tablesorter.widgets.min.js"); ?>"></script>
<script src="include/tablesorter/js/extras/jquery.dragtable.mod.js"></script>
<link rel="stylesheet" href="include/tablesorter/addons/pager/jquery.tablesorter.pager.css">
<script src="include/tablesorter/addons/pager/jquery.tablesorter.pager.js"></script>
<script type="text/javascript">


</script>
<div>
    <form id="frmRegTarifas" name="frmRegTarifas" method="post" action="<?php echo site_url("administrador/registrarTarifas"); ?>">
        <br/>
        <fieldset style="border: 1px solid #CCCCCC; padding-top:10px; padding-left:10px;">
            <legend><b>Registro de tarifas</b>&nbsp;</legend>
            <!-- Tabla para mostrar los datos del establecimiento -->
            <table width="100%">
                <tr>
                    <td width="18%">Nombre: </td>
                    <td><input type="text" id="idnomcomest" name="idnomcomest" value="<?php echo $establecimiento["idnomcom"]; ?>" size="25" class="textbox" disabled="disabled"/></td>
                </tr>
                <tr>
                    <td>NIT: </td>
                    <td><input type="text" id="idnitest" name="idnitest" value="<?php echo $establecimiento["nit_establecimiento"]; ?>" size="25" class="textbox" disabled="disabled"/></td>
                </tr>
                <tr>
                    <td>Tipo de tarifa: </td>
                    <td><select id="tipo_tarifa" name="tipo_tarifa" class="select1">
                            <option value="-">Seleccione...</option>
                            <option value="1">Referencia</option>
                            <option value="2">General</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="referencia">Referencia: </td>
                    <td><input type="text" id="referencia" name="referencia" value="" size="25" class="textbox referencia"/></td>
                </tr>   
                <tr>
                    <td>Departamento:</td>
                    <td><select id="cmbDeptoTar" name="cmbDeptoTar" class="select1">
                            <option value="-">Seleccione el departamento...</option>
                            <?php
                            for ($i = 0; $i < count($departamentos); $i++) {
                                     ?>
                                        <option value="<?php echo $departamentos[$i]["codigo"]; ?>"><?php echo utf8_encode($departamentos[$i]["nombre"]); ?></option>
                                    <?php
                                
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Ciudad: </td>
                    <td><select id="cmbMpioTar" name="cmbMpioTar" class="select1">
                            <option value="-">Seleccione el municipio...</option>
                            <?php
                            for ($i = 0; $i < count($municipios); $i++) {
                                    if (in_array($departamentos[$i]["codigo"], $ciudadesTarifas)) {
                                        echo "Existe Irix";
                                    }
                                    ?>          
                                        <option value="<?php echo $municipios[$i]["codigo"]; ?>"><?php echo $municipios[$i]["codigo"].''.$municipios[$i]["nombre"]; ?></option>
                                    <?php
                                    
                               
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                 
                <tr>
                    <td class="valor_tarifa">Valor tarifa o kilo: </td>
                    <td><input type="text" id="valor_tarifa" name="valor_tarifa" value="" size="25" class="textbox valor_tarifa"/></td>
                </tr> 
                <tr>
                    <td class="factor_conversion">Factor de conversi&oacute;n: </td>
                    <td><input type="text" id="factor_conversion" name="factor_conversion" value="" size="25" class="textbox factor_conversion"/></td>
                </tr> 
                <tr>
                    <td>Valor m&iacute;nima: </td>
                    <td><input type="text" id="valor_minima" name="valor_minima" value="" size="25" class="textbox"/></td>
                </tr>
                <tr>
                    <td class="referencia">Peso: </td>
                    <td><input type="text" id="peso" name="peso" value="" size="25" class="textbox referencia"/></td>
                </tr>
                <tr>
                    <td class="referencia">Ancho: </td>
                    <td><input type="text" id="ancho" name="ancho" value="" size="25" class="textbox referencia"/></td>
                </tr>
                <tr>
                    <td class="referencia">Largo: </td>
                    <td><input type="text" id="largo" name="largo" value="" size="25" class="textbox referencia"/></td>
                </tr>
                <tr>
                    <td class="referencia">Alto: </td>
                    <td><input type="text" id="alto" name="alto" value="" size="25" class="textbox referencia"/></td>
                </tr>
                <tr>
                    <td class="referencia">Costo de manejo: </td>
                    <td><input type="text" id="costomanejo" name="costomanejo" value="" size="25" class="textbox"/></td>
                </tr>     
                <tr>
                    <td>Descripci&oacute;n: </td>
                    <td><input type="text" id="descripcion" name="descripcion" value="" size="25" class="textbox"/></td>
                </tr>    
            </table>
            <br/>
            <!-- Fin Tabla-->
        </fieldset>
        <br/>
        <input type="submit" id="btnRegTarifas" name="btnRegTarifas" value="Registar tarifas" class="button"/>
        <br/><br/>
        <input type="hidden" id="IdEstablecimiento" name="IdEstablecimiento" value="<?php echo $establecimiento["nro_establecimiento"]; ?>"/>
    </form>
</div>
<div id="divDirectorio" class="table-responsive">
    <table class="tablesorter" width="100%" style="font-size: 11px;" class="table">
        <thead>
            <tr>
                <th>Tipo de tarifa</th>
                <th>Ciudad</th>
                <th>Valor tarifa</th>
                <th>Factor de conversi&oacute;n</th>
                <th>Valor minima</th>
                <th>Peso</th>
                <th>Ancho</th>
                <th>Largo</th>
                <th>Alto</th>
                <th>Costo de manejo</th>
                <th>Referencia</th>
                <th>Descripci&oacute;n</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($tarifas); $i++) {
                $class = (($i % 2) == 0) ? "row1" : "row2";
                ?>
                <tr>
                    <td><?php echo $tarifas[$i]['tipo_tarifa']; ?></td>
                    <td><?php echo $tarifas[$i]['nomciudad']; ?></td> 
                    <td><?php echo $tarifas[$i]['valor_tarifa']; ?></td>
                    <td><?php echo $tarifas[$i]['factor_conversion']; ?></td> 
                    <td><?php echo $tarifas[$i]['valor_minima']; ?></td> 
                    <td><?php echo $tarifas[$i]['peso']; ?></td> 
                    <td><?php echo $tarifas[$i]['ancho']; ?></td> 
                    <td><?php echo $tarifas[$i]['largo']; ?></td> 
                    <td><?php echo $tarifas[$i]['alto']; ?></td> 
                    <td><?php echo $tarifas[$i]['costo_manejo']; ?></td> 
                    <td><?php echo $tarifas[$i]['referencia']; ?></td>
                    <td><?php echo $tarifas[$i]['descripcion']; ?></td>
                    <td><a href="<?php echo site_url("administrador/formEditarTarifas/".$tarifas[$i]["id_tarifa"].""); ?>"><img src="<?php echo base_url("images/edit.png"); ?>"/></a>
                    </td>    
                </tr>
            <?php } ?>

        </tbody>

    </table>
</div>  