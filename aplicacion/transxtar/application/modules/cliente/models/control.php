<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Control extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library("session");
    }

    function obtenerGuias($id_usuario) {
        $this->load->model("divipola");
        $this->load->model("sede");
        $this->load->model("subsede");
        $control = array();
        $sql = "SELECT C.id_control, C.id_establecimientos, EST.idnomcom, EST.nit_establecimiento, EST.fk_depto, EST.fk_mpio,
                        C.fecha_recogida, C.fecha_entrega,
                        C.id_destinatario, DEST.nro_identificacion, DEST.nombre_destinatario,
    	               C.forma_pago, C.unidades, C.peso, C.peso_vol, C.peso_cobrar, C.valor_declarado, C.flete, C.costo_manejo, C.total_fletes, 
                       C.id_usuario_operario, US.nom_usuario, C.nro_placa, C.id_operario, C.id_usuario, C.fecha_registro, C.fecha_actualizacion, C.observaciones,
                       DEST.ciudad_destinatario, DEST.depto_destinatario,
                       CASE WHEN C.estado_contable = 1 THEN 'Contabilizado'
            WHEN C.estado_contable = 0 THEN 'No contabilizado'
            END AS estado_contable, 
            CASE WHEN C.estado_recaudo = 1 THEN 'Recaudado'
            WHEN C.estado_recaudo = 0 THEN 'No recaudado'
            END AS estado_recaudo,
            C.estado_carga, E.nom_estado, 
            CASE WHEN C.estado_control = 1 THEN 'Aprobado'
            WHEN C.estado_control = 0 THEN 'Sin aprobar'
            END AS estado_control,
            OP.nombre_operario,
            OP.nro_identificacion,
            OP.telefono_operario,
            OP.nro_placa as placa_ext
                FROM txtar_admin_control C
                INNER JOIN txtar_admin_establecimientos EST ON C.id_establecimientos=EST.id_establecimiento AND EST.nit_establecimiento= $id_usuario
                INNER JOIN txtar_admin_destinatarios DEST ON C.id_destinatario=DEST.id_destinatario
                INNER JOIN txtar_param_estados E ON C.estado_carga= E.id_estado
                LEFT JOIN txtar_param_operario OP ON C.id_operario = OP.id_operario  
                LEFT JOIN txtar_admin_usuarios US ON C.id_usuario_operario = US.num_identificacion  
                ORDER BY C.id_control ";
        $query = $this->db->query($sql);

        //echo $sql;
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $control[$i]["id_control"] = $row->id_control;
                $control[$i]["id_establecimiento"] = $row->id_establecimientos;
                $control[$i]["id_establecimientos"] = $row->nit_establecimiento;
                $control[$i]["idnomcom"] = $row->idnomcom;
                $control[$i]["ciudad_origen"] = $this->divipola->nombreMunicipio($row->fk_mpio);
                $control[$i]["depto_origen"] = $this->divipola->nombreDepartamento($row->fk_depto);
                $control[$i]["fecha_recogida"] = $row->fecha_recogida;
                $control[$i]["fecha_entrega"] = $row->fecha_entrega;
                $control[$i]["id_destinatario"] = $row->nro_identificacion;
                $control[$i]["nombre_destinatario"] = $row->nombre_destinatario;
                $control[$i]["ciudadDest"] = $this->divipola->nombreMunicipio($row->ciudad_destinatario);
                $control[$i]["deptoDest"] = $this->divipola->nombreDepartamento($row->depto_destinatario);
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
                $control[$i]["nomUsuario"] = $row->nom_usuario;
                $control[$i]["nro_placa"] = $row->nro_placa;
                $control[$i]["id_operario"] = $row->id_operario;
                $control[$i]["id_usuario"] = $row->id_usuario;
                $control[$i]["fecha_registro"] = $row->fecha_registro;
                $control[$i]["fechaActualizacion"] = $row->fecha_actualizacion;
                $control[$i]["observaciones"] = $row->observaciones;
                $control[$i]["estado_contable"] = $row->estado_contable;
                $control[$i]["estado_recaudo"] = $row->estado_recaudo;
                $control[$i]["estado_carga"] = $row->estado_carga;
                $control[$i]["nom_estado"] = $row->nom_estado;
                $control[$i]["estado_control"] = $row->estado_control;
                $control[$i]["nombreOperario"] = $row->nombre_operario;
                $control[$i]["nro_identificacion"] = $row->nro_identificacion;
                $control[$i]["telefono_operario"] = $row->telefono_operario;
                $control[$i]["placa_ext"] = $row->placa_ext;
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
        $sql = "SELECT C.id_control, C.id_establecimientos, EST.idnomcom, EST.nit_establecimiento, EST.iddirecc, EST.idtelno,
                        C.fecha_recogida, C.fecha_entrega, C.id_destinatario, DEST.nro_identificacion, DEST.nombre_destinatario,
                        DEST.ciudad_destinatario, DEST.depto_destinatario,DEST.direccion_destinatario, DEST.telefono_destinatario,
    	               C.forma_pago, C.unidades, C.peso, C.pv_alto, C.pv_ancho, C.pv_largo, C.peso_cobrar, C.valor_declarado, C.flete, C.costo_manejo, C.total_fletes, 
                       C.id_usuario_operario, US.nom_usuario, US.nro_telefono, C.nro_placa, C.id_operario, C.id_usuario, C.fecha_registro, C.observaciones, C.estado_contable, C.estado_control,
                       C.estado_recaudo, C.estado_carga, E.nom_estado,
                       OP.nombre_operario,
                    OP.nro_identificacion,
                    OP.nro_placa as placa_ext,
                    OP.telefono_operario
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
                $control["costo_manejo"] = $row->costo_manejo;
                $control["id_usuario_operario"] = $row->id_usuario_operario;
                $control["nomUsuario"] = $row->nom_usuario;
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
                $control["nombreOperario"] = $row->nombre_operario;
                $control["nro_identificacion"] = $row->nro_identificacion;
                $control["telefono_operario"] = $row->telefono_operario;
                $control["placa_ext"] = $row->placa_ext;
                $control["telOperario"] = $row->telefono_operario;
                $i++;
            }
        }
        //echo $sql;
        $this->db->close();
        return $control;
    }

    //Crea los registros de control cuando se realiza el cargue masivo del directorio
    function insertarControlGuia($idestablecimiento, $txtFecRecogida, $txtFecEntrega, $iddestinatario, $formaPago, $pesokg, $alto, $ancho, $largo, $unidades, $pesocobrar, $valorDeclarado, $flete, $costomanejo, $totalflete, $idoperario, $numplaca, $idoperarioext, $estadocarga, $estadoRecogida, $observaciones, $idusaurio, $fechaRegistro) {
        $data = array(
            'id_establecimientos' => $idestablecimiento,
            'fecha_recogida' => $txtFecRecogida,
            'fecha_entrega' => $txtFecEntrega,
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
    function actualizarDatosControl($id_control, $idestablecimiento, $fecharecog, $fechaentr, $iddestinatario, $formaPago, $pesokg, $alto, $ancho, $largo, $unidades, $pesocobrar, $valorDeclarado, $flete, $costomanejo, $totalflete, $idoperario, $numplaca, $idoperarioext, $estadocarga, $estadoRecogida, $observ) {
        $data = array('id_establecimientos' => $idestablecimiento,
            'fecha_recogida' => $fecharecog,
            'fecha_entrega' => $fechaentr,
            'id_destinatario' => $iddestinatario,
            'forma_pago' => $formaPago,
            'unidades' => $unidades,
            'peso' => $pesokg,
            'pv_ancho' => $ancho,
            'pv_alto' => $alto,
            'pv_largo' => $largo,
            'peso_cobrar' => $pesocobrar,
            'valor_declarado' => $valorDeclarado,
            'flete' => $flete,
            'costo_manejo' => $costomanejo,
            'total_fletes' => $totalflete,
            'id_usuario_operario' => $idoperario,
            'nro_placa' => $numplaca,
            'id_operario' => $idoperarioext,
            'observaciones' => $observ,
            'estado_carga' => $estadocarga,
            'estado_control' => $estadoRecogida
        );
        $this->db->where("id_control", $id_control);
        $this->db->update("txtar_admin_control", $data);
    }

    //Actualiza oa información del estado del control de las guias     
    function actualizarDatosControlTS($id_control,$idestablecimiento, $iddestinatario, $idoperario, $numplaca, $idoperarioext, $estadocarga, $fecha_actualizacion) {
        $data = array('id_establecimientos' => $idestablecimiento,
            'id_destinatario' => $iddestinatario,
            'id_usuario_operario' => $idoperario,
            'nro_placa' => $numplaca,
            'id_operario' => $idoperarioext,
            'estado_carga' => $estadocarga,
            'fecha_actualizacion' => $fecha_actualizacion
        );
        $this->db->where("id_control", $id_control);
        $this->db->update("txtar_admin_control", $data);
    }

    //Actualiza oa información del estado contable de las guias     
    function actualizarDatosControlCon($id_control, $estadocont, $estadorecaudo) {
        $data = array('estado_contable' => $estadocont,
            'estado_recaudo' => $estadorecaudo);
        $this->db->where("id_control", $id_control);
        $this->db->update("txtar_admin_control", $data);
    }

    //Funcion que me entrega el nombre del estado de un modulo
    function estadoModulo($estado) {
        $nombre = "";
        switch ($estado) {
            case 0: $nombre = "0 - Sin diligenciar";
                break;
            case 2: $nombre = "2 - Diligenciado";
                break;
        }
        return $nombre;
    }

    function cambiaEstadoControl($nro_orden, $nro_establecimiento, $ano_periodo, $mes_periodo, $estado, $novedad, $estadocontrol) {
        $data = array('fk_novedad' => $novedad,
            'fk_estado' => $estado,
            'estado_control' => $estadocontrol
        );
        $this->db->where("nro_orden", $nro_orden);
        $this->db->where("nro_establecimiento", $nro_establecimiento);
        $this->db->where("ano_periodo", $ano_periodo);
        $this->db->where("mes_periodo", $mes_periodo);
        $this->db->update("rmmh_admin_control", $data);
    }

    //Crea los registros de control cuando se realiza el cargue masivo del directorio
    function registrarEstados($id_control, $estadocarga, $fecha_actualizacion, $observaciones, $usuario) {
        $data = array(
            'id_control' => $id_control,
            'fecha_reg_estados' => $fecha_actualizacion,
            'estado_carga' => $estadocarga,
            'observaciones' => $observaciones,
            'id_usuario' => $usuario);
        $this->db->insert('txtar_admin_estados', $data);
        $this->db->close();
    }
    
    //Obtiene los registros de los estados
    function obtenerEstados($id_guia) {
        $estados = array();
        $sql = "SELECT E.id_estados, E.id_control, E.fecha_reg_estados, E.estado_carga, Es.nom_estado, E.observaciones, E.id_usuario,
                US.nom_usuario
                FROM txtar_admin_estados E
                INNER JOIN txtar_admin_usuarios US ON E.id_usuario = US.id_usuario  
                INNER JOIN txtar_param_estados Es ON E.estado_carga = Es.id_estado  
                WHERE
                id_control= $id_guia
                ORDER BY E.id_estados DESC ";
        $query = $this->db->query($sql);

        //echo $sql;
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $estados[$i]["id_estados"] = $row->id_estados;
                $estados[$i]["num_guia"] = $row->id_control;
                $estados[$i]["fechaRegistro"] = $row->fecha_reg_estados;
                $estados[$i]["nomestado"] = $row->nom_estado;
                $estados[$i]["observaciones"] = $row->observaciones;
                $estados[$i]["nom_usuario"] = $row->nom_usuario;
                $i++;
            }
        }
        //echo $sql;
        $this->db->close();
        return $estados;
    }

}

//EOC   