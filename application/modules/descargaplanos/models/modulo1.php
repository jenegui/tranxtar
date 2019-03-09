<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Modulo1 extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library("session");
        $this->load->library("general");
    }

    function obtenerModulo($nro_orden, $nro_establecimiento, $ano_periodo, $mes_periodo) {
        $modulo1 = array();
        $sql = "SELECT CTRL.modulo1, CTRL.nro_orden, CTRL.nro_establecimiento, EMP.idnit, EMP.iddv, EMP.idproraz, EMP.idnomcom, EMP.idsigla, EMP.iddirecc, EMP.fk_depto, 
    	               EMP.fk_mpio, EMP.idtelno, EMP.idfaxno, EMP.idpagweb, EMP.idcorreo, DATE_FORMAT(EST.finicial,'%d/%m/%Y') AS finicial, DATE_FORMAT(EST.ffinal,'%d/%m/%Y') AS ffinal, EST.idnomcom AS idnomcomest, EST.idsigla AS idsiglaest, 
    	               EST.iddirecc AS iddireccest, EST.iddepto AS iddeptoest, EST.idmpio AS idmpioest, EST.idtelno AS idtelnoest, EST.idfaxno AS idfaxnoest, EST.idcorreo AS idcorreoest, EMP.nom_cadena AS nom_cadena, EMP.nom_operador AS nom_operador, EST.fk_ciiu AS fk_ciiu,
    	               CIU.nom_ciiu AS nom_ciiu
                FROM rmmh_admin_control CTRL, rmmh_admin_empresas EMP, rmmh_admin_establecimientos EST, rmmh_param_ciiu3 CIU 
                WHERE CTRL.nro_orden = EMP.nro_orden
                AND CTRL.nro_establecimiento = EST.nro_establecimiento
                AND EMP.nro_orden = EST.nro_orden
                AND CIU.id_ciiu = EST.fk_ciiu
                AND CTRL.nro_orden = $nro_orden
                AND CTRL.nro_establecimiento = $nro_establecimiento
                AND CTRL.ano_periodo = $ano_periodo
                AND CTRL.mes_periodo = $mes_periodo";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $modulo1["imagen"] = $row->modulo1;
                $modulo1["nro_orden"] = $row->nro_orden;
                $modulo1["nro_establecimiento"] = $row->nro_establecimiento;
                $modulo1["idnit"] = $row->idnit;
                $modulo1["iddv"] = $row->iddv;
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
                $modulo1["nom_cadena"] = strtoupper($row->nom_cadena);
                $modulo1["nom_operador"] = strtoupper($row->nom_operador);
                $modulo1["fk_ciiu"] = strtoupper($row->fk_ciiu);
                $modulo1["nom_ciiu"] = strtoupper($row->nom_ciiu);
            }
        }
        $this->db->close();
        return $modulo1;
    }

    function actualizarModulo($nro_orden, $nro_establecimiento, $idnit, $idproraz, $idnomcom, $idsigla, $iddirecc, $iddepto, $idmpio, $idtelno, $idfaxno, $idpagweb, $idcorreo, $finicial, $ffinal, $idnomcomest, $idsiglaest, $iddireccest, $iddeptoest, $idmpioest, $idtelnoest, $idfaxnoest, $idcorreoest, $nom_cadena, $nom_operador) {
        // Limpiar las fechas del formato DANE y pasarlas a formato MySQL
        $arrayIni = explode("/", $finicial);
        $arrayFin = explode("/", $ffinal);
        $fechaInicial = $arrayIni[2] . "-" . $arrayIni[1] . "-" . $arrayIni[0];
        $fechaFinal = $arrayFin[2] . "-" . $arrayFin[1] . "-" . $arrayFin[0];
        // Actualizar rmmh_admin_empresas
        $data = array('idnit' => $idnit,
            'idproraz' => $idproraz,
            'idnomcom' => $idnomcom,
            'idsigla' => $idsigla,
            'iddirecc' => $iddirecc,
            'idtelno' => $idtelno,
            'idfaxno' => $idfaxno,
            'idaano' => '',
            'idpagweb' => $idpagweb,
            'idcorreo' => $idcorreo,
            'fk_depto' => $iddepto,
            'fk_mpio' => $idmpio,
            'nom_cadena' => $nom_cadena,
            'nom_operador' => $nom_operador);
        $this->db->where("nro_orden", $nro_orden);
        $this->db->update("rmmh_admin_empresas", $data);

        // Actualizar rmmh_admin_establecimientos
        $data = array('idnomcom' => $idnomcomest,
            'idsigla' => $idsiglaest,
            'iddirecc' => $iddireccest,
            'idmpio' => $idmpioest,
            'iddepto' => $iddeptoest,
            'idtelno' => $idtelnoest,
            'idfaxno' => $idfaxnoest,
            'idcorreo' => $idcorreoest,
            'finicial' => $fechaInicial,
            'ffinal' => $fechaFinal);
        $this->db->where("nro_orden", $nro_orden);
        $this->db->where("nro_establecimiento", $nro_establecimiento);
        $this->db->update("rmmh_admin_establecimientos", $data);
        $this->db->close();
    }

    /*     * *************
      function descargaPlanosModulo($ano_periodo, $mes_periodo){
      $modulo1 = array();
      //SE CAMBIA ESTA CONSULTA PARA HACER QUE EL ESTADO DE LA NOVEDAD DEL CAPITULO COINCIDA CON LA QUE ESTÁ REPORTADA EN EL HISTORICO DE NOVEDADES
      $sql = "SELECT U.log_usuario, U.pass_usuario, CTRL.ano_periodo, CTRL.mes_periodo, CTRL.nro_orden, CTRL.nro_establecimiento, EST.ulocal, EMP.idnit, EMP.idproraz, EMP.idnomcom, EMP.idsigla, EMP.iddirecc, EMP.fk_depto, EMP.fk_mpio, EMP.idtelno, EMP.idfaxno, EMP.idpagweb, EMP.idcorreo, EST.finicial, EST.ffinal,
      EST.idnomcom AS idnomcomest, EST.idsigla AS idsiglaest, EST.iddirecc AS iddireccest, EST.iddepto AS iddeptoest, EST.idmpio AS idmpioest, EST.idtelno AS idtelnoest, EST.idfaxno AS idfaxnoest, EST.idcorreo AS idcorreoest, CTRL.fk_sede, CTRL.fk_subsede,
      CTRL.fk_novedad, CTRL.fk_estado, CASE CTRL.fk_estado
      WHEN 0 THEN 'En Deuda'
      WHEN 1 THEN 'Notificado'
      WHEN 2 THEN 'En digitacion'
      WHEN 3 THEN 'Digitado'
      WHEN 4 THEN 'Analisis - Verificacion'
      WHEN 5 THEN 'Verificado'
      END nom_estado
      FROM rmmh_admin_control CTRL, rmmh_admin_empresas EMP, rmmh_admin_establecimientos EST, rmmh_admin_usuarios U
      WHERE CTRL.nro_orden = EMP.nro_orden
      AND CTRL.nro_establecimiento = EST.nro_establecimiento
      AND EMP.nro_orden = EST.nro_orden
      AND CTRL.nro_orden = U.nro_orden
      AND CTRL.nro_establecimiento = U.nro_establecimiento
      AND CTRL.ano_periodo = $ano_periodo
      AND CTRL.mes_periodo = $mes_periodo
      ORDER BY CTRL.nro_establecimiento ASC";

      //
      // Vuelvo a cambiar la consulta para la descarga de planos. (Julio 18, 2013)
      // NO cuadran el numero de registros de novedades generados en el plano, con el numero de registros de novedades reportados en control.
      //
      $sql = "SELECT U.log_usuario, U.pass_usuario, CTRL.ano_periodo, CTRL.mes_periodo, CTRL.nro_orden, CTRL.nro_establecimiento, EST.ulocal, EMP.idnit, EMP.idproraz, EMP.idnomcom, EMP.idsigla, EMP.iddirecc, EMP.fk_depto, EMP.fk_mpio, EMP.idtelno, EMP.idfaxno, EMP.idpagweb, EMP.idcorreo, EST.finicial, EST.ffinal,
      EST.idnomcom AS idnomcomest, EST.idsigla AS idsiglaest, EST.fk_ciiu AS idact, EST.iddirecc AS iddireccest, EST.iddepto AS iddeptoest, EST.idmpio AS idmpioest, EST.idtelno AS idtelnoest, EST.idfaxno AS idfaxnoest, EST.idcorreo AS idcorreoest, CTRL.fk_sede, CTRL.fk_subsede,
      IFNULL(HN.fk_novedad, CTRL.fk_novedad) AS fk_novedad, CTRL.fk_estado, CASE CTRL.fk_estado
      WHEN 0 THEN 'En Deuda'
      WHEN 1 THEN 'Notificado'
      WHEN 2 THEN 'En digitacion'
      WHEN 3 THEN 'Digitado'
      WHEN 4 THEN 'Analisis - Verificacion'
      WHEN 5 THEN 'Verificado'
      END nom_estado
      FROM rmmh_admin_control CTRL
      LEFT JOIN rmmh_admin_histnovedades HN ON (CTRL.nro_orden = HN.nro_orden
      AND CTRL.nro_establecimiento = HN.nro_establecimiento
      AND CTRL.ano_periodo = HN.ano_periodo
      AND CTRL.mes_periodo = HN.mes_periodo), rmmh_admin_empresas EMP, rmmh_admin_establecimientos EST, rmmh_admin_usuarios U
      WHERE CTRL.nro_orden = EMP.nro_orden
      AND CTRL.nro_orden = EST.nro_orden
      AND CTRL.nro_establecimiento = EST.nro_establecimiento
      AND CTRL.nro_orden = U.nro_orden
      AND CTRL.nro_establecimiento = U.nro_establecimiento
      AND CTRL.ano_periodo = $ano_periodo
      AND CTRL.mes_periodo = $mes_periodo
      GROUP BY CTRL.nro_establecimiento
      ORDER BY CTRL.nro_establecimiento ASC";
      $query = $this->db->query($sql);
      if ($query->num_rows()>0){
      $i = 0;
      foreach ($query->result() as $row){
      //Datos de Empresa
      $modulo1[$i]["ano_periodo"] = $row->ano_periodo;
      $modulo1[$i]["mes_periodo"] = $row->mes_periodo;
      $modulo1[$i]["nro_orden"] = $row->nro_orden;
      $modulo1[$i]["nro_establecimiento"] = $row->nro_establecimiento;
      $modulo1[$i]["ulocal"] = $row->ulocal;
      $modulo1[$i]["usuario"] = $row->log_usuario;
      $modulo1[$i]["contrasena"] = $this->danecrypt->decode($row->pass_usuario);
      $modulo1[$i]["idnit"] = $row->idnit;
      $modulo1[$i]["idproraz"] = $row->idproraz;
      $modulo1[$i]["idnomcom"] = $row->idnomcom;
      $modulo1[$i]["idsigla"] = $row->idsigla;
      $modulo1[$i]["iddirecc"] = $row->iddirecc;
      $modulo1[$i]["iddepto"] = $row->fk_depto;
      $modulo1[$i]["nom_depto"] = $this->divipola->nombreDepartamento($row->fk_depto);
      $modulo1[$i]["idmpio"] = $row->fk_mpio;
      $modulo1[$i]["nom_mpio"] = $this->divipola->nombreMunicipio($row->fk_mpio);
      $modulo1[$i]["idtelno"] = $row->idtelno;
      $modulo1[$i]["idfaxno"] = $row->idfaxno;
      $modulo1[$i]["idpagweb"] = $row->idpagweb;
      $modulo1[$i]["idcorreo"] = $row->idcorreo;
      $modulo1[$i]["finicial"] = $row->finicial;
      $modulo1[$i]["ffinal"] = $row->ffinal;
      //Datos de Establecimiento
      $modulo1[$i]["idnomcomest"] = $row->idnomcomest;
      $modulo1[$i]["idsiglaest"] = $row->idsiglaest;
      $modulo1[$i]["idact"] = $row->idact;
      $modulo1[$i]["iddireccest"] = $row->iddireccest;
      $modulo1[$i]["iddeptoest"] = $row->iddeptoest;
      $modulo1[$i]["nom_deptoest"] = $this->divipola->nombreDepartamento($row->iddeptoest);
      $modulo1[$i]["idmpioest"] = $row->idmpioest;
      $modulo1[$i]["nom_mpioest"] = $this->divipola->nombreMunicipio($row->idmpioest);
      $modulo1[$i]["idtelnoest"] = $row->idtelnoest;
      $modulo1[$i]["idtelnoest"] = $row->idtelnoest;
      $modulo1[$i]["idfaxnoest"] = $row->idfaxnoest;
      $modulo1[$i]["idcorreoest"] = $row->idcorreoest;
      //Datos de novedad y estado
      $modulo1[$i]["fk_sede"] = $row->fk_sede;
      $modulo1[$i]["nom_sede"] = $this->sede->nombreSede($row->fk_sede);
      $modulo1[$i]["fk_subsede"] = $row->fk_subsede;
      $modulo1[$i]["nom_subsede"] = $this->subsede->nombreSubSede($row->fk_subsede);
      $modulo1[$i]["fk_novedad"] = $row->fk_novedad;
      $modulo1[$i]["fk_estado"] = $row->fk_estado;
      $modulo1[$i]["estado"] = $row->nom_estado;
      $i++;
      }
      }
      $this->db->close();
      return $modulo1;
      }
     */

    function descargaPlanosModulo($ano_periodo, $mes_periodo) {
        $this->db->trans_start();
        $this->db->query("DROP TEMPORARY TABLE IF EXISTS histonovedades");
        $this->db->query("CREATE TEMPORARY TABLE histonovedades AS
                          SELECT *
                          FROM rmmh_admin_histnovedades
                          WHERE ano_periodo = $ano_periodo
                          AND mes_periodo = $mes_periodo
                          AND aceptada = 1
                          GROUP BY nro_orden, nro_establecimiento, ano_periodo, mes_periodo");
        $query = $this->db->query("SELECT C.ano_periodo, C.mes_periodo, C.nro_orden, C.nro_establecimiento, EST.ulocal, EMP.idnit, EMP.iddv, EMP.idproraz, EMP.idnomcom, EMP.idsigla, EMP.iddirecc, EMP.fk_depto, EMP.fk_mpio, EMP.idtelno, EMP.idfaxno, EMP.idpagweb, EMP.idcorreo, EST.finicial, EST.ffinal,
                                   EST.idnomcom AS idnomcomest, EST.idsigla AS idsiglaest, EST.fk_ciiu AS idact, EST.iddirecc AS iddireccest, EST.iddepto AS iddeptoest, EST.idmpio AS idmpioest, EST.idtelno AS idtelnoest, EST.idfaxno AS idfaxnoest, EST.idcorreo AS idcorreoest, EST.nom_cadena, EST.nom_operador,
                                   C.fk_sede, C.fk_subsede, IFNULL(H.fk_novedad, C.fk_novedad) AS fk_novedad, C.fk_estado, CASE C.fk_estado
                                                                                                                             WHEN 0 THEN 'Sin distribuir'
                                                                                                                             WHEN 1 THEN 'Distribuidas'
                                                                                                                             WHEN 2 THEN 'En digitacion'
                                                                                                                             WHEN 3 THEN 'Digitado'
                                                                                                                             WHEN 4 THEN 'Analisis - Verificacion'
                                                                                                                             WHEN 5 THEN 'Verificado'
                                                                                                                         END nom_estado
                                   FROM rmmh_admin_control C
                                   LEFT JOIN histonovedades H ON (C.nro_orden = H.nro_orden AND C.nro_establecimiento = H.nro_establecimiento AND C.ano_periodo = H.ano_periodo AND C.mes_periodo = H.mes_periodo)
                                   INNER JOIN rmmh_admin_empresas EMP ON (C.nro_orden = EMP.nro_orden)
                                   INNER JOIN rmmh_admin_establecimientos EST ON (C.nro_orden = EST.nro_orden AND C.nro_establecimiento = EST.nro_establecimiento)
                                   WHERE C.ano_periodo = $ano_periodo
                                   AND C.mes_periodo = $mes_periodo
                                   AND  EST.tipo_encuesta='E'");
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                //Datos de Empresa
                $modulo1[$i]["ano_periodo"] = $row->ano_periodo;
                $modulo1[$i]["mes_periodo"] = $row->mes_periodo;
                $modulo1[$i]["nro_orden"] = $row->nro_orden;
                $modulo1[$i]["nro_establecimiento"] = $row->nro_establecimiento;
                $modulo1[$i]["ulocal"] = $row->ulocal;
                $modulo1[$i]["idnit"] = $row->idnit;
                $modulo1[$i]["iddv"] = $row->iddv;
                $modulo1[$i]["idproraz"] = $row->idproraz;
                $modulo1[$i]["idnomcom"] = $row->idnomcom;
                $modulo1[$i]["idsigla"] = $row->idsigla;
                $modulo1[$i]["iddirecc"] = $row->iddirecc;
                $modulo1[$i]["iddepto"] = $row->fk_depto;
                $modulo1[$i]["nom_depto"] = $this->divipola->nombreDepartamento($row->fk_depto);
                $modulo1[$i]["idmpio"] = $row->fk_mpio;
                $modulo1[$i]["nom_mpio"] = $this->divipola->nombreMunicipio($row->fk_mpio);
                $modulo1[$i]["idtelno"] = $row->idtelno;
                $modulo1[$i]["idfaxno"] = $row->idfaxno;
                $modulo1[$i]["idpagweb"] = $row->idpagweb;
                $modulo1[$i]["idcorreo"] = $row->idcorreo;
                $modulo1[$i]["finicial"] = $row->finicial;
                $modulo1[$i]["ffinal"] = $row->ffinal;
                //Datos de Establecimiento
                $modulo1[$i]["idnomcomest"] = $row->idnomcomest;
                $modulo1[$i]["idsiglaest"] = $row->idsiglaest;
                $modulo1[$i]["idact"] = $row->idact;
                $modulo1[$i]["iddireccest"] = $row->iddireccest;
                $modulo1[$i]["iddeptoest"] = $row->iddeptoest;
                $modulo1[$i]["nom_deptoest"] = $this->divipola->nombreDepartamento($row->iddeptoest);
                $modulo1[$i]["idmpioest"] = $row->idmpioest;
                $modulo1[$i]["nom_mpioest"] = $this->divipola->nombreMunicipio($row->idmpioest);
                $modulo1[$i]["idtelnoest"] = $row->idtelnoest;
                $modulo1[$i]["idtelnoest"] = $row->idtelnoest;
                $modulo1[$i]["idfaxnoest"] = $row->idfaxnoest;
                $modulo1[$i]["idcorreoest"] = $row->idcorreoest;
                $modulo1[$i]["nom_cadena"] = $row->nom_cadena;
                $modulo1[$i]["nom_operador"] = $row->nom_operador;
                //Datos de novedad y estado 
                $modulo1[$i]["fk_sede"] = $row->fk_sede;
                $modulo1[$i]["nom_sede"] = $this->sede->nombreSede($row->fk_sede);
                $modulo1[$i]["fk_subsede"] = $row->fk_subsede;
                $modulo1[$i]["nom_subsede"] = $this->subsede->nombreSubSede($row->fk_subsede);
                $modulo1[$i]["fk_novedad"] = $row->fk_novedad;
                $modulo1[$i]["fk_estado"] = $row->fk_estado;
                $modulo1[$i]["estado"] = $row->nom_estado;
                $i++;
            }
        }
        $this->db->trans_complete();
        $this->db->close();
        return $modulo1;
    }
    
    /**
     * Descarga de directorio miniencuesta
     * @author SJNEIRAG
     * @since 2015
     */
    function descargaDirectorioMini($ano_periodo, $mes_periodo) {
        $this->db->trans_start();
        $query = $this->db->query("SELECT C.nro_orden, C.nro_establecimiento, EST.ulocal, EMP.id_empresa, EMP.idnit, EMP.iddv, EMP.idnit_nuevo, EMP.iddv_nuevo, EMP.idproraz, EST.idnomcom, EST.iddirecc, EST.fk_mpio, EST.fk_depto, EST.idtelno, EST.idcorreo, EMP.idpagweb,
                                   EST.fk_ciiu AS idact, C.fk_sede, C.fk_subsede, EST.nro_region, IFNULL(H.fk_novedad, C.fk_novedad) AS fk_novedad, C.fk_estado, 
                                    CASE C.fk_estado
                                        WHEN 0 THEN 'Sin distribuir'
                                        WHEN 1 THEN 'Distribuidas'
                                        WHEN 2 THEN 'En digitacion'
                                        WHEN 3 THEN 'Digitados'
                                        WHEN 4 THEN 'Analisis - Verificacion'
                                        WHEN 5 THEN 'Verificados'
                                    END nom_estado,
                                    CASE EST.tipo_encuesta
                                        WHEN 'M' THEN 'Miniencuesta'
                                        WHEN 'E' THEN 'Encuesta'
                                    END tipoEncuesta, C.fk_usuariocritica,
                                    IFNULL(US. nom_usuario,0) AS nom_usuario 
                                    FROM rmmh_admin_control C
                                   LEFT JOIN rmmh_admin_histnovedades H ON (C.nro_orden = H.nro_orden AND C.nro_establecimiento = H.nro_establecimiento AND C.ano_periodo = H.ano_periodo AND C.mes_periodo = H.mes_periodo)
                                   INNER JOIN rmmh_admin_empresas EMP ON (C.nro_orden = EMP.nro_orden)
                                   INNER JOIN rmmh_admin_establecimientos EST ON (C.nro_orden = EST.nro_orden AND C.nro_establecimiento = EST.nro_establecimiento)
                                   INNER JOIN rmmh_admin_usuarios US ON (id_usuario=C.fk_usuariocritica)
                                    WHERE C.ano_periodo = $ano_periodo
                                   AND C.mes_periodo = $mes_periodo
                                   AND  EST.tipo_encuesta='M'");
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                //Datos de Empresa
                $modulo1[$i]["nro_orden"] = $row->nro_orden;
                $modulo1[$i]["nro_establecimiento"] = $row->nro_establecimiento;
                $modulo1[$i]["ulocal"] = $row->ulocal;
                $modulo1[$i]["id_empresa"] = $row->id_empresa;
                $modulo1[$i]["idnit"] = $row->idnit;
                $modulo1[$i]["iddv"] = $row->iddv;
                $modulo1[$i]["idnit_nuevo"] = $row->idnit_nuevo;
                $modulo1[$i]["iddv_nuevo"] = $row->iddv_nuevo;
                $modulo1[$i]["idproraz"] = $row->idproraz;
                $modulo1[$i]["idnomcom"] = $row->idnomcom;
                $modulo1[$i]["iddirecc"] = $row->iddirecc;
                $modulo1[$i]["idmpio"] = $row->fk_mpio;
                $modulo1[$i]["nom_mpio"] = $this->divipola->nombreMunicipio($row->fk_mpio);
                $modulo1[$i]["iddepto"] = $row->fk_depto;
                $modulo1[$i]["nom_depto"] = $this->divipola->nombreDepartamento($row->fk_depto);
                $modulo1[$i]["idtelno"] = $row->idtelno;
                $modulo1[$i]["idcorreo"] = $row->idcorreo;
                $modulo1[$i]["idpagweb"] = $row->idpagweb;
                $modulo1[$i]["idact"] = $row->idact;
                $modulo1[$i]["fk_sede"] = $row->fk_sede;
                $modulo1[$i]["nom_sede"] = $this->sede->nombreSede($row->fk_sede);
                $modulo1[$i]["fk_subsede"] = $row->fk_subsede;
                $modulo1[$i]["nom_subsede"] = $this->subsede->nombreSubSede($row->fk_subsede);
                $modulo1[$i]["nro_region"] = $row->nro_region;
                $modulo1[$i]["fk_novedad"] = $row->fk_novedad;
                $modulo1[$i]["fk_estado"] = $row->fk_estado;
                $modulo1[$i]["estado"] = $row->nom_estado;
                $modulo1[$i]["tipoEncuesta"] = $row->tipoEncuesta;
                $modulo1[$i]["nom_critica"] = $row->nom_usuario;
                $i++;
            }
        }else{
            $modulo1[0]["nro_orden"] = "";
            $modulo1[0]["nro_establecimiento"] = "";
            $modulo1[0]["ulocal"] = "";
            $modulo1[0]["id_empresa"] = "";
            $modulo1[0]["idnit"] = "";
            $modulo1[0]["iddv"] = "";
            $modulo1[0]["idnit_nuevo"] = "";
            $modulo1[0]["iddv_nuevo"] = "";
            $modulo1[0]["idproraz"] = "";
            $modulo1[0]["idnomcom"] = "";
            $modulo1[0]["iddirecc"] = "";
            $modulo1[0]["idmpio"] = "";
            $modulo1[0]["nom_mpio"] = "";
            $modulo1[0]["iddepto"] = "";
            $modulo1[0]["nom_depto"] = "";
            $modulo1[0]["idtelno"] = "";
            $modulo1[0]["idcorreo"] = "";
            $modulo1[0]["idpagweb"] = "";
            $modulo1[0]["idact"] = "";
            $modulo1[0]["fk_sede"] = "";
            $modulo1[0]["nom_sede"] = "";
            $modulo1[0]["fk_subsede"] = "";
            $modulo1[0]["nom_subsede"] = "";
            $modulo1[0]["nro_region"] = "";
            $modulo1[0]["fk_novedad"] = "";
            $modulo1[0]["fk_estado"] = "";
            $modulo1[0]["estado"] = "";
            $modulo1[0]["tipoEncuesta"] = "";
            $modulo1[0]["nom_critica"] = "";
        }
        $this->db->trans_complete();
        $this->db->close();
        return $modulo1;
    }
    

    /**
     * Descarga de planos miniencuesta
     * @author SJNEIRAG
     * @since 2015
     */
    function descargaPlanosMini($ano_periodo, $mes_periodo) {
        $this->db->trans_start();
        $query = $this->db->query("SELECT C.nro_orden, C.nro_establecimiento, EST.ulocal, EMP.id_empresa, EMP.idnit, EMP.iddv, EMP.idnit_nuevo, EMP.iddv_nuevo, EMP.idproraz, EST.idnomcom, EST.iddirecc, EST.fk_mpio, EST.fk_depto, EST.idtelno, EST.idcorreo, EMP.idpagweb,
                                   EST.fk_ciiu AS idact, C.fk_sede, C.fk_subsede, EST.nro_region, SAL.pottot, CAR.ihdo, CAR.icda, ING.intio, ING.inalo, ENV.observaciones, ENV.responde, ENV.respoca, ENV.teler, ENV.emailr, IFNULL(H.fk_novedad, C.fk_novedad) AS fk_novedad, C.fk_estado, 
                                    CASE C.fk_estado
                                        WHEN 0 THEN 'Sin distribuir'
                                        WHEN 1 THEN 'Distribuidas'
                                        WHEN 2 THEN 'En digitacion'
                                        WHEN 3 THEN 'Digitado'
                                        WHEN 4 THEN 'Analisis - Verificacion'
                                        WHEN 5 THEN 'Verificado'
                                    END nom_estado,
                                    CASE EST.tipo_encuesta
                                        WHEN 'M' THEN 'Miniencuesta'
                                        WHEN 'E' THEN 'Encuesta' 
                                    END tipoEncuesta, C.fk_usuariocritica,
                                    US. nom_usuario
                                    FROM rmmh_admin_control C
                                   LEFT JOIN rmmh_admin_histnovedades H ON (C.nro_orden = H.nro_orden AND C.nro_establecimiento = H.nro_establecimiento AND C.ano_periodo = H.ano_periodo AND C.mes_periodo = H.mes_periodo)
                                   INNER JOIN rmmh_admin_empresas EMP ON (C.nro_orden = EMP.nro_orden)
                                   INNER JOIN rmmh_admin_establecimientos EST ON (C.nro_orden = EST.nro_orden AND C.nro_establecimiento = EST.nro_establecimiento)
                                   INNER JOIN rmmh_form_persalarios SAL ON (C.nro_orden = SAL.nro_orden AND C.nro_establecimiento = SAL.nro_establecimiento AND C.ano_periodo = SAL.ano_periodo AND C.mes_periodo = SAL.mes_periodo)
                                   INNER JOIN rmmh_form_caracthoteles CAR ON (C.nro_orden = CAR.nro_orden AND C.nro_establecimiento = CAR.nro_establecimiento AND C.ano_periodo = CAR.ano_periodo AND C.mes_periodo = CAR.mes_periodo)
                                   INNER JOIN rmmh_form_ingoperacionales ING ON (C.nro_orden = ING.nro_orden AND C.nro_establecimiento = ING.nro_establecimiento AND C.ano_periodo = ING.ano_periodo AND C.mes_periodo = ING.mes_periodo)
                                   INNER JOIN rmmh_form_envioform ENV ON (C.nro_orden = ENV.nro_orden AND C.nro_establecimiento = ENV.nro_establecimiento AND C.ano_periodo = ENV.ano_periodo AND C.mes_periodo = ENV.mes_periodo)
                                    INNER JOIN rmmh_admin_usuarios US ON (id_usuario=fk_usuariocritica)
                                   WHERE C.ano_periodo = $ano_periodo
                                   AND C.mes_periodo = $mes_periodo
                                   AND  EST.tipo_encuesta='M'");
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                //Datos de Empresa
                $modulo1[$i]["nro_orden"] = $row->nro_orden;
                $modulo1[$i]["nro_establecimiento"] = $row->nro_establecimiento;
                $modulo1[$i]["ulocal"] = $row->ulocal;
                $modulo1[$i]["id_empresa"] = $row->id_empresa;
                $modulo1[$i]["idnit"] = $row->idnit;
                $modulo1[$i]["iddv"] = $row->iddv;
                $modulo1[$i]["idnit_nuevo"] = $row->idnit_nuevo;
                $modulo1[$i]["iddv_nuevo"] = $row->iddv_nuevo;
                $modulo1[$i]["idproraz"] = $row->idproraz;
                $modulo1[$i]["idnomcom"] = $row->idnomcom;
                $modulo1[$i]["iddirecc"] = $row->iddirecc;
                $modulo1[$i]["idmpio"] = $row->fk_mpio;
                $modulo1[$i]["nom_mpio"] = $this->divipola->nombreMunicipio($row->fk_mpio);
                $modulo1[$i]["iddepto"] = $row->fk_depto;
                $modulo1[$i]["nom_depto"] = $this->divipola->nombreDepartamento($row->fk_depto);
                $modulo1[$i]["idtelno"] = $row->idtelno;
                $modulo1[$i]["idcorreo"] = $row->idcorreo;
                $modulo1[$i]["idpagweb"] = $row->idpagweb;
                $modulo1[$i]["idact"] = $row->idact;
                $modulo1[$i]["fk_sede"] = $row->fk_sede;
                $modulo1[$i]["nom_sede"] = $this->sede->nombreSede($row->fk_sede);
                $modulo1[$i]["fk_subsede"] = $row->fk_subsede;
                $modulo1[$i]["nom_subsede"] = $this->subsede->nombreSubSede($row->fk_subsede);
                $modulo1[$i]["nro_region"] = $row->nro_region;
                $modulo1[$i]["pottot"] = $row->pottot;
                $modulo1[$i]["ihdo"] = $row->ihdo;
                $modulo1[$i]["icda"] = $row->icda;
                $modulo1[$i]["intio"] = $row->intio;
                $modulo1[$i]["inalo"] = $row->inalo;
                $modulo1[$i]["observaciones"] = $row->observaciones;
                $modulo1[$i]["responde"] = $row->responde;
                $modulo1[$i]["respoca"] = $row->respoca;
                $modulo1[$i]["teler"] = $row->teler;
                $modulo1[$i]["emailr"] = $row->emailr;
                $modulo1[$i]["fk_novedad"] = $row->fk_novedad;
                $modulo1[$i]["fk_estado"] = $row->fk_estado;
                $modulo1[$i]["estado"] = $row->nom_estado;
                $modulo1[$i]["tipoEncuesta"] = $row->tipoEncuesta;
                $modulo1[$i]["nom_critica"] = $row->nom_usuario;
                $i++;
            }
        }else{
                $modulo1[0]["nro_orden"] = "";
                $modulo1[0]["nro_establecimiento"] = "";
                $modulo1[0]["ulocal"] = "";
                $modulo1[0]["id_empresa"] = "";
                $modulo1[0]["idnit"] = "";
                $modulo1[0]["iddv"] = "";
                $modulo1[0]["idnit_nuevo"] = "";
                $modulo1[0]["iddv_nuevo"] = "";
                $modulo1[0]["idproraz"] = "";
                $modulo1[0]["idnomcom"] = "";
                $modulo1[0]["iddirecc"] = "";
                $modulo1[0]["idmpio"] = "";
                $modulo1[0]["nom_mpio"] = "";
                $modulo1[0]["iddepto"] = "";
                $modulo1[0]["nom_depto"] = "";
                $modulo1[0]["idtelno"] = "";
                $modulo1[0]["idcorreo"] = "";
                $modulo1[0]["idpagweb"] = "";
                $modulo1[0]["idact"] = "";
                $modulo1[0]["fk_sede"] = "";
                $modulo1[0]["nom_sede"] = "";
                $modulo1[0]["fk_subsede"] = "";
                $modulo1[0]["nom_subsede"] = "";
                $modulo1[0]["nro_region"] = "";
                $modulo1[0]["pottot"] = "";
                $modulo1[0]["ihdo"] = "";
                $modulo1[0]["icda"] = "";
                $modulo1[0]["intio"] = "";
                $modulo1[0]["inalo"] = "";
                $modulo1[0]["observaciones"] = "";
                $modulo1[0]["responde"] = "";
                $modulo1[0]["respoca"] = "";
                $modulo1[0]["teler"] = "";
                $modulo1[0]["emailr"] = "";
                $modulo1[0]["fk_novedad"] = "";
                $modulo1[0]["fk_estado"] = "";
                $modulo1[0]["estado"] = "";
                $modulo1[0]["tipoEncuesta"] = "";
                $modulo1[0]["nom_critica"] = "";
        }
        $this->db->trans_complete();
        $this->db->close();
        return $modulo1;
    }
    
    /**
     * Descarga observaciones miniencuesta
     * @author SJNEIRAG
     * @since 2015
     */
    function descargaObsMini($ano_periodo, $mes_periodo) {
        $this->db->trans_start();
        $query = $this->db->query("SELECT C.nro_orden, C.nro_establecimiento, OBS.fecha, OBS.descripcion, US.id_usuario, US.nom_usuario
                                   FROM rmmh_admin_control C
                                   LEFT JOIN rmmh_admin_histnovedades H ON (C.nro_orden = H.nro_orden AND C.nro_establecimiento = H.nro_establecimiento AND C.ano_periodo = H.ano_periodo AND C.mes_periodo = H.mes_periodo)
                                   INNER JOIN rmmh_admin_empresas EMP ON (C.nro_orden = EMP.nro_orden)
                                   INNER JOIN rmmh_admin_establecimientos EST ON (C.nro_orden = EST.nro_orden AND C.nro_establecimiento = EST.nro_establecimiento)
                                   INNER JOIN rmmh_admin_observaciones OBS ON (C.nro_orden = OBS.nro_orden AND C.nro_establecimiento = OBS.nro_establecimiento AND C.ano_periodo = OBS.ano_periodo AND C.mes_periodo = OBS.mes_periodo)
                                   INNER JOIN rmmh_admin_usuarios US ON (OBS.fk_usuario = US.id_usuario)
                                   WHERE C.ano_periodo = $ano_periodo
                                   AND C.mes_periodo = $mes_periodo
                                   AND  EST.tipo_encuesta='M'");
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                //Datos de Empresa
                $modulo1[$i]["nro_orden"] = $row->nro_orden;
                $modulo1[$i]["nro_establecimiento"] = $row->nro_establecimiento;
                $modulo1[$i]["fecha"] = $row->fecha;
                $modulo1[$i]["descripcion"] = $row->descripcion;
                $modulo1[$i]["usuario"] = $row->id_usuario;
                $modulo1[$i]["nom_usuario"] = $row->nom_usuario;
                $i++;
            }
        }
        $this->db->trans_complete();
        $this->db->close();
        return $modulo1;
    }

}

?>