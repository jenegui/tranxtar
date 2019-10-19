<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tarifas extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library("session");
    }
    //Función para obtener las tarifas todas
    function obtenerDatosTarifasTodas($nro_establecimiento) {
        $this->load->model("divipola");
        $tarifas = array();
        $sql = "SELECT id_tarifa, id_establecimientos, id_ciudad, 
         CASE
        WHEN tipo_tarifa = 1 THEN 'Referencia'
        WHEN tipo_tarifa = 2 THEN 'General'
        END as tipoTarifa,
        tipo_tarifa, valor_tarifa, factor_conversion, valor_minima, peso, ancho, alto, largo, referencia, descripcion
                FROM txtar_admin_tarifas
                WHERE id_establecimientos=$nro_establecimiento
                ORDER BY id_establecimientos";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $i=0;
            foreach ($query->result() as $row) {
                $tarifas[$i]["id_tarifa"] = $row->id_tarifa;
                $tarifas[$i]["id_establecimientos"] = $row->id_establecimientos;
                $tarifas[$i]["id_ciudad"] = $row->id_ciudad;
                $tarifas[$i]["nomciudad"] = $this->divipola->nombreMunicipio($row->id_ciudad);
                $tarifas[$i]["tipo_tarifa"] = $row->tipoTarifa;
                $tarifas[$i]["valor_tarifa"] = $row->valor_tarifa;
                $tarifas[$i]["factor_conversion"] = $row->factor_conversion;
                $tarifas[$i]["valor_minima"] = $row->valor_minima;
                $tarifas[$i]["peso"] = $row->peso;
                $tarifas[$i]["ancho"] = $row->ancho;
                $tarifas[$i]["alto"] = $row->alto;
                $tarifas[$i]["largo"] = $row->largo;
                $tarifas[$i]["referencia"] = $row->referencia;
                $tarifas[$i]["descripcion"] = $row->descripcion;
            $i++;    
            }
        }
        $this->db->close();
        return $tarifas;
    }

    function obtenerTarifasId($id_tarifa) {
        $this->load->model("divipola");
        $tarifas = array();
        $sql = "SELECT id_tarifa, id_establecimientos, id_ciudad, tipo_tarifa, valor_tarifa, factor_conversion, valor_minima, peso, ancho, alto, largo, referencia, descripcion
                FROM txtar_admin_tarifas
                WHERE id_tarifa=$id_tarifa
                ORDER BY id_establecimientos";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $tarifas["id_tarifa"] = $row->id_tarifa;
                $tarifas["id_establecimientos"] = $row->id_establecimientos;
                $tarifas["id_ciudad"] = $row->id_ciudad;
                $tarifas["nomciudad"] = $this->divipola->nombreMunicipio($row->id_ciudad);
                $tarifas["tipo_tarifa"] = $row->tipo_tarifa;
                $tarifas["valor_tarifa"] = $row->valor_tarifa;
                $tarifas["factor_conversion"] = $row->factor_conversion;
                $tarifas["valor_minima"] = $row->valor_minima;
                $tarifas["peso"] = $row->peso;
                $tarifas["ancho"] = $row->ancho;
                $tarifas["alto"] = $row->alto;
                $tarifas["largo"] = $row->largo;
                $tarifas["referencia"] = $row->referencia;
                $tarifas["descripcion"] = $row->descripcion;
            }
        }
        $this->db->close();
        return $tarifas;
    }

    //Función para obtener las tarifas por establecimiento, ciudad y referencia
    function obtenerTarifasEstablecimiento($IdEstablecimiento, $ciudadDest) {
        $tarifas = array();
        $sql = "SELECT id_tarifa, id_establecimientos, id_ciudad, 
        CASE
        WHEN tipo_tarifa = 1 THEN 'Referencia'
        WHEN tipo_tarifa = 2 THEN 'General'
        END as tipoTarifa,
        tipo_tarifa, valor_tarifa, factor_conversion, valor_minima, peso, ancho, alto, largo, referencia, descripcion
                FROM txtar_admin_tarifas
                WHERE  id_establecimientos = $IdEstablecimiento
                AND id_ciudad=$ciudadDest ";
        //echo $sql;        
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $i=0;
            foreach ($query->result() as $row) {
                $tarifas[$i]["id_tarifa"] = $row->id_tarifa;
                $tarifas[$i]["id_establecimientos"] = $row->id_establecimientos;
                $tarifas[$i]["id_ciudad"] = $row->id_ciudad;
                $tarifas[$i]["tipo_tarifa"] = $row->tipo_tarifa;
                $tarifas[$i]["valor_tarifa"] = $row->valor_tarifa;
                $tarifas[$i]["factor_conversion"] = $row->factor_conversion;
                $tarifas[$i]["valor_minima"] = $row->valor_minima;
                $tarifas[$i]["peso"] = $row->peso;
                $tarifas[$i]["ancho"] = $row->ancho;
                $tarifas[$i]["alto"] = $row->alto;
                $tarifas[$i]["largo"] = $row->largo;
                $tarifas[$i]["referencia"] = $row->referencia;
                $tarifas[$i]["descripcion"] = $row->descripcion;
            $i++;    
            }
        }
        
        $this->db->close();
        return $tarifas;
    } 

    //Función para obtener las tarifas por establecimiento, ciudad y tipod de tarifa
    function obtenerTarifasGeneralId($IdEstablecimiento, $ciudadDest, $tipoTarifa) {
        $tarifas = array();
        $sql = "SELECT id_tarifa, id_establecimientos, id_ciudad, 
        CASE
        WHEN tipo_tarifa = 1 THEN 'Referencia'
        WHEN tipo_tarifa = 2 THEN 'General'
        END as tipoTarifa,
        tipo_tarifa, valor_tarifa, factor_conversion, valor_minima, peso, ancho, alto, largo, referencia, descripcion
                FROM txtar_admin_tarifas
                WHERE  id_establecimientos = $IdEstablecimiento
                AND id_ciudad=$ciudadDest 
                AND tipo_tarifa=$tipoTarifa";
        //echo $sql;        
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
           
            foreach ($query->result() as $row) {
                $tarifas["id_tarifa"] = $row->id_tarifa;
                $tarifas["id_establecimientos"] = $row->id_establecimientos;
                $tarifas["id_ciudad"] = $row->id_ciudad;
                $tarifas["tipo_tarifa"] = $row->tipo_tarifa;
                $tarifas["valor_tarifa"] = $row->valor_tarifa;
                $tarifas["factor_conversion"] = $row->factor_conversion;
                $tarifas["valor_minima"] = $row->valor_minima;
                $tarifas["peso"] = $row->peso;
                $tarifas["ancho"] = $row->ancho;
                $tarifas["alto"] = $row->alto;
                $tarifas["largo"] = $row->largo;
                $tarifas["referencia"] = $row->referencia;
                $tarifas["descripcion"] = $row->descripcion;
               
            }
        }
        
        $this->db->close();
        return $tarifas;
    } 

    //Función para obtener las tarifas por establecimiento 
    function obtenerDatosTarifasId($IdEstablecimiento,$cmbMpioTar, $tipo_tarifa, $referencia) {
        $tarifas = array();
        $sql = "SELECT id_tarifa, id_establecimientos, id_ciudad, 
        CASE
        WHEN tipo_tarifa = 1 THEN 'Referencia'
        WHEN tipo_tarifa = 2 THEN 'General'
        END as tipoTarifa,
        tipo_tarifa, valor_tarifa, factor_conversion, valor_minima, peso, ancho, alto, largo, referencia, descripcion
                FROM txtar_admin_tarifas
                WHERE  id_establecimientos = $IdEstablecimiento
                AND  id_ciudad=$cmbMpioTar
                AND tipo_tarifa=$tipo_tarifa
                AND referencia='$referencia' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $tarifas["id_establecimientos"] = $row->id_establecimientos;
                $tarifas["id_ciudad"] = $row->id_ciudad;
                $tarifas["tipo_tarifa"] = $row->tipo_tarifa;
                $tarifas["valor_tarifa"] = $row->valor_tarifa;
                $tarifas["factor_conversion"] = $row->factor_conversion;
                $tarifas["valor_minima"] = $row->valor_minima;
                $tarifas["peso"] = $row->peso;
                $tarifas["ancho"] = $row->ancho;
                $tarifas["alto"] = $row->alto;
                $tarifas["largo"] = $row->largo;
                $tarifas["referencia"] = $row->referencia;
                $tarifas["descripcion"] = $row->descripcion;
            }
        }
        
        $this->db->close();
        return $tarifas;
    } 
    //Función para registrar las tarifas
    function registrarTarifas($IdEstablecimiento, $cmbMpioTar, $tipo_tarifa, $valor_tarifa, $factor_conversion, $valor_minima, $peso, $ancho, $alto, $largo, $referencia, $descripcion) {
        $data = array(
            'id_establecimientos' => $IdEstablecimiento,
            'id_ciudad' => $cmbMpioTar,
            'tipo_tarifa' => $tipo_tarifa,
            'valor_tarifa' => $valor_tarifa,
            'factor_conversion' => $factor_conversion,
            'valor_minima' => $valor_minima,
            'peso' => $peso,
            'ancho' => $ancho,
            'alto' => $alto,
            'largo' => $largo,
            'referencia' => $referencia,
            'descripcion' => $descripcion
        );
        $this->db->insert("txtar_admin_tarifas", $data);
        $this->db->close();
        //echo $this->db->last_query();
    }
    //Función para actualizar las tarifas
    function actualizarTarifas($IdTarifa, $tipo_tarifa, $valor_tarifa, $factor_conversion, $valor_minima, $peso, $ancho, $alto, $largo, $referencia, $descripcion) {
        $data = array(
            'tipo_tarifa' => $tipo_tarifa,
            'valor_tarifa' => $valor_tarifa,
            'valor_tarifa' => $valor_tarifa,
            'factor_conversion' => $factor_conversion,
            'valor_minima' => $valor_minima,
            'peso' => $peso,
            'ancho' => $ancho,
            'alto' => $alto,
            'largo' => $largo,
            'referencia' => $referencia,
            'descripcion' => $descripcion
        );
        $this->db->where("id_tarifa", $IdTarifa);
        $this->db->update("txtar_admin_tarifas", $data);
        $this->db->close();
    }

    //Función para registrar las tarifas que se registran en las guis
    function registrarCtrlTarifas($idguia, $idtarifa, $cantidad, $valor_tarifa, $total) {
        $data = array(
            'id_ctrl_tarifas_numguia' => $idguia,
            'id_ctrl_tarifas_referencia' => $idtarifa,
            'id_ctrl_tarifas_valor' => $valor_tarifa,
            'id_ctrl_tarifas_cantidad' => $cantidad,
            'id_ctrl_total ' => $total,
        );
        $this->db->insert("txtar_admin_ctrl_tarifas", $data);
        $this->db->close();
        //echo $this->db->last_query();
    }

    //Función para obtener las tarifas registradas en la guias por establecimiento 
    function obtenerCtrlTarifas($idguia, $idtarifa) {
        $tarctrl = array();
        $sql = "SELECT id_ctrl_tarifas_numguia, id_ctrl_tarifas_referencia, 
        id_ctrl_tarifas_valor, id_ctrl_tarifas_cantidad, id_ctrl_total
                FROM txtar_admin_ctrl_tarifas
                WHERE  id_ctrl_tarifas_numguia = $idguia
                AND  id_ctrl_tarifas_referencia=$idtarifa
                 ";
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            
            foreach ($query->result() as $row) {
                $tarctrl["idnumguia"] = $row->id_ctrl_tarifas_numguia;
                $tarctrl["idtarifa"] = $row->id_ctrl_tarifas_referencia;
                $tarctrl["tarifas_valor"] = $row->id_ctrl_tarifas_valor;
                $tarctrl["tarifas_cantidad"] = $row->id_ctrl_tarifas_cantidad;
                $tarctrl["ctrl_total"] = $row->id_ctrl_total;
               
            }
        }
        
        $this->db->close();
        return $tarctrl;
    }

    //Función para obtener las tarifas registradas en la guias por establecimiento 
    function obtenerCtrlTarifasId($idguia) {
        $tarctrl = array();
        $sql = "SELECT id_ctrl_tarifas_numguia, id_ctrl_tarifas_referencia, 
        id_ctrl_tarifas_valor, id_ctrl_tarifas_cantidad, id_ctrl_total, referencia
                FROM txtar_admin_ctrl_tarifas
                INNER JOIN txtar_admin_tarifas ON id_tarifa=id_ctrl_tarifas_referencia
                WHERE  id_ctrl_tarifas_numguia = $idguia

                ";
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            $i=0;
            foreach ($query->result() as $row) {
                $tarctrl[$i]["idnumguia"] = $row->id_ctrl_tarifas_numguia;
                $tarctrl[$i]["idtarifa"] = $row->id_ctrl_tarifas_referencia;
                $tarctrl[$i]["tarifas_valor"] = $row->id_ctrl_tarifas_valor;
                $tarctrl[$i]["tarifas_cantidad"] = $row->id_ctrl_tarifas_cantidad;
                $tarctrl[$i]["ctrl_total"] = $row->id_ctrl_total;
                $tarctrl[$i]["referencia"] = $row->referencia;
            $i++;   
            }
        }
        
        $this->db->close();
        return $tarctrl;
    } 

    //Función para obtener la suma de las tarifas por guia
    function obtenerSumaCtrlTar($idguia) {
        $tarctrl = array();
        $sql = "SELECT SUM(id_ctrl_total) as sumaTotal
                FROM txtar_admin_ctrl_tarifas
                WHERE  id_ctrl_tarifas_numguia = $idguia
                
                ";

        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            
            foreach ($query->result() as $row) {
                $tarctrl["sumaTotal"] = $row->sumaTotal;
                
            
            }
        }
        
        $this->db->close();
        return $tarctrl;
    }   
}    