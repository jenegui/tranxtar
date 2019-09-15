 jQuery(function () {
    $(function () {
        $("#alto").numerico();
        $("#ancho").numerico();
        $("#largo").numerico();
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
        $("#idestablecimiento").select2();
        $("#iddestinatario").select2();
        $("#idoperario").select2();
        $("#idoperarioext").select2();
        $("#idmpioDest").select2();
        $("#tipo_tarifa").select2();
        $("#iddestinatario").cargarCombo("idmpioDest", "guias/actualizarMunicipios");


    
    }); 
});

 //Abre el dialogo para agregar un nuevo destintario
        $("#btnAgregarDestinatario").click(function () {
            $("#agregarDestinatario").dialog({
                width: 780,
                title: 'Agregar destinatarios',
                modal: true
            });
        });