<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control extends CI_Model {

    function __construct(){        
        parent::__construct();
        $this->load->database();
        $this->load->library("session");
    }
    
    function obtenerGuias($id_usuario) {
        $this->load->model("divipola");
        $this->load->model("sede");
        $this->load->model("subsede");
        $control = array();
        $sql = "SELECT C.id_control, C.id_establecimientos, EST.idnomcom, EST.nit_establecimiento, C.fecha_recogida, C.fecha_entrega,
                        C.id_destinatario, DEST.nro_identificacion, DEST.nombre_destinatario,
    	               C.forma_pago, C.unidades, C.peso, C.peso_vol, C.peso_cobrar, C.valor_declarado, C.flete, C.costo_manejo, C.total_fletes, 
                       C.id_usuario_operario, C.nro_placa, C.id_operario, C.id_usuario, C.fecha_registro, C.observaciones,
                       CASE WHEN C.estado_contable = 1 THEN 'Contabilizado'
            WHEN C.estado_contable = 0 THEN 'No contabilizado'
            END AS estado_contable, C.estado_carga, E.nom_estado	 
                FROM txtar_admin_control C,  txtar_admin_establecimientos EST, txtar_admin_destinatarios DEST, txtar_param_estados E
                WHERE C.id_establecimientos=EST.id_establecimiento
                AND C.id_destinatario=DEST.id_destinatario
                AND C.estado_carga= E.id_estado ";
                if($this->session->userdata("tipo_usuario")==5){
                 $sql.=" AND C.id_usuario_operario= $id_usuario ";
                 $sql.=" AND C.estado_carga != 8 "; 
                }elseif($this->session->userdata("tipo_usuario")==3){
                 $sql.=" AND EST.id_comercial= $id_usuario ";   
                }
        $sql.= "ORDER BY C.id_control "; 
        $query = $this->db->query($sql);
       ;
      // echo $sql;
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $control[$i]["id_control"] = $row->id_control;
                $control[$i]["id_establecimiento"] = $row->id_establecimientos;
                $control[$i]["id_establecimientos"] = $row->nit_establecimiento;
                $control[$i]["idnomcom"] = $row->idnomcom;
                $control[$i]["fecha_recogida"] = $row->fecha_recogida;
                $control[$i]["fecha_entrega"] = $row->fecha_entrega;
                $control[$i]["id_destinatario"] = $row->nro_identificacion;
                $control[$i]["nombre_destinatario"] = $row->nombre_destinatario;
                $control[$i]["forma_pago"] = $row->forma_pago;
                $control[$i]["unidades"] = $row->unidades;
                $control[$i]["peso"] = $row->peso;
                $control[$i]["peso_vol"] = $row->peso_vol;
                $control[$i]["peso_cobrar"] = $row->peso_cobrar;
                $control[$i]["valor_declarado"] = $row->valor_declarado;
                $control[$i]["flete"] = $row->flete;
                $control[$i]["costo_manejo"] = $row->costo_manejo;
                $control[$i]["total_fletes"] = $row->total_fletes;
                $control[$i]["costo_manejo"] = $row->costo_manejo;
                $control[$i]["id_usuario_operario"] = $row->id_usuario_operario;
                $control[$i]["nro_placa"] = $row->nro_placa;
                $control[$i]["id_operario"] = $row->id_operario;
                $control[$i]["id_usuario"] = $row->id_usuario;
                $control[$i]["fecha_registro"] = $row->fecha_registro;
                $control[$i]["observaciones"] = $row->observaciones;
                $control[$i]["estado_contable"] = $row->estado_contable;
                $control[$i]["estado_carga"] = $row->estado_carga;
                $control[$i]["nom_estado"] = $row->nom_estado;
                $i++;
            }
        }
        //echo $sql;
        $this->db->close();
        return $control;
    }
    function obtenerGuiasId($id_guia) {
        $this->load->model("divipola");
        $this->load->model("sede");
        $this->load->model("subsede");
        $control = array();
        $sql = "SELECT C.id_control, C.id_establecimientos, EST.idnomcom, EST.nit_establecimiento, C.fecha_recogida, C.fecha_entrega,
                        C.id_destinatario, DEST.nro_identificacion, DEST.nombre_destinatario,
    	               C.forma_pago, C.unidades, C.peso, C.peso_vol, C.peso_cobrar, C.valor_declarado, C.flete, C.costo_manejo, C.total_fletes, 
                       C.id_usuario_operario, C.nro_placa, C.id_operario, C.id_usuario, C.fecha_registro, C.observaciones, C.estado_contable, C.estado_control,
                       C.estado_carga
                FROM txtar_admin_control C,  txtar_admin_establecimientos EST, txtar_admin_destinatarios DEST
                WHERE C.id_establecimientos=EST.id_establecimiento
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
                $control["idnomcom"] = $row->idnomcom;
                $control["fecha_recogida"] = $row->fecha_recogida;
                $control["fecha_entrega"] = $row->fecha_entrega;
                $control["id_destinatario"] = $row->nro_identificacion;
                $control["id_dest"] = $row->id_destinatario;
                $control["nombre_destinatario"] = $row->nombre_destinatario;
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
                $control["estado_carga"] = $row->estado_carga;
                $control["estado_control"] = $row->estado_control;
                $i++;
            }
        }
        //echo $sql;
        $this->db->close();
        return $control;
    }

    	//Crea los registros de control cuando se realiza el cargue masivo del directorio
	 function insertarControlGuia($idestablecimiento, $txtFecRecogida, $txtFecEntrega,$iddestinatario,$formaPago,$pesokg,$pesovol,$unidades,$pesocobrar,$valorDeclarado,
                 $flete,$costomanejo,$totalflete,$idoperario,$numplaca,$idoperarioext,$estadocarga,$estadoRecogida,$observaciones,$idusaurio,$fechaRegistro){
	 	$data = array(
                            'id_establecimientos' => $idestablecimiento, 
	 	              'fecha_recogida' => $txtFecRecogida, 
	 	              'fecha_entrega' => $txtFecEntrega, 
	 	              'id_destinatario' => $iddestinatario, 
	 	              'forma_pago' => $formaPago, 
	 	              'unidades' => $unidades,  
	 	              'peso' => $pesokg, 
	 	              'peso_vol' => $pesovol, 
	 	              'peso_cobrar' => $pesocobrar,
                              'valor_declarado' => $valorDeclarado,
	 	              'flete' => $flete, 
	 	              'costo_manejo' => $costomanejo, 
	 	              'total_fletes' => $totalflete, 
	 	              'id_usuario_operario' => $idoperario, 
	 	              'nro_placa' => $numplaca, 
	 	              'id_operario' => $idoperarioext, 
	 	              'estado_carga' => $estadocarga, 
	 	              'estado_control' => $estadoRecogida, 
	 	              'observaciones' => $observaciones, 
	 	              'estado_contable' => 0,
	 	              'id_usuario' => $idusaurio,
	 	              'fecha_registro' => $fechaRegistro);
	 	$this->db->insert('txtar_admin_control', $data);
	 	$this->db->close();
	 }
    //Actualiza oa información del control de las guias     
    function actualizarDatosControl($id_control, $idestablecimiento, $txtFecRecogida, $txtFecEntrega, $iddestinatario, $formaPago, $pesokg, $pesovol, $unidades, 
            $pesocobrar, $valorDeclarado, $flete, $costomanejo, $totalflete, $idoperario, $numplaca, $idoperarioext, $estadocarga, $estadoRecogida, $observaciones){
    	$data = array('id_establecimientos' => $idestablecimiento,
		     'fecha_recogida' => $txtFecRecogida,
		     'fecha_entrega' => $txtFecEntrega,
		     'id_destinatario' => $iddestinatario,
		     'forma_pago' => $formaPago,
		     'unidades' => $unidades,
		     'peso' => $pesokg,
		     'peso_vol' => $pesovol,
		     'peso_cobrar' => $pesocobrar,
		     'valor_declarado' => $valorDeclarado,
		     'flete' => $flete,
		     'costo_manejo' => $costomanejo,
		     'total_fletes' => $totalflete,
		     'id_usuario_operario' => $idoperario,
		     'nro_placa' => $numplaca,
		     'id_operario' => $idoperarioext,
		     'observaciones' => $observaciones,
		     'estado_carga' => $estadocarga,
                     'estado_control' => $estadoRecogida   
		);
		$this->db->where("id_control", $id_control);
		$this->db->update("txtar_admin_control",$data);
    }     
    
    //Actualiza oa información del estado del control de las guias     
    function actualizarDatosControlTS($id_control, $estadocarga, $observaciones){
    	$data = array('observaciones' => $observaciones,
		     'estado_carga' => $estadocarga,
                );
		$this->db->where("id_control", $id_control);
		$this->db->update("txtar_admin_control",$data);
    }     
    //Actualiza oa información del estado contable de las guias     
    function actualizarDatosControlCon($id_control, $estadocont){
    	$data = array('estado_contable' => $estadocont,
                );
		$this->db->where("id_control", $id_control);
		$this->db->update("txtar_admin_control",$data);
    }     
     
   //Funcion que me entrega el nombre del estado de un modulo
   function estadoModulo($estado){
   		$nombre = "";
   		switch($estado){
   			case 0: $nombre = "0 - Sin diligenciar";
   			        break;
   			case 2: $nombre = "2 - Diligenciado";
   			        break;        
   		}
   		return $nombre;			
   }
   
	
   function cambiaEstadoControl($nro_orden, $nro_establecimiento, $ano_periodo, $mes_periodo, $estado,  $novedad, $estadocontrol){
    	$data = array('fk_novedad' => $novedad,
		     'fk_estado' => $estado,
                     'estado_control' => $estadocontrol   
		);
		$this->db->where("nro_orden", $nro_orden);
		$this->db->where("nro_establecimiento", $nro_establecimiento);
		$this->db->where("ano_periodo", $ano_periodo);
		$this->db->where("mes_periodo", $mes_periodo);
		$this->db->update("rmmh_admin_control",$data);
    }

    
}//EOC   