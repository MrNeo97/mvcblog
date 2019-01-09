<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/01/19
 * Time: 21:30
 */

namespace Mini\Model;

use Mini\Core\Database;

class Post
{
    public function listado()
    {
        $conn = Database::getInstance()->getDatabase();
        $ssql = "SELECT * FROM posts";
        $query = $conn->prepare($ssql);
        $query->execute();
        return $query->fetchAll();
    }
}