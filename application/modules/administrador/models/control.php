<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control extends CI_Model {

    function __construct(){        
        parent::__construct();
        $this->load->database();
        $this->load->library("session");
    }
    
    function obtenerGuias() {
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
            END AS estado_contable, c.estado_carga	 
                FROM txtar_admin_control C,  txtar_admin_establecimientos EST, txtar_admin_destinatarios DEST
                WHERE C.id_establecimientos=EST.id_establecimiento
                AND C.id_destinatario=DEST.id_destinatario
                ORDER BY C.id_control";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $control[$i]["id_control"] = $row->id_control;
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
     
     
	function validarPazYSalvo($nro_orden, $uni_local, $ano_periodo, $mes_periodo){
    	//Si el estado est� en 99 - 5 ya fue verificado por el critico / asistente tecnico, por lo que ya puede descargar el paz y salvo
    	$retorno = false;
    	$sql = "SELECT fk_novedad, fk_estado
                FROM rmmh_admin_control
                WHERE nro_orden = $nro_orden
                AND nro_establecimiento = $uni_local
                AND ano_periodo = $ano_periodo
                AND mes_periodo = $mes_periodo";    
	   	$query = $this->db->query($sql);
    	if ($query->num_rows() > 0){
    		foreach ($query->result() as $row){
    			//Pregunto si el formulario ya fue enviado
    			if (($row->fk_novedad==99)&&($row->fk_estado==5)){
    				$retorno = true;
    			}	    		
    			else{
    				$retorno = false;
    			}		
    		}
    	}
    	$this->db->close();
    	return $retorno;
    }
    
	 // DMDIAZF - Mayo 25 2012
     // Grupo de funciones para realizar las consultas del reporte de control de operativo
     function informeOperativo($ano, $mes, $sede, $subsede){
     	//Desde esta funcion se llaman a las demas funciones y se obtiene todo el reporte operativo
     	$informeOP = array();
     	$informeOP["directorio_base"] = $this->directorioBase($usuarioCR=0, $usuarioLOG=0, $ano, $mes, $sede, $subsede);
     	$informeOP["nuevos"] = $this->nuevos($usuarioCR=0, $usuarioLOG=0, $ano, $mes, $sede, $subsede);
     	$informeOP["total_recolectar"] = $informeOP["directorio_base"] + $informeOP["nuevos"];
     	$informeOP["sin_distribuir"] = $this->sinDistribuir($usuarioCR=0, $usuarioLOG=0, $ano, $mes, $sede, $subsede);
     	$informeOP["distribuidos"] = $this->distribuidos($usuarioCR=0, $usuarioLOG=0, $ano, $mes, $sede, $subsede);
     	$informeOP["digitacion"] = $this->digitacion($usuarioCR=0, $usuarioLOG=0, $ano, $mes, $sede, $subsede);
     	$informeOP["digitados"] = $this->digitados($usuarioCR=0, $usuarioLOG=0, $ano, $mes, $sede, $subsede);
     	$informeOP["analisis_verificacion"] = $this->analisisVerificacion($usuarioCR=0, $usuarioLOG=0, $ano, $mes, $sede, $subsede);
     	$informeOP["verificados"] = $this->verificados($usuarioCR=0, $usuarioLOG=0, $ano, $mes, $sede, $subsede);
     	$informeOP["novedades"] = $this->novedades($usuarioCR=0, $usuarioLOG=0, $ano, $mes, $sede, $subsede);
     	$informeOP["pct_dbase"] = $this->calcularPorcentaje($informeOP["directorio_base"], $informeOP["total_recolectar"]);
     	$informeOP["pct_nuevos"] = $this->calcularPorcentaje($informeOP["nuevos"], $informeOP["total_recolectar"]);
     	$informeOP["pct_totrecolectar"] = $this->calcularPorcentaje($informeOP["total_recolectar"], $informeOP["total_recolectar"]);
     	$informeOP["pct_sindistribuir"] = $this->calcularPorcentaje($informeOP["sin_distribuir"], $informeOP["total_recolectar"]);
     	$informeOP["pct_distribuidos"] = $this->calcularPorcentaje($informeOP["distribuidos"], $informeOP["total_recolectar"]);
     	$informeOP["pct_digitacion"] = $this->calcularPorcentaje($informeOP["digitacion"], $informeOP["total_recolectar"]);
     	$informeOP["pct_digitados"] = $this->calcularPorcentaje($informeOP["digitados"], $informeOP["total_recolectar"]);
     	$informeOP["pct_analisisver"] = $this->calcularPorcentaje($informeOP["analisis_verificacion"], $informeOP["total_recolectar"]);
     	$informeOP["pct_verificados"] = $this->calcularPorcentaje($informeOP["verificados"], $informeOP["total_recolectar"]);
     	$informeOP["pct_novedades"] = $this->calcularPorcentaje($informeOP["novedades"], $informeOP["total_recolectar"]);
     	return $informeOP;
     }
     
	// dmdiazf - Mayo 15 2012
    // Realiza las operaciones de asignaci�n de carga de fuentes a los cr�ticos    
    function asignarFuenteCritico($nro_orden, $nro_establecimiento, $ano_periodo, $mes_periodo, $usuario){
    	$data = array('fk_usuariocritica' => $usuario);
    	$this->db->where("nro_orden", $nro_orden);
    	$this->db->where("nro_establecimiento", $nro_establecimiento);
    	$this->db->where("ano_periodo", $ano_periodo);
    	$this->db->where("mes_periodo", $mes_periodo);
    	$this->db->update("rmmh_admin_control",$data);
    }
    
	// dmdiazf - Julio 31 2012
    // Realiza las operaciones de asignaci�n de carga de fuentes a los logisticos    
    function asignarFuenteLogistico($nro_orden, $nro_establecimiento, $ano_periodo, $mes_periodo, $usuario){
    	$data = array('fk_usuariologistica'=>$usuario);
    	$this->db->where("nro_orden", $nro_orden);
    	$this->db->where("nro_establecimiento", $nro_establecimiento);
    	$this->db->where("ano_periodo", $ano_periodo);
    	$this->db->where("mes_periodo", $mes_periodo);
    	$this->db->update("rmmh_admin_control",$data);
    }
    
	//dmdiazf - Junio 08 2012
    //Funcion para duplicar los registros de control para un siguiente periodo.
    //Se duplican todos los registro de control para las fuentes.
    function crearFuentesPeriodo(){
    	$this->load->library("session");
    	$this->load->model("periodo");
    	$ano = $this->session->userdata("ano_periodo");
    	$mes = $this->session->userdata("mes_periodo");
    	$periodo = $this->periodo->obtenerPeriodoActual(); //Obtener el ultimo periodo mas reciente
    	$sql = "INSERT INTO rmmh_admin_control (nro_orden, nro_establecimiento, ano_periodo, mes_periodo, nueva, modulo1, modulo2, modulo3, modulo4, envio, inclusion, control, fk_novedad, fk_estado, fk_sede, fk_subsede, fk_usuariocritica, fk_usuariologistica)
                SELECT C.nro_orden, C.nro_establecimiento, ".$periodo["ano"].",".$periodo["mes"].", 0, 0, 0, 0, 0, 0, C.inclusion, 'A', 5, 0, C.fk_sede, C.fk_subsede, C.fk_usuariocritica, C.fk_usuariologistica
                FROM rmmh_admin_control C
                WHERE C.ano_periodo = $ano
                AND C.mes_periodo = $mes";		
    	$query = $this->db->query($sql);
    	$this->db->close();    	
    }
    
    //dmdiazf - Junio 13 2012
    //Funcion para cerrar todos los estados y novedades de un periodo anterior
    //Todos los formularios de un periodo se cierran. Se mantiene la misma novedad / estado del periodo, y se crea un nuevo registro para el nuevo periodo.    
    function cierrePeriodoActual($ano, $mes){
    	$this->load->model("periodo");
    	$ano_periodo = $this->session->userdata("ano_periodo");	
    	$mes_periodo = $this->session->userdata("mes_periodo");
    	//Se comenta esta linea, debido al cambio de procedimiento en los cierres de periodo. 
    	//Utilizar el nuevo cierre de periodo modificado. 
    	//$this->periodo->crearNuevoPeriodo($ano_periodo, $mes_periodo);
    	$this->periodo->crearNuevoPeriodoMODIFICADO($ano_periodo, $mes_periodo);
    } 
    
    
	//dmdiazf - Julio 31 2012
    //Funcion para obtener el numero de fuentes que se le han asignado a un usuario de rol distinto a fuente.
    function obtenerNumeroFuentesAsignadas($rol, $id, $ano_periodo, $mes_periodo){
    	$nro = 0;
    	if ($rol==2 || $rol==5){
    		$sql = "SELECT COUNT(*) AS nro
                    FROM rmmh_admin_control C ";
    		switch($rol){
    			case 2: $sql.= " WHERE C.fk_usuariocritica = $id ";
    		            break;
    			case 5: $sql.= " WHERE C.fk_usuariologistica = $id ";
    		            break;       
    		}
        	$sql.= "AND C.ano_periodo = $ano_periodo
                    AND C.mes_periodo = $mes_periodo";
        	$query = $this->db->query($sql);
    		if ($query->num_rows() > 0){
    			foreach ($query->result() as $row){
	    			$nro = $row->nro;
    			}
    		}
   		}    
   		$this->db->close();
    	return $nro;	
   }
   
   
   //dmdiazf Octubre 12 2012
   //Funcion para obtener el nombre de un estado a partir de la novedad y el estado
   function obtenerEstadoControl($novedad, $estado){
   		$status = "";
   		if (($novedad==5)||($novedad==9)||($novedad==99)){
   			switch($estado){
   				case 0: $status = "Sin Distribuir";
   						break;
   				case 1: $status = "Distribuido";
   				        break;
   				case 2: $status = "En Digitaci&oacute;n";
   				        break;
   				case 3: $status = "Digitado";
   				        break;
   				case 4: $status = "An&aacute;lisis - Verificaci&oacute;n";
   				        break;
   				case 5: $status = "Verificado";
   				        break;                                				
   			}
   		}
   		else{
   			$status = "Novedad";
   		}
   		return $status;
   }
   
   //dmdiazf - Septiembre 25 2012
   //Funcion para obtener toda la informacion de control para una de las fuentes / Funciona en editar fuentes
   function obtenerInformacionControl($nro_orden, $nro_establecimiento, $ano_periodo, $mes_periodo){
   		$this->load->model("novedad");
   		$this->load->model("estado");
   		$info = array();
   		$sql = "SELECT fk_novedad, fk_estado, modulo1, modulo2, modulo3, modulo4, envio
                FROM rmmh_admin_control
                WHERE nro_orden = $nro_orden
                AND nro_establecimiento = $nro_establecimiento
                AND ano_periodo = $ano_periodo
                AND mes_periodo = $mes_periodo";
   		$query = $this->db->query($sql);
   		if ($query->num_rows() > 0){
    		foreach ($query->result() as $row){
	    		$info["novedad"] = $this->novedad->nombreNovedad($row->fk_novedad);
	    		$info["estado"] = $this->estado->nombreEstado($row->fk_estado);
	    		$info["modulo1"] = $this->estadoModulo($row->modulo1);
	    		$info["modulo2"] = $this->estadoModulo($row->modulo2);
	    		$info["modulo3"] = $this->estadoModulo($row->modulo3);
	    		$info["modulo4"] = $this->estadoModulo($row->modulo4);
	    		$info["envio"] = $this->estadoModulo($row->envio);
    		}
    	}	
    	$this->db->close();
   		return $info;
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