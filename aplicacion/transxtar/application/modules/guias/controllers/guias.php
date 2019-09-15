<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guias extends MX_Controller {
	
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
            $this->load->model("usuario");
         	$this->load->model("establecimiento");
		    $this->load->model("usuario");
		    $this->load->model("estado");
		    $this->load->model("tipodocs");
		    $this->load->model("divipola");
		    $data["controller"] = $this->session->userdata("controlador");
           	$data["tipo_usuario"] = $this->session->userdata("tipo_usuario");
		    $data["id_usuario"] = $this->session->userdata('num_identificacion');
		    $data["establecimiento"] = $this->establecimiento->obtenerEstablecimientos();
		    $data["destinatario"] = $this->usuario->obtenerDestinatarios();
		    $data["operarios"] = $this->usuario->obtenerOperariosInternos();
		    $data["operariosExt"] = $this->usuario->obtenerOperariosExternos();
		    $data["estadocarga"] = $this->estado->estadoCarga();
		    $data["departamentos"] = $this->divipola->obtenerDepartamentos();
    		$data["municipios"] = $this->divipola->obtenerMunicipios(0);
		    $data["usuario"] = $this->session->userdata("tipo_usuario");
            $data["view"] = "registroGuias";
            $data["menu"] = "administrador/adminmenu";
           // $this->load->view("layout_1",$data);
             $this->load->view("layout_1", $data);
		
	}
	
	 //Actualiza un combo de Municipios con base en un combo de departamentos
    public function actualizarMunicipios() {
        $this->load->model("divipola");
        $this->load->model("usuario");
        $id = explode("-",$this->input->post('id'));
        $nro_identificacion=$id[1];	
        $municipios = $this->usuario->obtenerCiudadesDest($nro_identificacion); //Obtiene las ciudades por destinario
        echo '<option value="-" selected="selected">Seleccione</option>';
        for ($i = 0; $i < count($municipios); $i++) {
            echo '<option value="' . $municipios[$i]["codigo"] . '">' . $municipios[$i]["nombre"] . '</option>';
        }
    }
	

}//EOC