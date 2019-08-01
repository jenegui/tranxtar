<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control extends CI_Model {
	
	function __construct(){        
        parent::__construct();
        $this->load->database();
        $this->load->library("session");
        $this->load->library("general");
    }
    
    
    
    function obtenerGuiasId($id_guia) {
        $this->load->model("divipola");
        
        $control = array();
        $sql = "SELECT C.id_control, C.id_establecimientos, EST.idnomcom, EST.nit_establecimiento, EST.iddirecc, EST.idtelno,
                        C.fecha_recogida, C.fecha_entrega, C.id_destinatario, DEST.nro_identificacion, DEST.nombre_destinatario,
                        DEST.ciudad_destinatario, DEST.depto_destinatario,DEST.direccion_destinatario, DEST.telefono_destinatario,
    	               C.forma_pago, C.unidades, C.peso, C.peso_vol, C.peso_cobrar, C.valor_declarado, C.flete, C.costo_manejo, C.total_fletes, 
                       C.id_usuario_operario, C.nro_placa, C.id_operario, C.id_usuario, C.fecha_registro, C.observaciones, C.estado_contable, C.estado_control,
                       C.estado_recaudo, C.estado_carga, E.nom_estado
                FROM txtar_admin_control C,  txtar_admin_establecimientos EST, txtar_admin_destinatarios DEST, txtar_param_estados E
                WHERE C.id_establecimientos=EST.id_establecimiento
                AND C.estado_carga= E.id_estado
                AND C.id_destinatario=DEST.id_destinatario ";
                if($id_guia!=0){
                 $sql.=" AND C.id_control= $id_guia ";   
                }
        $sql.= "ORDER BY C.id_control "; 
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $control["id_control"] = $row->id_control;
                $control["id_establecimiento"] = $row->id_establecimientos;
                $control["id_establecimientos"] = $row->nit_establecimiento;
                $control["iddirecc"] = $row->iddirecc;
                $control["idtelno"] = $row->idtelno;
                $control["idnomcom"] = $row->idnomcom;
                $control["fecha_recogida"] = $row->fecha_recogida;
                $control["fecha_entrega"] = $row->fecha_entrega;
                $control["id_destinatario"] = $row->nro_identificacion;
                $control["id_dest"] = $row->id_destinatario;
                $control["nombre_destinatario"] = $row->nombre_destinatario;
                $control["direccion_destinatario"] = $row->direccion_destinatario;
                $control["telefono_destinatario"] = $row->telefono_destinatario;
                $control["forma_pago"] = $row->forma_pago;
                $control["unidades"] = $row->unidades;
                $control["peso"] = $row->peso;
                $control["peso_vol"] = $row->peso_vol;
                $control["peso_cobrar"] = $row->peso_cobrar;
                $control["valor_declarado"] = $row->valor_declarado;
                $control["flete"] = $row->flete;
                $control["costo_manejo"] = $row->costo_manejo;
                $control["total_fletes"] = $row->total_fletes;
                $control["costo_manejo"] = $row->costo_manejo;
                $control["id_usuario_operario"] = $row->id_usuario_operario;
                $control["nro_placa"] = $row->nro_placa;
                $control["id_operario"] = $row->id_operario;
                $control["id_usuario"] = $row->id_usuario;
                $control["fecha_registro"] = $row->fecha_registro;
                $control["observaciones"] = $row->observaciones;
                $control["estado_contable"] = $row->estado_contable;
                $control["estado_recaudo"] = $row->estado_recaudo;
                $control["estado_carga"] = $row->estado_carga;
                $control["estado_control"] = $row->estado_control;
                $control["nom_estado"] = $row->nom_estado;
                $i++;
            }
        }
        //echo $sql;
        $this->db->close();
        return $control;
    }
    
}//EOC
