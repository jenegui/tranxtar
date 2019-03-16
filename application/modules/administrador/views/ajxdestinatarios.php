<?php

$this->load->library("session");
$this->load->helper("url");
$url = site_url();
//echo '<img scr="'.$url.'("images/edit.png")">';
if (count($destinatarios) > 0) {
    for ($i = 0; $i < count($destinatarios); $i++) {
        $datas[] = array('id_destinatario' => $destinatarios[$i]['id_destinatario'],
            'nro_identificacion' => $destinatarios[$i]['nro_identificacion'],
            'nombre_destinatario' => $destinatarios[$i]['nombre_destinatario'],
            'fk_mpio' => $destinatarios[$i]['fk_mpio'],
            'fk_depto' => $destinatarios[$i]['fk_depto'],
            'direccion_destinatario' => $destinatarios[$i]['direccion_destinatario'],
            'telefono_destinatario' => $destinatarios[$i]['telefono_destinatario'],
            'contacto_destinatario' => $destinatarios[$i]['contacto_destinatario']);
    }
} else {
    $datas[] = array('id_destinatario' => "",
        'nro_identificacion' => "",
        'nombre_destinatario' => "",
        'fk_mpio' => "",
        'fk_depto' => "",
        'direccion_destinatario' => "",
        'telefono_destinatario' => "",
        'contacto_destinatario' => "");
}
$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($destinatarios),
    "iTotalDisplayRecords" => count($destinatarios),
    "aaData" => $datas,);
echo json_encode($results);
?>
