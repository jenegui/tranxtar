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
		$this->load->model("periodo");
		$ano = $this->session->userdata("ano_periodo"); 
	  	$mes = $this->session->userdata("mes_periodo");
	  	$data["nombre"]  = $this->session->userdata("nombre");
	  	$data["controller"] = "login";
		$data["view"] = "login/login";
		$this->load->view('layout',$data);		
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
	
	public function verificar(){
		$this->load->library("danecrypt");
		$password = "F11700350";
		$encode = $this->danecrypt->encode($password);		
		var_dump($encode);
		
		$password = "94BfWXn4XzD1oSsGk3K2zc_drn82m0NZYyIm59aF0bs";
		$decode = $this->danecrypt->decode($password);		
		var_dump($decode);
		
	}
	
	
}//EOC

