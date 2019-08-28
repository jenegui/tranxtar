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
        $sql = "SELECT id_tarifa, id_establecimientos, id_ciudad, tipo_carga, valor_tarifa, referencia, descripcion
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
                $tarifas[$i]["tipo_carga"] = $row->tipo_carga;
                $tarifas[$i]["valor_tarifa"] = $row->valor_tarifa;
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
        $sql = "SELECT id_tarifa, id_establecimientos, id_ciudad, tipo_carga, valor_tarifa, referencia, descripcion
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
                $tarifas["tipo_carga"] = $row->tipo_carga;
                $tarifas["valor_tarifa"] = $row->valor_tarifa;
                $tarifas["referencia"] = $row->referencia;
                $tarifas["descripcion"] = $row->descripcion;
            }
        }
        $this->db->close();
        return $tarifas;
    }

    //Función para obtener las tarifas por establecimiento y ciudad
    function obtenerDatosTarifasId($IdEstablecimiento,$cmbMpioTar, $tipo_carga, $referencia) {
        $tarifas = array();
        $sql = "SELECT id_tarifa, id_establecimientos, id_ciudad, tipo_carga, valor_tarifa, referencia, descripcion
                FROM txtar_admin_tarifas
                WHERE  id_establecimientos = $IdEstablecimiento
                AND  id_ciudad=$cmbMpioTar
                AND tipo_carga=$tipo_carga
                AND referencia=$referencia ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $tarifas["id_establecimientos"] = $row->id_establecimientos;
                $tarifas["id_ciudad"] = $row->id_ciudad;
                $tarifas["tipo_carga"] = $row->tipo_carga;
                $tarifas["valor_tarifa"] = $row->valor_tarifa;
                $tarifas["referencia"] = $row->referencia;
                $tarifas["descripcion"] = $row->descripcion;
            }
        }
        $this->db->close();
        return $tarifas;
    } 
    //Función para registrar las tarifas
    function registrarTarifas($IdEstablecimiento, $cmbMpioTar, $tipo_carga, $valor_tarifa, $referencia, $descripcion) {
        $data = array(
            'id_establecimientos' => $IdEstablecimiento,
            'id_ciudad' => $cmbMpioTar,
            'tipo_carga' => $tipo_carga,
            'valor_tarifa' => $valor_tarifa,
            'referencia' => $referencia,
            'descripcion' => $descripcion
        );
        $this->db->insert("txtar_admin_tarifas", $data);
        $this->db->close();
    }
    //Función para actualizar las tarifas
    function actualizarTarifas($IdTarifa, $tipo_carga, $valor_tarifa, $referencia, $descripcion) {
        $data = array(
            'tipo_carga' => $tipo_carga,
            'valor_tarifa' => $valor_tarifa,
            'referencia' => $referencia,
            'descripcion' => $descripcion
        );
        $this->db->where("id_tarifa", $IdTarifa);
        $this->db->update("txtar_admin_tarifas", $data);
        $this->db->close();
    }
}    