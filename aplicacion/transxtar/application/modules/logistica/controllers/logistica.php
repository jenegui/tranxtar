<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para el modulo de logistica de RMMH
 * @author Daniel Mauricio D�az Forero - DMDiazF
 * @since  Julio 30 de 2012
 */


class Logistica extends MX_Controller {
	
    public function __construct(){
        parent::__construct();
        $this->load->library("pagination");
        $this->load->library("danecrypt"); 
        $this->load->library('phpexcel/PHPExcel');
        $this->load->library("validarsesion");
    }
	
    //Funcion principal. Se ejecuta por defecto al cargar el controlador (Muestra la funcion Directorio)
    public function index(){
        $this->load->model("periodo");				
        $nom_usuario = $this->session->userdata("nombre");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        //var_dump($this->session->userdata);
        $data['tipo_usuario']=$this->session->userdata("controlador");
        //$data['tipo_usuario']=$this->session->userdata("tipo_usuario");
        $data["nom_usuario"] = $nom_usuario;
        $data["controller"] = $this->session->userdata("controlador");
        $data["view"] = "logistica";
        $data["menu"] = "logmenu";
        $this->load->view("layout",$data);		
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
        $data["menu"] = "logmenu";
        $data["view"] = "control";
        $data["tipodocs"] = $this->tipodocs->obtenerTipoDocumentos();
        $data["usuario"] = $tipo_usuario;
        $id_usuario = 0;
        $data["control"] = $this->control->obtenerGuias($id_usuario);
        $this->load->view("layout", $data);
    }
    
    //Procesa el ajax para mostrar las guas en datatable
    public function directorioControl() {
        $this->load->model("control");
        $this->load->model("divipola");
        $tipo_usuario = $this->session->userdata("tipo_usuario");
        $data["usuario"] = $tipo_usuario;
        if ($tipo_usuario == 5 || $tipo_usuario == 3) {
            $id_usuario = $this->session->userdata('num_identificacion');
        } else {
            $id_usuario = 0;
        }

        $data["control"] = $this->control->obtenerGuias($id_usuario);
        // var_dump($data["control"]);
        $this->load->view("ajxcontrol", $data);
    }
    
    public function cerrarSesion() {
        $this->load->helper("url");
        $this->load->library("session");
        $this->session->sess_destroy();
        redirect("login", "refresh");
    }
	
}//EOC