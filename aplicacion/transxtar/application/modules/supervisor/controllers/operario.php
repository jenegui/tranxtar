<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Operario extends MX_Controller {
	
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
            $this->load->model("ficha");
            $data["controller"] = $this->session->userdata("controlador");
            $data["view"] = "administrador/operario";
            $data["menu"] = "administrador/adminmenu";
            $this->load->view("layout",$data);
		
	}
	
	

}//EOC