<?php



class usuarioCrypt {
    public static function encode($pass) {
        $passHash = password_hash($pass, PASSWORD_BCRYPT);
        return $passHash;
    }
}//EOC