<?php
$this->load->library("session");
$this->load->helper("url");
$url = site_url();
//echo '<img scr="'.$url.'("images/edit.png")">';
if (count($control) > 0) {
    for ($i = 0; $i < count($control); $i++){
        $datas[] = array('NumGuia' => '<a href=administrador/detalleGuia/'.$control[$i]['id_control'].' class="external"><b>G-'.$control[$i]['id_control'].'</b></a>',
            'nomCliente' => $control[$i]['idnomcom'],
            'fecRecogida' => $control[$i]['fecha_recogida'],
            'fecEntrega' => $control[$i]['fecha_entrega'],
            'nomDestinatario' => $control[$i]['nombre_destinatario'],
            'ciudadDest' => $control[$i]['ciudadDest'],
            'deptoDest' => $control[$i]['deptoDest'],
            'valorFlete' => $control[$i]['total_fletes'],
            'pesoKg' => $control[$i]['peso'],
            'pesoVol' => $control[$i]['peso_vol'],
            'estadoCarga' => $control[$i]['nom_estado']);
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