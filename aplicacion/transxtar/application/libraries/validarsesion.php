<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	/**	  
	 * Validar si una sesion ya esta iniciada en la aplicacion.
	 * Si la sesion ya esta inicializada, se continua con el flujo
	 * normal del controlador, en caso contrario se redirecciona al 
	 * login de la aplicacion.
	 * @author DMDiazF
	 * @since  Marzo 06 de 2012	 
	 **/

	class ValidarSesion {
		
		var $url = "/login"; //Redireccionar a este controlador si el usuario no se encuentra logueado.
		
		function __construct(){
			$CI =& get_instance();
			$CI->load->helper("url");
			$CI->load->library("session");			
			$modulos_generales = array("supervisor",
				"administrador",
				"comercial",
				"operario",
				"traficoseguridad",
				"contabilidad",
				"despacho",
				"imprimir",
				"cliente",
				"logistica",
				"fuente",
				"guias",
				"");
			if (in_array($CI->uri->segment(1),$modulos_generales)){				
				if ($CI->session->userdata("auth")!="OK"){
					redirect($this->url,"refresh");
				}				
			}
			else{				
				if (strcmp($CI->uri->segment(1), $CI->session->userdata("controlador"))==0){
					if ($CI->session->userdata("auth")!="OK"){
						redirect($this->url,"refresh");
					}					
				}
				else{					
					redirect($this->url,"refresh");					
				}
			}
		}		
		
		
	
	}//EOC