<?php

$this->load->library("session");
$this->load->helper("url");
$url = site_url();
//echo '<img scr="'.$url.'("images/edit.png")">';

if (count($usuarios) > 0) {
    for ($i = 0; $i < count($usuarios); $i++) {
        $editar = '<a href=administrador/editarControl/'.$usuarios[$i]['id'].' onclick=\"editarDestinatario('.$usuarios[$i]['id'].')\"><img border=\"0px\" src="'.$url.'/images/edit.png" alt=\"Editar\"/></a>';
        $datas[] = array('Id' => $usuarios[$i]['id'],
            'nombre' => $usuarios[$i]['nombre'],
            'rol' => $usuarios[$i]['nom_rol'],
            'estado'=>$usuarios[$i]['estado'],
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

