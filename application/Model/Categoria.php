<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/01/19
 * Time: 21:01
 */

namespace Mini\Model;

use Mini\Core\Database;


class Categoria
{
    public static function buscar($value, $param = 'id')
    {

        $conn = Database::getInstance()->getDatabase();
        $ssql = "SELECT * FROM categorias WHERE " . $param . "='" . $value ."'";
        $query = $conn->prepare($ssql);
        $query->execute();
        return $query->fetchAll();

    }
}