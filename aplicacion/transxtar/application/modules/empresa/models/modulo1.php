<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modulo1 extends CI_Model {
	
	function __construct(){        
        parent::__construct();
        $this->load->database();
        $this->load->library("session");
        $this->load->library("general");
    }
    
    function obtenerModuloOLD($nro_orden, $nro_establecimiento, $ano_periodo, $mes_periodo){
    	$modulo1 = array();
    	$sql = "SELECT CTRL.modulo1, CTRL.nro_orden,EMP.idnit, EMP.idproraz, EMP.idnomcom, EMP.idsigla, EMP.iddirecc, EMP.fk_depto, 
    	               EMP.fk_mpio, EMP.idtelno, EMP.idfaxno, EMP.idpagweb, EMP.idcorreo, DATE_FORMAT(EST.finicial,'%d/%m/%Y') AS finicial, DATE_FORMAT(EST.ffinal,'%d/%m/%Y') AS ffinal, EST.idnomcom AS idnomcomest, EST.idsigla AS idsiglaest, 
    	               EST.iddirecc AS iddireccest, EST.iddepto AS iddeptoest, EST.idmpio AS idmpioest, EST.idtelno AS idtelnoest, EST.idfaxno AS idfaxnoest, EST.idcorreo AS idcorreoest, EST.nom_cadena AS nom_cadena, EST.nom_operador AS nom_operador, EST.fk_ciiu AS fk_ciiu,
    	               CIU.nom_ciiu AS nom_ciiu
                FROM rmmh_admin_control CTRL, rmmh_admin_empresas EMP, rmmh_admin_establecimientos EST, rmmh_param_ciiu3 CIU
                WHERE CTRL.nro_orden = EMP.nro_orden
                AND EMP.nro_orden = EST.nro_orden
                AND CIU.id_ciiu = EST.fk_ciiu
                AND CTRL.nro_orden = $nro_orden
                AND CTRL.ano_periodo = $ano_periodo
                AND CTRL.mes_periodo = $mes_periodo";    	
    	$query = $this->db->query($sql);
    	  
    	if ($query->num_rows() > 0){
    		foreach ($query->result() as $row){
      			$modulo1["imagen"] = $row->modulo1;
    			$modulo1["nro_orden"] = $row->nro_orden;
    			$modulo1["idnit"] = $row->idnit;
      			$modulo1["idproraz"] = strtoupper($row->idproraz);
      			$modulo1["idnomcom"] = strtoupper($row->idnomcom);
      			$modulo1["idsigla"] = strtoupper($row->idsigla);
      			$modulo1["iddirecc"] = strtoupper($row->iddirecc);
      			$modulo1["iddepto"] = $row->fk_depto;
      			$modulo1["idmpio"] = $row->fk_mpio;
      			$modulo1["idtelno"] = $row->idtelno;
      			$modulo1["idfaxno"] = $row->idfaxno;
      			$modulo1["idpagweb"] = strtolower($row->idpagweb);
      			$modulo1["idcorreo"] = strtolower($row->idcorreo);
      			$modulo1["finicial"] = $row->finicial;
      			$modulo1["ffinal"] = $row->ffinal;
      			$modulo1["idnomcomest"] = strtoupper($row->idnomcomest);
      			$modulo1["idsiglaest"] = strtoupper($row->idsiglaest);
      			$modulo1["iddireccest"] = strtoupper($row->iddireccest);
      			$modulo1["iddeptoest"] = $row->iddeptoest;
      			$modulo1["idmpioest"] = $row->idmpioest;
      			$modulo1["idtelnoest"] = $row->idtelnoest;
      			$modulo1["idfaxnoest"] = $row->idfaxnoest;
      			$modulo1["idcorreoest"] = strtolower($row->idcorreoest);
      			$modulo1["nom_cadena"]=strtoupper($row->nom_cadena);
      			$modulo1["nom_operador"]=strtoupper($row->nom_operador);
      			$modulo1["fk_ciiu"]=strtoupper($row->fk_ciiu);
      			$modulo1["nom_ciiu"]=strtoupper($row->nom_ciiu);
   			}   			
   		}    	
    	$this->db->close();
   		return $modulo1;
    }
    
    /**
     * Obtener módulo uno, no se tiene en cuenta la tabla control
     * @author sjneirag
     * @since  08/05/2017
     */
    function obtenerModulo($nro_orden, $nro_establecimiento, $ano_periodo, $mes_periodo){
    	$modulo1 = array();
    	$sql = "SELECT EMP.nro_orden, EMP.idnit, EMP.idproraz, EMP.idnomcom, EMP.idsigla, EMP.iddirecc, EMP.fk_depto,
    	EMP.fk_mpio, EMP.idtelno, EMP.idfaxno, EMP.idpagweb, EMP.idcorreo, DATE_FORMAT(EST.finicial,'%d/%m/%Y') AS finicial, DATE_FORMAT(EST.ffinal,'%d/%m/%Y') AS ffinal, EST.idnomcom AS idnomcomest, EST.idsigla AS idsiglaest,
    	EST.iddirecc AS iddireccest, EST.iddepto AS iddeptoest, EST.idmpio AS idmpioest, EST.idtelno AS idtelnoest, EST.idfaxno AS idfaxnoest, EST.idcorreo AS idcorreoest, EST.nom_cadena AS nom_cadena, EST.nom_operador AS nom_operador, EST.fk_ciiu AS fk_ciiu,
    	CIU.nom_ciiu AS nom_ciiu
    	FROM rmmh_admin_empresas EMP, rmmh_admin_establecimientos EST, rmmh_param_ciiu3 CIU
    	WHERE EMP.nro_orden = EST.nro_orden
    	AND CIU.id_ciiu = EST.fk_ciiu
    	AND EMP.nro_orden = $nro_orden ";
    	$query = $this->db->query($sql);  
    	
    	if ($query->num_rows() > 0){
    			foreach ($query->result() as $row){
    			$modulo1["nro_orden"] = $row->nro_orden;
    			$modulo1["idnit"] = $row->idnit;
    			$modulo1["idproraz"] = strtoupper($row->idproraz);
    			$modulo1["idnomcom"] = strtoupper($row->idnomcom);
		    	$modulo1["idsigla"] = strtoupper($row->idsigla);
		    	$modulo1["iddirecc"] = strtoupper($row->iddirecc);
		    	$modulo1["iddepto"] = $row->fk_depto;
		    	$modulo1["idmpio"] = $row->fk_mpio;
		    	$modulo1["idtelno"] = $row->idtelno;
		    	$modulo1["idfaxno"] = $row->idfaxno;
		    	$modulo1["idpagweb"] = strtolower($row->idpagweb);
		    	$modulo1["idcorreo"] = strtolower($row->idcorreo);
		    	$modulo1["finicial"] = $row->finicial;
		    	$modulo1["ffinal"] = $row->ffinal;
    			$modulo1["idnomcomest"] = strtoupper($row->idnomcomest);
    			$modulo1["idsiglaest"] = strtoupper($row->idsiglaest);
    			$modulo1["iddireccest"] = strtoupper($row->iddireccest);
    			$modulo1["iddeptoest"] = $row->iddeptoest;
    			$modulo1["idmpioest"] = $row->idmpioest;
    			$modulo1["idtelnoest"] = $row->idtelnoest;
    			$modulo1["idfaxnoest"] = $row->idfaxnoest;
    			$modulo1["idcorreoest"] = strtolower($row->idcorreoest);
    	$modulo1["nom_cadena"]=strtoupper($row->nom_cadena);
    	$modulo1["nom_operador"]=strtoupper($row->nom_operador);
    	$modulo1["fk_ciiu"]=strtoupper($row->fk_ciiu);
    	$modulo1["nom_ciiu"]=strtoupper($row->nom_ciiu);
    	}
    	}
    	$this->db->close();
    	return $modulo1;
    }
    
    
    function actualizarModulo($nro_orden, $nro_establecimiento, $idnit, $idproraz, $iddirecc, $iddepto, $idmpio, $idtelno, $idfaxno, $idpagweb, $idcorreo, $finicial, $ffinal){
        // Limpiar las fechas del formato DANE y pasarlas a formato MySQL
        $arrayIni = explode("/",$finicial);                      	
        $arrayFin = explode("/",$ffinal);
        $fechaInicial = $arrayIni[2]."-".$arrayIni[1]."-".$arrayIni[0];
    	$fechaFinal = $arrayFin[2]."-".$arrayFin[1]."-".$arrayFin[0];
        // Actualizar rmmh_admin_empresas
    	$data = array('idnit' => $idnit, 
    	              'idproraz' => $idproraz, 
    	              'iddirecc' => $iddirecc, 
    	              'idtelno' => $idtelno, 
    	              'idfaxno' => $idfaxno, 
    	              'idaano' => '', 
    	              'idpagweb' => $idpagweb, 
    	              'idcorreo' => $idcorreo,
    	              'fk_depto' => $iddepto, 
    	              'fk_mpio' => $idmpio);	
    	$this->db->where("nro_orden",$nro_orden);
    	$this->db->update("rmmh_admin_empresas", $data);
    	//echo $this->db->last_query();
    }
    
    /**
     * Inserta establacimientos nuevos.
     * @author sjneirag
     * @since  08/05/2017
     */
    function insertModuloEst($nro_orden,$nro_establecimiento, $idnomcomest, $iddireccest, $idactivest, $iddeptoest, $idmpioest, $idtelnoest, $idfaxnoest, $idcorreoest, $nom_cadena, $nom_operador, $anio, $mes){
    	// Inserta rmmh_admin_establecimientos
    	$data = array(
    			'nro_orden'=>$nro_orden,
    			'nro_establecimiento'=>$nro_establecimiento,
    			'idnomcom' => $idnomcomest,
    			'iddirecc' => $iddireccest,
    			'fk_ciiu' => $idactivest,
    			'fk_mpio' => $idmpioest,
    			'fk_depto' => $iddeptoest,
    			'idtelno' => $idtelnoest,
    			'idfaxno' => $idfaxnoest,
    			'idcorreo' => $idcorreoest,
    			'finicial' => $nom_cadena,
    			'ffinal' => $nom_operador,
    			'anio_apertura' => $anio,
    			'mes_apertura' => $mes,
                        'estado_establecimiento' => 0 );
    	$this->db->where("nro_orden",$nro_orden);
    	//$this->db->where("nro_establecimiento",$nro_establecimiento);
    	$this->db->insert("rmmh_admin_establecimientos", $data);
    	$this->db->close();
    	 
    	echo $this->db->last_query();
    	
    }
    
    /**
     * Obtiene el número de estableciminetos iniciales, abiertos en el mes y cerrados en el mes.
     * @author sjneirag
     * @since  04/05/2017
     */
    function obtenerNumEst($nro_orden,$ano_periodo, $mes_periodo, $opcion){
    	$modulo1 = array();
    	$sql = "SELECT count(nro_establecimiento) as establecimientos 
    	FROM rmmh_admin_establecimientos 
    	WHERE nro_orden= $nro_orden ";
    	if($opcion==1){
	    	$sql.= "AND mes_apertura NOT IN ($mes_periodo) 
	    	AND anio_apertura NOT IN ($ano_periodo) 
	    	AND estado_establecimiento=1 "; 
    	}elseif($opcion==2){
    		$sql.= "AND mes_apertura = $mes_periodo
    		AND anio_apertura = $ano_periodo ";
    	}elseif($opcion==3){
    		$sql.= "AND mes_cierre = $mes_periodo
    		AND anio_cierre = $ano_periodo
    		AND estado_establecimiento=0 ";
    	} 
    	$query = $this->db->query($sql);
    	//echo $sql."<br><br>";
    	if ($query->num_rows() > 0){
    		foreach ($query->result() as $row){
    			$modulo1["establecimientos"] = $row->establecimientos;
    		}
    	}    	
    	$this->db->close();
   		return $modulo1;
    }
    
    
    /**
     * Obtiene las unidades locales de la empresa.
     * @author sjneirag
     * @since  04/05/2017
     */
    function obtenerUnidadLocal($nro_orden,$ano_periodo, $mes_periodo, $opcion){
    	$ulocal = array();
    	$sql = "SELECT fk_mpio, nom_mpio, COUNT(nro_establecimiento) AS establecimientos, fk_sede, fk_subsede  
    			FROM rmmh_admin_establecimientos, rmmh_param_mpios 
    			WHERE nro_orden=$nro_orden 
    			AND id_mpio= fk_mpio
    			AND estado_establecimiento IN (0,1) 
    			GROUP BY fk_mpio 
    			ORDER BY fk_mpio ASC ";
    	$query = $this->db->query($sql);
    	   
    	if ($query->num_rows() > 0){
    		$i=0;
	    	foreach ($query->result() as $row){
	    		$ulocal[$i]["codmpio"] = $row->fk_mpio;
	    		$ulocal[$i]["nompio"] = $row->nom_mpio;
	    		$ulocal[$i]["establecimientos"] = $row->establecimientos;
	    		$ulocal[$i]["sede"] = $row->fk_sede;
	    		$ulocal[$i]["subsede"] = $row->fk_subsede;
	    	$i++;
	    	}
    	}
    	$this->db->close();
    	return $ulocal;
    }
	
	/**
     * Obtiene el último número de establecimineto.
     * @author sjneirag
     * @since  04/05/2017
     */
    function obtenerEstablecimientos(){
    	$estab = array();
    	$sql = "SELECT MAX(nro_establecimiento) AS establecimientos 
    			FROM rmmh_admin_establecimientos 
    			";
    	$query = $this->db->query($sql);
    	 
    	if ($query->num_rows() > 0){
    		;
	    	foreach ($query->result() as $row){
	    		$estab["ultimoEstab"] = $row->establecimientos;
	    	}
    	}
    	$this->db->close();
    	return $estab;
    }
    
    /**
     * Obtiene establecimiento para validar que ya exista y no deje registar mas de uno con el mismo nombre.
     * @author sjneirag
     * @since  04/05/2017
     */
    function obtenerEstablecimiento($nro_orden, $idnomcomest){
    	$estab = array();
    	$sql = "SELECT nro_establecimiento, idnomcom
    			FROM rmmh_admin_establecimientos
    			WHERE
    			nro_orden=$nro_orden
    			AND idnomcom= '$idnomcomest' 
    			AND estado_establecimiento=1 ";
    	$query = $this->db->query($sql);
    echo $sql;
    	if ($query->num_rows() > 0){
    		foreach ($query->result() as $row){
    			$estab["ultimoEstab"] = $row->nro_establecimiento;
    			$estab["nomEstab"] = $row->idnomcom;
    		}
    	}
    	$this->db->close();
    	return $estab;
    }
    
    /**
     * Obtiene las unidades locales de la empresa.
     * @author sjneirag
     * @since  08/05/2017
     */
    function obtenerEstablecimientosXEmpresa($numero,$numero1,$opcion){
    	$estab = array();
    	$sql = "SELECT nro_establecimiento, idnomcom, estado_establecimiento, iddirecc, observaciones
    	FROM rmmh_admin_establecimientos ";
    	if($opcion=="empresa"){
    		$sql.= "WHERE nro_orden=$numero ";
    	}elseif($opcion=="ulocal"){
    		$sql.= "WHERE nro_orden=$numero ";
    		$sql.= "AND fk_mpio=$numero1 ";
    		$sql.= "AND estado_establecimiento=1 ";
    	}else{
    		$sql.= "WHERE nro_establecimiento=$numero ";
    	}
    	$sql.= "ORDER BY nro_establecimiento ASC ";
    	$query = $this->db->query($sql);
    	
    	if ($query->num_rows() > 0){
    		if($opcion=="empresa" ||$opcion=="ulocal"){
	    		$i=0;
		    	foreach ($query->result() as $row){
			    	$estab[$i]["nro_establecimiento"] = $row->nro_establecimiento;
			    	$estab[$i]["idnomcom"] = $row->idnomcom;
			    	$estab[$i]["estadoEst"] = $row->estado_establecimiento;
			    	$estab[$i]["direccion"] = $row->iddirecc;
			    $i++;
		    	}
    		}else{
    			foreach ($query->result() as $row){
    				$estab["nro_establecimiento"] = $row->nro_establecimiento;
    				$estab["idnomcom"] = $row->idnomcom;
    				$estab["estadoEst"] = $row->estado_establecimiento;
    				$estab["observaciones"] = $row->observaciones;
    			}
    		}
    	}
    	$this->db->close();
    	return $estab;
    	}
    	
    	
    	/**
    	 * Actualiza el estado de establacimientos cerrados
    	 * @author sjneirag
    	 * @since  08/05/2017
    	 */
    	function actualizaCierreEst($nro_estab, $estado_establecimiento, $motivoCierre, $anio, $mes){
    		// Inserta rmmh_admin_establecimientos
    		$data = array(
    				'estado_establecimiento'=>$estado_establecimiento,
    				'observaciones'=>$motivoCierre,
    				'anio_cierre' => $anio,
    				'mes_cierre' => $mes);
    		//$this->db->where("nro_orden",$nro_orden);
    		$this->db->where("nro_establecimiento",$nro_estab);
    		$this->db->update("rmmh_admin_establecimientos", $data);
    		$this->db->close();
    	
    		echo $this->db->last_query();
    		 
    	}
    	
    	
}

?>