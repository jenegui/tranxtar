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
		    $this->load->model("tarifas");
		    if(isset($_REQUEST['idestab'])){
		    	$idestab=$this->input->post("idestab");
		    	$iddestin=$this->input->post("iddestinatario");

		    	$data["estab"] = $this->establecimiento->obtenerDatosEstablecimiento($idestab);
		    	$data["dest"] = $this->usuario->obtenerDestinatariosId($iddestin);
		    	$ciudadDest=$data["dest"]["ciudadDest"];
		    	$nroIdentificacion= $data["dest"]["nro_identificacion"];
		    	$this->session->set_userdata("nro_identificacion", $nroIdentificacion);
		    	$data["IdTarifa"]= $this->tarifas->obtenerTarifasEstablecimiento($idestab, $ciudadDest);
		    	//echo count($data["dest"])."MMM";
		    	$data["municipios"] = $this->usuario->obtenerCiudadesDest($nroIdentificacion); 
		    }else{
		    	$data["datosEstab="]=0;
		    }
		    $data["dest"] = $this->usuario->obtenerDestinatariosPagina(0);
		    $data["controller"] = $this->session->userdata("controlador");
           	$data["tipo_usuario"] = $this->session->userdata("tipo_usuario");
		    $data["id_usuario"] = $this->session->userdata('num_identificacion');
		    $data["establecimiento"] = $this->establecimiento->obtenerEstablecimientos();
		    $data["destinatario"] = $this->usuario->obtenerDestinatarios();
		    $data["operarios"] = $this->usuario->obtenerOperariosInternos();
		    $data["operariosExt"] = $this->usuario->obtenerOperariosExternos();
		    $data["estadocarga"] = $this->estado->estadoCarga();
		    $data["departamentos"] = $this->divipola->obtenerDepartamentos();
    		//$data["municipios"] = $this->divipola->obtenerMunicipios(0);
		    $data["usuario"] = $this->session->userdata("tipo_usuario");
            $data["view"] = "registroGuias";
            $data["menu"] = "administrador/adminmenu";
           // $this->load->view("layout_1",$data);
             $this->load->view("layout_1", $data);
	}

	//Obtiene la información del cliente para completar el formulario de registro guias
	public function obtenerGuiaCliente() {
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
            $data["view"] = "ajxregistroGuias";
            $data["menu"] = "administrador/adminmenu";
           echo $data["view"];
    }
	
	 //Actualiza un combo de Municipios con base en un combo de departamentos
    public function actualizarMunicipios() {
        $this->load->model("divipola");
        $this->load->model("usuario");
        $nro_identificacion=$this->session->userdata("nro_identificacion");
        $municipios = $this->usuario->obtenerCiudadesDest($nro_identificacion); //Obtiene las ciudades por destinario
        echo '<option value="-" selected="selected">Seleccione</option>';
        for ($i = 0; $i < count($municipios); $i++) {
            echo '<option value="'.$municipios[$i]["id_destinatario"].'">' . $municipios[$i]["nombre"] . '</option>';
        }
    }
    //Actualiza un combo de destinatarios 
    public function actualizarDestinatarios() {
        $this->load->model("divipola");
        $this->load->model("usuario");
        $this->load->model("establecimiento");
        $idCliente=$this->input->post("id");
        $data["estab"] = $this->establecimiento->obtenerDatosEstablecimiento($idCliente);
        $destinatarios = $this->usuario->obtenerDestinatariosPagina($data["estab"]['nit_establecimiento']); //Obtiene las ciudades por destinario
        echo '<option value="-" selected="selected">Seleccione</option>';
        for ($i = 0; $i < count($destinatarios); $i++) {
            echo '<option value="'.$destinatarios[$i]["id_destinatario"].'">' . $destinatarios[$i]["nombre_destinatario"].' - '.$destinatarios[$i]["fk_mpio"].' - '.$destinatarios[$i]["direccion_destinatario"]. '</option>';
        }
    }
	

}//EOC