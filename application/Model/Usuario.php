<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/01/19
 * Time: 21:30
 */

namespace Mini\Model;

use Mini\Core\Database;
use Mini\Core\Session;

class Usuario
{
    public function comprueba($user, $clave, $param)
    {
        $conn = Database::getInstance()->getDatabase();
        $ssql = "SELECT * FROM administradores WHERE " . $param ." = '" . $user . "'";
        $query = $conn->prepare($ssql);
        $query->execute();

        if( $query->fetchAll() ) {
            $conn = Database::getInstance()->getDatabase();
            $ssql = "SELECT * FROM administradores WHERE password = '" . $clave . "' AND " . $param . " = '" . $user . "'";
            $query = $conn->prepare($ssql);
            $query->execute();
            $cuenta = $query->rowCount();
            $query = $query->fetchAll();
            //var_dump($query);

            if( $cuenta == 1 ) {
                Session::set('user', $query);
                return true;
            } else {
                Session::set('errorPass', 'La contraseña es incorrecta');
                return true;
            }

        } else {
            Session::set('errorUser', 'El ' . $param . ' no existe en la base de datos');
            return true;
        }

    }
}