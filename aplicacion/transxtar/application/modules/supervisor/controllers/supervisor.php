<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supervisor extends MX_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->load->library("session");
        $this->load->library("validarsesion");
	}
	
	/**
	 * Controlador para el usuario supervisor
	 * @author Jes�s Neira Guio - SJNEIRAG
	 * @since Julio de 2015
	 */
	
	public function index(){
            $this->load->model("control");
            
            $nom_usuario = $this->session->userdata("nombre");
            $tipo_usuario = $this->session->userdata("tipo_usuario");
            $data['tipo_usuario']=$this->session->userdata("tipo_usuario");
            $data["controller"] = $this->session->userdata("controlador");
            $data["noAprobadas"]=$this->control->obtenerGuiasNoAprobadas();
            echo $data["noAprobadas"]["estado"];
            $data["view"] = "administrador/supervisor";
            $data["menu"] = "administrador/adminmenu";
            $this->load->view("layout",$data);
		
	}
	
	

}//EOC