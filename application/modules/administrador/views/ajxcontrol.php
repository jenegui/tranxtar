<?php
$this->load->library("session");
$this->load->helper("url");
$url = site_url();
//echo '<img scr="'.$url.'("images/edit.png")">';
if (count($control) > 0) {
    for ($i = 0; $i < count($control); $i++) {
        $editar = '<a href=administrador/editarControl/'.$control[$i]['id_control'].' onclick=\"editarDestinatario('.$control[$i]['id_control'].')\"><img border=\"0px\" src="'.$url.'/images/edit.png" alt=\"Editar\"/></a>';
        $imprimir = '<a href=administrador/imprimirGuia/'.$control[$i]['id_control'].' onclick=\"editarDestinatario('.$control[$i]['id_control'].')\"><img border=\"0px\" src="'.$url.'/images/impresora.png" alt=\"Editar\"/></a>';
        $datas[] = array('NumGuia' => $control[$i]['id_control'],
            'IdCliente' => $control[$i]['id_establecimientos'],
            'nomCliente' => $control[$i]['idnomcom'],
            'fecRecogida' => $control[$i]['fecha_recogida'],
            'fecEntrega' => $control[$i]['fecha_entrega'],
            'IdDestinatario' => $control[$i]['id_destinatario'],
            'nomDestinatario' => $control[$i]['nombre_destinatario'],
            'valorFlete' => $control[$i]['total_fletes'],
            'fecRegistro' => $control[$i]['fecha_registro'],
            'estadoCarga' => $control[$i]['nom_estado'],
            'Editar'=>$editar,
            'Imprimir' => $imprimir);
    }
} else {
    $datas[] = array('NumGuia' => "",
        'IdCliente' => "",
        'nomCliente' => "",
        'fecRecogida' => "",
        'fecEntrega' => "",
        'IdDestinatario' => "",
        'nomDestinatario' => "",
        'valorFlete' => "",
        'fecRegistro' => "",
        'estadoCarga' => "",
        'editar' => "",
        'imprimir' => "");
}
$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($control),
    "iTotalDisplayRecords" => count($control),
    "aaData" => $datas,);
echo json_encode($results);
?>