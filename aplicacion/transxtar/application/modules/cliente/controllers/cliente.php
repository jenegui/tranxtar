<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cliente extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library("session");
        $this->load->library("validarsesion");
    }

    /**
     * Controlador para el usuario supervisor
     * @author Jes�s Neira Guio - SJNEIRAG
     * @since Julio de 2015
     */
    public function index() {
        $this->load->model("control");
        $this->load->model("ficha");
        $data["controller"] = $this->session->userdata("controlador");
        $data["view"] = "cliente";
        $data["menu"] = "clientemenu";
        $this->load->view("layout", $data);
    }
    
     //function para editar los datos de la fuente en el directorio de fuentes
    public function editarFuente() {
        $this->load->model("divipola");
        $this->load->model("empresa");
        $this->load->model("establecimiento");
        $data["controller"] = "administrador";
        
        $nro_establecimiento = $this->session->userdata("num_identificacion");
       
        $data["view"] = "detalle";
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data['tipo_usuario'] = $this->session->userdata("controlador");
        $data["nom_usuario"] = $nom_usuario;
        $data["menu"] = "clientemenu";
        $data["departamentos"] = $this->divipola->obtenerDepartamentos();
        $data["municipios"] = $this->divipola->obtenerMunicipios("");
        $data["establecimiento"] = $this->establecimiento->obtenerDatosEstablecimiento($nro_establecimiento);

        $this->load->view("layout_1", $data);
    }
    
     //funcion para actualizar los datos de una fuente
    public function actualizarDatosFuente() {
        //$this->load->model("procedure");
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
        redirect('/cliente/editarFuente', 'refresh');
    }
    
     //function para editar los datos del destinatario en el directorio de fuentes
    public function editarDestinatario() {
        $this->load->model("divipola");
        $this->load->model("empresa");
        $this->load->model("usuario");
        $this->load->model("tipodocs");
        $data["controller"] = $this->session->userdata("controlador");
       
        $nro_ident = $this->session->userdata("num_identificacion");
        $data["tipodocs"] = $this->tipodocs->obtenerTipoDocumentos();

        $data["view"] = "editardest";

        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data['tipo_usuario'] = $this->session->userdata("controlador");
        $data["nom_usuario"] = $nom_usuario;
        $data["menu"] = "clientemenu";
        $data["departamentos"] = $this->divipola->obtenerDepartamentos();
        $data["municipios"] = $this->divipola->obtenerMunicipios("");
        $data["destinatario"] = $this->usuario->obtenerDatosDestinatario($nro_ident);
        $this->load->view("layout", $data);
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
        
        $data["menu"] = "clientemenu";

        $data["view"] = "control";
        //echo "nrnbn";
        $data["tipodocs"] = $this->tipodocs->obtenerTipoDocumentos();

        $data["usuario"] = $tipo_usuario;

        //Configuracion del paginador
        $config = array();

        $config["base_url"] = site_url("traficoseguridad/control");
        $id_usuario = $this->session->userdata("num_identificacion");
        

        $data["control"] = $this->control->obtenerGuias($id_usuario);



        $this->load->view("layout", $data);
    }

    //Procesa el ajax para mostrar las guas en datatable
    public function directorioControl() {
        $this->load->model("control");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data["usuario"] = $tipo_usuario;
       
        $id_usuario = $this->session->userdata('num_identificacion');
        

        $data["control"] = $this->control->obtenerGuias($id_usuario);
        // var_dump($data["control"]);
        //$this->load->view("ajxcontrol", $data);
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
        $data["menu"] = "traficomenu";
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
        $data["estados"] = $this->control->obtenerEstados($id_control);
        $this->load->view("layout", $data);
    }
    
    
        //funcion para editar el estado de las Guias
	public function actualizarDatosControlTS(){
	    $this->load->model("empresa");
            $this->load->model("usuario");
            $this->load->model("control");
           
            //Recibir todas las variables que vengan enviadas por POST
            foreach($_POST as $nombre_campo => $valor){
                    echo $nombre_campo."=>".$valor;
                    $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";  			
                    eval($asignacion);
            }
           
            $idusaurio=$this->session->userdata('id');
            $fechaRegistro= date("Y-m-d H:i:s"); 

            if(!isset($pesokg)){
                $pesokg1=0;
            }else{
                $pesokg1=$pesokg;
            }
            if(!isset($pesovol)){
                $pesovol1=0;
            }else{
                $pesovol1=$pesovol;
            }
            if($idoperarioext=='-'){
                $idoperarioext1=0;
            }else{
                $idoperarioext1=$idoperarioext;
            }
           
            $fecharec= explode("/",$txtFecRecogida);
            $fecharecog=$fecharec[2].'-'.$fecharec[1].'-'.$fecharec[0];
            $fechaent= explode("/",$txtFecEntrega);
            $fechaentr=$fechaent[2].'-'.$fechaent[1].'-'.$fechaent[0];
            $fecha_actualizacion= date("Y-m-d H:i:s"); 
            $observ=$observaciones;
            //Actualizar los datos del destinatario
            $this->control->actualizarDatosControlTS($id_control, $idestablecimiento, $iddestinatario, $idoperario, $numplaca, $idoperarioext, $estadocarga, $fecha_actualizacion);
            
            if($nomOperarioInt!=''){
                $nomoperario=$nomOperarioInt;
            }else{
                $nomoperario=$nomOperarioExt;
            }
            if($numplacaint!=''){
                $numplaca=$numplacaint;
            }else{
                $numplaca=$numplacaext;
            }
            
            if($numtelint!=''){
                $numtel=$numtelint;
            }else{
                $numtel=$numtelext;
            }
            
            $this->control->registrarEstados($id_control, $estadocarga, $fecha_actualizacion, $observaciones, $idusaurio);
                                                   
            /*if($this->control->actualizarDatosControlTS){
                //redirect("/administrador/control", "refresh");
            }else{
                echo "No";
            }*/
	}

    public function cerrarSesion() {
        $this->load->helper("url");
        $this->load->library("session");
        $this->session->sess_destroy();
        redirect("login", "refresh");
    }

}

//EOC