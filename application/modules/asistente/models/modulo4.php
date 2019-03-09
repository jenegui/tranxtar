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
    
    /*****************
    
    function insertarCapitulo($habdia, $ihdo, $ihoa, $camdia, $icda, $icva, $ihpn, $ihpnr, $huetot, 
                              $mvnr, $mvnnr, $mvcr, $mvcnr, $mvor, $mvonr, $mvsr, $mvsnr, $mvotr, $mvotnr, $mvott, $mvottnr, 
                              $thsen, $ingsen, $inalosen, $thdob, $ingdob, $inalodob, $thsui, $ingsui, $inalosui, $thmult, $ingmult, $inalomul, $thotr, $ingotr, $inalootr, $thtot, $ingtot, $inalotot){            
    	$nro_orden = $this->session->userdata("nro_orden");     //Obtener desde la sesion
    	$uni_local = $this->session->userdata("uni_local");     //Obtener desde la sesion
    	$ano_periodo = $this->session->userdata("ano_periodo"); //Obtener desde la sesion
    	$mes_periodo = $this->session->userdata("mes_periodo"); //Obtener desde la sesion
    	$data = array('nro_orden' => $nro_orden,
    	              'uni_local' => $uni_local,
    	              'ano_periodo' => $ano_periodo,
    	              'mes_periodo' => $mes_periodo,
    	              'habdia' => $habdia,
    				  'ihdo' => $ihdo, 
    			      'ihoa' => $ihoa,
    			      'camdia' => $camdia,
    			      'icda' => $icda,
    			      'icva' => $icva,
    			      'ihpn' => $ihpn,
    			      'ihpnr' => $ihpnr,
    			      'huetot' => $huetot,
    			      'mvnr' => $mvnr,
    			      'mvnnr' => $mvnnr,
    				  'mvcr' => $mvcr,
    	              'mvcnr' => $mvcnr,
    			      'mvor' => $mvor,
    			      'mvonr' => $mvonr,
    			      'mvsr' => $mvsr,
    			      'mvsnr' => $mvsnr,
    			      'mvotr' => $mvotr,
    			      'mvotnr' => $mvotnr,
    			      'mvott' => $mvott,
    			      'mvottnr' => $mvottnr,
    			      'thsen' => $thsen,
    			      'ingsen' => $ingsen,
    			      'inalosen' => $inalosen,
    			      'thdob' => $thdob,
    			      'ingdob' => $ingdob,
    			      'inalodob' => $inalodob,
    			      'thsui' => $thsui,
    			      'ingsui' => $ingsui,
    			      'inalosui' => $inalosui,
    			      'thmult' => $thmult,
    			      'ingmult' => $ingmult,
    			      'inalomul' => $inalomul,
    			      'thotr' => $thotr,
    			      'ingotr' => $ingotr,
    			      'inalootr' => $inalootr,
    			      'thtot' => $thtot,
    			      'ingtot' => $ingtot,
    			      'inalotot' => $inalotot
    	);
		$this->db->insert('rmmh_form_caracthoteles', $data);
		$this->db->close();
    }

	function actualizarCapitulo($habdia, $ihdo, $ihoa, $camdia, $icda, $icva, $ihpn, $ihpnr, $huetot, 
                                $mvnr, $mvnnr, $mvcr, $mvcnr, $mvor, $mvonr, $mvsr, $mvsnr, $mvotr, $mvotnr, $mvott, $mvottnr, 
                                $thsen, $ingsen, $inalosen, $thdob, $ingdob, $inalodob, $thsui, $ingsui, $inalosui, $thmult, $ingmult, $inalomul, $thotr, $ingotr, $inalootr, $thtot, $ingtot, $inalotot){            
    	$nro_orden = $this->session->userdata("nro_orden");     //Obtener desde la sesion
    	$uni_local = $this->session->userdata("uni_local");     //Obtener desde la sesion
    	$ano_periodo = $this->session->userdata("ano_periodo"); //Obtener desde la sesion
    	$mes_periodo = $this->session->userdata("mes_periodo"); //Obtener desde la sesion
    	$data = array('habdia' => $habdia,
    				  'ihdo' => $ihdo, 
    			      'ihoa' => $ihoa,
    			      'camdia' => $camdia,
    			      'icda' => $icda,
    			      'icva' => $icva,
    			      'ihpn' => $ihpn,
    			      'ihpnr' => $ihpnr,
    			      'huetot' => $huetot,
    			      'mvnr' => $mvnr,
    			      'mvnnr' => $mvnnr,
    				  'mvcr' => $mvcr,
    	              'mvcnr' => $mvcnr,
    			      'mvor' => $mvor,
    			      'mvonr' => $mvonr,
    			      'mvsr' => $mvsr,
    			      'mvsnr' => $mvsnr,
    			      'mvotr' => $mvotr,
    			      'mvotnr' => $mvotnr,
    			      'mvott' => $mvott,
    			      'mvottnr' => $mvottnr,
    			      'thsen' => $thsen,
    			      'ingsen' => $ingsen,
    			      'inalosen' => $inalosen,
    			      'thdob' => $thdob,
    			      'ingdob' => $ingdob,
    			      'inalodob' => $inalodob,
    			      'thsui' => $thsui,
    			      'ingsui' => $ingsui,
    			      'inalosui' => $inalosui,
    			      'thmult' => $thmult,
    			      'ingmult' => $ingmult,
    			      'inalomul' => $inalomul,
    			      'thotr' => $thotr,
    			      'ingotr' => $ingotr,
    			      'inalootr' => $inalootr,
    			      'thtot' => $thtot,
    			      'ingtot' => $ingtot,
    			      'inalotot' => $inalotot
    	);
		$this->db->where("nro_orden",   $nro_orden);
		$this->db->where("uni_local",   $uni_local);
		$this->db->where("ano_periodo", $ano_periodo);
		$this->db->where("mes_periodo", $mes_periodo);
    	$this->db->update('rmmh_form_caracthoteles', $data);
		$this->db->close();
    }
    
	function actualizarCapituloCritico($nro_orden, $uni_local, $habdia, $ihdo, $ihoa, $camdia, $icda, $icva, $ihpn, $ihpnr, $huetot, 
                                $mvnr, $mvnnr, $mvcr, $mvcnr, $mvor, $mvonr, $mvsr, $mvsnr, $mvotr, $mvotnr, $mvott, $mvottnr, 
                                $thsen, $ingsen, $inalosen, $thdob, $ingdob, $inalodob, $thsui, $ingsui, $inalosui, $thmult, $ingmult, $inalomul, $thotr, $ingotr, $inalootr, $thtot, $ingtot, $inalotot){            
    	$ano_periodo = $this->session->userdata("ano_periodo"); //Obtener desde la sesion
    	$mes_periodo = $this->session->userdata("mes_periodo"); //Obtener desde la sesion
    	$data = array('habdia' => $habdia,
    				  'ihdo' => $ihdo, 
    			      'ihoa' => $ihoa,
    			      'camdia' => $camdia,
    			      'icda' => $icda,
    			      'icva' => $icva,
    			      'ihpn' => $ihpn,
    			      'ihpnr' => $ihpnr,
    			      'huetot' => $huetot,
    			      'mvnr' => $mvnr,
    			      'mvnnr' => $mvnnr,
    				  'mvcr' => $mvcr,
    	              'mvcnr' => $mvcnr,
    			      'mvor' => $mvor,
    			      'mvonr' => $mvonr,
    			      'mvsr' => $mvsr,
    			      'mvsnr' => $mvsnr,
    			      'mvotr' => $mvotr,
    			      'mvotnr' => $mvotnr,
    			      'mvott' => $mvott,
    			      'mvottnr' => $mvottnr,
    			      'thsen' => $thsen,
    			      'ingsen' => $ingsen,
    			      'inalosen' => $inalosen,
    			      'thdob' => $thdob,
    			      'ingdob' => $ingdob,
    			      'inalodob' => $inalodob,
    			      'thsui' => $thsui,
    			      'ingsui' => $ingsui,
    			      'inalosui' => $inalosui,
    			      'thmult' => $thmult,
    			      'ingmult' => $ingmult,
    			      'inalomul' => $inalomul,
    			      'thotr' => $thotr,
    			      'ingotr' => $ingotr,
    			      'inalootr' => $inalootr,
    			      'thtot' => $thtot,
    			      'ingtot' => $ingtot,
    			      'inalotot' => $inalotot
    	);
		$this->db->where("nro_orden",   $nro_orden);
		$this->db->where("uni_local",   $uni_local);
		$this->db->where("ano_periodo", $ano_periodo);
		$this->db->where("mes_periodo", $mes_periodo);
    	$this->db->update('rmmh_form_caracthoteles', $data);
		$this->db->close();
    }
    
	public function obtenerInfoCapitulo($nro_orden, $uni_local){
    	$capitulo4 = array(
    	  'op'=>'',
    	  'imagen'=>0,
    	  'habdia'=>'',
    	  'ihdo'=>'',
    	  'ihoa'=>'',
    	  'camdia'=>'',
    	  'icda'=>'',
    	  'icva'=>'',
    	  'ihpn'=>'',
    	  'ihpnr'=>'',
    	  'huetot'=>'',
    	  'mvnr'=>'',
    	  'mvnnr'=>'',
    	  'mvcr' => '',
    	  'mvcnr' => '',
    	  'mvor'=>'',
    	  'mvonr'=>'',
    	  'mvsr'=>'',
    	  'mvsnr'=>'',
    	  'mvotr'=>'',
    	  'mvotnr'=>'',
    	  'mvott'=>'',
    	  'mvottnr'=>'',
    	  'thsen'=>'',
    	  'ingsen'=>'',
    	  'inalosen'=>'',
    	  'thdob'=>'',
    	  'ingdob'=>'',
    	  'inalodob'=>'',
    	  'thsui'=>'',
    	  'ingsui'=>'',
    	  'inalosui'=>'',
    	  'thmult'=>'',
    	  'ingmult'=>'',
    	  'inalomul'=>'',
    	  'thotr'=>'',
    	  'ingotr'=>'',
    	  'inalootr'=>'',
    	  'thtot'=>'',
    	  'ingtot'=>'',
    	  'inalotot'=>''
    	);
    	$ano_periodo = $this->session->userdata("ano_periodo");
    	$mes_periodo = $this->session->userdata("mes_periodo");
    	$sql = "SELECT *
				FROM rmmh_form_caracthoteles C4, rmmh_admin_control CTRL
				WHERE C4.nro_orden = CTRL.nro_orden
				AND C4.uni_local = CTRL.uni_local
				AND C4.ano_periodo = CTRL.ano_periodo
				AND C4.mes_periodo = CTRL.mes_periodo
				AND CTRL.nro_orden = $nro_orden
				AND CTRL.uni_local = $uni_local
				AND CTRL.ano_periodo = $ano_periodo
				AND CTRL.mes_periodo = $mes_periodo";
    	$query = $this->db->query($sql);
    	if ($query->num_rows() > 0){
    		foreach ($query->result() as $row){
      			$capitulo4["op"] = "update";
    			$capitulo4["imagen"] = $row->cap4;
    			$capitulo4["habdia"] = $row->habdia;
    			$capitulo4["ihdo"] = $row->ihdo; 
    			$capitulo4["ihoa"] = $row->ihoa;
    			$capitulo4["camdia"] = $row->camdia;
    			$capitulo4["icda"] = $row->icda;
    			$capitulo4["icva"] = $row->icva;
    			$capitulo4["ihpn"] = $row->ihpn;
    			$capitulo4["ihpnr"] = $row->ihpnr;
    			$capitulo4["huetot"] = $row->huetot;
    			$capitulo4["mvnr"] = $row->mvnr;
    			$capitulo4["mvnnr"] = $row->mvnnr;
    			$capitulo4["mvcr"] = $row->mvcr;
    			$capitulo4["mvcnr"] = $row->mvcnr;
    			$capitulo4["mvor"] = $row->mvor;
    			$capitulo4["mvonr"] = $row->mvonr;
    			$capitulo4["mvsr"] = $row->mvsr;
    			$capitulo4["mvsnr"] = $row->mvsnr;
    			$capitulo4["mvotr"] = $row->mvotr;
    			$capitulo4["mvotnr"] = $row->mvotnr;
    			$capitulo4["mvott"] = $row->mvott;
    			$capitulo4["mvottnr"] = $row->mvottnr;
    			$capitulo4["thsen"] = $row->thsen;
    			$capitulo4["ingsen"] = $row->ingsen;
    			$capitulo4["inalosen"] = $row->inalosen;
    			$capitulo4["thdob"] = $row->thdob;
    			$capitulo4["ingdob"] = $row->ingdob;
    			$capitulo4["inalodob"] = $row->inalodob;
    			$capitulo4["thsui"] = $row->thsui;
    			$capitulo4["ingsui"] = $row->ingsui;
    			$capitulo4["inalosui"] = $row->inalosui;
    			$capitulo4["thmult"] = $row->thmult;
    			$capitulo4["ingmult"] = $row->ingmult;
    			$capitulo4["inalomul"] = $row->inalomul;
    			$capitulo4["thotr"] = $row->thotr;
    			$capitulo4["ingotr"] = $row->ingotr;
    			$capitulo4["inalootr"] = $row->inalootr;
    			$capitulo4["thtot"] = $row->thtot;
    			$capitulo4["ingtot"] = $row->ingtot;
    			$capitulo4["inalotot"] = $row->inalotot;     			
    		}   			
   		}
   		$this->db->close();
   		return $capitulo4;
    }
    
    
    *********************/
    
   
}//EOC  
