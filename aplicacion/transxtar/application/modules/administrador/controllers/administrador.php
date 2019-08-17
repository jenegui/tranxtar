<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrador extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->helper("download");
        $this->load->library("session");
        $this->load->library("validarsesion");
        $this->load->library("danecrypt");
        $this->load->library("pagination"); //Este es el paginador propio de CodeIgniter        
        $this->load->library('phpexcel/PHPExcel');
    }

    //Funcion principal. Se ejecuta por defecto al cargar el controlador ()
    public function index() {
        $data["controller"] = $this->session->userdata("controlador");
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data['tipo_usuario'] = $this->session->userdata("tipo_usuario");
        $data["nom_usuario"] = $nom_usuario;
        $data["view"] = "administrador";
        $data["menu"] = "adminmenu";
        //$data["periodos"] = $this->periodo->obtenerPeriodosTodosMOD();
        $this->load->view("layout", $data);
    }

    //Actualiza el salario minimo.
    public function actualizarSalarioMin() {
        $this->load->model("periodo");
        $ano_periodo = $this->session->userdata("ano_periodo");
        $mes_periodo = $this->session->userdata("mes_periodo");
        $salario = $_REQUEST['salario'];
        $this->periodo->actualizarSalarioPeriodo($salario, $ano_periodo, $mes_periodo);
        //var_dump($_REQUEST);
        //redirect('/administrador', 'location', 301);
    }

    //Funciones AJAX
    //Obtiene las observaciones que se han realizado sobre los capitulos de un formulario (por parte de la fuente)
    public function obtenerObservaciones($nro_orden, $nro_establecimiento) {
        $this->load->model("observacion");
        $campo = $this->input->post("campo");
        $modulo = $this->input->post("modulo");
        $ano_periodo = $this->session->userdata("ano_periodo");
        $mes_periodo = $this->session->userdata("mes_periodo");
        $observaciones = $this->observacion->obtenerObservacionesModulo($nro_orden, $nro_establecimiento, $ano_periodo, $mes_periodo, $modulo);
        echo json_encode($observaciones);
    }

    /**
     * Genera los usuarios de las empresas.
     * @author sjneirag
     * @since  25/05/2017
     */
    public function generarUsuarios() {
        $this->load->model("usuario");
        $data["controller"] = $this->session->userdata("controlador");
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        if ($tipo_usuario == 1) {
            $data['tipo_usuario'] = $this->session->userdata("controlador");
        }
        $data["nom_usuario"] = $nom_usuario;
        $data["view"] = "genera_usaurios";
        $data["menu"] = "adminmenu";
        //Lista las empresas que no tienen usuario asignado
        $data["contar_fuentes"] = $this->usuario->contarFuentes(0, 0);
        //echo "MMM".$data["contar_fuentes"];
        $this->load->view("layout", $data);
    }

    public function GeneraUsuarios() {
        $this->load->model("usuario");
        $data['tipo_usuario'] = $this->session->userdata("controlador");
        $data["traer_fuentes"] = $this->usuario->traerFuentes(0, 0);
        
        
        for ($i = 0; $i <= count($data["traer_fuentes"]) - 1; $i++) {
            $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $longpalabra = 8;
            for ($pass = '', $n = strlen($caracteres) - 1; strlen($pass) < $longpalabra;) {
                $x = rand(0, $n);
                $pass .= $caracteres[$x];
            }
            
            $id_est=$data["traer_fuentes"][$i]["id_establecimiento"];
            $txtNumId=$data["traer_fuentes"][$i]["nit_establecimiento"];
            $txtNomUsuario=$data["traer_fuentes"][$i]["idnomcom"];
            $txtLogin = $data["traer_fuentes"][$i]["nit_establecimiento"];
            $password = $this->danecrypt->encode($pass);
            $txtEmail = $data["traer_fuentes"][$i]["idcorreo"];
            $estado='A';
            $fecini=date('Y-m-d');
            $fecfin=date('Y-m-d');
            $numtelefono=$data["traer_fuentes"][$i]["idtelno"];
            
            $this->usuario->insertarUsuario($txtNumId, $txtNomUsuario, $txtLogin, $password, $txtEmail, $fecini, $fecfin, 0, $id_est, $numtelefono, 1, 8, 0, 0);
            $this->usuario->insertarNotifica($id_est, $pass, 0);
            //echo "<script>alert('¡Registro exitoso!.');</script>";
           
        }
         redirect('/administrador/usuarios', 0);
    }

    //Ejecuta la funcion del directorio del menu del administrador.
    public function directorio() {
        $this->load->model("control");
        $this->load->model("divipola");
        $this->load->model("tipodocs");
        $this->load->model("actividad");
        $this->load->model("directorio");
        $this->load->model("usuario");
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data['tipo_usuario'] = $this->session->userdata("controlador");
        $data["nom_usuario"] = $nom_usuario;
        $data["controller"] = $this->session->userdata("controlador");
        $data["menu"] = "adminmenu";
        $data["view"] = "directorio";
        $data["tipodocs"] = $this->tipodocs->obtenerTipoDocumentos();
        $data["departamentos"] = $this->divipola->obtenerDepartamentos();
        $data["municipios"] = $this->divipola->obtenerMunicipios(0);
        $data["comerciales"] = $this->usuario->obtenerComerciales();
        
        $data["id_usuario"] = $this->session->userdata("num_identificacion");
        //Configuracion del paginador
        $config = array();
        $config["base_url"] = site_url("administrador/directorio");
        $config["total_rows"] = $this->directorio->contarFuentes(0, 0); //Obtener el numero total de registros que debe procesar el paginador
        $config["per_page"] = 50;   //Cantidad de registros por pagina que debe mostrar el paginador
        $config["num_links"] = 5;  //Cantidad de links para cambiar de pÃ¯Â¿Â½gina que va a mostrar el paginador.
        $config["first_link"] = "Primero";
        $config["last_link"] = "&Uacute;ltimo";
        $config["use_page_numbers"] = TRUE;
        $this->pagination->initialize($config);

        //Trabajo de paginacion
        $pagina = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; //Si esta definido un valor por get, utilice el valor, de lo contrario utilice cero (para el primer valor a mostrar).
        $desde = ($pagina - 1) * $config["per_page"];

        $data["fuentes"] = $this->directorio->obtenerClientes();

        $data["NoEstab"] = $this->directorio->obtenerUltmoEstablecimiento();
        $data["links"] = $this->pagination->create_links();
        $this->load->view("layout", $data);
    }
    
    public function registrarClientes() {
        $this->load->model("divipola");
        $this->load->model("empresa");
        $this->load->model("establecimiento");
        $this->load->model("directorio");        
        $data["controller"] = "administrador";
        $data["view"] = "detalle";
        
        //$data["view"] = "ajxfuentesadd";
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data['tipo_usuario'] = $this->session->userdata("controlador");
        $data["nom_usuario"] = $nom_usuario;
        $data["menu"] = "adminmenu";
        $data["departamentos"] = $this->divipola->obtenerDepartamentos();
        $data["municipios"] = $this->divipola->obtenerMunicipios("");
        $data["ultimoEstab"] = $this->directorio->obtenerUltmoEstablecimiento();
        
        $this->load->view("layout_1", $data);
    }
       
     //function para editar los datos de la fuente en el directorio de fuentes
    public function editarFuente($nro_establecimiento) {
        $this->load->model("divipola");
        $this->load->model("empresa");
        $this->load->model("establecimiento");
        $this->load->model("tarifas");

        $data["controller"] = "administrador";
        if (isset($_REQUEST['nro_establecimiento'])) {
            $this->session->set_userdata('nro_establecimiento', $_REQUEST['nro_establecimiento']);
            $nro_establecimiento = $this->session->userdata("nro_establecimiento");
        } else {
            $nro_establecimiento = $nro_establecimiento;
        }
       
        $data["view"] = "detalle";

        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data['tipo_usuario'] = $this->session->userdata("controlador");
        $data["nom_usuario"] = $nom_usuario;
        $data["menu"] = "adminmenu";
        $data["departamentos"] = $this->divipola->obtenerDepartamentos();
        $data["municipios"] = $this->divipola->obtenerMunicipios("");
        $data["establecimiento"] = $this->establecimiento->obtenerDatosEstablecimiento($nro_establecimiento);
       
        $data["tarifas"] = $this->tarifas->obtenerDatosTarifasTodas($nro_establecimiento);
        
        $data["ciudadesTarifas"]=0;
        for($i=0; $i<=count($data["tarifas"])-1; $i++){
            $data["ciudadesTarifas"]= $data["ciudadesTarifas"].','.$data["tarifas"][$i]["id_ciudad"]; 
        }

        $this->load->view("layout_1", $data);
    }

    //Función para registrar las tarifas
    public function registrarTarifas(){
        $this->load->model("empresa");
        $this->load->model("usuario");
        $this->load->model("control");
        $this->load->model("tarifas");
        //Recibir todas las variables que vengan enviadas por POST
        foreach ($_POST as $nombre_campo => $valor) {

            $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
            eval($asignacion);
        }
        $data["tarifa"] = $this->tarifas->obtenerDatosTarifasId($IdEstablecimiento,$cmbMpioTar);
        if(count($data["tarifa"]) > 0) {
            echo "El registro ya existe"; 
        }else{
            //Actualizar los datos del destinatario
            $this->tarifas->registrarTarifas($IdEstablecimiento, $cmbMpioTar, $valorpesokg, $valorvolumen, $valorxunidad);
        }
        redirect("/administrador/editarFuente/$IdEstablecimiento#tarifas", "refresh");
    }
    
    public function cargaDirectorio() {
        echo Modules::run('carga_directorio/cargadir/index');
    }

    //Función para editar las tarifas
    public function formEditarTarifas($id_tarifa){
        $this->load->model("establecimiento");
        $this->load->model("tarifas");
        $this->load->model("divipola");
        $data["tarifa"] = $this->tarifas->obtenerTarifasId($id_tarifa);
        $data["establecimiento"] = $this->establecimiento->obtenerDatosEstablecimiento($data["tarifa"]["id_establecimientos"]);
        $data["controller"] = "administrador";
        $data["menu"] = "adminmenu";
        $data["view"] = "editarTarifa";
        //echo $actualizo;
        $this->load->view("layout_1", $data);
    }

    //Función para registrar la edición de las tarifas
    public function editarTarifas(){
        $this->load->model("establecimiento");
        $this->load->model("tarifas");
        $this->load->model("divipola");
        //Recibir todas las variables que vengan enviadas por POST
        foreach ($_POST as $nombre_campo => $valor) {

            $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
            eval($asignacion);
        }
        $this->tarifas->actualizarTarifas($IdTarifa, $valorpesokg, $valorvolumen, $valorxunidad);
        redirect("/administrador/editarFuente/$IdEstablecimiento#tarifas", "refresh");
    }

    //Ejecuta la funcion del control de guias del menu del administrador.
    public function control() {
        $this->load->model("control");
        $this->load->model("divipola");
        $this->load->model("tipodocs");
        $this->load->model("actividad");
        $this->load->model("directorio");
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data['tipo_usuario'] = $this->session->userdata("controlador");
        $data["nom_usuario"] = $nom_usuario;
        $data["controller"] = $this->session->userdata("controlador");
        $data["menu"] = "adminmenu";
        $data["view"] = "control";
        $data["tipodocs"] = $this->tipodocs->obtenerTipoDocumentos();
        $data["departamentos"] = $this->divipola->obtenerDepartamentos();
        $data["municipios"] = $this->divipola->obtenerMunicipios(0);
        $data["usuario"] = $tipo_usuario;
        //Configuracion del paginador
        $config = array();
        $config["base_url"] = site_url("administrador/control");
        $config["total_rows"] = $this->directorio->contarFuentes(0, 0); //Obtener el numero total de registros que debe procesar el paginador
        $config["per_page"] = 50;   //Cantidad de registros por pagina que debe mostrar el paginador
        $config["num_links"] = 5;  //Cantidad de links para cambiar de pÃ¯Â¿Â½gina que va a mostrar el paginador.
        $config["first_link"] = "Primero";
        $config["last_link"] = "&Uacute;ltimo";
        $config["use_page_numbers"] = TRUE;
        $this->pagination->initialize($config);

        //Trabajo de paginacion
        $pagina = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; //Si esta definido un valor por get, utilice el valor, de lo contrario utilice cero (para el primer valor a mostrar).
        $desde = ($pagina - 1) * $config["per_page"];
        if ($tipo_usuario == 5 || $tipo_usuario == 3) {
            $id_usuario = $this->session->userdata('num_identificacion');
        } else {
            $id_usuario = 0;
        }
        $data["control"] = $this->control->obtenerGuias($id_usuario);
        //var_dump($data["control"])."-----";
        $data["NoEstab"] = $this->directorio->obtenerUltmoEstablecimiento();
        $data["links"] = $this->pagination->create_links();
        $this->load->view("layout", $data);
    }

    //Ejecuta la funcion del control de guias por ciudad
    public function reportexCiudad() {
        $this->load->model("control");
        $this->load->model("divipola");
        $this->load->model("tipodocs");
        $this->load->model("actividad");
        $this->load->model("directorio");
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data['tipo_usuario'] = $this->session->userdata("controlador");
        $data["nom_usuario"] = $nom_usuario;
        $data["controller"] = $this->session->userdata("controlador");
        $data["menu"] = "adminmenu";
        $data["view"] = "controlxCiudad";
        $data["tipodocs"] = $this->tipodocs->obtenerTipoDocumentos();
        $data["departamentos"] = $this->divipola->obtenerDepartamentos();
        $data["municipios"] = $this->divipola->obtenerMunicipios(0);
        $data["usuario"] = $tipo_usuario;
        //Configuracion del paginador
        $config = array();
        $config["base_url"] = site_url("administrador/control");
        $config["total_rows"] = $this->directorio->contarFuentes(0, 0); //Obtener el numero total de registros que debe procesar el paginador
        $config["per_page"] = 50;   //Cantidad de registros por pagina que debe mostrar el paginador
        $config["num_links"] = 5;  //Cantidad de links para cambiar de pÃ¯Â¿Â½gina que va a mostrar el paginador.
        $config["first_link"] = "Primero";
        $config["last_link"] = "&Uacute;ltimo";
        $config["use_page_numbers"] = TRUE;
        $this->pagination->initialize($config);

        //Trabajo de paginacion
        $pagina = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; //Si esta definido un valor por get, utilice el valor, de lo contrario utilice cero (para el primer valor a mostrar).
        $desde = ($pagina - 1) * $config["per_page"];
        if ($tipo_usuario == 5 || $tipo_usuario == 3) {
            $id_usuario = $this->session->userdata('num_identificacion');
        } else {
            $id_usuario = 0;
        }
        $data["control"] = $this->control->obtenerGuias($id_usuario);
        //var_dump($data["control"])."-----";
        $data["NoEstab"] = $this->directorio->obtenerUltmoEstablecimiento();
        $data["links"] = $this->pagination->create_links();
        $this->load->view("layout", $data);
    }
    //Ejecuta la funcion del control de guias por ciudad
    public function reporteHistorico() {
        $this->load->model("control");
        $this->load->model("divipola");
        $this->load->model("tipodocs");
        $this->load->model("actividad");
        $this->load->model("directorio");
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data['tipo_usuario'] = $this->session->userdata("controlador");
        $data["nom_usuario"] = $nom_usuario;
        $data["controller"] = $this->session->userdata("controlador");
        $data["menu"] = "adminmenu";
        $data["view"] = "reportehistorico";
        $data["tipodocs"] = $this->tipodocs->obtenerTipoDocumentos();
        $data["departamentos"] = $this->divipola->obtenerDepartamentos();
        $data["municipios"] = $this->divipola->obtenerMunicipios(0);
        $data["usuario"] = $tipo_usuario;
        //Configuracion del paginador
        $config = array();
        $config["base_url"] = site_url("administrador/control");
        $config["total_rows"] = $this->directorio->contarFuentes(0, 0); //Obtener el numero total de registros que debe procesar el paginador
        $config["per_page"] = 50;   //Cantidad de registros por pagina que debe mostrar el paginador
        $config["num_links"] = 5;  //Cantidad de links para cambiar de pÃ¯Â¿Â½gina que va a mostrar el paginador.
        $config["first_link"] = "Primero";
        $config["last_link"] = "&Uacute;ltimo";
        $config["use_page_numbers"] = TRUE;
        $this->pagination->initialize($config);

        //Trabajo de paginacion
        $pagina = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; //Si esta definido un valor por get, utilice el valor, de lo contrario utilice cero (para el primer valor a mostrar).
        $desde = ($pagina - 1) * $config["per_page"];
        if ($tipo_usuario == 5 || $tipo_usuario == 3) {
            $id_usuario = $this->session->userdata('num_identificacion');
        } else {
            $id_usuario = 0;
        }
        $data["control"] = $this->control->obtenerGuiasTodas($id_usuario);
        //var_dump($data["control"])."-----";
        $data["NoEstab"] = $this->directorio->obtenerUltmoEstablecimiento();
        $data["links"] = $this->pagination->create_links();
        $this->load->view("layout", $data);
    }

    //funcion para editar el control de guias
    public function editarControl($id_control) {
        $this->load->model("divipola");
        $this->load->model("empresa");
        $this->load->model("establecimiento");
        $this->load->model("control");
        $this->load->model("usuario");
        $this->load->model("estado");

        $data["controller"] = $this->session->userdata("controlador");
        if (isset($_REQUEST['$id_control'])) {
            $id_control = $_REQUEST['$id_control'];
        } else {
            $id_control = $id_control;
        }
        $nom_usuario = $this->session->userdata("nombre");
        $data['tipo_usuario'] = $this->session->userdata("controlador");
        $data['usuario'] = $this->session->userdata("tipo_usuario");
        $data["view"] = "controlEditar";
        $nom_usuario = $this->session->userdata("nombre");
        $data["menu"] = "adminmenu";
        $data["establecimiento"] = $this->establecimiento->obtenerEstablecimientos();
        $data["destinatario"] = $this->usuario->obtenerDestinatarios();
        $data["operarios"] = $this->usuario->obtenerOperariosInternos();
        $data["operariosExt"] = $this->usuario->obtenerOperariosExternos();
        $data["estadocarga"] = $this->estado->estadoCarga();

        $data["nom_usuario"] = $nom_usuario;
        $data['usuario'] = $this->session->userdata('tipo_usuario');
        $data["departamentos"] = $this->divipola->obtenerDepartamentos();
        $data["municipios"] = $this->divipola->obtenerMunicipios("");
        $data["control"] = $this->control->obtenerGuiasId($id_control);

        $this->load->view("layout", $data);
    }

    //funcion para cambiar el estado de la carga para tráfico y seguridad
    public function editarControlTraficoySeg($id_control) {
        $this->load->model("divipola");
        $this->load->model("empresa");
        $this->load->model("establecimiento");
        $this->load->model("control");
        $this->load->model("usuario");
        $this->load->model("estado");

        $data["controller"] = $this->session->userdata("controlador");
        if (isset($_REQUEST['$id_control'])) {
            $id_control = $_REQUEST['$id_control'];
        } else {
            $id_control = $id_control;
        }
        $nom_usuario = $this->session->userdata("nombre");
        $data['tipo_usuario'] = $this->session->userdata("controlador");
        $data['usuario'] = $this->session->userdata("tipo_usuario");
        $data["view"] = "controlEditarTraficoSeg";
        $nom_usuario = $this->session->userdata("nombre");
        $data["menu"] = "adminmenu";
        $data["establecimiento"] = $this->establecimiento->obtenerEstablecimientos();
        $data["destinatario"] = $this->usuario->obtenerDestinatarios();
        $data["operarios"] = $this->usuario->obtenerOperariosInternos();
        $data["operariosExt"] = $this->usuario->obtenerOperariosExternos();
        $data["estadocarga"] = $this->estado->estadoCarga();

        $data["nom_usuario"] = $nom_usuario;
        $data['usuario'] = $this->session->userdata('tipo_usuario');
        $data["departamentos"] = $this->divipola->obtenerDepartamentos();
        $data["municipios"] = $this->divipola->obtenerMunicipios("");
        $data["control"] = $this->control->obtenerGuiasId($id_control);

        $this->load->view("layout", $data);
    }

    //funcion para cambiar el estado contable
    public function editarControlContable($id_control) {
        $this->load->model("divipola");
        $this->load->model("empresa");
        $this->load->model("establecimiento");
        $this->load->model("control");
        $this->load->model("usuario");
        $this->load->model("estado");

        $data["controller"] = $this->session->userdata("controlador");
        if (isset($_REQUEST['$id_control'])) {
            $id_control = $_REQUEST['$id_control'];
        } else {
            $id_control = $id_control;
        }
        $nom_usuario = $this->session->userdata("nombre");
        $data['tipo_usuario'] = $this->session->userdata("controlador");
        $data['usuario'] = $this->session->userdata("tipo_usuario");
        $data["view"] = "controlEditarContable";
        $nom_usuario = $this->session->userdata("nombre");
        $data["menu"] = "adminmenu";
        $data["establecimiento"] = $this->establecimiento->obtenerEstablecimientos();
        $data["destinatario"] = $this->usuario->obtenerDestinatarios();
        $data["operarios"] = $this->usuario->obtenerOperariosInternos();
        $data["operariosExt"] = $this->usuario->obtenerOperariosExternos();
        $data["estadocarga"] = $this->estado->estadoCarga();

        $data["nom_usuario"] = $nom_usuario;
        $data['usuario'] = $this->session->userdata('tipo_usuario');
        $data["departamentos"] = $this->divipola->obtenerDepartamentos();
        $data["municipios"] = $this->divipola->obtenerMunicipios("");
        $data["control"] = $this->control->obtenerGuiasId($id_control);

        $this->load->view("layout", $data);
    }

    //funcion para editar el control de guias
    public function actualizarDatosControl() {
        $this->load->model("empresa");
        $this->load->model("usuario");
        $this->load->model("control");
        //Recibir todas las variables que vengan enviadas por POST
        foreach ($_POST as $nombre_campo => $valor) {
            $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
            eval($asignacion);
        }
        $idusaurio = $this->session->userdata('id');
        $fechaRegistro = date("Y-m-d H:i:s");

        if ($idoperarioext == '-') {
            $idoperarioext1 = 0;
        } else {
            $idoperarioext1 = $idoperarioext;
        }

        $fecharec = explode("/", $txtFecRecogida);
        $fecharecog = $fecharec[2] . '-' . $fecharec[1] . '-' . $fecharec[0];
        $fechaent = explode("/", $txtFecEntrega);
        $fechaentr = $fechaent[2] . '-' . $fechaent[1] . '-' . $fechaent[0];
        $observ = $observaciones . " Se modificaron los datos con el usuario  " . $idusaurio . ", el " . $fechaRegistro;
        //Actualizar los datos del destinatario
        $this->control->actualizarDatosControl($id_control, $numremesa, $idestablecimiento, $fecharecog, $fechaentr, $iddestinatario, $formaPago, $pesokg, $alto, $ancho, $largo, $unidades, $pesocobrar, $valorDeclarado, $flete, $costomanejo, $totalflete, $tipocarga, $idoperario, $numplaca, $idoperarioext, $estadocarga, $estadoRecogida, $observ);
        //echo "¡Registro exitoso!.";                                       
        redirect("/administrador/control", "refresh");
    }

    //funcion para editar el estado de las Guias
    public function actualizarDatosControlTS() {
        $this->load->model("empresa");
        $this->load->model("usuario");
        $this->load->model("control");
        //Recibir todas las variables que vengan enviadas por POST
        foreach ($_POST as $nombre_campo => $valor) {

            $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
            eval($asignacion);
        }
        $idusaurio = $this->session->userdata('id');
        $fechaRegistro = date("Y-m-d H:i:s");

        if (!isset($pesokg)) {
            $pesokg1 = 0;
        } else {
            $pesokg1 = $pesokg;
        }
        if (!isset($pesovol)) {
            $pesovol1 = 0;
        } else {
            $pesovol1 = $pesovol;
        }
        if ($idoperarioext == '-') {
            $idoperarioext1 = 0;
        } else {
            $idoperarioext1 = $idoperarioext;
        }

        $fecharec = explode("/", $txtFecRecogida);
        $fecharecog = $fecharec[2] . '-' . $fecharec[1] . '-' . $fecharec[0];
        $fechaent = explode("/", $txtFecEntrega);
        $fechaentr = $fechaent[2] . '-' . $fechaent[1] . '-' . $fechaent[0];
        $observ = $observaciones . " Se modificaron los datos con el usuario  " . $idusaurio . ", el " . $fechaRegistro;
        //Actualizar los datos del destinatario
        $this->control->actualizarDatosControlTS($id_control, $estadocarga, $observ);

        if ($this->control->actualizarDatosControlTS) {
            redirect("/administrador/control", "refresh");
        } else {
            echo "No";
        }
    }

    //funcion para editar el estado contable de las Guias
    public function actualizarDatosControlCon() {
        $this->load->model("empresa");
        $this->load->model("usuario");
        $this->load->model("control");
        //Recibir todas las variables que vengan enviadas por POST
        foreach ($_POST as $nombre_campo => $valor) {

            $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
            eval($asignacion);
        }
        $idusaurio = $this->session->userdata('id');
        $fechaRegistro = date("Y-m-d H:i:s");

        if (!isset($pesokg)) {
            $pesokg1 = 0;
        } else {
            $pesokg1 = $pesokg;
        }
        if (!isset($pesovol)) {
            $pesovol1 = 0;
        } else {
            $pesovol1 = $pesovol;
        }
        if ($idoperarioext == '-') {
            $idoperarioext1 = 0;
        } else {
            $idoperarioext1 = $idoperarioext;
        }

        $fecharec = explode("/", $txtFecRecogida);
        $fecharecog = $fecharec[2] . '-' . $fecharec[1] . '-' . $fecharec[0];
        $fechaent = explode("/", $txtFecEntrega);
        $fechaentr = $fechaent[2] . '-' . $fechaent[1] . '-' . $fechaent[0];
        $observ = $observaciones . " Se modificaron los datos con el usuario  " . $idusaurio . ", el " . $fechaRegistro;
        //Actualizar los datos del destinatario
        $this->control->actualizarDatosControlCon($id_control, $estadocont, $estadorecaudo);

        if ($this->control->actualizarDatosControlCon) {
            redirect("/administrador/control", "refresh");
        } else {
            echo "No";
        }
    }

    //Descarga el manual para la carga del directorio con archivo CSV
    public function descargaManualCSV() {
        $file = "./res/confcarga.pdf";
        if (file_exists($file)) {
            $data = file_get_contents($file); // Read the file's contents
            $name = 'manual.pdf';
            force_download($name, $data);
        } else {
            die("<h3>ERROR: NO se ha podido descargar el archivo del formulario. No existe el archivo. Consulte con su administrador</h3>");
            exit(-1);
        }
    }

    //Descarga el modelo de archivo CSV para la carga del directorio
    public function descargaArchivoCSV() {
        $file = "./res/archivo.csv";
        if (file_exists($file)) {
            $data = file_get_contents($file); // Read the file's contents
            $name = 'archivo.csv';
            force_download($name, $data);
        } else {
            die("<h3>ERROR: NO se ha podido descargar el archivo del formulario. No existe el archivo. Consulte con su administrador</h3>");
            exit(-1);
        }
    }

    //Muestra los usuarios generales del aplicativo ()
    public function usuarios() {
        $this->load->model("usuario");
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data['tipo_usuario'] = $this->session->userdata("controlador");
        $data["nom_usuario"] = $nom_usuario;
        $data["controller"] = $this->session->userdata("controlador");
        $data["menu"] = "adminmenu";
        $data["view"] = "usuarios";

        //Configuracion del paginador
        $config = array();
        $config["base_url"] = site_url("administrador/usuarios");
        $config["total_rows"] = $this->usuario->contarUsuarios(); //Nro de registros que debe procesar el paginador
        $config["per_page"] = 50; //Cantidad de registros por pagina que debe mostrar el paginador
        $config["num_links"] = 5; //Cantidad de links para cambiar de pÃ¯Â¿Â½gina que va a mostrar el paginador.
        $config["first_link"] = "Primero";
        $config["last_link"] = "&Uacute;ltimo";
        $config["use_page_numbers"] = TRUE;
        $this->pagination->initialize($config);
        //Trabajo de paginacion
        $pagina = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; //Si esta definido un valor por get, utilice el valor, de lo contrario utilice cero (para el primer valor a mostrar).
        $desde = ($pagina - 1) * $config["per_page"];
        $data["usuarios"] = $this->usuario->obtenerUsuariosPagina();
        $data["links"] = $this->pagination->create_links();
        $this->load->view("layout", $data);
    }

    //Muestra los operarios generales del aplicativo ()
    public function operarios() {
        $this->load->model("usuario");
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data['tipo_usuario'] = $this->session->userdata("controlador");
        $data["nom_usuario"] = $nom_usuario;
        $data["controller"] = $this->session->userdata("controlador");
        $data["menu"] = "adminmenu";
        $data["view"] = "operarios";

        //Configuracion del paginador
        $config = array();
        $config["base_url"] = site_url("administrador/usuarios");
        $config["total_rows"] = $this->usuario->contarUsuarios(); //Nro de registros que debe procesar el paginador
        $config["per_page"] = 50; //Cantidad de registros por pagina que debe mostrar el paginador
        $config["num_links"] = 5; //Cantidad de links para cambiar de pÃ¯Â¿Â½gina que va a mostrar el paginador.
        $config["first_link"] = "Primero";
        $config["last_link"] = "&Uacute;ltimo";
        $config["use_page_numbers"] = TRUE;
        $this->pagination->initialize($config);
        //Trabajo de paginacion
        $pagina = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; //Si esta definido un valor por get, utilice el valor, de lo contrario utilice cero (para el primer valor a mostrar).
        $desde = ($pagina - 1) * $config["per_page"];
        $data["usuarios"] = $this->usuario->obtenerOperariosPagina($desde, $config["per_page"]);
        $data["links"] = $this->pagination->create_links();
        $this->load->view("layout", $data);
    }

    //Muestra los operarios generales del aplicativo ()
    public function destinatarios() {
        $this->load->model("usuario");
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data['tipo_usuario'] = $this->session->userdata("controlador");
        $data["nom_usuario"] = $nom_usuario;
        $data["controller"] = $this->session->userdata("controlador");
        $data["menu"] = "adminmenu";
        $data["view"] = "destinatarios";
        
        if($tipo_usuario==8){
            $data["identificacion"] = $this->session->userdata("num_identificacion");
        }else{
            $data["identificacion"] = 0;
        }

        //Configuracion del paginador
        $config = array();
        $config["base_url"] = site_url("administrador/destinatarios");
        $config["total_rows"] = $this->usuario->contarUsuarios(); //Nro de registros que debe procesar el paginador
        $config["per_page"] = 50; //Cantidad de registros por pagina que debe mostrar el paginador
        $config["num_links"] = 5; //Cantidad de links para cambiar de pÃ¯Â¿Â½gina que va a mostrar el paginador.
        $config["first_link"] = "Primero";
        $config["last_link"] = "&Uacute;ltimo";
        $config["use_page_numbers"] = TRUE;
        $this->pagination->initialize($config);
        //Trabajo de paginacion
        $pagina = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; //Si esta definido un valor por get, utilice el valor, de lo contrario utilice cero (para el primer valor a mostrar).
        $desde = ($pagina - 1) * $config["per_page"];
        $data["destinatarios"] = $this->usuario->obtenerDestinatariosPagina($data["identificacion"] );
        $data["links"] = $this->pagination->create_links();
        $this->load->view("layout", $data);
    }

    //Agrega el registro de un nuevo destinatatrio creado en el sistema a la B.D.
    public function insertarDestinatario() {
        $this->load->helper("url");
        $this->load->library("danecrypt");
        $this->load->library("general");
        $this->load->model("usuario");
        $usuario = $this->session->userdata("num_identificacion");
        
        foreach ($_POST as $nombre_campo => $valor) {
            $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
            eval($asignacion);
        }
        //$fecini = $this->general->formatoFecha($txtFecCreacion,"/");
        $this->usuario->insertarDestinatario($txtNomDest, $txtIdDest, $tipoDocumento, $txtDirDest, $idtelefono, $idcorreo, $iddepto, $idmpio, $nom_contacto, $id_cliente);
        //echo "El distinatario ha sido registrado";
        redirect('/administrador/destinatarios', 'refresh');
    }

    //function para editar los datos del destinatario en el directorio de fuentes
    public function editarDestinatario($id_destinatario) {
        $this->load->model("divipola");
        $this->load->model("empresa");
        $this->load->model("usuario");
        $this->load->model("tipodocs");
        $data["controller"] = $this->session->userdata("controlador");

        $id_dest = $id_destinatario;
        $data["tipodocs"] = $this->tipodocs->obtenerTipoDocumentos();

        $data["view"] = "editardest";

        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data['tipo_usuario'] = $this->session->userdata("controlador");
        $data["nom_usuario"] = $nom_usuario;
        $data["menu"] = "adminmenu";
        $data["departamentos"] = $this->divipola->obtenerDepartamentos();
        $data["municipios"] = $this->divipola->obtenerMunicipios("");
        $data["destinatario"] = $this->usuario->obtenerDatosDestinatario($id_dest);
        $this->load->view("layout", $data);
    }

    //Busca en la base de datos si el numero de identificacion del destinatario que se esta creando ya esta en la base de datos
    public function validaDestinatario() {
        $this->load->model("usuario");
        $tipo = $this->input->post("tipodoc");
        $numero = $this->input->post("numdoc");
        $idmpio = $this->input->post("idmpio");
        $direccion = $this->input->post("direccion");
        $id_cliente = $this->input->post("id_cliente");
        $valid1 = $this->usuario->numIdentDestinanarioExiste($tipo, $numero, $idmpio, $direccion, $id_cliente);
        
        //$valid2 = $this->usuario->existeLogin($login);
        if ($valid1 == true) {
            $validar = false;
            $error = "El destinatario ya existe.";
        } else {
            $validar = true;
            $error = "&nbsp;";
        }
        $arrayError = array('valid' => $validar,
            'error' => $error);
        echo json_encode($arrayError);
    }

    //Muestra el formulario para actualizar los datos de un usuario
    public function UPDUsuario($id_usuario) {
        $this->load->model("usuario");
        $this->load->model("tipodocs");
        $this->load->model("rol");
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data["controller"] = $this->session->userdata("controlador");
        $data['tipo_usuario'] = $this->session->userdata("controlador");
        $data["menu"] = "adminmenu";
        $data["nom_usuario"] = $nom_usuario;
        $index = $this->input->post("index");
        $data["index"] = $id_usuario;
        $data["tipodoc"] = $this->tipodocs->obtenerTipoDocumentos();
        $data["roles"] = $this->rol->obtenerRolesUsuario();
        $data["usuario"] = $this->usuario->obtenerUsuarioID($id_usuario);
        $data["view"] = "ajxusuarioupd";
        $this->load->view("layout", $data);
    }

    //Muestra el formulario para actualizar los datos de un operario
    public function UPDOperario($id_operario) {
        $this->load->model("usuario");
        $this->load->model("tipodocs");
        //$this->load->model("rol");
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data["controller"] = $this->session->userdata("controlador");
        $data['tipo_usuario'] = $this->session->userdata("tipo_usuario");
        $data["menu"] = "adminmenu";
        $index = $this->input->post("index");
        $data["index"] = $id_operario;
        $data["tipodoc"] = $this->tipodocs->obtenerTipoDocumentos();
        //$data["roles"] = $this->rol->obtenerRolesUsuario();
        $data["operario"] = $this->usuario->obtenerOperarioID($id_operario);
        $data["view"] = "ajxoperarioupd";
        $this->load->view("layout", $data);
    }

    //Elimina el registro de un usuario en Administrador/Usuarios/Eliminar Usuario
    public function eliminarUsuario($index) {
        $this->load->helper("url");
        $this->load->model("usuario");
        $this->usuario->eliminarUsuario($index);
        redirect('/administrador/usuarios', 'refresh');
    }

    //Muestra los clientes generales del aplicativo ()
    public function clientes() {
        $this->load->model("usuario");
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        if ($tipo_usuario == 1) {
            $data['tipo_usuario'] = $this->session->userdata("controlador");
        }
        $data["nom_usuario"] = $nom_usuario;
        $data["controller"] = $this->session->userdata("controlador");
        $data["menu"] = "adminmenu";
        $data["view"] = "clientes";

        //Configuracion del paginador
        $config = array();
        $config["base_url"] = site_url("administrador/usuarios");
        $config["total_rows"] = $this->usuario->contarUsuarios(); //Nro de registros que debe procesar el paginador
        $config["per_page"] = 50; //Cantidad de registros por pagina que debe mostrar el paginador
        $config["num_links"] = 5; //Cantidad de links para cambiar de pÃ¯Â¿Â½gina que va a mostrar el paginador.
        $config["first_link"] = "Primero";
        $config["last_link"] = "&Uacute;ltimo";
        $config["use_page_numbers"] = TRUE;
        $this->pagination->initialize($config);
        //Trabajo de paginacion
        $pagina = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; //Si esta definido un valor por get, utilice el valor, de lo contrario utilice cero (para el primer valor a mostrar).
        $desde = ($pagina - 1) * $config["per_page"];
        $data["usuarios"] = $this->usuario->obtenerUsuariosPagina($desde, $config["per_page"]);
        $data["links"] = $this->pagination->create_links();
        $this->load->view("layout", $data);
    }

    public function fuentesAsignadas($id) {
        $this->load->model("periodo");
        $this->load->model("usuario");
        $ano_periodo = $this->session->userdata("ano_periodo");
        $mes_periodo = $this->session->userdata("mes_periodo");
        $data["periodos"] = $this->periodo->obtenerPeriodosTodosMOD();
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        if ($tipo_usuario == 4) {
            $data['tipo_usuario'] = "ADMINISTRADOR";
        }
        $data["nom_usuario"] = $nom_usuario;
        $data["controller"] = "administrador";
        $data["menu"] = "adminmenu";
        $data["view"] = "ftesasignadas";
        $data["nomcritico"] = $this->usuario->obtenerNombreUsuario($id);
        $data["asignadas"] = $this->usuario->obtenerFuentesAsignadas($id, $ano_periodo, $mes_periodo);
        $this->load->view("layout", $data);
    }

    //Actualiza los datos de un usuario en Administrador/Usuarios/Actualizar Usuario
    public function actualizarUsuario() {
        $this->load->library("danecrypt");
        $this->load->helper("url");
        $this->load->model("usuario");
        foreach ($_POST as $nombre_campo => $valor) {
            $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
            eval($asignacion);
        }
        $password = $this->danecrypt->encode($txtPassword);
        $this->usuario->actualizarUsuario($hddIndex, $txtNumId, $txtNomUsuario, $txtLogin, $password, $txtEmail, $txtFecCreacion, $txtFecVencimiento, $cmbRol, 0, 0, $cmbTipoDocumento, $estado);
        //echo "<script>alert('¡Registro exitoso!.');</script>";
        redirect('/administrador/usuarios', 'refresh');
    }

    //Actualiza los datos de los operarios
    public function actualizarOperario() {
        $this->load->library("danecrypt");
        $this->load->helper("url");
        $this->load->model("usuario");
        $usuario = $this->session->userdata("num_identificacion");
        foreach ($_POST as $nombre_campo => $valor) {
            $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
            eval($asignacion);
        }
        if (!isset($estado)) {
            $estadoOp = 0;
        } else {
            $estadoOp = $estado;
        }
        $this->usuario->actualizarOperario($hddIndex, $cmbTipoDocumento, $txtNumId, $txtNomUsuario, $teloperario, $nro_placa, $estadoOp, $usuario);
        redirect('/administrador/operarios', 'refresh');
    }

    public function descargaPlanos() {
        $this->load->model("usuario");
        $this->load->model("periodo");
        $data["periodos"] = $this->periodo->obtenerPeriodosTodosMOD();
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");

        if ($tipo_usuario == 4) {
            $data['tipo_usuario'] = "ADMINISTRADOR";
            $data["menu"] = "adminmenu";
        } elseif ($tipo_usuario == 5) {
            $data['tipo_usuario'] = "LOGISTICA";
            $data["menu"] = "logmenu";
        }
        $data["nom_usuario"] = $nom_usuario;
        $data["controller"] = "administrador";
        $this->load->model("divipola");
        //$data["view"] = "descargaplanos";
        $data["anios"] = $this->divipola->obtenerAnios();
        $this->load->view("layout", $data);
    }

    
    public function buscarFuentes() {
        $this->load->model("control");
        $this->load->model("novedad");
        $this->load->model("periodo");
        $this->load->model("directorio");
        $opcion = $this->input->post("radBusqueda");
        $buscar = $this->input->post("txtBuscar");
        $data["ano_periodo"] = $this->session->userdata("ano_periodo");
        $data["mes_periodo"] = $this->session->userdata("mes_periodo");
        $data["periodos"] = $this->periodo->obtenerPeriodosTodosMOD();
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        if ($tipo_usuario == 4) {
            $data['tipo_usuario'] = "ADMINISTRADOR";
        }
        $data["nom_usuario"] = $nom_usuario;
        $data["menu"] = "adminmenu";
        $data["controller"] = "administrador";
        $data["view"] = "ajxformularios";
        //Configuracion del paginador
        $config = array();
        $config["base_url"] = site_url("administrador/buscarFuentes");
        $config["total_rows"] = $this->directorio->contarDirectorio($opcion, $buscar, $data["ano_periodo"], $data["mes_periodo"]);
        $config["per_page"] = 50;   //Cantidad de registros por pagina que debe mostrar el paginador
        $config["num_links"] = 5;  //Cantidad de links para cambiar de pÃ¯Â¿Â½gina que va a mostrar el paginador.
        $config["first_link"] = "Primero";
        $config["last_link"] = "&Uacute;ltimo";
        $config["use_page_numbers"] = TRUE;
        $this->pagination->initialize($config);
        //Trabajo de paginacion
        $pagina = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; //Si esta definido un valor por get, utilice el valor, de lo contrario utilice cero (para el primer valor a mostrar).
        $desde = ($pagina - 1) * $config["per_page"];
        $data["fuentes"] = $this->directorio->buscarDirectorioPagina($opcion, $buscar, $data["ano_periodo"], $data["mes_periodo"], $desde, $config["per_page"]);
        $data["total"] = $config["total_rows"];
        $data["links"] = $this->pagination->create_links();
        $this->load->view("layout", $data);
    }

    //Muestra el reporte operativo desde el modulo de administracion
    public function operativo() {
        $this->load->library("session");
        $this->load->model("control");
        $ano = $this->session->userdata("ano_periodo");
        $mes = $this->session->userdata("mes_periodo");
        $data["sedes"] = $this->sede->obtenerSedes();
        $data["subsedes"] = $this->subsede->obtenerSubSedesAll();
        $data["periodos"] = $this->periodo->obtenerPeriodosTodosMOD();
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        if ($tipo_usuario == 4) {
            $data['tipo_usuario'] = "ADMINISTRADOR";
        }
        $data["nom_usuario"] = $nom_usuario;
        $data["sede"] = 0;
        $data["subsede"] = 0;
        $data["informe"] = $this->control->informeOperativo($ano, $mes, $data["sede"], $data["subsede"]); //Obtener todas las sedes y todas las subsedes
        $data["controller"] = "administrador";
        $data["menu"] = "adminmenu";
        $data["view"] = "operativo";
        $this->load->view("layout", $data);
    }

    public function operativoCritico() {
        $this->load->model("usuario");
        $this->load->model("periodo");
        $this->load->model("control");
        $this->load->model("sede");
        $this->load->model("subsede");
        $ano_periodo = $this->session->userdata("ano_periodo");
        $mes_periodo = $this->session->userdata("mes_periodo");
        $data["periodos"] = $this->periodo->obtenerPeriodosTodosMOD();
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        if ($tipo_usuario == 4) {
            $data['tipo_usuario'] = "ADMINISTRADOR";
        }
        $data["nom_usuario"] = $nom_usuario;
        $data["controller"] = "administrador";
        $data["menu"] = "adminmenu";
        $data["view"] = "operativocr";
        $data["sedes"] = $this->sede->obtenerSedes();
        $criticos = $this->usuario->obtenerCriticos(0, 0); //Sede 0 - Subsede 0
        //Para cada uno de los criticos que se encontraron, obtengo su respectivo reporte operativo
        for ($i = 0; $i < count($criticos); $i++) {
            $data["reporte"][$i]["nombre"] = $criticos[$i]["nombre"];
            $data["reporte"][$i]["reporte"] = $this->control->informeOperativoCritico($criticos[$i]["id"], $ano_periodo, $mes_periodo, 0, 0);
        }
        $this->load->view("layout", $data);
    }

    public function ajaxOperativoCritico($sede, $subsede) {
        $this->load->model("usuario");
        $this->load->model("control");
        $ano_periodo = $this->session->userdata("ano_periodo");
        $mes_periodo = $this->session->userdata("mes_periodo");
        $criticos = $this->usuario->obtenerCriticos($sede, $subsede);
        //Para cada uno de los criticos que se encontraron, obtengo su respectivo reporte operativo
        if (count($criticos) > 0) {
            for ($i = 0; $i < count($criticos); $i++) {
                $data["reporte"][$i]["nombre"] = $criticos[$i]["nombre"];
                $data["reporte"][$i]["reporte"] = $this->control->informeOperativoCritico($criticos[$i]["id"], $ano_periodo, $mes_periodo, $sede, $subsede);
            }
            $this->load->view("ajxoperativocr", $data);
        } else {
            echo "<h3>No se han encontrado resultados</h3>";
        }
    }

    public function actualizarSubSedeOperativo() {
        $this->load->model("subsede");
        $sede = $this->input->post("sede");
        $subsedes = $this->subsede->obtenerSubsedesID($sede);
        echo '<select id="cmbSubSedeOP" name="cmbSubSedeOP" class="select">';
        echo '<option value="-" selected="selected">Seleccione...</option>';
        echo '<option value="0">Todas las subsedes.</option>';
        for ($i = 0; $i < count($subsedes); $i++) {
            echo '<option value="' . $subsedes[$i]["id"] . '">' . $subsedes[$i]["nombre"] . '</option>';
        }
        echo '</select>';
    }

    public function actualizarOperativo() {
        $this->load->library("session");
        $this->load->model("control");
        $ano = $this->session->userdata("ano_periodo");
        $mes = $this->session->userdata("mes_periodo");
        $data["sede"] = $this->input->post("sede");
        $data["subsede"] = $this->input->post("subsede");
        $data["informe"] = $this->control->informeOperativo($ano, $mes, $data["sede"], $data["subsede"]);
        $this->load->view("ajxoperativo", $data);
    }

    //Descarga el archivo del formulario en blanco
    public function descarga() {
        $this->load->helper("download");
        $file = "./res/formrmmh.pdf";
        if (file_exists($file)) {
            $data = file_get_contents($file); // Read the file's contents
            $name = 'formulario.pdf';
            force_download($name, $data);
        }
        /* else{
          die("<h3>ERROR: NO se ha podido descargar el archivo del formulario. No existe el archivo. Consulte con su administrador</h3>");
          exit(-1);
          } */
    }

    //CIERRA EL PERIODO ACTUAL DE DILIGENCIAMIENTO
    public function cierrePeriodo() {
        // Octubre 03 - 2012
        // Nota: Se modifica la propiedad del cierre de periodos. 
        // Descripcion: Al cerrar el periodo y abrir periodos se copian las fuentes y pasan con estado
        // (5-0) para el nuevo periodo, las fuentes para el periodo que se estÃ¯Â¿Â½ cerrando se mantienen 
        // con el mismo estado y novedad. (No se cambian al estado 99 - 5). Solo se crean registros para 
        //el nuevo periodo. Se hace apertura y cierre en una sola funcion
        $this->load->model("periodo");
        $this->load->model("control");
        $ano_periodo = $this->session->userdata("ano_periodo");
        $mes_periodo = $this->session->userdata("mes_periodo");
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        if ($tipo_usuario == 4) {
            $data['tipo_usuario'] = "ADMINISTRADOR";
        }
        $data["nom_usuario"] = $nom_usuario;
        $data["controller"] = "administrador";
        $data["menu"] = "adminmenu";
        $data["view"] = "cierreper";
        $data["periodos"] = $this->periodo->obtenerPeriodosTodosMOD();
        $data["periodo_actual"] = $this->periodo->obtenerPeriodoActual();
        $data["nombre_actual"] = $this->periodo->obtenerNombrePeriodo($data["periodo_actual"]["ano"], $data["periodo_actual"]["mes"]);
        $data["estado_actual"] = ($this->periodo->validaCierre($ano_periodo, $mes_periodo)) ? 'Cerrado' : 'Abierto';
        if ($data["periodo_actual"]["mes"] < 12) {
            $ano_nuevo = $data["periodo_actual"]["ano"];
            $mes_nuevo = $data["periodo_actual"]["mes"] + 1;
        } else {
            $ano_nuevo = $data["periodo_actual"]["ano"] + 1;
            $mes_nuevo = 1;
        }
        $data["ano_nuevo"] = $ano_nuevo;
        $data["mes_nuevo"] = $mes_nuevo;
        $data["nombre_nuevo"] = $this->periodo->obtenerNombrePeriodo($ano_nuevo, $mes_nuevo);
        $data["dirbase"] = $this->control->directorioBase(0, 0, $ano_periodo, $mes_periodo, 0, 0);
        $data["nuevos"] = $this->control->nuevos(0, 0, $ano_periodo, $mes_periodo, 0, 0);
        $data["sindistribuir"] = $this->control->sinDistribuir(0, 0, $ano_periodo, $mes_periodo, 0, 0);
        $data["distribuido"] = $this->control->distribuidos(0, 0, $ano_periodo, $mes_periodo, 0, 0);
        $data["digitacion"] = $this->control->digitacion(0, 0, $ano_periodo, $mes_periodo, 0, 0);
        $data["digitados"] = $this->control->digitados(0, 0, $ano_periodo, $mes_periodo, 0, 0);
        $data["analverif"] = $this->control->analisisVerificacion(0, 0, $ano_periodo, $mes_periodo, 0, 0);
        $data["verificados"] = $this->control->verificados(0, 0, $ano_periodo, $mes_periodo, 0, 0);
        $data["novedades"] = $this->control->novedades(0, 0, $ano_periodo, $mes_periodo, 0, 0);
        $data["salario"] = $this->periodo->obtenerSalarioPeriodo($ano_periodo, $mes_periodo);
        $this->load->view("layout", $data);
    }

    public function cierreEfectivoPeriodo() {
        $this->load->model("periodo");
        $this->load->model("control");
        $ano = $this->input->post("ano");
        $mes = $this->input->post("mes");
        if ($this->periodo->validaCierre($ano, $mes)) {
            //Se cierra el periodo, se mantiene la novedad-estado del periodo anterior, y se duplican las fuentes para el nuevo periodo en novedad y estado (5-0).
            $this->control->cierrePeriodoActual($ano, $mes);
            echo "El periodo ha sido cerrado.";
        } else {
            //El periodo ya esta cerrado
            echo "Este periodo ya ha sido cerrado.";
        }
    }

    //Cierra la sesion del usuario cuando se da click en la opcion salir del menu	
    public function cerrarSesion() {
        $this->load->helper("url");
        $this->load->library("session");
        $this->session->sess_destroy();
        redirect("login", "refresh");
    }

    public function generarPazySalvo() {
        $this->load->library("session");
        $this->load->helper("dompdf_helper");
        $this->load->model("envioform");
        /* if($this->session->userdata("nro_establecimiento")!=0)
          {
          $nro_establecimiento = $this->session->userdata("nro_establecimiento");
          }
          else
          {
          $nro_establecimiento = $this->input->post("nro_establecimiento");
          } */
        $nro_establecimiento = $this->input->post("nro_establecimiento");
        //$nro_orden = $this->session->userdata("nro_orden"); 
        $nro_orden = $this->input->post("nro_orden");
        $uni_local = $this->session->userdata("uni_local"); //
        $ano = $this->session->userdata("ano_periodo");
        $mes = $this->session->userdata("mes_periodo");
        //Obtengo los datos para generar el paz y salvo
        $data["pyz"] = $this->envioform->datosPazYSalvo($nro_orden, $nro_establecimiento, $ano, $mes);
        $this->load->view("pazysalvo_1", $data);
        //$html = $this->load->view("pazysalvo",$data,true);
        //generarPdf($html,'pazysalvo','letter','portrait');                
    }

    /*     * **************************************************
     * FUNCIONES AJAX PARA EL MODULO DE ADMINISTRACION
     * ************************************************** */

    //Actualiza el combo de las subsedes a partir de una sede escogida
    public function actualizarSubsedes() {
        $this->load->model("subsede");
        $idsede = $this->input->post("id");
        $subsedes = $this->subsede->obtenerSubsedesID($idsede);
        echo '<option value="-" selected="selected">Seleccione</option>';
        for ($i = 0; $i < count($subsedes); $i++) {
            echo '<option value="' . $subsedes[$i]["id"] . '">' . $subsedes[$i]["nombre"] . '</option>';
        }
    }

    //Insertat / Agregar una nueva empresa desde el directorio de fuentes del administrador
    public function insertarEmpresa() {
        $this->load->model("directorio");
        $this->load->model("usuario");
        foreach ($_POST as $nombre_campo => $valor) {
            $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
            eval($asignacion);
        }

        $validar = $this->usuario->validaRegistroEmpresa($txtNitEmpresa, $txtNroOrden);
        if ($validar == 0) {  //Validar que la empresa no estÃ¯Â¿Â½ ya registrada.
            //La empresa no estÃ¯Â¿Â½ registrada. Debe agregarse el registro
            $nit = $txtNitEmpresa . $txtNitDigValida;
            $this->directorio->insertarEmpresa($txtNroOrden, $nit, $txtRazonSocial, $txtNomComercial, $txtSigla, $txtDireccion, $txtTelefono, $txtFax, $idaano = 0, $txtPagWeb, $txtEmail, $cmbDepartamento, $cmbCiudad);
            echo "La empresa ha sido registrada.";
        } else if ($validar == 1) {
            //La empresa ya estÃ¯Â¿Â½ registrada. Retorno el Nro de orden.
            echo "El Nro. de orden de la empresa ya se encuentra registrado. ($txtNroOrden)";
        } else if ($validar == 2) {
            //El nÃ¯Â¿Â½mero de nit de la empresa que se intenta registrar ya existe.
            echo "El NIT de la empresa ya se encuentra registrado. ($nit)";
        }
    }

    //Insertar / Agregar una nueva fuente desde el directorio de fuentes del administrador
    public function insertarFuente() {
        $this->load->model("control");
        $this->load->model("empresa");
        $this->load->model("usuario");
        $this->load->model("directorio");
        $this->load->model("establecimiento");
        foreach ($_POST as $nombre_campo => $valor) {
            $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
            eval($asignacion);
        }

        //Validar que el establecimiento no estÃ¯Â¿Â½ registrado ya
        if (!$this->usuario->validaRegistroEstablecimiento($txtNitEmpresa)) {
            $this->establecimiento->insertarEstablecimiento($txtNumEstab, $txtNitEmpresa, $txtNomEstab, $txtDirEstab, $idtelefono, $idcorreo, $cmbDeptoEstab, $cmbMpioEstab, $cmbComercial, $nom_contacto, $observaciones);
            $data['mensaje'] = 'Registro exitoso!';
        } else {
            $data['mensaje'] = 'El cliente ya se encuentra registrado!';
        }
        echo $this->load->view('ajxfuentesadd', $data, true);
    }

    //Insertar / Agregar una nueva fuente desde el directorio de fuentes del administrador
    public function insertarGuia() {
        $this->load->model("control");
        $this->load->model("empresa");
        $this->load->model("usuario");
        $this->load->model("directorio");
        $this->load->model("establecimiento");
        foreach ($_POST as $nombre_campo => $valor) {
            $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
            eval($asignacion);
        }
        $idusaurio = $this->session->userdata('id');
        $fechaRegistro = date("Y-m-d H:i:s");

        if ($idoperarioext == '-') {
            $idoperarioext1 = 0;
        } else {
            $idoperarioext1 = $idoperarioext;
        }
        
        if (!isset($estadoRecogida)) {
            $estadoRecogida1 = 0;
        } else {
            $estadoRecogida1 = $estadoRecogida;
        }
        if(!isset($idoperarioext)){
            $idoperarioext1 = 0;
        } else {
            $idoperarioext1=$idoperarioext;
        }
        if(!isset($numremesa)){
            $numremesa1 = 0;
        } else {    
            $numremesa1=$numremesa;
        }
        if(!isset($numplaca)){
            $numplaca1 = 0;
        } else {
            $numplaca1=$numplaca;
        }
        if(!isset($idoperario)){
            $idoperario1 = 0;
        } else {
            $idoperario1=$idoperario;
        }
        if(!isset($estadocarga)){
            $estadocarga1 = 1;
        } else {
            $estadocarga1=$estadocarga;
        }
        
        
        $fecharec = explode("/", $txtFecRecogida);
        $fecharecog = $fecharec[2] . '-' . $fecharec[1] . '-' . $fecharec[0];
        $fechaent = explode("/", $txtFecEntrega);
        $fechaentr = $fechaent[2] . '-' . $fechaent[1] . '-' . $fechaent[0];

        //Validar que el establecimiento no estÃ¯Â¿Â½ registrado ya
        //if (!$this->usuario->validaRegistroEstablecimiento(0, $txtNumEstab)){
        $this->control->insertarControlGuia($numremesa1, $idestablecimiento, $fecharecog, $fechaentr, $iddestinatario, $formaPago, $pesokg, $alto, $ancho, $largo, $unidades, $pesocobrar, $valorDeclarado, $flete, $costomanejo, $totalflete, $tipocarga, $idoperario1, $numplaca1, $idoperarioext1, $estadocarga1, $estadoRecogida1, $observaciones, $idusaurio, $fechaRegistro);
        echo "La guia ha sido registrada.";
        //}			
        /* else{
          echo "No se puede agregar el establecimiento. El establecimiento ya se encuentra registrado.";
          } */

        redirect('/administrador/control', 'refresh');
    }

    //Procesa el ajax para mostrar los establecimientos en datatable
    public function directorioClientes() {
        $this->load->model("directorio");
        $data["fuentes"] = $this->directorio->obtenerFuentesTodas();
        $this->load->view("ajxdirectorio", $data);
    }

    //Procesa el ajax para mostrar las guas en datatable
    public function directorioControl() {
        $this->load->model("control");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data["usuario"] = $tipo_usuario;
        if ($tipo_usuario == 5 || $tipo_usuario == 3 || $tipo_usuario==8) {
            $id_usuario = $this->session->userdata('num_identificacion');
        } else {
            $id_usuario = 0;
        }

        $data["control"] = $this->control->obtenerGuias($id_usuario);
        // var_dump($data["control"]);
        $this->load->view("ajxcontrol", $data);
    }

    //Procesa el ajax para mostrar las guias por ciudad
    public function dirControlCiudad() {
        $this->load->model("control");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data["usuario"] = $tipo_usuario;
        if ($tipo_usuario == 5 || $tipo_usuario == 3) {
            $id_usuario = $this->session->userdata('num_identificacion');
        } else {
            $id_usuario = 0;
        }

        $data["control"] = $this->control->obtenerGuias($id_usuario);
        // var_dump($data["control"]);
        $this->load->view("ajxcontrolCiudad", $data);
    }

    public function procesaObtenerEstab() {
        $this->load->model("establecimiento");
        $data["establecimiento"] = $this->establecimiento->obtenerEstablecimientos();

        for ($i = 0; $i < count($data["establecimiento"]); $i++) {
            $datas[] = array('<option value="' . $establecimiento[$i]["id_establecimiento"] . '">' . $establecimiento[$i]["establecimiento"] . '</option></select>');
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($control),
            "iTotalDisplayRecords" => count($control),
            "aaData" => $datas,);
        echo json_encode($results);
    }

    //Procesa el ajax para mostrar los destinatarios en datatable
    public function directorioDestinatarios() {
        $this->load->model("usuario");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        if($tipo_usuario == 8){
            $id_usuario = $this->session->userdata('num_identificacion');
        } else {
            $id_usuario = 0;
        }
        $data["destinatarios"] = $this->usuario->obtenerDestinatariosPagina($id_usuario);
        $this->load->view("ajxdestinatarios", $data);
    }

    //Procesa el ajax para mostrar los usuarios en datatable
    public function directorioUsuarios() {
        $this->load->model("usuario");
        $data["usuarios"] = $this->usuario->obtenerUsuariosPagina();

        $this->load->view("ajxusuarios", $data);
    }

    //Procesa el ajax para mostrar los usuarios en datatable
    public function directorioOperarios() {
        $this->load->model("usuario");
        $data["usuarios"] = $this->usuario->obtenerOperariosPagina();

        $this->load->view("ajxoperarios", $data);
    }

    //Remueve las fuentes del directorio de fuentes. Operacion DELETE sobre el directorio de fuentes. Se eliminan los datos del periodo actual. 
    //Si existen datos de periodos anteriores, estos datos se mantienen.
    public function removerFuente() {
        $this->load->model("usuario");
        $ano_periodo = $this->session->userdata("ano_periodo");
        $mes_periodo = $this->session->userdata("mes_periodo");
        foreach ($_POST as $nombre_campo => $valor) {
            $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
            eval($asignacion);
        }
        $arrayData = explode("-", $cmbFuente);
        $nro_orden = $arrayData[0];
        $nro_establecimiento = $arrayData[1];
        $this->usuario->eliminarFuente($nro_orden, $nro_establecimiento, $ano_periodo, $mes_periodo);
        echo $this->db->last_query();
    }

    //Funcion para descargar el directorio. Genera un archivo Excel donde se muestran las contraseÃ¯Â¿Â½as del directorio sin encriptar
    public function descargaDirectorio() {
        $this->load->model("usuario");
        $data["usuarios"] = $this->usuario->reportePasswords();
        header('Content-type: application/vnd.ms-excel; charset=UTF-8');
        header("Content-Disposition: attachment; filename=reporte.xls");
        $this->load->view("usuariosDir", $data);
    }

    //Descarga del directorio de usuarios
    /* public function directorioUsuarios(){
      $this->load->model("usuario");
      $usuarios = $this->usuario->reporteDirectorioUsuarios();
      $sheet = $this->phpexcel->getActiveSheet();
      $sheet->getColumnDimension('A')->setWidth(30);
      $sheet->getColumnDimension('B')->setWidth(30);
      $sheet->getColumnDimension('C')->setWidth(30);
      $sheet->getColumnDimension('D')->setWidth(30);
      $sheet->getColumnDimension('E')->setWidth(30);
      $sheet->setCellValue('A1','ID. Usuario');
      $sheet->setCellValue('B1','Nit - Nro. Identificacion');
      $sheet->setCellValue('C1','Nombre Usuario');
      $sheet->setCellValue('D1','Login');
      $sheet->setCellValue('E1','Password');
      $styleArray = array('font' => array('bold' => true, 'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE ));
      $sheet->getStyle('A1')->applyFromArray($styleArray);
      $sheet->getStyle('B1')->applyFromArray($styleArray);
      $sheet->getStyle('C1')->applyFromArray($styleArray);
      $sheet->getStyle('D1')->applyFromArray($styleArray);
      $sheet->getStyle('E1')->applyFromArray($styleArray);
      for ($i=0; $i<count($usuarios); $i++){
      $codA = "A".($i+3);
      $codB = "B".($i+3);
      $codC = "C".($i+3);
      $codD = "D".($i+3);
      $codE = "E".($i+3);
      $sheet->setCellValue($codA,$usuarios[$i]["id"]);
      $sheet->setCellValue($codB,$usuarios[$i]["num_identificacion"]);
      $sheet->setCellValue($codC,strtoupper($usuarios[$i]["nom_usuario"]));
      $sheet->setCellValue($codD,$usuarios[$i]["log_usuario"]);
      $sheet->setCellValue($codE,$usuarios[$i]["pas_usuario"]);
      }
      $writer = new PHPExcel_Writer_Excel5($this->phpexcel);
      header('Content-type: application/vnd.ms-excel');
      $writer->save('php://output');
      } */

    //Muestra el formulario para realizar la captura de datos e ingresar los datos de un nuevo usuario del sistema (No para fuentes)
    public function INSUsuario() {

        $this->load->model("tipodocs");
        $this->load->model("rol");

        $data["tipodoc"]["id"] = $this->tipodocs->obtenerTipoDocumentos();
        //$data["roles"] = $this->rol->obtenerRoles();

        $this->load->view("ajxusuarioins", $data);
    }

    //Busca en la base de datos si el numero de identificacion del usuario que se esta creando ya estÃ¯Â¿Â½ creado en la base de datos
    public function validaNitLogin() {
        $this->load->model("usuario");
        $tipo = $this->input->post("tipodoc");
        $numero = $this->input->post("numdoc");
        $login = $this->input->post("login");
        $valid1 = $this->usuario->numIdentificacionExiste($tipo, $numero);
        $valid2 = $this->usuario->existeLogin($login);
        if (($valid1 == true) || ($valid2 == true)) {
            $validar = false;
            $error = "El usuario ya existe.";
        } else {
            $validar = true;
            $error = "&nbsp;";
        }
        $arrayError = array('valid' => $validar,
            'error' => $error);
        echo json_encode($arrayError);
    }

    //Busca en la base de datos si el numero de identificacion del operario que se esta creando ya estÃ¡ en la base de datos
    public function validaOperario() {
        $this->load->model("usuario");
        $tipo = $this->input->post("tipodoc");
        $numero = $this->input->post("numdoc");

        $valid1 = $this->usuario->numIdentOperarioExiste($tipo, $numero);
        //$valid2 = $this->usuario->existeLogin($login);
        if ($valid1 == true) {
            $validar = false;
            $error = "El operario ya existe.";
        } else {
            $validar = true;
            $error = "&nbsp;";
        }
        $arrayError = array('valid' => $validar,
            'error' => $error);
        echo json_encode($arrayError);
    }

    //Busca en la base de datos si el numero de identificacion del destinatario que se esta creando ya esta en la base de datos
    public function validaCliente() {
        $this->load->model("usuario");
        $nitEmpresa = $this->input->post("nitEmpresa");
        $valid1 = $this->usuario->validaRegistroEstablecimiento($nitEmpresa);
        //$valid2 = $this->usuario->existeLogin($login);
        if ($valid1 == true) {
            $validar = false;
            $error = "El cliente ya existe.";
        } else {
            $validar = true;
            $error = "&nbsp;";
        }
        $arrayError = array('valid' => $validar,
            'error' => $error);
        echo json_encode($arrayError);
    }

    

    //Agrega el registro de un nuevo usuario creado en el sistema a la B.D.
    public function insertarUsuario() {
        $this->load->helper("url");
        $this->load->library("danecrypt");
        $this->load->library("general");
        $this->load->model("usuario");
        foreach ($_POST as $nombre_campo => $valor) {
            $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
            eval($asignacion);
        }
        $nro_orden = 0; //No se asigna un numero de orden
        $nro_establecimiento = 0; //No se asigna un numero de establecimiento
        $fecini = $this->general->formatoFecha($txtFecCreacion, "/");
        $fecfin = $this->general->formatofecha($txtFecVencimiento, "/");
        $password = $this->danecrypt->encode($txtPassword);
        //$this->usuario->insertarUsuario($txtNumId, $txtNomUsuario, $txtLogin, $password, $txtEmail, $fecini, $fecfin, $nro_orden, $cmbRol, $cmbsede, $cmbSubsede, $cmbTipoDocumento);
        //$encryptpass = $this->danecrypt->codificar($password);
        $this->usuario->insertarUsuario($txtNumId, $txtNomUsuario, $txtLogin, $password, $txtEmail, $fecini, $fecfin, 0, 0, $numtelefono, $cmbTipoDocumento, $cmbRol, 0, 0);
        redirect('/administrador/usuarios', 'refresh');
    }

    //Agrega el registro de un nuevo operario creado en el sistema a la B.D.
    public function insertarOperario() {
        $this->load->helper("url");
        $this->load->library("danecrypt");
        $this->load->library("general");
        $this->load->model("usuario");
        $usuario = $this->session->userdata("num_identificacion");
        foreach ($_POST as $nombre_campo => $valor) {
            $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
            eval($asignacion);
        }
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        if ($tipo_usuario == 7) {
            $estado = 0;
        } else {
            $estado = 1;
        }
        $fecini = $this->general->formatoFecha($txtFecCreacion, "/");

        $this->usuario->insertarOperario($cmbTipoDocumento, $txtNumId, $txtNomUsuario, $teloperario, $numplaca, $fecini, $usuario, $estado);
        redirect('/administrador/operarios', 'refresh');
    }

    //Paginador para la busqueda de resultados de la busqueda de formularios
    public function pagerBuscadorFuentes() {
        $this->load->library("session");
        $this->load->library("paginador2");
        $this->load->model("directorio");
        $buscar = $this->input->post("buscar");
        $ano_periodo = $this->session->userdata("ano_periodo");
        $mes_periodo = $this->session->userdata("mes_periodo");
        $opcion = $this->input->post("opcion");
        $buscar = $this->input->post("buscar");
        $pagina = $this->input->post("pagina");
        $desde = ($pagina - 1) * $this->paginador2->getRegsPagina();
        $this->paginador2->setFuncion("administrador/pagerBuscadorFuentes");
        $data["total"] = $this->directorio->contarDirectorio($opcion, $buscar, $ano_periodo, $mes_periodo);
        $data["fuentes"] = $this->directorio->buscarDirectorioPagina($desde, $opcion, $buscar, $ano_periodo, $mes_periodo);
        $data["paginador"] = $this->paginador2->paginar('divResultados', $pagina, $data["total"]);
        $this->load->view("ajxformularios", $data);
    }

    //Actualiza un combo de Municipios con base en un combo de departamentos
    public function actualizarMunicipios() {
        $this->load->model("divipola");
        $iddepto = $this->input->post("id");
        $municipios = $this->divipola->obtenerMunicipios($iddepto);
        echo '<option value="-" selected="selected">Seleccione</option>';
        for ($i = 0; $i < count($municipios); $i++) {
            echo '<option value="' . $municipios[$i]["codigo"] . '">' . $municipios[$i]["nombre"] . '</option>';
        }
    }

    public function consultaFuentesAsignadas() {
        $this->load->model("control");
        $ano_periodo = $this->session->userdata("ano_periodo");
        $mes_periodo = $this->session->userdata("mes_periodo");
        $rol = $this->input->post("rol");
        $id_usuario = $this->input->post("usuario");
        $fuentes = 0;
        echo json_encode($fuentes);
    }

   

    //Function para eliminar los datos de una fuente. Elimina todos los datos de una fuente
    public function eliminarFuente() {
        $this->load->model("establecimiento");
        $id_usuario = $this->session->userdata("id");
        $nro_establecimiento = $this->input->post("numest");
        $ano_periodo = $this->session->userdata("ano_periodo");
        $mes_periodo = $this->session->userdata("mes_periodo");
        $this->establecimiento->inactivarCliente($nro_establecimiento);
    }

    //funcion para actualizar los datos de una fuente
    public function actualizarDatosFuente() {
        $this->load->model("procedure");
        $this->load->model("empresa");
        $this->load->model("establecimiento");
        //Recibir todas las variables que vengan enviadas por POST
        foreach ($_POST as $nombre_campo => $valor) {

            $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
            eval($asignacion);
        }

        //Actualizar los datos del establecimiento
        $this->establecimiento->actualizarEstablecimiento($IdEstablecimiento, $idnomcomest, $idnitest, $iddireccest, $idtelnoest, $idcorreoest, $nom_contacto, $cmbDeptoEst, $cmbMpioEst, $estado_establecimiento, $observaciones);
        //echo "<script>alert('¡Registro exitoso!.');</script>";
        redirect('/administrador/directorio', 'refresh');
    }

    //funcion para actualizar los datos de un destintatario
    public function actualizarDatosDestinatario() {
        $this->load->model("procedure");
        $this->load->model("empresa");
        $this->load->model("usuario");
        $this->load->model("establecimiento");
        //Recibir todas las variables que vengan enviadas por POST
        foreach ($_POST as $nombre_campo => $valor) {

            $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
            eval($asignacion);
        }

        //Actualizar los datos del destinatario
        $this->usuario->actualizarDestinatario($id_destinatario, $idnomdest, $identificacion, $tipoDocumento, $direccion, $telefono, $idcorreoest, $nom_contacto, $cmbDeptoEst, $cmbMpioEst);

        //echo "<script>alert('¡Registro exitoso!.');</script>";
        redirect('/administrador/destinatarios', 'refresh');
    }

    public function cambiarFuente() {
        $this->load->model("procedure");
        $nro_orden = $this->input->post("numord");
        $nro_establecimiento = $this->input->post("numest");
        $ano_periodo = $this->session->userdata("ano_periodo");
        $mes_periodo = $this->session->userdata("mes_periodo");
        $novedad = $this->input->post("novedad");
        $estado = $this->input->post("estado");
        $usuario = 0; //Esta opcion siempre la ejecuta el administrador
        $this->procedure->cambiarEstadoFormulario($nro_orden, $nro_establecimiento, $ano_periodo, $mes_periodo, $novedad, $estado, $usuario);
    }

    public function obtenerSalario() {
        $this->load->model("periodo");
        $ano_periodo = $this->session->userdata("ano_periodo");
        $mes_periodo = $this->session->userdata("mes_periodo");
        $salario = $this->periodo->obtenerSalarioPeriodo($ano_periodo, $mes_periodo);
        echo json_encode($salario);
    }

    //Muestra el consolidado de los mÃ¯Â¿Â½dulos II, III y IV para las empresas.)
    public function imprimirGuia($id_guia) {
        $this->load->model("control");
        $this->load->model("usuario");
        $tipoUsuario = $this->session->userdata("tipo_usuario");
        $nom_usuario = $this->session->userdata("nombre");
        $data["tipo_usuario"] = $this->session->userdata("tipo_usuario");
        $data["nom_usuario"] = $nom_usuario;
        $data["controller"] = $this->session->userdata("controlador");
        $data["menu"] = "adminmenu";
        $data["view"] = "imprimir";
        $data["guia"] = $this->control->obtenerGuiasId($id_guia);

        $this->load->view("layout_1", $data);
    }

    //Muestra el detalle del segimiento de las guias
    public function detalleGuia($id_guia) {
        $this->load->model("control");
        $data["controller"] = $this->session->userdata("controlador");
        $data["guia"] = $this->control->obtenerGuiasId($id_guia);
        $data["estados"] = $this->control->obtenerEstatus($id_guia);
        // $data["view"] = "vistadetalleguia";
        $data["tipo_usuario"]= $this->session->userdata("tipo_usuario");
        
        echo $this->load->view('vistadetalleguia', $data, true);
        //$this->load->view("layout", $data);
    }

}

//EOC
?>