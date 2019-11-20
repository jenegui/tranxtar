<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control extends CI_Model {

    function __construct(){        
        parent::__construct();
        $this->load->database();		
    }
    
	function obtenerGuiasNoAprobadas(){
   		$result = array();
   		$sql = "SELECT count(estado_control) estado
                FROM txtar_admin_control
                WHERE estado_control = 0";
   		$query = $this->db->query($sql);
   		if ($query->num_rows()>0){
			foreach($query->result() as $row){
				$result["estado"] = $row->estado;
			}
		}
		$this->db->close();
		return $result;
   	} 

	function actualizarNovedadEstado($nro_orden, $nro_establecimiento, $ano_periodo, $mes_periodo, $novedad, $estado){
    	$data = array('fk_novedad' => $novedad,
		              'fk_estado' => $estado  
		        );
		$this->db->where("nro_orden", $nro_orden);
		$this->db->where("nro_establecimiento", $nro_establecimiento);
		$this->db->where("ano_periodo", $ano_periodo);
		$this->db->where("mes_periodo", $mes_periodo);
		$this->db->update("rmmh_admin_control",$data);
    }
    //Obtiene el último id de la guias
    function obtenerUltimoIdGuia(){
   		$result = array();
   		$sql = "SELECT id_control
                FROM txtar_admin_control
                order by id_control desc limit 1";
   		$query = $this->db->query($sql);
   		if ($query->num_rows()>0){
			foreach($query->result() as $row){
				$result["id_control"] = $row->id_control;
			}
		}
		$this->db->close();
		return $result;
   	} 

   	//Crea los registros de control cuando se realiza el cargue masivo del directorio
    function registrarGuia($ulimoIdGuia, $numremesa, $idestablecimiento, $iddestinatario, $formaPago, $pesokg, $alto, $ancho, $largo, $unidades, $pesocobrar, $valorDeclarado, $flete, $costomanejo, $totalflete, $tipocarga, $idoperario, $numplaca, $idoperarioext, $estadocarga, $estadoRecogida, $observaciones, $idusaurio, $fechaRegistro) {
       		 $data = array('id_control' => $ulimoIdGuia,
        	'nro_remesa' => $numremesa,
            'id_establecimientos' => $idestablecimiento,
            
            'id_destinatario' => $iddestinatario,
            'forma_pago' => $formaPago,
            'unidades' => $unidades,
            'peso' => $pesokg,
            'pv_alto' => $alto,
            'pv_ancho' => $ancho,
            'pv_largo' => $largo,
            'peso_cobrar' => $pesocobrar,
            'valor_declarado' => $valorDeclarado,
            'flete' => $flete,
            'costo_manejo' => $costomanejo,
            'total_fletes' => $totalflete,
            'tipo_carga' => $tipocarga,
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
        //echo $this->db->last_query();
    }

    //Actualiza la guia con los datos del greistro de la guiA
    function actualizarGuiaReferencia($id_guia, $numremesa, $formaPago, $fecharecog, $valorDeclarado, $flete, $totalflete, $tipocarga, $idoperario, $numplaca, $idoperarioext, $estadocarga, $estadoRecogida, $observaciones, $idusaurio, $fechaRegistro) {
       		 $data = array(
        	'nro_remesa' => $numremesa,
            'forma_pago' => $formaPago,
            'fecha_recogida' => $fecharecog,
            'valor_declarado' => $valorDeclarado,
            'flete' => $flete,
            'total_fletes' => $totalflete,
            'tipo_carga' => $tipocarga,
            'id_usuario_operario' => $idoperario,
            'nro_placa' => $numplaca,
            'id_operario' => $idoperarioext,
            'estado_carga' => $estadocarga,
            'estado_control' => $estadoRecogida,
            'observaciones' => $observaciones,
            'estado_contable' => 0,
            'id_usuario' => $idusaurio,
            'fecha_registro' => $fechaRegistro);
        $this->db->where("id_control", $id_guia);
        $this->db->update("txtar_admin_control", $data);
        
       // echo $this->db->last_query();
        $this->db->close();
    }

    //Crea los registros de control cuando se realiza el cargue masivo del directorio
    function insertarControlGuia($numremesa, $idestablecimiento, $txtFecRecogida, $iddestinatario, $formaPago, $alto, $ancho, $largo, $unidades, $valorDeclarado, $flete, $totalflete, $tipocarga, $idoperario, $numplaca, $idoperarioext, $estadocarga, $estadoRecogida, $observaciones, $idusaurio, $fechaRegistro) {
        $data = array('nro_remesa' => $numremesa,
            'id_establecimientos' => $idestablecimiento,
            'fecha_recogida' => $txtFecRecogida,
            'id_destinatario' => $iddestinatario,
            'forma_pago' => $formaPago,
            'unidades' => $unidades,
            'pv_alto' => $alto,
            'pv_ancho' => $ancho,
            'pv_largo' => $largo,
            'valor_declarado' => $valorDeclarado,
            'flete' => $flete,
            'total_fletes' => $totalflete,
            'tipo_carga' => $tipocarga,
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

    function obtenerGuiasId($id_guia) {
        $this->load->model("divipola");
        $this->load->model("sede");
        $this->load->model("subsede");
        $control = array();
        $sql = "SELECT C.id_control, C.nro_remesa, C.id_establecimientos, EST.idnomcom, EST.nit_establecimiento, EST.iddirecc, EST.idtelno,
                        C.fecha_recogida, C.fecha_entrega, C.id_destinatario, DEST.nro_identificacion, DEST.nombre_destinatario,
                        DEST.ciudad_destinatario, DEST.depto_destinatario,DEST.direccion_destinatario, DEST.telefono_destinatario,
                       C.forma_pago, C.unidades, C.peso, C.pv_alto, C.pv_ancho, C.pv_largo, C.peso_cobrar, C.valor_declarado, C.flete, C.costo_manejo, C.total_fletes, C.tipo_carga,
                       C.id_usuario_operario, US.nom_usuario, US.nro_telefono, C.nro_placa, C.id_operario, C.id_usuario, C.fecha_registro, C.observaciones, C.estado_contable, C.estado_control,
                       C.estado_recaudo, C.estado_carga, E.nom_estado,
                       OP.nombre_operario,
                    OP.nro_identificacion,
                    OP.nro_placa as placa_ext,
                    OP.telefono_operario, C.fecha_registro, C.observaciones
                FROM txtar_admin_control C
                INNER JOIN txtar_admin_establecimientos EST ON C.id_establecimientos=EST.id_establecimiento 
                INNER JOIN txtar_admin_destinatarios DEST ON C.id_destinatario=DEST.id_destinatario
                INNER JOIN txtar_param_estados E ON C.estado_carga= E.id_estado
                LEFT JOIN txtar_param_operario OP ON C.id_operario = OP.id_operario  
                LEFT JOIN txtar_admin_usuarios US ON C.id_usuario_operario = US.num_identificacion 
                  ";
        if ($id_guia != 0) {
            $sql .= " WHERE C.id_control= $id_guia ";
        }
        $sql .= "ORDER BY C.id_control ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $control["id_control"] = $row->id_control;
                $control["nroRemesa"] = $row->nro_remesa;
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
                $control["nroTelefono"] = $row->nro_telefono;
                $control["ciudadDest"] = $this->divipola->nombreMunicipio($row->ciudad_destinatario);
                $control["deptoDest"] = $this->divipola->nombreDepartamento($row->depto_destinatario);
                $control["direccion_destinatario"] = $row->direccion_destinatario;
                $control["telefono_destinatario"] = $row->telefono_destinatario;
                $control["forma_pago"] = $row->forma_pago;
                $control["unidades"] = $row->unidades;
                $control["peso"] = $row->peso;
                $control["alto"] = round($row->pv_alto);
                $control["ancho"] = round($row->pv_ancho);
                $control["largo"] = round($row->pv_largo);
                $control["peso_cobrar"] = $row->peso_cobrar;
                $control["valor_declarado"] = $row->valor_declarado;
                $control["flete"] = $row->flete;
                $control["costo_manejo"] = $row->costo_manejo;
                $control["total_fletes"] = $row->total_fletes;
                $control["tipoCarga"] = $row->tipo_carga;
                $control["costo_manejo"] = $row->costo_manejo;
                $control["id_usuario_operario"] = $row->id_usuario_operario;
                $control["nomUsuario"] = $row->nom_usuario;
                $control["nro_placa"] = $row->nro_placa;
                $control["nroTelefono"] = $row->nro_telefono;
                $control["id_operario"] = $row->id_operario;
                $control["id_usuario"] = $row->id_usuario;
                $control["fecha_registro"] = $row->fecha_registro;
                $control["observaciones"] = $row->observaciones;
                $control["estado_contable"] = $row->estado_contable;
                $control["estado_recaudo"] = $row->estado_recaudo;
                $control["estado_carga"] = $row->estado_carga;
                $control["estado_control"] = $row->estado_control;
                $control["nom_estado"] = $row->nom_estado;
                $control["nombreOperario"] = $row->nombre_operario;
                $control["nro_identificacion"] = $row->nro_identificacion;
                $control["telefono_operario"] = $row->telefono_operario;
                $control["placa_ext"] = $row->placa_ext;
                $control["telOperario"] = $row->telefono_operario;
                $control["fechaRegistro"] = $row->fecha_registro;
                $control["observaciones"] = $row->observaciones;
                $i++;
            }
        }
        //echo $sql;
        $this->db->close();
        return $control;
    }
    
}//EOC