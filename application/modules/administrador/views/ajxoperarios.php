<?php

$this->load->library("session");
$this->load->helper("url");
$url = site_url();
//echo '<img scr="'.$url.'("images/edit.png")">';

if (count($usuarios) > 0) {
    for ($i = 0; $i < count($usuarios); $i++) {
        $editar = '<a href=administrador/UPDOperario/'.$usuarios[$i]['id_operario'].' onclick=\"UPDOperario('.$usuarios[$i]['id_operario'].')\"><img border=\"0px\" src="'.$url.'/images/edit.png" alt=\"Editar\"/></a>';
        $datas[] = array('nomOperario' => $usuarios[$i]['nombre_operario'],
            'identificacion' => $usuarios[$i]['nro_identificacion'],
            'telefono' => $usuarios[$i]['telefono_operario'],
            'placaVehiculo'=>$usuarios[$i]['nro_placa'],
            'estado'=>$usuarios[$i]['estado_operario'],
            'editar' => $editar);
    }
} else {
    $datas[] = array('nombre' => "",
        'nivel' => "",
        'estado' => "",
        'editar' => ""
        );
}
$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($usuarios),
    "iTotalDisplayRecords" => count($usuarios),
    "aaData" => $datas);
echo json_encode($results);

