//DMDIAZF - Agosto 15, 2012
//Funciones JavaScript para el modulo IV de fuente
//


$(function () {

    //Configuracion inicial del formulario
    var mensajeIHOA = "Justifique por qu&eacute; durante el mes, el n&uacute;mero de habitaciones vendidas fue mayor que el de habitaciones ofrecidas.";
    var mensajeICVA = "En el mes el n&uacute;mero de camas vendidas fue mayor que el n&uacute;mero de camas ofrecidas &iquest;Se vendieron camas supletorias?";
    //var mensajeHUETOT = "Justifique por qu&eacute; durante el mes, el n&uacute;mero total de hu&eacute;spedes es igual al n&uacute;mero de camas vendidas.";
    var mensajeHUETOT1 = "Justifique por qu&eacute; el n&uacute;mero total de hu&eacute;spedes es igual 0.";
    var mensajeTHUDOB = "Verificar por qu&eacute; la tarifa por tipo de acomodaci&oacute;n sencilla es mayor que la doble.";
    var mensajeTHUSUI = "Verificar por qu&eacute; la tarifa por tipo de acomodaci&oacute;n sencilla es mayor que la tipo suite.";
    var mensajeTHUMULT = "Verificar por qu&eacute; la tarifa por tipo de acomodaci&oacute;n sencilla es mayor que la m&uacute;ltiple.";
    var mensajeMVAM = "Especifique otros motivos viaje no solicitados antes, residentes.";
    var mensajeMVAMNR = "Especifique otros motivos viaje no no solicitados antes, no residentes.";
    //var mensajeINALOMUL = "Si por el tipo de habitaci&oacute;n m&uacute;ltiple s&oacute;lo se diligencia los ingresos de alojamiento el rubro deber&iacute;a ser menor o igual al ingreso total.";
    //var mensajeINALOOTR = "Si por otro tipo de habitaci&oacute;n s&oacute;lo se diligencia los ingresos de alojamiento el rubro deber&iacute;a ser menor o igual al ingreso total.";
    //$("#habdia").numerico().largo(7);
    $("#ihdo").numerico().largo(7);
    $("#ihoa").numerico().largo(7);
    //$("#camdia").numerico().largo(7);
    $("#icda").numerico().largo(7);
    $("#icva").numerico().largo(7);
    $("#ihpnvd").numerico().largo(7);
    $("#ihpntc").numerico().largo(7);
    $("#ihpn").numerico().largo(7);
    $("#ihpnrvd").numerico().largo(7);
    $("#ihpnrtc").numerico().largo(7);
    $("#ihpnr").numerico().largo(7);
    $("#huetot").numerico().largo(7);
    $("#mvnr").numerico().largo(4);
    $("#mvcr").numerico().largo(4);
    $("#mvor").numerico().largo(4);
    $("#mvsr").numerico().largo(4);
    $("#mvsnr").numerico().largo(4);
    $("#mvotr").numerico().largo(4);
    $("#mvam").numerico().largo(4);
    $("#mvott").numerico().largo(4);
    $("#mvnnr").numerico().largo(4);
    $("#mvcnr").numerico().largo(4);
    $("#mvonr").numerico().largo(4);
    $("#mvotnr").numerico().largo(4);
    $("#mvamnr").numerico().largo(4);
    $("#mvottnr").numerico().largo(4);
    $("#thsen").numerico().largo(9);
    $("#thusen").numerico().largo(9);
    $("#thdob").numerico().largo(9);
    $("#thudob").numerico().largo(9);
    $("#thsui").numerico().largo(9);
    $("#thusui").numerico().largo(9);
    $("#thmult").numerico().largo(9);
    $("#thumult").numerico().largo(9);
    $("#thotr").numerico().largo(9);
    $("#thuotr").numerico().largo(9);
    $("#thtot").numerico().largo(9);
    //$("#ingsen").numerico().largo(9);
    //$("#ingdob").numerico().largo(9);
    //$("#ingsui").numerico().largo(9);
    //$("#ingmult").numerico().largo(9);
    //$("#ingotr").numerico().largo(9);
    $("#ingtot").numerico().largo(9);
    //$("#inalosen").numerico().largo(9);
    //$("#inalodob").numerico().largo(9);
    //$("#inalosui").numerico().largo(9);
    //$("#inalomul").numerico().largo(9);
    //$("#inalootr").numerico().largo(9);
    $("#inalotot").numerico().largo(9);

    $("#ihoa").cajaObservaciones('parseInt($("#ihoa").val()) > parseInt($("#ihdo").val())', 'divihoa', mensajeIHOA, 'obsihoa');
    $("#icva").cajaObservaciones('parseInt($("#icva").val()) > parseInt($("#icda").val())', 'divicva', mensajeICVA, 'obsicva');
    //$("#huetot").cajaObservaciones('parseInt($("#huetot").val()) == parseInt($("#icva").val())','divhuetot',mensajeHUETOT,'obshuetot');
    $("#huetot").cajaObservaciones1('parseInt($("#huetot").val()) == 0', 'divhuetot1', mensajeHUETOT1, 'obshuetot1');
    $("#thudob").cajaObservaciones('parseInt($("#thusen").val()) > parseInt($("#thudob").val())', 'divthudob', mensajeTHUDOB, 'obsthudob');
    $("#thusui").cajaObservaciones('parseInt($("#thusen").val()) > parseInt($("#thusui").val())', 'divthusui', mensajeTHUSUI, 'obsthusui');
    $("#thumult").cajaObservaciones('parseInt($("#thusen").val()) > parseInt($("#thumult").val())', 'divthumult', mensajeTHUMULT, 'obsthumult');
    $("#mvam").cajaObservaciones('parseInt($("#mvam").val()) > 0', 'divmvam', mensajeMVAM, 'obsmvam');
    $("#mvamnr").cajaObservaciones('parseInt($("#mvamnr").val()) > 0', 'divmvamnr', mensajeMVAMNR, 'obsmvamnr');

    //$("#inalomul").cajaObservaciones('parseInt($("#ingmult").val()) > parseInt($("#inalomul").val())','divinalomul',mensajeINALOMUL,'obsinalomul');
    //$("#inalootr").cajaObservaciones('parseInt($("#ingotr").val()) > parseInt($("#inalootr").val())','divinalootr',mensajeINALOOTR,'obsinalootr');

    //$("#habdia").hint("Disponibles promedio d&iacute;a. Infraestructura. Capacidad de alojamiento.");
    $("#ihdo").hint("Las habitaciones ofrecidas pueden cambiar si hay  habitaciones en mantenimiento o cerradas temporalmente. Ej:  si tiene 10  habitaciones f&iacute;sicas  que estuvieron disponibles todos los 30 días  del mes, entonces las habitaciones ofrecidas total mes ser&aacute;n = 300 .");
    $("#ihoa").hint("Suma de a + b (ocupadas por venta directa + ocupadas por tiempo compartido).");
    //$("#camdia").hint("Disponibles promedio d&iacute;a. Infraestructura. Capacidad de alojamiento. No se incluyen las camas supletorias.");
    $("#icda").hint("Hace referencia a las camas ofrecida en el mes, no incluir las supletorias o adicionales.");
    $("#icva").hint("Se obtiene de acuerdo con los registros de hu&eacute;spedes, sumando d&iacute;a a d&iacute;a el n&uacute;mero de veces que cada cama ha estado cedida (vendida) a un cliente; por ejemplo, si la totalidad de hoteles tiene f&iacute;sicamente 200 camas, de las cuales 160 permanecen ocupadas todo el mes, el n&uacute;mero de camas vendidas es de 4 800 (160 camas × 30 días).");
    $("#texto6").hint("Persona que se aloja en un establecimiento, mediante contrato de hospedaje. S&oacute;lo se registran las personas que llegan sin tener en cuenta el tiempo de pernoctaci&oacute;n (Ej. Una persona se registra en un hotel, pernocta seis (6) noches seguidas, se reportar&aacute; como un solo hu&eacute;sped)");
    $("#huetot").hint("Suma de total residentes m&aacute;s total no residentes");
    //$("#texto1").hint("Motivo sin el cual el viaje no se hubiera efectuado.");
    $("#texto2").hint("Ingresos totales por habitaci&oacute;n. Incluye ingresos por alojamiento y otros cobros.");
    $("#texto3").hint("Triple, cu&aacute;druple");
    $("#texto4").hint("Caba&ntilde;a, Apartamento, camping, etc.");
    $("#textoMICE").hint("MICE ( Meeting, incentives, congresses, exhibitions), es aquel que abarca las actividades basadas en la organizaci&oacute;n, promoci&oacute;n, venta y distribuci&oacute;n de reuniones y eventos; productos y servicios que incluyen reuniones gubernamentales, de empresas y de asociaciones; viajes de incentivos de empresas, seminarios, congresos, conferencias, convenciones, exposiciones y ferias.");
    $//("#nota").hint("Infraestructura -capacidad de alojamiento- no incluye supletorias o adicionales.");
    //Lanzo función ajax para saber si la fuente ha diligenciado justificaciones para este capitulo y mostrarlas en los recuadros.
    $.ajax({
        type: "POST",
        url: base_url + "fuente/obtenerObservaciones",
        data: {'campo': 0, 'modulo': 4}, //Se envia el campo en cero para que traiga todas las observaciones del modulo 3
        dataType: "html",
        cache: false,
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
                    var contenido = '<p>' + datos[i].mensaje + '</p><textarea id="' + caja + '" name="' + caja + '" rows="3" style="width: 75%; border: 1px solid #CCCCCC;"' + bloquear + '>' + datos[i].descripcion + '</textarea>';
                    $(div).html(contenido);
                }
            }
        }
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
                igualQue: 'parseInt($("#thsen").val()) + parseInt($("#thdob").val()) + parseInt($("#thsui").val()) + parseInt($("#thotr").val())',
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
                expresion : "Verificar la llegada de personas o el n&uacute;mero total de hu&eacute;spedes en el hotel, hay ingresos por alojamento y habitaciones  ocupadas. "
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
            //Validación de porcentajes residentes.
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
                alert('El número de residentes de en Colombia es 0, por lo tanto el porcentaje del motivo de viaje residentes debe ser igual a 0!!!');
                return false;
            } else if ($("#ihpnr").val() == 0 && $("#mvottnr").val() != 0)
            {
                alert('El número de NO residentes es 0, por lo tanto el porcentaje del motivo de viaje  de NO residentes debe ser igual a 0!!!');
                return false;
            } else
            {
                $.ajax({
                    type: "POST",
                    url: base_url + "fuente/actualizarModuloIV",
                    data: $("#frmModuloIV").serialize(),
                    dataType: "html",
                    cache: false,
                    success: function (data) {
                        var image = $("#imgtab4");
                        image.attr("src", base_url + "/images/tick.png");
                        $("#tabs").tabs({selected: 4});
                        location.reload();
                        location.href = base_url + "fuente/index#tabs-5";
                    }
                });
            }

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


});

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
        case 'thudob':
            mensaje = "Verificar por qu&eacute; la tarifa por tipo de acomodaci&oacute;n sencilla es mayor que la doble.";
            break;
        case 'thusui':
            mensaje = "Verificar por qu&eacute; la tarifa por tipo de acomodaci&oacute;n sencilla es mayor que la tipo suite.";
            break;
        case 'thumult':
            mensaje = "Verificar por qu&eacute; la tarifa por tipo de acomodaci&oacute;n sencilla es mayor que la m&uacute;ltiple.";
            break;
        case 'huetot':
            mensaje = "Justifique por qu&eacute; durante el mes, el n&uacute;mero total de hu&eacute;spedes es igual al n&uacute;mero de camas vendidas.";
            break;
        case 'huetot1':
            mensaje = "Justifique por qu&eacute; el n&uacute;mero total de hu&eacute;spedes es igual 0.";
            break;
        case 'mvam':
            mensaje = "Especifique otros motivos viaje no solicitados antes, residentes.";
            break;
        case 'mvamnr':
            mensaje = "Especifique otros motivos viaje no solicitados antes, no residentes.";
            break;
    }
    return mensaje;
}

