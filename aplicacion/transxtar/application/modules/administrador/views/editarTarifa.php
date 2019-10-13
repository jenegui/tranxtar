<?php
$this->load->helper("url");
$url = site_url();
?>

<script type="text/javascript">
        //});
        $("#valorpesokg").numerico().largo(8);
        $("#valor_tarifa_ed").numerico().largo(8)
        $("#valor_minima_ed").numerico().largo(8);
        $("#peso_ed").numerico().largo(8);
        $("#ancho_ed").numerico().largo(8);
        $("#alto_ed").numerico().largo(8);
        $("#largo_ed").numerico().largo(8);
        $("#valorxunidad").numerico().largo(8);
        
        $("#cmbDeptoTar").select2();
        $("#cmbMpioTar").select2();
        $("#cmbDeptoTar").cargarCombo("cmbMpioTar", "administrador/actualizarMunicipios");
   

    jQuery(function () {
            jQuery("#frmEditTarifas").validate({
                rules: {
                    cmbDeptoTar: {
                        comboBox: '-'
                    },
                    cmbMpioTar: {
                        comboBox: '-'
                    },
                     tipo_carga_ed: {
                        comboBox: '-'
                    },
                    valor_tarifa_ed: {
                        required: true
                    },
                    valor_minima_ed: {
                        required: true
                    },
                    peso_ed: {
                        required: true
                    },
                    ancho_ed: {
                        required: true
                    },
                    alto_ed: {
                        required: true
                    },
                    largo_ed: {
                        required: true
                    },
                    costomanejo_ed: {
                        required: true
                    },
                    referencia_ed: {
                        required: true
                    },
                    descripcion_ed: {
                        required: true
                    }
                },
                messages: {
                    cmbDeptoTar: {
                        comboBox: "Seleccione una departamento."
                    },
                    cmbMpioTar: {
                        comboBox: "Seleccione un municipio."
                    },
                    tipo_carga_ed: {
                        comboBox: "Seleccione el tipo de carga."
                    },
                    valor_tarifa_ed: {
                        required: "El campo valor tarifa es obligatorio."
                    },
                    valor_minima_ed: {
                        required: "El campo valor minima es obligatorio."
                    },
                    peso_ed: {
                        required: "El campo peso es obligatorio."
                    },
                    ancho_ed: {
                        required: "El campo ancho es obligatorio."
                    },
                    alto_ed: {
                        required: "El campo alto es obligatorio."
                    },
                    largo_ed: {
                        required: "El campo largo es obligatorio."
                    },
                    costomanejo_ed: {
                        required: "El campo costo de manejo es obligatorio."
                    },
                    referencia_ed: {
                        required: "El campo referencia es obligatorio."
                    },
                    descripcion_ed: {
                        required: "El campo descripcion es obligatorio."
                    }
                },
                errorPlacement: function (error, element) {
                    element.after(error);
                    error.css('opacity', '0.47');
                    error.css('z-index', '991');
                    error.css('background', '#ee0101');
                    //error.css('float','right');
                    error.css('position', 'absolute');
                    error.css('margin-top', '1px');
                    error.css('color', '#fff');
                    error.css('font-size', '11px');
                    error.css('border', '2px solid #ddd');
                    error.css('box-shadow', '0 0 6px #000');
                    error.css('-moz-box-shadow', '0 0 6px #000');
                    error.css('-webkit-box-shadow', '0 0 6px #000');
                    error.css('padding', '4px 10px 4px 10px');
                    error.css('border-radius', '6px');
                    error.css('-moz-border-radius', '6px');
                    error.css('-webkit-border-radius', '6px');
                }
            });
        });    

</script>
<div>
    <form id="frmEditTarifas" name="frmEditTarifas" method="post" action="<?php echo site_url("administrador/editarTarifas"); ?>">
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
                    <td>Municipio: </td>
                    <td><input type="text" id="idnomcomest" name="idnomcomest" value="<?php echo $tarifa["nomciudad"]; ?>" size="25" class="textbox" disabled="disabled"/></td>
                </tr>
                <tr>
                    <td>Tipo de carga: </td>
                    <td>
                    <select id="tipo_carga_ed" name="tipo_carga_ed" class="select guia">

                        <?php
                        $selectd1 = '';
                        $selectd2 = '';
                        $selectd3 = '';
                        if ($tarifa["tipo_carga"] == 1) {
                            $selectd1 = 'selected="selected"';
                        } elseif ($tarifa["tipo_carga"] == 2) {
                            $selectd2 = 'selected="selected"';
                        } elseif ($tarifa["tipo_carga"] == 3) {
                            $selectd3 = 'selected="selected"';
                        }
                        ?>
                        <option value="1" <?php echo $selectd1; ?>>Peso</option>
                        <option value="2" <?php echo $selectd2; ?>>Volumen</option>
                        <option value="3" <?php echo $selectd3; ?>>Paquete</option>
                    </select>
                </td>    
                </tr>    
                <tr>
                    <td>Valor tarifa: </td>
                    <td><input type="text" id="valor_tarifa_ed" name="valor_tarifa_ed" value="<?php echo $tarifa["valor_tarifa"]; ?>" size="25" class="textbox"/></td>
                </tr>
                <tr>
                    <td>Factro de conversi&oaacute;n: </td>
                    <td><input type="text" id="factor_conversion_ed" name="factor_conversion_ed" value="<?php echo $tarifa["factor_conversion"]; ?>" size="25" class="textbox"/></td>
                </tr>
                <tr>
                    <td>Valor m&iacute;nima: </td>
                    <td><input type="text" id="valor_minima_ed" name="valor_minima_ed" value="<?php echo $tarifa["valor_minima"]; ?>" size="25" class="textbox"/></td>
                </tr>
                <tr>
                    <td>Peso: </td>
                    <td><input type="text" id="peso_ed" name="peso_ed" value="<?php echo $tarifa["peso"]; ?>" size="25" class="textbox"/></td>
                </tr>
                <tr>
                    <td>Ancho: </td>
                    <td><input type="text" id="ancho_ed" name="ancho_ed" value="<?php echo $tarifa["ancho"]; ?>" size="25" class="textbox"/></td>
                </tr>
                <tr>
                    <td>Largo: </td>
                    <td><input type="text" id="largo_ed" name="largo_ed" value="<?php echo $tarifa["largo"]; ?>" size="25" class="textbox"/></td>
                </tr>
                <tr>
                    <td>Alto: </td>
                    <td><input type="text" id="alto_ed" name="alto_ed" value="<?php echo $tarifa["alto"]; ?>" size="25" class="textbox"/></td>
                </tr>
                
                <!--tr>
                    <td>Costo manejo</td>
                    <td>
                        <?php
                        $selectd005 = '';
                        $selectd1 = '';
                        $selectd0015 = '';
                        $selectd3 = '';
                        $selectd5 = '';
                        /*if ($tarifa["costo_manejo"] == 0.005) {
                            $selectd005 = 'selected="selected"';
                        } elseif ($tarifa["costo_manejo"] == 0.01) {
                            $selectd1 = 'selected="selected"';
                        } elseif ($tarifa["costo_manejo"] == 0.015) {
                            $selectd0015 = 'selected="selected"';
                        }elseif ($tarifa["costo_manejo"] == 0.03) {
                            $selectd3 = 'selected="selected"';
                        }elseif ($tarifa["costo_manejo"] == 5) {
                            $selectd5 = 'selected="selected"';
                        }*/
                        ?>
                        <select id="costomanejo_ed" name="costomanejo_ed" class="select guia totalFlete">
                            <option value="-">Seleccione...</option>
                            <option value="0.005" <?php //echo $selectd005; ?>>0.5%</option>
                            <option value="0.01" <?php //echo $selectd1; ?>>1%</option>
                            <option value="0.015" <?php// echo $selectd0015; ?>>1.5%</option>
                            <option value="0.03" <?php //echo $selectd3; ?>>3%</option>
                            <option value="0.05" <?php //echo $selectd5; ?>>5%</option>
                        </select>
                    </td>    
                </tr-->     
                <tr>
                    <td>Referencia: </td>
                    <td><input type="text" id="referencia_ed" name="referencia_ed" value="<?php echo $tarifa["referencia"]; ?>" size="25" class="textbox"/></td>
                </tr>
                <tr>
                    <td>Descripci&oacute;n: </td>
                    <td><input type="text" id="descripcion_ed" name="descripcion_ed" value="<?php echo $tarifa["descripcion"]; ?>" size="25" class="textbox"/></td>
                </tr>    
            </table>
            <br/>
            <!-- Fin Tabla-->
        </fieldset>
        <br/>
        <input type="submit" id="btnEditTarifas" name="btnEditTarifas" value="Editar tarifas" class="button"/>
        <br/><br/>
        <input type="hidden" id="IdTarifa" name="IdTarifa" value="<?php echo $tarifa["id_tarifa"]; ?>"/>
        <input type="hidden" id="IdEstablecimiento" name="IdEstablecimiento" value="<?php echo $tarifa["id_establecimientos"]; ?>"/>
        <input type="hidden" id="costomanejo_ed" name="costomanejo_ed" value="0"/>
    </form>
</div>
