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
		    	$data["idestab"]=$this->input->post("idestab");
		    	$data["iddestin"]=$this->input->post("iddestinatario");
		    	$data["tipTar"]=$this->input->post("tipo_tarifa");

		    	$data["estab"] = $this->establecimiento->obtenerDatosEstablecimiento($data["idestab"]);
		    	$data["dest"] = $this->usuario->obtenerDestinatariosId($data["iddestin"]);
		    	$ciudadDest=$data["dest"]["ciudadDest"];
		    	$nroIdentificacion= $data["dest"]["nro_identificacion"];
		    	$this->session->set_userdata("nro_identificacion", $nroIdentificacion);
		    	$data["IdTarifa"]= $this->tarifas->obtenerTarifasEstablecimiento($data["idestab"], $ciudadDest);
		    	//echo count($data["dest"])."MMM";
		    	$data["municipios"] = $this->usuario->obtenerCiudadesDest($nroIdentificacion);
		    	$data["ulimoIdGuia"] = $this->control->obtenerUltimoIdGuia();
		    	$ulimoIdGuia = $data["ulimoIdGuia"]["id_control"]+1;
		    	$i=0;
		    	foreach ($_POST as $nombre_campo => $valor) {
		    		//var_dump($nombre_campo)."<br>";
		    		//var_dump($valor)."<br>";
		    		$cadena = $nombre_campo;
				    $buscartarifa = "idtarifa";
				    $resulttarifas = strpos($cadena, $buscartarifa);

				    $buscarcantidad = "cantidad";
				    $resultcantidad= strpos($cadena, $buscarcantidad);

				    $buscarvalor_tarifa = "valor_tarifa";
				    $resultvalor_tarifa= strpos($cadena, $buscarvalor_tarifa);
				  	
				    $_POST['idtarifa'][$i]=isset($_POST['idtarifa'][$i])?$_POST['idtarifa'][$i]:0;
			    	
				    //Rescata solamente lo que diga valores
				    //if($resulttarifas !== FALSE || $resultcantidad !== FALSE || $resultvalor_tarifa !== FALSE)
				    //{
				    if($_POST['idtarifa'][$i] != 0){
				    	//Calcula el valor de la tarifa por la cantidad
				    	$subtotal[$i]=$_POST['cantidad'][$i]*$_POST['valor_tarifa'][$i];
				    	//Compara si el cálculo anterior es menor a la mínima, el total corresponde a la mínima de lo contrario cobra el resultado del cálculo anterior.
				    	if($subtotal[$i] < $_POST['valor_minima'][$i]){
				    		$total[$i]=$_POST['valor_minima'][$i];
				    	}else{
				    		$total[$i]=$subtotal[$i];
				    	}
				    	//Obtiene los registros de la tabla txtar_admin_ctrl_tarifas
				    	$data["hayTarifas"] = $this->tarifas->obtenerCtrlTarifas($ulimoIdGuia,$_POST['idtarifa'][$i]);
				    	//Si hay registros de tarifas en las guias
				    	if(count($data["hayTarifas"])>0){
				    		
				    		if($data["hayTarifas"]["idtarifa"] == $_POST['idtarifa'][$i]){
					    		echo ""; 
					    	}
			        	}else{
			        		//Registra en la tabla txtar_admin_ctrl_tarifas
			        		$this->tarifas->registrarCtrlTarifas($ulimoIdGuia, $_POST['idtarifa'][$i], $_POST['cantidad'][$i], $_POST['valor_tarifa'][$i], $total[$i]);
			        	}
		            }
		        $i++;
		        }
		       	$data["ctrlTarifas"] = $this->tarifas->obtenerCtrlTarifasId($ulimoIdGuia);
		       	$data["sumaTarifas"] = $this->tarifas->obtenerSumaCtrlTar($ulimoIdGuia);
	    		
		        $idusaurio = $this->session->userdata('id');
		        $fechaRegistro = date("Y-m-d H:i:s");
	         	//$this->control->registrarGuia($ulimoIdGuia, 0, $_POST['idestab'], $_POST['iddestinatario'], 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', $idusaurio, $fechaRegistro);
		    	//var_dump($_REQUEST); 
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