<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estado extends CI_Model {

    function __construct(){        
        parent::__construct();
        $this->load->database();
        $this->load->library("session");
        $this->load->helper("url");
    }
    
    function estadoCarga(){
    	$estado = array();
    	$sql = "SELECT id_estado, nom_estado
                FROM txtar_param_estados 
                ORDER BY id_estado ASC ";
    	$query = $this->db->query($sql);
   		if ($query->num_rows()>0){
                    $i = 0;
                    foreach($query->result() as $row){
                        $estado[$i]['id_estado'] = $row->id_estado;
                        $estado[$i]['nom_estado'] = $row->nom_estado;
                        $i++;
                    }
		}
		$this->db->close();
		return $estado;
    	
    }
    
   	
    
} //EOC   	