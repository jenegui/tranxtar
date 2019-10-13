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
    }
    
}//EOC