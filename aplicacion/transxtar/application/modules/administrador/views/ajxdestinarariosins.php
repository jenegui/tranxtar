<script type="text/javascript">

    $(function () {

        $("#txtNumId").numerico();
        $("#txtNomDest").mayusculas();
        $("#nom_contacto").mayusculas();
        $("#txtDirDest").mayusculas();
        $("#txtFecCreacion").datepicker();
        $("#txtFecVencimiento").datepicker();
        $("#cmbsede").cargarCombo("cmbSubsede", "administrador/actualizarSubsedes");
        $("#iddepto").select2();
        $("#idmpio").select2();
        $("#idestablecimiento").select2();
        $("#frmINSdestinatario").validate({
            //Reglas de validacion
            rules: {
                cmbTipoDocumento: {required: true,
                    comboBox: '-'
                },
                iddepto: {required: true,
                    comboBox: '-'
                },
                idmpio: {required: true,
                    comboBox: '-'
                },
                txtIdDest: {required: true
                },
                txtNomDest: {required: true
                },
                txtDirDest: {required: true
                },
                idtelefono: {required: true
                },
                numplaca: {required: true
                },
                nom_contacto: {required: true
                },

                cmbRol: {required: true,
                    comboBox: '-'
                },
                cmbsede: {required: true,
                    comboBox: '-'
                },
                cmbSubsede: {required: true,
                    comboBox: '-'
                }
            },
            messages: {
                cmbTipoDocumento: {required: "Debe indicar el tipo de documento del usuario.",
                    comboBox: "Debe indicar el tipo de documento del usuario."
                },
                iddepto: {required: "Debe seleccionar un departamento.",
                    comboBox: "Debe seleccionar un departamento."
                },
                idmpio: {required: "Debe seleccionar un municipio.",
                    comboBox: "Debe seleccionar un municipio."
                },
                txtIdDest: {required: "Debe indicar el n&uacute;mero de identificaci&oacute;n del destinatario."
                },
                txtNomDest: {required: "Debe registrar el nombre del destinatario."
                },
                txtDirDest: {required: "Debe registrar la direcci&oacute;n del destinatario."
                },
                idtelefono: {required: "Debe ingresar el n&uacute;mero de tel&eacute;fono."
                },

                nom_contacto: {required: "Debe registrar el nombre del contacto del destinatario."
                },
                cmbRol: {required: "Debe seleccionar el rol del usuario.",
                    comboBox: "Debe seleccionar el rol del usuario."
                },
                cmbsede: {required: "Debe seleccionar la sede del usuario.",
                    comboBox: "Debe seleccionar la sede del usuario."
                },
                cmbSubsede: {required: "Debe seleccionar la subsede del usuario.",
                    comboBox: "Debe seleccionar la subsede del usuario."
                }
            },
            //Mensajes de error
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
            },
            //Envio del formulario
            submitHandler: function (form) {

                //Valido que el numero de identificacion del usuario ni el login ya est�n registrados, 
                $.ajax({
                    type: "POST",
                    url: base_url + "administrador/validaDestinatario",
                    data: {'tipodoc': $("#tipoDocumento").val(),
                        'numdoc': $("#txtIdDest").val(),
                        'idmpio': $("#idmpio").val(),
                        'direccion': $("#txtDirDest").val()
                    },
                    dataType: "html",
                    cache: false,
                    success: function (data) {
                        var test = eval("(" + data + ")");
                        //$("#errorNumID").css('display','inline');
                        //$("#errorNumID").css('margin-left','10px');				
                        //$("#errorNumID").css('color',"#FF0000");
                        $("#errorNumID").css('opacity', '0.47');
                        $("#errorNumID").css('z-index', '991');
                        $("#errorNumID").css('background', '#ee0101');
                        //error.css('float','right');
                        //$("#errorNumID").css('position', 'absolute');
                        $("#errorNumID").css('margin-top', '1px');
                        $("#errorNumID").css('color', '#fff');
                        $("#errorNumID").css('font-size', '11px');
                        $("#errorNumID").css('border', '2px solid #ddd');
                        $("#errorNumID").css('box-shadow', '0 0 6px #000');
                        $("#errorNumID").css('-moz-box-shadow', '0 0 6px #000');
                        $("#errorNumID").css('-webkit-box-shadow', '0 0 6px #000');
                        $("#errorNumID").css('padding', '4px 10px 4px 10px');
                        $("#errorNumID").css('border-radius', '6px');
                        $("#errorNumID").css('-moz-border-radius', '6px');
                        $("#errorNumID").css('-webkit-border-radius', '6px');
                        $("#errorNumID").html(test.error);
                        if (test.valid != false) {
                            form.submit();
                            alert("");
                            location.reload();
                        }
                    }
                });
            }

        });
    });

</script>

<?php $this->load->helper("url"); ?>
<br/>
<form id="frmINSdestinatario" name="frmINSdestinatario" method="post" action="<?php echo site_url("administrador/insertarDestinatario"); ?>">

    <table>
        <tr>
            <td>Nombre: </td>
            <td><input type="text" id="txtNomDest" name="txtNomDest" value="" size="35" class="textbox"/></td>
        </tr>
        <tr>
            <td>Nro identificacion: </td>
            <td><input type="text" id="txtIdDest" name="txtIdDest" value="" size="35" class="textbox"/><div id="errorNumID"></div></td>
        </tr>
        <tr>
            <td width="150">Tipo documento: </td>
            <td><select id="tipoDocumento" name="tipoDocumento" class="select">
                    <?php
                    for ($i = 0; $i < count($tipodoc); $i++) {
                        if ($usuario["fk_tipodoc"] == $tipodoc[$i]["id"]) {
                            echo '<option value="' . $tipodoc[$i]["id"] . '" selected="selected">' . $tipodoc[$i]["nombre"] . '</option>';
                        } else {
                            echo '<option value="' . $tipodoc[$i]["id"] . '">' . $tipodoc[$i]["nombre"] . '</option>';
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Direcci&oacute;n: </td>
            <td><input type="text" id="txtDirDest" name="txtDirDest" value="" size="35" class="textbox"/></td>
        </tr>
        <tr>
            <td>Tel&eacute;fono: </td>
            <td><input type="text" id="idtelefono" name="idtelefono" value="" size="35" class="textbox"/></td>
        </tr>
        <tr>
            <td>Correo electr&oacute;nico: </td>
            <td><input type="text" id="idcorreo" name="idcorreo" value="" size="35" class="textbox"/></td>
        </tr>	
        <tr>
            <td>Departamento: </td>
            <td><select id="iddepto" name="iddepto" style="width:250px;" class="select">
                    <option value="-">Seleccione...</option>
                    <?php for ($i = 0; $i < count($departamentos); $i++) { ?>
                        <option value="<?php echo $departamentos[$i]["codigo"]; ?>"><?php echo $departamentos[$i]["nombre"]; ?></option>	
                    <?php } ?>
                </select>
            </td>    
        </tr>
        <tr>
            <td>Municipio: </td>
            <td><select id="idmpio" name="idmpio" style="width:250px;" class="select">
                    <option value="-">Seleccione...</option>
                    <?php for ($i = 0; $i < count($municipios); $i++) { ?>
                        <option value="<?php echo $municipios[$i]["codigo"]; ?>"><?php echo $municipios[$i]["nombre"]; ?></option> 
                    <?php } ?>
                </select>
            </td>    
        </tr>
        <tr>
            <td>Nombre del contacto: </td>
            <td><input type="text" id="nom_contacto" name="nom_contacto" value="" size="35" class="textbox"/></td>
        </tr>
        
        <tr>
            <td colspan="2" align="center"><input type="submit" id="btnGrabar" name="btnGrabar" value="Registar Datos" class="button"/></td>
        </tr>
    </table>
</fieldset>
</form>


