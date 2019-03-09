<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modulo4 extends CI_Model {

    function __construct(){        
        parent::__construct();
        $this->load->database();
        $this->load->library("session");        
    }
    
    function obtenerModulo($nro_orden, $nro_establecimiento, $ano_periodo, $mes_periodo){
    	$modulo4 = array();
    	$sql = "SELECT C.modulo4, CH.ihdo, CH.ihoa, CH.ihoavd, CH.ihoatc, CH.icda, CH.icva, CH.ihpnvd, CH.ihpntc, CH.ihpn, CH.ihpnrvd, CH.ihpnrtc, CH.ihpnr, CH.huetot, CH.mvnr, CH.mvnnr, CH.mvcr, CH.mvcnr, CH.mvor, CH.mvonr,
                       CH.mvsr, CH.mvsnr, CH.mvotr, CH.mvotnr, CH.mvam, CH.mvamnr, CH.mvott, CH.mvottnr, CH.thsen, CH.thusen, CH.thdob, CH.thudob, CH.thsui, CH.thusui, CH.thmult, CH.thumult, CH.thotr, CH.thuotr, CH.thtot
                FROM rmmh_form_caracthoteles CH, rmmh_admin_control C
                WHERE CH.nro_orden = C.nro_orden
                AND CH.nro_establecimiento = C.nro_establecimiento
                AND CH.ano_periodo = C.ano_periodo
                AND CH.mes_periodo = C.mes_periodo
                AND C.nro_orden = $nro_orden
                AND C.nro_establecimiento = $nro_establecimiento
                AND C.ano_periodo = $ano_periodo
                AND C.mes_periodo = $mes_periodo";    
    	$query = $this->db->query($sql);
    	if ($query->num_rows() > 0){
    		foreach ($query->result() as $row){
      			$modulo4["op"] = "update";
    			$modulo4["imagen"] = $row->modulo4;
    			$modulo4["ihdo"] = $row->ihdo; 
    			$modulo4["ihoa"] = $row->ihoa;
    			$modulo4["ihoavd"] = $row->ihoavd;
    			$modulo4["ihoatc"] = $row->ihoatc;
    			$modulo4["icda"] = $row->icda;
    			$modulo4["icva"] = $row->icva;
                        $modulo4["ihpnvd"] = $row->ihpnvd;
                        $modulo4["ihpntc"] = $row->ihpntc;
    			$modulo4["ihpn"] = $row->ihpn;
                        $modulo4["ihpnrvd"] = $row->ihpnrvd;
                        $modulo4["ihpnrtc"] = $row->ihpnrtc;
    			$modulo4["ihpnr"] = $row->ihpnr;
    			$modulo4["huetot"] = $row->huetot;
    			$modulo4["mvnr"] = $row->mvnr;
    			$modulo4["mvnnr"] = $row->mvnnr;
    			$modulo4["mvcr"] = $row->mvcr;
    			$modulo4["mvcnr"] = $row->mvcnr;
    			$modulo4["mvor"] = $row->mvor;
    			$modulo4["mvonr"] = $row->mvonr;
    			$modulo4["mvsr"] = $row->mvsr;
    			$modulo4["mvsnr"] = $row->mvsnr;
    			$modulo4["mvam"] = $row->mvam;
    			$modulo4["mvamnr"] = $row->mvamnr;
    			$modulo4["mvotr"] = $row->mvotr;
    			$modulo4["mvotnr"] = $row->mvotnr;
    			$modulo4["mvott"] = $row->mvott;
    			$modulo4["mvottnr"] = $row->mvottnr;
    			$modulo4["thsen"] = $row->thsen;
    			$modulo4["thusen"] = $row->thusen;
    			$modulo4["thdob"] = $row->thdob;
    			$modulo4["thudob"] = $row->thudob;
    			$modulo4["thsui"] = $row->thsui;
    			$modulo4["thusui"] = $row->thusui;
    			$modulo4["thmult"] = $row->thmult;
    			$modulo4["thumult"] = $row->thumult;
    			$modulo4["thotr"] = $row->thotr;
    			$modulo4["thuotr"] = $row->thuotr;
    			$modulo4["thtot"] = $row->thtot;
    		}   			
   		}
   		else{
                $modulo4["op"] = "insert";
    		$modulo4["imagen"] = 0;
    		$modulo4["ihdo"] = "0"; 
    		$modulo4["ihoa"] = "0";
    		$modulo4["ihoavd"] = "0";
    		$modulo4["ihoatc"] = "0";
    		$modulo4["icda"] = "0";
    		$modulo4["icva"] = "0";
                $modulo4["ihpnvd"] = "0";
                $modulo4["ihpntc"] = "0";
    		$modulo4["ihpn"] = "0";
                $modulo4["ihpnrvd"] = "0";
                $modulo4["ihpnrtc"] = "0";
    		$modulo4["ihpnr"] = "0";
    		$modulo4["huetot"] = "";
    		$modulo4["mvnr"] = "0";
    		$modulo4["mvnnr"] = "0";
    		$modulo4["mvcr"] = "0";
    		$modulo4["mvcnr"] = "0";
    		$modulo4["mvor"] = "0";
    		$modulo4["mvonr"] = "0";
    		$modulo4["mvsr"] = "0";
    		$modulo4["mvsnr"] = "0";
    		$modulo4["mvotr"] = "0";
    		$modulo4["mvotnr"] = "0";
    		$modulo4["mvotr"] = "0";
    		$modulo4["mvam"] = "0";
    		$modulo4["mvamnr"] = "0";
    		$modulo4["mvott"] = "";
    		$modulo4["mvottnr"] = "";
    		$modulo4["thsen"] = "0";
    		$modulo4["thusen"] = "0";
    		$modulo4["thdob"] = "0";
    		$modulo4["thudob"] = "0";
    		$modulo4["thsui"] = "0";
    		$modulo4["thusui"] = "0";
    		$modulo4["thmult"] = "0";
    		$modulo4["thumult"] = "0";
    		$modulo4["thotr"] = "0";
    		$modulo4["thuotr"] = "0";
    		$modulo4["thtot"] = "";
    	}     	
    	$this->db->close();
   		return $modulo4;   		
    }
    
function actualizarModulo($ihdo, $ihoa, $ihoavd, $ihoatc, $icda, $icva, $ihpnvd, $ihpntc, $ihpn, $ihpnrvd, $ihpnrtc, $ihpnr, $huetot, $mvnr, $mvcr, $mvor, $mvsr, $mvotr, $mvam, $mvamnr, $mvott, $mvnnr, $mvcnr, $mvonr, $mvsnr, $mvotnr, $mvottnr, $thsen, $thusen, $thdob, $thudob, $thsui, $thusui, $thmult, $thumult, $thotr, $thuotr, $thtot, $tphto, $nro_orden, $nro_establecimiento, $ano_periodo, $mes_periodo){
    	$data = array('ihdo' => $ihdo, 'ihoa' => $ihoa,
                    'ihoavd' => $ihoavd, 'ihoatc' => $ihoatc,
                    'icda' => $icda, 'icva' => $icva,
                    'ihpnvd' => $ihpnvd, 'ihpntc' => $ihpntc, 
                    'ihpn' => $ihpn, 'ihpnrvd' => $ihpnrvd,
                    'ihpnrtc' => $ihpnrtc, 'ihpnr' => $ihpnr,
                    'huetot' => $huetot, 'mvnr' => $mvnr, 
                    'mvcr' => $mvcr, 'mvor' => $mvor, 
                    'mvsr' => $mvsr, 'mvotr' => $mvotr,
                    'mvam' => $mvam, 'mvamnr' => $mvamnr,	 
                    'mvott' => $mvott, 'mvnnr' => $mvnnr, 
                    'mvcnr' => $mvcnr, 'mvonr' => $mvonr, 
                    'mvsnr' => $mvsnr, 'mvotnr' => $mvotnr, 
                    'mvottnr' => $mvottnr, 'thsen' => $thsen,
                    'thusen' => $thusen, 'thdob' => $thdob, 
                    'thudob' => $thudob, 'thsui' => $thsui, 
                    'thusui' => $thusui, 'thmult' => $thmult, 
                    'thumult' => $thumult, 'thotr' => $thotr,
                    'thuotr' => $thuotr, 'thtot' => $thtot, 
                    'tphto' => $tphto);
    	$this->db->where("nro_orden", $nro_orden);
		$this->db->where("nro_establecimiento", $nro_establecimiento);
		$this->db->where("ano_periodo", $ano_periodo);
		$this->db->where("mes_periodo", $mes_periodo);
    	$this->db->update('rmmh_form_caracthoteles', $data);
		$this->db->close();
		echo $this->db->last_query();
    }
    
function insertarModulo($ihdo, $ihoa, $ihoavd, $ihoatc, $icda, $icva, $ihpnvd, $ihpntc, $ihpn, $ihpnrvd, $ihpnrtc, $ihpnr, $huetot, $mvnr, $mvcr, $mvor, $mvsr, $mvotr, $mvam, $mvamnr, $mvott, $mvnnr, $mvcnr, $mvonr, $mvsnr, $mvotnr, $mvottnr, $thsen, $thusen, $thdob, $thudob, $thsui, $thusui, $thmult, $thumult, $thotr, $thuotr, $thtot, $tphto, $nro_orden, $nro_establecimiento, $ano_periodo, $mes_periodo){
    	$data = array('ihdo' => $ihdo, 'ihoa' => $ihoa,
                    'ihoavd' => $ihoavd, 'ihoatc' => $ihoatc,
                    'icda' => $icda, 'icva' => $icva, 
                    'ihpnvd' => $ihpnvd, 'ihpntc' => $ihpntc, 
                    'ihpn' => $ihpn, 'ihpnrvd' => $ihpnrvd,
                    'ihpnrtc' => $ihpnrtc, 'ihpnr' => $ihpnr, 
                    'huetot' => $huetot, 'mvnr' => $mvnr, 
                    'mvcr' => $mvcr, 'mvor' => $mvor, 
                    'mvsr' => $mvsr, 'mvotr' => $mvotr,
                    'mvam' => $mvam, 'mvamnr' => $mvamnr,
                    'mvott' => $mvott, 'mvnnr' => $mvnnr, 
                    'mvcnr' => $mvcnr, 'mvonr' => $mvonr, 
                    'mvsnr' => $mvsnr, 'mvotnr' => $mvotnr, 
                    'mvottnr' => $mvottnr, 'thsen' => $thsen,
                    'thusen' => $thusen, 'thdob' => $thdob, 
                    'thudob' => $thudob, 'thsui' => $thsui, 
                    'thusui' => $thusui,  'thmult' => $thmult,
                    'thumult' => $thumult, 'thotr' => $thotr, 
                    'thuotr' => $thuotr, 'thtot' => $thtot, 
                    'tphto' => $tphto, 'nro_orden' => $nro_orden,
                    'nro_establecimiento' => $nro_establecimiento,
                    'ano_periodo' => $ano_periodo, 'mes_periodo' => $mes_periodo);
    	$this->db->insert('rmmh_form_caracthoteles', $data);
		$this->db->close();
		
		echo $this->db->last_query(); 
    }
    
	function descargaPlanosModulo($ano_periodo, $mes_periodo){
    	$modulo4 = array();
    	$sql = "SELECT IFNULL(CH.habdia,0) AS habdia,
                       IFNULL(CH.ihdo,0) AS ihdo,
                       IFNULL(CH.ihoa,0) AS ihoa,
                       IFNULL(CH.camdia,0) AS camdia,
                       IFNULL(CH.icda,0) AS icda,
                       IFNULL(CH.icva,0) AS icva,
                       IFNULL(CH.ihpn,0) AS ihpn,
                       IFNULL(CH.ihpnr,0) AS ihpnr,
                       IFNULL(CH.huetot,0) AS huetot,
                       IFNULL(CH.mvnr,0) AS mvnr,
                       IFNULL(CH.mvcr,0) AS mvcr,
                       IFNULL(CH.mvor,0) AS mvor,
                       IFNULL(CH.mvsr,0) AS mvsr,
                       IFNULL(CH.mvotr,0) AS mvotr,
                       IFNULL(CH.mvott,0) AS mvott,
                       IFNULL(CH.mvnnr,0) AS mvnnr,
                       IFNULL(CH.mvcnr,0) AS mvcnr,
                       IFNULL(CH.mvonr,0) AS mvonr,
                       IFNULL(CH.mvsnr,0) AS mvsnr,
                       IFNULL(CH.mvotnr,0) AS mvotnr,
                       IFNULL(CH.mvottnr,0) AS mvottnr,
                       IFNULL(CH.thsen,0) AS thsen,
                       IFNULL(CH.thusen,0) AS thusen,
                       IFNULL(CH.thdob,0) AS thdob,
                       IFNULL(CH.thudob,0) AS thudob,
                       IFNULL(CH.thsui,0) AS thsui,
                       IFNULL(CH.thusui,0) AS thusui,
                       IFNULL(CH.thmult,0) AS thmult,
                       IFNULL(CH.thumult,0) AS thumult,
                       IFNULL(CH.thotr,0) AS thotr,
                       IFNULL(CH.thuotr,0) AS thuotr,
                       IFNULL(CH.thtot,0) AS thtot,
                       IFNULL(CH.ingsen,0) AS ingsen,
                       IFNULL(CH.ingdob,0) AS ingdob,
                       IFNULL(CH.ingsui,0) AS ingsui,
                       IFNULL(CH.ingmult,0) AS ingmult,
                       IFNULL(CH.ingotr,0) AS ingotr,
                       IFNULL(CH.ingtot,0) AS ingtot,
                       IFNULL(CH.tphto,0) AS tphto,
                       IFNULL(CH.inalosen,0) AS inalosen,
                       IFNULL(CH.inalodob,0) AS inalodob,
                       IFNULL(CH.inalosui,0) AS inalosui,
                       IFNULL(CH.inalomul,0) AS inalomul,
                       IFNULL(CH.inalootr,0) AS inalootr,
                       IFNULL(CH.inalotot,0) AS inalotot,
                       C.nro_orden, C.nro_establecimiento, C.ano_periodo, C.mes_periodo, C.fk_novedad, C.fk_estado
                FROM rmmh_admin_control C
                LEFT JOIN rmmh_form_caracthoteles CH ON (C.nro_orden = CH.nro_orden AND C.nro_establecimiento = CH.nro_establecimiento AND C.ano_periodo = CH.ano_periodo AND C.mes_periodo = CH.mes_periodo)
                WHERE C.ano_periodo = $ano_periodo
                AND C.mes_periodo = $mes_periodo";
    	$query = $this->db->query($sql);
    	if ($query->num_rows()>0){
    		$i = 0;
    		foreach ($query->result() as $row){
      			$modulo4[$i]["habdia"] = $row->habdia; 
      			$modulo4[$i]["ihdo"] = $row->ihdo; 
      			$modulo4[$i]["ihoa"] = $row->ihoa; 
      			$modulo4[$i]["camdia"] = $row->camdia; 
      			$modulo4[$i]["icda"] = $row->icda; 
      			$modulo4[$i]["icva"] = $row->icva; 
      			$modulo4[$i]["ihpn"] = $row->ihpn; 
      			$modulo4[$i]["ihpnr"] = $row->ihpnr; 
      			$modulo4[$i]["huetot"] = $row->huetot; 
      			$modulo4[$i]["mvnr"] = $row->mvnr; 
      			$modulo4[$i]["mvcr"] = $row->mvcr; 
      			$modulo4[$i]["mvor"] = $row->mvor; 
      			$modulo4[$i]["mvsr"] = $row->mvsr; 
      			$modulo4[$i]["mvotr"] = $row->mvotr; 
      			$modulo4[$i]["mvott"] = $row->mvott; 
      			$modulo4[$i]["mvnnr"] = $row->mvnnr; 
      			$modulo4[$i]["mvcnr"] = $row->mvcnr; 
      			$modulo4[$i]["mvonr"] = $row->mvonr; 
      			$modulo4[$i]["mvsnr"] = $row->mvsnr; 
      			$modulo4[$i]["mvotnr"] = $row->mvotnr; 
      			$modulo4[$i]["mvottnr"] = $row->mvottnr; 
      			$modulo4[$i]["thsen"] = $row->thsen;
      			$modulo4[$i]["thusen"] = $row->thusen;
      			$modulo4[$i]["thdob"] = $row->thdob;
      			$modulo4[$i]["thudob"] = $row->thudob;
      			$modulo4[$i]["thsui"] = $row->thsui; 
      			$modulo4[$i]["thusui"] = $row->thusui;
      			$modulo4[$i]["thmult"] = $row->thmult;
      			$modulo4[$i]["thumult"] = $row->thumult;
      			$modulo4[$i]["thotr"] = $row->thotr;
      			$modulo4[$i]["thuotr"] = $row->thuotr;
      			$modulo4[$i]["thtot"] = $row->thtot; 
      			$modulo4[$i]["ingsen"] = $row->ingsen; 
      			$modulo4[$i]["ingdob"] = $row->ingdob; 
      			$modulo4[$i]["ingsui"] = $row->ingsui; 
      			$modulo4[$i]["ingmult"] = $row->ingmult; 
      			$modulo4[$i]["ingotr"] = $row->ingotr; 
      			$modulo4[$i]["ingtot"] = $row->ingtot; 
      			$modulo4[$i]["tphto"] = $row->tphto; 
      			$modulo4[$i]["inalosen"] = $row->inalosen; 
      			$modulo4[$i]["inalodob"] = $row->inalodob; 
      			$modulo4[$i]["inalosui"] = $row->inalosui; 
      			$modulo4[$i]["inalomul"] = $row->inalomul; 
      			$modulo4[$i]["inalootr"] = $row->inalootr; 
      			$modulo4[$i]["inalotot"] = $row->inalotot; 
      			$modulo4[$i]["nro_orden"] = $row->nro_orden; 
      			$modulo4[$i]["nro_establecimiento"] = $row->nro_establecimiento; 
      			$modulo4[$i]["ano_periodo"] = $row->ano_periodo; 
      			$modulo4[$i]["mes_periodo"] = $row->mes_periodo;
      			$modulo4[$i]["fk_novedad"] = $row->fk_novedad;
      			$modulo4[$i]["fk_estado"] = $row->fk_estado;
      			$modulo4[$i]["estado"] = $this->novedad->nombreEstadoFormulario($row->fk_novedad, $row->fk_estado);
    			$i++;
    		}
    	}
    	$this->db->close();
   		return $modulo4;
    }
    
}//EOC  
