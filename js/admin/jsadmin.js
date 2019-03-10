//Funciones JavaScript que trabajan con el menu (Seleccion de periodo)
$(function () {

    var mensajeINALO = "Justificar el bajo porcentaje de ingresos por alojamiento en el total de ingresos.";
    var mensajeINALI = "Justificar por qu&eacute; los ingresos por servicio de restaurante y catering para eventos son mayores que los de servicios de alojamiento.";
    var mensajeINTIO = "Justificar el alto porcentaje de participaci&oacute;n de otros ingresos en el total de ingresos.";
    var mensajeINTIO3 = " Justifique el por qu&eacute; sus ingresos diferentes a alojamiento son proporcionalmente mayores en el total de ingresos.";
    var mensajeINOIO = "Desagregue y justifique valor de otros ingresos operacionales.";
    var mensajeINALO2 = "Especifique el valor de ingresos por alojamiento.";
    var mensajeINALO3 = "Justifique por qu&eacute; los ingresos por alojamiento est&aacute;n en cero.";
    var mensajeINOE = "Especifique el ingreso por alquiler de salones indicando los principales eventos realizados.";
    var mensajeINBA = "Justificar por qu&eacute; los ingresos por bebidas alcoh&oacute;licas son mayores que los de servicio de alojamiento.";
    var mensajeINSR = "Justificar por qu&eacute; los ingresos por servicios receptivos y conexos son mayores que los ingresos por alojamiento.";
    var mensajeINOE = "Justificar por qu&eacute; los ingresos por organizaci&oacute;n de convenciones (MICE)  son mayores que los ingresos por alojamiento, y especifique los principales eventos realizados.";
    var mensajeINOIO = "Justifique cual o cuales  ingresos son los  que inciden al aumento del valor de otros ingresos.";
    var mensajeGPSSDE = "Justificar el bajo sueldo y salarios del personal temporal contratado directamente por la empresa.";
    var mensajeGPPGPA = "Justificar el bajo sueldo y salarios del personal aprend&iacute;z";
    var mensajeINCAT = "Especifique el ingreso por rervicios de catering para eventos.";
    var mensajeIHOA = "Justifique por qu&eacute; durante el mes, el n&uacute;mero de habitaciones vendidas fue mayor que el de habitaciones disponibles.";
    var mensajeICVA = "En el mes el n&uacute;mero de camas vendidas fue mayor que el n&uacute;mero de camas disponibles &iquest;Se vendieron camas supletorias?";
    var mensajeHUETOT = "Justifique por qu&eacute; durante el mes, el n&uacute;mero total de hu&eacute;spedes es igual al n&uacute;mero de camas vendidas.";
    var mensajeTHUDOB = "Verificar por qu&eacute; la tarifa por persona en habitaci&oacute;n sencilla es mayor que la doble.";
    var mensajeTHUSUI = "Verificar por qu&eacute; la tarifa por persona en habitaci&oacute;n sencilla es mayor que la tipo suite.";
    var mensajeTHUMULT = "Verificar por qu&eacute; la tarifa por persona en habitaci&oacute;n sencilla es mayor que la m&uacute;ltiple.";
    var mensajeMVAM = "Especifique otros motivos viaje no solicitados antes, residentes.";
    var mensajeMVAMNR = "Especifique otros motivos viaje no no solicitados antes, no residentes.";

    var numord = $("#hddNroOrden").val();
    var numest = $("#hddNroEstablecimiento").val();


    $("#inalii").hint("Catering (Producci&oacute;n de servicio de comida en el lugar se&ntilde;alado por el cliente).");
    $("#inoee").hint("MICE (Meeting, incentives, congresses, exhibitions). Incluya todo lo referente a alquiler; log&iacute;stica, alimentaci&oacute;n, promoci&oacute;n y venta  de eventos empresariales.");
    $("#inoioo").hint("Incluya todo lo referente a comunicaciones, lavander&iacute;a, peluquer&iacute;a, arrendamientos,  etc.");
    $("#insrr").hint("City tours, gu&iacute;as tur&iacute;sticos, pasad&iacute;as, organizaci&oacute;n de viajes, operadores y servicios similares y conexos.");
    //$("#habdia").hint("Disponibles promedio d&iacute;a. Infraestructura. Capacidad de alojamiento.");
    $("#ihdo").hint("Las habitaciones ofrecidas pueden cambiar si hay habitaciones en mantenimiento o cerradas temporalmente. Ej: si tiene 10 habitaciones f&iacute;sicas que estuvieron disponibles todos los 30 d&iacute;as del mes 'para un mes calendario = 30', entonces las habitaciones ofrecidas total mes ser&aacute;n 300.");
    $("#ihoa").hint("Suma de a + b (ocupadas por venta directa + ocupadas por tiempo compartido).");
    //$("#camdia").hint("Disponibles promedio d&iacute;a. Infraestructura. Capacidad de alojamiento. No se incluyen las camas supletorias.");
    $("#icda").hint("Hace referencia a las camas fijas realmente ofrecidas en el mes. No se cuentan camas supletorias.");
    $("#icva").hint("Se obtiene de acuerdo con los registros de hu&eacute;spedes, sumando d�a a d�a el n&uacute;mero de veces que cada cama ha estado cedida (vendida) a un cliente; por ejemplo, si la totalidad de hoteles tiene f&iacute;sicamente 200 camas, de las cuales 160 permanecen ocupadas todo el mes, el n&uacute;mero de camas vendidas es de 4 800 (160 camas x 30 d&iacute;as.");
    $("#texto6").hint("Persona que se aloja en un establecimiento, mediante contrato de hospedaje. S&oacute;lo se registran las personas que llegan sin tener en cuenta el tiempo de pernoctaci&oacute;n (Ej. Una persona se registra en un hotel, pernocta seis (6) noches seguidas, se reportar&aacute; como un solo hu&eacute;sped)");
    $("#huetot").hint("Suma de residentes m&aacute;s no residentes");
    //$("#texto1").hint("Motivo sin el cual el viaje no se hubiera efectuado.");
    $("#texto2").hint("Ingresos totales por habitaci&oacute;n. Incluye ingresos por alojamiento y otros cobros.");
    $("#texto3").hint("Triple, cu&aacute;druple");
    $("#texto4").hint("Caba&ntilde;a, Apartamento, camping, etc.");
    //$("#textoMICE").hint("MICE�( Meeting, incentives, congresses, exhibitions), es aquel que abarca las actividades basadas en la organizaci&oacute;n, promoci&oacute;n, venta y distribuci&oacute;n de reuniones y eventos; productos y servicios que incluyen reuniones gubernamentales, de empresas y de asociaciones; viajes de incentivos de empresas, seminarios, congresos, conferencias, convenciones, exposiciones y ferias.");
    $("#nota").hint("Infraestructura -capacidad de alojamiento- no incluye supletorias o adicionales.");
    $("#textoMICE").hint("MICE( Meeting, incentives, congresses, exhibitions), es aquel que abarca las actividades basadas en la organizaci&oacute;n, promoci&oacute;n, venta y distribuci&oacute;n de reuniones y eventos; productos y servicios que incluyen reuniones gubernamentales, de empresas y de asociaciones; viajes de incentivos de empresas, seminarios, congresos, conferencias, convenciones, exposiciones y ferias.");
    $("#texto1").hint("(Motivo sin el cual el viaje no se hubiera efectuado).");

    /*$("#gpssde").cajaObservaciones('parseInt($("#gpssde").val()) < SMMLV',"divgpssde",mensajeGPSSDE,'obsgpssde');
     $("#gppgpa").cajaObservaciones('parseInt($("#gppgpa").val()) < (SMMLV / 2)',"divgppgpa",mensajeGPPGPA,'obsgppgpa');  //Validaciones para justificar el salario de aprendices.
     $("#inoe").hint("Incluya todo lo referente a alquiler, log&iacute;stica, alimentaci&oacute;n, etc..");
     $("#inoio").hint("Incluye comunicaciones, lavander&iacute;a, peluquer&iacute;a, etc.");
     $("#insr").hint("City tours, gu&iacute;as tur&iacute;sticos, servicios de organizaci&oacute;n de viajes, operadores y servicios similares.");
     $("#incat").hint("Producci&oacute;n de servicio de comida en el lugar se&ntilde;alado por el cliente.");
     $("#intio").cajaObservaciones('parseInt($("#inalo").val()) < 0.5 * parseInt($("#intio").val())','divintio1',mensajeINALO,'obsintio1');
     $("#intio").cajaObservaciones('parseInt($("#inoio").val()) > 0.4 * parseInt($("#intio").val())','divintio2',mensajeINTIO,'obsintio2');
     $("#inalo").cajaObservaciones('parseInt($("#inalo").val()) > 0','divinalo',mensajeINALO2,'obsinalo');
     $("#inoio").cajaObservaciones('parseInt($("#inoio").val()) > 0','divinoio',mensajeINOIO,'obsinoio');
     $("#inoe").cajaObservaciones('parseInt($("#inoe").val()) > 0','divinoe',mensajeINOE,'obsinoe');
     $("#incat").cajaObservaciones('parseInt($("#incat").val()) > 0','divincat',mensajeINCAT,'obsincat');
     $("#ihoa").cajaObservaciones('parseInt($("#ihoa").val()) > parseInt($("#ihdo").val())','divihoa',mensajeIHOA,'obsihoa');
     $("#icva").cajaObservaciones('parseInt($("#icva").val()) > parseInt($("#icda").val())','divicva',mensajeICVA,'obsicva');
     $("#huetot").cajaObservaciones('parseInt($("#huetot").val()) == parseInt($("#icva").val())','divhuetot',mensajeHUETOT,'obshuetot');
     $("#thudob").cajaObservaciones('parseInt($("#thusen").val()) > parseInt($("#thudob").val())','divthudob',mensajeTHUDOB,'obsthudob');
     $("#thusui").cajaObservaciones('parseInt($("#thusen").val()) > parseInt($("#thusui").val())','divthusui',mensajeTHUSUI,'obsthusui');
     $("#thumult").cajaObservaciones('parseInt($("#thusen").val()) > parseInt($("#thumult").val())','divthumult',mensajeTHUMULT,'obsthumult');
     $("#mvam").cajaObservaciones('parseInt($("#mvam").val()) > 0','divmvam',mensajeMVAM,'obsmvam');
     $("#mvamnr").cajaObservaciones('parseInt($("#mvamnr").val()) > 0','divmvamnr',mensajeMVAMNR,'obsmvamnr');*/

    $("#observacionesADM").hide();
    $("#agregarEmpresa").hide();
    $("#agregarFuente").hide();
    $("#removerFuente").hide();
    $("#iddepto").cargarCombo("idmpio", "administrador/actualizarmunicipios");
    $("#iddeptoest").cargarCombo("idmpioest", "administrador/actualizarmunicipios");
    $("#cmbSedes").cargarCombo("cmbSubsedes", "administrador/actualizarSubsedes");
    $("#cmbSedeCR").cargarCombo("cmbSubSedeCR", "administrador/actualizarSubsedes");
    $("#texto2").hint("MICE (Meeting, incentives, congresses, exhibitions), es aquel que abarca las actividades basadas en la organizaci&oacute;n, promoci&oacute;n, venta y distribuci&oacute;n de reuniones y eventos; productos y servicios que incluyen reuniones gubernamentales, de empresas y de asociaciones; viajes de incentivos de empresas, seminarios, congresos, conferencias, convenciones, exposiciones y ferias.");

    if ((typeof (numord) != "undefined") && (typeof (numest) != "undefined")) {

        //Lanzo funci�n ajax para saber si la fuente ha diligenciado justificaciones para este capitulo y mostrarlas en el recuadro. (Modulo 2)
        $.ajax({
            type: "POST",
            url: base_url + "administrador/obtenerObservaciones/" + numord + "/" + numest,
            data: {'campo': 0, 'modulo': 2}, //Se envia el campo en cero para que traiga todas las observaciones del modulo 2
            dataType: "html",
            cache: false,
            success: function (data) {
                var datos = eval(data);
                if (typeof (datos) != "undefined") { //Si se recibio alguna respuesta de observaciones 
                    for (i = 0; i < datos.length; i++) {
                        var bloquear = "";
                        var div = "#div" + datos[i].campo;
                        var caja = "obs" + datos[i].campo;
                        datos[i].mensaje = obtenerMensaje2(datos[i].campo); //Obtengo el mensaje para la justificacion.
                        if (datos[i].bloqueo == true) {
                            var bloquear = 'disabled = "disabled"';
                        }
                        var contenido = '<p>' + datos[i].mensaje + '</p><textarea id="' + caja + '" name="' + caja + '" rows="3" style="width: 75%; border: 1px solid #CCCCCC;"' + bloquear + ' disabled>' + datos[i].descripcion + '</textarea>';
                        //Muestro el contenido dentro del div asignado
                        $(div).html(contenido);
                    }
                }
            }
        });

        //Lanzo funci�n ajax para saber si la fuente ha diligenciado justificaciones para este capitulo y mostrarlas en el recuadro. (Modulo 3)
        $.ajax({
            type: "POST",
            url: base_url + "administrador/obtenerObservaciones/" + numord + "/" + numest,
            data: {'campo': 0, 'modulo': 3}, //Se envia el campo en cero para que traiga todas las observaciones del modulo 2
            dataType: "html",
            cache: false,
            success: function (data) {
                var datos = eval(data);
                if (typeof (datos) != "undefined") { //Si se recibio alguna respuesta de observaciones 
                    for (i = 0; i < datos.length; i++) {
                        var bloquear = "";
                        var div = "#div" + datos[i].campo;
                        var caja = "obs" + datos[i].campo;
                        datos[i].mensaje = obtenerMensaje3(datos[i].campo); //Obtengo el mensaje para la justificacion.
                        if (datos[i].bloqueo == true) {
                            var bloquear = 'disabled = "disabled"';
                        }
                        var contenido = '<p>' + datos[i].mensaje + '</p><textarea id="' + caja + '" name="' + caja + '" rows="3" style="width: 75%; border: 1px solid #CCCCCC;"' + bloquear + ' disabled>' + datos[i].descripcion + '</textarea>';
                        //Muestro el contenido dentro del div asignado
                        $(div).html(contenido);
                    }
                }
            }
        });

        //Lanzo funci�n ajax para saber si la fuente ha diligenciado justificaciones para este capitulo y mostrarlas en el recuadro. (Modulo 4)
        $.ajax({
            type: "POST",
            url: base_url + "administrador/obtenerObservaciones/" + numord + "/" + numest,
            data: {'campo': 0, 'modulo': 4}, //Se envia el campo en cero para que traiga todas las observaciones del modulo 2
            dataType: "html",
            cache: false,
            //alert (data);
            success: function (data) {
                var datos = eval(data);
                if (typeof (datos) != "undefined") { //Si se recibio alguna respuesta de observaciones 
                    for (i = 0; i < datos.length; i++) {
                        var bloquear = "";
                        var div = "#div" + datos[i].campo;
                        var caja = "obs" + datos[i].campo;
                        datos[i].mensaje = obtenerMensaje4(datos[i].campo); //Obtengo el mensaje para la justificacion.
                        if (datos[i].bloqueo == true) {
                            var bloquear = 'disabled = "disabled"';
                        }
                        var contenido = '<p>' + datos[i].mensaje + '</p><textarea id="' + caja + '" name="' + caja + '" rows="3" style="width: 75%; border: 1px solid #CCCCCC;"' + bloquear + ' disabled>' + datos[i].descripcion + '</textarea>';
                        //Muestro el contenido dentro del div asignado
                        $(div).html(contenido);
                    }
                }
            }
        });

    }

    //Configurar el formulario para agregar fuentes.
    $("#txtNumOrden").numerico().largo(11);
    $("#txtNitEmpresa").numerico().largo(20);
    $("#txtNomEmpresa").mayusculas().largo(80);
    $("#txtNumEstab").numerico().largo(11);
    $("#txtNomEstab").mayusculas().largo(80);
    $("#txtDirEstab").mayusculas().largo(80);
    $("#cmbDeptoEstab").cargarCombo("cmbMpioEstab", "administrador/actualizarMunicipios");
    $("#cmbSedeEstab").cargarCombo("cmbSubSedeEstab", "administrador/actualizarSubsedes");
    var i = 0;
    for (i; i <= 1000; i++) {
        $("#cmbSedeEstab" + i).cargarCombo("cmbSubSedeEstab" + i, "administrador/actualizarSubsedes");
    }

    //Actualizar la sesion con el periodo seleccionado en el comboBox de periodos
    $("#cmbPeriodo").change(function () {
        $('#frmPeriodo').submit();
    });


    //Abre el dialogo para agregar una nueva empresa
    $("#btnAgregarEmpresa").click(function () {
        $("#agregarEmpresa").dialog({
            width: 780,
            title: 'Agregar empresas',
            modal: true
        });
    });
    
    //Abre el dialogo para agregar una nueva empresa
    $("#btnAgregarUsuario").click(function () {
        $("#agregarUsuario").dialog({
            width: 780,
            title: 'Agregar usuarios',
            modal: true
        });
    });
    
    //Abre el dialogo para agregar una nueva empresa
    $("#btnModifUsuario").click(function () {
        $("#modifUsuario").dialog({
            width: 780,
            title: 'Agregar usuarios',
            modal: true
        });
    });


    //Abre el dialogo para agregar una nueva fuente
    $("#btnAgregar").click(function () {
        $("#agregarFuente").dialog({
            width: 780,
            title: 'Agregar clientes',
            modal: true
        });
    });
    
    //Abre el dialogo para agregar editar fuentes
    $("#btnEditar").click(function () {
        $("#editarCliente").dialog({
            width: 780,
            title: 'Editar clientes',
            modal: true
        });
    });

    $("#btnUsuEstab").click(function () {
        $("#generarUsuarioEstab").dialog({
            width: 780,
            title: 'Generar usuarios establecimientos',
            modal: true
        });
    });

    $("#btnUsuEstabMini").click(function () {
        $("#generarUsuarioEstabMini").dialog({
            width: 780,
            title: 'Generar usuarios establecimientos miniencuesta',
            modal: true
        });
    });

    $("#btnUSuEmp").click(function () {
        $("#generarUsuarioEmpresa").dialog({
            width: 780,
            title: 'Generar usuario empresas',
            modal: true
        });
    });

    //Valida el env�o del formulario de agregar empresas
    $("#btnAgregarEmpresaInt").click(function () {
        $("#frmEmpresaInsert").validate({
            rules: {
                txtNroOrden: {required: true},
                txtNitEmpresa: {required: true},
                txtRazonSocial: {required: true},
                txtPagWeb: {url: true},
                txtEmail: {email: true},
                cmbDepartamento: {required: true,
                    comboBox: '-'
                },
                cmbCiudad: {required: true,
                    comboBox: '-'
                }
            },
            messages: {
                txtNroOrden: {required: "Debe ingresar el nro. de orden de la empresa."},
                txtNitEmpresa: {required: "Debe ingresar el Nit de la empresa."},
                txtRazonSocial: {required: "Debe ingresar la raz&oacute;n social."},
                txtPagWeb: {url: "No es una direcci&oacute;n web v&aacute;lida. Agregue 'http://' al iniciar."},
                txtEmail: {email: "No es una direcci&oacute;n de correo v&aacute;lida"},
                cmbDepartamento: {required: "Debe seleccionar el departamento de la empresa",
                    comboBox: "Debe seleccionar el departamento de la empresa"
                },
                cmbCiudad: {required: "Debe seleccionar el municipio de la empresa",
                    comboBox: "Debe seleccionar el municipio de la empresa"
                }
            },
            errorPlacement: function (error, element) {
                element.after(error);
                error.css('opacity','0.47');
                error.css('z-index','991');
                error.css('background','#ee0101');
                //error.css('float','right');
                error.css('position','absolute');
                error.css('margin-top','1px');
                error.css('color','#fff');
                error.css('font-size','11px');
                error.css('border','2px solid #ddd');
                error.css('box-shadow','0 0 6px #000');
                error.css('-moz-box-shadow','0 0 6px #000');
                error.css('-webkit-box-shadow','0 0 6px #000');
                error.css('padding','4px 10px 4px 10px');
                error.css('border-radius','6px');
                error.css('-moz-border-radius','6px');
                error.css('-webkit-border-radius','6px');
            },
            submitHandler: function (form) {
                $.ajax({
                    type: "POST",
                    url: base_url + "administrador/insertarEmpresa",
                    data: $("#frmEmpresaInsert").serialize(),
                    dataType: "html",
                    cache: false,
                    success: function (data) {
                        alert(data);
                        $("#agregarEmpresa").dialog('close');
                    }
                });
            }
        });
    });




    //Valida el env�o del formulario de agregar empresas
    $("#btnSalarioMin").click(function () {
        $("#frmSalarioMin").validate({
            rules: {
                salario: {required: true,
                          number: true  }
            },
            messages: {
                salario: {required: "Debe ingresar el salario minimo.",
                          number:"El campo debe ser num�rico"  }
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
            },
            submitHandler: function (form) {
                $.ajax({
                    type: "POST",
                    url: base_url + "administrador/actualizarSalarioMin",
                    data: $("#frmSalarioMin").serialize(),
                    dataType: "html",
                    cache: false,
                    success: function (data) {
                        //form.submit();
                       // $("#agregarEmpresa").dialog('close');
                        $("#mensaje").css('opacity', '0.47');
                        $("#mensaje").css('z-index', '991');
                        $("#mensaje").css('background', '#ee0101');
                        //error.css('float','right');
                        $("#mensaje").css('position', 'absolute');
                        $("#mensaje").css('margin-top', '1px');
                        $("#mensaje").css('color', '#fff');
                        $("#mensaje").css('font-size', '11px');
                        $("#mensaje").css('border', '2px solid #ddd');
                        $("#mensaje").css('box-shadow', '0 0 6px #000');
                        $("#mensaje").css('-moz-box-shadow', '0 0 6px #000');
                        $("#mensaje").css('-webkit-box-shadow', '0 0 6px #000');
                        $("#mensaje").css('padding', '4px 10px 4px 10px');
                        $("#mensaje").css('border-radius', '6px');
                        $("#mensaje").css('-moz-border-radius', '6px');
                        $("#mensaje").css('-webkit-border-radius', '6px');
                       $("#mensaje").html("El salario se actualiz� correctamente");
                    }
                });
            }
        });
    });



    //Valida el env�o del formulario de agregar establecimientos
    $("#btnAgregarFuenteInt").click(function () {

        $("#frmAgregarFTE").validate({
            rules: {
                txtNumOrden: {
                    required: true
                },
                txtNitEmpresa: {
                    required: true
                },
                txtNomEmpresa: {
                    required: true
                },
                txtNumEstab: {
                    required: true
                },
                txtNomEstab: {
                    required: true
                },
                txtDirEstab: {
                    required: true
                },
                idtelefono: {
                    required: true
                },
                 idcorreo: {
                    required: true,
                    email: true
                },
                cmbDeptoEstab: {
                    required: true,
                    comboBox: '-'
                },
                cmbMpioEstab: {
                    required: true,
                    comboBox: '-'
                },
                cmbActivEstab: {
                    required: true,
                    comboBox: '-'
                },
                cmbSedeEstab: {
                    required: true,
                    comboBox: '-'
                },
                cmbSubSedeEstab: {
                    required: true,
                    comboBox: '-'
                },
                nom_contacto: {
                    required: true
                },
                cmbInclusion: {
                    required: true,
                    comboBox: '-'
                }
            },
            messages: {
                txtNumOrden: {
                    required: "Debe ingresar el n&uacute;mero de orden de la empresa"
                },
                txtNitEmpresa: {
                    required: "Debe ingresar el nit de la empresa"
                },
                txtNomEmpresa: {
                    required: "Debe ingresar el nombre de la empresa"
                },
                txtNumEstab: {
                    required: "Debe ingresar el n&uacute;mero de establecimiento"
                },
                txtNomEstab: {
                    required: "Debe ingresar el nombre del establecimiento"
                },
                txtDirEstab: {
                    required: "Debe ingresar la direcci&oacute;n del establecimiento"
                },
                idtelefono: {
                    required: "Debe ingresar el número de teléfono"
                },
                idcorreo: {
                    required: "Debe ingresar el correo electrónico",
                    email : "Debe ingresar un correo electrónico válido"
                },
                cmbDeptoEstab: {
                    required: "Debe indicar el departamento",
                    comboBox: "Debe indicar el departamento"
                },
                cmbMpioEstab: {
                    required: "Debe indicar el municipio",
                    comboBox: "Debe indicar el municipio"
                },
                cmbActivEstab: {
                    required: "Debe indicar la actividad",
                    comboBox: "Debe indicar la actividad"
                },
                cmbSedeEstab: {
                    required: "Debe indicar la sede",
                    comboBox: "Debe indicar la sede"
                },
                cmbSubSedeEstab: {
                    required: "Debe indicar la sub - sede",
                    comboBox: "Debe indicar la sub - sede"
                },
                nom_contacto: {
                    required: "Debe ingrear el nombre del contacto",
                },
                cmbInclusion: {
                    required: "Debe indicar el tipo de inclusi&oacute;n",
                    comboBox: "Debe indicar el tipo de inclusi&oacute;n"
                }
            },
            errorPlacement: function (error, element) {
                element.after(error);
                error.css('opacity','0.47');
                error.css('z-index','991');
                error.css('background','#ee0101');
                //error.css('float','right');
                error.css('position','absolute');
                error.css('margin-top','1px');
                error.css('color','#fff');
                error.css('font-size','11px');
                error.css('border','2px solid #ddd');
                error.css('box-shadow','0 0 6px #000');
                error.css('-moz-box-shadow','0 0 6px #000');
                error.css('-webkit-box-shadow','0 0 6px #000');
                error.css('padding','4px 10px 4px 10px');
                error.css('border-radius','6px');
                error.css('-moz-border-radius','6px');
                error.css('-webkit-border-radius','6px');
            },
            submitHandler: function (form) {
                $.ajax({
                    type: "POST",
                    url: base_url + "administrador/insertarFuente",
                    data: $("#frmAgregarFTE").serialize(),
                    dataType: "html",
                    cache: false,
                    success: function (data) {
                        if (data != "") {
                            alert(data);
                        }
                        form.submit();
                        //$("#agregarEmpresa").dialog('close');
                    }
                });
            }
        });
    });



    //Abre el dialogo para eliminar una fuente.
    $("#btnEliminar").click(function () {
        $("#removerFuente").dialog({
            width: 950,
            title: 'Remover Fuentes',
            modal: true
        });
    });


    $("#btnAperEst").click(function () {
        $("#adminEstablecimientos").dialog({
            width: 950,
            title: 'Establecimientos abiertos por la empresa',
            modal: true
        });
    });
    
    $("#btnCieEst").click(function () {
        $("#adminEstablecimientos1").dialog({
            width: 950,
            title: 'Establecimientos abiertos por la empresa',
            modal: true
        });
    });

    //Cierra el dialogo para eliminar una fuente
    $("#btnCancelarFTE").click(function () {
        $("#removerFuente").dialog('close');
    });

    //Actualiza los datos de la fuente al cambiar la seleccion del combo de fuentes en la eliminacion de fuentes
    $("#cmbFuente").change(function () {
        $.ajax({
            type: "POST",
            url: base_url + "administrador/obtenerDatosFuente",
            data: $("#frmRemoverFTE").serialize(),
            dataType: "html",
            cache: false,
            success: function (data) {
                $("#datosFuente").html(data);
            }
        });
    });

    //Remueve una de las fuentes que han sido seleccionadas desde la opcion eliminar fuente.	
    $("#btnRemoverFTE").click(function () {
        $.ajax({
            type: "POST",
            url: base_url + "administrador/removerFuente",
            data: $("#frmRemoverFTE").serialize(),
            dataType: "html",
            cache: false,
            success: function (data) {
                form.submit();
            }
        });
        $("#removerFuente").dialog('close');
    });


    //Descarga los datos del directorio
    $("#btnDescarga").click(function () {
        $("#frmDir").submit();
    });

    //Descarga los datos del directorio de usuarios
    $("#btnDescargaDir").click(function () {
        $("#frmDirUsuarios").submit();
    });


    /****
     //Busca una fuente dentro del directorio de fuentes.
     $("#btnBuscarADM").click(function(){
     var opcion = $("input[name='radBusqueda']:checked").val();
     var buscar = $("#txtBuscar").val();
     $.ajax({
     type: "POST",
     url: base_url + "administrador/buscarFuentes",
     data: {'opcion': opcion,
     'buscar': buscar
     },
     dataType: "html", 
     cache: false,
     success: function(data){
     $("#divResultados").html(data);
     }
     });		
     });
     ****/


    //Descarga los datos del directorio
    $("#btnDescarga").click(function () {
        $("#frmDir").submit();
    });

    /*//Descarga pnanos consolidado y varios periodos
     $("#btnDescargaPlanos").click(function(){
     if(!$("#per1").val().checked)  
     {
     alert ('Debe seleccionar una opcion');
     return false;
     }
     else
     {
     alert "mmm";
     }	
     });*/

    //Agrega un nuevo usuario al sistema (Muestra el dialogo para crear el nuevo usuario)
    $("#btnInsertar").click(function () {
        $.ajax({url: base_url + "administrador/INSUsuario",
            type: "post",
            dataType: "html",
            //alert(url);
            success: function (data) {
                $("#detalle").html(data);
            }
        });
    });



    //Abrir la ventana para obtener las observaciones del administrador para el capitulo I (Caratula)
    $("#btnOBSAdminI").click(function () {
        if ($("#frmModuloI").valid()) {
            $("#hddCapitulo").val(1);
            $("#txaObservacionesADM").val("");
            $("#observacionesADM").dialog({
                width: 480,
                title: 'Observaciones de Administrador',
                modal: true,
            });
            $("#tabs").tabs({selected: 0});
        }
    });

    //Abrir la ventana para obtener las observaciones del administrador para el capitulo II (Movimiento mensual)
    $("#btnOBSAdminII").click(function () {
        if ($("#frmModuloII").valid()) {
            if (parseInt($("#potpsfr").val()) == 0) {
                del = confirm('�Est� seguro que desea registrar el valor de personal propietarios, socios y familiares en 0?');
                if (del) {
                    cierto = 1;
                } else {
                    return false;
                }
            } else {
                cierto = 2;
            }
            if (cierto == 1 || cierto == 2) {
                $("#hddCapitulo").val(2);
                $("#txaObservacionesADM").val("");
                $("#observacionesADM").dialog({
                    width: 480,
                    title: 'Observaciones de Administrador',
                    modal: true
                });
                $("#tabs").tabs({selected: 1});
            }
        }
    });

    //Abrir la ventana para obtener las observaciones del administrador para el capitulo III (Ingresos Netos Operacionales)
    $("#btnOBSAdminIII").click(function () {
        if ($("#frmModuloIII").valid()) {
            $("#hddCapitulo").val(3);
            $("#txaObservacionesADM").val("");
            $("#observacionesADM").dialog({
                width: 480,
                title: 'Observaciones de Administrador',
                modal: true
            });
            $("#tabs").tabs({selected: 2});
        }
    });

    //Abrir la ventana para obtener las observaciones del administrador para el capitulo IV (Personal ocupado promedio)
    $("#btnOBSAdminIV").click(function () {
        if ($("#frmModuloIV").valid()) {
            if ($("#ihpn").val() != 0 && $("#mvott").val() != 100)
            {
                alert('El porcentaje del motivo de viaje de residentes debe ser igual a 100!!!');
                return false;
            } else if ($("#ihpnr").val() != 0 && $("#mvottnr").val() != 100)
            {
                alert('El porcentaje del motivo de viaje de NO residentes debe ser igual a 100!!!');
                return false;
            } else if ($("#ihpn").val() == 0 && $("#mvott").val() != 0)
            {
                alert('El n�mero de residentes de en Colombia es 0, por lo tanto el porcentaje del motivo de viaje residentes debe ser igual a 0!!!');
                return false;
            } else if ($("#ihpnr").val() == 0 && $("#mvottnr").val() != 0)
            {
                alert('El n�mero de NO residentes es 0, por lo tanto el porcentaje del motivo de viaje  de NO residentes debe ser igual a 0!!!');
                return false;
            } else
            {
                $("#hddCapitulo").val(4);
                $("#txaObservacionesADM").val("");
                $("#observacionesADM").dialog({
                    width: 480,
                    title: 'Observaciones de Administrador',
                    modal: true
                });
                $("#tabs").tabs({selected: 3});
            }
        }
    });

    //Abrir la ventana para obtener las observaciones del administrador para el capitulo V (Ciiu 4)
    $("#btnOBSAdminV").click(function () {
        if ($("#frmModuloV").valid()) {
            $("#hddCapitulo").val(5);
            $("#txaObservacionesADM").val("");
            $("#observacionesADM").dialog({
                width: 480,
                title: 'Observaciones de Adminsitrador',
                modal: true
            });
            $("#tabs").tabs({selected: 4});
        }
    });

    //Abrir la ventana para obtener las observaciones del administrador para el envio del formulario
    $("#btnOBSEnvioADM").click(function () {
        if ($("#frmModuloEnvio").valid()) {
            $("#hddCapitulo").val(0);
            $("#txaObservacionesADM").val("");
            $("#observacionesADM").dialog({
                width: 480,
                title: 'Observaciones de Administrador',
                modal: true
            });
            $("#tabs").tabs({selected: 4});
        }
    });



    //Ejecutar las funciones AJAX para guardar los comentarios de la administracion y los datos modificados del formulario
    $("#btnGuardarCriticaADM").click(function () {
        //Guardar los datos del formulario
        var formulario = "";

        switch ($("#hddCapitulo").val()) {
            case '1':
                formulario = "#frmModuloI";
                break;
            case '2':
                formulario = "#frmModuloII";
                break;
            case '3':
                formulario = "#frmModuloIII";
                break;
            case '4':
                formulario = "#frmModuloIV";
                break;
            case '5':
                formulario = "#frmModuloV";
                break;
            default:
                formulario = "#frmModuloEnvio";
                break;
        }
        //Valida que digiten las observaciones
        if ($("#txaObservacionesADM").val() == '')
        {
            alert('Por favor digite las observaciones...');
            return false;
        } else
        {
            $.ajax({
                type: "POST",
                url: base_url + "administrador/guardarCapitulo",
                data: {'observacion': $("#txaObservacionesADM").val(), 'capitulo': $("#hddCapitulo").val(), 'form': $(formulario).serialize()},
                dataType: "html",
                cache: false,
                success: function (data) {
                    $("#observacionesADM").dialog("close");
                    location.reload(); //Recargar la pagina.
                }
            });
        }
    });

    //Actualiza las subsedes del combo sede en el reporte operativo
    $("#cmbSedeOP").change(function () {
        var sede = $("#cmbSedeOP").val();
        $.ajax({url: base_url + "administrador/actualizarSubSedeOperativo",
            data: {'sede': sede},
            type: "post",
            dataType: "html",
            success: function (data) {
                $("#subSede").html(data);
            }
        });
    });

    //Consultar el reporte operativo
    $("#btnConsultar").click(function () {
        var sede = $("#cmbSedeOP").val();
        var subsede = $("#cmbSubSedeOP").val();
        if ((sede == "-") || (subsede == "-")) {
            alert("Por favor seleccione sede y subsede.");
        } else {
            $.ajax({url: base_url + "administrador/actualizarOperativo",
                data: {'sede': sede, 'subsede': subsede},
                type: "post",
                dataType: "html",
                success: function (data) {
                    $("#tresumen").html(data);
                }
            });
        }
    });


    //Consultar el reporte operativo del critico
    $("#btnOperCR").click(function () {
        var sede = $("#cmbSedeCR").val();
        var subsede = $("#cmbSubSedeCR").val();
        if ((sede == "-") || (subsede == "-")) {
            alert("Por favor seleccione sede y subsede.");
        } else {
            $.ajax({url: base_url + "administrador/ajaxOperativoCritico/" + sede + "/" + subsede,
                data: {'sede': sede, 'subsede': subsede},
                type: "post",
                dataType: "html",
                success: function (data) {
                    $("#reporteOPCritico").html(data);
                }
            });
        }
    });


    //Apertura de periodos desde el administrador
    $("#btnApertura").click(function () {
        $.ajax({url: base_url + "administrador/aperturaPeriodoX",
            data: {'ano': $("#hddAno").val(),
                'mes': $("#hddMes").val()
            },
            type: "post",
            dataType: "html",
            success: function (data) {
                $("#resultCierre").html("");
                $("#resultCierre").css('background-color', "#FFFFFF");
                $("#resultApertura").html(data);
                $("#resultApertura").effect('slide', '', 500, '');
            }
        });
    });

    $("#btnCierrePer").click(function () {
        var cierre = confirm("Realmente desea cerrar este periodo ?");
        if (cierre == true) {
            $.ajax({url: base_url + "administrador/cierreEfectivoPeriodo",
                data: {'ano': $("#hddAno").val(),
                    'mes': $("#hddMes").val()
                },
                type: "post",
                dataType: "html",
                success: function (data) {
                    alert(data);
                    location.reload();
                }
            });
        }
    });



    //************************************************************************
    //* VALIDACIONES DE LOS FORMULARIOS EN EL ADMINISTRADOR                  *
    //* SE REUTILIZAN LAS MISMAS VALIDACIONES QUE SE REALIZARON EN LA FUENTE *
    //************************************************************************

    //VALIDACIONES PARA EL MODULO I
    $("#frmModuloI").validate({
        rules: {
            idproraz: {required: true,
                alfanumerico: true
            },
            idnomcom: {required: true
            },
            idsigla: {maxlength: 20
            },
            iddirecc: {required: true
            },
            iddepto: {comboBox: '-'
            },
            idmpio: {comboBox: '-'
            },
            idtelno: {required: true,
                min: 7
            },
            idpagweb: {required: false,
                url: true
            },
            idcorreo: {email: true
            },
            finicial: {required: true
            },
            ffinal: {required: true
            },
            idnomcomest: {required: true,
                alfanumerico: true
            },
            idsiglaest: {maxlength: 20
            },
            iddireccest: {required: true
            },
            iddeptoest: {comboBox: '-'
            },
            idmpioest: {comboBox: '-'
            },
            idtelnoest: {required: true,
                min: 7
            },
            idcorreoest: {email: true
            },
            obsidproraz: {required: true
            }
        },
        messages: {
            idproraz: {required: "Falta la raz&oacute;n social.",
                alfanumerico: "El campo debe ser alfanumerico."
            },
            idnomcom: {required: "Falta nombre comercial."
            },
            idsigla: {maxlength: "M&aacute;ximo 20 caracteres."
            },
            iddirecc: {required: "Falta la direcci&oacute;n de la gerencia."
            },
            iddepto: {comboBox: "Falta el nombre del departamento."
            },
            idmpio: {comboBox: "Falta el nombre del municipio."
            },
            idtelno: {required: "Falta n&uacute;mero de tel&eacute;fono.",
                min: "M&iacute;nimo 7 D&iacute;gitos."
            },
            idpagweb: {required: "",
                url: "Digite una direcci&oacute;n v&aacute;lida (http://www.xxxxx.com)."
            },
            idcorreo: {email: "Digite un correo v&aacute;lido (xxxxxx@xxxx.com)."
            },
            finicial: {required: "Falta fecha inicial."
            },
            ffinal: {required: "Falta fecha final."
            },
            idnomcomest: {required: "Falta nombre comercial establecimiento.",
                alfanumerico: "El campo debe ser alfanumerico."
            },
            idsiglaest: {maxlength: "M&aacute;ximo 20 caracteres."
            },
            iddireccest: {required: "Falta la direcci&oacute;n del establecimiento."
            },
            iddeptoest: {comboBox: "Falta el nombre del departamento."
            },
            idmpioest: {comboBox: "Falta el nombre del municipio."
            },
            idtelnoest: {required: "Falta n&uacute;mero de tel&eacute;fono.",
                min: "M&iacute;nimo 7 D&iacute;gitos."
            },
            idcorreoest: {email: "Digite un correo v&aacute;lido (xxxxxx@xxxx.com)."
            },
            obsidproraz: {required: "Por favor justifique."
            }
        },
        errorPlacement: function (error, element) {
            //Mostrar el error en la parte de abajo de la caja de texto.
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
        submitHandler: function (form) {
            //No se ejecuta nada.
            //Solo se indica si el formulario fue valido o no.
        }
    });

    //VALIDACIONES PARA EL MODULO II
    $("#frmModuloII").validate({
        rules: {
            potpsfr: {required: true,
                menorQue: 0
            },
            potperm: {required: true,
                menorQue: 0,
                expresion: 'parseInt($("#potperm").val())== 0 &&  parseInt($("#gpper").val()) > 0'
            },
            gpper: {required: true,
                expresion: 'parseInt($("#potperm").val()) > 0  &&  parseInt($("#gpper").val()) == 0'
                        //expresion2: '(parseInt($("#gpper").val()) / parseInt($("#potperm").val()) < SMMLV) '
                        //expresion3 : '(parseInt($("#gpper").val()) / parseInt($("#potperm").val()) > SMMLV*25)'	
            },
            pottcde: {required: true,
                menorQue: 0,
                expresion: 'parseInt($("#pottcde").val())== 0 &&  parseInt($("#gpssde").val()) > 0'
            },
            gpssde: {required: true,
                expresion: 'parseInt($("#pottcde").val()) > 0  &&  parseInt($("#gpssde").val()) == 0'
                        // expresion2: 'parseInt($("#gpssde").val()) / parseInt($("#pottcde").val()) < SMMLV'
                        //expresion3 : '(parseInt($("#gpssde").val()) / parseInt($("#pottcde").val()) > SMMLV*25)'
            },
            pottcag: {required: true,
                menorQue: 0,
                expresion: 'parseInt($("#pottcag").val())== 0 &&  parseInt($("#gpppta").val()) > 0'
            },
            gpppta: {required: true,
                expresion: 'parseInt($("#pottcag").val()) > 0  &&  parseInt($("#gpppta").val()) == 0'
                        //expresion2: 'parseInt($("#gpppta").val()) / parseInt($("#pottcag").val()) < SMMLV'
                        //expresion3 : 'parseInt($("#gpppta").val()) / parseInt($("#pottcag").val()) > SMMLV*25'	
            },
            potpau: {required: true,
                menorQue: 0,
                expresion: 'parseInt($("#potpau").val())== 0 &&  parseInt($("#gppgpa").val()) > 0'
            },
            gppgpa: {required: true
                        //expresion  : 'parseInt($("#potpau").val()) > 0  &&  parseInt($("#gppgpa").val()) == 0',							
                        // expresion2: '(parseInt($("#gppgpa").val())!=0) && (parseInt($("#gppgpa").val()) / parseInt($("#potpau").val()) < 0.5 * SMMLV)'
                        //expresion3 : 'parseInt($("#gppgpa").val()) / parseInt($("#potpau").val()) > SMMLV*25'
            },
            pottot: {required: true,
                menorQue: 0,
                igualQue: 'parseInt($("#potpsfr").val()) + parseInt($("#potperm").val()) + parseInt($("#pottcde").val()) + parseInt($("#pottcag").val()) + parseInt($("#potpau").val())'
            },
            gpsspot: {required: true,
                igualQue: 'parseInt($("#gpper").val()) + parseInt($("#gpssde").val()) + parseInt($("#gppgpa").val())'
            },
            obsgppgpa: {required: true
            },
            obspottot: {required: true
            },
            obsgpper: {required: true
            },
            obsgpssde: {required: true
            },
            obsgpppta: {required: true
            },
            obsgppgpa: {required: true
            }
        },
        messages: {
            potpsfr: {required: "Falta n&uacute;mero de personal propietario, socios y familiares.",
                menorQue: "No puede ser negativo."
            },
            potperm: {required: "Falta n&uacute;mero de personal permanente.",
                menorQue: "No puede ser negativo.",
                expresion: "Existen salarios sin personal permanente."
            },
            gpper: {required: "Falta salario de personal permanente.",
                expresion: "Existe personal permanente sin salarios."
                        //expresion2: "<br/>El salario promedio del personal permanente no puede ser menor que el salario m&iacute;nimo mensual legal vigente. Promedie el personal si hay personas que no trabajaron todo el mes."
                        //expresion3 :  "<br/>El salario promedio del personal permanente no puede ser mayor a 25 salarios m&iacute;nimos mensuales legales vigentes. Promedie el personal si hay personas que no trabajaron todo el mes."			
            },
            pottcde: {required: "Falta n&uacute;mero de personal temporal directo.",
                menorQue: "No puede ser negativo.",
                expresion: "Existen salarios sin personal temporal directo."
            },
            gpssde: {required: "Falta salario del personal temporal directo.",
                expresion: "Existe personal temporal directo sin salarios."
                        //expresion2: "<br/>El salario promedio del personal temporal directo no puede ser menor que el salario m&iacute;nimo mensual legal vigente. Promedie el personal si hay personas que no trabajaron todo el mes."
                        //expresion3 : "<br/>El salario promedio del personal temporal directo no puede ser mayor a 25 salarios m&iacute;nimos mensuales legales vigentes. Promedie el personal si hay personas que no trabajaron todo el mes."
            },
            pottcag: {required: "Falta n&uacute;mero de personal temporal indirecto.",
                menorQue: "No puede ser negativo.",
                expresion: "Hay un valor cobrado por otras empresas sin que suministren personal temporal."
            },
            gpppta: {required: "Falta salario de personal temporal indirecto.",
                expresion: "Hay personal temporal con otras empresas sin un valor cobrado por dichas empresas."
                        //expresion2: "<br/>El salario promedio del personal temporal indirecto no puede ser menor que el salario m&iacute;nimo mensual legal vigente. Promedie el personal si hay personas que no trabajaron todo el mes."
                        //expresion3 : "<br/>El salario promedio del personal temporal indirecto no puede ser mayor a 25 salarios m&iacute;nimos mensuales legales vigentes. Promedie el personal si hay personas que no trabajaron todo el mes."
            },
            potpau: {required: "Falta n&uacute;mero de personal aprendiz o estudiante.",
                menorQue: "No puede ser negativo.",
                expresion: "Hay gastos por personal aprendiz sin personas en esta categoria."
            },
            gppgpa: {required: "Falta salario de personal aprendiz o estudiante."
                        //expresion  : "Existe personal aprendiz, pero no hay gastos causados por estos."
                        //expresion2: "<br/>El salario promedio del personal aprendiz no puede ser menor que el 50% del salario m&iacute;nimo mensual legal vigente. Promedie el personal si hay personas que no trabajaron todo el mes."
                        //expresion3 : "<br/>El salario promedio del personal aprendiz no puede ser mayor a 25 salarios m&iacute;nimos mensuales legales vigentes. Promedie el personal si hay personas que no trabajaron todo el mes."
            },
            pottot: {required: "Falta personal ocupado.",
                menorQue: "No puede ser negativo.",
                igualQue: "La suma no corresponde."
            },
            gpsspot: {required: "Falta salario del personal ocupado.",
                igualQue: "La suma no corresponde."
            },
            obsgppgpa: {required: "Justifique."
            },
            obspottot: {required: "Justifique."
            },
            obsgpper: {required: "Justifique."
            },
            obsgpssde: {required: "Justifique."
            },
            obsgpppta: {required: "Justifique."
            },
            obsgppgpa: {required: "Justifique."
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
        },
        submitHandler: function (form) {
            //No se ejecuta nada.
            //Solo se indica si el formulario fue valido o no.
        }
    });

    //VALIDACIONES PARA EL MODULO III
    $("#frmModuloIII").validate({
        rules: {
            inalo: {required: true,
                menorQue: 0
                        // igualQue       :  'parseInt($("#inalovd").val()) + parseInt($("#inaloatc").val())'
            },
            inalovd: {required: true,
                menorQue: 0
            },
            inaloatc: {required: true,
                menorQue: 0
            },
            inali: {required: true,
                menorQue: 0
                        //expresion  	    :   'parseInt($("#inali").val())>parseInt($("#inalo").val())' 
            },
            inba: {required: true,
                menorQue: 0
            },
            insr: {required: true,
                menorQue: 0
            },
            inoe: {required: true,
                menorQue: 0,
                igualQue: 'parseInt($("#inoeconv").val()) + parseInt($("#inoeeven").val())'
            },
            inoeconv: {required: true,
                menorQue: 0
            },
            inoeeven: {required: true,
                menorQue: 0
            },
            incat: {required: true,
                menorQue: 0,
                expresion: 'parseInt($("#incat").val())>parseInt($("#inalo").val())'
            },
            inoio: {required: true,
                menorQue: 0
            },
            intio: {required: true,
                diferenteDe: 0,
                menorQue: 0,
                igualQue: 'parseInt($("#inalo").val()) + parseInt($("#inali").val()) + parseInt($("#inba").val()) + parseInt($("#insr").val()) + parseInt($("#inoe").val()) + parseInt($("#inoio").val())'  //La suma no corresponde
            },
            obsintio1: {required: true
            },
            obsintio2: {required: true
            },
            obsinalo: {required: true
            },
            obsinali: {required: true
            },
            obsinoe: {required: true
            },
            obsincat: {required: true
            },
            obsinoio: {required: true
            },
            obsinba: {required: true
            },
            obsinsr: {required: true
            },
            obsinoe: {required: true
            },
            obsinoio: {required: true
            },
            obsintio3: {required: true
            }
        },
        messages: {
            inalo: {required: "Falta ingresos por alojamiento.",
                menorQue: "No pueden haber ingresos negativos."
                        //igualQue        :   "La suma no corresponde."
            },
            inalovd: {required: "Falta  Ingresos por  alojamiento por ventas directas.",
                menorQue: "No pueden haber ingresos negativos."
            },
            inaloatc: {required: "Falta Ingresos por alojamiento  por administracion de tiempo compartido.",
                menorQue: "No pueden haber ingresos negativos."
            },
            inali: {required: "Falta ingresos por servicios de restaurante y catering para eventos.",
                menorQue: "No pueden haber ingresos negativos."
                        //expresion		:   "Los ingresos por servicio de Restaurante  y catering para eventos son mayores que los de servicio de alojamiento."
            },
            inba: {required: "Falta ingresos por bebidas alcoh&oacute;licas y cigarrillos.",
                menorQue: "No pueden haber ingresos negativos."
            },
            insr: {required: "Falta ingresos de Servicios Receptivos.",
                menorQue: "No pueden haber ingresos negativos."
            },
            inoe: {required: "Falta ingresos por alquiler de salones y/o eventos.",
                menorQue: "No pueden haber ingresos negativos.",
                igualQue: "La suma no corresponde."
            },
            inoeconv: {required: "Falta ingresos por  convenciones .",
                menorQue: "No pueden haber ingresos negativos."
            },
            inoeeven: {required: "Falta ingresos por  eventos sociales.",
                menorQue: "No pueden haber ingresos negativos."
            },
            incat: {required: "Falta servicios de catering para eventos.",
                menorQue: "No pueden haber ingresos negativos.",
                expresion: "Los ingresos por Servicios de Servicios de catering para eventos son mayores que los ingresos por alojamiento."
            },
            inoio: {required: "Faltan otros ingresos netos operacionales.",
                menorQue: "No pueden haber ingresos negativos."
            },
            intio: {required: "Falta total de ingresos operacionales.",
                diferenteDe: "Falta total de ingresos operacionales.",
                menorQue: "No pueden haber ingresos negativos.",
                igualQue: "La suma no corresponde."
            },
            obsintio1: {required: "Justifique."
            },
            obsintio2: {required: "Justifique."
            },
            obsinalo: {required: "Justifique."
            },
            obsinali: {required: "Justifique."
            },
            obsinoe: {required: "Justifique."
            },
            obsincat: {required: "Justifique."
            },
            obsinoio: {required: "Justifique."
            },
            obsinba: {required: "Justifique."
            },
            obsinsr: {required: "Justifique."
            },
            obsinoe: {required: "Justifique."
            },
            obsinoio: {required: "Justifique."
            },
            obsintio3: {required: "Justifique."
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
        },
        submitHandler: function (form) {
            //No se ejecuta nada.
            //Solo se indica si el formulario fue valido o no.									
        }
    });

    $(document).ready(function () {
        $('.sumaring').blur(function () {
            var suma = 0;
            $(".sumaring").each(function () {
                if (/^\d+$/.test($(this).val())) {
                    suma += parseInt($(this).val());
                }
                //suma+=parseInt($(this).val()); 

            });

            $("#inoe").val(suma);
        });
    });

    //Validar el formulario del modulo 4 (Caracteristicas de los hoteles)
    $("#frmModuloIV").validate({
        rules: {
            /*habdia : {		required  :  true,
             menorQue  :  0
             },*/
            ihdo: {required: true,
                menorQue: 'parseInt($("#ihdo").val())'
            },
            ihoa: {required: true,
                expresion: '(parseInt($("#inalo").val()) > 0) && (parseInt($("#ihoa").val())<=0)',
                expresion2: '(parseInt($("#inalo").val()) == 0) && (parseInt($("#ihoa").val())>0)',
                mayorQue: 'parseInt($("#ihdo").val())',
                igualQue: 'parseInt($("#ihoavd").val()) + parseInt($("#ihoatc").val())'
            },
            ihoavd: {required: true
            },
            ihoatc: {required: true
            },
            /*camdia : {		required  : true,
             menorQue  : 0
             },*/
            icda: {required: true,
                expresion: '(parseInt($("#ihdo").val()) > 0) && (parseInt($("#icda").val())<=0)',
                menorQue: 'parseInt($("#ihdo").val())'
            },
            icva: {required: true,
                expresion: '(parseInt($("#inalo").val()) > 0) && (parseInt($("#ihoa").val()) > 0) && (parseInt($("#icva").val())<=0)',
                menorQue: 'parseInt($("#ihoa").val())',
                expresion2: 'parseInt($("#icva").val())>parseInt($("#icda").val())'
            },
            ihpnvd: {required: true
                        //expresion: '(parseInt($("#ihoa").val()) > 0) && (parseInt($("#ihpnr").val()) == 0) && (parseInt($("#inalo").val()) > 0) && (parseInt($("#ihpn").val()) <= 0)'
            },
            ihpntc: {required: true
                        //expresion: '(parseInt($("#ihoa").val()) > 0) && (parseInt($("#ihpnr").val()) == 0) && (parseInt($("#inalo").val()) > 0) && (parseInt($("#ihpn").val()) <= 0)'
            },
            ihpn: {required: true,
                igualQue: 'parseInt($("#ihpnvd").val()) + parseInt($("#ihpntc").val())'
            },
            ihpnrvd: {required: true
                        //expresion: '(parseInt($("#ihoa").val()) > 0) && (parseInt($("#ihpn").val()) == 0) && (parseInt($("#inalo").val()) > 0) && (parseInt($("#ihpnr").val()) <= 0)'
            },
            ihpnrtc: {required: true
                        //expresion: '(parseInt($("#ihoa").val()) > 0) && (parseInt($("#ihpn").val()) == 0) && (parseInt($("#inalo").val()) > 0) && (parseInt($("#ihpnr").val()) <= 0)'
            },
            ihpnr: {required: true,
                igualQue: 'parseInt($("#ihpnrvd").val()) + parseInt($("#ihpnrtc").val())'
            },
            huetot: {required: true,
                igualQue: 'parseInt($("#ihpn").val()) + parseInt($("#ihpnr").val())',
                mayorQue: 'parseInt($("#icva").val())',
                expresion: '(parseInt($("#ihoa").val()) > 0) && (parseInt($("#huetot").val()) == 0) && (parseInt($("#inalo").val()) > 0) && (parseInt($("#huetot").val()) <= 0)'
            },
            mvnr: {required: true
            },
            mvnnr: {required: true
            },
            mvcr: {required: true
            },
            mvcnr: {required: true
            },
            mvor: {required: true
            },
            mvonr: {required: true
            },
            mvsr: {required: true
            },
            mvsnr: {required: true
            },
            mvotr: {required: true
            },
            mvotnr: {required: true
            },
            mvam: {required: true
            },
            mvamnr: {required: true
            },
            mvott: {required: true,
                igualQue: 'parseInt($("#mvnr").val()) + parseInt($("#mvcr").val()) + parseInt($("#mvor").val()) + parseInt($("#mvsr").val()) + parseInt($("#mvam").val()) + parseInt($("#mvotr").val())'
            },
            mvottnr: {required: true,
                igualQue: 'parseInt($("#mvnnr").val()) + parseInt($("#mvcnr").val()) + parseInt($("#mvonr").val()) + parseInt($("#mvsnr").val()) + parseInt($("#mvamnr").val()) + parseInt($("#mvotnr").val())'
            },
            thsen: {required: true,
                expresion2: '(parseInt($("#thsen").val()) +  parseInt($("#thdob").val())) > (parseInt($("#ihoavd").val()) + parseInt($("#ihoatc").val()))'
            },
            thusen: {required: true,
                expresion: '(parseInt($("#thsen").val()) == 0) && (parseInt($("#thusen").val())>0)',
                expresion2: '(parseInt($("#thsen").val()) > 0) && (parseInt($("#thusen").val()) == 0)'
            },
            /*ingsen  : {		required  : true
             },
             inalosen : {	required  : true
             //mayorQue  : 'obtenerValor("#ingsen")' 
             },*/
            thdob: {required: true,
                expresion2: '(parseInt($("#thsen").val()) +  parseInt($("#thdob").val())) > (parseInt($("#ihoavd").val()) + parseInt($("#ihoatc").val()))'
            },
            thudob: {required: true,
                expresion: '(parseInt($("#thdob").val()) == 0) && (parseInt($("#thudob").val())>0)',
                expresion2: '(parseInt($("#thdob").val()) > 0) && (parseInt($("#thudob").val()) == 0)'
            },
            /*ingdob   : {	required  : true
             },
             inalodob : {	required  : true
             //mayorQue  : 'obtenerValor("#ingdob")'
             },*/
            thsui: {required: true
            },
            thusui: {required: true,
                expresion: '(parseInt($("#thsui").val()) == 0) && (parseInt($("#thusui").val())>0)',
                expresion2: '(parseInt($("#thsui").val()) > 0) && (parseInt($("#thusui").val()) == 0)'
            },
            /*ingsui   : {	required  : true
             },
             inalosui : {	required  : true
             //mayorQue  : 'obtenerValor("#ingsui")'
             },*/
            thmult: {required: true
            },
            thumult: {required: true,
                expresion: '(parseInt($("#thmult").val()) == 0) && (parseInt($("#thumult").val())>0)',
                expresion2: '(parseInt($("#thmult").val()) > 0) && (parseInt($("#thumult").val()) == 0)'
            },
            /*ingmult   : {	required  : true
             },
             inalomul : {	required  : true
             //mayorQue  : 'obtenerValor("#ingmult")'
             },*/
            thotr: {required: true
            },
            thuotr: {required: true,
                expresion: '(parseInt($("#thotr").val()) == 0) && (parseInt($("#thuotr").val())>0)',
                expresion2: '(parseInt($("#thotr").val()) > 0) && (parseInt($("#thuotr").val()) == 0)'
            },
            /*ingotr   : {	required  : true
             },
             inalootr : {	required  : true
             //mayorQue  : 'obtenerValor("#ingotr")'
             },*/
            thtot: {required: true,
                igualQue: 'parseInt($("#thsen").val()) + parseInt($("#thdob").val()) + parseInt($("#thsui").val()) + parseInt($("#thmult").val()) + parseInt($("#thotr").val())',
                //expresion : '(obtenerValor("#thsen") + obtenerValor("#thdob") + obtenerValor("#thsui") + obtenerValor("#thmult") + obtenerValor("#thotr")) != obtenerValor("#ihoa")'
                expresion2: 'parseInt($("#thtot").val()) != (parseInt($("#ihoavd").val()) + parseInt($("#ihoatc").val()))'
            },
            /*ingtot   : {	required  : true,
             igualQue  : 'parseInt($("#ingsen").val()) + parseInt($("#ingdob").val()) + parseInt($("#ingsui").val()) + parseInt($("#ingmult").val()) + parseInt($("#ingotr").val())'
             //expresion : 'obtenerValor("#inalo") != (obtenerValor("#inalotot") + obtenerValor("#ingtot"))'
             },
             inalotot : {	required  : true,
             igualQue  : 'parseInt($("#inalosen").val()) + parseInt($("#inalodob").val()) + parseInt($("#inalosui").val()) + parseInt($("#inalomul").val()) + parseInt($("#inalootr").val())',
             expresion : 'obtenerValor("#inalo") != (obtenerValor("#inalotot") + obtenerValor("#ingtot"))'
             },*/
            obsihoa: {required: true
            },
            obsicva: {required: true
            },
            obshuetot: {required: true
            },
            obsthudob: {required: true
            },
            obsthusui: {required: true
            },
            obsthumult: {required: true
            },
            obsmvam: {required: true
            },
            obsmvamnr: {required: true
            },
            obshuetot1: {required: true
            },
        },
        messages: {
            /*habdia : {		required  :  "<br/>Falta n&uacute;mero de habitaciones disponibles.",
             menorQue  :  "<br/>Diga si se abrieron nuevas habitaciones o si hubo habitaciones cerradas durante el mes."
             },*/
            ihdo: {required: "Falta n&uacute;mero de habitaciones ofrecidas.",
                menorQue: "Las habitaciones ofrecidas son mayores a las habitaciones disponibles."
            },
            ihoa: {required: "Falta n&uacute;mero de habitaciones vendidas.",
                expresion: "Existen  ingresos por alojamiento en el capitulo III sin habitaciones vendidas en el capitulo IV.",
                expresion2: "Los ingresos por alojamiento en el capitulo III es igual a 0, por lo tanto no puede haber habitaciones ocupadas.",
                mayorQue: "Habitaciones ocupadas o  vendidas mes  es mayor de  las ofrecidas total mes, Corrija.",
                igualQue: "La suma no corresponde"
            },
            ihoavd: {required: "Falta n&uacute;mero de habitaciones vendidas por venta directa.",
            },
            ihoatc: {required: "Falta n&uacute;mero de habitaciones vendidas por tiempo comtartido.",
            },
            /*camdia : {		required  : "<br/>Falta n&uacute;mero de camas disponibles.",
             menorQue  : "<br/>Diga se se abrieron nuevas habitaciones o si hubo habitaciones cerradas durante el mes que afectaran o beneficiaran la disponibilidad de camas"
             },*/
            icda: {required: "Falta n&uacute;mero de camas ofrecidas.",
                expresion: "Falta el n&uacute;mero de camas disponibles.",
                menorQue: "N&uacute;mero de camas ofrecidas mes menor que el n&uacute;mero de habitaciones ofrecidas mes, corrija. "
            },
            icva: {required: "Falta n&uacute;mero de camas vendidas en el mes.",
                expresion: "Falta el n&uacute;mero de camas vendidas en el mes.",
                menorQue: "N&uacute;mero de camas ocupadas o vendidas mes menor que el n&uacute;mero de habitaciones ocupadas o vendidas mes, corrija.",
                expresion2: "N&uacute;mero de camas ocupadas o vendidas mes es mayor que el n&uacute;mero de camas ofrecidas mes, corrija."
            },
            ihpnvd: {required: "Falta n&uacute;mero de residentes por venta directa. ."
                        //expresion: "Falta n&uacute;mero de hu&eacute;spedes residentes en Colombia."
            },
            ihpntc: {required: " Falta numero de residentes por tiempo compartido."
                        //expresion: "Falta n&uacute;mero de hu&eacute;spedes residentes en Colombia."
            },
            ihpn: {required: "Falta n&uacute;mero de hu&eacute;spedes residentes en Colombia.",
                igualQue: "La suma no corresponde.",
            },
            ihpnrvd: {required: "Falta n&uacute;mero de  no residentes por venta directa."
                        //expresion: "Falta n&uacute;mero de hu&eacute;spedes no residentes en Colombia."
            },
            ihpnrtc: {required: "Falta n&uacute;mero de  no  residentes por tiempo compartido."
                        //expresion: "Falta n&uacute;mero de hu&eacute;spedes no residentes en Colombia."
            },
            ihpnr: {required: "Falta n&uacute;mero de hu&eacute;spedes no residentes en Colombia.",
                igualQue: "La suma no corresponde.",
            },
            huetot: {required: "Falta total de hu&eacute;spedes.",
                igualQue: "Verificar la llegada de personas o el n&uacute;mero total de hu&eacute;spedes en el hotel.",
                mayorQue: "Verifique o corrija el n&uacute;mero de hu&eacute;spedes, es mayor que el n&uacute;mero de camas vendidas.",
                expresion: "Verificar la llegada de personas o el n&uacute;mero total de hu&eacute;spedes en el hotel, hay ingresos por alojamento y habitaciones  ocupadas. "
            },
            mvnr: {required: "Falta porcentaje negocios residentes."
            },
            mvnnr: {required: "Falta porcentaje negocios no residentes."
            },
            mvcr: {required: "Falta porcentaje convenciones residentes."
            },
            mvcnr: {required: "Falta porcentaje convenciones no residentes."
            },
            mvor: {required: "Falta porcentaje ocio y recreaci&oacute;n residentes."
            },
            mvonr: {required: "Falta porcentaje ocio y recreaci&oacute;n no residentes."
            },
            mvsr: {required: "Falta porcentaje salud y belleza residentes."
            },
            mvsnr: {required: "Falta porcentaje salud y belleza no residentes."
            },
            mvotr: {required: "Falta porcentaje amercos residentes."
            },
            mvotnr: {required: "Falta porcentaje amercos no residentes."
            },
            mvam: {required: "Falta porcentaje otros residentes."
            },
            mvamnr: {required: "Falta porcentaje otros no residentes."
            },
            mvott: {required: "Falta porcentaje total residentes.",
                //menorQue   : "El total del porcentaje de resitentes no puede ser menor que 100.",
                igualQue: "El porcentaje total de residentes no coincide."
            },
            mvottnr: {required: "Falta porcentaje total no residentes.",

                igualQue: "El porcentaje total de no residentes no coincide."
            },
            thsen: {required: "Falta n&uacute;mero de habitaciones sencillas vendidas.",
                expresion2: "La suma del n&uacute;mero de habitaciones  sencilla y doble vendidas mes es mayor que  total habitaciones ocupadas, corrija."
            },
            thusen: {required: "Falta tarifa promedio por tipo de acomodaci&oacute;n habitaci&oacute;n sencilla.",
                expresion: "El n&uacute;mero de habitaciones sencillas vendidas es 0, por lo tanto  la tarifa promedio tiene que ser 0.",
                expresion2: "La tarifa promedio no puede ser 0, porque hay habitaciones sencillas vendidas."
            },
            /*ingsen  : {		required  : "<br/>Falta ingresos por habitaciones sencillas."
             },
             inalosen : {	required  : "<br/>Falta ingresos totales por alojamiento habitaciones sencillas."
             //mayorQue  : "<br/>Si por este tipo de habitaci&oacute;n s&oacute;lo se diligencia los ingresos de alojamiento, el rubro deber&iacute;a ser menor o igual al ingreso total."
             },*/
            thdob: {required: "Falta n&uacute;mero de habitaciones dobles vendidas.",
                expresion2: " La suma del n&uacute;mero de habitaciones  sencilla y doble vendidas mes es mayor que  total habitaciones ocupadas, corrija."
            },
            thudob: {required: "Falta tarifa promedio por tipo de acomodaci&oacute;n habitaci&oacute;n doble.",
                expresion: "El n&uacute;mero de habitaciones dobles vendidas es 0, por lo tanto  la tarifa promedio tiene que ser 0.",
                expresion2: "La tarifa promedio no puede ser 0, porque hay habitaciones dobles vendidas."
            },
            /*ingdob   : {	required  : "<br/>Falta ingresos por habitaciones dobles."
             },
             inalodob : {	required  : "<br/>Falta ingresos totales por alojamiento habitaciones dobles."
             //mayorQue  : "<br/>Si por este tipo de habitaci&oacute;n s&oacute;lo se diligencia los ingresos de alojamiento, el rubro deber&iacute;a ser menor o igual al ingreso total."
             },*/
            thsui: {required: "Falta n&uacute;mero de habitaciones suite vendidas."
            },
            thusui: {required: "Falta tarifa promedio por tipo de acomodaci&oacute;n habitaci&oacute;n suite.",
                expresion: "El n&uacute;mero de habitaciones suite vendidas es 0, por lo tanto  la tarifa promedio tiene que ser 0.",
                expresion2: "La tarifa promedio no puede ser 0, porque hay habitaciones suite vendidas."
            },
            /*ingsui   : {	required  : "<br/>Falta ingresos por habitaciones suite."
             },
             inalosui : {    required  : "<br/>Falta ingresos totales por alojamiento habitaciones suites."
             //mayorQue  : "<br/>Si por este tipo de habitaci&oacute;n s&oacute;lo se diligencia los ingresos de alojamiento, el rubro deber&iacute;a ser menor o igual al ingreso total."
             },*/
            thmult: {required: "Falta n&uacute;mero de habitaciones m&uacute;ltiples vendidas."
            },
            thumult: {required: "Falta tarifa promedio por tipo de acomodaci&oacute;n habitaci&oacute;n m&uacute;ltiple.",
                expresion: "El n&uacute;mero de habitaciones m&uacute;ltiples vendidas es 0, por lo tanto  la tarifa promedio tiene que ser 0.",
                expresion2: "La tarifa promedio no puede ser 0, porque hay habitaciones m&uacute;ltiples vendidas."
            },
            /*ingmult   : {	required  : "<br/>Falta ingresos por habitaciones m&uacute;ltiples."
             },
             inalomul : {	required  : "<br/>Falta ingresos totales por alojamiento habitaciones m&uacute;ltiples."
             //mayorQue  : "<br/>Si por este tipo de habitaci&oacute;n s&oacute;lo se diligencia los ingresos de alojamiento, el rubro deber&iacute;a ser menor o igual al ingreso total."
             },*/
            thotr: {required: "Falta n&uacute;mero de otro tipo de habitaciones vendidas."
            },
            thuotr: {required: "Falta tarifa promedio por tipo de acomodaci&oacute;n otro tipo de habitaci&oacute;n.",
                expresion: "El n&uacute;mero de otro tipo de habitaciones vendidas es 0, por lo tanto  la tarifa promedio tiene que ser 0.",
                expresion2: "La tarifa promedio no puede ser 0, porque hay otro tipo de habitaciones vendidas."
            },
            /*ingotr   : {	required  : "<br/>Falta ingresos por otro tipo de habitaciones."
             },
             inalootr : {	required  : "<br/>Falta ingresos totales por alojamiento otro tipo de habitaciones."
             //mayorQue  : "<br/>Si por este tipo de habitaci&oacute;n s&oacute;lo se diligencia los ingresos de alojamiento, el rubro deber&iacute;a ser menor o igual al ingreso total."
             },*/
            thtot: {required: "Falta total de habitaciones vendidas.",
                igualQue: "<br/>El total de habitaciones vendidas no coincide.",
                //expresion : "<br/>El total de habitaciones vendidas no coincide.",
                expresion2: "<br/>El total de habitaciones vendidas no coincide con el numero de habitaciones ocupadas y/o vendidas."
            },
            ingtot: {required: "Falta total de ingresos.",
                igualQue: "<br/>El total de ingresos por alojamiento y otros servicios no coincide."
                        //expresion : "<br/>Debe coincidir con el total de ingresos por alojamiento del Cap&iacute;tulo 3."
            },
            inalotot: {required: "Falta total de ingresos por alojamiento.",
                igualQue: "<br/>El total de ingresos por alojamiento no coincide.",
                expresion: "<br/>La sumatoria de los totales facturados debe coincidir con el numeral '1. Alojamiento' del m&oacute;dulo 3"
            },
            obsihoa: {required: "Por favor complete la observaci&oacute;n."
            },
            obsicva: {required: "Por favor complete la observaci&oacute;n."
            },
            obshuetot: {required: "Por favor complete la observaci&oacute;n."
            },
            obsthudob: {required: "Por favor complete la observaci&oacute;n."
            },
            obsthusui: {required: "Por favor complete la observaci&oacute;n."
            },
            obsthumult: {required: "Por favor complete la observaci&oacute;n."
            },
            obsmvam: {required: "Por favor complete la observaci&oacute;n."
            },
            obsmvamnr: {required: "Por favor complete la observacio&oacute;n."
            },
            obshuetot1: {required: "Por favor complete la observaci&oacute;n."
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
        },
        submitHandler: function (form) {
            //No se ejecuta nada.
            //Solo se indica si el formulario fue valido o no.			
        }
    });

    $(document).ready(function () {
        $('.sumarinfra').blur(function () {
            var suma = 0;
            $(".sumarinfra").each(function () {
                if (/^\d+$/.test($(this).val())) {
                    suma += parseInt($(this).val());
                }
                //suma+=parseInt($(this).val()); 

            });

            $("#ihoa").val(suma);
        });
    });



    //VALIDACIONES PARA EL ENVIO DEL FORMULARIO
    $("#frmModuloEnvio").validate({
        rules: {
            fteObserv: {maxlength: 500
            },
            dmpio: {required: true
            },
            fedili: {required: true
            },
            repleg: {required: true
            },
            responde: {required: true
            },
            respoca: {required: true
            },
            teler: {required: true
            },
            emailr: {required: true,
                email: true
            }
        },
        messages: {
            fteObserv: {
                maxlength: "500 caracteres es el m&aacute;ximo permitido."
            },
            dmpio: {required: "<br/>Falta ciudad diligenciamiento."
            },
            fedili: {required: "<br/>Falta fecha de diligenciamiento."
            },
            repleg: {required: "<br/>Falta nombre representante legal."
            },
            responde: {required: "<br/>Falta nombre de quien responde la encuesta."
            },
            respoca: {required: "<br/>Falta cargo de quien responde la encuesta."
            },
            teler: {required: "<br/>Falta n&uacute;mero telef&oacute;nico de contacto."
            },
            emailr: {required: "<br/>Falta email de contacto.",
                email: "<br/>No es un correo v&aacute;lido"
            }
        },
        errorPlacement: function (error, element) {
            element.after(error);
            error.css('display', 'inline');
            error.css('margin-left', '10px');
            error.css('color', "#FF0000");
        },
        submitHandler: function (form) {
            //No se ejecuta nada.
            //Solo se indica si el formulario fue valido o no.			
        }
    });

    //Ajustar los datos del formulario de actualizar las fuentes
    //Datos de la empresa.
    $("#idnit").numerico().largo(15);
    $("#idproraz").mayusculas().largo(255);
    $("#idnomcom").mayusculas().largo(80);
    $("#idsigla").mayusculas().largo(20);
    $("#iddirecc").mayusculas().largo(80);
    $("#idtelno").numerico().largo(15);
    $("#idfaxno").numerico().largo(11);
    $("#idaano").numerico().largo(11);
    $("#idpagweb").minusculas().largo(255);
    $("#idcorreo").minusculas().largo(255);
    $("#cmbDeptoEmp").cargarCombo("cmbMpioEmp", "administrador/actualizarmunicipios");

    //Datos del establecimiento
    $("#idnomcomest").mayusculas().largo(80);
    $("#idsiglaest").mayusculas().largo(20);
    $("#iddireccest").mayusculas().largo(80);
    $("#idtelnoest").numerico().largo(15);
    $("#idfaxnoest").numerico().largo(11);
    $("#idcorreoest").minusculas().largo(255);
    $("#cmbDeptoEst").cargarCombo("cmbMpioEst", "administrador/actualizarmunicipios");
    $("#cmbSedeEst").cargarCombo("cmbSubSedeEst", "administrador/actualizarSubsedes");



    //Validador para actualizar los datos de la fuente
    $("#btnActualizarFuente").click(function () {
        $("#frmEditarFuente").validate({
            rules: {
                idnit: {required: true},
                idproraz: {required: true},
                idnomcom: {required: true},
                iddirecc: {required: true},
                idtelno: {required: true},
                idcorreo: {required: true,
                    email: true
                },
                cmbDeptoEmp: {comboBox: '-'},
                cmbMpioEmp: {comboBox: '-'},
                idnomcomest: {required: true},
                iddireccest: {required: true},
                idtelnoest: {required: true},
                idcorreoest: {required: true,
                    email: true
                },
                cmbActEst: {comboBox: '-'},
                cmbDeptoEst: {comboBox: '-'},
                cmbMpioEst: {comboBox: '-'},
                cmbSedeEst: {comboBox: '-'},
                cmbSubSedeEst: {comboBox: '-'}
            },
            messages: {
                idnit: {required: "Debe ingresar el nit de la empresa."},
                idproraz: {required: "Debe ingresar la raz&oacute;n social de la empresa."},
                idnomcom: {required: "Debe ingresar el nombre comercial de la empresa."},
                iddirecc: {required: "Debe ingresar la direcci&oacute;n de la empresa."},
                idtelno: {required: "Debe ingresar el n&uacute;mero telef&oacute;nico de la empresa."},
                idcorreo: {required: "Debe ingresar el correo electr&oacute;nico de la empresa.",
                    email: "No es un correo v&aacute;lido."},
                cmbDeptoEmp: {required: "Debe seleccionar el departamento de la empresa."},
                cmbMpioEmp: {required: "Debe seleccionar el municipio de la empresa."},
                idnomcomest: {required: "Debe ingresar el nombre comercial del establecimiento."},
                iddireccest: {required: "Debe ingresar la direcci&oacute;n del establecimiento."},
                idtelnoest: {required: "Debe ingresar el n&uacute;mero telef&oacute;nico del establecimiento."},
                idcorreoest: {required: "Debe ingresar el correo electr&oacute;nico del establecimiento.",
                    email: "No es un correo v&aacute;lido."
                },
                cmbActEst: {required: "Debe seleccionar la actividad econ&oacute;mica del establecimiento."},
                cmbDeptoEst: {required: "Debe seleccionar el departamento del establecimiento."},
                cmbMpioEst: {required: "Debe seleccionar el municipio del establecimiento."},
                cmbSedeEst: {required: "Debe seleccionar la sede del establecimiento."},
                cmbSubSedeEst: {required: "Debe seleccionar la subsede del establecimiento."}
            },
            errorPlacement: function (error, element) {
                element.after(error);
                error.css('display', 'inline');
                error.css('margin-left', '10px');
                error.css('color', "#FF0000");
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });


    //Actualizaciones JavaScript para el modulo V (Ciiu 4)
    //Funciones para bloquear categorias del modulo 5
    //Solo se puede se�alar una de las seis categorias
    //Pregunta si hay alguna categoria checkeada para bloquear los demas
    $("#chkCategoria1").click(function () {
        if ($("#chkCategoria1").attr("checked")) {
            $("#chkCategoria2").attr("disabled", true);
            $("#chkCategoria2").prop("checked", false);
            $("#chkCategoria3").attr("disabled", true);
            $("#chkCategoria3").prop("checked", false);
            $("#chkCategoria4").attr("disabled", true);
            $("#chkCategoria4").prop("checked", false);
            $("#chkCategoria5").attr("disabled", true);
            $("#chkCategoria5").prop("checked", false);
            $("#chkCategoria6").attr("disabled", true);
            $("#chkCategoria6").prop("checked", false);
            $('[name^=chkServicios2]').attr("disabled", true);
            $('[name^=chkServicios3]').attr("disabled", true);
            $('[name^=chkServicios4]').attr("disabled", true);
            $('[name^=chkServicios5]').attr("disabled", true);
            $('[name^=chkServicios6]').attr("disabled", true);
        } else {
            $('[name^=chkCategoria]').attr("disabled", false);
            $('[name^=chkServicios]').attr("disabled", false);
            $('[name^=chkServicios]').attr("checked", false);
        }
    });


    $("#chkCategoria2").click(function () {
        if ($("#chkCategoria2").attr("checked")) {
            $("#chkCategoria1").attr("disabled", true);
            $("#chkCategoria1").prop("checked", false);
            $("#chkCategoria3").attr("disabled", true);
            $("#chkCategoria3").prop("checked", false);
            $("#chkCategoria4").attr("disabled", true);
            $("#chkCategoria4").prop("checked", false);
            $("#chkCategoria5").attr("disabled", true);
            $("#chkCategoria5").prop("checked", false);
            $("#chkCategoria6").attr("disabled", true);
            $("#chkCategoria6").prop("checked", false);
            $('[name^=chkServicios1]').attr("disabled", true);
            $('[name^=chkServicios3]').attr("disabled", true);
            $('[name^=chkServicios4]').attr("disabled", true);
            $('[name^=chkServicios5]').attr("disabled", true);
            $('[name^=chkServicios6]').attr("disabled", true);
        } else {
            $('[name^=chkCategoria]').attr("disabled", false);
            $('[name^=chkServicios]').attr("disabled", false);
            $('[name^=chkServicios]').attr("checked", false);
        }
    });

    $("#chkCategoria3").click(function () {
        if ($("#chkCategoria3").attr("checked")) {
            $("#chkCategoria1").attr("disabled", true);
            $("#chkCategoria1").prop("checked", false);
            $("#chkCategoria2").attr("disabled", true);
            $("#chkCategoria2").prop("checked", false);
            $("#chkCategoria4").attr("disabled", true);
            $("#chkCategoria4").prop("checked", false);
            $("#chkCategoria5").attr("disabled", true);
            $("#chkCategoria5").prop("checked", false);
            $("#chkCategoria6").attr("disabled", true);
            $("#chkCategoria6").prop("checked", false);
            $('[name^=chkServicios1]').attr("disabled", true);
            $('[name^=chkServicios2]').attr("disabled", true);
            $('[name^=chkServicios4]').attr("disabled", true);
            $('[name^=chkServicios5]').attr("disabled", true);
            $('[name^=chkServicios6]').attr("disabled", true);
        } else {
            $('[name^=chkCategoria]').attr("disabled", false);
            $('[name^=chkServicios]').attr("disabled", false);
            $('[name^=chkServicios]').attr("checked", false);
        }
    });

    $("#chkCategoria4").click(function () {
        if ($("#chkCategoria4").attr("checked")) {
            $("#chkCategoria1").attr("disabled", true);
            $("#chkCategoria1").prop("checked", false);
            $("#chkCategoria2").attr("disabled", true);
            $("#chkCategoria2").prop("checked", false);
            $("#chkCategoria3").attr("disabled", true);
            $("#chkCategoria3").prop("checked", false);
            $("#chkCategoria5").attr("disabled", true);
            $("#chkCategoria5").prop("checked", false);
            $("#chkCategoria6").attr("disabled", true);
            $("#chkCategoria6").prop("checked", false);
            $('[name^=chkServicios1]').attr("disabled", true);
            $('[name^=chkServicios2]').attr("disabled", true);
            $('[name^=chkServicios3]').attr("disabled", true);
            $('[name^=chkServicios5]').attr("disabled", true);
            $('[name^=chkServicios6]').attr("disabled", true);
        } else {
            $('[name^=chkCategoria]').attr("disabled", false);
            $('[name^=chkServicios]').attr("disabled", false);
            $('[name^=chkServicios]').attr("checked", false);
        }
    });

    $("#chkCategoria5").click(function () {
        if ($("#chkCategoria5").attr("checked")) {
            $("#chkCategoria1").attr("disabled", true);
            $("#chkCategoria1").prop("checked", false);
            $("#chkCategoria2").attr("disabled", true);
            $("#chkCategoria2").prop("checked", false);
            $("#chkCategoria3").attr("disabled", true);
            $("#chkCategoria3").prop("checked", false);
            $("#chkCategoria4").attr("disabled", true);
            $("#chkCategoria4").prop("checked", false);
            $("#chkCategoria6").attr("disabled", true);
            $("#chkCategoria6").prop("checked", false);
            $('[name^=chkServicios1]').attr("disabled", true);
            $('[name^=chkServicios2]').attr("disabled", true);
            $('[name^=chkServicios3]').attr("disabled", true);
            $('[name^=chkServicios4]').attr("disabled", true);
            $('[name^=chkServicios6]').attr("disabled", true);
        } else {
            $('[name^=chkCategoria]').attr("disabled", false);
            $('[name^=chkServicios]').attr("disabled", false);
            $('[name^=chkServicios]').attr("checked", false);
        }
    });

    $("#chkCategoria6").click(function () {
        if ($("#chkCategoria6").attr("checked")) {
            $("#chkCategoria1").attr("disabled", true);
            $("#chkCategoria1").prop("checked", false);
            $("#chkCategoria2").attr("disabled", true);
            $("#chkCategoria2").prop("checked", false);
            $("#chkCategoria3").attr("disabled", true);
            $("#chkCategoria3").prop("checked", false);
            $("#chkCategoria4").attr("disabled", true);
            $("#chkCategoria4").prop("checked", false);
            $("#chkCategoria5").attr("disabled", true);
            $("#chkCategoria5").prop("checked", false);
            $('[name^=chkServicios1]').attr("disabled", true);
            $('[name^=chkServicios2]').attr("disabled", true);
            $('[name^=chkServicios3]').attr("disabled", true);
            $('[name^=chkServicios4]').attr("disabled", true);
            $('[name^=chkServicios5]').attr("disabled", true);
        } else {
            $('[name^=chkCategoria]').attr("disabled", false);
            $('[name^=chkServicios]').attr("disabled", false);
            $('[name^=chkServicios]').attr("checked", false);
        }
    });


    if ($("#chkServicios112").prop("checked")) {
        $("#divihoa").show();
    }


    //Validar fomulario
    $("#btnGenerarUsuariosEmp").click(function () {
        $.ajax({
            type: "POST",
            url: base_url + "administrador/generaUsuarios",
            data: $("#frmGenerarUsuariosEmp").serialize(),
            dataType: "html",
            cache: false,
            success: function (data) {
                alert('El registro se guard� exitosamente.');
                location.reload();
                location.href = base_url + "administrador/generarUsuarios";
            }
        });
    });

    $("#btnGenerarUsuariosEst").click(function () {
        $.ajax({
            type: "POST",
            url: base_url + "administrador/generaUsuarios",
            data: $("#frmGenerarUsuariosEst").serialize(),
            dataType: "html",
            cache: false,
            success: function (data) {
                alert('El registro se guard� exitosamente.');
                location.reload();
                location.href = base_url + "administrador/generarUsuarios";
            }
        });
    });

    //Validar fomulario
    $("#btnGenerarUsuariosEstMini").click(function () {
        $.ajax({
            type: "POST",
            url: base_url + "administrador/generaUsuarios",
            data: $("#frmGenerarUsuariosEstMini").serialize(),
            dataType: "html",
            cache: false,
            success: function (data) {
                alert('El registro se guard� exitosamente.');
                location.reload();
                location.href = base_url + "administrador/generarUsuarios";
            }
        });
    });

    $('.select').change(function () {
        
        $(this).css({'border': ''});
        if ($(this).val() == '-') {
            $(this).css({'border': '1px solid red'});
        }
        
    });
    $("#btnAprobarEstab").click(function () {
        var error = 0;
       
        
           
            $('.select').each(function () {
                 
                $(this).css({'border': ''});

                    if ($(this).val() == '-') {
                        $(this).css({'border': '1px solid red'});
                        error++;
                    }
                    
            });
            
    
       

        if (error > 0) {
            $('#aviso').html('Debe rellenar los campos resaltados <br />');
            event.preventDefault();
        } else {
            $.ajax({
                type: "POST",
                url: base_url + "administrador/generaUsuarios",
                data: $("#frmAprobarEstab").serialize(),
                dataType: "html",
                cache: false,
                success: function (data) {
                    alert('El registro se guard� exitosamente.');
                    location.reload();
                    location.href = base_url + "administrador/generarUsuarios";
                }
            });
        }
    });
    
    $("#btnAprobarCierreEstab").click(function () {
        var error = 0;
       
        $('.select').each(function () {
            $(this).css({'border': ''});
            if ($(this).val() == '-') {
                $(this).css({'border': '1px solid red'});
                error++;
            }
        });
        
        if (error == 0) {
            $('#aviso').html('Debe rellenar los campos resaltados <br />');
            event.preventDefault();
        } else {
            $.ajax({
                type: "POST",
                url: base_url + "administrador/generaUsuarios",
                data: $("#frmAprobarCierreEstab").serialize(),
                dataType: "html",
                cache: false,
                success: function (data) {
                    alert('El registro se guard� exitosamente.');
                    location.reload();
                    location.href = base_url + "administrador/generarUsuarios";
                }
            });
        }
    });

});


//Muestra el cuadro texto, dependiendo de la respuesta del cuadro lista
$(document).ready(function () {
    $("#chkServicios112").change(function () {
        $("#chkServicios112").each(function () {
            if ($("#chkServicios112").attr("checked")) {
                $("#formularioInsindc").show();
            } else {
                $("#formularioInsindc").hide();
            }
        });
    })
    $("#chkServicios215").change(function () {
        $("#chkServicios215").each(function () {
            if ($("#chkServicios215").attr("checked")) {
                $("#formularioInsindc").show();
            } else {
                $("#formularioInsindc").hide();
            }
        });
    })
    $("#chkServicios313").change(function () {
        $("#chkServicios313").each(function () {
            if ($("#chkServicios313").attr("checked")) {
                $("#formularioInsindc").show();
            } else {
                $("#formularioInsindc").hide();
            }
        });
    })
    $("#chkServicios412").change(function () {
        $("#chkServicios412").each(function () {
            if ($("#chkServicios412").attr("checked")) {
                $("#formularioInsindc").show();
            } else {
                $("#formularioInsindc").hide();
            }
        });
    })
    $("#chkServicios510").change(function () {
        $("#chkServicios510").each(function () {
            if ($("#chkServicios510").attr("checked")) {
                $("#formularioInsindc").show();
            } else {
                $("#formularioInsindc").hide();
            }
        });
    })
    $("#chkServicios65").change(function () {
        $("#chkServicios65").each(function () {
            if ($("#chkServicios65").attr("checked")) {
                $("#formularioInsindc").show();
            } else {
                $("#formularioInsindc").hide();
            }
        });
    })

});//




function modificarUsuarioADM(index) {
    $.ajax({url: base_url + "administrador/UPDUsuario",
        type: "post",
        dataType: "html",
        data: "index=" + index,
        success: function (data) {
            $("#detalle").html(data);
        }
    });
}


function validacionAlMenosUnSi(preguntas, clase, grupo, cantCampos) {
    var todoNo = cantCampos * 2;
    //adicionarClase( preguntas, clase);
    $("." + clase).on("change", function () {
        var resultado = 0;
        $("." + clase + ":checked").each(function () {
            resultado += parseInt($(this).val());
        });
        if (resultado == todoNo) {
            //var elem = $( "label" ).insertAfter("#lbl_msj_19");
            //elem.attr("id","lbl_msj_error_19");
            //$("#lbl_msj_19").css("color","RED");
            $("#error_grp_" + grupo).remove();
            $("<div id='error_grp_" + grupo + "'>al menos una de las opciones debe ser si</div>").addClass('error text-danger').insertAfter("#lbl_grp_" + grupo);
        } else {
            $("#error_grp_" + grupo).remove();
        }
    });
}

function eliminarUsuarioADM(rol, index) {

    //Lanzo Ajax para preguntar si el usuario tiene fuentes asignadas.
    $.ajax({
        type: "POST",
        url: base_url + "administrador/consultaFuentesAsignadas",
        data: {'rol': rol,
            'usuario': index
        },
        dataType: "html",
        cache: false,
        success: function (data) {
            var obj = eval('(' + data + ')');
            if (obj == 0) {
                if (confirm("Realmente desea eliminar este usuario ?")) {
                    document.frmUsuarios.action = base_url + "administrador/eliminarUsuario/" + index;
                    document.frmUsuarios.submit();
                }
            } else {
                alert("Este usuario no puede ser eliminado. Aun tiene fuentes asignadas.");
            }
        }
    });
}


function agregarFuente() {
    $("#agregarFuente").dialog({
        width: 680,
        title: 'Agregar Fuentes',
        modal: true
    });
}
;



//Funcion JavaScript que trabaja en conjunto con el paginador de resultados
function paginar(div, pagina, funcion) {
    var divAjax = "#" + div;
    $.ajax({
        type: "POST",
        url: base_url + funcion,
        data: {'pagina': pagina},
        cache: false,
        success: function (data) {
            $(divAjax).html(data);
        }
    });
}

//Funcion JavaScript que trabaja en conjunto con el paginador de resultados
function paginar2(div, pagina, funcion) {
    var divAjax = "#" + div;
    var critico = $("#hddCritico").val();
    $.ajax({
        type: "POST",
        url: base_url + funcion,
        data: {'pagina': pagina, 'critico': critico},
        cache: false,
        success: function (data) {
            $(divAjax).html(data);
        }
    });
}

//Funcion para obtener los mensajes de las cajas de texto de las justificaciones
function obtenerMensaje2(campo) {
    var mensaje = "";
    switch (campo) {
        case 'gppgpa':
            mensaje = "Justificar el bajo sueldo y salarios del personal aprend&iacute;z";
            break;
        default:
            mensaje = "Justificar el bajo sueldo y salarios del personal aprend&iacute;z";
            break;
    }
    return mensaje;
}

//Funcion para obtener los mensajes de las cajas de texto de las justificaciones
function obtenerMensaje3(campo) {
    var mensaje = "";
    switch (campo) {
        case 'intio1':
            mensaje = "Justificar el bajo porcentaje de ingresos por alojamiento en el total de ingresos.";
            break;
        case 'intio2':
            mensaje = "Justificar el alto porcentaje de participaci&oacute;n de otros ingresos en el total de ingresos.";
            break;
        case 'inalo':
            mensaje = "Especifique el valor de ingresos por alojamiento.";
            break;
        case 'inali':
            mensaje = "Justificar por qu&eacute; los ingresos por servicio de restaurante y catering para eventos son mayores que los de servicios de alojamiento."
            break;
        case 'inalo3':
            mensaje = "Justifique por qu&eacute; los ingresos por alojamiento est&aacute;n en cero.";
            break;
        case 'inoio':
            mensaje = "Desagregue y justifique valor de otros ingresos operacionales.";
            break;
        case 'inoe':
            mensaje = "Especifique el ingreso por alquiler de salones indicando los principales eventos realizados.";
            break;
        case 'incat':
            mensaje = "Especifique el ingreso por servicios de catering para eventos.";
            break;
        case 'inba':
            mensaje = "Justificar por qu&eacute; los ingresos por bebidas alcoh&oacute;licas son mayores que los de servicio de alojamiento.";
            break;
        case 'insr':
            mensaje = "Justificar por qu&eacute; los ingresos por servicios receptivos y conexos son mayores que los ingresos por alojamiento.";
            break;
        case 'inoe':
            mensaje = "Justificar por qu&eacute; los ingresos por organizaci&oacute;n de convenciones (MICE)  son mayores que los ingresos por alojamiento, y especifique los principales eventos realizados.";
            break;
        case 'inoio':
            mensaje = "Justifique cual o cuales  ingresos son los  que inciden al aumento del valor de otros ingresos.";
            break;
        case 'intio3':
            mensaje = "Justifique el por qu&eacute; sus ingresos diferentes a alojamiento son proporcionalmente mayores en el total de ingresos.";
            break;
        case 'intio1':
            mensaje = "Justificar el bajo porcentaje de ingresos por alojamiento en el total de ingresos.";
            break;
    }
    return mensaje;
}

//Funcion para obtener los mensajes de las cajas de texto de las justificaciones
function obtenerMensaje4(campo) {
    var mensaje = "";
    switch (campo) {
        case 'ihoa':
            mensaje = "Justifique por qu&eacute; durante el mes, el n&uacute;mero de habitaciones vendidas fue mayor que el de habitaciones disponibles.";
            break;
        case 'icva':
            mensaje = "En el mes el n&uacute;mero de camas vendidas fue mayor que el n&uacute;mero de camas disponibles &iquest;Se vendieron camas supletorias?";
            break;
        case 'huetot':
            mensaje = "Justifique por qu&eacute; durante el mes, el n&uacute;mero total de hu&eacute;spedes es igual al n&uacute;mero de camas vendidas.";
            break;
        case 'thudob':
            mensaje = "Verificar por qu&eacute; la tarifa por persona en habitaci&oacute;n sencilla es mayor que la doble.";
            break;
        case 'thusui':
            mensaje = "Verificar por qu&eacute; la tarifa por persona en habitaci&oacute;n sencilla es mayor que la tipo suite.";
            break;
        case 'thumult':
            mensaje = "Verificar por qu&eacute; la tarifa por persona en habitaci&oacute;n sencilla es mayor que la m&uacute;ltiple.";
            break;
        case 'inoe':
            mensaje = "Especifique el ingreso por alquiler de salones indicando los principales eventos realizados.";
            break;
        case 'incat':
            mensaje = "Especifique el ingreso por servicios de catering para eventos.";
            break;
        case 'mvam':
            mensaje = "Especifique otros motivos viaje no solicitados antes, residentes.";
            break;
        case 'mvamnr':
            mensaje = "Especifique otros motivos viaje no solicitados antes, no residentes.";
            break;
            /*case 'inalomul':  mensaje = "Si por el tipo de habitaci&oacute;n m&uacute;ltiple s&oacute;lo se diligencia los ingresos de alojamiento el rubro deber&iacute;a ser menor o igual al ingreso total.";
             break;
             case 'inalootr':  mensaje = "Si por otro tipo de habitaci&oacute;n s&oacute;lo se diligencia los ingresos de alojamiento el rubro deber&iacute;a ser menor o igual al ingreso total.";
             break;*/
    }
    return mensaje;
}


function removerFuenteDirectorio(numest) {
    var answer = confirm("Realmente desea inactivar esta empresa del directorio ?");
    if (answer) {
        $.ajax({
            type: "POST",
            url: base_url + "administrador/eliminarFuente",
            data: {'numest': numest},
            cache: false,
            success: function (data) {
                alert("La empresa ha sido inactivada");
                location.reload();
            }
        });
    }
}

//$("#datos_a_enviar").click(function(){
$(document).ready(function () {
    $(".botonExcel").click(function (event) {
        $("#datos_a_enviar").val($("<div>").append($("#Exportar_a_Excel").eq(0).clone()).html());
        $("#FormularioExportacion").submit();
    });
});

//}
$(document).ready(function(){
    $('#tablaDirectorio').dataTable( {
                    "sPaginationType": "full_numbers",
                    "aaSorting": [[ 2, "asc" ]],
                    "bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bJQueryUI": true,
                    "bAutoWidth": true, 
                    "processing": true,
                    "serverSide": true,
                    "bProcessing": true,
                    "sAjaxSource": base_url +"administrador/directorioClientes",
                     "aoColumns": [
                            { mData: 'NumEstabl' } ,
                            { mData: 'NombreEstablecimiento' },
                            { mData: 'NIT' },
                            { mData: 'Dierccion' },
                            { mData: 'telefono' },
                            { mData: 'email' },
                            { mData: 'Contacto' },
                            { mData: 'Departamento' },
                            { mData: 'Municipio' },
                            { mData: 'Estado' }
                    ]
     } );
     
     
 
});