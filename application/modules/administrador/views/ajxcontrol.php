<?php
$this->load->library("session");
$this->load->helper("url");
$url = site_url();
//echo '<img scr="'.$url.'("images/edit.png")">';
if (count($control) > 0) {
    for ($i = 0; $i < count($control); $i++){
        if($usuario==4){
            $editar = '<a href=administrador/editarControlTraficoySeg/'.$control[$i]['id_control'].' onclick=\"editarDestinatario('.$control[$i]['id_control'].')\"><img border=\"0px\" src="'.$url.'/images/edit.png" alt=\"Editar\"/></a>';
        }elseif($usuario==6){
            $editar = '<a href=administrador/editarControlContable/'.$control[$i]['id_control'].' onclick=\"editarDestinatario('.$control[$i]['id_control'].')\"><img border=\"0px\" src="'.$url.'/images/edit.png" alt=\"Editar\"/></a>';
        }else{
            $editar = '<a href=administrador/editarControl/'.$control[$i]['id_control'].' onclick=\"editarDestinatario('.$control[$i]['id_control'].')\"><img border=\"0px\" src="'.$url.'/images/edit.png" alt=\"Editar\"/></a>';
        }
        if($usuario==6){
            $campo1=$control[$i]['estado_contable'];
            $campo2=$control[$i]['estado_recaudo'];
            
        }else{
            $campo1='<a href=administrador/imprimirGuia/'.$control[$i]['id_control'].' onclick=\"editarDestinatario('.$control[$i]['id_control'].')\"><img border=\"0px\" src="'.$url.'/images/impresora.png" alt=\"Editar\"/></a>';
            $campo2=$control[$i]['fecha_registro'];
        }
        $datas[] = array('NumGuia' => "G-".$control[$i]['id_control'],
            'IdCliente' => $control[$i]['id_establecimientos'],
            'nomCliente' => $control[$i]['idnomcom'],
            'fecRecogida' => $control[$i]['fecha_recogida'],
            'fecEntrega' => $control[$i]['fecha_entrega'],
            'IdDestinatario' => $control[$i]['id_destinatario'],
            'nomDestinatario' => $control[$i]['nombre_destinatario'],
            'valorFlete' => $control[$i]['total_fletes'],
            'fecRegistro' => $campo2,
            'estadoCarga' => $control[$i]['nom_estado'],
            'Editar'=>$editar,
            'Imprimir' => $campo1);
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