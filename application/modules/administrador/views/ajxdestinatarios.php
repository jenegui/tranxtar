<?php

$this->load->library("session");
$this->load->helper("url");
$url = site_url();
//echo '<img scr="'.$url.'("images/edit.png")">';
if (count($destinatarios) > 0) {
    for ($i = 0; $i < count($destinatarios); $i++) {
        $editar = '<a href=administrador/editarDestinatario/'.$destinatarios[$i]['id_destinatario'].' onclick=\"editarDestinatario('.$destinatarios[$i]['id_destinatario'].')\"><img border=\"0px\" src="'.$url.'/images/edit.png" alt=\"Editar\"/></a>';
        $datas[] = array('id_destinatario' => $destinatarios[$i]['id_destinatario'],
            'nombre_destinatario' => $destinatarios[$i]['nombre_destinatario'],
            'nro_identificacion' => $destinatarios[$i]['nro_identificacion'],
            'fk_mpio' => $destinatarios[$i]['fk_mpio'],
            'fk_depto' => $destinatarios[$i]['fk_depto'],
            'direccion_destinatario' => $destinatarios[$i]['direccion_destinatario'],
            'telefono_destinatario' => $destinatarios[$i]['telefono_destinatario'],
            'contacto_destinatario' => $destinatarios[$i]['contacto_destinatario'],
            //'button' => '<input type="button" id="editarDestinatario" name="editarDestinatario" value="Registrar destinatarios" class="button"/>');
            //'button' => '<button class="btn btn-primary" type="button" id="editarDestinatario" value="'.$destinatarios[$i]['id_destinatario'].'"><i class="fa fa-edit"></i> </button>');
            //'button' => '<button type="submit" id_destinatario= "'.$destinatarios[$i]['id_destinatario'].'" class btn-warning btnedit"> <i class="fa fa-edit"></i>Editar</button>');
            'editar' => $editar);
            
    }
} else {
    $datas[] = array('id_destinatario' => "",
        'nombre_destinatario' => "",
        'nro_identificacion' => "",
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
