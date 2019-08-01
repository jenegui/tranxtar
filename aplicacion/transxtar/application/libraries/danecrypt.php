<?php

class DaneCrypt {

  

    public static function encode($password) {

        $hashClave = hash('sha512', $password);

        return $hashClave;

    }

 

}