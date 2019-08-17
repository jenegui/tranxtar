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
        $sql = "SELECT id_tarifa, id_establecimientos, id_ciudad, valor_kilo, valor_volumen, valorx_unidad
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
                $tarifas[$i]["valor_kilo"] = $row->valor_kilo;
                $tarifas[$i]["valor_volumen"] = $row->valor_volumen;
                $tarifas[$i]["valorx_unidad"] = $row->valorx_unidad;
            $i++;    
            }
        }
        $this->db->close();
        return $tarifas;
    }

    function obtenerTarifasId($id_tarifa) {
        $this->load->model("divipola");
        $tarifas = array();
        $sql = "SELECT id_tarifa, id_establecimientos, id_ciudad, valor_kilo, valor_volumen, valorx_unidad
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
                $tarifas["valor_kilo"] = $row->valor_kilo;
                $tarifas["valor_volumen"] = $row->valor_volumen;
                $tarifas["valorx_unidad"] = $row->valorx_unidad;
            }
        }
        $this->db->close();
        return $tarifas;
    }

    //Función para obtener las tarifas por establecimiento y ciudad
    function obtenerDatosTarifasId($IdEstablecimiento,$cmbMpioTar) {
        $tarifas = array();
        $sql = "SELECT id_establecimientos, id_ciudad, valor_kilo, valor_volumen, valorx_unidad
                FROM txtar_admin_tarifas
                WHERE  id_establecimientos = $IdEstablecimiento
                AND  id_ciudad=$cmbMpioTar";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $tarifas["id_establecimientos"] = $row->id_establecimientos;
                $tarifas["id_ciudad"] = $row->id_ciudad;
                $tarifas["valor_kilo"] = $row->valor_kilo;
                $tarifas["valor_volumen"] = $row->valor_volumen;
                $tarifas["valorx_unidad"] = $row->valorx_unidad;
            }
        }
        $this->db->close();
        return $tarifas;
    } 
    //Función para registrar las tarifas
    function registrarTarifas($IdEstablecimiento, $cmbMpioTar, $valorpesokg, $valorvolumen, $valorxunidad) {
        $data = array(
            'id_establecimientos' => $IdEstablecimiento,
            'id_ciudad' => $cmbMpioTar,
            'valor_kilo' => $valorpesokg,
            'valor_volumen' => $valorvolumen,
            'valorx_unidad' => $valorxunidad
        );
        $this->db->insert("txtar_admin_tarifas", $data);
        $this->db->close();
    }
    //Función para actualizar las tarifas
    function actualizarTarifas($IdTarifa, $valorpesokg, $valorvolumen, $valorxunidad) {
        $data = array(
            'valor_kilo' => $valorpesokg,
            'valor_volumen' => $valorvolumen,
            'valorx_unidad' => $valorxunidad
        );
        $this->db->where("id_tarifa", $IdTarifa);
        $this->db->update("txtar_admin_tarifas", $data);
        $this->db->close();
    }
}    