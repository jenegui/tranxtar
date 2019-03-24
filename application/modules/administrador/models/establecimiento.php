<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Establecimiento extends CI_Model {

    function __construct(){        
        parent::__construct();
        $this->load->database();
        $this->load->library("session");
    }
    
    /**
     * Obtiene la lista de los establecimientos que no tienen usuario asignado.
     * @author sjneirag
     * @since  30/05/2017
     */
    function obtenerEstablecimientos(){
    	$establecimiento = array();
    	$sql = "SELECT id_establecimiento, concat_ws(' - ', nit_establecimiento, idnomcom) as establecimiento
   		FROM txtar_admin_establecimientos
   		ORDER BY establecimiento ASC ";
    	 
    	$query = $this->db->query($sql);
    	
    	if ($query->num_rows()>0){
    		$i=0;
    		foreach($query->result() as $row){
    			$establecimiento[$i]["id_establecimiento"] = $row->id_establecimiento;
                        $establecimiento[$i]["establecimiento"] = $row->establecimiento;
                       $i++;
    		}
    	}
    	$this->db->close();
    	return $establecimiento;
    }
    
    /**
     * Obtiene la lista de los establecimientos creados por la empresa.
     * @author sjneirag
     * @since  21/06/2017
     */
    function obtenerEstablecimientosCreados(){
    	$establecimiento = array();
    	$sql = "SELECT EST.nro_orden, EST.nro_establecimiento, idnomcom, idsigla, iddirecc, idmpio, iddepto, idtelno, idfaxno, idcorreo, finicial, ffinal,
   		               fk_ciiu, fk_depto, fk_mpio, fk_sede, fk_subsede
   		FROM rmmh_admin_establecimientos EST WHERE EST.nro_establecimiento NOT IN (select CO.nro_establecimiento FROM rmmh_admin_control CO) AND estado_establecimiento = 0
   		ORDER BY nro_establecimiento ASC "; 
    
    	$query = $this->db->query($sql);
    	 
    	if ($query->num_rows()>0){
    		$i=0;
    		foreach($query->result() as $row){
    			$establecimiento[$i]["nro_orden"] = $row->nro_orden;
    			$establecimiento[$i]["nro_establecimiento"] = $row->nro_establecimiento;
    			$establecimiento[$i]["idnomcom"] = $row->idnomcom;
    			$establecimiento[$i]["idsigla"] = $row->idsigla;
    			$establecimiento[$i]["iddirecc"] = $row->iddirecc;
    			$establecimiento[$i]["idmpio"] = $row->idmpio;
    			$establecimiento[$i]["iddepto"] = $row->iddepto;
    			$establecimiento[$i]["idtelno"] = $row->idtelno;
    			$establecimiento[$i]["idfaxno"] = $row->idfaxno;
    			$establecimiento[$i]["idcorreo"] = $row->idcorreo;
    			$establecimiento[$i]["finicial"] = $row->finicial;
    			$establecimiento[$i]["ffinal"] = $row->ffinal;
    			$establecimiento[$i]["fk_ciiu"] = $row->fk_ciiu;
    			$establecimiento[$i]["fk_depto"] = $row->fk_depto;
    			$establecimiento[$i]["fk_mpio"] = $row->fk_mpio;
    			$establecimiento[$i]["fk_sede"] = $row->fk_sede;
    			$establecimiento[$i]["fk_subsede"] = $row->fk_subsede;
    			$i++;
    		}
    	}
    	$this->db->close();
    	return $establecimiento;
    }
    
    function obtenerEstablecimientosCerrados($ano_periodo, $mes_periodo){
    	$establecimiento = array();
    	$sql = "SELECT EST.nro_orden, EST.nro_establecimiento, idnomcom, idsigla, iddirecc, idmpio, iddepto, idtelno, idfaxno, idcorreo, finicial, ffinal,
   		               fk_ciiu, fk_depto, fk_mpio, fk_sede, fk_subsede
   		FROM rmmh_admin_establecimientos EST WHERE EST.nro_establecimiento IN (select CO.nro_establecimiento FROM rmmh_admin_control CO WHERE estado_control = 1 AND ano_periodo=$ano_periodo AND mes_periodo =  $mes_periodo) AND estado_establecimiento = 0
   		ORDER BY nro_establecimiento ASC "; 
    
    	$query = $this->db->query($sql);
    	if ($query->num_rows()>0){
    		$i=0;
    		foreach($query->result() as $row){
    			$establecimiento[$i]["nro_orden"] = $row->nro_orden;
    			$establecimiento[$i]["nro_establecimiento"] = $row->nro_establecimiento;
    			$establecimiento[$i]["idnomcom"] = $row->idnomcom;
    			$establecimiento[$i]["idsigla"] = $row->idsigla;
    			$establecimiento[$i]["iddirecc"] = $row->iddirecc;
    			$establecimiento[$i]["idmpio"] = $row->idmpio;
    			$establecimiento[$i]["iddepto"] = $row->iddepto;
    			$establecimiento[$i]["idtelno"] = $row->idtelno;
    			$establecimiento[$i]["idfaxno"] = $row->idfaxno;
    			$establecimiento[$i]["idcorreo"] = $row->idcorreo;
    			$establecimiento[$i]["finicial"] = $row->finicial;
    			$establecimiento[$i]["ffinal"] = $row->ffinal;
    			$establecimiento[$i]["fk_ciiu"] = $row->fk_ciiu;
    			$establecimiento[$i]["fk_depto"] = $row->fk_depto;
    			$establecimiento[$i]["fk_mpio"] = $row->fk_mpio;
    			$establecimiento[$i]["fk_sede"] = $row->fk_sede;
    			$establecimiento[$i]["fk_subsede"] = $row->fk_subsede;
    			$i++;
    		}
    	}
    	$this->db->close();
    	return $establecimiento;
    }
    
   	function obtenerDatosEstablecimiento($nro_establecimiento){
   		$establecimiento = array();
   		$sql = "SELECT id_establecimiento, idnomcom, nit_establecimiento, iddirecc, nom_contacto, idtelno, idfaxno, idcorreo, nom_contacto, 
   		               fk_depto, fk_mpio, estado_establecimiento,
                               CASE WHEN estado_establecimiento = 1 THEN 'Activo'
                               ELSE 'Inactivo' END AS nom_estado_establecimiento, 
                               observaciones
                FROM txtar_admin_establecimientos
                WHERE id_establecimiento = $nro_establecimiento ";
                
   	   $query = $this->db->query($sql);
   		if ($query->num_rows()>0){
			foreach($query->result() as $row){
				$establecimiento["nro_establecimiento"] = $row->id_establecimiento;
				$establecimiento["idnomcom"] = $row->idnomcom;
                                $establecimiento["nit_establecimiento"] = $row->nit_establecimiento;
				$establecimiento["iddirecc"] = $row->iddirecc;
				$establecimiento["idtelno"] = $row->idtelno;
				$establecimiento["idfaxno"] = $row->idfaxno;
				$establecimiento["idcorreo"] = $row->idcorreo;
				$establecimiento["nom_contacto"] = $row->nom_contacto;
                                $establecimiento["fk_depto"] = $row->fk_depto;
				$establecimiento["fk_mpio"] = $row->fk_mpio;
				$establecimiento["estado"] = $row->estado_establecimiento;
                                $establecimiento["nom_estado"] = $row->nom_estado_establecimiento;
                                $establecimiento["observaciones"] = $row->observaciones;
			}
		}
                 
		$this->db->close();
		return $establecimiento;
   	}
   	
   	function insertarEstablecimiento($txtNumEstab, $txtNitEmpresa, $txtNomEstab, $txtDirEstab,$idtelefono,$idcorreo, $cmbDeptoEstab, $cmbMpioEstab, $nom_contacto,$observaciones){
   		$data = array('id_establecimiento' => $txtNumEstab, 
   		              'idnomcom' => $txtNomEstab,
                               'nit_establecimiento' => $txtNitEmpresa,
   		              'iddirecc' => $txtDirEstab, 
   		              'idtelno' => $idtelefono, 
   		              'idcorreo' => $idcorreo,
                              'nom_contacto' => $nom_contacto,
   		              'fk_depto' => $cmbDeptoEstab, 
   		              'fk_mpio' => $cmbMpioEstab, 
   		              'estado_establecimiento' => 1,
                              'observaciones' => $observaciones);
   		$this->db->insert('txtar_admin_establecimientos', $data); 
   		
   	}
   	

   	function estado_establecimiento($nro_orden, $nro_establecimiento, $idnomcom, $idsigla, $iddirecc, $idmpio, $iddepto, $idtelno, $idfaxno, $idcorreo, $fk_ciiu, $fk_depto, $fk_mpio, $fk_sede, $fk_subsede){
   		$data = array('idnomcom' => $idnomcom,
                      'idsigla' => $idsigla,
                      'iddirecc' => $iddirecc,
   		              'idmpio' => $idmpio,
   		              'iddepto' => $iddepto,
   		              'idtelno' => $idtelno,
   		              'idfaxno' => $idfaxno,
   		              'idcorreo' => $idcorreo,
   		              'fk_ciiu' => $fk_ciiu,
   		              'fk_depto' => $fk_depto,
   		              'fk_mpio' => $fk_mpio,
   		              'fk_sede' => $fk_sede,
   		              'fk_subsede' => $fk_subsede
                );
		$this->db->where('nro_orden', $nro_orden);
		$this->db->where('nro_establecimiento', $nro_establecimiento);
		$this->db->update('rmmh_admin_establecimientos', $data);
   	}
        
        function actualizarEstablecimiento($hddNroEstablecimiento, $idnomcomest, $iddireccest, $idtelnoest, $idfaxnoest, $idcorreoest, $nom_contacto, $cmbDeptoEst, $cmbMpioEst, $estado_establecimiento, $observaciones){
   		$data = array('idnomcom' => $idnomcomest,
                            'iddirecc' => $iddireccest,
   		              'idtelno' => $idtelnoest,
   		              'idfaxno' => $idfaxnoest,
   		              'idcorreo' => $idcorreoest,
                              'nom_contacto' => $nom_contacto,
   		              'fk_depto' => $cmbDeptoEst,
   		              'fk_mpio' => $cmbMpioEst,
   		              'estado_establecimiento' => $estado_establecimiento,
   		              'observaciones' => $observaciones
                );
		$this->db->where('id_establecimiento', $hddNroEstablecimiento);
		$this->db->update('txtar_admin_establecimientos', $data);
   	}
        
        
        function estado_aper_establecimiento($nro_orden, $nro_establecimiento){
   		$data = array('estado_establecimiento' => 1 
                );
		$this->db->where('nro_orden', $nro_orden);
		$this->db->where('nro_establecimiento', $nro_establecimiento);
		$this->db->update('rmmh_admin_establecimientos', $data);
   	}
   	
        function inactivarCliente($nro_establecimiento){
   		$data = array('estado_establecimiento' => 0 
                );
		$this->db->where('id_establecimiento', $nro_establecimiento);
		$this->db->update('txtar_admin_establecimientos', $data);
   	}
}//EOC