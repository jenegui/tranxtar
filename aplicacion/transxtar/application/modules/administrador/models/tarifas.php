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
        tipo_tarifa, valor_tarifa, factor_conversion, valor_minima, valor_maxima, peso, ancho, alto, largo, costo_manejo, referencia, descripcion
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
                $tarifas[$i]["valor_maxima"] = $row->valor_maxima;
                $tarifas[$i]["peso"] = $row->peso;
                $tarifas[$i]["ancho"] = $row->ancho;
                $tarifas[$i]["alto"] = $row->alto;
                $tarifas[$i]["largo"] = $row->largo;
                $tarifas[$i]["costo_manejo"] = $row->costo_manejo;
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
        $sql = "SELECT id_tarifa, id_establecimientos, id_ciudad, tipo_tarifa, valor_tarifa, factor_conversion, valor_minima, valor_maxima, peso, ancho, alto, largo, costo_manejo, referencia, descripcion
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
                $tarifas["valor_maxima"] = $row->valor_maxima;
                $tarifas["peso"] = $row->peso;
                $tarifas["ancho"] = $row->ancho;
                $tarifas["alto"] = $row->alto;
                $tarifas["largo"] = $row->largo;
                $tarifas["costo_manejo"] = $row->costo_manejo;
                $tarifas["referencia"] = $row->referencia;
                $tarifas["descripcion"] = $row->descripcion;
            }
        }
        $this->db->close();
        return $tarifas;
    }

    //Función para obtener las tarifas por establecimiento y ciudad
    function obtenerDatosTarifasId($IdEstablecimiento,$cmbMpioTar, $tipo_tarifa, $referencia, $valor_tarifa) {
        $tarifas = array();
        $sql = "SELECT id_tarifa, id_establecimientos, id_ciudad, 
        CASE
        WHEN tipo_tarifa = 1 THEN 'Referencia'
        WHEN tipo_tarifa = 2 THEN 'General'
        END as tipoTarifa,
        tipo_tarifa, valor_tarifa, factor_conversion, valor_minima, valor_maxima, peso, ancho, alto, largo, costo_manejo, referencia, descripcion
                FROM txtar_admin_tarifas
                WHERE  id_establecimientos = $IdEstablecimiento
                AND  id_ciudad=$cmbMpioTar
                AND tipo_tarifa=$tipo_tarifa
                AND referencia='$referencia' 
                AND valor_tarifa=$valor_tarifa ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $tarifas["id_establecimientos"] = $row->id_establecimientos;
                $tarifas["id_ciudad"] = $row->id_ciudad;
                $tarifas["tipo_tarifa"] = $row->tipo_tarifa;
                $tarifas["valor_tarifa"] = $row->valor_tarifa;
                $tarifas["factor_conversion"] = $row->factor_conversion;
                $tarifas["valor_minima"] = $row->valor_minima;
                $tarifas["valor_maxima"] = $row->valor_maxima;
                $tarifas["peso"] = $row->peso;
                $tarifas["ancho"] = $row->ancho;
                $tarifas["alto"] = $row->alto;
                $tarifas["costo_manejo"] = $row->costo_manejo;
                $tarifas["largo"] = $row->largo;

                $tarifas["referencia"] = $row->referencia;
                $tarifas["descripcion"] = $row->descripcion;
            }
        }
        
        $this->db->close();
        return $tarifas;
    } 
    //Función para registrar las tarifas
    function registrarTarifas($IdEstablecimiento, $cmbMpioTar, $tipo_tarifa, $valor_tarifa, $factor_conversion, $valor_minima, $valor_maxima, $peso, $ancho, $alto, $largo, $costomanejo, $referencia, $descripcion) {
                               
        $data = array(
            'id_establecimientos' => $IdEstablecimiento,
            'id_ciudad' => $cmbMpioTar,
            'tipo_tarifa' => $tipo_tarifa,
            'valor_tarifa' => $valor_tarifa,
            'factor_conversion' => $factor_conversion,
            'valor_minima' => $valor_minima,
            'valor_maxima' => $valor_maxima,
            'peso' => $peso,
            'ancho' => $ancho,
            'alto' => $alto,
            'largo' => $largo,
            'costo_manejo' => $costomanejo,
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
        //echo $this->db->last_query();
        $this->db->close();
        
    
    }
}    