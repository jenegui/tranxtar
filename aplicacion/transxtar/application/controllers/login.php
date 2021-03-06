<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para la validacion de acceso mediante usuario y contrase�a
 * @author Daniel Mauricio D�az Forero - DMDiazF
 * @since  Marzo 06 de 2012
 */

class Login extends CI_Controller {
    
	//Carga la vista para el login de usuarios. Se carga por defecto al iniciar la aplicacion (ver aplication/config/routes.php)
	public function index(){
		$this->load->library("session");
		$this->session->sess_destroy();
		$this->config->load("sitio");
		$this->load->model("control");
                $this->load->model("divipola");
		$data["departamentos"] = $this->divipola->obtenerDepartamentos();
		$data["municipios"] = $this->divipola->obtenerMunicipios("");
	  	$data["nombre"]  = $this->session->userdata("nombre");
	  	$data["controller"] = "login";
		$data["view"] = "login/login";
		$this->load->view('layout',$data);		
	}
	
        //Actualiza un combo de Municipios con base en un combo de departamentos
	public function actualizarMunicipios(){
		$this->load->model("divipola");
		$iddepto = $this->input->post("id");
		$municipios = $this->divipola->obtenerMunicipios($iddepto);
		echo '<option value="-" selected="selected">Seleccione</option>';
		for ($i=0; $i<count($municipios); $i++){
			echo '<option value="'.$municipios[$i]["codigo"].'">'.$municipios[$i]["nombre"].'</option>';	
		}
	}
	//Recibe los datos del usuario y valida contra la B.D. que el usuario sea v�lido.
	public function validar(){		
		$this->load->model("usuario");
		$this->load->helper("url");
		$login = $this->input->post("txtLogin"); //Recibir por post con XSS_CLEAN
		$password = $this->input->post("txtPassword"); //Recibir por post con XSS_CLEAN	
                if ($this->usuario->validarUsuario($login, $password)){
                    $this->usuario->redireccionarUsuario();
                }
		else{
                   $this->session->set_userdata('error_login', 1);
                   redirect('/login', 'location', 301); 
		}		
	}
        //Recibe los datos del usuario y valida contra la B.D. que el usuario sea v�lido.
	public function seguimiento(){
                $this->load->model("control");
		$this->load->helper("url");
		$num_guia = $this->input->post("numGuia"); 
                $data["estadoGuia"] = $this->control->obtenerGuiasId($num_guia);
                
                if(count($data["estadoGuia"])>0){
                    $estado_guia=$data["estadoGuia"]['nom_estado'];
                    $placaNo=$data["estadoGuia"]['nro_placa'];
                    $this->session->set_userdata('guia', $estado_guia);
                    $this->session->set_userdata('placa', $placaNo);
                    $this->session->set_userdata('si', 1);
                    
                }else{
                    $this->session->unset_userdata('guia', 0);
                    $this->session->unset_userdata('placa', 0);
                    $this->session->set_userdata('si', 0);
                }
                redirect('/login', 'location', 301);
                		
	}
        
        //Recibe los datos del usuario y valida contra la B.D. que el usuario sea v�lido.
	public function cotizar(){
                $this->load->model("control");
                $this->load->model("divipola");
		$this->load->helper("url");
		$depto = $this->input->post("cmbDeptoEstab"); 
		$ciudad = $this->input->post("cmbMpioEstab"); 
		$pesokg = $this->input->post("pesoKg"); 
		$alto = $this->input->post("alto")/100; 
		$ancho = $this->input->post("ancho")/100;
		$largo = $this->input->post("largo")/100;
                $cantidad = $this->input->post("cantidad");
                $valdeclarado = $this->input->post("valdeclarado");
                $data["valCiudad"] = $this->divipola->obtenerValoresCiudad($ciudad);
               //echo $valmin=$data["valCiudad"]["valor_minima"];
               
                if($data["valCiudad"]["valor_minima"]!=0){
                    $valorKg=$pesokg;
                    $valorVol=(($ancho*$largo*$alto)*400);
                   
                    if($valorKg < $valorVol){
                        if($valorVol<30){
                            $valorFlete=$valorVol*$data["valCiudad"]["valor_minima"]*$cantidad;
                        }else{
                            $valorFlete=$valorVol*$data["valCiudad"]["valor_kilo"]*$cantidad;
                        }
                    }else{
                        if($pesokg<30){
                            $valorFlete=$valorKg*$data["valCiudad"]["valor_minima"]*$cantidad;
                        }else{
                            $valorFlete=$valorKg*$data["valCiudad"]["valor_kilo"]*$cantidad;
                        }
                    }
                    $costoManejo=$valdeclarado*0.01;   
                    $totalFlete= ($costoManejo+$valorFlete);
                    
                    $this->session->set_userdata('tentrega', $data["valCiudad"]["tiempo_entrega"]);
                    $this->session->set_userdata('valorFlete', $valorFlete); 
                    $this->session->set_userdata('totalFlete', $totalFlete);
                    $this->session->set_userdata('costoManejo', $costoManejo);
                    $this->session->set_userdata('mpio', $data["valCiudad"]["nom_mpio"]);
                    $this->session->set_userdata('flete', 1);
                }else{
                    $this->session->set_userdata('tentrega', 0);
                    $this->session->set_userdata('valorFlete', 0);
                    $this->session->set_userdata('totalFlete', 0);
                    $this->session->set_userdata('mpio', 'Para la ciudad seleccionada no se est&aacute; prestando servicio de transporte.');
                    $this->session->set_userdata('flete', 2);
                }
                redirect('/login#anchor', 'location', 301);
                		
	}
	
	/*public function verificar(){
		$this->load->library("danecrypt");
		$password = "F11700350";
		$encode = $this->danecrypt->encode($password);		
		var_dump($encode);
		
		$password = "94BfWXn4XzD1oSsGk3K2zc_drn82m0NZYyIm59aF0bs";
		$decode = $this->danecrypt->decode($password);		
		var_dump($decode);
		
	}*/
	
	
}//EOC

