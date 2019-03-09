<?php

/***
/***
 * Daniel Mauricio Díaz Forero
 * Junio 05 2012
 * Libreria codeigniter para Encriptar / Desencriptar contraseñas
 */

class DaneCrypt {
    
	private static  $arrayLetras = array('M', 'A', 'R', 'C', 'O', 'S');
    private static function getArrayLetras() {
        return self::$arrayLetras;
    }
    public static function codificar($dato){
        $resultado = $dato;
     
        $limite = count(self::getArrayLetras()) - 1;
        $num = mt_rand(0, $limite);
        for ($i = 1; $i <= $num; $i++) {
            $resultado = base64_encode($resultado);
        }
        $resultado = $resultado . '+' . self::getArrayLetras()[$num];
        $resultado = base64_encode($resultado);
        return $resultado;
    }
    public static function decodificar($dato) {
        $resultado = base64_decode($dato);
        list($resultado, $letra) = explode('+', $resultado);
       
        for ($i = 0; $i < count(self::getArrayLetras()); $i++) {
            if (self::getArrayLetras()[$i] == $letra) {
                for ($j = 1; $j <= $i; $j++) {
                    $resultado = base64_decode($resultado);
                }
                break;
            }
        }
        return $resultado;
    }
	
}//EOC