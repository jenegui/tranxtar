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
            $campo3=$control[$i]['total_fletes'];
            $campo4=$editar;
        }elseif($usuario==2){
            $id_control=$control[$i]['id_control'];
            $campo1='<a href=administrador/imprimirGuia/'.$id_control.'><img border=\"0px\" src="'.$url.'/images/impresora.png" alt=\"Imprimir\"/></a>';
            $campo2=$control[$i]['estado_control'];
            $campo3=$control[$i]['total_fletes'];
            $campo4=$editar;
        }elseif($usuario==5 || $usuario==8){
            $id_control=$control[$i]['id_control'];
            $campo1='<a href=administrador/imprimirGuia/'.$id_control.'><img border=\"0px\" src="'.$url.'/images/impresora.png" alt=\"Imprimir\"/></a>';
            $campo2=$control[$i]['fecha_registro'];
            $campo3=$control[$i]['unidades'];
            $campo4='';
        }elseif($usuario==7){
            $id_control=$control[$i]['id_control'];
            $campo1='<a href=administrador/imprimirGuia/'.$id_control.'><img border=\"0px\" src="'.$url.'/images/impresora.png" alt=\"Imprimir\"/></a>';
            $campo2=$control[$i]['fecha_registro'];
            $campo3=$control[$i]['unidades'];
            $campo4=$editar;
        }else{
            $id_control=$control[$i]['id_control'];
            $campo1='<a href=administrador/imprimirGuia/'.$id_control.'><img border=\"0px\" src="'.$url.'/images/impresora.png" alt=\"Imprimir\"/></a>';
            $campo2=$control[$i]['fecha_registro'];
            $campo3=$control[$i]['total_fletes'];
            $campo4=$editar;
        }
        $datas[] = array('NumGuia' => '<a href=administrador/detalleGuia/'.$control[$i]['id_control'].' class="external"><b>G-'.$control[$i]['id_control'].'</b></a>',
            'numRemesa' => $control[$i]['nroRemesa'],
            'nomCliente' => $control[$i]['idnomcom'],
            'ciudadOrigen' => $control[$i]['ciudadOrigen'],
            'fecRecogida' => $control[$i]['fecha_recogida'],
            'fecEntrega' => $control[$i]['fecha_entrega'],
            'formaPago' => $control[$i]['forma_pago'],
            'nomDestinatario' => $control[$i]['nombre_destinatario'],
            'ciudadDestino' => $control[$i]['ciudadDest'],
            'valorFlete' => $campo3,
            'fecRegistro' => $campo2,
            'estadoCarga' => $control[$i]['nom_estado'],
            'Editar'=>$campo4,
            'Imprimir' => $campo1);
    }
} else {
    $datas[] = array('NumGuia' => "",
        'numRemesa' => "",
        'nomCliente' => "",
        'ciudadOrigen' => "",
        'fecRecogida' => "",
        'fecEntrega' => "",
        'formaPago' => "",
        'nomDestinatario' => "",
        'ciudadDestino' => "",
        'valorFlete' => "",
        'fecRegistro' => "",
        'estadoCarga' => "",
        'Editar' => "",
        'Imprimir' => "");
}
$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($control),
    "iTotalDisplayRecords" => count($control),
    "aaData" => $datas);

echo json_encode($results);
?>